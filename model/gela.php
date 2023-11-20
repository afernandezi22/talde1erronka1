<?php
    /**
     * Gela objektua definitzen duen klasea, bere eraikitzailearekin eta taulan beharrezkoak izango diren parametroekin.
     */
    class Gela{
        public $id;
        public $izena;
        public $taldea;

        public function __construct($id, $izena, $taldea){
            $this -> id = $id;
            $this -> izena = $izena;
            $this -> taldea = $taldea;
        }

        public function getId(){
            return $this -> id;
        }
    }
?>