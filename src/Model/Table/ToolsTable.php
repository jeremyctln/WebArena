<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;
use Cake\ORM\TableRegistry;
use Cake\ORM\Table;

/**
 * Description of ToolsTable
 *
 * @author jeremy_pc
 */
class ToolsTable extends Table{
    
    public function createTools(){
        
        $queryTools = TableRegistry::get('tools');
        $queryFight = TableRegistry::get('fighters');
       
        //INFO FIGHER FOR THEIR POSITION 
        $posPlayer = $queryFight->find();
        //INFO TOOLS TO CREATE NEW POSITION 
        $posTools = $queryTools->find();
        
        
        $queryTools->query()->delete()->execute();
        
                   
            for($i=0; $i<10; $i++){
                  
                $aleaCoordinateX = rand (0,14);
                $aleaCoordinateY = rand (0,9);
                
                //SUPPRESSION DANS LA TABKE SI ELEMENT EXISTE DEJA
                              
                $freeCoordinate = false;
                               
                while ($freeCoordinate == false ){
                    
                    $freeCoordinate = true;
                    
                    //LOOK IN THE FIGHTER TABLE IF THE COORDINATE IS FREE
                    foreach ($posPlayer as $playerPos){
                                         
                        if($aleaCoordinateX == $playerPos['coordinate_x'] && $aleaCoordinateY == $playerPos['coordinate_y'] ){
                           $freeCoordinate = false;
                        }
                    }
                    //LOOK IN THE TOOL TABLE IF THE COORDINATE IS FREE
                    foreach ($posTools as $toolsP){
                        
                        if($aleaCoordinateX == $toolsP['coordinate_x'] && $aleaCoordinateY == $toolsP['coordinate_y']){
                            $freeCoordinate = false;
                        }
                    }
                        
                              
                    if($freeCoordinate == true){//  COORDINATES X AND Y ARE FREE
                        
                        //ALEA 
                        $typeTool = rand(1,3);
                        if ($typeTool == 1){
                            $typeTool = "strength";
                        }elseif($typeTool == 2){
                            $typeTool = "health";
                        }else{
                            $typeTool = "sight";                            
                        }
                        
                        $bonusTool = rand(1,3);
                        //INSERT IN THE DATABASE THE NEW TOOL
                        $queryTools->query()->insert(['type', 'bonus', 'coordinate_x', 'coordinate_y'])->values(['type' => $typeTool, 'bonus' => $bonusTool, 'coordinate_x' => $aleaCoordinateX, 'coordinate_y' => $aleaCoordinateY ])->execute();
                        
                    }else{
                        
                        $aleaCoordinateX = rand (0,9);
                        $aleaCoordinateY = rand (0,14);
                        
                    } 
                    
                }
            }
  
        return true;
               
    }
    /*
            foreach ($query as $s){
            echo $s;
        }*/

    //RECOVER TOOLS
    public function getTools(){    
        $query= TableRegistry::get('tools ')->find()->where(['fighter_id IS' => null]);
        return $query; 
    }
    
    public function getToolsFighter($idFighter, $idPlayer){
        $query = TableRegistry::get('tools')->find()->where(['fighter_id' => $idFighter]);
        return $query;
    }
    
    public function retrieveTool($idFighter,$direction){
        
        $queryTools = TableRegistry::get('tools');
        $queryFighters = TableRegistry::get('fighters');
        
       //INFO ABOUT THE FIGHTER THAT WE ARE USING
        $mainFighter = $queryFighters->find()->where(['id' => $idFighter]);
        
        //INFO ABOUT THE FIGHTER THAT WE ARE USING
        $toolList = $queryTools->find();
        
        foreach($mainFighter as $fighter){
       
            //WE WANT TO KNOW WICH TOOL WILL BE ASSIGN TO THE MAIN FIGHTER
            if ($direction == "up"){
                $toolAssign = $queryTools->find()->where(['coordinate_x' => $fighter['coordinate_x'], 'coordinate_y' => $fighter['coordinate_y']-1]);
            }elseif($direction == "right"){
                $toolAssign = $queryTools->find()->where(['coordinate_y' => $fighter['coordinate_y'], 'coordinate_x' => $fighter['coordinate_x']+1]);
            }elseif($direction == "left"){
                $toolAssign = $queryTools->find()->where(['coordinate_y' => $fighter['coordinate_y'], 'coordinate_x' => $fighter['coordinate_x']-1]);
            }elseif($direction == "down"){
                $toolAssign = $queryTools->find()->where(['coordinate_x' => $fighter['coordinate_x'], 'coordinate_y' => $fighter['coordinate_y']+1]);
            }
            
            //RECUPERATION DE L'ATTRIBUT SUPP
            foreach($toolAssign as $toolA){
                if($toolA['type'] == "strength"){
                    $queryFighters->find()->update()->set(['skill_strength' => $fighter['skill_strength']+$toolA['bonus']])->where(['id' => $idFighter])->execute();
                }elseif($toolA['type'] == "sight"){
                    $queryFighters->find()->update()->set(['skill_sight' => $fighter['skill_sight']+$toolA['bonus']])->where(['id' => $idFighter])->execute();
                }elseif($toolA['type'] == "health"){
                    $queryFighters->find()->update()->set(['skill_health' => $fighter['skill_health']+$toolA['bonus'], 'current_health' => $fighter['current_health']+$toolA['bonus']])->where(['id' => $idFighter])->execute();
                }
            //ASSIGN THE TOOL TO THE FIGHTER
            $queryTools->find()->update()->set(['fighter_id' => $idFighter])->where(['coordinate_x' => $toolA['coordinate_x'], 'coordinate_y' => $toolA['coordinate_y']])->execute();
        
            return "You have a new tool, your ".$toolA['type']."increase of ".$toolA['bonus'];
            }
            
        }
        
        //ASSIGN TO THE TOOL THE ID OF THE FIGHTER
          
            
    }
    
}
