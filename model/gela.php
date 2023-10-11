<?php
    class Gela{
        private $id;
        private $izena;
        private $taldea;

        public function __construct($id, $izena, $taldea){
            $this -> id = $id;
            $this -> izena = $izena;
            $this -> taldea = $taldea;
        }
    }
?>