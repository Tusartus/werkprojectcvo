<?php
session_start();


require_once('../includes/connect.php');

 //protect  page only for login as admin role in users databank
 require_once( "config/if-loggin.php");

if(isset($_POST) & !empty($_POST)){
    // PHP Form Validations
    
    if(empty($_POST['limit'])){ $errors[] = "Coupon Limit is Required";}
    if(empty($_POST['expiry'])){ $errors[] = "Coupon Expiry Date is Required";}

  

    if(empty($errors)){
        // Insert into categories table
        $sql = "UPDATE coupons SET description=:description, terms=:terms, coupon_limit=:coupon_limit, coupon_expiry=:coupon_expiry, updated=NOW() WHERE id=:id";
        $result = $db->prepare($sql);
        $values = array(':description'      => $_POST['description'],
                        ':terms'            => $_POST['terms'],
                        ':coupon_limit'     => $_POST['limit'],
                        ':coupon_expiry'    => $_POST['expiry'],
                        ':id'               => $_POST['id']
                        );
        $res = $result->execute($values);
        if($res){
            header('location: view-coupons.php');
        }else{
            $errors[] = "Failed to Update Coupon";
        }
    }
}




include ('inc/header.php'); 
include ('inc/navbar.php'); 


$sql = "SELECT * FROM coupons WHERE id=?";
$result = $db->prepare($sql);
$result->execute(array($_GET['id']));
$coupon = $result->fetch(PDO::FETCH_ASSOC);


?>




    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"> </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
       
     
        </div>
      </div>

   <div class="col-sm-8">
   <h2> Add coupon</h2>

   <div class="col-md-9">
   <?php
                        if(!empty($messages)){
                            echo "<div class='alert alert-success alert-dismissible'>";
                            echo"<button type='button' class='close' data-dismiss='alert'>&times;</button>";
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
      <form role="form" method="post">
                              

                                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                                <div class="form-group">
                                    <label>Coupon Code</label>
                                    <input name="code" class="form-control" placeholder="Enter Category Title" value="<?php if(isset($coupon['coupon_code'])){ echo $coupon['coupon_code']; } ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Coupon Description</label>
                                    <textarea name="description" class="form-control" rows="3"><?php if(isset($coupon['description'])){ echo $coupon['description']; } ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Coupon Terms</label>
                                    <textarea name="terms" class="form-control" rows="3"><?php if(isset($coupon['terms'])){ echo $coupon['terms']; } ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Coupon Type</label>
                                    <select name="type" class="form-control" disabled>
                                        <option value="">--Select Coupon Type--</option>
                                        <option value="flat-rate" <?php if($coupon['type'] == 'flat-rate'){ echo "selected"; } ?>>Flat Rate</option>
                                        <option value="percentage" <?php if($coupon['type'] == 'percentage'){ echo "selected"; } ?>>Percentage</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Category Discount Value</label>
                                    <input name="discount" type="number" class="form-control" placeholder="Enter Coupon Discount Value" value="<?php if(isset($coupon['coupon_value'])){ echo $coupon['coupon_value']; } ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Coupon Limit</label>
                                    <input name="limit" type="number" class="form-control" placeholder="Enter Coupon Limit" value="<?php if(isset($coupon['coupon_limit'])){ echo $coupon['coupon_limit']; } ?>">
                                </div>
                                <div class="form-group">
                                    <label>Coupon Expiry (2018-10-30)</label>
                                    <input name="expiry" class="form-control" placeholder="Enter Coupon Expiry Day" value="<?php if(isset($coupon['coupon_expiry'])){ echo $coupon['coupon_expiry']; } ?>">
                                </div>

                                <input type="submit" class="btn btn-primary" value="Submit" />
                            </form>


      </fiedset>

   </div>


   
    </main>

    <?php include ('inc/footer.php'); ?>

    
    