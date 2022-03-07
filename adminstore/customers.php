<?php
session_start();
//include('inc/check-login.php');

require_once('../includes/connect.php');

 

?>

<?php
  require_once('../config/db.php');
  require_once('../lib/pdo_db.php');
  require_once('../models/Customer.php');


;

  // Instantiate Customer
  $customer = new Customer();

  // Get Customer
  $customers = $customer->getCustomers();

?>



<?php
include ('inc/header.php'); 
include ('inc/navbar.php'); 

?>




    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"> </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
       
     
        </div>
      </div>

   <div class="col-sm-8">
   <h2>Section title</h2>

   <div class="col-md-9">
   <div class="container mt-4">
    <div class="btn-group" role="group">
      <a href="customers.php" class="btn btn-primary">Customers</a>
      <a href="transactions.php" class="btn btn-secondary">Transactions</a>
    </div>
    <hr>
    <h2>Customers</h2>
    <table class="table table-striped"  id="table_id">
      <thead>
        <tr>
          <th>Customer ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Date</th>
       h>
        </tr>
      </thead>
      <tbody>
        <?php foreach($customers as $c): ?>
          <tr>
            <td><?php echo $c->id; ?></td>
            <td><?php echo $c->first_name; ?> <?php echo $c->last_name; ?></td>
            <td><?php echo $c->email; ?></td>
        


            <td><?php echo $c->created_at; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <br>
    
  </div>



  <div class="mb-5" style="margin:15rem 0;"></div>
   
   </div>
      
   

   </div>


   
    </main>

    <?php include ('inc/footer.php'); ?>

    