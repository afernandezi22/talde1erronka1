<?php
    include "defaultdb.php";
    //Datubaserako konexioak sortzkeo klasea
    class DB implements DefaultDB{
        private $servername;
        private $username;
        private $password;
        private $database;
        private $conn;

        //Sortzailea
        public function __construct(){
            $this -> servername = "localhost";
            $this -> username = "root";
            $this -> password = "";
            $this -> database = "3wag2e1";
        }

        //Datubasera konektatzeko funtzioa
        private function connect(){
            $this -> conn = new mysqli($this -> servername, $this -> username, $this -> password, $this -> database);
            
            //Konexioa begiratu
            if($this -> conn -> connect_error){
                die("Connection failed: " . $this -> conn -> connect_error);
            }

            return $this -> conn;
        }

        //SELECT egiteko erabiltzen den funtzioa
        public function select($sql){
            //Konexioa sortu
            $this -> connect();
            //Emaitza lortu kontsulta eginez
            $emaitza = $this -> conn -> query($sql);
            //0 baino gehiagoko erantzuna ematen badu emaitza bueltatu, bestela 0 bueltatu
            if ($emaitza -> num_rows > 0){
                return $emaitza;
            }else{
                return 0;
            }
            //Konexioa itxi
            $this -> conn -> close();
        }

        //INSERT, UPDATE eta DELETE egiteko erabiltzen den funtzioa
        public function do($sql){
            //Konexioa sortu
            $this -> connect();
            //Sententzia ondo exekutatzen bada emaitza bueltatu, bestela 0 bueltatu
            if ($emaitza = $this -> conn -> query($sql)){
                return $emaitza;
            }else{
                return 0;
            }
            //Konexioa itxi
            $this -> conn -> close();
        }
    }
?>