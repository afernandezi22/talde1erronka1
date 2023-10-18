<?php
    class Kategoria{
        public $id;
        public $izena;

        public function __construct($id, $izena){
            $this -> id = $id;
            $this -> izena = $izena;
        }
    }
?>