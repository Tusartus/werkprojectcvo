<?php

include('../includes/connect.php');

class FunctionAction{

   //need $eidit_row
    public function editNeeded($edit_row, $db){
        if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
{
 $id = $_GET['edit_id'];
 $stmt_edit = $db->prepare('SELECT title, description,  pic FROM helpen WHERE id = :id');
 $stmt_edit->execute(array(':id'=>$id));
 $edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);

 extract((array)$edit_row);
}
else
{
 header("Location: view-helpen.php");
}
}



    //edit helpen update form by id 
    public function editHelpen($edit_row, $db, $id){

         
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
     $upload_dir ='../media-helpen/'; // upload directory 
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
        $stmt = $db->prepare('UPDATE helpen
    
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
        $messages = "The product has been successfully updated";
      
    }
    else
    {
        $messages = "An error occured while updating....";
    }





    }
                   

    

    }


       //need $eidit_row
       public function editNeedOver($edit_row, $db){
        if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
{
 $id = $_GET['edit_id'];
 $stmt_edit = $db->prepare('SELECT title, description,  pic FROM helpen WHERE id = :id');
 $stmt_edit->execute(array(':id'=>$id));
 $edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);

 extract((array)$edit_row);
}
else
{
 header("Location: view-over.php");
}
}
    
    //edit helpen update form by id 
    public function editOver($edit_row, $db, $id){

         
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
         $upload_dir ='../media-overons/'; // upload directory 
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
            $stmt = $db->prepare('UPDATE overons
        
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







}






?>