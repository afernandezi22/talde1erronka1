<?php
    class Erabiltzailea{
        private $nan;
        private $izena;
        private $abizena;
        private $erabiltzailea;
        private $pasahitza;
        private $rola;
        private $irudia;

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