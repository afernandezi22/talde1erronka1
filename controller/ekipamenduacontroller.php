<?php
    require "controller.php";
    require "../repository/db.php";
    require "../model/ekipamendua.php";
    class EkipamenduaController extends Controller{
        public function getAll(){
            $this -> db = new DB();
            $sql = "SELECT * FROM ekipamendua";
            $emaitza = $this -> db -> select($sql);
            foreach($emaitza as $ekipamendua){
                $ekipamenduak[] = new Ekipamendua($ekipamendua["id"], $ekipamendua["izena"], $ekipamendua["deskribapena"], $ekipamendua["marka"], $ekipamendua["modelo"], $ekipamendua["stock"], $ekipamendua["idKategoria"]);
            }

            return $ekipamenduak;
        }

        public function getById($id){
            $this -> db = new DB();
            $sql = "SELECT * FROM ekipamendua WHERE id = " . $id;
            $emaitza = $this -> db -> select($sql);
            foreach($emaitza as $ekipamendua){
                $ekipamenduak[] = new Ekipamendua($ekipamendua["id"], $ekipamendua["izena"], $ekipamendua["deskribapena"], $ekipamendua["marka"], $ekipamendua["modelo"], $ekipamendua["stock"], $ekipamendua["idKategoria"]);
            }

            return $ekipamenduak;
        }

        public function put($json){
            $this -> db = new DB();
            $data = json_decode($json, true);
            $sql = "UPDATE ekipamendua SET izena = " . $data["izena"]
                . " abizena = " . $data["abizena"]
                . " erabiltzailea = " . $data["erabiltzailea"]
                . " pasahitza = " . $data["pasahitza"]
                . " rola = " . $data["rola"]
                . " irudia = " . $data["irudia"];
            if($this -> db -> do($sql)){
                //Ondo
            } else{
                //Txarto
            }
        }

        public function post($json){
            $this -> db = new DB();
            $data = json_decode($json, true);
            $sql = "INSERT INTO ekipamendua VALUES (izena = " . $data["izena"]
                . " abizena = " . $data["abizena"]
                . " erabiltzailea = " . $data["erabiltzailea"]
                . " pasahitza = " . $data["pasahitza"]
                . " rola = " . $data["rola"]
                . " irudia = " . $data["irudia"] . ")";
            if($this -> db -> do($sql)){
                //Ondo
            } else{
                //Txarto
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
            echo $sql;

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
?>