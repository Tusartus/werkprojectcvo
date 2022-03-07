
<?php
session_start();

require_once('./includes/connect.php');

?>

<?php  

include "frontend/shop-header.php";

include "frontend/shop-navmenu.php";


?>


<section class="container-fluid">
    <div class="row">
        <div class="jumbotron text-center col-lg-12 col-md-12 col-sm-12 p-2">
            
            <p> Shop for goed doel ...........</p> 
        </div>

    </div>
</section>
<section class="retbox container-fluid">
    <div class="row">
            
        <div class="col-lg-12 col-md-12 col-sm-12 showDetailImg">
            <img src="https://images.pexels.com/photos/2633986/pexels-photo-2633986.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" class="card-img-top" alt="productimg">
        </div>

        <div class="card col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
            <article class="card-body animateHere">
                
                <h5 class="card-title float-lg-right"> <a class="text-warning" href="cart.php"> winkelmandje </a> </h5>
                <p class="card-text d-flex justify-content-center">
                Welkomstgeschenk!!! Bij bestelling van meer dan 50€, ontvang je een gratis geschenkje!! Voeg het artikel toe in je winkelmandje.
                    
                .</p>
               
            </article>

        </div>




    </div>
</section>
  
<div class="container">
  <div class="row">
         
       <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
           <p class="text-info d-flex justify-content-center mb-4">
             our products 
           </p>

       </div>

       <?php
// fetch the results
$sql = "SELECT * FROM products LIMIT 5";
$result = $db->prepare($sql);
$result->execute();
$products = $result->fetchAll(PDO::FETCH_ASSOC);
 foreach ($products as $product) {
?>

    <div class="col-lg-3 col-md-3 col-sm-3 cardShadow">
        <img src="./media-products/<?php echo $product['pic']; ?>" class="card-img-top imgShop" alt="productimg">
        <div class="card-body">
          <h5 class="card-title"> <?php echo $product['Name']; ?></h5>
          <p class="card-text"><?php echo substr($product['Description'],0 , 20 ); ?> ...</p>
          <p class="card-text"> $ <?php echo $product['Price']; ?></p>
        </div>
        <div class="card-body">
            <a href="add-to-cart.php?id=<?php echo $product['id']; ?>" id="cartBtn"  class="card-link"> <i class="fa fa-shopping-cart p-1 text-danger" style="font-size:25px;"></i></a>
            <a href="single-prod.php?id=<?php echo $product['id']; ?>" class="card-link btn btn-info"> view</a>
          </div>
    </div>


    <?php  }  ?>

   
   
   
   


  </div>
</div>

<hr class="bg-info">


<?php   include "frontend/shop-footer.php"; ?>