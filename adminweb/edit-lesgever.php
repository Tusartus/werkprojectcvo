<?php
session_start();

include('../includes/connect.php');

include('inc/header.php');
include('inc/navbar.php');

//protect index page only for login as admin role in users databank
require_once("config/if-loggin.php");




if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
{
 $id = $_GET['edit_id'];
 $stmt_edit = $db->prepare('SELECT title, description,  pic FROM lesgevers WHERE id = :id');
 $stmt_edit->execute(array(':id'=>$id));
 $edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);

 extract((array)$edit_row);
}
else
{
 header("Location: view-lesgever.php");
}


if(isset($_POST['save_updates'])){

   
      
        //variable name 
        $title = $_POST['title'];
        
        $description = strip_tags($_POST['description']);
        
    
      // PHP Form Validations
      if(empty($_POST['title'])){$errors[] = "Title Field is Required";}
      if(empty($_POST['description'])){$errors[] = "Content Field is Required";}
     
    
    
     
    
        $imgFile = $_FILES['pic']['name'];
        $tmp_dir = $_FILES['pic']['tmp_name'];
        $imgSize = $_FILES['pic']['size'];
           
        if($imgFile)
        {
         $upload_dir ='../media-lesgever/'; // upload directory 
         $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
         $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
         $propic = rand(1000,1000000).".".$imgExt;
              if(in_array($imgExt, $valid_extensions)) {  
      
                    if($imgSize < 5000000){
                    unlink($upload_dir.$edit_row['pic']);
                    move_uploaded_file($tmp_dir,$upload_dir.$propic);
                    }else{
                   $errors[]= "Sorry, your file is too large it should be less then 5MB";
                    }
              }else{
              $errors[] = "Sorry, only JPG, JPEG, PNG  files are allowed.";  
               } 
        }else{
         // if no image selected the old image remain as it is.
         $propic = $edit_row['pic']; // old image from database
        } 
    
    
       
        if(!isset($errors)){
            $stmt = $db->prepare('UPDATE lesgevers
        
                          SET title=:title,
                           description=:description, 
                           pic=:pic,
                           
                           created=NOW() WHERE id=:id ');
    
        
     
        
         $stmt->bindParam(':title', $title);      
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':pic', $propic);
        
        $stmt->bindParam(':id',$id);
    
        if($stmt->execute())
        {
            $messages = "it has been successfully updated";
          
        }
        else
        {
            $messages = "An error occured while updating....";
        }
    
    
    
    
    
        }

 


      
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

        <h2> edit page</h2>
        <hr>

 

        <fiedset class="claa p-2">
            <form role="form" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label> title : </label>
                    <input class="form-control" name="title"  value="<?php  echo $title; ?>" >
                </div>
                <div class="form-group">
                    <label> Content</label>
                    <textarea style="overflow-y: scroll; height: 200px;" id="content"  class="form-control" name="description" rows="9" cols="48">
                    <?php  echo $description; ?>
                </textarea>
                </div>
                <div class="form-group">
                    <label>Featured Image</label>
                    <input type="file" name="pic">

                    <img src='../media-lesgever/<?php echo $pic; ?>'  height='50px' width='100px'>
                </div>
              
                <input type="submit" name="save_updates" class="btn btn-success" value="Submit" />
            </form>


        </fiedset>


    </div>








</main>

<?php include('inc/footer.php'); ?>