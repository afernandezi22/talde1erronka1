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
    }
?>