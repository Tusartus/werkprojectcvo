

<?php   

include ('./includes/connect.php');
//include classes
include_once "includes/config.inc.php";


include 'frontend/header.inc.php';
include_once 'frontend/menu.inc.php';


// opzoeken en afdrukken

$partners = Partner::getAll(['orderby' => 'id DESC']);


 // opzoeken en afdrukken

 $info = Infogegeven::getAll(['orderby' => 'id DESC']);


$history = History::getAll(['orderby' => 'id DESC']);

?>
  

    <div class="wrapper">

        <section class="OneHeader">
            <div class="box-descenter">
                

                <p class="vlo-center"> <?php echo "studiebegeleiding voor zieke kinderen en jongeren uit het basis- en secundair onderwijs";  ?> </p>

            </div>
        </section>

        <section class="uitleg">
            <div class="header-text">
                <p> <?php echo "WAARVOOR KAN JE BIJ ONS TERECHT?"; ?>
                </p>
            </div>
            <div class="boxflex-content">
                <article class="desc-box">
                    <p> <?php echo "
                     School & Ziekzijn is een vrijwilligersorganisatie die zorgt voor individueel onderwijs aan zieke leerlingen.
                    " ?></p>
                    <p><?php echo "
                    Kinderen en jongeren uit de basisschool en het secundair onderwijs (5-18 jaar) die langdurig of vaak afwezig zijn op school door 
                    een ongeval, ziekte, heelkundige ingreep of psychische problemen krijgen kosteloos les thuis en soms in het ziekenhuis.
                    "; ?></p>
                    <p><?php echo "
                    School & Ziekzijn (S&Z) richt zich tot alle zieke jongeren van alle onderwijsnetten uit het gewoon 
                    onderwijs. S&Z staat los van elke politieke en filosofische overtuiging. De missie van S&Z is:
                    -leerachterstand voorkomen en/of wegwerken - isolement doorbreken - zittenblijven vermijden

                    "; ?></p>
                    <p>
                        <?php  
                         print"
                         S&Z bestaat sinds 1982 en heeft in elke Vlaamse provincie en Brussel een autonome afdeling (vzw) met een eigen werking.
                         ";
                        ?>
                    </p>
                </article>
                <article class="img-boxdesc">
                    <img class="img-file" src="https://images.pexels.com/photos/3255543/pexels-photo-3255543.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="img">
                </article>

            </div>
        </section>

        <section class="colfix-box">
            <div class="header-text">
                <p> <?php echo "WAAR KAN JE TERECHT? "; ?></p>
                <p> <?php echo "Selecteer je regio voor meer info en contactgegevens  in jouw buurt. "; ?></p>
            </div>
            <div class="box-drie">
            <?php foreach ($info as $q): ?>
                <article class="boxflex">
                    <h1 class="bg-titleBottom"><?=  $q->getTitle(); ?></h1>
                
                    <p id="adresscontent">
                    <?=  $q->getDescription(); ?>
                    </p>
                    <div class="lk-region">
                        <a target="_blank" id="alinkregion" href="<?=  $q->getLinkurl(); ?>"> <?php print "Ga naar de website"; ?></a>
                    </div>
                </article>
            <?php endforeach; ?>  
              
             
             
            </div>
        </section>

        <section class="partnerSamen">
            <div class="header-text">
            <div class="lignhr"></div>
            <h2> <?php echo "PARTNERS IN DE SAMENWERKING"; ?></h2>
            <div class="lignhr"></div>
            </div>
            
             <aside class="oneside">
             <?php foreach ($partners as $q): ?>
                <div class="rondlink">
                    <a class="rondCirlcelink" target="_blank" href="<?=  $q->getLinkurl(); ?>"> <?=  $q->getName(); ?></a>
                </div>
            <?php endforeach; ?>

              
            
             </aside>
              
        </section>

        
        <section class="history-cont">
        <?php foreach ($history as $q): ?>
            <div class="header-text lgtext">
            <h3><?=  $q->getTitle(); ?></h3>
            </div>
        
            <div class="history-container-fluid">
                <p> <?=  $q->getDescription(); ?> </p>         
            </div>
            <?php endforeach; ?>   
        </section>

       


        <?php  include "frontend/footer.inc.php";     ?>