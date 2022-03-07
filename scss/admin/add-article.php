<?php 

session_start();

require_once('../includes/connect.php');

include('inc/check-login.php');


if(isset($_POST) & !empty($_POST)){
  // PHP Form Validations
  if(empty($_POST['title'])){$errors[] = "Title Field is Required";}
  if(empty($_POST['content'])){$errors[] = "Content Field is Required";}
  if(empty($_POST['categories'])){$errors[] = "Categories Field is Required";}
  if(empty($_POST['slug'])){$slug = trim($_POST['title']); //}else{$slug = trim($_POST['slug']);}
  //if(empty($_FILES['pic']['name'])){$errors[] = "You Should Upload a File";}
  $imgFile = $_FILES['pic']['name'];
  $tmp_dir = $_FILES['pic']['tmp_name'];
  $imgSize = $_FILES['pic']['size'];

   if(empty($imgFile)){
    $errors[] = "Please Select Image File.";
   }else{

  

   $upload_dir = '../media-posts/'; // upload directory
 
   $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
   
   //valid image extensions
   $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions

   // rename uploading image
    $userpic = rand(1000,1000000).".".$imgExt;

             // allow valid image file formats
             if(in_array($imgExt, $valid_extensions)){   
             // Check file size '5MB'
               // Check file size '5MB'
               if($imgSize < 5000000) {
                move_uploaded_file($tmp_dir,$upload_dir.$userpic);
               }
               else{
                 $errMSG = "Sorry, your file is too large.";
               }
    }
    else{
    $errMSG = "Sorry, only JPG, JPEG, PNG  files are allowed.";  
    }
}



  // check slug is unique with db query
  $search = array(" ", ",", ".", "_");
  $slug = strtolower(str_replace($search, '-', $slug));
  $sql = "SELECT * FROM posts WHERE slug=?";
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
           

            

      $sql = "INSERT INTO posts ( /*uid,*/ title, content, slug, pic) VALUES (/*:uid,*/ :title, :content,  :slug, :pic)";
      $result = $db->prepare($sql);
      $values = array( //':uid'      => $_SESSION['id'],
                      ':title'    => strip_tags($_POST['title']),
                      ':content'  => strip_tags($_POST['content']),
                      //':status'   => $_POST['status'],
                      ':slug'     => $slug,
                      ':pic'      => $userpic
                      );

      $res = $result->execute($values) or die(print_r($result->errorInfo(), true));
      if($res){
          // After inserting the article, insert category id and article id into post_categories table
          $pid = $db->lastInsertID();
          foreach ($_POST['categories'] as $category) {
          $sql = "INSERT INTO post_categories (pid, cid) VALUES (:pid, :cid)";
          $result = $db->prepare($sql);
          $values = array(':pid'  => $pid,
                          ':cid'  => $category
                         );

          $res = $result->execute($values) or die(print_r($result->errorInfo(), true));
          }
          header("location: view-articles.php");
           }else{
          $errors[] = "Failed to Add Article";
         }
      }
   }//if empty erros[]
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
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
       
      
        </div>
      </div>

   <div class="col-sm-10">
   <h2>add new article</h2>

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
                              <form role="form" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
                                <div class="form-group">
                                    <label>Article Title</label>
                                    <input class="form-control" name="title" placeholder="Enter Article Title" value="<?php if(isset($_POST['title'])){ echo $_POST['title'];} ?>">
                                </div>
                                <div class="form-group">
                                    <label>Article Content</label>
                                    <textarea class="form-control" name="content" rows="9" cols="55"><?php if(isset($_POST['content'])){ echo $_POST['content'];} ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Featured Image</label>
                                    <input type="file" name="pic">
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <?php 
                                            // Fetch categories from categories table
                                            $sql = "SELECT * FROM categories";
                                            $result = $db->prepare($sql);
                                            $result->execute();
                                            $res = $result->fetchAll(PDO::FETCH_ASSOC);
                                            ?>
                                            <label>Categories</label>
                                            <select multiple="" name="categories[]" class="form-control">
                                                <?php
                                                    foreach ($res as $cat) {
                                                        if(in_array($cat['id'], $_POST['categories'])){ $checked = "selected"; }else{ $checked = ""; }
                                                        echo "<option value='".$cat['id']."'".$checked .">".$cat['title']."</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                  
                                </div>
                                <div class="form-group">
                                   
                                    <input type="hidden" class="form-control" name="slug"  value="<?php if(isset($_POST['slug'])){ echo $_POST['slug'];} ?>">
                                </div>
                                <input type="submit" class="btn btn-success" value="Submit" />
                            </form>


      </fiedset>

   </div>


   
    </main>


    <?php include ('inc/footer.php'); ?>



    