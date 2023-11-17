<?php
    header("Access-Control-Allow-Headers:{$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

    require "controller.php";
    require "../repository/db.php";
    require "../model/erabiltzailea.php";
    /**
     * Erabiltzaileko taula kudeatzeko controller-a
     */
    class ErabiltzaileaController extends Controller{
        /**
         * Ez du parametrorik hartzen eta erabiltzaileen zerrenda bueltatzen du.
         */
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
        /**
         * ID-aren arabera erabiltzaile zehatz bat bueltatzen du.
         */
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
        /**
         * Zutabea eta datua aukeratuta erabiltzaile multzo zehatz bat bueltatzen du.
         */
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
        /**
         * UPDATE egiteko funtzioa. Baliozkotze bat dauka: beste erabiltzaileren bat topatzen badu erabiltzaile-izen berarekin ez du UPDATE-a egingo. Gainera argazkirik ez bada gehitzen "null" jarriko du zutabe horretan.
         */
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
                //Badago beste erabiltzaileren bat erabiltzaile-izen horrekin
            }
        }
        /**
         * INSERT egiteko funtzioa. Baliozkotzea badauka: ezin da sortu erabiltzaile berri bat beste erabiltzaile baten erabiltzaile-izen berarekin. Irudirik ez bada sartzen NULL izango da zutabe horretan.
         */
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
                //Badago beste erabiltzaileren bat erabiltzaile-izen horrekin
            }
            
        }
        /**
         * DELETE egiteko funtzioa multzoka. ADMIN rola dutenek bakarrik ezabatu ahal izango dute.
         */
        public function delete($json){
            $this -> db = new DB();
            $data = json_decode($json, true);
            $sql = "DELETE FROM erabiltzailea WHERE nan IN('";
            for($i = 0; $i < count($data["nan"]); $i++){
                //Baliozkotzea: ez da ezabatuko admin rola badauka
                $sqlSelect = "SELECT * FROM erabiltzailea WHERE nan = '" . $data["nan"][$i] ."'";
                $result = $this -> db -> select($sqlSelect);
                foreach($result as $erabiltzaile){
                    if($erabiltzaile["rola"] != 0){
                        $sql = $sql . $data["nan"][$i] . "', '";
                    }
                }
            }

            $sql = $sql . "0')";

            if($this -> db -> do($sql)){
                //Ondo
            } else{
                //Txarto
            }
        }
        /**
         * LOGIN-a egiteko funtzioa. POST bidez jasotako JSON-ean erabiltzaile izena eta pasahitza lortzen dira. Horiek datu-basean konparatzen dira eta horren arabera beste JSON bat bueltatzen da front-era informazio zehatzarekin. 
         * Erabiltzailea eta pasahitza ondo idatzi diren eta ondo egin bada beste informazio gehiago gehituko zaio: erabiltzailearen irudiaren esteka (null bada lehenetsitako izango da), erabiltzaile izena, rola eta izena.
         * Informazio guzti hori gero front-ean erabiliko da cookia sortzeko.
         */
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
                        $irudia = null;
                        if($lerro["irudia"] == null){
                            $irudia = "../img/avatar/default.jpg";
                        }else{
                            $irudia = $lerro["irudia"];
                        }
                        $rol = $lerro["rola"];
                        $name = $lerro["izena"];
                    } else{
                        $pass = false;
                    }
                    $info= ["erabil" => $erabil, "pass" => $pass, "username" => $data["erabil"], "rol" => $rol, "name" => $name, "avatar" => $irudia];
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
