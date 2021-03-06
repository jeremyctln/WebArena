<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Web Arena</title>
       
    </head>
    <body>
    
    <?= $this->Html->css('header')?>
    <?= $this->Html->css('guild');?>
    <?= $this->Html->css('sight') ?> 
    <?= $this->Html->css('foundation.min') ?> 
    <?= $this->Html->css('foundation') ?> 
    
    <div class="title">
    <h1>Web Arena <small>Let's play</small></h1>
    <div id="nav_sight">
        <nav class="hover-underline-menu" data-menu-underline-from-center>
            <ul class="menu align-center">
                <li><a href="login">Login</a></li>
                <li><a href="fighter">Fighter</a></li>
                <li><a href="diary">Diary</a></li>
                <li><a href="guild">Guilds</a></li>
            </ul>
        </nav>
    </div>
    </div>
    
    <div id="playground">
        
        <?php   //CATCH THE COORD OF THE CLICK

            if (isset($_POST["x"]) && isset($_POST["y"])) {
            $x = htmlspecialchars($_POST["x"]); // GRAB AND SECURE X POST VAL
            $y = htmlspecialchars($_POST["y"]); // GRAB AND SECURE Y POST VAL
            ///

            $jsonReturn = array("error_code" => 99, "data" => array()); // CREATE JSON RESPONSE TEMPLATE
            try {
                // ALWAYS CONTROL WHAT YOU GOT FROM THE USER BECAUSE USER IS DUMB
                if ($x < 0 || $x > 14) {
                    throw new Exception("Wrong X value");
                }

                if ($y < 0 || $y > 10) {
                    throw new Exception("Wrong Y value");
                }

            } catch (Exception $e) {
                error_log($e->getMessage());        

            }
        }   
        ?> 
        
    </div>
    
        <div class="grid-x grid-padding-x" style="margin-left:120px;">
      
       <div class="cell small-2 flex-container flex-dir-column"id="infoFighter" >
            <div class="callout primary flex-child-shrink" id="infoFighter">
                <ul class="vertical menu align-center">
                  <li>Level: <?= $levelFighter; ?></li>
                </ul>
            </div>
       
           
            <div class="callout primary flex-child-shrink" id="infoFighter">
                <ul class="vertical menu align-center">
                    <li>XP: <?= $xpFighter; ?></li>
                </ul>
            </div>
            <div class="callout primary flex-child-shrink" id="infoFighter">
                <ul class="vertical menu align-center">
                    <li>Health: <?= $currentHealth; ?>/<?= $healthFighter; ?></li>
                </ul>
                
            </div>
            <div class="callout primary flex-child-shrink" id="infoFighter">
                <ul class="vertical menu align-center">
                    <li>Strength:<?= $strengthFighter; ?></li>
                </ul>
            </div>
            <div class="callout primary flex-child-shrink" id="infoFighter">
                <ul class="vertical menu align-center">
                    <li>Sight:<?= $sightFighter; ?></li>
                </ul>
                
            </div>
            
            <div class="callout primary flex-child-auto" id="infoFighter">
                <ol class="vertical menu align-center">
                    <li>INVENTORY</li>
                    <?php foreach($toolList as $tool){ 
                        if($tool['type'] == "strength" && $tool['bonus'] == 1){
                            $name = "Dagger";
                        }elseif($tool['type'] == "strength" && $tool['bonus'] == 2){
                            $name = "Axe";
                        }elseif($tool['type'] == "strength" && $tool['bonus'] == 3){
                            $name = "Excalibur";
                        }elseif($tool['type'] == "health" && $tool['bonus'] == 1){
                            $name = "Helmet";
                        }elseif($tool['type'] == "health" && $tool['bonus'] == 2){
                            $name = "Shield";
                        }elseif($tool['type'] == "health" && $tool['bonus'] == 3){
                            $name = "Armor";
                        }elseif($tool['type'] == "sight" && $tool['bonus'] == 1){
                            $name = "Torch";
                        }elseif($tool['type'] == "sight" && $tool['bonus'] == 2){
                            $name = "Lamp";
                        }elseif($tool['type'] == "sight" && $tool['bonus'] == 3){
                            $name = "Light fist";
                        }
                    ?>
                    <li> <?php echo $name;echo (" : "); echo $tool['type']; echo (" ("); echo $tool['bonus']; echo (") ")?></li>
                   <?php } ?>
                </ol>
                
                
            </div>
    </div>
