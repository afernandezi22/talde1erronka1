<?php
    //Datubaseko klaseak izan behar dituen funtzioen definizioa
    interface DefaultDB{
        public function select($sql);
        public function do($sql);
    }
?>