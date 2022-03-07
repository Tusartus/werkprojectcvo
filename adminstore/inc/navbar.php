<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3 ml-5 text-success" href="#"> store application </a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  
  
  
    <?php 
						if(isset($_SESSION['id']) & !empty($_SESSION['id'])){
							$sql = "SELECT * FROM users WHERE id=?";
							$result = $db->prepare($sql);
							$result->execute(array($_SESSION['id']));
							$user = $result->fetch(PDO::FETCH_ASSOC);
							if($user['role'] == 'admin'){
					 ?>
     <ul class="navbar-nav d-flex px-3">
     
      <li class="nav-item">
        <a class="nav-link text-info" href="logout.php">logout</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php">Store dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../adminweb/index.php"> Web dashboard</a>
      </li>

      </ul>



              <?php   } } else{ ?>
        <ul class="navbar-nav px-3">

                <li class="nav-item">
            <a class="nav-link" href="login.php"> Login</a>
               </li>
         

               <?php }  ?>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">

    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-3">
      <?php 
						if(isset($_SESSION['id']) & !empty($_SESSION['id'])){
							$sql = "SELECT * FROM users WHERE id=?";
							$result = $db->prepare($sql);
							$result->execute(array($_SESSION['id']));
							$user = $result->fetch(PDO::FETCH_ASSOC);
							if($user['role'] == 'admin'){
					 ?>
        <ul class="nav flex-column">
        
          <li class="nav-item">
            <a class="nav-link" href="add-categp.php">
              <span data-feather="file"></span>
              add category
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="view-categories.php">
              <span data-feather="shopping-cart"></span>
              view categories
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="add-product.php">
              <span data-feather="shopping-cart"></span>
         Add products
            </a>
          </li>


          <li class="nav-item">
            <a class="nav-link" href="view-products.php">
              <span data-feather="shopping-cart"></span>
            View products
            </a>
          </li>


       
       
       
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Settings</span>
          <hr>
          <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          
     
        <li class="nav-item">
            <a class="nav-link" href="add-coupon.php">
              <span data-feather="shopping-cart"></span>
         Add coupons
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="view-coupons.php">
              <span data-feather="shopping-cart"></span>
         view coupons
            </a>
          </li>


          


        </ul>
        <?php }  } ?>
      </div>
    </nav>

