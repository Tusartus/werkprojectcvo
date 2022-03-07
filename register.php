
<?php  


session_start();



require_once('./includes/connect.php');


if(isset($_POST) & !empty($_POST)){
    // PHP Form Validations
    if(empty($_POST['username'])){ $errors[]="User Name field is Required"; }else{
        // Check Username is Unique with DB query
        $sql = "SELECT * FROM users WHERE username=?";
        $result = $db->prepare($sql);
        $result->execute(array($_POST['username']));
        $count = $result->rowCount();
        if($count == 1){
            $errors[] = "Username already exists in database";
        }
    }
    if(empty($_POST['email'])){ $errors[]="E-mail field is Required"; }else{
        // Check Email is Unique with DB Query
        $sql = "SELECT * FROM users WHERE email=?";
        $result = $db->prepare($sql);
        $result->execute(array($_POST['email']));
        $count = $result->rowCount();
        if($count == 1){
            $errors[] = "E-Mail already exists in database";
        }
    }
   

    if(empty($_POST['mobile'])){ $errors[]="Mobile field is Required"; }else{
        // Check Username is Unique with DB query
        $sql = "SELECT * FROM users WHERE mobile=?";
        $result = $db->prepare($sql);
        $result->execute(array($_POST['mobile']));
        $count = $result->rowCount();
        if($count == 1){
            $errors[] = "Mobile already exists in database";
        }
    }
  
    if(empty($_POST['password'])){ $errors[]="Password field is Required"; }else{
        // check the repeat password
        if(empty($_POST['passwordr'])){ $errors[]="Repeat Password field is Required"; }else{
            // compare both passwords, if they match. Generate the Password Hash
            if($_POST['password'] == $_POST['passwordr']){
                // create password hash
                $pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            }else{
                // Display Error Message
                $errors[] = "Both Passwords Should Match";
            }
        }
    }

   

    // If no Errors, Insert the Values into users table
    if(empty($errors)){
        $sql = "INSERT INTO users ( username, email, mobile,  password, role ) VALUES ( :username, :email, :mobile, :password, 'customer')";
        $result = $db->prepare($sql);
        $values = array(':username'     => $_POST['username'],
                        ':email'        => $_POST['email'],
                        ':mobile'         => $_POST['mobile'],
                        ':password'     => $pass_hash
                        );
        $res = $result->execute($values);
        if($res){
            $messages[] = "User Registered";
             // redirect the user to members area/dashboard page
             header('location:login.php');
       

        }
    }
}



include "frontend/shop-header.php";

include "frontend/shop-navmenu.php";


?>




      <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-offset-3 mt-5">
                <div class="login-panel panel panel-default mt-5">
                    <div class="panel-heading mt-5">
                        <h3 class="panel-title">Please Register</h3>
                    </div>
                    <div class="panel-body">
                    <?php
                        if(!empty($errors)){
                            echo "
                            
                            <div class='alert alert-danger alert-dismissible'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                            ";
                            foreach ($errors as $error) {
                                echo "<span class='glyphicon glyphicon-remove'></span>&nbsp;".$error."<br>";
                            }
                            echo "</div>";
                        }
                    ?>
                    <?php
                        if(!empty($messages)){
                            echo "
                            <div class='alert alert-success alert-dismissible'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                                   
                            ";
                            foreach ($messages as $message) {
                                echo "<span class='glyphicon glyphicon-ok'></span>&nbsp;".$message."<br>";
                            }
                            echo "</div>";
                        }
                    ?>
                            
                        
                            <hr>
                        <div class="col-sm-12">
    
                      
                        <form role="form" method="post">
                          
     
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="User Name" name="username" type="text" value="<?php if(isset($_POST['username'])){ echo $_POST['username']; } ?>">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" value="<?php if(isset($_POST['email'])){ echo $_POST['email']; } ?>">
                                </div>
    
                                <div class="form-group">
                                    <input class="form-control" placeholder="phone number + code country" name="mobile" type="text" value="<?php if(isset($_POST['mobile'])){ echo $_POST['mobile']; } ?>" >
                                </div>
                             
    
    
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" >
                                </div>
    
                                <div class="form-group">
                                    <input class="form-control" placeholder="Repeat Password" name="passwordr" type="password">
                                </div>
    
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Register" />
                            </fieldset>
    
                        </form>
                        </div>
                        <span class="mt-5"> Already have  an account  
                        <a class="text-success mt-5" href="login.php">Login here </a>  </span>
    
    
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="mb-5" style="margin:25rem 0;"></div>



    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>