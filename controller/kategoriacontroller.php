<?php
    header("Access-Control-Allow-Headers:{$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

    require "controller.php";
    require "../repository/db.php";
    require "../model/kategoria.php";
    /**
     * Kategoriako taula kudeatzeko controller-a
     */
    class KategoriaController extends Controller{
        /**
         * Ez du parametrorik hartzen eta kategoria guztiak bueltatzen ditu
         */
        public function getAll(){
            $this -> db = new DB();
            $sql = "SELECT * FROM kategoria";
            $emaitza = $this -> db -> select($sql);
            if(!$emaitza == null){
                foreach($emaitza as $kategoria){
                    $kategoriak[] = new Kategoria($kategoria["id"], $kategoria["izena"]);
                }
    
                return $kategoriak;
            }
        }
        /**
         * ID zehatz bat duen kategoria bueltatzen du
         */
        public function getById($id){
            $this -> db = new DB();
            $sql = "SELECT * FROM kategoria WHERE id = " . $id;
            $emaitza = $this -> db -> select($sql);
            if(!$emaitza == null){
                foreach($emaitza as $kategoria){
                    $kategoriak[] = new Kategoria($kategoria["id"], $kategoria["izena"]);
                }
    
                return $kategoriak;
            }
        }
        /**
         * Zutabe eta datu baten arabera lortzen dituen kategoriak bueltatzen ditu
         */
        public function getByFilter($zutabea, $datua){
            $this -> db = new DB();
            $sql = "SELECT * FROM kategoria WHERE " . $zutabea. " = '" . $datua . "'"; 
            $emaitza = $this -> db -> select($sql);
            if(!$emaitza == null){
                foreach($emaitza as $kategoria){
                    $kategoriak[] = new Kategoria($kategoria["id"], $kategoria["izena"]);
                }
    
                return $kategoriak;
            }
        }
        /**
         * UPDATE egiteko futzioa. Baliozkotze bat dauka: beste kategoria bat badago kategoria izen berarekin ez du ezer egingo.
         */
        public function put($json){
            $this -> db = new DB();
            $data = json_decode($json, true);

            //Baliozkotzea: kategoria izena ezin da errepikatu
            $sql = "SELECT * FROM kategoria WHERE izena = '" . $data["izena"] ."'";
            $result = $this -> db -> select($sql);
            if($result == null){
                $sql = "UPDATE kategoria SET izena = '" . $data["izena"]
                    . "' WHERE id = " . $data["id"];
                if($this -> db -> do($sql)){
                    //Ondo
                } else{
                    //Txarto
                }
            } else {
                //Errorea badagoelako kategoria izen horrekin
            }
        }
        /**
         * INSERT egiteko futzioa. Baliozkotze bat dauka: beste kategoria bat badago kategoria izen berarekin ez du ezer egingo.
         */
        public function post($json){
            $this -> db = new DB();
            $data = json_decode($json, true);

            //Baliozkotzea: kategoria izena ezin da errepikatu
            $sql = "SELECT * FROM kategoria WHERE izena = '" . $data["izena"] ."'";
            $result = $this -> db -> select($sql);
            if($result == null){
                $sql = "INSERT INTO kategoria (izena) VALUES ('" . $data["izena"] . "')";
                if($this -> db -> do($sql)){
                    //Ondo
                } else{
                    //Txarto
                }
            } else {
                //Errorea badagoelako kategoria izen horrekin
            }
        }
        /**
         * DELETE egiteko futzioa. Multzoka egingo du eta baliozkotze bat dauka: ekipamenduren bat badago ekipamenduko taula kategoria horrekin ez da ezabatuko.
         */
        public function delete($json){
            $this -> db = new DB();
            $data = json_decode($json, true);
            $sql = "DELETE FROM kategoria WHERE id IN(";
            for($i = 0; $i < count($data["id"]); $i++){
                //Baliozkotzea: ez da gehituko ezabatzeko array-ra ekipamenduko taulan kategoria horren ekipamendua badago
                $sqlSelect = "SELECT * FROM ekipamendua WHERE idKategoria = " . $data["id"][$i];
                $result = $this -> db -> select($sqlSelect);
                if($result == null){
                    $sql = $sql . $data["id"][$i] . ",";
                } else {
                    //Baliozkotzea: ez da ezabatuko
                }
            }
            $sql = $sql . "0)";
            if($this -> db -> do($sql)){
                //Ondo
                return true;
            } else{
                //Txarto
                return true;
            }
        }
    }

    header("Content-Type: application/json; charset=UTF-8");


    if($_SERVER["REQUEST_METHOD"] === "PUT"){
        $json = file_get_contents('php://input');
        $kategoriaController = new KategoriaController();
        $kategoriaController -> put($json);
    }

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $json = file_get_contents('php://input');
        $kategoriaController = new KategoriaController();
        $kategoriaController -> post($json);
    }

    if($_SERVER["REQUEST_METHOD"] === "DELETE"){
        $json = file_get_contents('php://input');
        $kategoriaController = new KategoriaController();
        $kategoriaController -> delete($json);
    }

    if($_SERVER["REQUEST_METHOD"] === "GET"){
        $kategoriaController = new KategoriaController();
        if(isset($_GET["id"])){
            $kategoria = $kategoriaController -> getById($_GET["id"]);
            echo json_encode($kategoria);
        }elseif(isset($_GET["zutabea"])){
            $kategoria = $kategoriaController -> getByFilter($_GET["zutabea"], $_GET["datua"]);
            echo json_encode($kategoria);
        }else{
            $kategoria = $kategoriaController -> getAll();
            echo json_encode($kategoria);
        }
    }
?>