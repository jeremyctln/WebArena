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
 * Description of SurroundingsTable
 *
 * @author jeremy_pc
 */
class SurroundingsTable extends Table {
    
    public function setSurroundings($posMainFighter, $posEnemyFighter, $posTools){
        $query= TableRegistry::get('surroundings');
        
        //DELETE THE CONTENT IN THE TABLE
        $query->query()->delete()->execute();
        
        //INSERT IN THE TABLE THE MAIN FIGHTER
        foreach ($posMainFighter as $mainFighter){
            $query->query()->insert(['type', 'coordinate_x', 'coordinate_y'])->values(['type' => "mainFighter", 'coordinate_x' => $mainFighter['coordinate_x'], 'coordinate_y' => $mainFighter['coordinate_y'] ])->execute();
            //POSITION AND SIGHT OF THE MAIN FIGHTER
            $posX = $mainFighter['coordinate_x'];
            $posY = $mainFighter['coordinate_y'];
            $sight = $mainFighter['skill_sight'];
        }
        
        //CREATE THE AREA OF SIGHT OF THE USER
        for($y=($posY-$sight);$y<=($posY+$sight);$y++){
            for($x=($posX-$sight);$x<=($posX+$sight);$x++){
                //IN THE CASE OF A ENEMY
                
                $nothing=true;
                if(($x-$posX)+($y-$posY) <= $sight && ($x-$posX)-($y-$posY) <= $sight && -($x-$posX)+($y-$posY) <= $sight && -($x-$posX)-($y-$posY) <= $sight){
                    
                    
                    foreach ($posEnemyFighter as $enemyPos){
                        if($x == $enemyPos['coordinate_x'] && $y == $enemyPos['coordinate_y']){
                            $query->query()->insert(['type', 'coordinate_x', 'coordinate_y'])->values(['type' => "EnemyFighter", 'coordinate_x' => $enemyPos['coordinate_x'], 'coordinate_y' => $enemyPos['coordinate_y'] ])->execute();
                            $nothing=false;                        
                        }   
                    }
                    foreach ($posTools as $tools){
                        if($x == $tools['coordinate_x'] && $y == $tools['coordinate_y']){
                            $query->query()->insert(['type', 'coordinate_x', 'coordinate_y'])->values(['type' => "tool", 'coordinate_x' => $tools['coordinate_x'], 'coordinate_y' => $tools['coordinate_y'] ])->execute();
                            $nothing=false;                        
                        } 
                    }
                    if($nothing==true){
                        if($posX !=$x || $posY != $y){
                            $query->query()->insert(['type', 'coordinate_x', 'coordinate_y'])->values(['type' => "ground", 'coordinate_x' => $x, 'coordinate_y' => $y])->execute();
                        }
                    }
                }
                               
            }
        }
        
       
       
            
    }
    
    public function getSurroundings(){
        $query= TableRegistry::get('surroundings')->find();
        return $query;
    }
    
    //put your code here
}
