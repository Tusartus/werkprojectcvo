
<?php   

include ('./includes/connect.php');



include 'frontend/header.inc.php';
include_once 'frontend/menu.inc.php';

?>

    <div class="wrapper">

        
        <section class="OneHeader">
            <div class="box-descenter">

                <p class="vlo-center"> <?php print "OVER ONS";  ?> </p>
               

            </div>
        </section>

        <section class="boxContent">

              
        <?php 


$sql = "SELECT * FROM overons ";
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
              <img class="imgAlgemeen" src="./media-overons/<?php echo $p['pic']; ?>" alt="img" >
            </article>
           

           </div>

    <?php } ?>  


           

        </section>
        <hr>
        <section class="strategie">
            <div class="header-text">
            <h1> <?php print "STRATEGIE";  ?> </h1>
            </div>
            <p>
         <?php
         echo "
         Men wil haar visie afstemmen op de actuele realiteit in het onderwijs en de maatschappij. Het bereiken van 
         zoveel mogelijk zieke leerlingen en het kunnen aanbieden van op maat gemaakte studiebegeleiding 
         vergt een actief beleid: informeren, vrijwilligersbeleid en fondsenwerving.
         ";
         ?>
            </p>

        </section>

        
        <?php  include "frontend/footer.inc.php";  ?>