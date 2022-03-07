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
   <h2>Section title</h2>
   <table class="table table-striped">
    <thead>
      <tr>
      <th>#</th>
      <th>Title</th>
      <th>Slug</th>
      <th>Updated</th>
      <th>Operations</th>
      </tr>
    </thead>
    <tbody>
                                <?php
                              /* $start, $perpage*/
                                    $sql = "SELECT * FROM categories ";
                                    $result = $db->prepare($sql);
                                    $result->execute();
                                    $res = $result->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($res as $cat) {
                                ?>
                                <tr>
                                    <td><?php echo $cat['id']; ?></td>
                                    <td><?php echo $cat['title']; ?></td>
                                    <td><?php echo $cat['slug']; ?></td>
                                    <td><?php echo $cat['updated']; ?></td>
                                    <td><a href="edit-category.php?id=<?php echo $cat['id']; ?>">Edit</a> | <a href="delete-item.php?id=<?php echo $cat['id']; ?>&item=category">Delete</a></td>
                                    
                                </tr>
                                <?php } ?>
   
    </tbody>
  </table>
  
  
   </div>


   
    </main>

    <?php include ('inc/footer.php'); ?>