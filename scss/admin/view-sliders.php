<?php

session_start();
require_once('../includes/connect.php');
include('inc/check-login.php');

include ('inc/header.php'); 
include ('inc/navbar.php'); 
 



 ?>




    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
       
      
        </div>
      </div>

   <div class="col-sm-8">
   <h2>view sliders</h2>
   <table class="table table-striped">
    <thead>
      <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                   
                                    <th> description</th>
                                    <th>Image</th>
                                   
                                   
                                   
                                    <th>Operations</th>
      </tr>
    </thead>
    <tbody>
   
  <?php

 
 $stmt = $db->prepare('SELECT userID, userName, userProfession, userPic FROM tbl_users ORDER BY userID DESC');
 $stmt->execute();
 
 if($stmt->rowCount() > 0)
 {
  while($post= $stmt->fetch(PDO::FETCH_ASSOC))
  {
   extract($post);
   ?>


                                <tr>
                                    <td><?php echo $post['userID']; ?></td>
                                    <td><?php echo substr($userName, 0, 12); ?> ...</td> 
                                    <td><?php echo substr($userProfession, 0, 18); ?>...</td> 
                                            
                                    <td><?php if(isset($post['userPic']) & !empty($post['userPic'])){ echo "Yes"; }else{ echo "No"; } ?></td>
                                   
                                   
                                    <td><a href="editformslider.php?edit_id=<?php echo $post['userID']; ?>">Edit</a> | <a href="?delete_id=<?php echo $post['userID']; ?>"  title="click for delete" onclick="return confirm('sure to delete ?')">Delete</a></td>
                                </tr>

 <?php } } ?>
  
    </tbody>
  </table>
  
  
   </div>


   <?php
if(isset($_GET['delete_id']))
{
 // select image from db to delete
 $stmt_select = $db->prepare('SELECT userPic FROM tbl_users WHERE userID =:uid');
 $stmt_select->execute(array(':uid'=>$_GET['delete_id']));
 $imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
 unlink("../user_images/".$imgRow['userPic']);
 
 // it will delete an actual record from db
 $stmt_delete = $db->prepare('DELETE FROM tbl_users WHERE userID =:uid');
 $stmt_delete->bindParam(':uid',$_GET['delete_id']);
 $stmt_delete->execute();
 
 // header("Location: view-sliders.php");
}

?>



   
    </main>

    



    <?php include ('inc/footer.php'); ?>