<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
       
    </head>
    <body>
        
        <?= $this->Html->css('diary')?>
        <?= $this->Html->css('foundation')?>
        <?= $this->Html->css('foundation.min')?>
        <?= $this->Html->script('js/foundation.min')?>
        <?= $this->Html->script('js/foundation')?>
        
        <?php $this->extend('header'); ?>
        <nav class="hover-underline-menu" data-menu-underline-from-center>
            <ul class="menu align-center">
              <li><a href="login">Login</a></li>
              <li><a href="fighter">Fighter</a></li>
              <li><a href="sight">Game</a></li>
              <li><a href="guild">Guilds</a></li>
              <li><a href="home.ctp">Home</a></li>
            </ul>
        </nav>
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
    <div class="cell small-8 cell " style="font-size: 30px;">    
        <?= $this->Html->link("go to the game",["controller"=>"Arenas","action"=>"fighter"]);?>
        </div>
</div>
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
        