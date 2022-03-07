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

$info = Infogegeven::getAll(['orderby' => 'id DESC']);


 ?>




    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
            <a class="text-info p-2" href="add-info.php"> add info</a>
            
        </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
       
      
        </div>
      </div>

   <div class="col-sm-8">
 
 <h2> all gegevens  </h2>
 <hr>
   <table class="table table-striped">
    <thead>
      <tr>
      <th>#</th>
      <th>title</th>
      <th> description</th>
      <th> url link </th>
      
      <th>Operations</th>
      </tr>
    </thead>
    <tbody>
                           
    <?php if (count($info)): ?>

<?php foreach ($info as $q): ?>
                                <tr>
                                    <td> <?=  $q->getId(); ?> </td>
                                    <td>  <?=  $q->getTitle(); ?></td>
                                    <td>  <?=  $q->getDescription(); ?></td>
                                    <td> <?=  $q->getLinkurl(); ?> </td>
                                   
                                    <td> <a class="text-success" href="delete-info.php?id=<?=  $q->getId(); ?>">Delete</a></td>
                                    
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