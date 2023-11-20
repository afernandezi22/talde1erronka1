<?php
    /**
     * Inbentarioa objektua definitzen duen klasea, bere eraikitzailearekin eta taulan beharrezkoak izango diren parametroekin.
     */
    class Inbentarioa{
        public $etiketa;
        public $idEkipamendu;
        public $izenaEkipamendu;
        public $erosketaData;

        public function __construct($etiketa, $idEkipamendu, $izenaEkipamendu, $erosketaData){
            $this -> etiketa = $etiketa;
            $this -> idEkipamendu = $idEkipamendu;
            $this -> izenaEkipamendu = $izenaEkipamendu;
            $this -> erosketaData = $erosketaData;
        }
    }
?>