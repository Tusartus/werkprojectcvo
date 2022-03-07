
<?php
session_start();

require_once('./includes/connect.php');

?>

<?php  

include "frontend/shop-header.php";

include "frontend/shop-navmenu.php";


?>

<section class="retbox container-fluid">
    <div class="row">
            
        <div class="col-lg-12 col-md-12 col-sm-12 showDetailImg">
            <img src="img/FashV51.jpg" class="card-img-top" alt="productimg">
        </div>

        <div class="card col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
            <article class="card-body animateHere">
                
                <h5 class="card-title float-lg-right"> 
                    <a class="text-warning" href="cart.php"> winkelmandje</a>
                </h5>
                <p class="card-text d-flex justify-content-center">
                Welkomstgeschenk!!! Bij bestelling van meer dan 50€, ontvang je een gratis geschenkje!! Voeg het artikel toe in je winkelmandje.
                    
                </p>
               
            </article>

        </div>




    </div>
</section>
  
<div class="container-fluid">
  <div class="row">
         
     <aside class="col-lg-8 col-md-8 col-sm-8">
    
    <div class="row">

    <?php
    //fetch 
$sql = "SELECT * FROM products ";
$result = $db->prepare($sql);
$result->execute();
$products = $result->fetchAll(PDO::FETCH_ASSOC);
 foreach ($products as $product) {
?>
    <div class="col-lg-3 col-md-3 col-sm-3 cardShadow">
        <img src="./media-products/<?php echo $product['pic']; ?>" class="card-img-top imgShop" alt="productimg">
        <div class="card-body">
          <h5 class="card-title"><?php echo $product['Name']; ?></h5>
          <p class="card-text"><?php echo substr($product['Description'],0 , 10 ); ?></p>
          <p class="card-text">  <?php echo $product['Name']; ?> $ </p>
        </div>
        <div class="card-body">    
        <a href="single-prod.php?id=<?php echo $product['id']; ?>" class="card-link  btn btn-info w-50"> view</a>
          </div>
    </div>
    <?php  }  ?>    

   
   
   
 
 
  


    </div> 
     </aside>

     <aside class="col-lg-3 col-md-3 col-sm-3 p-4">
     <h2 class="mb-2 nav justify-content-center">categories: </h2>
         <hr>
         <div class="row">
         <?php

$catsql = "SELECT * FROM categories";
$catresult = $db->prepare($catsql);
$catresult->execute();
$catres = $catresult->fetchAll(PDO::FETCH_ASSOC);

?>
         <ul class="asideCategory mt-3 d-block">
         <?php foreach ($catres as $cat) { ?>
             <li><a class="p-2 mb-4" href="category.php?cat_id=<?php echo $cat['id']; ?>" target="_blank"> <?php echo $cat['title']; ?> </a></li>
             <?php }  ?> 

         </ul>
        </div> 
        <hr>

        <div class="row">
            <h3 class="text-info d-flex justify-content-center mb-4 pb-4">recents products</h3>
            
          
    <?php
    //fetch 
$sql = "SELECT * FROM products ORDER BY created  LIMIT 2";
$result = $db->prepare($sql);
$result->execute();
$products = $result->fetchAll(PDO::FETCH_ASSOC);
 foreach ($products as $product) {
?>
            <div class="col-lg-12 col-md-12 col-sm-12 cardShadow">
                <img src="./media-products/<?php echo $product['pic']; ?>" class="card-img-top imgShop" alt="productimg">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $product['Name']; ?></h5>
                  <p class="card-text"><?php echo substr($product['Description'],0 , 10 ); ?> ...</p>
                  
                </div>
                <div class="card-body">
                    
                    <a href="single-prod.php?id=<?php echo $product['id']; ?>" class="card-link btn btn-info w-75"> view </a>
                  </div>
            </div>
      <?php  }  ?>       
        </div>
     </aside>



  </div>
</div>

<hr class="bg-info">


<?php   include "frontend/shop-footer.php"; ?>
