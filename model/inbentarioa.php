<?php
    class Inbentarioa{
        private $etiketa;
        private $idEkipamendu;
        private $erosketaData;

        public function __construct($etiketa, $idEkipamendu, $erosketaData){
            $this -> etiketa = $etiketa;
            $this -> idEkipamendu = $idEkipamendu;
            $this -> erosketaData = $erosketaData;
        }
    }
?>