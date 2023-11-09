<?php
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