<div class="cell small-6">
  <section id="playGround">
        <table>
            <?php  
            
           $fighter=false;
        for($y = 0; $y < 10; $y++) {
            echo "<tr>";

            for ($x = 0; $x < 15; $x++) {
                echo "<td data-x='$x' data-y='$y' class='zone'>";
                $darkground=true;
                foreach($gridDisplay as $display ){
                    
                    if ($display["coordinate_x"]==$x && $display["coordinate_y"]==$y){// ADD THE CONDITION FOR ID=1
                        if($display['type'] == "mainFighter"){
                            echo $this->Html->image("perso1.png", ['width'=> '60', 'height'=>'60']);
                            $darkground = false;
                        }elseif($display['type'] == 'EnemyFighter'){
                            echo $this->Html->image("perso2.png", ['width'=> '60', 'height'=>'60']);
                            $darkground = false;
                        }elseif($display['type'] == 'tool'){
                            echo $this->Html->image("tool.png", ['width'=> '60', 'height'=>'60']);
                            $darkground = false;
                        }elseif($display['type'] =='ground'){
                            echo $this->Html->image("ground.png", ['width'=> '60', 'height'=>'60']);
                            $darkground = false;
                        }
                    }                       
                }
                if($darkground==true){
                    echo $this->Html->image("darkground.png", ['width'=> '60', 'height'=>'60']);
                }
            }
            echo "</td>";
        echo "</tr>";
        }
            ?>
        </table>
    </section>     
         
</div>
       <div class="cell small-3 align-self-top" id="infoFighter">
           <?php
           //PART WHEN THE PLAYER WANT TO MOVE AND TO ATTACK
            echo $this->Form->create('post');?>
           <div id="buttonUp">
        <!--        <div class="button" style="width: 223px; height:77px; font-size: 25px; cursor: pointer;">-->
                     <?= $this->Form->button('Go Up', ['value' => 'up', 'name' => 'touche', 'class' => 'buttonSize']); ?>
        <!--        </div> -->
           </div>
        <!-- 'class' => 'classUp'    -->
           <div id="buttonLeftRight">
        <!--    <div class="button" style="width: 215px; height:77px; font-size: 25px; cursor: pointer;">-->
            <?php echo $this->Form->button('left',  ['value' => 'left', 'name' => 'touche', 'class' => 'buttonSize']);  ?>
             
     <!--       <div class="button" style="width: 215px; height:77px; font-size: 25px; cursor: pointer;">-->
            <?php echo $this->Form->button('right', ['value' => 'right', 'name' => 'touche', 'class' => 'buttonSize']);?>
       <!--     </div>-->
       <!--    </div><!-- , 'class' => 'classLeft', , 'class' => 'classRight'-->
       </div>     
            <div id="buttonDown">
     <!--          <div class="button" style="width: 223px; height:77px; font-size: 25px; cursor: pointer;"> -->
            <?php
                echo $this->Form->button('down', ['value' =>'down', 'name' => 'touche', 'class' => 'buttonSize']);
            ?><!--, 'class' => 'classDown-->
   <!--            </div>-->
           </div>
            <div class="callout primary flex-child-shrink" id="infoFighter">
                <ul class="vertical menu align-center">
                    <li>Points:<?= $skillPoint; ?></li>
                </ul>
            </div>
           <div id="buttonsSill">
           <?php
                echo $this->Form->button('strength', ['value' => 'strength', 'name' => 'touche', 'class' => 'classSkills']);
                echo $this->Form->button('health', ['value' => 'health', 'name' => 'touche', 'class' => 'classSkills']);
                echo $this->Form->button('sight', ['value' => 'sight', 'name' => 'touche', 'class' => 'classSkills']);
            ?>
           </div>
           <div class="callout primary flex-child-shrink" id="infoFighter">
                <ul class="vertical menu align-center">
                    <li>INFORMATIONS:<?php echo(" "); echo $state_information; ?></li>
                </ul>
            </div>
            <?php
                echo $this->Form->button('Tools', ['value' =>'tool', 'name' => 'touche', 'class' => 'buttonSize']);
            ?>
        
           <?php
                echo $this->Form->end();
           ?>
       </div>
</div>
    
   
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      
 
 <script type="text/javascript">

    $(function(){

        /**
            WHEN WE CLICK ON AN ITEM
         */
        $(document).on("click", ".zone", function(e){
            e.preventDefault();

            var pX = $(this).data("x"); 
            var pY = $(this).data("y");

            console.log("x=" + pX + " , y=" + pY);
            
            $px = pX;
            $py = pY;

           
        });

    });

   </script>  
   

    <div class="grid-x grid-margin-x" style="color: white; background-image: url('../img/footer1.jpg'); height: 320px;">
         <div class="small-4 cell">
         <p>Developper :</p>
     <ul>
      <li>Jeremy Catelain</li>
      <li>Cécile Coton</li>
      <li>Etienne Hensgen</li>
      <li>Stanislas Pinto</li>
   </ul>
        </div>
        <div class="auto cell">
         <p>Option:</p>
             <ul>
                 <li> Option A : Advanced management of the fighters and equipment</li>
                 <li> Option B: Communication management and Guild </li>
                 <li> Option G : Foundation 6</li>
             </ul>
        </div>
        <div class="auto cell">
            <p>Link:</p>
            <ul>
                <li>Git: https://github.com/jeremyctln/WebArena/tree/master</li>
            </ul>
        </div>
     </div>

 
    </body>
</html>

