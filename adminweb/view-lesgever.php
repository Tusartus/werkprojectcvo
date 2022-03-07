<?php 
  session_start();

  include ('../includes/connect.php');

 include ('inc/header.php'); 
 include ('inc/navbar.php');

 //protect index page only for login as admin role in users databank
 require_once( "config/if-loggin.php");




 ?>




    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
            <a class="text-info p-2" href="add-lesgever.php"> add new </a>
            
        </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
       
      
        </div>
      </div>

   <div class="col-sm-8">
 
 <h2> inhoud   </h2>
 <hr>
   <table class="table table-striped">
    <thead>
      <tr>
      <th>#</th>
      <th>title</th>
      <th> description</th>
     
      
      <th>Operations</th>
      </tr>
    </thead>
    <tbody>
    <?php 


$sql = "SELECT * FROM lesgevers ";
$result = $db->prepare($sql);
$result->execute();      
$res = $result->fetchAll(PDO::FETCH_ASSOC);
 foreach ($res as $p) {
                                


?>         
 
                                <tr>
                                    <td> <?php echo $p['id']; ?></td>
                                    <td>  <?php echo $p['title']; ?></td>
                                    <td> <?php echo substr($p['description'], 0, 25); ?>...</td>
                                    
                                   
                                    <td> 
                                    <a class="text-info" href="edit-lesgever.php?edit_id=<?php echo $p['id'];?>">edit</a> |  
                                    <a class="text-success" href="?delete_id=<?php echo $p['id'];  ?>">Delete</a></td>
                                    
                                </tr>
 <?php } ?>
     
   
    </tbody>
  </table>
  
  
   </div>

 
   
   <?php
   /* delete in helpen databank met image  */
if(isset($_GET['delete_id']))
{
 // select image from db to delete
 $stmt_select = $db->prepare('SELECT pic FROM lesgevers WHERE id =:id');
 $stmt_select->execute(array(':id'=>$_GET['delete_id']));
 $imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
 unlink("../media-lesgever/".$imgRow['pic']);
 
 // it will delete an actual record from db
 $stmt_delete = $db->prepare('DELETE FROM lesgevers WHERE id =:pid');
 $stmt_delete->bindParam(':pid',$_GET['delete_id']);
 $stmt_delete->execute();

 

if($stmt_delete->execute())
{

  echo"
  <script>
  alert('Successfully deleted ...');
  window.location.href='view-werking.php';
  </script>
  ";



}



}

?>

  
  


   
    </main>

    <?php include ('inc/footer.php'); ?>