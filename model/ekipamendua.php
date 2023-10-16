<?php
    class Ekipamendua{
        private $id;
        private $izena;
        private $deskribapena;
        private $marka;
        private $modelo;
        private $stock;
        private $idKategoria;

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