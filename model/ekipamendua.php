<?php
    class Ekipamendua{
        public $id;
        public $izena;
        public $deskribapena;
        public $marka;
        public $modelo;
        public $stock;
        public $idKategoria;

        public function __construct($id, $izena, $deskribapena, $marka, $modelo, $stock, $idKategoria){
            $this -> id = $id;
            $this -> izena = $izena;
            $this -> deskribapena = $deskribapena;
            $this -> marka = $marka;
            $this -> modelo = $modelo;
            $this -> stock = $stock;
            $this -> idKategoria = $idKategoria;
        }
    }
?>