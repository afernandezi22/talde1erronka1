<?php
    /**
     * Ekipamendua objektua definitzen duen klasea, bere eraikitzailearekin eta taulan beharrezkoak izango diren parametroekin.
     */
    class Ekipamendua{
        public $id;
        public $izena;
        public $deskribapena;
        public $marka;
        public $modelo;
        public $stock;
        public $idKategoria;
        public $kategoriaIzena;

        public function __construct($id, $izena, $deskribapena, $marka, $modelo, $stock, $idKategoria, $kategoriaIzena){
            $this -> id = $id;
            $this -> izena = $izena;
            $this -> deskribapena = $deskribapena;
            $this -> marka = $marka;
            $this -> modelo = $modelo;
            $this -> stock = $stock;
            $this -> idKategoria = $idKategoria;
            $this -> kategoriaIzena = $kategoriaIzena;
        }
    }
?>