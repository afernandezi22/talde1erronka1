<?php
    require "controller.php";
    require "../repository/db.php";
    require "../model/erabiltzailea.php";
    class ErabiltzaileaController extends Controller{
        public function getAll(){
            $this -> db = new DB();
            $sql = "SELECT * FROM erabiltzailea";
            $emaitza = $this -> db -> select($sql);
            if(!$emaitza == null){
                foreach($emaitza as $erabiltzailea){
                    $erabiltzaileak[] = new Erabiltzailea($erabiltzailea["nan"], $erabiltzailea["izena"], $erabiltzailea["abizena"], $erabiltzailea["erabiltzailea"], $erabiltzailea["pasahitza"], $erabiltzailea["rola"], $erabiltzailea["irudia"]);
                }
                return $erabiltzaileak;
            }
        }

        public function getById($id){
            $this -> db = new DB();
            $sql = "SELECT * FROM erabiltzailea WHERE nan = '" . $id . "'";
            $emaitza = $this -> db -> select($sql);

            if(!$emaitza == null){
                foreach($emaitza as $erabiltzailea){
                    $erabiltzaileak[] = new Erabiltzailea($erabiltzailea["nan"], $erabiltzailea["izena"], $erabiltzailea["abizena"], $erabiltzailea["erabiltzailea"], $erabiltzailea["pasahitza"], $erabiltzailea["rola"], $erabiltzailea["irudia"]);
                }
                return $erabiltzaileak;
            }
        }

        public function put($json){
            $this -> db = new DB();
            $data = json_decode($json, true);
            $sql = "UPDATE erabiltzailea SET izena = '" . $data["izena"]
                . "', abizena = '" . $data["abizena"]
                . "', erabiltzailea = '" . $data["erabiltzailea"]
                . "', pasahitza = '" . $data["pasahitza"]
                . "', rola = " . $data["rola"]
                . ", irudia = '" . $data["irudia"]
                . "' WHERE nan = '" . $data["nan"] . "'";
            if($this -> db -> do($sql)){
                //Ondo
            } else{
                //Txarto
            }
        }

        public function post($json){
            $this -> db = new DB();
            $data = json_decode($json, true);
            $sql = "INSERT INTO erabiltzailea VALUES ('" . $data["nan"]
                . "', '" . $data["izena"]
                . "', '" . $data["abizena"]
                . "', '" . $data["erabiltzailea"]
                . "', '" . $data["pasahitza"]
                . "', " . $data["rola"] 
                . ", '" . $data["irudia"] . "')";
            if($this -> db -> do($sql)){
                //Ondo
            } else{
                //Txarto
            }
        }

        public function delete($json){
            $this -> db = new DB();
            $data = json_decode($json, true);
            $sql = "DELETE FROM erabiltzailea WHERE nan IN('";
            for($i = 0; $i < count($data["nan"]); $i++){
                if($i == 0){
                    $sql = $sql . $data["nan"][$i];
                }else{
                    $sql = $sql . "','" . $data["nan"][$i];
                }
            }

            $sql = $sql . "')";

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
        $erabiltzaileaController = new ErabiltzaileaController();
        $erabiltzaileaController -> put($json);
    }

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $json = file_get_contents('php://input');
        $erabiltzaileaController = new ErabiltzaileaController();
        $erabiltzaileaController -> post($json);
    }

    if($_SERVER["REQUEST_METHOD"] === "DELETE"){
        $json = file_get_contents('php://input');
        $erabiltzaileaController = new ErabiltzaileaController();
        $erabiltzaileaController -> delete($json);
    }

    if($_SERVER["REQUEST_METHOD"] === "GET"){
        $erabiltzaileaController = new ErabiltzaileaController();
        if(isset($_GET["id"])){
            $erabiltzaile = $erabiltzaileaController -> getById($_GET["id"]);
            echo json_encode($erabiltzaile);
        }else{
            $erabiltzaile = $erabiltzaileaController -> getAll();
            echo json_encode($erabiltzaile);
        }
    }
?>