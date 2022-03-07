
<?php 
session_start();

require_once('../includes/connect.php');

 //protect page only for login as admin role in users databank
 require_once( "config/if-loggin.php");

if(isset($_POST) & !empty($_POST)){
    // PHP Form Validations
    if(empty($_POST['title'])){$errors[] = "Title Field is Required";}
    
    if(empty($_POST['slug'])){$slug = trim($_POST['title']); } else{$slug = trim($_POST['slug']);}
    // check slug is unique with db query
    $search = array(" ", ",", ".", "_");
    $slug = strtolower(str_replace($search, '-', $slug));
    $sql = "SELECT * FROM categories WHERE slug=:slug AND id <> :id";
    $result = $db->prepare($sql) or die(print_r($result->errorInfo(), true));
    $values = array(':slug'   => $_POST['slug'],
                     ':id'    => $_POST['id']
                    );
    $result->execute($values);
    $count = $result->rowCount();
    if($count == 1){
        $errors[] = "Slug already exists in database";
    }


    

 

    if(empty($errors)){
     
               // Update SQL Query
        $sql = "UPDATE categories SET title=:title,  slug=:slug  WHERE id=:id";
        $result = $db->prepare($sql);
        $values = array(':title'            => $_POST['title'],
                       
                        ':slug'             => $_POST['slug'],
                        ':id'               => $_POST['id']
                        );

        $res = $result->execute($values);
        if($res){
            header('location:view-categories.php');
        }else{
            $errors[] = "Failed to updated Category";
        }

     
     



    }
}






include ('inc/header.php'); 
include ('inc/navbar.php'); 


$sql = "SELECT * FROM categories WHERE id=?";
$result = $db->prepare($sql);
$result->execute(array($_GET['id']));
$cat = $result->fetch(PDO::FETCH_ASSOC);

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
                              


                                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                                <div class="form-group">
                                    <label>Category Title</label>
                                    <input tyep="text" class="form-control" name="title"  value="<?php if(isset($cat['title'])){ echo $cat['title'];} ?>">
                                </div>
                               
                                <div class="form-group">
                                   
                                    <input type="hidden" class="form-control" name="slug"  value="<?php if(isset($cat['slug'])){ echo $cat['slug'];} ?>">
                                </div>

                                <input type="submit" class="btn btn-success" value="Submit" />
                            </form> 


      </fiedset>

   </div>


   
    </main>

    <?php include ('inc/footer.php'); ?>
