<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class FightersTable extends Table
{

    
    public function getBestFighter(){
        $figterlist=$this->find("all")->first();//suppression du order entre all et first
        //$figterlist= $this->query("SELECT * FROM fighters;");
        return $figterlist;
    }
              
    public function getFighter($fighterID){
        
        $table=$query = TableRegistry::get('fighters')->find();
        //$fighter = $query->select;
        foreach ($table as $t) {
            
        }
    }
    
    public function getFighterName($fighterID){
        
        $query = TableRegistry::get('fighters')->find();
        $name=$query->select(['name'])->where(['id =' => $fighterID ]);
        
        return debug($name);
    }
    
    
    public function fighterAttack($idPlayer, $idFighter, $direction){
        $query = TableRegistry::get('fighters')->find();
        
        // recuperer la vie du joueur, la force, le level, xp, current health, next_action 
        
        $fighterPos = $query->select(['id','coordinate_x' ,'coordinate_y'])->where(['id =' => $idFighter ]);
        
        //faire en fonction de la direction l'attack pour recuperer la position du fighter enemi
       // faire reduire la vie de de l'enemi
        //faire le cas d'un attack reussi 
        //verification que le joureur est toujour en vie. sinon deleter le joureur de la BDD
        
        //quand on est dans l'autre joueur, faire une verification que le joueur enemie est toujours en vie.
        
        
        
    }
            
        
    public function fighterMove($idPlayer, $idFighter, $direction){
        $query = TableRegistry::get('fighters')->find();
        $query2 = TableRegistry::get('fighters')->find();
         
        $fighterPos = $query->select(['id','coordinate_x' ,'coordinate_y'])->where(['id =' => $idFighter ]);
        
        $fighterList = $query2->select(['id', 'player_id', 'coordinate_x', 'coordinate_y']);
       
              
        
        foreach($fighterList as $fighterL){
            
            foreach ($fighterPos as $fighterP){
                
                if($direction == "up" ){
                
                    if($fighterP['coordinate_y']-1 == $fighterL['coordinate_y'] && $fighterP['coordinate_x'] == $fighterL['coordinate_x']){
                        return "fighter";
                    }else{
                        //IN THE CASE OF THE FIGHTER GO OUT OF THE GRID
                        if($fighterP['coordinate_y']-1 < 0){
                            return false;
                        }else{
                            $newPos = $fighterP['coordinate_y']-1;
                        }
                    }
                                  
                }elseif($direction == "right"){
                    if($fighterP['coordinate_x']+1 == $fighterL['coordinate_x'] && $fighterP['coordinate_y'] == $fighterL['coordinate_y']){
                        return "fighter";
                    }else{
                        //THE FIGHTER GO OUT ON THE RIGHT OF THE GRID
                        if($fighterP['coordinate_x']+1 > 14){
                            return false;
                        }else{
                            $newPos = $fighterP['coordinate_x']+1;
                        }
                        
                    }
                }elseif($direction == "left"){
                    if($fighterP['coordinate_x']-1 == $fighterL['coordinate_x'] && $fighterP['coordinate_y'] == $fighterL['coordinate_y']){
                        return "fighter";
                    }else{
                        //THE FIGHTER GO OUT OF THE GRID ON THE LEFT
                        if($newPos == $fighterP['coordinate_x']-1<0){
                            return false;
                        }else{
                            $newPos = $fighterP['coordinate_x']-1;
                        }
                        
                    }            
                }elseif($direction == "down"){
                    if($fighterP['coordinate_y']+1 == $fighterL['coordinate_y'] && $fighterP['coordinate_x'] == $fighterL['coordinate_x']){
                        return "fighter";
                    }else{
                        if($newPos == $fighterP['coordinate_y']+1 > 14){
                            return false;
                        }else{
                            $newPos = $fighterP['coordinate_y']+1;
                        }
                        
                    }
                }

                
            }
            
        }
        
        //NO ONE HAS BEEN FOUND
        echo $newPos;

        if($direction == "up" ){
            $query->update()->set(['coordinate_y' => $newPos])->where(['id' => $idFighter])->execute();
            

        }elseif($direction == "right"){
            $query->update()->set(['coordinate_x' => $newPos])->where(['id' => $idFighter])->execute();
            
        }elseif($direction == "left"){
            $query->update()->set(['coordinate_x' => $newPos])->where(['id' => $idFighter])->execute();
            
        }elseif($direction == "down"){
            $query->update()->set(['coordinate_y' => $newPos])->where(['id' => $idFighter])->execute();
        }
        
        return $fighterPos;
         
    
    }
    
    public function createFighter($name,$player_id) {
        $query=TableRegistry::get('fighters');
        
        $aleaCoordinateX = rand(0,14);
        $aleaCoordinateY = rand(0,9);
        $freeCoordinate=false;
        while ($freeCoordinate=false) {
            $freeCoordinate=true;
            foreach ($posPlayer as $posP) {
                if ($aleaCoordinateX==$posP['coordinate_x']&& $aleaCoordinateY==$posP['coordinate_y']) {
                    $freeCoordinate=false;
                }
            }
            foreach ($posTools as $posT) {
                if ($aleaCoordinateX==$posT['coordinate_x']&& $aleaCoordinateY==$posT['coordinate_y']) {
                    $freeCoordinate=false;
                }      
            }
        }
            
        $query->query()->insert(['name','player_id','coordinate_x','coordinate_y','level','xp','skill_sight',
            'skill_strength','skill_health','current_health'])->
                values(['name' => $name,
            'player_id' => $player_id,
            'coordinate_x' => $aleaCoordinateX,
            'coordinate_y' => $aleaCoordinateY,
            'level' => 0,
            'xp' => 0,
            'skill_sight' => 2,
            'skill_strength' => 1,
            'skill_health' => 5,
            'current_health' => 5])->execute();
        
    }
    
    //Récupérer les fighters d'un player
    
    public function getFightersOfPlayer($id_player) {
        $query=TableRegistry::get('fighters');
        $fighterInfo = $query->find()->select(['id', 'name','level','skill_sight','skill_strength','skill_health','current_health'])->where(['player_id'=>$id_player]);
        return $fighterInfo;
    }
    
}
    


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

