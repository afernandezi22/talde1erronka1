<?php
    /**
     * Kategoria objektua definitzen duen klasea, bere eraikitzailearekin eta taulan beharrezkoak izango diren parametroekin.
     */
    class Kategoria{
        public $id;
        public $izena;

        public function __construct($id, $izena){
            $this -> id = $id;
            $this -> izena = $izena;
        }
    }
?>