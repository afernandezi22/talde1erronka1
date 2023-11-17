<?php
    /**
     * Erabiltzailea objektua definitzen duen klasea, bere eraikitzailearekin eta taulan beharrezkoak izango diren parametroekin.
     */
    class Erabiltzailea{
        public $nan;
        public $izena;
        public $abizena;
        public $erabiltzailea;
        public $pasahitza;
        public $rola;
        public $irudia;

        public function __construct($nan, $izena, $abizena, $erabiltzailea, $pasahitza, $rola, $irudia){
            $this -> nan = $nan;
            $this -> izena = $izena;
            $this -> abizena = $abizena;
            $this -> erabiltzailea = $erabiltzailea;
            $this -> pasahitza = $pasahitza;
            $this -> rola = $rola;
            $this -> irudia = $irudia;
        }
    }
?>