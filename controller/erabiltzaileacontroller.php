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

        public function getByFilter($zutabea, $datua){
            $this -> db = new DB();
            $sql = "SELECT * FROM erabiltzailea WHERE " . $zutabea. " = '" . $datua . "'"; 
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
            
            //Baliozkotzea: ezin da erabiltzaile-izen berarekin editatu
            $sql = "SELECT * FROM erabiltzailea WHERE erabiltzailea = '" . $data["erabiltzailea"] ."' AND nan <> '" . $data["nan"] . "'";
            $result = $this -> db -> select($sql);
            if($result == null){
                    if($data["irudia"] != ""){
                        $sql = "UPDATE erabiltzailea SET izena = '" . $data["izena"]
                            . "', abizena = '" . $data["abizena"]
                            . "', erabiltzailea = '" . $data["erabiltzailea"]
                            . "', pasahitza = '" . $data["pasahitza"]
                            . "', rola = " . $data["rola"]
                            . ", irudia = '" . $data["irudia"]
                            . "' WHERE nan = '" . $data["nan"] . "'";
                    } else{
                        $sql = "UPDATE erabiltzailea SET izena = '" . $data["izena"]
                        . "', abizena = '" . $data["abizena"]
                        . "', erabiltzailea = '" . $data["erabiltzailea"]
                        . "', pasahitza = '" . $data["pasahitza"]
                        . "', rola = " . $data["rola"]
                        . ", irudia = null"
                        . " WHERE nan = '" . $data["nan"] . "'";
                    }
                    if($this -> db -> do($sql)){
                        //Ondo
                    } else{
                        //Txarto
                    }
            } else {
                //Errorea badagoelako erabiltzailea erabiltzaile-izen horrekin
                // throw new Exception("Badago erabiltzailea izen horrekin!");
            }
        }

        public function post($json){
            $this -> db = new DB();
            $data = json_decode($json, true);

            //Baliozkotzea: erabiltzailea ezin da errepikatu
            $sql = "SELECT * FROM erabiltzailea WHERE erabiltzailea = '" . $data["erabiltzailea"] ."'";
            $result = $this -> db -> select($sql);
            if($result == null){
                //Ez dago erabiltzailerik erabiltzaile-izen horrekin
                //Begiratu ea irudia daukan edo ez
                if($data["irudia"] != ""){
                    $sql = "INSERT INTO erabiltzailea VALUES ('" . $data["nan"]
                    . "', '" . $data["izena"]
                    . "', '" . $data["abizena"]
                    . "', '" . $data["erabiltzailea"]
                    . "', '" . $data["pasahitza"]
                    . "', " . $data["rola"] 
                    . ", '" . $data["irudia"] . "')";
                } else{
                    $sql = "INSERT INTO erabiltzailea (nan, izena, abizena, erabiltzailea, pasahitza, rola) VALUES ('" . $data["nan"]
                    . "', '" . $data["izena"]
                    . "', '" . $data["abizena"]
                    . "', '" . $data["erabiltzailea"]
                    . "', '" . $data["pasahitza"]
                    . "', " . $data["rola"] . ")";
                }
                if($this -> db -> do($sql)){
                    //Ondo
                } else{
                    //Txarto
                }
            } else{
                //Errorea badagoelako erabiltzailea erabiltzaile-izen horrekin
                throw new Exception("Badago erabiltzailea izen horrekin!");
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

        public function login($json){
            $erabil = false;
            $pass = false;

            $this -> db = new DB();
            $data = json_decode($json, true);
            $sql = "SELECT * FROM erabiltzailea WHERE erabiltzailea = '" . $data["erabil"] . "'";
            $emaitza = $this -> db -> select($sql);
            if($emaitza == null){
                $info = ["erabil" => $erabil, "pass" => $pass];
                
            } else{
                $erabil = true;
                foreach($emaitza as $lerro){
                    if($lerro["pasahitza"] == $data["pass"]){
                        $pass = true;
                        $info = ["erabil" => $erabil, "pass" => $pass];
                    } else{
                        $pass = false;
                        $info= ["erabil" => $erabil, "pass" => $pass];
                    }
                }
            }
            return json_encode($info);
        }
    }

    header("Content-Type: application/json; charset=UTF-8");


    if($_SERVER["REQUEST_METHOD"] === "PUT"){
        $json = file_get_contents('php://input');
        $erabiltzaileaController = new ErabiltzaileaController();
        $erabiltzaileaController -> put($json);
    }

    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        if(isset($data["erabil"])){
            $erabiltzaileaController = new ErabiltzaileaController();
            echo $erabiltzaileaController -> login($json);
        } else{
            $json = file_get_contents('php://input');
            $erabiltzaileaController = new ErabiltzaileaController();
            $erabiltzaileaController -> post($json);
        }
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
        }elseif(isset($_GET["zutabea"])){
            $erabiltzailea = $erabiltzaileaController -> getByFilter($_GET["zutabea"], $_GET["datua"]);
            echo json_encode($erabiltzailea);
        }else{
            $erabiltzaile = $erabiltzaileaController -> getAll();
            echo json_encode($erabiltzaile);
        }
    }
?>
