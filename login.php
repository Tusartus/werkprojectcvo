

<?php 
session_start();
require_once('includes/connect.php');

// If LoggedIn Redirect to checkout page
//include('admin/includes/if-loggedin.php'); 



if(isset($_POST) & !empty($_POST)){

	// ***********
	if($_POST['submit'] == 'Login'){
		// PHP Form Validations
	    if(empty($_POST['username'])){ $errors[]="User Name / E-Mail field is Required"; }
	    if(empty($_POST['password'])){ $errors[]="Password field is Required"; }

	
	    if(empty($errors)){
	        // Check the Login Credentials
	        $sql = "SELECT * FROM users WHERE ";
	        if(filter_var($_POST['username'], FILTER_VALIDATE_EMAIL)){
	            $sql .= "email=?";
	        }else{
	            $sql .= "username=?";
	        }
	        $sql .= " AND role='customer'";
	        $result = $db->prepare($sql);
	        $result->execute(array($_POST['username']));
	        $count = $result->rowCount();
	        $res = $result->fetch(PDO::FETCH_ASSOC);
	        if($count == 1){
	            // Compare the password with password hash
	            if(password_verify($_POST['password'], $res['password'])){
	                // regenerate session id
	                session_regenerate_id();
	                $_SESSION['login'] = true;
	                $_SESSION['id'] = $res['id'];
	                $_SESSION['last_login'] = time();
	                // redirect the user to checkout page
	                header("location: checkoutnostripe.php");
	            }else{
	                $messages[] = "User Name / E-Mail & Password Combination not Working";
	            }
	        }else{
	            $messages[] = "User Name / E-Mail not Valid";
	        }
	    }
	}


}





?>

      
      
<?php  

include "frontend/shop-header.php";

include "frontend/shop-navmenu.php";


?>


<section class="container">
    <div class="row">
        
        <div class="col-md-12">
            <h2 class="d-flex justify-content-center">login </h2>
        </div>

        <div class="col-md-12 error">
            <!-- display error from php -->
            <div class="p-2 m-2"></div>
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
                            echo "<a class='btn btn-info' href='login.php'>login again</a>";
                            echo "</div>";
                            
                        }
                    ?>
        </div>

        <fieldset class="col-lg-12 col-md-12 col-sm-12 p-3">
            <form class="logregform" method="post">

                <div class="form-group">
                    <label for="email">Email or username :</label>
                    <input type="text" class="form-control w-75" id="username" placeholder="Enter  email.." name="username" value="<?php if(isset($_POST['username'])){ echo $_POST['username']; } ?>">
                  </div>
                  <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control w-75" id="pwd" placeholder="Enter password" name="password" >
                  </div>
                
                  <button type="submit" name="submit" class="btn btn-primary" value="Login">Submit</button>
				

           
               
              
            </form>
        </fieldset>


    </div>
</section>

<div class="mb-5" style="margin:25rem 0;"></div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>