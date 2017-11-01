<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
       
    </head>
    <body>
        <?php $this->extend('header'); ?>
        <?= $this->Html->css('diary')?>
        <?= $this->Html->css('foundation')?>
        <?= $this->Html->css('foundation.min')?>
        <?= $this->Html->script('js/foundation.min')?>
        <?= $this->Html->script('js/foundation')?>

<div class="grid-x grid-padding-x align-center"><!--align center-->
    <div class="cell small-8 cell ">    
    <h1>Here are the events happened in the last 24 hours :</h1>
    </div>
    <div class="cell small-8 cell ">    
        <table>
            <tr>
                <th>Date</th>
                <th>Event</th>
                <th>Coordinate</th>
                <!--On ajoutera une colonne pour mettre une image du perso impliqué dans l'évènement-->
            </tr>
            <?php
            foreach ($event as $i){
                
            echo "<tr>";
                echo "<td>"; echo $i['date']; echo "</td>";
                echo "<td>"; echo $i['name']; echo "</td>";
                echo "<td>"; echo "("; echo $i['coordinate_x']; echo(","); echo $i['coordinate_y']; echo ") </td>";
            echo "</tr>";
            
            }?>
        </table>
    </div>
        <div class="cell small-8 cell ">    
        <?= $this->Html->link("go to the game",["controller"=>"Arenas","action"=>"fighter"]);?>
        </div>
</div>
    </body>
   
</html>
        