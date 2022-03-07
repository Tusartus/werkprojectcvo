<?php 

require_once('../includes/connect.php');
//include('inc/check-login.php');


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
   <h2>all users</h2>
 
   <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User Name</th>
                                    <th>Name</th>
                                    <th>E-Mail</th>
                                    <th>Role</th>
                                    <th>Articles</th>
                                    <th>Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $sql = "SELECT * FROM users ";
                                    $result = $db->prepare($sql);
                                    $result->execute();
                                    $res = $result->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($res as $user) {
                                        $postsql = "SELECT * FROM posts WHERE uid=?";
                                        $postresult = $db->prepare($postsql);
                                        $postresult->execute(array($user['id']));
                                        $postcount = $postresult->rowCount();
                                ?>
                                <tr>
                                    <td><?php echo $user['id']; ?></td>
                                    <td><?php echo $user['username']; ?></td>
                                    <td><?php echo $user['fname'] . " " . $user['lname']; ?></td>
                                    <td><?php echo $user['email']; ?></td>
                                    <td><?php echo $user['role']; ?></td>
                                    <td><?php echo $postcount; ?></td>
                                    <td><a href="edit-user.php?id=<?php echo $user['id']; ?>">Edit</a> | <a href="delete-item.php?id=<?php echo $user['id']; ?>&item=user">Delete</a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
  
   </div>


   
    </main>

    <?php include ('inc/footer.php'); ?>