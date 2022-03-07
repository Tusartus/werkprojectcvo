<?php
session_start();
require_once('../includes/connect.php');


 //protected page only for login as admin role in users databank
 require_once( "config/if-loggin.php");

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
   <h2>view articles</h2>
   <table class="table table-striped"   id="table_id">
    <thead>
      <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>category</th>
                                   
                                    <th> content</th>
                                    <th>Image</th>
                                     <th>price</th>
                                    <th>Date</th>
                                  
                                   
                                    <th>Operations</th>
      </tr>
    </thead>
    <tbody>
    <?php 

                                   //$sql = "SELECT * FROM products INNER JOIN categories on products.catid = categories.id";
                                   $sql = "SELECT * FROM products ";
                                   $result = $db->prepare($sql);
                                   $result->execute();      
                                   $res = $result->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($res as $post) {
                                                                   


  ?>
                                <tr>
                                    <td><?php echo $post['id']; ?></td>
                                    <td><?php echo substr($post['Name'], 0, 20); ?>...</td> 
                                    <td><?php

                                       echo $post['catid'];
                                      
                                
                                      ?>
                                    </td>  
                                    <td><?php echo substr($post['Description'], 0, 12); ?>...</td>                                                
                                    <td><?php if(isset($post['pic']) & !empty($post['pic'])){ echo "Yes"; }else{ echo "No"; } ?></td>
                                    <td> $ <?php echo $post['Price']; ?></td> 
                                    <td><?php echo $post['created']; ?></td>
                                  
                                    <td><a href="edit-product.php?edit_id=<?php echo $post['id']; ?>">Edit</a> | <a href="?delete_id=<?php echo $post['id']; ?>" onclick="return confirm('sure to delete ?')">Delete</a></td>
                                </tr>
                                <?php } ?>
  
    </tbody>
  </table>
  
  
   </div>

   <?php
if(isset($_GET['delete_id']))
{
 // select image from db to delete
 $stmt_select = $db->prepare('SELECT pic FROM products WHERE id =:id');
 $stmt_select->execute(array(':id'=>$_GET['delete_id']));
 $imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
 unlink("../media-products/".$imgRow['pic']);
 
 // it will delete an actual record from db
 $stmt_delete = $db->prepare('DELETE FROM products WHERE id =:pid');
 $stmt_delete->bindParam(':pid',$_GET['delete_id']);
 $stmt_delete->execute();

 

if($stmt_delete->execute())
{

  echo"
  <script>
  alert('Successfully deleted ...');
  window.location.href='view-products.php';
  </script>
  ";



}



}

?>


   
    </main>

    



    <?php include ('inc/footer.php'); ?>


    