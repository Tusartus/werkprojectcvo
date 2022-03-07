<?php
session_start();

require_once('../includes/connect.php');

 //protected only for login as admin role in users databank
 require_once( "config/if-loggin.php");



if(isset($_POST) & !empty($_POST)){
    // PHP Form Validations
    if(empty($_POST['code'])){ $errors[] = "Coupon Code is Required";}else{
        // check the coupon code in unique
        $sql = "SELECT * FROM coupons WHERE coupon_code=?";
        $result = $db->prepare($sql);
        $result->execute(array($_POST['code']));
        $count = $result->rowCount();
        if($count == 1){
            $errors[] = 'Coupon Code already exists in database';
        }
    }
    if(empty($_POST['type'])){ $errors[] = "Coupon Type is Required";}
    if(empty($_POST['discount'])){ $errors[] = "Coupon Discount Value is Required";}
    if(empty($_POST['limit'])){ $errors[] = "Coupon Limit is Required";}
    if(empty($_POST['expiry'])){ $errors[] = "Coupon Expiry Date is Required";}

    if(empty($errors)){
        // Insert into categories table
        $sql = "INSERT INTO coupons (coupon_code, type, description, terms, coupon_value, coupon_limit, coupon_expiry) VALUES (:coupon_code, :type, :description, :terms, :coupon_value, :coupon_limit, :coupon_expiry)";
        $result = $db->prepare($sql);
        $values = array(':coupon_code'      => strtoupper($_POST['code']),
                        ':type'             => $_POST['type'],
                        ':description'      => $_POST['description'],
                        ':terms'            => $_POST['terms'],
                        ':coupon_value'     => $_POST['discount'],
                        ':coupon_limit'     => $_POST['limit'],
                        ':coupon_expiry'    => $_POST['expiry']
                        );
        $res = $result->execute($values);
        if($res){
            header('location: view-coupons.php');
        }else{
            $errors[] = "Failed to Add Coupon";
        }
    }
}





include ('inc/header.php'); 
include ('inc/navbar.php'); 

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
                                

                                <div class="form-group">
                                    <label>Coupon Code</label>
                                    <input name="code" class="form-control" placeholder="CREATE coupon code " value="<?php if(isset($_POST['code'])){ echo $_POST['code']; } ?>">
                                </div>
                                <div class="form-group">
                                    <label>Coupon Description</label>
                                    <textarea name="description" class="form-control" rows="3"><?php if(isset($_POST['description'])){ echo $_POST['description']; } ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Coupon Terms</label>
                                    <textarea name="terms" class="form-control" rows="3"><?php if(isset($_POST['terms'])){ echo $_POST['terms']; } ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Coupon Type</label>
                                    <select name="type" class="form-control">
                                        <option value="">--Select Coupon Type--</option>
                                        <option value="flat-rate">Flat Rate</option>
                                        <option value="percentage">Percentage</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Category Discount Value</label>
                                    <input name="discount" type="number" class="form-control" placeholder="Enter Coupon Discount Value" value="<?php if(isset($slug)){ echo $slug; } ?>">
                                </div>
                                <div class="form-group">
                                    <label>Coupon Limit</label>
                                    <input name="limit" type="number" min="0" class="form-control" placeholder="Enter Coupon Limit" value="<?php if(isset($slug)){ echo $slug; } ?>">
                                </div>
                                <div class="form-group">
                                    <label>Coupon Expiry (LIKE 2018-10-30)</label>
                                    <input type="text" name="expiry" id="datepicker" class="form-control" placeholder="Enter Coupon Expiry Day YYYY-MM-DAY" value="<?php if(isset($slug)){ echo $slug; } ?>">
                                </div>

                                <input type="submit" class="btn btn-primary" value="Submit" />
                            </form>


      </fiedset>

   </div>


   
    </main>

    <?php include ('inc/footer.php'); ?>

    
    