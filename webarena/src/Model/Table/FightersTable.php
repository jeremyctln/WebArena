<?php

namespace App\Model\Table;

use Cake\ORM\Table;

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
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

