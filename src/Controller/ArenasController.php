<?php
namespace App\Controller;
use App\Controller\AppController;
/**
* Personal Controller
* User personal interface
*
*/
class ArenasController  extends AppController
{
    public function index()
    {

        // 3 lignes suivantes à rajouté a chauqe page (sauf login) pour cérifier qu'on est bien loggé (commenté pr désactiver si besoin, ça ne change rien à la var session)
        $session = $this->request->session();
        if($session->read('player.Pid') == null){
            return $this->redirect(['controller' => 'Arenas', 'action' => 'login']);
        } // 3 lignes précédentes à rajouté a chauqe page (sauf login) pour cérifier qu'on est bien loggé


        //$this->set('myname',"julien");
        
        //permet de creer un lien vers le model ou un fichier s'appel Fighters
        $this->loadModel('Fighters');
        //$figterlist=$this->Fighters->find('all');
        //pr($figterlist->toArray());
        //$valuetest = $this->Fighters->test();
        //$this->set('value', $valuetest);
        
        //test d'un redirection
        //if ($valuetest == 3){
        //    return $this->redirect(['controller' => 'Arenas', 'action' => 'login']);
        //}
        
        //permet d'interoger dans le model la fonction test();
        //$value = $this->Fighters->test();
        //$this->set('value', $value);
        
        //permet de recuperer l'array du meilleur fighter
        $value2 = $this->Fighters->getBestFighter();
        $this->set('value2',$value2);
        
       //$valueget = $this->Fighters->getBestFighter();
       // pr($valueget->toArray());
        //$this->set('valueofget',$valueget);
        
        
    }

    public function verif(){
        // 3 lignes suivantes à rajouté a chauqe page (sauf login) pour cérifier qu'on est bien loggé (commenté pr désactiver si besoin, ça ne change rien à la var session)
        $session = $this->request->session();
        if($session->read('player.Pid') == null){
            return $this->redirect(['controller' => 'Arenas', 'action' => 'login']);
        } // 3 lignes précédentes à rajouté a chauqe page (sauf login) pour cérifier qu'on est bien loggé
        
        $password=$_POST['NamePass'];
        echo $password;
        $this->loadModel('Players');
        $pass = $this->Players->getPlayer($password);
        
        if($pass==true){
            $retour = "vous avez rentré le bon mot de passe!";
        }else{
            $retour = "Vous avez rentré le mauvais mot de passe!";
           }
        $this->set('notation',$retour);
        
    }
    public function fighter(){
        // 3 lignes suivantes à rajouté a chauqe page (sauf login) pour cérifier qu'on est bien loggé (commenté pr désactiver si besoin, ça ne change rien à la var session)
        $session = $this->request->session();
        if($session->read('player.Pid') == null){
            return $this->redirect(['controller' => 'Arenas', 'action' => 'login']);
        } // 3 lignes précédentes à rajouté a chauqe page (sauf login) pour cérifier qu'on est bien loggé
        
        
        
        
    }

