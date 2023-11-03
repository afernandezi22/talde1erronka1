<?php
    require "controller.php";
    require "../repository/db.php";
    require "../model/kategoria.php";
    class KategoriaController extends Controller{
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

        public function put($json){
            $this -> db = new DB();
            $data = json_decode($json, true);

            //Baliozkotzea: kategoria izena ezin da errepikatu
            $sql = "SELECT * FROM kategoria WHERE izena = '" . $data["izena"] ."'";
            $result = $this -> db -> select($sql);
            if($result -> num_rows < 0){
                $sql = "UPDATE kategoria SET izena = '" . $data["izena"]
                    . "' WHERE id = " . $data["id"];
                if($this -> db -> do($sql)){
                    //Ondo
                } else{
                    //Txarto
                }
            } else {
                //Errorea badagoelako kategoria izen horrekin
                //throw new Exception("Badago kategoria izen horrekin!");
            }
        }

        public function post($json){
            $this -> db = new DB();
            $data = json_decode($json, true);

            //Baliozkotzea: kategoria izena ezin da errepikatu
            $sql = "SELECT * FROM kategoria WHERE izena = '" . $data["izena"] ."'";
            $result = $this -> db -> select($sql);
            if($result -> num_rows < 0){
                $sql = "INSERT INTO kategoria (izena) VALUES ('" . $data["izena"] . "')";
                if($this -> db -> do($sql)){
                    //Ondo
                } else{
                    //Txarto
                }
            } else {
                //Errorea badagoelako kategoria izen horrekin
                //throw new Exception("Badago kategoria izen horrekin!");
            }
        }

        public function delete($json){
            $this -> db = new DB();
            $data = json_decode($json, true);
            $sql = "DELETE FROM kategoria WHERE id IN(";
            $lehenengoa = true;
            for($i = 0; $i < count($data["id"]); $i++){
                //Baliozkotzea: ez da gehituko ezabatzeko array-ra ekipamenduko taulan kategoria horren ekipamendua badago
                $sqlSelect = "SELECT * FROM ekipamendua WHERE idKategoria = " . $data["id"][$i];
                $result = $this -> db -> select($sqlSelect);
                if($result -> num_rows < 0){
                    if($lehenengoa){
                        $sql = $sql . $data["id"][$i] . ",";
                        $lehenengoa = false;
                    }else{
                        $sql = $sql . $data["id"][$i] . ",";
                    }
                } else {
                    //Baliozkotzea: ez da ezabatuko
                    //throw new Exception("Badago kategoria izen horrekin!");
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