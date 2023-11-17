<?php
    header("Access-Control-Allow-Headers:{$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

    require "controller.php";
    require "../repository/db.php";
    require "../model/gela.php";
    /**
     * Gelako taula kudeatzeko controller-a
     */
    class GelaController extends Controller{
        /**
         * Ez du parametrorik hartzen eta gela zerrenda osoa bueltatzen du.
         */
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
        /**
         * ID zehatz bat duen gela bueltatuko du.
         */
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
        /**
         * Zutabe eta datu zehatz baten arabera gela multzoa bueltatuko du.
         */
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
        /**
         * UPDATE egiteko funtzioa. Baliozkotze bat dauka: beste gelaren bat badago izen berarekin ez du UPDATE-a egingo.
         */
        public function put($json){
            $this -> db = new DB();
            $data = json_decode($json, true);

            //Baliozkotze: begiratzen du ea beste gelaren bat dagoen izen berarekin
            $sqlSelect = "SELECT * FROM gela WHERE izena = '" . $data["izena"] . "'";
            $result = $this -> db -> select($sqlSelect);
            foreach($result as $gela){
                $gelak[] = new Gela($gela["id"], $gela["izena"], $gela["taldea"]);
            }

            if($result == null || $data["id"] == $gelak[0] -> getId()){
                $sql = "UPDATE gela SET izena = '" . $data["izena"]
                    . "', taldea = '" . $data["taldea"]
                    . "' WHERE id = " . $data["id"];
                if($this -> db -> do($sql)){
                    // return true;
                } else{
                    // return false;
                }
            }
        }
        /**
         * INSERT egiteko funtzioa. Baliozkotze bat dauka: beste gelaren bat badago izen berarekin ez du UPDATE-a egingo.
         */
        public function post($json){
            $this -> db = new DB();
            $data = json_decode($json, true);

            //Baliozkotze: begiratzen du ea beste gelaren bat dagoen izen berarekin
            $sqlSelect = "SELECT * FROM gela WHERE izena = '" . $data["izena"] . "'";
            $result = $this -> db -> select($sqlSelect);
            if($result == null){
                $sql = "INSERT INTO gela (izena, taldea) VALUES ('" . $data["izena"]
                    . "', '" . $data["taldea"] . "')";
                if($this -> db -> do($sql)){
                    // INSERT ONDO
                } else{
                    // INSERT TXARTO
                }
            }
        }
        /**
         * DELETE egiteko funtzioa. Multzoka egiten du eta baliozkotze bat dauka: kokalekua taulan agertzen bada ez da ezabatuko.
         */
        public function delete($json){
            $this -> db = new DB();
            $data = json_decode($json, true);

            $sql = "DELETE FROM gela WHERE id IN(";
            for($i = 0; $i < count($data["id"]); $i++){
                //Baliozkotzea: begiratzen du ea gela kokalekuan agertzen den
                $sqlSelect = "SELECT * FROM kokalekua WHERE idGela = " . $data["id"][$i];
                $result = $this -> db -> select($sqlSelect);

                if($result == null){
                    $sql = $sql . $data["id"][$i] . ", ";
                }
            }

            $sql = $sql . "0)";

            if($this -> db -> do($sql)){
                //return true;
            } else{
                // return true;
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