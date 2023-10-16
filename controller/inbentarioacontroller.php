<?php
    require "controller.php";
    require "../repository/db.php";
    require "../model/inbentarioa.php";
    class InbentarioaController extends Controller{
        public function getAll(){
            $this -> db = new DB();
            $sql = "SELECT * FROM inbentarioa";
            $emaitza = $this -> db -> select($sql);
            foreach($emaitza as $inbentarioa){
                $inbentarioak[] = new Inbentarioa($inbentarioa["etiketa"], $inbentarioa["idEkipamendu"], $inbentarioa["erosketaData"]);
            }

            return $inbentarioak;
        }

        public function getById($id){
            $this -> db = new DB();
            $sql = "SELECT * FROM inbentarioa WHERE id = " . $id;
            $emaitza = $this -> db -> select($sql);
            foreach($emaitza as $inbentarioa){
                $inbentarioak[] = new Inbentarioa($inbentarioa["etiketa"], $inbentarioa["idEkipamendu"], $inbentarioa["erosketaData"]);
            }

            return $inbentarioak;
        }
    }
?>