    public function sight(){

        // 3 lignes suivantes à rajouté a chauqe page (sauf login) pour cérifier qu'on est bien loggé (commenté pr désactiver si besoin, ça ne change rien à la var session)
        $session = $this->request->session();
        if($session->read('player.Pid') == null){
            return $this->redirect(['controller' => 'Arenas', 'action' => 'login']);
        } // 3 lignes précédentes à rajouté a chauqe page (sauf login) pour cérifier qu'on est bien loggé

        
        $this->loadModel('Fighters');
        $this->loadModel('Grids'); 
        $this->loadModel('Tools');
        $this->loadModel('Surroundings');
        
        $idPlayer = '545f827c-576c-4dc5-ab6d-27c33186dc3e';
        $idFighter = '1';
        
        //DISPLAY THE GRID IN THEVIEW
        $this->set('idsession', $idPlayer);
        
        ///////////////////////////////////////////
        
        //CREATION OF NEW 
        //$this->Tools->createTools();
        //$toolList = $this->Tools->getTools();
        
        
        ///////////////////////////////////////////
            
        //marche
        //demander aussi pour le tableau avec les zone sombre...
        if($this->request->is('post')){
            $game = $this->request->getData();

            //WHEN THE PLAYER WANT TO MOVE
            if ($game["toucheMove"]== "up"){
                echo"touche haut";

                $direction = 'up';
                $move = $this->Fighters->fighterMove($idPlayer, $idFighter, $direction);

                //IN THE CASE WE THE VALUE RETURN IS A fighter THAT MEAN
                // THERE IS A FIGHTER IN THE CASE
                // ATTACK THE FIGHTER

                if ($move == 'fighter'){
                    $attack = $this->Fighters->fighterAttack($idPlayer, $idFighter, $direction);            
                }elseif ($move == "tool"){
                    //recuperer le tool à la coordonné donnée!
                }

                //regader si position de 
            }elseif ($game["toucheMove"]== "right"){
                echo"touche right";
                $direction = 'right';
                $move = $this->Fighters->fighterMove($idPlayer, $idFighter, $direction);

                if ($move == 'fighter'){
                    $attack = $this->Fighters->fighterAttack($idPlayer, $idFighter, $direction);            
                }elseif ($move == "tool"){
                    //recuperer le tool à la coordonné donnée!
                }

            }elseif ($game["toucheMove"]== "left"){
                echo"touche left";
                $direction = 'left';
                $move = $this->Fighters->fighterMove($idPlayer, $idFighter, $direction);

                if ($move == 'fighter'){
                    $attack = $this->Fighters->fighterAttack($idPlayer, $idFighter, $direction);            
                }elseif ($move == "tool"){
                    //recuperer le tool à la coordonné donnée!
                }
                
            }elseif ($game["toucheMove"]== "down"){
                echo"touche down";
                $direction = 'down';
                $move = $this->Fighters->fighterMove($idPlayer, $idFighter, $direction);

                if ($move == 'fighter'){
                    $attack = $this->Fighters->fighterAttack($idPlayer, $idFighter, $direction);            
                }elseif ($move == "tool"){
                    //recuperer le tool à la coordonné donnée!
                }
                
            }


            //ADD THE CASE WHERE THE FIGHTER ATTAQUE AN OTHER FIGHTER
            // SI ATTAQUE VERS LE HAUT /
            //CALL THE METHODE ATTAQUE IN THE MODEL; 
            //
        }
        
        //$this->loadModel('Players');
        
        
        
        
        /*foreach($posPlayer as $pos){
            $arraygrid = array();
             if($player["coordinate_x"]==$j && $player["coordinate_y"]==$i){
                 
             }
        }
        
         if ($player["coordinate_x"]==$j && $player["coordinate_y"]==$i){
                        echo $this->Html->image("perso".$player["id"].".png", ['width'=> '25', 'height'=>'26']);
                        $fighter = true;
                       }
                       
                    }
                    if($fighter==false){// in the case that no one fighter has been find
                           echo $this->Html->image("herbe.png", ['width'=> '26', 'height'=>'26']);
                    }else{// previously a finghter has been find
                           $fighter = false;// a fighter has been find
                           // we have to re-initialised the variable $fighter
                    }*/
        
        //echanger l'array de pos Player en une autre array ou l'on pourrait stocker tute les infos dans cette array 
        
        //THE ARRAY THAT WE SEND TO THE LOOP IN THE VIEW
        //MIMPLEMENTATION OF THE VIEW HERE
        $posPlayer = $this->Grids->getPosFighter();
        $this->set('posPlayer',$posPlayer);
        
        //SEND WIDTH AND THE HIGHT OF THE GRID
        $gridWidth = $this->Grids->getWidth();
        $gridHeight = $this->Grids->getHeight();
        $this->set('gridWidth', $gridWidth);
        $this->set('gridHeight', $gridHeight);
        
        
        $posMainFighter = $this->Fighters->getMainFighter($idFighter, $idPlayer);
        $posEnemyFighter = $this->Fighters->getEnemyFighter($idFighter, $idPlayer);
        $posTools = $this->Tools->getTools();
        $this->Surroundings->setSurroundings($posMainFighter, $posEnemyFighter, $posTools);
        $gridDisplay = $this->Surroundings->getSurroundings();
        $this->set('gridDisplay', $gridDisplay);
        //envoie des info ici à la vue
       
       
        
        //$perso = $this->Grid->getPosFighter();
        
            
            //on doit lui passer le fighter
       
        //$user = $this->player->get($user);
        
        
        
        /*
        $this->loadModel('Grids');
        $line = $this->Grids->getWidth();
        $column =$this->Grids->getHeight();
        
        for($i=0;$i<$line;$i++){
            for($j=0;$j<$column;$j++){
                $PosX = $this->Grids->getPosXFighter();
                $PosY = $this->Grids->getPosYFighter();
                if ($i==$PosY && $j==$PosX){
                    return 
                }
            
            }
        }
         
         */
        
        //exemple d'affichage de la grille
        
        
    }

