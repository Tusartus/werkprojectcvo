<?php 

session_start();

require_once('../includes/connect.php');

 //protected page only for login as admin role in users databank
 require_once( "config/if-loggin.php");


if(isset($_POST) & !empty($_POST)){

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
 
  $imgFile = $_FILES['pic']['name'];
  $tmp_dir = $_FILES['pic']['tmp_name'];
  $imgSize = $_FILES['pic']['size'];

   if(empty($imgFile)){
    $errors[] = "Please Select Image File.";
   }else{

  

   $upload_dir = '../media-products/'; // upload directory
 
   $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
   
   //valid image extensions
   $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions

   // rename uploading image
    $productpic = rand(1000,1000000).".".$imgExt;

             // allow valid image file formats
        if(in_array($imgExt, $valid_extensions)){   
             // Check file size '5MB'
               // Check file size '5MB'
               if($imgSize < 5000000) {
                move_uploaded_file($tmp_dir,$upload_dir.$productpic);
               }
               else{
                $errors[] = "Sorry, your file is too large.";
               }
        }
       else{
        $errors[] = "Sorry, only JPG, JPEG, PNG  files are allowed.";  
        }
     }



  // check slug is unique with db query
  $search = array(" ", ",", ".", "_");
  $slug = strtolower(str_replace($search, '-', $slug));
  $sql = "SELECT * FROM products WHERE slug=?";
  $result = $db->prepare($sql);
  $result->execute(array($slug));
  $count = $result->rowCount();
  if($count == 1){
      $errors[] = "Slug already exists in database";
  }


  if(empty($errors)){
   
    $stmt = $db->prepare('INSERT INTO products (Name,  Description,pic,  Price, catid, slug )

     VALUES (:Name,  :Description, :pic, :Price, :Category, :slug )');
    
    $stmt->bindParam(':Category', $Category);
    
     $stmt->bindParam(':Name', $Name);      
    $stmt->bindParam(':Description', $Description);
    $stmt->bindParam(':pic', $productpic);
    $stmt->bindParam(':Price', $Price);

    $stmt->bindParam(':Category', $Category);
    $stmt->bindParam(':slug', $slug);



                    if($stmt->execute())
                    {
                        $messages = "The product has been succesfully added";
                        //header("refresh:1;index.php"); // redirects image view page after 5 seconds.
                        header('location:view-products.php');
                    }
                    else
                    {
                        $errMSG = "An error occured while inserting....";
                    }







  }//empty errors msg









  
      
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

   <div class="col-sm-5">
   <h2>add new article</h2>

   <div class="col-md-9">
   <?php
   /*
                        if(!empty($messages)){
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
      
                <aside class="row">
                <fiedset class="col-md-12 col-sm-12 p-2">
                              <form role="form" method="post" enctype="multipart/form-data">
                           
                                <div class="form-group">
                                    <label>Product name: </label>
                                    <input class="form-control" name="Name" placeholder="Enter Article Title" >
                                </div>
                                <div class="form-group">
                                    <label> Product Content</label>
                                    <textarea style="overflow-y: scroll; height: 200px;" id="content" class="form-control" name="Description" rows="9" cols="48"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Featured Image</label>
                                    <input type="file" name="pic">
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
                                                                    <option value="">&nbsp;</option>
																		<?php foreach ($res as $item) :?>
																		<option value="<?php echo $item['id']; ?>"> <?php echo $item['title']; ?></option>
																		<?php endforeach; ?>
																	</select>

																       </div>
                                                                       </div>

                                   
                                  
                                </div>

                                <div class="form-group">
																<label class="control-label 3 no-padding-right" for="Price"> Price:</label>

									
																	<div class="clearfix">
																		<input type="number" name="Price"  min="1.00" id="Price" class="form-control"  />
																	</div>
																
								</div>
                                <div class="form-group">
                                   
                                    <input type="hidden" class="form-control" name="slug"  value="<?php if(isset($_POST['slug'])){ echo $_POST['slug'];} ?>">
                                </div>
                                <input type="submit" class="btn btn-success" value="Submit" />
                            </form>

        <br> <br> <br> <br>
      </fiedset>
                </aside>

   </div>


   
    </main>


    <?php include ('inc/footer.php'); ?>



    