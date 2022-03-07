<?php

include 'includes/connect.php';


if(isset($_POST) & !empty($_POST)){

     //validate and input 
      
    // PHP Form Validations
    if(empty($_POST['name'])){$errors[] = "Name Field is Required";}
    
    if(empty($_POST['email'])){$errors[] = "Email Field is Required";}
    if(empty($_POST['bericht'])){$errors[] = "Bericht  Field is Required";}
    if(empty($_POST['provencie'])){$errors[] = "Provencie Field not selected";}
    
    
  

     if(empty($errors) )  {
      
        $sql = "INSERT INTO contacts (  name, email, provencie,bericht ) VALUES ( :name,  :email, :provencie, :bericht )";
        $result = $db->prepare($sql);
        $values = array( 
                        ':name'    => strip_tags($_POST['name']),
                        
                         ':email'    => strip_tags($_POST['email']),
                         ':provencie'  => strip_tags($_POST['provencie']),
                        ':bericht'  => strip_tags($_POST['bericht']),                   
                    
                        );
    
        $res = $result->execute($values) or die(print_r($result->errorInfo(), true));
        if($res){
            $cid = $db->lastInsertID();
            $messages[] = "Message has been succesfully added";
            header("location: contact.php");
        }else{
            $messages[] = "Failed to send contact form ...";
    
            header("location: contact.php");
        }
       
      }   
    //end if empty erros[] and mssages[]


    }    




  
  


?>




<?php   
include 'frontend/header.inc.php';
include_once 'frontend/menu.inc.php';
?>

    <div class="wrapper">

        
        <section class="OneHeader">
            <div class="box-descenter">

                <p class="vlo-center">Contact  </p> <br>
                <div class="flashContact">
                <?php
                        if(!empty($errors)){
                            echo "<div class='alert-error'>";
                         
                            foreach ($errors as $error) {
                                echo "<span class='spane-ok'></span>&nbsp;". $error ."<br>";
                            }
                            echo "</div>";
                        }
                    ?>
           </div>
                <div class="flashContact">
                <?php
                        if(!empty($messages)){
                            echo "<div class='alert-error'>";
                            foreach ($messages as $message) {
                                echo "<span class='span-ok'></span>&nbsp;". $message ."<br>";
                            }
                            echo "</div>";
                        }
                    ?>
                </div>
           

            </div>
        </section>

        <section class="contactus">

        

            <div class="container-form">

           


                <form  method="post">
                  <div class="row">
                    <div class="colBoxName">
                      <label for="fname">Naam : </label>
                    </div>
                    <div class="colInput">
                      <input type="text" id="fname" name="name" placeholder="voornaam + achternaam.." value="<?php if(isset($_POST['name'])){ echo $_POST['name'];} ?>">
                    </div>
                  </div>

                  <div class="row">
                    <div class="colBoxName">
                      <label for="email">Email: </label>
                    </div>
                    <div class="colInput">
                      <input type="email" id="lemail" name="email" placeholder=" ..@gmail.com " value="<?php if(isset($_POST['email'])){ echo $_POST['email'];} ?>">
                    </div>
                  </div>
                 
                  <div class="row">
                    <div class="colBoxName">
                      <label for="country">Provencie: </label>
                    </div>
                    <div class="colInput">
                      <select id="country" name="provencie">
                        <option value="Antwerpen">Antwerpen</option>
                        <option value="Brussel-Vlaams-Brabant"> Brussel-Vlaams-Brabant</option>
                        <option value="Limburg">Limburg</option>
                        <option value="oost-Vlaanderen">Oost-Vlaanderen</option>
                        <option value="West-Vlaanderen">West-Vlaanderen</option>
                      </select>
                    </div>

                  </div>

                  <div class="row">
                    <div class="colBoxName">
                      <label for="subject">Bericht: </label>
                    </div>
                    <div class="colInput">
                      <textarea id="subject" name="bericht" placeholder="Write something.." style="height:220px" > 
                      <?php if(isset($_POST['bericht']) ){ echo $_POST['bericht'];} ?>
                    </textarea>
                    </div>
                  </div>
                  <div class="row">
                    <input type="submit" value="Submit">
                  </div>
                </form>
              </div>


        </section>


      


        <section class="footer">
            <footer class="content">
                   
                <ul class="menuUl">
                    <li>
                        <a class="btnLink" href="over-ons.html"> over ons </a>
                    </li>
                    <li>
                        <a class="btnLink"  href="lesgever.html"> lesgever </a>
                    </li>
                    <li>
                        <a  class="btnLink"  href="werking.html"> werking </a>
                    </li>
                    <li>
                        <a class="btnLink"  href="helpen.html"> helpen en steunen </a>
                    </li>
                </ul>
                <div class="madeby">
                    <p> 
                        privacy 2022 made with love icon <i> </i> by <a class="btnLink"  href="https://github.com/Tusartus" target="_blank">Arthus </a>
                    </p>
                </div>
            </footer>
        </section>



      </div>  



      <script src="js/main.js"></script>
</body>
</html>    