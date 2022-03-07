
<?php 
  session_start();

  include ('../includes/connect.php');

 include ('inc/header.php'); 
 include ('inc/navbar.php');

 //protect index page only for login as admin role in users databank
 require_once( "config/if-loggin.php");

 include_once "includes/config.inc.php";




 
  



if(isset($_GET['id'])){  

$id = $_GET['id'];
$sql = "SELECT * FROM partners WHERE id=:id";
$result = $db->prepare($sql);
$result->execute(array(':id'=>$id));
$qot = $result->fetch(PDO::FETCH_ASSOC);

extract((array)$qot);

}

 ?>




    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
            <a class="text-info p-2" href="view-partner.php">  view partners</a>
            
        </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
       
      
        </div>
      </div>

   <div class="col-sm-8">
 
 <h2> add partner </h2>
 <?php echo $qot['id']; ?>
 <hr>
 
   
 <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
 
 <input type="hidden" name="id" value="<?php echo $qot['id']; ?>">
 
 <div class="form-group">
  <label for="name">Name</label>
  <input type="text" name="name" id="name" class="form-control" value="<?php if(isset($qot['name'])){ echo $qot['name'];} ?>" readonly />
 
</div>

<div class="form-group">
  <label for="name"> url link of partner</label>
  <input type="text" name="linkurl" id="linkurl" class="form-control" value="<?php if(isset($qot['linkurl'])){ echo $qot['linkurl'];} ?>"  readonly />
 
</div>



    
    </form>
  
  
   </div>

 
  
  
  


   
    </main>

    <?php include ('inc/footer.php'); ?>