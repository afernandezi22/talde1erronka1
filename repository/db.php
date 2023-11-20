<?php
    include "defaultdb.php";
    /**
     * Datubaserako konexioak sortzeko klasea
     */
    class DB implements DefaultDB{
        private $servername;
        private $username;
        private $password;
        private $database;
        private $conn;

        /**
         * Lehenetsitako eraikitzailea
         */
        public function __construct(){
            $this -> servername = "192.168.201.101";
            $this -> username = "root";
            $this -> password = "root";
            $this -> database = "3wag2e1";
        }

        /**
         * Konexioa sortzeko funtzioa. Konexioa bueltatzen du.
         */
        private function connect(){
            $this -> conn = new mysqli($this -> servername, $this -> username, $this -> password, $this -> database);
            
            //Konexioa begiratu
            if($this -> conn -> connect_error){
                die("Connection failed: " . $this -> conn -> connect_error);
            }

            return $this -> conn;
        }

        /**
         * SELECT diren kontsultak egiteko erabiltzen den funtzioa. Kontsulta bueltatzen du.
         */
        public function select($sql){
            //Konexioa sortu
            $this -> connect();
            //Emaitza lortu kontsulta eginez
            //0 baino gehiagoko erantzuna ematen badu emaitza bueltatu, bestela 0 bueltatu

            try{
                $emaitza = $this -> conn -> query($sql);
                if ($emaitza -> num_rows > 0){
                    //Konexioa itxi
                    $this -> conn -> close();
                    return $emaitza;
                }else{
                    //Konexioa itxi
                    $this -> conn -> close();
                    return null;
                }
            } catch (Exception $e) {
                //echo "ERROREA " . $e;
            }
        }

        /**
         * INSERT, UPDATE edo DELETE diren sententziak exekutatzeko erabiltzen den funtzioa.
         */
        public function do($sql){
            //Konexioa sortu
            $this -> connect();
            //Sententzia ondo exekutatzen bada emaitza bueltatu, bestela 0 bueltatu
            if ($emaitza = $this -> conn -> query($sql)){
                //Konexioa itxi
                $this -> conn -> close();
                return $emaitza;
            }else{
                //Konexioa itxi
                $this -> conn -> close();
                return 0;
            }
        }
    }
?>