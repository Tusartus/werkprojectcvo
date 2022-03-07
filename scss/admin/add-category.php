<?php
session_start();
include('inc/check-login.php');

require_once('../includes/connect.php');


/*include('includes/check-subscriber.php'); */
if(isset($_POST) & !empty($_POST)){
    // PHP Form Validations
    if(empty($_POST['title'])){$errors[] = "Title Field is Required";}
    //if(empty($_FILES['pic']['name'])){$errors[] = "You Should Upload a File";}
    if(empty($_POST['slug'])){$slug = trim($_POST['title']); } //else{$slug = trim($_POST['slug']);}
    // check slug is unique with db query
    $search = array(" ", ",", ".", "_");
    $slug = strtolower(str_replace($search, '-', $slug));
    $sql = "SELECT * FROM categories WHERE slug=?";
    $result = $db->prepare($sql);
    $result->execute(array($slug));
    $count = $result->rowCount();
    if($count == 1){
        $errors[] = "Slug already exists in database";
    }
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
        $sql = "INSERT INTO categories (title, description, slug) VALUES (:title, :description, :slug)";
        $result = $db->prepare($sql);
        $values = array(':title'            => $_POST['title'],
                        ':description'      => $_POST['description'],
                        ':slug'             => $slug
                        );
        $res = $result->execute($values);
        if($res){
            header('location:view-categories.php');
        }else{
            $errors[] = "Failed to Add Category";
        }
    }
}
// Create CSRF token
$token = md5(uniqid(rand(), TRUE));
$_SESSION['csrf_token'] = $token;
$_SESSION['csrf_token_time'] = time();




include ('inc/header.php'); 
include ('inc/navbar.php'); 

?>




    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"> </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
       
     
        </div>
      </div>

   <div class="col-sm-8">
   <h2>Section title</h2>

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
                                    <label>Category Title</label>
                                    <input class="form-control" name="title" placeholder="Enter Article Title" value="<?php if(isset($_POST['title'])){ echo $_POST['title'];} ?>">
                                </div>
                                <div class="form-group">
                                    <label>Category Description</label>
                                    <textarea class="form-control" name="description" cols="58" rows="5"> </textarea>
                                </div>
                                <div class="form-group">
                                    <input  type="hidden" class="form-control" name="slug" placeholder="Enter Category Slug Here" value="<?php if(isset($_POST['slug'])){ echo $_POST['slug'];} ?>">
                                </div>

                                <input type="submit" class="btn btn-success" value="Submit" />
                            </form>


      </fiedset>

   </div>


   
    </main>

    <?php include ('inc/footer.php'); ?>

    