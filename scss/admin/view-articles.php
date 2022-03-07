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
   <h2>view articles</h2>
   <table class="table table-striped">
    <thead>
      <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                   
                                    <th>Categories</th>
                                    <th>Image</th>
                                    <th>Date</th>
                                    <th> content</th>
                                   
                                    <th>Operations</th>
      </tr>
    </thead>
    <tbody>
    <?php 


                                   $sql = "SELECT * FROM posts ";
                                   $result = $db->prepare($sql);
                                   $result->execute();



                                 
                                    
                                    $res = $result->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($res as $post) {
                                    // TODO : Only user with administrator privillages or user who created the article can only edit or delete post

                                    $catsql = "SELECT categories.title FROM categories INNER JOIN post_categories ON post_categories.cid=categories.id WHERE post_categories.pid=?";
                                    $catresult = $db->prepare($catsql);
                                    $catresult->execute(array($post['id']));
                                    $categories = $catresult->fetchAll(PDO::FETCH_ASSOC);
                                /*
                                    $usersql = "SELECT * FROM users WHERE id=?";
                                    $userresult = $db->prepare($usersql);
                                    $userresult->execute(array($post['uid']));
                                    $user = $userresult->fetch(PDO::FETCH_ASSOC);

                                    */

                                  


  ?>
                                <tr>
                                    <td><?php echo $post['id']; ?></td>
                                    <td><?php echo $post['title']; ?></td> 
                                    <td><?php foreach ($categories as $cat) {echo $cat['title'].", ";} ?></td>                                                  
                                    <td><?php if(isset($post['pic']) & !empty($post['pic'])){ echo "Yes"; }else{ echo "No"; } ?></td>
                                    <td><?php echo $post['updated']; ?></td>
                                    <td><?php echo substr($post['content'], 0, 12); ?>...</td>
                                    <td><a href="edit-article.php?id=<?php echo $post['id']; ?>">Edit</a> | <a href="delete-article.php?id=<?php echo $post['id']; ?> ">Delete</a></td>
                                </tr>
                                <?php } ?>
  
    </tbody>
  </table>
  
  
   </div>



   
    </main>

    



    <?php include ('inc/footer.php'); ?>