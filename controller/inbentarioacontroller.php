<?php
    header("Access-Control-Allow-Headers:{$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

    require "controller.php";
    require "../repository/db.php";
    require "../model/inbentarioa.php";
    /**
     * Inbentarioko taula kudeatzeko controller-a
     */
    class InbentarioaController extends Controller{
        /**
         * Ez du parametrorik hartzen eta inbentarioko erregistro guztiak bueltatzen ditu.
         */
        public function getAll(){
            $this -> db = new DB();
            $sql = "SELECT I.etiketa, I.idEkipamendu, E.izena AS izenaEkipamendu, I.erosketaData FROM inbentarioa I, ekipamendua E WHERE I.idEkipamendu = E.id";
            $emaitza = $this -> db -> select($sql);
            if(!$emaitza == null){
                foreach($emaitza as $inbentarioa){
                    $inbentarioak[] = new Inbentarioa($inbentarioa["etiketa"], $inbentarioa["idEkipamendu"], $inbentarioa["izenaEkipamendu"], $inbentarioa["erosketaData"]);
                }
    
                return $inbentarioak;
            }
        }
        /**
         * ID zehatz baten arabera inbentarioko erregistro bat bueltatzen du.
         */
        public function getById($id){
            $this -> db = new DB();
            $sql = "SELECT I.etiketa, I.idEkipamendu, E.izena AS izenaEkipamendu, I.erosketaData FROM inbentarioa I, ekipamendua E WHERE I.idEkipamendu = E.id AND I.etiketa = " . $id;
            $emaitza = $this -> db -> select($sql);
            if(!$emaitza == null){
                foreach($emaitza as $inbentarioa){
                    $inbentarioak[] = new Inbentarioa($inbentarioa["etiketa"], $inbentarioa["idEkipamendu"], $inbentarioa["izenaEkipamendu"], $inbentarioa["erosketaData"]);
                }
    
                return $inbentarioak;
            }
        }
        /**
         * Zutabe eta datu baten arabera lortzen dituen erregistro guztiak bueltatuko ditu.
         */
        public function getByFilter($zutabea, $datua){
            $this -> db = new DB();
            $sql = "SELECT I.etiketa, I.idEkipamendu, E.izena AS izenaEkipamendu, I.erosketaData FROM inbentarioa I, ekipamendua E WHERE I.idEkipamendu = E.id AND I.$zutabea = '" . $datua . "'";
            $emaitza = $this -> db -> select($sql);
            if(!$emaitza == null){
                foreach($emaitza as $inbentarioa){
                    $inbentarioak[] = new Inbentarioa($inbentarioa["etiketa"], $inbentarioa["idEkipamendu"], $inbentarioa["izenaEkipamendu"], $inbentarioa["erosketaData"]);
                }
    
                return $inbentarioak;
            }
        }
        /**
         * UPDATE egiteko funtzioa. Baliozkotze bat dauka: gaurBainoBeranduago funtzioa erabiliz begiratzen du eta aukeratutako data gaur edo beranduago den eta horren arabera UPDATE egingo du edo ez.
         */
        public function put($json){
            $this -> db = new DB();
            $data = json_decode($json, true);
            $beranduago = false;
            //Baliozkotze: data ezin da izan gaur baino beranduago
            if($this -> gaurBainoBeranduago($data["erosketaData"])){
                $beranduago = true;
            } else{
                $beranduago = false;
            }

            if(!$beranduago){
                $sql = "UPDATE inbentarioa SET erosketaData = '" . $data["erosketaData"]
                    . "' WHERE etiketa = '" . $data["etiketa"] . "'";
                if($this -> db -> do($sql)){
                    //return true;
                } else{
                    //return false;
                }
            }
        }
        /**
         * @param $dataStr Data bat string formatuan hartzen du.
         * Erabilgarritasun funtzio bat da. Parametro bezala lortutako data gaur baino beranduago den edo ez bueltatuko du.
         */
        public function gaurBainoBeranduago($dataStr){
            $data = DateTime::createFromFormat("Y-m-d", $dataStr);    
            $gaur = new DateTime();

            if($data > $gaur){
                return true;
            }else {
                return false;
            }
        }
        /**
         * Modu aleatorioan etiketak sortzeko erabilgarritasun funtzio bat da. Gainera begiratzen du ea etiketa hori datu-basean dagoen edo ez bueltatu baino lehen.
         */
        public function etiketaSortu(){
            $this -> db = new DB();

            $abc = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $luzera = 10;
            $match = true;
            
            do{
                $etiketa = '';
                for ($i = 0; $i < $luzera; $i++) {
                    $zbk = mt_rand(0, strlen($abc) - 1);
                    $etiketa = $etiketa . $abc[$zbk];
                }
    
                $sql = "SELECT * FROM inbentarioa WHERE etiketa = '$etiketa'";
                $emaitza = $this -> db -> select($sql);
                if($emaitza == null){
                    $match = false;
                    return $etiketa;
                } else {
                    $match = true;
                }
            }while($match);
        }
        /**
         * INSERT egiteko funtzioa. Baliozkotze bat dauka: begiratzen du erosketa data gaur baino beranduago den edo ez. Bukle baten barruan egiten dira INSERT-ak erregistro bat baino gehiago sortu daitezkelako aldi berean.
         */
        public function post($json){
            $this -> db = new DB();
            $data = json_decode($json, true);
            $beranduago = false;
            //Baliozkotze: data ezin da izan gaur baino beranduago
            if($this -> gaurBainoBeranduago($data["erosketaData"])){
                $beranduago = true;
            } else{
                $beranduago = false;
            }

            if(!$beranduago){
                //Zenbat sartu nahi dituzun begiratzen du
                for($i = 0; $i < $data["zenbat"]; $i++){
                    $sql = "INSERT INTO inbentarioa VALUES ('" . $this -> etiketaSortu()
                        . "', " . $data["idEkipamendu"]
                        . ", '" . $data["erosketaData"] . "')";
                    if($this -> db -> do($sql)){
                        //Insert ONDO egin da. Horregatik EKIPAMENDUA taulan STOCK-a gehitzen du.
                        $sqlUpdate = "UPDATE ekipamendua SET stock = stock + 1 WHERE id = " . $data["idEkipamendu"];
                        if($this -> db -> do($sqlUpdate)){
                            //UPDATE ONDO
                        } else {
                            //UPDATE TXARTO
                        }
                    } else{
                        //return false;
                    }
                }
            }
        }
        /**
         * DELETE egiteko funtzioa. Multzoka egin daiteke eta baliozkotze bat dauka: kokalekuren batean bada ezin da ezabatu. Gainera bat ezabatzean ekipamendu horren stock-a eguneratzen da.
         */
        public function delete($json){
            $this -> db = new DB();
            $data = json_decode($json, true);
            
            $sql = "DELETE FROM inbentarioa WHERE etiketa IN('";
            for($i = 0; $i < count($data["etiketa"]); $i++){
                //Baliozkotzea: begiratzen du etiketa kokalekuren batean dagoen
                $sqlSelect = "SELECT * FROM kokalekua WHERE etiketa = '" . $data["etiketa"][$i] . "'";
                $result = $this -> db -> select($sqlSelect);

                if($result == null){
                    $sqlSelectId = "SELECT idEkipamendu FROM inbentarioa WHERE etiketa = '" . $data["etiketa"][$i] . "'";
                    $emaitza = $this -> db -> select($sqlSelectId);
                    if($emaitza != null){
                        foreach($emaitza as $id){
                            $idak[] = $id["idEkipamendu"]; //sartzen da update egiteko arrayan
                        }
                    }
                    $sql = $sql . $data["etiketa"][$i] . "', '";
                }
            }

            $sql = $sql . "0')";  
            if($this -> db -> do($sql)){
                // DELETE ONDO
                //EKIPAMENDU-ko stock eguneratu idak array-a erabiliz
                if(isset($idak)){
                    for($i = 0; $i < count($idak); $i++){
                        $sql = "UPDATE ekipamendua SET stock = stock - 1 WHERE id = " . $idak[$i];
                        if($this -> db -> do($sql)){
                            //UPDATE ONDO EGIN DA
                        }else{
                            //UPDATE TXARTO EGIN DA
                        }
                    }
                }
            } else{
                // DELETE TXARTO
            }
            
        }
    }

    header("Content-Type: application/json; charset=UTF-8");


    if($_SERVER["REQUEST_METHOD"] === "PUT"){
        $json = file_get_contents('php://input');
        $inbentarioaController = new InbentarioaController();
        $inbentarioaController -> put($json);
    }

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $json = file_get_contents('php://input');
        $inbentarioaController = new InbentarioaController();
        $inbentarioaController -> post($json);
    }

    if($_SERVER["REQUEST_METHOD"] === "DELETE"){
        $json = file_get_contents('php://input');
        $inbentarioaController = new InbentarioaController();
        $inbentarioaController -> delete($json);
    }

    if($_SERVER["REQUEST_METHOD"] === "GET"){
        $inbentarioaController = new InbentarioaController();
        if(isset($_GET["id"])){
            $inbentario = $inbentarioaController -> getById($_GET["id"]);
            echo json_encode($inbentario);
        }elseif(isset($_GET["zutabea"])){
            $inbentario = $inbentarioaController -> getByFilter($_GET["zutabea"], $_GET["datua"]);
            echo json_encode($inbentario);
        }else{
            $inbentario = $inbentarioaController -> getAll();
            echo json_encode($inbentario);
        }
    }
?>