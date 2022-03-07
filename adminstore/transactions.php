<?php
  require_once('../config/db.php');
  require_once('../lib/pdo_db.php');
  require_once('../models/Transaction.php');

  

  // Instantiate Transaction
  $transaction = new Transaction();

  // Get Transaction
  $transactions = $transaction->getTransactions();
?>


<?php

//include('inc/check-login.php');


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
      <a href="customers.php" class="btn btn-secondary">Customers</a>
      <a href="transactions.php" class="btn btn-primary">Transactions</a>
    </div>
    <hr>
    <h2>Transactions</h2>
    <table class="table table-striped"  id="table_id">
      <thead>
        <tr>
          <th>Transaction ID</th>
          <th>Customer</th>
          <th>Product</th>
          <th>Amount</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($transactions as $t): ?>
          <tr>
            <td><?php echo $t->id; ?></td>
            <td><?php echo $t->customer_id; ?></td>
            <td><?php echo $t->product; ?></td>
            <td><?php echo sprintf('%.2f', $t->amount / 100); ?> <?php echo strtoupper($t->currency); ?></td>
            <td><?php echo $t->created_at; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <br>
    

  </div>



   </div>





   </div>


   
    </main>

    <?php include ('inc/footer.php'); ?>

    