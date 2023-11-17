<?php
    /**
     * Kontroladorean izango dituzten aldagaiak eta funtzioak definitzen dituen klase abstraktua
     */
    abstract class Controller{
        //Gutxienez guztiek datubase bat izango dute
        private $db;
        private $check;
        /**
         * id-aren arabera SELECT egiteko
         */
        abstract function getById($id);
        /**
         * filtroarekin SELECT egiteko
         */
        abstract function getByFilter($zutabea, $datua);
        /**
         * Taula horretako datu guztiak lortzeko
         */
        abstract function getAll();
        /**
         * INSERT bat egiteko
         */
        abstract function post($json);
        /**
         * DELETE egiteko
         */
        abstract function delete($json);
        /**
         * UPDATE egiteko
         */
        abstract function put($json); //
    }
?>