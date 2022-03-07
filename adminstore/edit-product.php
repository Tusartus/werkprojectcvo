<?php 


session_start();

require_once('../includes/connect.php');

 //protect  page only for login as admin role in users databank
 require_once( "config/if-loggin.php");

if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
{
 $id = $_GET['edit_id'];
 $stmt_edit = $db->prepare('SELECT Name, Description, Price, slug, pic FROM products WHERE id = :id');
 $stmt_edit->execute(array(':id'=>$id));
 $edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
 //extract($edit_row);
 extract((array)$edit_row);
}
else
{
 header("Location: view-products.php");
}


if(isset($_POST['save_updates'])){

    //variable name 
    $Name = $_POST['Name'];
    $Category = $_POST['Category'];
    $Description = strip_tags($_POST['Description']);
    $Price = $_POST['Price'];
   
    $slug = strip_tags($_POST['slug']);

  // PHP Form Validations
  if(empty($_POST['Name'])){$errors[] = "Name Field is Required";}
  if(empty($_POST['Description'])){$errors[] = "Content Field is Required";}
  if(empty($_POST['Category'])){$errors[] = "Category Field is Required";}
  if(empty($_POST['Price'])){$errors[] = "Price Field is Required";}
  if(empty($_POST['slug'])){$slug = trim($_POST['Name']); }else{$slug = trim($_POST['slug']);}


    // check slug is unique with db query
    $search = array(" ", ",", ".", "_");
    $slug = strtolower(str_replace($search, '-', $slug));
    $sql = "SELECT * FROM products WHERE slug=?";
    $result = $db->prepare($sql);
    $result->execute(array($slug));
    $count = $result->rowCount();
    /*if($count == 1){
        $errors[] = "Slug already exists in database";
        
    }
    */

    $imgFile = $_FILES['pic']['name'];
    $tmp_dir = $_FILES['pic']['tmp_name'];
    $imgSize = $_FILES['pic']['size'];
       
    if($imgFile)
    {
     $upload_dir ='../media-products/'; // upload directory 
     $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
     $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
     $productpic = rand(1000,1000000).".".$imgExt;
          if(in_array($imgExt, $valid_extensions)) {  
  
                if($imgSize < 5000000){
                unlink($upload_dir.$edit_row['pic']);
                move_uploaded_file($tmp_dir,$upload_dir.$productpic);
                }else{
               $errors[]= "Sorry, your file is too large it should be less then 5MB";
                }
          }else{
          $errors[] = "Sorry, only JPG, JPEG, PNG  files are allowed.";  
           } 
    }else{
     // if no image selected the old image remain as it is.
     $productpic = $edit_row['pic']; // old image from database
    } 


   
    if(!isset($errors)){
        $stmt = $db->prepare('UPDATE products
    
                      SET Name=:Name,
                       Description=:Description, 
                       pic=:pic, 
                       Price=:Price,
                       catid=:Category,
                       slug=:slug, 
                       created=NOW() WHERE id=:id ');

    
    $stmt->bindParam(':Category', $Category);
    
     $stmt->bindParam(':Name', $Name);      
    $stmt->bindParam(':Description', $Description);
    $stmt->bindParam(':pic', $productpic);
    $stmt->bindParam(':Price', $Price);

    $stmt->bindParam(':Category', $Category);
    $stmt->bindParam(':slug', $slug);
    $stmt->bindParam(':id',$id);

    if($stmt->execute())
    {
        $messages = "The product has been successfully updated";
        //header("refresh:1;index.php"); // redirects image view page after 5 seconds.
        header('location:view-products.php');
    }
    else
    {
        $messages = "An error occured while updating....";
    }





    }
                   




      
}


include ('inc/header.php');
include ('inc/navbar.php'); 



?>




    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
       
      
        </div>
      </div>

   <div class="col-sm-7">
   <h2> Edit new article</h2>

   <div class="col-md-7">
   <?php
           /*             if(!empty($messages)){
                            echo "<div class='alert alert-success'>";
                            foreach ($messages as $message) {
                                echo "<span class='glyphicon glyphicon-ok'></span>&nbsp;". $message ."<br>";
                            }
                            echo "</div>";
                        }
        */
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
                           
                                <div class="form-group">
                                    <label>Product name: </label>
                                    <input class="form-control" name="Name"  value="<?php /*if(isset($post['Name'])){  echo $post['Name']; }  */ echo $Name; ?>" >
                                </div>
                                <div class="form-group">
                                    <label> Product Content</label>
                                    <textarea style="overflow-y: scroll; height: 200px;" id="content" class="form-control" name="Description" rows="9" cols="48">
                                    <?php /*if(isset($post['Description'])){ echo $post['Description'];}*/  echo $Description; ?>
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label>Featured Image</label>
                                    <input type="file" name="pic">

                        

                                  <img src='../media-products/<?php echo $pic; ?>'  height='50px' width='100px'>

                                </div>



                                <div class="row">
                                   
                                     
                                            <?php 
                                            // Fetch categories from categories table
                                            $sql = "SELECT * FROM categories";
                                            $result = $db->prepare($sql);
                                            $result->execute();
                                            $res = $result->fetchAll(PDO::FETCH_ASSOC);

                                 

                                            ?> 
                                            <label>Categories</label>
                                          
                                       


                                             <div class="col-lg-6">
                                            <div class="form-group">
											<select id="Brand" name="Category" class="select2" data-placeholder="Click to Choose...">
                                          
                                            <?php  foreach ($res as $item) :  ?>
                                                
                                         <option value="<?php echo $item['id']; ?>"> <?php echo $item['id']; ?>: <?php echo $item['title']; ?></option>
                                                             
                                           <?php endforeach; ?>

                                             </select>

											</div>
                                            </div>

                                   
                                  
                                </div>

                                <div class="form-group">
								<label class="control-label 3 no-padding-right" for="Price"> Price:</label>

									
									<div class="clearfix">
									<input type="number" name="Price"  min="1" id="Price" class="form-control"  value="<?php  echo $Price; ?>" 
									</div>
																
								</div>
                           
                                <div class="form-group">
                                   
                                <input type="hidden" class="form-control" name="slug">
                                </div>
                                <input type="submit" class="btn btn-success" name="save_updates" value="Submit" />
                            </form>


      </fiedset>

   </div>


   
    </main>


    <?php include ('inc/footer.php'); ?>



    <?php
    /*
         <?php
                                   if(isset($post['pic']) & !empty($post['pic'])){
                                    echo "<img src='../media-products/".$post['pic']."' height='50px' width='100px'>";                                  
                                }
     */

                                




    

    ?>