    public function diary(){

            // 3 lignes suivantes à rajouté a chauqe page (sauf login) pour cérifier qu'on est bien loggé (commenté pr désactiver si besoin, ça ne change rien à la var session)
        $session = $this->request->session();
        if($session->read('player.Pid') == null){
            return $this->redirect(['controller' => 'Arenas', 'action' => 'login']);
        } // 3 lignes précédentes à rajouté a chauqe page (sauf login) pour cérifier qu'on est bien loggé
        
    }




    public function login(){

        $session = $this->request->session();
        $session->destroy();// on réinitialise la session en entrant sur la page login, pour se reconnecter à nouveau


        $Flog = ''; // F si la donné provient d'une Form, DB si la donné provient d'une query
        $Fpass = '';
        if(isset($_POST['username'])){
            $Flog = $_POST['username']; // recupere les valeurs depuis le formulaire dans register.ctp
        }
        
        if(isset($_POST['password'])){
            $Fpass = $_POST['password'];
        }

            if (($Flog != '') && ($Fpass != '')) // si les 2 champs sont non vide 
        {
            $this->loadModel('Players');
            if($this->Players->checkCredentials($Flog, $Fpass)){
                //echo "Bon mot de passe";
                //echo "<br/> l'id de la session est :";
                $session->write('player.Pid',$this->Players->getIDfromLog($Flog));
                //echo $session->read('player.Pid');
                return $this->redirect(['controller' => 'Arenas', 'action' => 'index']);


            }
            else
                echo "Mauvais mdp/login";
        }

        


        
    }

    public function register(){

        // 3 lignes suivantes à rajouté a chauqe page (sauf login) pour cérifier qu'on est bien loggé (commenté pr désactiver si besoin, ça ne change rien à la var session)
        $session = $this->request->session();
        if($session->read('player.Pid') == null){
            return $this->redirect(['controller' => 'Arenas', 'action' => 'login']);
        } // 3 lignes précédentes à rajouté a chauqe page (sauf login) pour cérifier qu'on est bien loggé


        $session = $this->request->session(); // facultatif, mais ça réduit la taille des lignes suivantes


        //echo "<br/> l'id de la session est :";
        echo $session->read('player.Pid');
        $RandID = substr(md5(rand()), 0, 36); // génère une id random
        $Flog = ''; // F si la donné provient d'une Form, DB si la donné provient d'une query
        $Fpass = '';
        if(isset($_POST['username'])){
            //echo "post username is set";
            $Flog = $_POST['username']; // recupere les valeurs depuis le formulaire dans register.ctp
        }
        
        if(isset($_POST['password'])){
            //echo "post password is set";
            $Fpass = $_POST['password'];
        }
        
        //echo $RandID;
        //echo $Flog;
        //echo $Fpass;


        if (($Flog != '') && ($Fpass != '')) // si les 2 champs sont non vide 
        {
            $this->loadModel('Players');
            if(!$this->Players->checkExists($Flog, $Fpass)) // regarde si l'un des champs existe déja
                $this->Players->insertPlayer($RandID, $Flog, $Fpass); // insere le nouveau péon : voir PlayersTable.php
        }



    }


}