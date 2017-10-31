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
    
<div class="grid-x grid-padding-x align-center"><!--align center-->

<div class="cell small-8 cell ">
    <h1>Choose your fighter : </h1>
</div>

    <div class="cell small-8 cell ">
        
    <?php echo $this->Form->create('post');?>
    
    
    <?php echo $this->Form->control('Name',[ 'name' => 'field', 'value' => '']);?>

<!--         <div class="button" style="width: 223px; height:77px; font-size: 25px;"> -->
    <?php echo $this->Form->button('ok',[ 'name' => 'ValidationButton', 'value' => 'choisir', 'class' => 'buttonSize']);?>
<!--    </div>-->
</div>

<div class="cell small-8 cell ">
    <h1>Create a new character : </h1>
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
    <h1>Choose one of your characters already existing :</h1>
    <ul class="vertical menu">
    <?php
    foreach ($listCharac as $p) {
    ?>
    
        <li class="persoList"><table>
<!--      <div class="button" style="width: 223px; height:77px; font-size: 25px;"> -->
    <?php echo $this->Form->button('Select',['name' => 'ValidationButton','value' => $p['id'], 'class' => 'buttonSize']);?>
    </div>
     
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
</body>


    
</html>

