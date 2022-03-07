<?php
session_start();

require_once('includes/connect.php');

// check user login - role customer
require_once('includes/check-login.php'); 

$date = date("Y-m-d");
if(isset($_SESSION['cart'])){
	header('location: checkoutnostripe.php');
}else{
	header('location: cart.php');
}

//checkout button form 
if(isset($_POST)){

       // Redirect to success
  header('Location: notify.php');

  unset($_SESSION['cart']);
  unset($_SESSION['coupon']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>Pay Page</title>
</head>
<body>

<?php include('frontend/shop-navmenu.php.php') ?>


<div class="jumbotron">
<div class="page_header text-center">
			<h2>Shop - Checkout</h2>
			<p>No Payment  to Place the Order want winkelwagen alleen </p>
		</div>

</div>

  <div class="container">

  <div class="row">
  
      <article class="col-md-5">
      
      <div class="content-blog">
	
	
	

		<div class="row">
			<div class="lk">
				<?php
                    if(!empty($errors)){
                        echo "<div class='alert alert-danger'>";
                        foreach ($errors as $error) {
                            echo "&nbsp;".$error."<br>";
                        }
                        echo "</div>";
                    }
                ?>
			
			</div>
		</div>
		
		<div class="space30"></div>
		<h4 class="heading mt-5">Your order</h4>
		
		<table class="table table-bordered extra-padding mt-5">
			<?php 
				$cart = $_SESSION['cart'];
                $total = 0;
                foreach ($cart as $key => $value) {
					// key is id and value is qunatity
					$sql = "SELECT * FROM products WHERE id=?";
				    $result = $db->prepare($sql);
				    $result->execute(array($key));
				    $product = $result->fetch(PDO::FETCH_ASSOC);

				    $total = $total + ($product['Price']*$value['quantity']);
				}
			
			 ?>
			<tbody>
				<tr>
					<th>Cart Subtotal</th>
					<td><span class="amount">$ <?php echo $total; ?></span></td>
				</tr>
				<tr>
					<th>Shipping and Handling</th>
					<td>
						Free Shipping				
					</td>
				</tr>
				<?php 
				if(isset($_SESSION['coupon'])){
					$sql = "SELECT * FROM coupons WHERE coupon_code=? AND DATE(coupon_expiry) >= $date";
					$result = $db->prepare($sql);
					$result->execute(array($_SESSION['coupon']));
					$count = $result->rowCount();
					$coupon = $result->fetch(PDO::FETCH_ASSOC);
				?>
				<tr>
					<th>Discount <small>(<?php echo $coupon['coupon_code']; ?>)</small></th>
					<td>
						<?php 
							if($coupon['type'] == 'percentage'){
								//(coupon value / 100) * total
								$discount = ($coupon['coupon_value']/100) * $total;
								$total = $total - $discount;

							}elseif($coupon['type'] == 'flat-rate'){
								$discount = $coupon['coupon_value'];
								$total = $total - $discount;
							}
						?>
						$ <?php echo $discount; ?>				
					</td>
				</tr>
				<?php } ?>

				<tr>
					<th>Order Total</th>
					<td><strong><span class="amount"> $ <?php echo $total; ?></span></strong> </td>
				</tr>
			</tbody>
		</table>
		
<?php 




?>
	
      
      
      
      </div>

      </article>
  
  
  
  
  
  
  
 


  <article class="col-md-6">
  
 

    <h2 class="my-4 text-center"> clik te betalen  </h2>

    
    <form  method="post" id="payment-fo">
      <div class="for">
       

       <?php 
				if(isset($_SESSION['cart'])){
					$cart = $_SESSION['cart'];
					$total = 0;
					foreach ($cart as $key => $value) {
						// key is id and value is qunatity
						$sql = "SELECT * FROM products WHERE id=?";
					    $result = $db->prepare($sql);
					    $result->execute(array($key));
                        $product = $result->fetch(PDO::FETCH_ASSOC);
                        
						$total = $total + ($product['Price']*$value['quantity']);
						

						 $productarray =  $product['Name'];
			 ?>


			   <?php  

			   // echo $productarray;

			   ?>
		
						
			<!-- Details about the item that buyers will purchase. -->
            <div class="form-group">
			<input type="hidden" name="item_name" value=" <?php echo $product['Name']; ?>">
            </div>

            <div class="form-group">
			<input type="hidden" name="item_number" value="<?php echo $key; ?>">
            </div>

          
					
			<!-- URLs -->
		
            <?php } } ?>

            <div class="form-group">
			<input type="hidden" name="amount" value="<?php echo $total; ?>">
            </div>

        <div id="card-element" class="form-control">
          <!-- a Stripe Element will be inserted here. -->
        </div>

        <!-- Used to display form errors -->
        <div id="card-errors" role="alert"></div>
      </div>

      <button class="btn btn-info m-4 pt-4" > te betalen</button>
    </form>

	 

    </article>


    </div>

  </div>


  <div class="mb-5" style="margin: 20rem 0;"></div>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 

</body>
</html>