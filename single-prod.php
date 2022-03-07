
<?php
session_start();

require_once('./includes/connect.php');

?>

<?php  

include "frontend/shop-header.php";

include "frontend/shop-navmenu.php";


?>

<?php

if(isset($_GET['id']) & !empty($_GET['id'])){
    $id= $_GET['id'];
  	$sql = "SELECT * FROM products WHERE id=?";
    $result = $db->prepare($sql);
    $result->execute(array($_GET['id']));
    $product = $result->fetch(PDO::FETCH_ASSOC);



}

?>


	    	

      <section class="container-fluid">
        <div class="row">
            <div class="jumbotron text-center col-lg-12 col-md-12 col-sm-12 p-2">
                
                <p> product detail </p> 
            </div>
    
        </div>
    </section>

  
<div class="container-fluid">
  <div class="row">
         
     <aside class="col-lg-5 col-md-5 col-sm-5">
    <div class="cardShadow">
        <img src="./media-products/<?php echo $product['pic']; ?>" class="card-img-top imgDetail" alt="productimg">
      
    </div>
     </aside>
     <aside class="col-lg-5 col-md-5 col-sm-5">

        <h1><?php echo $product['Name']; ?></h1>
        <hr class="bg-success">
        <p> <?php echo $product['Description']; ?>  </p>
        <p>
            price : <?php echo $product['Price']; ?>   $ 
        </p>

         <div class="cartAdd">
              <a href="add-to-cart.php?id=<?php echo $product['id']; ?>" class="btn btn-info text-danger"> add to cart </a>
         </div>
     </aside>


     



  </div>
</div>

<hr class="bg-info">

 <!-- footer -->
 <?php   include "frontend/shop-footer.php"; ?>