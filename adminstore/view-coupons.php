<?php 
session_start();
require_once('../includes/connect.php');

 //protected page only for login as admin role in users databank
 require_once( "config/if-loggin.php");

include ('inc/header.php'); 
include ('inc/navbar.php');


//for pagination
// number of results per page
$perpage = 1;
if(isset($_GET['page']) & !empty($_GET['page'])){
    $curpage = $_GET['page'];
}else{
    $curpage = 1;
}

// get the number of total coupons table
$sql = "SELECT * FROM coupons";
$result = $db->prepare($sql);
$result->execute();
$totalres = $result->rowCount();

// calculate startpage, nextpage, endpage variables
$endpage = ceil($totalres/$perpage);
$startpage = 1;
$nextpage = $curpage + 1;
$previouspage = $curpage - 1;
$start = ($curpage * $perpage) - $perpage;




 
?>





    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
       
      
        </div>
      </div>

   <div class="col-sm-8">
   <h2> All coupons</h2>
   <table class="table table-striped">
    <thead>
      <tr>
                                     <th>#</th>
                                    <th>Coupon Code</th>
                                    <th>Type</th>
                                    <th>Value</th>
                                    <th>Limit</th>
                                    <th>Expiry</th>
                                    <th>Operations</th>
      </tr>
    </thead>
    <tbody>
                                 <?php
                                    
                                    $sql = "SELECT * FROM coupons LIMIT $start, $perpage";
                                    $result = $db->prepare($sql);
                                    $result->execute();
                                    $res = $result->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($res as $coupon) {
                                 

                                  ?>
                                <tr>
                                    <td><?php echo $coupon['id']; ?></td>
                                    <td><?php echo $coupon['coupon_code']; ?></td>
                                    <td><?php echo $coupon['type']; ?></td>
                                    <td><?php echo $coupon['coupon_value']; ?></td>
                                    <td><?php echo $coupon['coupon_limit']; ?></td>
                                    <td><?php echo $coupon['coupon_expiry']; ?></td>
                                    <td><a href="edit-coupon.php?id=<?php echo $coupon['id']; ?>">Edit</a></td>
                                    
                                </tr>
                                <?php } ?>
   
    </tbody>
  </table>
  
  
   </div>
   <div class=" col-sm-8">

   <ul class="pagination justify-content-center mb-4">
                        <?php if($curpage != $startpage){ ?>
                        <li class="page-item">
                            <a href="?page=<?php echo $startpage; ?>" class="page-link">&laquo; First</a>
                        </li>
                        <?php } ?>
                        <?php if($curpage >= 2){ ?>
                        <li class="page-item">
                            <a href="?page=<?php echo $previouspage; ?>" class="page-link"><?php echo $previouspage; ?></a>
                        </li>
                        <?php } ?>
                        <?php if($curpage != $endpage){ ?>
                        <li class="page-item">
                            <a href="?page=<?php echo $nextpage; ?>" class="page-link"><?php echo $nextpage; ?></a>
                        </li>
                        <?php } ?>
                        <?php if($curpage != $endpage){ ?>
                        <li class="page-item">
                            <a href="?page=<?php echo $endpage; ?>" class="page-link">&raquo; Last</a>
                        </li>
                        <?php } ?>
                    </ul>
   
   </div>


   

   
    </main>

    <?php include ('inc/footer.php'); ?>

    