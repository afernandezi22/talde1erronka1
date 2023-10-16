<?php
    require "controller.php";
    require "../repository/db.php";
    require "../model/erabiltzailea.php";
    class ErabiltzaileaController extends Controller{
        public function getAll(){
            $this -> db = new DB();
            $sql = "SELECT * FROM erabiltzailea";
            $emaitza = $this -> db -> select($sql);
            foreach($emaitza as $erabiltzailea){
                $erabiltzaileak[] = new Erabiltzailea($erabiltzailea["nan"], $erabiltzailea["izena"], $erabiltzailea["abizena"], $erabiltzailea["erabiltzailea"], $erabiltzailea["pasahitza"], $erabiltzailea["rola"], $erabiltzailea["irudia"]);
            }

            return $erabiltzaileak;
        }

        public function getById($id){
            $this -> db = new DB();
            $sql = "SELECT * FROM erabiltzailea WHERE id = " . $id;
            $emaitza = $this -> db -> select($sql);
            foreach($emaitza as $erabiltzailea){
                $erabiltzaileak[] = new Erabiltzailea($erabiltzailea["nan"], $erabiltzailea["izena"], $erabiltzailea["abizena"], $erabiltzailea["erabiltzailea"], $erabiltzailea["pasahitza"], $erabiltzailea["rola"], $erabiltzailea["irudia"]);
            }

            return $erabiltzaileak;
        }
    }
?>