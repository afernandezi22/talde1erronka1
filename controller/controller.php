<?php
    //Kontroladorean izango dituzten aldagaiak eta funtzioak definitzen dituen klase abstraktua
    abstract class Controller{
        //Gutxienez guztiek datubase bat izango dute
        private $db;
        private $check;

        abstract function getById($id); //id-aren arabera SELECT egiteko
        abstract function getAll(); //Taula horretako datu guztiak lortzeko
        abstract function post($json); //INSERT bat egiteko
        abstract function delete($json); //DELETE egiteko
        abstract function put($json); //UPDATE egiteko
    }
?>