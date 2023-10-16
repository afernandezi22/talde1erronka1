<?php
    class Kategoria{
        private $id;
        private $izena;

        public function __construct($id, $izena){
            $this -> id = $id;
            $this -> izena = $izena;
        }
    }
?>