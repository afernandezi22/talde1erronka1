<?php
    require "controller.php";
    require "../repository/db.php";
    require "../model/kategoria.php";
    class KategoriaController extends Controller{
        public function getAll(){
            $this -> db = new DB();
            $sql = "SELECT * FROM kategoria";
            $emaitza = $this -> db -> select($sql);
            foreach($emaitza as $kategoria){
                $kategoriak[] = new Kategoria($kategoria["id"], $kategoria["izena"]);
            }

            return $kategoriak;
        }

        public function getById($id){
            $this -> db = new DB();
            $sql = "SELECT * FROM kategoria WHERE id = " . $id;
            $emaitza = $this -> db -> select($sql);
            if(is_array($emaitza)){
                foreach($emaitza as $kategoria){
                    $kategoriak[] = new Kategoria($kategoria["id"], $kategoria["izena"]);
                }
    
                return $kategoriak;
            }
        }

        public function put($json){
            $this -> db = new DB();
            $data = json_decode($json, true);
            $sql = "UPDATE kategoria SET izena = " . $data["izena"]
                . " WHERE id = " . $data["id"];
            if($this -> db -> do($sql)){
                return true;
            } else{
                return false;
            }
        }

        public function post($json){
            $this -> db = new DB();
            $data = json_decode($json, true);
            $sql = "INSERT INTO kategoria (izena) VALUES ('" . $data["izena"] . "')";
            if($this -> db -> do($sql)){
                return true;
            } else{
                return false;
            }
        }

        public function delete($json){
            $this -> db = new DB();
            $data = json_decode($json, true);
            $sql = "DELETE FROM kategoria WHERE id IN(";
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
        }else{
            $kategoria = $kategoriaController -> getAll();
            echo json_encode($kategoria);
        }
    }
?>