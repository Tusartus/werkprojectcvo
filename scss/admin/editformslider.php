


<!-- new page -->
<?php 
session_start();

include('inc/check-login.php');

require_once('../includes/connect.php');
include ('inc/header.php'); 
include ('inc/navbar.php'); 


?>

<?php


 
 if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
 {
  $id = $_GET['edit_id'];
  $stmt_edit = $db->prepare('SELECT userName, userProfession, userPic FROM tbl_users WHERE userID =:uid');
  $stmt_edit->execute(array(':uid'=>$id));
  $edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
  extract($edit_row);
 }
 else
 {
  header("Location: index.php");
 }
 
 if(isset($_POST['btn_save_updates']))
 {
  $username = $_POST['user_name'];// user name
  $userjob = $_POST['user_job'];// user email
   
  $imgFile = $_FILES['user_image']['name'];
  $tmp_dir = $_FILES['user_image']['tmp_name'];
  $imgSize = $_FILES['user_image']['size'];
     
  if($imgFile)
  {
   $upload_dir = '../user_images/'; // upload directory 
   $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
   $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
   $userpic = rand(1000,1000000).".".$imgExt;
        if(in_array($imgExt, $valid_extensions)) {  

              if($imgSize < 5000000){
              unlink($upload_dir.$edit_row['userPic']);
              move_uploaded_file($tmp_dir,$upload_dir.$userpic);
              }else{
             $errMSG = "Sorry, your file is too large it should be less then 5MB";
              }
        }else{
        $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";  
         } 
  }else{
   // if no image selected the old image remain as it is.
   $userpic = $edit_row['userPic']; // old image from database
  } 
      
  
  // if no error occured, continue ....
  if(!isset($errMSG))
  {
   $stmt = $db->prepare('UPDATE tbl_users 
              SET userName=:uname, 
               userProfession=:ujob, 
               userPic=:upic 
               WHERE userID=:uid');
   $stmt->bindParam(':uname',$username);
   $stmt->bindParam(':ujob',$userjob);
   $stmt->bindParam(':upic',$userpic);
   $stmt->bindParam(':uid',$id);
    
   if($stmt->execute()){
    ?>
                <script>
    alert('Successfully Updated ...');
    window.location.href='view-sliders.php';
    </script>
                <?php
   }
   else{
    $errMSG = "Sorry Data Could Not Updated !";
   }
  }    
 }

?>
<?php




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
   <?php  if(isset($fmsg)){ ?>
                        <div class="alert alert-danger alert-dismissible m-3">
                         <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?php  echo $fmsg;  ?>
                        </div>

                    <?php }  ?>
                    
                    <?php  if(isset($errMSG)){ ?>
                        <div class="alert alert-success alert-dismissible m-3">
                         <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?php  echo $errMSG;  ?>
                        </div>

                    <?php }  ?>
   
   </div>
      
      <fiedset class="cllaa p-2">
      <form method="post" enctype="multipart/form-data" class="form-horizontal"> 

      <table class="table table-bordered table-responsive mt-5">

   <tr>
    <td><label class="control-label">Title:</label></td>
       <td><input class="form-control" type="text" name="user_name"  /></td>
   </tr>
   
   <tr>
    <td><label class="control-label">description:</label></td>
       <td><textarea class="form-control" type="text" name="user_job" rows="5">  </textarea></td>
   </tr>
   
   <tr>
    <td><label class="control-label">content Img:</label></td>
       <td><input class="input-group" type="file" name="user_image" accept="image/*" /></td>
   </tr>
   
   <tr>
       <td colspan="2"><button type="submit" name="btn_save_updates" class="btn btn-info w-100">
       <span class="glyphicon glyphicon-save"></span> &nbsp; save
       </button>
       </td>
   </tr>
   
        </table>
        </form>

      </fiedset>

   </div>


   
    </main>

    <?php include ('inc/footer.php'); ?>


    