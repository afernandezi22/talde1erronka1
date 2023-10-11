<?php
    include "defaultdb.php";
    class DB implements DefaultDB{
        private $servername;
        private $username;
        private $password;
        private $database;
        private $conn;

        public function __construct(){
            $this -> servername = "localhost";
            $this -> username = "root";
            $this -> password = "";
            $this -> database = "3wag2e1";
        }

        private function connect(){
            $this -> conn = new mysqli($this -> servername, $this -> username, $this -> password, $this -> database);
            
            //Konexioa begiratu
            if($this -> conn -> connect_error){
                die("Connection failed: " . $this -> conn -> connect_error);
            }

            return $this -> conn;
        }

        public function select($sql){
            $this -> connect();
            $emaitza = $this -> conn -> query($sql);
            if ($emaitza -> num_rows > 0){
                return $emaitza;
            }else{
                return 0;
            }
            $this -> conn -> close();
        }

        public function do($sql){
            $this -> connect();
            if ($emaitza = $this -> conn -> query($sql)){
                return $emaitza;
            }else{
                return 0;
            }
            $this -> conn -> close();
        }
    }
?>