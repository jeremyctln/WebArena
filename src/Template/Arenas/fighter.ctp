<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>      
    </head>
    
    <body>
        
        <?= $this->Html->css('guild')?>
        <?= $this->Html->css('header')?>
        <?= $this->Html->css('sight')?>
        <?= $this->Html->css('foundation')?>
        <?= $this->Html->css('foundation.min')?>
        <?= $this->Html->script('js/foundation.min')?>
        <?= $this->Html->script('js/foundation')?>
        
        <?php $this->extend('header'); ?>
        <nav class="hover-underline-menu" data-menu-underline-from-center>
            <ul class="menu align-center">
              <li><a href="login">Login</a></li>
              <li><a href="diary">diary</a></li>
              <li><a href="sight">Game</a></li>
              <li><a href="guild">Guilds</a></li>
              <li><a href="home">Home</a></li>
            </ul>
        </nav>
        
<div class="grid-x grid-padding-x align-center"><!--align center-->
    
    <div class="cell small-8 cell" style = "color: gold; background-color: grey;">
        <?php echo $infoCreation ?>
    </div>
    
    <div class="cell small-8 cell ">
        <h1>Enter the name of the fighter to play : </h1>
    </div>

        <div class="cell small-8 cell ">
            
        <?php echo $this->Form->create('post');?>
        
        
        <?php echo $this->Form->control('Name',[ 'name' => 'field', 'value' => '']);?>

   <!--         <div class="button" style="width: 223px; height:77px; font-size: 25px;"> -->
        <?php echo $this->Form->button('ok',[ 'name' => 'ValidationButton', 'value' => 'choisir', 'class' => 'buttonSize']);?>
    <!--    </div>-->
    </div>
    
    <div class="cell small-8 cell ">
        <h1>Create a new fighter : </h1>
    </div>
        <div class="cell small-8 ">
        <?php
        echo $this->Form->control('Name',[ 'name' => 'nameField', 'value' => 'create']);
        ?>
        
  <!--      <div class="button" style="width: 223px; height:77px; font-size: 25px;">-->
            <?php
            echo $this->Form->button('ok',[ 'name' => 'ValidationButton', 'value' => 'validName', 'class' => 'buttonSize']);
            ?>
  <!--      </div> -->
        </div>
        <div class="cell small-9 ">
        <h1>Existing fighters :</h1>
        <ul class="vertical menu">
        <?php
        foreach ($listCharac as $p) {
        ?>
        
            <li class="persoList"><table>
      
         
        <?php
        echo "<tr>";
                echo "<td>"; echo "Name :"; echo $p['name']; echo "</td>";
                echo "<td>"; echo "Level :"; echo $p['level']; echo "</td>";
                echo "<td>"; echo "Sight :"; echo $p['skill_sight']; echo "</td>";
                echo "<td>"; echo "Strength :"; echo $p['skill_strength']; echo "</td>";
                echo "<td>"; echo "Health max :"; echo $p['skill_health']; echo "</td>";
                echo "<td>"; echo "Current health :"; echo $p['current_health']; echo "</td>";
            echo "</tr>";
        ?></table>
        </li>
        
        <?php }
        echo $this->Form->end();?>
         </ul>
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


