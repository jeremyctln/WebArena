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
                $aleaCoordinateY = rand (0,14);
                
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
                            $typeTool = "strenght";
                        }elseif($typeTool == 2){
                            $typeTool = "health";
                        }else{
                            $typeTool = "sight";                            
                        }
                        
                        $bonusTool = rand(1,3);
                        //INSERT IN THE DATABASE THE NEW TOOL
                        $queryTools->query()->insert(['type', 'bonus', 'coordinate_x', 'coordinate_y'])->values(['type' => $typeTool, 'bonus' => $bonusTool, 'coordinate_x' => $aleaCoordinateX, 'coordinate_y' => $aleaCoordinateY ])->execute();
                        
                    }else{
                        
                        $aleaCoordinateX = rand (0,14);
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
    
    
    
    
    
}
