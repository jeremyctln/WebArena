<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;
use Cake\ORM\Table;

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

    //put your code here
}
