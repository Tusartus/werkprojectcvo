
<?php   
include ('./includes/connect.php');
//include classes
//include_once "adminweb/includes/config.inc.php";


include 'frontend/header.inc.php';
include_once 'frontend/menu.inc.php';
?>
    <div class="wrapper">

        
        <section class="OneHeader">
            <div class="box-descenter">

                <p class="vlo-center">Lesgever  </p>
               

            </div>
        </section>

        <section class="boxContent">

        
        <?php 


$sql = "SELECT * FROM lesgevers ";
$result = $db->prepare($sql);
$result->execute();      
$res = $result->fetchAll(PDO::FETCH_ASSOC);
 foreach ($res as $p) {
                                


?>  
           <div class="over-box">

            <article class="desciptionBox">
                <h1> <?php echo $p['title']; ?> </h1>
                <div class="contentArticle">
                    <p> <?php echo $p['description']; ?></p>
                    
                </div>

            </article>
            <article class="imgBox">
              <img class="imgAlgemeen" src="./media-lesgever/<?php echo $p['pic']; ?>" alt="img" >
            </article>

           </div>

    <?php } ?>  


        </section>
        <hr>
    

        <?php  include "frontend/footer.inc.php";  ?>