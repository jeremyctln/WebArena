<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
       
    </head>
    <body>
        <?= $this->Html->css('sight') ?> 
        
        <?php $this->extend('header'); ?>
           
            
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
  <?php
        //PART WHEN THE PLAYER WANT TO MOVE AND TO ATTACK
        echo $this->Form->create('post');
        echo $this->Form->button('up', ['value'=> 'up', 'name'=>'toucheMove']);
        echo $this->Form->button('right', ['value'=> 'right', 'name' => 'toucheMove']);
        echo $this->Form->button('left',  ['value'=> 'left', 'name'=> 'toucheMove']);
        echo $this->Form->button('down', ['value'=>'down', 'name' => 'toucheMove']);
        echo $this->Form->end();
        
        //FORM HIDDEN ASK TO THE TEACHER
        /*
        echo $this->Form->hidden('pY', ['value'=> $py]);
        echo $this->Form->hidden('pX', ['value'=> $px]);
        echo $this->Form->end();*/
    
  ?>
        
        
        
            
        
    </body>
</html>

