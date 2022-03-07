<?php 
  session_start();

  include ('../includes/connect.php');

 include ('inc/header.php'); 
 include ('inc/navbar.php');

 //protect index page only for login as admin role in users databank
 require_once( "config/if-loggin.php");

 

 ?>




    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
       
      
        </div>
      </div>

   <div class="col-sm-8">
     <h2>  
  
    </h2>
   
 
 <hr>
 <section class="row p-2">

 <article class="col-sm-4 p-3">
 <div class="card p-4">
 <?php 

$sql = "SELECT COUNT(*) FROM helpen";
$stmt = $db->query($sql);
$count = $stmt->fetchColumn();

print "<p class='btn btn-info' >  <span class='btn btn-success' >".   $count . " </span> helpen  </p>";

  ?>

 </div>
 </article>

 <article class="col-sm-4 p-3">
 <div class="card p-4">
 <?php 

$sql = "SELECT COUNT(*) FROM helpen";
$stmt = $db->query($sql);
$count = $stmt->fetchColumn();

print "<p class='btn btn-info' >  <span class='btn btn-success' >".   $count . " </span> helpen  </p>";

  ?>

 </div>
 </article>

 <article class="col-sm-4 p-3">
 <div class="card p-4">
 <?php 

$sql = "SELECT COUNT(*) FROM infogegevens";
$stmt = $db->query($sql);
$count = $stmt->fetchColumn();

print "<p class='btn btn-info' >  <span class='btn btn-success' >".   $count . " </span> infogegevens  </p>";

  ?>

 </div>
 </article>

 <article class="col-sm-4 p-3">
 <div class="card p-4">
 <?php 

$sql = "SELECT COUNT(*) FROM werking";
$stmt = $db->query($sql);
$count = $stmt->fetchColumn();

print "<p class='btn btn-info' >  <span class='btn btn-success' >".   $count . " </span> werking  </p>";

  ?>

 </div>
 </article>

 <article class="col-sm-4 p-3">
 <div class="card p-4">
 <?php 

$sql = "SELECT COUNT(*) FROM overons";
$stmt = $db->query($sql);
$count = $stmt->fetchColumn();

print "<p class='btn btn-info' >  <span class='btn btn-success' >".   $count . " </span> overons  </p>";

  ?>

 </div>
 </article>

 <article class="col-sm-4 p-3">
 <div class="card p-4">
 <?php 

$sql = "SELECT COUNT(*) FROM lesgevers";
$stmt = $db->query($sql);
$count = $stmt->fetchColumn();

print "<p class='btn btn-info' >  <span class='btn btn-success' >".   $count . " </span> lesgevers  </p>";

  ?>

 </div>
 </article>

 <article class="col-sm-4 p-3">
 <div class="card p-4">
 <?php 

$sql = "SELECT COUNT(*) FROM partners";
$stmt = $db->query($sql);
$count = $stmt->fetchColumn();

print "<p class='btn btn-info' >  <span class='btn btn-success' >".   $count . " </span> partners  </p>";

  ?>

 </div>
 </article>


 <article class="col-sm-4 p-3">
 <div class="card p-4">
 <?php 

$sql = "SELECT COUNT(*) FROM history";
$stmt = $db->query($sql);
$count = $stmt->fetchColumn();

print "<p class='btn btn-info' >  <span class='btn btn-success' >".   $count . " </span> history  </p>";

  ?>

 </div>
 </article>

 </section>


 
  
  
   </div>


   
    </main>

    <?php include ('inc/footer.php'); ?>