<?php 
session_start();

require_once('includes/connect.php');

// check user login - customer
require_once('includes/check-login.php'); 

?>

                    <?php 
						if(isset($_SESSION['cart'])){
							//$cart = $_SESSION['cart'];
							//$total = 0;

                           
                        }else{

                            header('location: shop-products.php');

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

<?php include('navmenu.php') ?>



<div class="jumbotron">
<div class="page_header text-center">
			<h2>message : </h2>
			
            <p class="text-info">
            bedankt om bij ons te kopen
</p>
		</div>

</div>






</body>
</html>