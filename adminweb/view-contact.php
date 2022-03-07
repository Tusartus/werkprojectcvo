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
            
            
        </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
       
      
        </div>
      </div>

   <div class="col-sm-8">
 
 <h2> alle berichten </h2>
 <hr>
   <table class="table table-striped">
    <thead>
      <tr>
      
      <th>name</th>
      <th> email </th>
      <th> provencie </th>
      <th> berichten </th>
      <th> created  </th>
      
      <th> read </th>
      </tr>
    </thead>
    <tbody>
                                <?php
                                
                                    $sql = "SELECT * FROM  contacts";
                                    $result = $db->prepare($sql);
                                    $result->execute();
                                    $res = $result->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($res as $co) {
                                        
                                ?>
                                <tr>
                                    
                                    <td><?php  echo $co['name']; ?>  </td>
                                    <td><?php echo $co['email']; ?>  </td>
                                    <td><?php  echo $co['provencie']; ?> </td>
                                    <td><?php echo $co['bericht']; ?>  </td>
                                    <td><?php echo date("d-m-Y", strtotime($co['created'])); ?>  </td>
                                   
                                    <td> <a class="btn btn-danger" href="?delete_id=<?php echo $co['id']; ?>">Delete</a></td>
                                    
                                </tr>
                                <?php } ?>
   
    </tbody>
  </table>
  
  
   </div>

 
    
   
   <?php
   /* delete  contact in ons databank  */
if(isset($_GET['delete_id']))
{
 
 // it will delete an actual record from db
 $stmt_delete = $db->prepare('DELETE FROM contacts WHERE id =:pid');
 $stmt_delete->bindParam(':pid',$_GET['delete_id']);
 $stmt_delete->execute();

if($stmt_delete->execute())
{

  echo"
  <script>
  alert('Successfully deleted ...');
  window.location.href='view-contact.php';
  </script>";



}



}

?>
  
  
  


   
    </main>

    <?php include ('inc/footer.php'); ?>