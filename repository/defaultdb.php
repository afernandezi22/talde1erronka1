<?php
    interface DefaultDB{
        public function select($sql);
        public function do($sql);
    }
?>