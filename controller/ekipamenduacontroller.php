<?php
    require "controller.php";
    require "../repository/db.php";
    require "../model/ekipamendua.php";
    class EkipamenduaController extends Controller{
        public function getAll(){
            $this -> db = new DB();
            $sql = "SELECT * FROM ekipamendua";
            $emaitza = $this -> db -> select($sql);
            if(!$emaitza == null){
                foreach($emaitza as $ekipamendua){
                    $ekipamenduak[] = new Ekipamendua($ekipamendua["id"], $ekipamendua["izena"], $ekipamendua["deskribapena"], $ekipamendua["marka"], $ekipamendua["modelo"], $ekipamendua["stock"], $ekipamendua["idKategoria"]);
                }
                return $ekipamenduak;
            }
        }

        public function getById($id){
            $this -> db = new DB();
            $sql = "SELECT * FROM ekipamendua WHERE id = " . $id;
            $emaitza = $this -> db -> select($sql);
            
            if(!$emaitza == null){
                foreach($emaitza as $ekipamendua){
                    $ekipamenduak[] = new Ekipamendua($ekipamendua["id"], $ekipamendua["izena"], $ekipamendua["deskribapena"], $ekipamendua["marka"], $ekipamendua["modelo"], $ekipamendua["stock"], $ekipamendua["idKategoria"]);
                }
                return $ekipamenduak;
            }
        }

        public function getByFilter($zutabea, $datua){
            $this -> db = new DB();
            $sql = "SELECT * FROM ekipamendua WHERE " . $zutabea. " = '" . $datua . "'"; 
            $emaitza = $this -> db -> select($sql);
            if(!$emaitza == null){
                foreach($emaitza as $gela){
                    $ekipamenduak[] = new Ekipamendua($ekipamendua["id"], $ekipamendua["izena"], $ekipamendua["deskribapena"], $ekipamendua["marka"], $ekipamendua["modelo"], $ekipamendua["stock"], $ekipamendua["idKategoria"]);
                }
    
                return $gelak;
            }
        }

        public function put($json){
            $this -> db = new DB();
            $data = json_decode($json, true);
            $sql = "UPDATE ekipamendua SET izena = '" . $data["izena"]
                . "', deskribapena = '" . $data["deskribapena"]
                . "', marka = '" . $data["marka"]
                . "', modelo = '" . $data["modelo"]
                . "', stock = " . $data["stock"]
                . ", idKategoria = " . $data["idKategoria"]
                . " WHERE id = " . $data["id"];
            if($this -> db -> do($sql)){
                //Ondo
            } else{
                //Txarto
            }
        }

        public function post($json){
            $this -> db = new DB();
            $data = json_decode($json, true);
            $sql = "INSERT INTO ekipamendua (izena, deskribapena, marka, modelo, stock, idKategoria) VALUES ('" . $data["izena"]
                . "', '" . $data["deskribapena"]
                . "', '" . $data["marka"]
                . "', '" . $data["modelo"]
                . "', " . $data["stock"]
                . ", " . $data["idKategoria"] . ")";
                if($this -> db -> do($sql)){
                    return true;
                } else{
                    return false;
                }
        }

        public function delete($json){
            $this -> db = new DB();
            $data = json_decode($json, true);
            $sql = "DELETE FROM ekipamendua WHERE id IN(";
            for($i = 0; $i < count($data["id"]); $i++){
                if($i == 0){
                    $sql = $sql . $data["id"][$i];
                }else{
                    $sql = $sql . "," . $data["id"][$i];
                }
            }

            $sql = $sql . ")";

            if($this -> db -> do($sql)){
                //Ondo
            } else{
                //Txarto
            }
        }
    }

    header("Content-Type: application/json; charset=UTF-8");

    if($_SERVER["REQUEST_METHOD"] === "PUT"){
        $json = file_get_contents('php://input');
        $ekipamenduController = new EkipamenduaController();
        $ekipamenduController -> put($json);
    }

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $json = file_get_contents('php://input');
        $ekipamenduController = new EkipamenduaController();
        $ekipamenduController -> post($json);
    }

    if($_SERVER["REQUEST_METHOD"] === "DELETE"){
        $json = file_get_contents('php://input');
        $ekipamenduController = new EkipamenduaController();
        $ekipamenduController -> delete($json);
    }

    if($_SERVER["REQUEST_METHOD"] === "GET"){
        $ekipamenduController = new EkipamenduaController();
        if(!empty($_GET["id"])){
            $ekipamendu = $ekipamenduController -> getById($_GET["id"]);
            echo json_encode($ekipamendu);
        }else{
            $ekipamendu = $ekipamenduController -> getAll();
            echo json_encode($ekipamendu);
        }
    }
?>