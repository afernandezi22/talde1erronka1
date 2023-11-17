<?php
    /**
     * Gutxienez datubaseko klaseak izan behar dituen funtzioak definitzen dituen interfazea.
     */
    interface DefaultDB{
        public function select($sql);
        public function do($sql);
    }
?>