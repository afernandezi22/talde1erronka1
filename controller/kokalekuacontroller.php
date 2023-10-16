<?php
    require "controller.php";
    require "../repository/db.php";
    require "../model/kokalekua.php";
    class KokalekuaController extends Controller{
        public function getAll(){
            $this -> db = new DB();
            $sql = "SELECT * FROM kokalekua";
            $emaitza = $this -> db -> select($sql);
            foreach($emaitza as $kokalekua){
                $kokalekuak[] = new Kokalekua($kokalekua["etiketa"], $kokalekua["idGela"], $kokalekua["hasieraData"], $kokalekua["amaieraData"]);
            }

            return $kategoriak;
        }

        public function getById($id){
            $this -> db = new DB();
            $sql = "SELECT * FROM kokalekua WHERE id = " . $id;
            $emaitza = $this -> db -> select($sql);
            foreach($emaitza as $kokalekua){
                $kokalekuak[] = new Kokalekua($kokalekua["etiketa"], $kokalekua["idGela"], $kokalekua["hasieraData"], $kokalekua["amaieraData"]);
            }

            return $kokalekuak;
        }
    }
?>