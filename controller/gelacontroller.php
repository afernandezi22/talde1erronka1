<?php
    require "controller.php";
    require "../repository/db.php";
    require "../model/gela.php";
    class GelaController extends Controller{
        public function getAll(){
            $this -> db = new DB();
            $sql = "SELECT * FROM gela";
            $emaitza = $this -> db -> select($sql);
            foreach($emaitza as $gela){
                $gelak[] = new Gela($gela["id"], $gela["izena"], $gela["taldea"]);
            }

            return $gelak;
        }

        public function getById($id){
            $this -> db = new DB();
            $sql = "SELECT * FROM gela WHERE id = " . $id;
            $emaitza = $this -> db -> select($sql);
            foreach($emaitza as $gela){
                $gelak[] = new Gela($gela["id"], $gela["izena"], $gela["taldea"]);
            }

            return $gelak;
        }
    }

    $froga = new GelaController();
    $emaitza = $froga -> getById(2);
    var_dump($emaitza);
?>