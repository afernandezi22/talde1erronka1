<?php
    require "controller.php";
    require "../repository/db.php";
    require "../model/gela.php";
    class GelaController extends Controller{
        public function getAll(){
            $this -> db = new DB();
            $sql = "SELECT * FROM gela";
            $emaitza = $this -> db -> select($sql);
            if(!$emaitza == null){
                foreach($emaitza as $gela){
                    $gelak[] = new Gela($gela["id"], $gela["izena"], $gela["taldea"]);
                }
    
                return $gelak;
            }
        }

        public function getById($id){
            $this -> db = new DB();
            $sql = "SELECT * FROM gela WHERE id = " . $id;
            $emaitza = $this -> db -> select($sql);
            if(!$emaitza == null){
                foreach($emaitza as $gela){
                    $gelak[] = new Gela($gela["id"], $gela["izena"], $gela["taldea"]);
                }
    
                return $gelak;
            }
        }

        public function getByFilter($zutabea, $datua){
            $this -> db = new DB();
            $sql = "SELECT * FROM gela WHERE " . $zutabea. " = '" . $datua . "'"; 
            $emaitza = $this -> db -> select($sql);
            if(!$emaitza == null){
                foreach($emaitza as $gela){
                    $gelak[] = new Gela($gela["id"], $gela["izena"], $gela["taldea"]);
                }
    
                return $gelak;
            }
        }

        public function put($json){
            $this -> db = new DB();
            $data = json_decode($json, true);
            $sql = "UPDATE gela SET izena = '" . $data["izena"]
                . "', taldea = '" . $data["taldea"]
                . "' WHERE id = " . $data["id"];
            if($this -> db -> do($sql)){
                return true;
            } else{
                return false;
            }
        }

        public function post($json){
            $this -> db = new DB();
            $data = json_decode($json, true);
            $sql = "INSERT INTO gela (izena, taldea) VALUES ('" . $data["izena"]
                . "', '" . $data["taldea"] . "')";
            if($this -> db -> do($sql)){
                return true;
            } else{
                return false;
            }
        }

        public function delete($json){
            $this -> db = new DB();
            $data = json_decode($json, true);
            $sql = "DELETE FROM gela WHERE id IN(";
            for($i = 0; $i < count($data["id"]); $i++){
                if($i == 0){
                    $sql = $sql . $data["id"][$i];
                }else{
                    $sql = $sql . "," . $data["id"][$i];
                }
            }

            $sql = $sql . ")";

            if($this -> db -> do($sql)){
                return true;
            } else{
                return true;
            }
        }
    }

    header("Content-Type: application/json; charset=UTF-8");


    if($_SERVER["REQUEST_METHOD"] === "PUT"){
        $json = file_get_contents('php://input');
        $gelaController = new GelaController();
        $gelaController -> put($json);
    }

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $json = file_get_contents('php://input');
        $gelaController = new GelaController();
        $gelaController -> post($json);
    }

    if($_SERVER["REQUEST_METHOD"] === "DELETE"){
        $json = file_get_contents('php://input');
        $gelaController = new GelaController();
        $gelaController -> delete($json);
    }

    if($_SERVER["REQUEST_METHOD"] === "GET"){
        $gelaController = new GelaController();
        if(isset($_GET["id"])){
            $gela = $gelaController -> getById($_GET["id"]);
            echo json_encode($gela);
        }elseif(isset($_GET["zutabea"])){
            $gela = $gelaController -> getByFilter($_GET["zutabea"], $_GET["datua"]);
            echo json_encode($gela);
        }else {
            $gela = $gelaController -> getAll();
            echo json_encode($gela);
        }
    }
?>