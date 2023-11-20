<?php
    /**
     * Kokalekua objektua definitzen duen klasea, bere eraikitzailearekin eta taulan beharrezkoak izango diren parametroekin.
     */
    class Kokalekua{
        public $etiketa;
        public $ekipamenduIzena;
        public $idGela;
        public $gelaIzena;
        public $hasieraData;
        public $amaieraData;

        public function __construct($etiketa, $ekipamenduIzena, $idGela, $gelaIzena, $hasieraData, $amaieraData){
            $this -> etiketa = $etiketa;
            $this -> ekipamenduIzena = $ekipamenduIzena;
            $this -> idGela = $idGela;
            $this -> gelaIzena = $gelaIzena;
            $this -> hasieraData = $hasieraData;
            $this -> amaieraData = $amaieraData;
        }
    }
?>