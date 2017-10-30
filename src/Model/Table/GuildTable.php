<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class GuildTable extends Table
{
    public function GetGuildName($guild_id)
    {
        // select date, tittle, message, fighter_id_from from message where fighter_id = guild_id
        // avec guild_id = select guild_id from fighter

        $guild_name = "You don't belong to a guild!";

        $name = TableRegistry::get('guilds')->find()
        ->select(['name'])
        ->where(['id =' => $guild_id]);

         foreach($name as $nam){
            $guild_name = $nam['name']; 
        }

        return $guild_name;
    }

    public function GetGuildID($Fid)
    {
        $guild_id = '';
        $guild = TableRegistry::get('fighters')->find()
        ->select(['guild_id'])
        ->where(['id =' => $Fid]);

         foreach($guild as $gui){
            $guild_id = $gui['guild_id']; 
        }

        return $guild_id;
    }


    public function GetGuildMSG($guild_id)
    {
        $Master_msg = '';

        $messages = TableRegistry::get ('messages')->find()
        ->select(['date','title','message','fighter_id_from'])
        ->where(['fighter_id' => $guild_id])
        ->order(['date' => 'ASC']);

        foreach($messages as $msg){

            $nom = TableRegistry::get('fighters')->find()
            ->select(['name'])
            ->where(['id' => $msg['fighter_id_from']]);

            foreach ($nom as $n)
            {
                $Master_msg .= "[<i>".$msg['date']."</i>]"." <b>".$n['name']."</b> : ".$msg['message']."<br>";
            }

            if($msg['fighter_id_from'] == 0){
                $Master_msg .= "[<i>".$msg['date']."</i>] <b>Info</b> : Le joueur <b>".$msg['message']."</b> a rejoint la guilde <br>";
            }

        }
        return $Master_msg;

    }

    public function JoinGuild($guild_name, $Fid)
    {
        $msg = "None guild are called [". $guild_name. "] .";
        $guild_id = '';

        $guild = TableRegistry::get('guilds')->find()
        ->select(['id'])
        ->where(['name =' => $guild_name]);

         foreach($guild as $gui){
            $guild_id = $gui['id']; 
        }

        if ($guild_id != ''){
            $msg = '';
            $joindre = TableRegistry::get('fighters')->query() // augmente le lvl de 1 
                ->update()
                ->set(['guild_id' => $guild_id])
                ->where(['id' => $Fid])
                ->execute();
        }

        return $msg;
    }

    public function AddMessage($Fid,$content,$guild_id)
    {
        date_default_timezone_set('Europe/Paris');
        $date = date('Y/m/d H:i:s', time());
        $name = '';
        $guild_id2 = '';

        // petite douille ici, le champ fighter_id représente en réaliter la guilde et contient guild_id

        if(($guild_id > 0) && ($Fid != '') && ($content != ''))
        {
            $ajout = TableRegistry::get('messages')->query()
            ->insert(['date','title','message','fighter_id_from','fighter_id'])
            ->values(['date'=> $date,'title'=> 'not used', 'message'=> $content, 'fighter_id_from'=> $Fid, 'fighter_id'=> $guild_id])
            ->execute();
        }

        if($guild_id == -1){ // essaye même pas comprendre ici, c'est plein de douilles

            $guild = TableRegistry::get('guilds')->find()
            ->select(['id'])
            ->where(['name =' => $content]);

             foreach($guild as $gui){
                $guild_id2 = $gui['id']; 
            }

            $nom = TableRegistry::get('fighters')->find()
            ->select(['name'])
            ->where(['id' => $Fid]);
            foreach($nom as $n){
                $name = $n['name'];
            }
            

            $ajout = TableRegistry::get('messages')->query()
            ->insert(['date','title','message','fighter_id_from','fighter_id'])
            ->values(['date'=> $date,'title'=> 'not used', 'message'=> $name, 'fighter_id_from'=> 0, 'fighter_id'=> $guild_id2])
            ->execute();
        }
    }

    public function CreateGuild($name)
    {
        $ajout = TableRegistry::get('guilds')->query()
        ->insert(['name'])
        ->values(['name'=> $name])
        ->execute();
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

