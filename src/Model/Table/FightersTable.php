<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class FightersTable extends Table
{
    public function test(){
        return 'ok';
    }
    
    public function getBestFighter(){
        $figterlist=$this->find("all")->first();//suppression du order entre all et first
        //$figterlist= $this->query("SELECT * FROM fighters;");
        return $figterlist;
    }
              
    public function getFighter($fighterID){
        
        $query = TableRegistry::get('fighters')->find();
        //$fighter = $query->select;
    }
            
        
    public function fighterMove($idplayer, $idFighter, $direction){
        $query = TableRegistry::get('fighters')->find();
        $query2 = TableRegistry::get('fighters')->find();
         
        $fighterPos = $query->select(['id','coordinate_x' ,'coordinate_y'])->where(['id =' => $idFighter ]);
        
        $fighterList = $query2->select(['id', 'player_id', 'coordinate_x', 'coordinate_y']);
        
        echo("salut");
        
        
              
        
        foreach($fighterList as $fighterL){
            
            foreach ($fighterPos as $fighterP){
                
                if($direction == "up" ){
                
                    if($fighterP['coordinate_y']-1 == $fighterL['coordinate_y'] && $fighterP['coordinate_x'] == $fighterL['coordinate_x']){
                        return false;
                    }else{
                        $newPos = $fighterP['coordinate_y']-1;
                    }
                                  
                }elseif($direction == "right"){
                    if($fighterP['coordinate_x']+1 == $fighterL['coordinate_x'] && $fighterP['coordinate_y'] == $fighterL['coordinate_y']){
                        return false;
                    }else{
                        $newPos = $fighterP['coordinate_x']+1;
                    }
                }elseif($direction == "left"){
                    if($fighterP['coordinate_x']-1 == $fighterL['coordinate_x'] && $fighterP['coordinate_y'] == $fighterL['coordinate_y']){
                        return false;
                    }else{
                        $newPos = $fighterP['coordinate_x']-1;
                    }            
                }elseif($direction == "down"){
                    if($fighterP['coordinate_y']+1 == $fighterL['coordinate_y'] && $fighterP['coordinate_x'] == $fighterL['coordinate_x']){
                        return false;
                    }else{
                        $newPos = $fighterP['coordinate_y']+1;
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
}
    


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

