<?php 
include('inc/check-login.php');

//require_once('../includes/connect.php');

//include('includes/check-admin.php');
//check-subscriber.php is not required while check-admin in loaded
//include('includes/check-subscriber.php');
if(isset($_POST) & !empty($_POST)){
    // PHP Form Validations
    if(empty($_POST['username'])){ $errors[] = 'User Name field is Required';}else{
        // check username is unique with db query
        $sql = "SELECT * FROM users WHERE username=?";
        $result = $db->prepare($sql);
        $result->execute(array($_POST['username']));
        $count = $result->rowCount();
        if($count == 1){
            $errors[] = "User Name already exists in database";
        }
    }
    if(empty($_POST['email'])){ $errors[] = 'E-mail field is Required';}else{
        // check email is unique with db query
        $sql = "SELECT * FROM users WHERE email=?";
        $result = $db->prepare($sql);
        $result->execute(array($_POST['email']));
        $count = $result->rowCount();
        if($count == 1){
            $errors[] = "E-mail already exists in database";
        }
    }
    if(empty($_POST['fname'])){ $errors[] = 'First Name field is Required';}
    if(empty($_POST['password'])){ $errors[] = 'Password field is Required';}else{$pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);}
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
        $sql = "INSERT INTO users (fname, lname, username, email, password, role) VALUES (:fname, :lname, :username, :email, :password, :role)";
        $result = $db->prepare($sql);
        $values = array(':fname'     => $_POST['fname'],
                        ':lname'        => $_POST['lname'],
                        ':username'     => $_POST['username'],
                        ':email'        => $_POST['email'],
                        ':password'     => $pass_hash,
                        ':role'     => $_POST['role']
                        );
        $res = $result->execute($values);
        if($res){
            // redirect user to view-users.php page
            header("location: view-users.php");
        }else{
            $errors[] = "Failed to Add users";
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

?>




    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"> Users</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
       
     
        </div>
      </div>

   <div class="col-sm-8">
   <h2> Add new user</h2>

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
                                <div class="form-group">
                                    <label>User Name</label>
                                    <input class="form-control" name="username" placeholder="Enter User Name" value="<?php if(isset($_POST['username'])){ echo $_POST['username'];} ?>">
                                </div>
                                <div class="form-group">
                                    <label>E-Mail</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter E-Mail" value="<?php if(isset($_POST['email'])){ echo $_POST['email'];} ?>">
                                </div>
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input class="form-control" name="fname" placeholder="Enter First Name" value="<?php if(isset($_POST['fname'])){ echo $_POST['fname'];} ?>">
                                </div>
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input class="form-control" name="lname" placeholder="Enter Last Name" value="<?php if(isset($_POST['lname'])){ echo $_POST['lname'];} ?>">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control" name="password" type="password" placeholder="Enter User Password">
                                </div>
                                <div class="form-group">
                                    <label>User Role</label>
                                    <select class="form-control" name="role">
                                        <option>Select User Role</option>
                                        <option>Subscriber</option>
                                        <option>Editor</option>
                                        <option>Administrator</option>
                                    </select>
                                </div>

                                <input type="submit" class="btn btn-success" value="Submit" />
                            </form>


      </fiedset>

   </div>


   
    </main>

    <?php include ('inc/footer.php'); ?>
