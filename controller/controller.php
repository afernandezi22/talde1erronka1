<?php
    abstract class Controller{
        private $db;

        abstract function getById($id);
        abstract function getAll();
        // abstract function post($json);
        // abstract function delete($json);
        abstract function put($json);
    }
?>