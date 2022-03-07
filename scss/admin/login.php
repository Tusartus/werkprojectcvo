<?php 
session_start();

include ('./inc/header.php');
require_once('../includes/connect.php');


if(isset($_POST) & !empty($_POST)){
    /*print_r($_POST); */
    if(empty($_POST['email'])){ $errors[] = 'User Name / E-mail field is Required';}
    if(empty($_POST['password'])){ $errors[] = 'Password field is Required';}
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
        // select sql query to check the email id in database
        // updating the sql query to work with email and username with filter_var
        $sql = "SELECT * FROM users WHERE ";
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $sql .= "email=?";
        }else{
            $sql .= "username=?";
        }
        $result = $db->prepare($sql);
        $result->execute(array($_POST['email']));
        $count = $result->rowCount();
        $res = $result->fetch(PDO::FETCH_ASSOC);
        if($count == 1){
            // then comparing the password with password hash
            if(password_verify($_POST['password'], $res['password'])){
                // regenerate session id
                session_regenerate_id();
                $_SESSION['login'] = true;
                $_SESSION['id'] = $res['id'];
                $_SESSION['last_login'] = time();
                // redirect the user to members area/dashboard page
                header('location:index.php');
            }else{
                $errors[] = "User Name / E-Mail & Password Combination not Working";
            }
        }else{
            $errors[] = "User Name / E-Mail Not Valid";
        }
    }
}
// Create CSRF token
$token = md5(uniqid(rand(), TRUE));
$_SESSION['csrf_token'] = $token;
$_SESSION['csrf_token_time'] = time();

?>



  <div class="container">
   <div class="row">
   
    
   <main role="main" class="col-md-11 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"> </h1>
        <div class="btn-toolbar mb-2 mb-md-0">


       
      
        </div>
      </div>

   <div class="col-sm-6">
   <h2>Please Sign In</h2>
   <center class="mt-5 mb-4">
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
                            echo "<div class='alert alert-danger'>";
                            foreach ($errors as $error) {
                                echo "<span class='glyphicon glyphicon-remove'></span>&nbsp;". $error ."<br>";
                            }
                            echo "</div>";
                        }
                    ?>
   </center>
      
   <form  method="post">
   <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">

  <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" class="form-control" name="email" placeholder="Enter email or Username" id="email">
  </div>

  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" name="password" placeholder="Enter password" id="pwd">
  </div>

 
  <button type="submit" class="btn btn-primary">Submit</button>
    </form>

  
    <span class="mt-5"> Are you Admin and don't have  an account  
                    <a class="text-success mt-5" href="register.php">   Register here </a>  </span> <br>

                      
    <span class="mt-5"> 
 <a class="text-warning mt-5" href="../forgetPassword.php">  Forget password </a>  </span>
   </div>


   
    </main>
   
  
 

    <?php include ('inc/footer.php'); ?>