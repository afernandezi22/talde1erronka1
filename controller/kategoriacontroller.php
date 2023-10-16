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
            foreach($emaitza as $kategoria){
                $kategoriak[] = new Kategoria($kategoria["id"], $kategoria["izena"]);
            }

            return $kategoriak;
        }
    }
?>