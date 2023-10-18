<?php
    class Kokalekua{
        public $etiketa;
        public $idGela;
        public $hasieraData;
        public $amaieraData;

        public function __construct($etiketa, $idGela, $hasieraData, $amaieraData){
            $this -> etiketa = $etiketa;
            $this -> idGela = $idGela;
            $this -> hasieraData = $hasieraData;
            $this -> amaieraData = $amaieraData;
        }
    }
?>