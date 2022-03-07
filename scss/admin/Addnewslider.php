

<!-- new page -->
<?php 
 session_start();
include('inc/check-login.php');

require_once('../includes/connect.php');
include ('inc/header.php'); 
include ('inc/navbar.php'); 


?>


<?php


 
 if(isset($_POST['btnsave']))
 {
  $username = $_POST['user_name'];// user name
  $userjob = $_POST['user_job'];// user email
  
  $imgFile = $_FILES['user_image']['name'];
  $tmp_dir = $_FILES['user_image']['tmp_name'];
  $imgSize = $_FILES['user_image']['size'];
  
  
        if(empty($username)){
           $errMSG = "Please Enter Username.";
           }
            else if(empty($userjob)){
            $errMSG = "Please Enter Your Job Work.";
            }
            else if(empty($imgFile)){
            $errMSG = "Please Select Image File.";
        }else
        {
          $upload_dir = '../user_images/'; // upload directory
 
           $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
  
           // valid image extensions
           $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
  
           // rename uploading image
            $userpic = rand(1000,1000000).".".$imgExt;
    
                     // allow valid image file formats
                     if(in_array($imgExt, $valid_extensions)){   
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
  
  
        // if no error occured, continue ....
        if(!isset($errMSG))
        {
           $stmt = $db->prepare('INSERT INTO tbl_users(userName,userProfession,userPic) VALUES(:uname, :ujob, :upic)');
           $stmt->bindParam(':uname',$username);
           $stmt->bindParam(':ujob',$userjob);
           $stmt->bindParam(':upic',$userpic);
   
                   if($stmt->execute()) {
                   $fmsg = "new record succesfully inserted ...";
                     //header("Addnewslider.php"); // redirects image view page after 2 seconds.
                    }
                     else {
                       $errMSG = "error while inserting....";
                    }
        }
 }
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
                        <div class="alert alert-success alert-dismissible m-3">
                         <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?php  echo $fmsg;  ?>
                        </div>

                    <?php }  ?>
                    
                    <?php  if(isset($errMSG)){ ?>
                        <div class="alert alert-danger alert-dismissible m-3">
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
       <td><input class="form-control" type="text" name="user_name" placeholder="Enter title" /></td>
   </tr>
   
   <tr>
    <td><label class="control-label">description:</label></td>
       <td><textarea class="form-control" type="text" name="user_job" rows="5" placeholder="Enter description"> </textarea></td>
   </tr>
   
   <tr>
    <td><label class="control-label">content Img:</label></td>
       <td><input class="input-group" type="file" name="user_image" accept="image/*" /></td>
   </tr>
   
   <tr>
       <td colspan="2"><button type="submit" name="btnsave" class="btn btn-info w-100">
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
