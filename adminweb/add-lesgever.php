<?php
session_start();

include('../includes/connect.php');

include('inc/header.php');
include('inc/navbar.php');

//protect index page only for login as admin role in users databank
require_once("config/if-loggin.php");





if(isset($_POST) & !empty($_POST)){

    //variable name 
    $title = $_POST['title'];
    $description = strip_tags($_POST['description']);
    

  // PHP Form Validations
  if(empty($_POST['title'])){$errors[] = "Tilte Field is Required";}
  if(empty($_POST['description'])){$errors[] = "Content Field is Required";}
 
  
 
  $imgFile = $_FILES['pic']['name'];
  $tmp_dir = $_FILES['pic']['tmp_name'];
  $imgSize = $_FILES['pic']['size'];

   if(empty($imgFile)){
    $errors[] = "Please Select Image File.";
   }else{

  

   $upload_dir = '../media-lesgever/'; // upload directory
 
   $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
   
   //valid image extensions
   $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions

   // rename uploading image
    $propic = rand(1000,1000000).".".$imgExt;

             // allow valid image file formats
        if(in_array($imgExt, $valid_extensions)){   
             // Check file size '5MB'
               // Check file size '5MB'
               if($imgSize < 5000000) {
                move_uploaded_file($tmp_dir,$upload_dir.$propic);
               }
               else{
                $errors[] = "Sorry, your file is too large.";
               }
        }
       else{
        $errors[] = "Sorry, only JPG, JPEG, PNG  files are allowed.";  
        }
     }


  if(empty($errors)){
   
    $stmt = $db->prepare('INSERT INTO lesgevers (title,  description,pic  )  VALUES (:title,  :description, :pic )');
      
    $stmt->bindParam(':title', $title);      
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':pic', $propic);
    



                    if($stmt->execute())
                    {
                        $messages = "it has been succesfully added";
                        
                        
                    }
                    else
                    {
                        $errMSG = "An error occured while inserting....";
                    }







  }//empty errors msg


}






?>




<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
            <a class="text-info p-2" href="view-lesgever.php"> view </a>


        </h1>
<?php
        if(isset($messages)){

        echo'   <div class="alert alert-success alert-dismissible">';
          echo '  <button type="button" class="close" data-dismiss="alert">&times;</button>';
          echo "<p>  <strong>" . $messages ."</strong></p>";
         echo "</div>";



}
?>
        <div class="btn-toolbar mb-2 mb-md-0">
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
    </div>

    <div class="col-sm-8">

        <h2> add info</h2>
        <hr>

        <?php

if(isset($errMSG)){

    echo "<p class='alert alert-info' >" . $errMSG ."</p>";

}
        ?>

        <fiedset class="claa p-2">
            <form role="form" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label> title : </label>
                    <input class="form-control" name="title" placeholder="Enter  Title .." >
                </div>
                <div class="form-group">
                    <label> Content</label>
                    <textarea style="overflow-y: scroll; height: 200px;" id="content"  class="form-control" name="description" rows="9" cols="48"></textarea>
                </div>
                <div class="form-group">
                    <label>Featured Image</label>
                    <input type="file" name="pic">
                </div>
              
                <input type="submit" class="btn btn-success" value="Submit" />
            </form>


        </fiedset>


    </div>








</main>

<?php include('inc/footer.php'); ?>