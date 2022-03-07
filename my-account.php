<?php 
session_start();

require_once('includes/connect.php');
// check user login - customer
require_once('includes/check-login.php');

include "frontend/shop-header.php";

include "frontend/shop-navmenu.php";
 
?>
<!-- SHOP CONTENT -->
<section id="content">
	<div class="content-blog content-account">
		<div class="container">
			<div class="row">
				<div class="page_header text-center ">
					<h2>My Account</h2>
					<p> login as :</p>
					<hr>
				</div>
				<div class="col-md-12 card p-4 mb-4">
  

   <?php
   
$sql = "SELECT * FROM users WHERE id=?";
$result = $db->prepare($sql);
$result->execute(array($_SESSION['id']));
$users = $result->fetchAll(PDO::FETCH_ASSOC);


				foreach ($users as $cat) {
    ?>
                             
                                    <span>your email:   <strong>  <?php echo $cat['email']; ?></strong></span><br>
                                    <span> username: <?php echo $cat['username']; ?></span>
									
        
				<?php   } ?>
		<br>
		<br>
		<br>

		<div class="ma-address p-3 m-2">
					<h3>My Addresses <a href="add-address.php" class="pull-right btn btn-info w-25">Add New Address</a></h3>
			
        <div class="mb-5" style="margin:25rem 0;"></div>

		<div class="row">
			<?php 
				$sql = "SELECT * FROM user_address WHERE uid=?";
			    $result = $db->prepare($sql);
			    $result->execute(array($_SESSION['id']));
			    $res = $result->fetchAll(PDO::FETCH_ASSOC);
			    foreach ($res as $address) {
			 ?>
			<div class="col-md-3">
				<h4><?php echo $address['nickname']; ?> </h4>
				<p>
					<?php echo $address['fname']." ".$address['lname']; ?><br>
					<?php echo $address['phone']; ?><br>
					<?php echo $address['address1']; ?><br>
					<?php echo $address['address2']; ?><br>
					<?php echo $address['city']; ?><br>
					<?php echo $address['state']; ?><br>
					<?php echo $address['country']; ?><br>
					<?php echo $address['zipcode']; ?>
				</p>
			</div>
			<?php } ?>
		</div>
		</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php include('frontend/shop-footer.php'); ?>

