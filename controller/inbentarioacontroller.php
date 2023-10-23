<?php
    require "controller.php";
    require "../repository/db.php";
    require "../model/inbentarioa.php";
    class InbentarioaController extends Controller{
        public function getAll(){
            $this -> db = new DB();
            $sql = "SELECT * FROM inbentarioa";
            $emaitza = $this -> db -> select($sql);
            if(!$emaitza == null){
                foreach($emaitza as $inbentarioa){
                    $inbentarioak[] = new Inbentarioa($inbentarioa["etiketa"], $inbentarioa["idEkipamendu"], $inbentarioa["erosketaData"]);
                }
    
                return $inbentarioak;
            }
        }

        public function getById($id){
            $this -> db = new DB();
            $sql = "SELECT * FROM inbentarioa WHERE etiketa = " . $id;
            $emaitza = $this -> db -> select($sql);
            if(!$emaitza == null){
                foreach($emaitza as $inbentarioa){
                    $inbentarioak[] = new Inbentarioa($inbentarioa["etiketa"], $inbentarioa["idEkipamendu"], $inbentarioa["erosketaData"]);
                }
    
                return $inbentarioak;
            }
        }

        public function put($json){
            $this -> db = new DB();
            $data = json_decode($json, true);
            $sql = "UPDATE inbentarioa SET idEkipamendu = " . $data["idEkipamendu"]
                . ", erosketaData = " . $data["erosketaData"]
                . " WHERE etiketa = " . $data["etiketa"];
            if($this -> db -> do($sql)){
                return true;
            } else{
                return false;
            }
        }

        public function post($json){
            $this -> db = new DB();
            $data = json_decode($json, true);
            $sql = "INSERT INTO inbentarioa VALUES ('" . $data["etiketa"]
                . "', " . $data["idEkipamendu"]
                . ", '" . $data["erosketaData"] . "')";
            if($this -> db -> do($sql)){
                return true;
            } else{
                return false;
            }
        }

        public function delete($json){
            $this -> db = new DB();
            $data = json_decode($json, true);
            $sql = "DELETE FROM inbentarioa WHERE etiketa IN(";
            for($i = 0; $i < count($data["etiketa"]); $i++){
                if($i == 0){
                    $sql = $sql . $data["etiketa"][$i];
                }else{
                    $sql = $sql . "," . $data["etiketa"][$i];
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
        $inbentarioaController = new InbentarioaController();
        $inbentarioaController -> put($json);
    }

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $json = file_get_contents('php://input');
        $inbentarioaController = new InbentarioaController();
        $inbentarioaController -> post($json);
    }

    if($_SERVER["REQUEST_METHOD"] === "DELETE"){
        $json = file_get_contents('php://input');
        $inbentarioaController = new InbentarioaController();
        $inbentarioaController -> delete($json);
    }

    if($_SERVER["REQUEST_METHOD"] === "GET"){
        $inbentarioaController = new InbentarioaController();
        if(isset($_GET["id"])){
            $inbentario = $inbentarioaController -> getById($_GET["id"]);
            echo json_encode($inbentario);
        }else{
            $inbentario = $inbentarioaController -> getAll();
            echo json_encode($inbentario);
        }
    }
?>