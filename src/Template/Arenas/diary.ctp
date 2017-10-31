<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
       
    </head>
    <body>
        <h1>Here are the events happened in the last 24 hours :</h1>
        <table>
            <tr>
                <th>Date</th>
                <th>Event</th>
                <th>Place</th>
                <!--On ajoutera une colonne pour mettre une image du perso impliqué dans l'évènement-->
            </tr>
            <?php
            foreach ($event as $i){
                
            echo "<tr>";
                echo "<td>"; echo $i['date']; echo "</td>";
                echo "<td>"; echo $i['name']; echo "</td>";
                echo "<td> ("; echo $i['coordinate_x']; echo(","); echo $i['coordinate_y']; echo ") </td>";
            echo "</tr>";
            
            }?>
        </table>
        
        <?= $this->Html->link("go to the game",["controller"=>"Arenas","action"=>"fighter"]);?>
        
    </body>
   
</html>
        
