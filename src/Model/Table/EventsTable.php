<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class EventsTable extends Table
{
    //create a new tuple when an event occurs
    public function setEvent($FighterName, $posX, $posY, $eventName) {
        $query = TableRegistry::get('events');
        $id=$query->find()->select(['id']);
       
        $query->query()->insert(['name','date', 'coordinate_x', 'coordinate_y'])->values(['name' => $FighterName." ".$eventName, 'date' => new \DateTime(), 'coordinate_x' => $posX, 'coordinate_y' => $posY])->execute();

    }
   
    //quand on se connecte, avant d'afficher tous les évènements, supprime les évènements qui ont eu lieu il y a plus de 24h
    public function cancelEvents() {
        $query2 = TableRegistry::get('events')->find();

        $query2->delete('events', ['date <' => date("Y-m-j H:i:s", mktime(date("H"), date("i"), date("s"), date("m"), date("d") - 1, date("Y")))])->execute();
        
    }
    
    //Récupérer les infos de la table sous forme d'array (sauf l'id)
    public function takeEvents() {
        $query3 = TableRegistry::get('events')->find();
        $tableEvents=$query3->select(['name','date','coordinate_x','coordinate_y']);
        return $tableEvents;
    }
            
}



