<?php 
//include('inc/check-login.php');

require_once('../includes/connect.php');

//include('includes/check-admin.php');
//check-subscriber.php is not required while check-admin in loaded
//include('includes/check-subscriber.php');
if(isset($_POST) & !empty($_POST)){
    // PHP Form Validations
    if(empty($_POST['fname'])){ $errors[] = 'First Name field is Required';}
    if(empty($_POST['role'])){ $errors[] = 'User Role field is Required';}
    // CSRF Token Validation
    if(isset($_POST['csrf_token'])){
        if($_POST['csrf_token'] === $_SESSION['csrf_token']){
        }else{
            $errors[] = "Problem with CSRF Token Verification";
        }
    }else{
        $errors[] = "Problem with CSRF Token Validation";
    }
    // CSRF Token Time Validation
    $max_time = 60*60*24;
    if(isset($_SESSION['csrf_token_time'])){
        $token_time = $_SESSION['csrf_token_time'];
        if(($token_time + $max_time) >= time()){
        }else{
            $errors[] = "CSRF Token Expired";
            unset($_SESSION['csrf_token']);
            unset($_SESSION['csrf_token_time']);
        }
    }else{
        unset($_SESSION['csrf_token']);
        unset($_SESSION['csrf_token_time']);
    }

    if(empty($errors)){
        $pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        // add password to sql & values while it's submitted
        $sql = "UPDATE users SET fname=:fname, lname=:lname, ";
        if(isset($_POST['password'])& !empty($_POST['password'])){$sql .= "password=:password, ";}
        $sql .= " role=:role, updated=NOW() WHERE id=:id";
        $result = $db->prepare($sql);
        $values = array(':fname'        => $_POST['fname'],
                        ':lname'        => $_POST['lname'],
                        ':role'         => $_POST['role'],
                        ':id'           => $_POST['id']
                        );
        if(isset($_POST['password'])& !empty($_POST['password'])){$values[':password'] = $pass_hash; }
        $res = $result->execute($values);
        if($res){
            // redirect user to view-users.php page
            header("location: view-users.php");
        }else{
            $errors[] = "Failed to Update users";
        }
    }
}
// Create CSRF token
$token = md5(uniqid(rand(), TRUE));
$_SESSION['csrf_token'] = $token;
$_SESSION['csrf_token_time'] = time();




// Create CSRF token
$token = md5(uniqid(rand(), TRUE));
$_SESSION['csrf_token'] = $token;
$_SESSION['csrf_token_time'] = time();




include ('inc/header.php'); 
include ('inc/navbar.php'); 



$sql = "SELECT * FROM users WHERE id=?";
$result = $db->prepare($sql);
$result->execute(array($_GET['id']));
$user = $result->fetch(PDO::FETCH_ASSOC); 


?>




    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"> Users</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
       
     
        </div>
      </div>

   <div class="col-sm-8">
   <h2> Edit user</h2>

   <div class="col-md-9">
   <?php
                        if(!empty($messages)){
                            echo "<div class='alert alert-success'>";
                            foreach ($messages as $message) {
                                echo "<span class='glyphicon glyphicon-ok'></span>&nbsp;". $message ."<br>";
                            }
                            echo "</div>";
                        }
                    ?>
                    <?php
                        if(!empty($errors)){
                            echo "<div class='alert alert-danger alert-dismissible'>";
                          echo"<button type='button' class='close' data-dismiss='alert'>&times;</button>";
                            foreach ($errors as $error) {
                                echo "<span class='glyphicon glyphicon-remove'></span>&nbsp;". $error ."<br>";
                            }
                            echo "</div>";
                        }
                    ?>
   
   </div>
      
      <fiedset class="cllaa p-2">
      <form role="form" method="post">
                                <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
                                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                                <div class="form-group">
                                    <label>User Name</label>
                                    <input class="form-control" name="username" placeholder="Enter User Name" value="<?php if(isset($user['username'])){ echo $user['username'];} ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label>E-Mail</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter E-Mail" value="<?php if(isset($user['email'])){ echo $user['email'];} ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input class="form-control" name="fname" placeholder="Enter First Name" value="<?php if(isset($user['fname'])){ echo $user['fname'];} ?>">
                                </div>
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input class="form-control" name="lname" placeholder="Enter Last Name" value="<?php if(isset($user['lname'])){ echo $user['lname'];} ?>">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control" name="password" type="password" placeholder="Enter User Password">
                                </div>
                                <div class="form-group">
                                    <label>User Role</label>
                                    <select class="form-control" name="role">
                                      
                                        <option value="subscriber" <?php if($user['role'] == 'subscriber'){ echo "selected"; } ?>>Subscriber</option>
                                        <option value="editor" <?php if($user['role'] == 'editor'){ echo "selected"; } ?>>Editor</option>
                                        <option value="administrator" <?php if($user['role'] == 'administrator'){ echo "selected"; } ?>>Administrator</option>
                                    </select>
                                </div>

                                <input type="submit" class="btn btn-success" value="Submit" />
                            </form>


      </fiedset>

   </div>


   
    </main>

    <?php include ('inc/footer.php'); ?>
