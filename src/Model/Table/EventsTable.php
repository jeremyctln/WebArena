<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class EventsTable extends Table
{
    //create a new tuple when an event occurs
    public function setEvent($FighterName, $posX, $posY, $eventName) {
        $query = TableRegistry::get('events')->find();
        $id=$query->select(['id']);
        
        insert('events', ['id' => max($id)+1, 'name' => $FighterName + $eventName, 'date' => new DateTime('now'),
               'coordinate_X' => $posX, 'coordinate_Y' => $posY]
                )->execute();
    }
   
    //quand on se connecte, avant d'afficher tous les évènements, supprime les évènements qui ont eu lieu il y a plus de 24h
    public function cancelEvents() {
        $query2 = TableRegistry::get('events')->find();
        $query2->delete('events', ['date <' => DateTime('now')])->execute();
        
    }
    
    //Récupérer les infos de la table sous forme d'array (sauf l'id)
    public function takeEvents() {
        $query3 = TableRegistry::get('events')->find();
        $tableEvents=$query3->select(['name','date','coordinate_x','coordinate_y']);
        return $tableEvents;
    }
            
}

