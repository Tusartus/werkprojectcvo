<?php 

session_start();

require_once('../includes/connect.php');
include('inc/check-login.php');


if(isset($_GET['id']) && !empty($_GET['id']))
{
 $id = $_GET['id'];
 $stmt_edit = $db->prepare('SELECT title, content, slug, pic FROM posts WHERE id = :id');
 $stmt_edit->execute(array(':id'=>$id));
 $edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
 extract($edit_row);
}
else
{
 header("Location: view-article.php");
}


if(isset($_POST) & !empty($_POST)){
    // PHP Form Validations
    if(empty($_POST['title'])){$errors[] = "Title Field is Required";}
    if(empty($_POST['content'])){$errors[] = "Content Field is Required";}
    if(empty($_POST['categories'])){$errors[] = "Categories Field is Required";}
    //if(empty($_FILES['pic']['name'])){$errors[] = "You Should Upload a File";}
    if(empty($_POST['slug'])){$slug = trim($_POST['title']); }else{$slug = trim($_POST['slug']);}
    // check slug is unique with db query
    $search = array(" ", ",", ".", "_");
    $slug = strtolower(str_replace($search, '-', $slug));
    $sql = "SELECT * FROM posts WHERE slug=:slug AND id <> :id";
    $result = $db->prepare($sql) or die(print_r($result->errorInfo(), true));
    $values = array(':slug'     => $_POST['slug'],
                    ':id'       => $_POST['id']
                    );
    $result->execute($values);
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
        // TODO : Only user with Administrator privillages or user who created the article can only edit 
        if(isset($_FILES) & !empty($_FILES)){

            $imgFile = $_FILES['pic']['name'];
            $tmp_dir = $_FILES['pic']['tmp_name'];
            $imgSize = $_FILES['pic']['size'];
               
            if($imgFile)
            {
             $upload_dir ='../media-posts/'; // upload directory 
             $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
             $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
             $userpic = rand(1000,1000000).".".$imgExt;
                  if(in_array($imgExt, $valid_extensions)) {  
          
                        if($imgSize < 5000000){
                        unlink($upload_dir.$edit_row['pic']);
                        move_uploaded_file($tmp_dir,$upload_dir.$userpic);
                        }else{
                       $errMSG = "Sorry, your file is too large it should be less then 5MB";
                        }
                  }else{
                  $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";  
                   } 
            }else{
             // if no image selected the old image remain as it is.
             $userpic = $edit_row['pic']; // old image from database
            } 

            
            




        }

        $sql = "UPDATE posts SET title=:title, content=:content,  slug=:slug, ";
        if(isset($userpic) & !empty($userpic)){ $sql .="pic=:pic, "; }  
        $sql .= "updated=NOW() WHERE id=:id";
        //echo $sql;
        $result = $db->prepare($sql);
        $values = array(':title'    => $_POST['title'],
                        ':content'  => $_POST['content'],
                        
                        ':slug'     => $_POST['slug'],
                        ':id'       => $_POST['id'],
                        );
        if(isset($userpic) & !empty($userpic)){ $values[':pic'] = $userpic;}
        $res = $result->execute($values) or die(print_r($result->errorInfo(), true));
        if($res){
            // TODO : removing non selected categories from post_categories table
            $pid = $_POST['id'];
            //$pid = $db->lastInsertID();

            foreach ($_POST['categories'] as $category) {
                $catsql = "DELETE FROM post_categories WHERE pid=:pid AND cid=:cid";
                $catresult = $db->prepare($catsql);
                $values = array(':pid'      => $pid,
                                ':cid'      => $category
                                );

                $catresult->execute($values);
                
                $catcount = $catresult->rowCount();
                if($catcount == 1){}else{
                    $sql = "INSERT INTO post_categories (pid, cid) VALUES (:pid, :cid)";
                    $result = $db->prepare($sql);
                    $values = array(':pid'  => $pid,
                                    ':cid'  => $category
                                    );
                    $res = $result->execute($values) or die(print_r($result->errorInfo(), true));
                }
            }
            header("location: view-articles.php");
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
 
$sql = "SELECT * FROM posts WHERE id=?";
$result = $db->prepare($sql);
$result->execute(array($_GET['id']));
$post = $result->fetch(PDO::FETCH_ASSOC); 

?>




    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"> Articles</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
       
      
        </div>
      </div>

   <div class="col-sm-10">
   <h2>     Edit article</h2>

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
                                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                                <div class="form-group">
                                    <label>Article Title</label>
                                    <input class="form-control" name="title" placeholder="Enter Article Title" value="<?php if(isset($post['title'])){ echo $post['title'];} ?>">
                                </div>
                                <div class="form-group">
                                    <label>Article Content</label>
                                    <textarea class="form-control" name="content" rows="3"><?php if(isset($post['content'])){ echo $post['content'];} ?></textarea>
                                </div>
                                <div class="form-group">
                                     <label>Featured Image</label>
                                    <input type="file" name="pic">

                                    <?php
                                        if(isset($post['pic']) & !empty($post['pic'])){
                                            echo "<img src='../media-posts/".$post['pic']."' height='50px' width='100px'>";
                                            echo "<a href='delete-pic.php?id=". $_GET['id'] ."&type=post'>Delete Pic</a>";
                                        }else{
                                    ?>
                                   
                                    <?php } ?>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <?php 
                                                // TODO : Select Existing Categories from Database Values
                                            $sql = "SELECT * FROM categories";
                                            $result = $db->prepare($sql);
                                            $result->execute();
                                            $res = $result->fetchAll(PDO::FETCH_ASSOC);

                                            $catsql = "SELECT * FROM post_categories WHERE pid=?";
                                            $catresult = $db->prepare($catsql);
                                            $catresult->execute(array($_GET['id']));
                                            $categories = $catresult->fetchAll(PDO::FETCH_ASSOC);
                                            ?>
                                            <label>Categories</label>
                                            <select multiple="" name="categories[]" class="form-control">
                                            <?php
                                                foreach ($res as $cat) {
                                                    if(in_array($cat['id'], array_column($categories, 'cid'))){$selected = "selected"; }else{ $selected = ""; }
                                                    echo "<option value='".$cat['id']."'". $selected .">".$cat['title']."</option>";
                                                }
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                

                                </div>
                                <div class="form-group">
                                    
                                    <input type="hidden" class="form-control" name="slug"  value="<?php if(isset($post['slug'])){ echo $post['slug'];} ?>">
                                </div>
                                <input type="submit" class="btn btn-success" value="Submit" />
                            </form>


      </fiedset>

   </div>


   
    </main>


    <?php include ('inc/footer.php'); ?>



    