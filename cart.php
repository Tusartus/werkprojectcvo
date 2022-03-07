<?php
session_start();

require_once('includes/connect.php');


include "frontend/shop-header.php";

include "frontend/shop-navmenu.php";


$date = date("Y-m-d");
if (isset($_POST) & !empty($_POST)) {
	$sql = "SELECT * FROM coupons WHERE coupon_code=? AND DATE(coupon_expiry) >= $date";
	$result = $db->prepare($sql);
	$result->execute(array($_POST['coupon']));
	$count = $result->rowCount();
	$coupon = $result->fetch(PDO::FETCH_ASSOC);
	if ($count == 1) {
		// create the sesison with coupon_code
		$_SESSION['coupon']	= $coupon['coupon_code'];
	} else {
		$couponerrors[] = "Invalid/Expired Coupon Code";
	}
} elseif (isset($_SESSION['coupon'])) {
	$sql = "SELECT * FROM coupons WHERE coupon_code=? AND DATE(coupon_expiry) >= $date";
	$result = $db->prepare($sql);
	$result->execute(array($_SESSION['coupon']));
	$count = $result->rowCount();
	$coupon = $result->fetch(PDO::FETCH_ASSOC);
}





?>


<!-- SHOP CONTENT -->
<section id="content mt-5" style="margin: 6rem 0;">
	<div class="content-blog">
		<div class="container">

			<div class="row">
				<div class="page_header text-center">
					<h2>Shop Cart</h2>
					<p>Checkout these items to Place the Order</p>
				</div>
				<div class="col-md-12">
					<table class="cart-table table table-bordered">
						<thead>
							<tr>
								<th>&nbsp;</th>
								<th>&nbsp;</th>
								<th>Product</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>

							<?php
							if (isset($_SESSION['cart'])) {
								$cart = $_SESSION['cart'];
								$total = 0;
								foreach ($cart as $key => $value) {
									// key is id and value is qunatity
									$sql = "SELECT * FROM products WHERE id=?";
									$result = $db->prepare($sql);
									$result->execute(array($key));
									$product = $result->fetch(PDO::FETCH_ASSOC);
							?>

									<tr>
										<td>
											<a href="del-cart.php?id=<?php echo $key; ?>" class="remove"><i class="fa fa-times"></i></a>
										</td>
										<td>
											<a href="single-prod.php?id=<?php echo $product['id']; ?>"><img src="./media-products/<?php echo $product['pic']; ?>" alt="" height="90" width="90"></a>
										</td>
										<td>
											<a href="single-prod.php?id=<?php echo $product['id']; ?>"><?php echo $product['Name']; ?></a>
										</td>
										<td>
											<span class="amount"> $ <?php echo $product['Price']; ?></span>
										</td>
										<td>
											<div class="quantity">

												<span> <?php echo $value['quantity']; ?></span>




											</div>



										</td>
										<td>
											<span class="amount"> $ <?php echo ($product['Price'] * $value['quantity']); ?></span>
										</td>
									</tr>

							<?php
									$total = $total + ($product['Price'] * $value['quantity']);
								} //end foreach

							} else {
								echo "<tr><td><h3 class='text-info '>Your cart is empty -Add Products to Cart for Checkout.</h3></td></tr>";
							} ?>

							<tr>
								<td colspan="6" class="actions">
									<div class="col-md-6">
										<div class="coupon">
											<form method="post">
												<label>Coupon:</label><br>
												<input name="coupon" placeholder="Coupon code" type="text" value="<?php if (isset($count)) {
																														if ($count == 1) {
																															echo $coupon['coupon_code'];
																														}
																													} ?>">
												<button class="btn btn-info" type="submit">Apply</button>
												<?php if (isset($count)) {
													if ($count == 1) { ?>
														<a href="remove-coupon.php" class="btn btn-danger">Remove</a>
												<?php }
												} ?>
											</form>
											<?php
											if (!empty($couponerrors)) {
												echo "
                                                  <div class='alert alert-danger alert-dismissible m-3'>
                                                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                    
                                                   ";
												foreach ($couponerrors as $couponerror) {
													echo "<span class='glyphicon glyphicon-remove'></span>&nbsp;" . $couponerror . "<br>";
												}
												echo "</div>";
											}
											?>
											<small class="mt-3">
												<?php
												if (isset($count)) {
													if ($count == 1) {
														echo "Coupon Type : " . $coupon['type'] . "<br>";
														if ($coupon['type'] == 'percentage') {
															echo "Coupon Value : " . $coupon['coupon_value'] . "%<br>";
														} elseif ($coupon['type'] == 'flat-rate') {
															echo "Coupon Value : $ " . $coupon['coupon_value'] . "<br>";
														}

														echo "Description : " . $coupon['description'] . "<br>";
														echo "Terms : " . $coupon['terms'] . "<br>";
													}
												}
												?>
										</div>
										</small>
									</div>

								</td>

								<td>
									<div class="col-md-6">
										<div class="cart-btn">
											
											<a href="checkoutnostripe.php" class="button btn-md btn btn-success">Checkout</a>
										</div>
									</div>

								</td>
							</tr>
						</tbody>
					</table>

					<div class="cart_totals">
						<div class="col-md-6 push-md-6 no-padding">
							<h4 class="heading">Cart Totals</h4>
							<table class="table table-bordered col-md-6">
								<tbody>
									<tr>
										<th>Cart Subtotal</th>
										<td><span class="amount"> $ <?php if(!empty($total)){ echo $total; }else{ echo "0"; } ?></span></td>
									</tr>
									<tr>
										<th>Shipping and Handling</th>
										<td>
											Free Shipping
										</td>
									</tr>
                                    <?php 
							if(isset($count)){
		                	if($count == 1){ 
		                            ?>
									<tr>
										<th>Discount</th>
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
								$  <?php echo $discount; ?>				
							</td>
									</tr>
						    <?php } } ?>
									<tr>
										<th>Order Total</th>
										<td><strong><span class="amount"> $ <?php if(!empty($total)){ echo $total; }else{ echo "0"; } ?></span></strong> </td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</section>



















<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/main.js"></script>
</body>

</html>