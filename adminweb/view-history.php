<?php 
  session_start();

  include ('../includes/connect.php');

 include ('inc/header.php'); 
 include ('inc/navbar.php');

 //protect index page only for login as admin role in users databank
 require_once( "config/if-loggin.php");

 //include classes
 include_once "includes/config.inc.php";


 // opzoeken en afdrukken

$history = History::getAll(['orderby' => 'id DESC']);

 ?>




    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
            
            
        </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
       
      
        </div>
      </div>

   <div class="col-sm-8">
 
 <h2> all history  </h2>
 <hr>
   <table class="table table-striped">
    <thead>
      <tr>
      <th>#</th>
      <th>title</th>
      <th> description</th>
     
      
     
      </tr>
    </thead>
    <tbody>
                             
    <?php if (count($history)): ?>

<?php foreach ($history as $q): ?>
                                <tr>
                                    <td> <?=  $q->getId(); ?> </td>
                                    <td>  <?=  $q->getTitle(); ?></td>
                                    <td> <?=  substr($q->getDescription(), 0, 80); ?>.. </td>
                                   
                                    
                                    
                                </tr>
                                <?php endforeach; ?>

        <?php else: ?>   
          <p>Er werden NIKS gevonden. </p>  
        <?php endif; ?> 
   
    </tbody>
  </table>
  
  
   </div>

 
  
  
  


   
    </main>

    <?php include ('inc/footer.php'); ?>