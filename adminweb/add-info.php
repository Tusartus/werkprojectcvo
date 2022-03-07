
<?php 
  session_start();

  include ('../includes/connect.php');

 include ('inc/header.php'); 
 include ('inc/navbar.php');

 //protect index page only for login as admin role in users databank
 require_once( "config/if-loggin.php");

 include_once "includes/config.inc.php";

 

 //toevoegen  via form 
if($_POST){
    $q= new Infogegeven($_POST);
 
    $formerrors = $q->validate();
 
    if(empty($formerrors)){
      
       $q->save();
       unset($q);

     

    }
 }


 ?>




    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
            <a class="text-info p-2" href="view-info.php">  view info gegevens</a>

            
        </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
       
      
        </div>
      </div>

   <div class="col-sm-8">
 
 <h2> add info</h2>
 <hr>
   
 <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
      <?php  include "includes/formInfo.php" ?>

      <div class="form-group">
        <input type="submit" value="Toevoegen" class="btn btn-success" class="form-control" />
      </div>
    </form>
  
  
   </div>

 
  
  
  


   
    </main>

    <?php include ('inc/footer.php'); ?>