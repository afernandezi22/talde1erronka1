<?php
    class Inbentarioa{
        public $etiketa;
        public $idEkipamendu;
        public $erosketaData;

        public function __construct($etiketa, $idEkipamendu, $erosketaData){
            $this -> etiketa = $etiketa;
            $this -> idEkipamendu = $idEkipamendu;
            $this -> erosketaData = $erosketaData;
        }
    }
?>