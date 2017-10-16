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
        <?php $this->extend('header'); ?>
        
        <?php
        // put your code here
        for ($i=0;$i<$gridHeight;$i++){
            for($j=0;$j<$gridWidth;$j++){
                foreach($posPlayer as $player ){
                //    if($cle == "coordinate_y" and $player == $i ){
                //        echo $player; echo "yes";
                //    } 
                   if ($player["coordinate_x"]==$j && $player["coordinate_y"]==$i){
                    echo $this->Html->image("perso".$player["id"].".png", ['width'=> '25', 'height'=>'25']);
                                      
                   }else{
                       echo $this->Html->image("herbe.png", ['width'=> '25', 'height'=>'25']);
                       
                   }
                
                }
            }echo "<br/>";
        }
        
        
        $this->Html->form()
        
        ?>
    </body>
</html>

