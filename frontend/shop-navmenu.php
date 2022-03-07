<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <a class="navbar-brand" href="shop-products.php">Shopsteun</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav ml-r">
      <li class="nav-item">
        <a class="nav-link" href="shop-products.php">shop</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="shop-products.php">Products</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="all-products.php">All products</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-center " style="margin-left:25px;">
    <?php 
						if(isset($_SESSION['id']) & !empty($_SESSION['id'])){
							$sql = "SELECT * FROM users WHERE id=?";
							$result = $db->prepare($sql);
							$result->execute(array($_SESSION['id']));
							$user = $result->fetch(PDO::FETCH_ASSOC);
							if($user['role'] == 'customer'){
					 ?>
      <li class="nav-item">
        <a class="nav-link text-info" href="my-account.php">Myaccount</a>
      </li>
     
      <li class="nav-item">
        <a class="nav-link text-warning" href="logout.php">logout</a>
      </li>

              <?php   } } else{ ?>
      <li class="nav-item">
        <a class="nav-link" href="login.php">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="register.php">Register</a>
      </li>

      <?php }  ?>

    </ul>
    <ul class="navbar-nav ml-auto">
      <?php
      if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
        $total = 0;
      ?>
        <li class="nav-item">
        
        <li class="nav-item">
        <a class="nav-link " href="cart.php"><i class="fa fa-shopping-cart text-danger"></i> 
        
        <small class="ml-1"> <em><?php echo count($cart); ?> item(s) </em></small>
        </a>
      </li>


      <?php } else {  ?>

        <li class="nav-item">
          <a class="nav-link " href="cart.php"><i class="fa fa-shopping-cart text-danger"></i>

            <small class="ml-1"> <em>0 item(s) </em></small>
          </a>
        </li>


      <?php } ?>


    </ul>
  </div>
</nav>
<br>