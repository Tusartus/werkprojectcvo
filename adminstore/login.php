
<?php 
session_start();
require_once('../includes/connect.php');

// If LoggedIn Redirect to checkout page
//include('admin/includes/if-loggedin.php'); 



if(isset($_POST) & !empty($_POST)){

	// ***********
	if($_POST['submit'] == 'Login'){
		// PHP Form Validations
	    if(empty($_POST['username'])){ $logerrors[]="User Name / E-Mail field is Required"; }
	    if(empty($_POST['password'])){ $logerrors[]="Password field is Required"; }

	
	    if(empty($errors)){
	        // Check the Login Credentials
	        $sql = "SELECT * FROM users WHERE ";
	        if(filter_var($_POST['username'], FILTER_VALIDATE_EMAIL)){
	            $sql .= "email=?";
	        }else{
	            $sql .= "username=?";
	        }
	        $sql .= " AND role='admin'";
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
					header('location: index.php');
					
	            }else{
	                $errors[] = "User Name / E-Mail & Password Combination not Working";
	            }
	        }else{
	            $errors[] = "User Name / E-Mail not Valid";
	        }
	    }
	}


}

	
	

	   
	
	





include('inc/header.php');
include('inc/navbar.php') 



?>

<div class="mb-5" style="margin:5rem 0;"></div>
<!-- SHOP CONTENT -->
<section id="content-section" class="col-md-7 col-sm-8 p-3">
	<div class="content-blog">
		<div class="container">
			<div class="row">
				<div class="page_header text-center col-md-7 col-sm-7">
					
					<p>Login to Your Account</p>
					<hr>

				</div>
				

				<div class="col-md-6 col-sm-6">
			<div class="shop-login m-3">
			<div class="co m-3 p-3">
				<div class="box-content">
					
					<div class="clearfix space40"></div>
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

					<form class="logregform" method="post">
				

						<div class="row">
							<div class="form-group">
								<div class="col-md-12">
									<label>Username or E-mail Address</label>
									<input type="text" name="username" class="form-control" value="<?php if(isset($_POST['username'])){ echo $_POST['username']; } ?>">
								</div>
							</div>
						</div>
						<div class="clearfix space20"></div>
						<div class="row">

							<div class="form-group">
								<div class="col-md-12">
								    <!--
									<a class="pull-right" href="#">(Lost Password?)</a>
									-->


									<label>Password</label>
									<input type="password" name="password" value="" class="form-control">
								</div>
							</div>
						</div>
						<div class="clearfix space20"></div>
						<div class="row">

						

							<div class="form-group">
								<input type="submit" name="submit" class="button btn-md pull-right" value="Login" />
							</div>

						</div>
					</form>

				</div>
			</div>
			</div>


			
			</div>
		


						
			
			</div>
		</div>
	</div>
</section>


</div>
</div>

<div class="mb-5" style="margin:15rem 0;"></div>
<?php include('inc/footer.php'); ?>


