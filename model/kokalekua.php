<?php
    class Kokalekua{
        private $etiketa;
        private $idGela;
        private $hasieraData;
        private $amaieraData;

        public function __construct($etiketa, $idGela, $hasieraData, $amaieraData){
            $this -> etiketa = $etiketa;
            $this -> idGela = $idGela;
            $this -> hasieraData = $hasieraData;
            $this -> amaieraData = $amaieraData;
        }
    }
?>