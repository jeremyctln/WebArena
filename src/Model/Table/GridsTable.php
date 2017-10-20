<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

/**
 * Description of GridTable
 *
 * @author jeremy_pc
 */
class GridsTable extends Table {
    
    public function getWidth(){
        return 10;
    }
    
    public function getHeight(){
        return 15;
    }
    
    public function getPosXFighter(){
        //get the pos X of the player
        $query = TableRegistry::get('players')->find();
        $fighterPosX = $query->find()->extract('coordinate_x');
        return $fighterPosX;          
    }
    
    public function getPosYFighter(){
        $query = TableRegistry::get('players')->find();
        $fighterPosY = $query->find()->extract('coordinate_y');
        return $fighterPosY; 
    }
    
    public function getPosFighter(){//ADD FOR THE USER ID TO ONLY SHOW HIS POSITION
        $query = TableRegistry::get('fighters')->find();
        $fighterPos = $query->select(['id','coordinate_x' ,'coordinate_y']);
        return $fighterPos;
        
    }


    //put your code here
}
