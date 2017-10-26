<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>      
    </head>
    
    <body>
        <h1>Create a new character : </h1>
        
        <?php
        
        echo $this->Form->create('post');
        ?>

        <div class="small-3 cell">
        <?php
        echo $this->Form->control('Name',[ 'name' => 'nameField', 'value' => 'create']);
        ?>
        </div>
        <?php
        echo $this->Form->button('ok',[ 'name' => 'validationButton', 'value' => 'validName']);
        ?>

        
        <h1>Choose one of your characters already existing :</h1>
        <ul class="vertical menu">
        <?php
        foreach ($listCharac as $p) {
        ?>
        
            <li class="persoList"><table>
        <?php 
        echo $this->Form->button('Select',['name' => 'validationButton','value' => $p['id']]);
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
        
    </body>
    
    
</html>

