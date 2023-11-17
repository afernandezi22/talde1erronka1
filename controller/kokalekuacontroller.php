<?php
    header("Access-Control-Allow-Headers:{$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

    require "controller.php";
    require "../repository/db.php";
    require "../model/kokalekua.php";
    /**
     * Kokalekuko taula kudeatzeko controller-a
     */
    class KokalekuaController extends Controller{
        /**
         * Ez du parametrorik hartzen eta kokalekuko taulako erregistro guztiak bueltatzen ditu
         */
        public function getAll(){
            $this -> db = new DB();
            $sql = "SELECT K.etiketa as etiketa, E.izena as ekipamenduIzena, K.idGela as idGela, G.izena as gelaIzena, K.hasieraData as hasieraData, K.amaieraData as amaieraData  
            FROM ekipamendua E, gela G, inbentarioa I, kokalekua K 
            WHERE K.etiketa = I.etiketa 
            AND I.idEkipamendu =  E.id
            AND K.idGela = G.id";
            $emaitza = $this -> db -> select($sql);
            foreach($emaitza as $kokalekua){
                $kokalekuak[] = new Kokalekua($kokalekua["etiketa"], $kokalekua["ekipamenduIzena"], $kokalekua["idGela"], $kokalekua["gelaIzena"], $kokalekua["hasieraData"], $kokalekua["amaieraData"]);
            }

            return $kokalekuak;
        }
        /**
         * Metodo hau taula honetan ez da erabiltzen, baina agertu behar da klase abstraktuan agertzen delako.
         */
        public function getById($id){
            $this -> db = new DB();
            $sql = "SELECT * FROM kokalekua WHERE id = " . $id;
            $emaitza = $this -> db -> select($sql);
            if(!$emaitza == null){
                foreach($emaitza as $kokalekua){
                    $kokalekuak[] = new Kokalekua($kokalekua["etiketa"], $kokalekua["ekipamenduIzena"], $kokalekua["idGela"], $kokalekua["gelaIzena"], $kokalekua["hasieraData"], $kokalekua["amaieraData"]);
                }
    
                return $kokalekuak;
            }
        }
        /**
         * Zutabe eta datu baten arabera kokalekuko erregistroak bueltatzen ditu.
         */
        public function getByFilter($zutabea, $datua){
            $this -> db = new DB();
            $sql = "SELECT K.etiketa as etiketa, E.izena as ekipamenduIzena, K.idGela as idGela, G.izena as gelaIzena, K.hasieraData as hasieraData, K.amaieraData as amaieraData  
            FROM ekipamendua E, gela G, inbentarioa I, kokalekua K 
            WHERE K.etiketa = I.etiketa 
            AND I.idEkipamendu =  E.id
            AND K.idGela = G.id
            AND " . $zutabea . " = '" . $datua . "'";
            $emaitza = $this -> db -> select($sql);
            if($emaitza != null){
                foreach($emaitza as $kokalekua){
                    $kokalekuak[] = new Kokalekua($kokalekua["etiketa"], $kokalekua["ekipamenduIzena"], $kokalekua["idGela"], $kokalekua["gelaIzena"], $kokalekua["hasieraData"], $kokalekua["amaieraData"]);
                }
                return $kokalekuak;
            }else{
                return null;
            }
        }
        /**
         * Libre dauden ekipamenduak bueltatzen ditu. Hau da: noizbait erabili direnak baina orain libre daudenak + inoiz ez erabili ez direnak. Gainera bikoiztuta badaude bakarrik mota bakoitzeko bat agertuko da.
         */
        public function getFreeEkipamendu(){
            $this -> db = new DB();
            $sqlSelect = "SELECT
            etiketa,
            izena
        FROM
            (
                SELECT
                    I.etiketa AS etiketa,
                    E.izena AS izena
                FROM
                    inbentarioa I
                JOIN ekipamendua E ON I.idEkipamendu = E.id
                WHERE etiketa NOT IN (
                        SELECT etiketa
                        FROM kokalekua
                    )
                
                UNION
                
                SELECT
                    K.etiketa AS etiketa,
                    E.izena AS izena
                FROM
                    kokalekua K
                JOIN inbentarioa I ON K.etiketa = I.etiketa
                JOIN ekipamendua E ON I.idEkipamendu = E.id
                WHERE
                    K.etiketa NOT IN (
                        SELECT etiketa
                        FROM kokalekua
                        WHERE amaieraData IS NULL
                    )
                    AND amaieraData < CURRENT_DATE
            ) AS subquery
        GROUP BY
            izena";
            $emaitza = $this -> db -> select($sqlSelect);
            $etiketak = []; 
            foreach($emaitza as $libre){
                $libreak[] = array("etiketa" => $libre["etiketa"], "izena" => $libre["izena"]);
            }

            return $libreak;
        }
        /**
         * Guztira zenbat portatil dauden eta zenbat LIBRE dauden bueltatuko duen funtzioa.
         */
        public function getZenbatPortatil(){
            $this -> db = new DB();
            $sql = "SELECT SUM(STOCK) AS TOTAL
            FROM ekipamendua
            WHERE idKategoria = 4";
            $emaitza = $this -> db -> select($sql);
            if($emaitza != null){
                foreach($emaitza as $total){
                    $zenbat["TOTAL"] = $total["TOTAL"];
                }
            } else{
                $zenbat["TOTAL"] = 0;
            }

            $sql = "SELECT COUNT(ETIKETA) AS TOTAL FROM (
                        SELECT I.etiketa AS ETIKETA
                        FROM inbentarioa I, ekipamendua E
                        WHERE I.etiketa NOT IN (
                            SELECT etiketa
                            FROM kokalekua
                        ) AND I.idEkipamendu = E.id
                        AND E.idKategoria = 4
                        UNION
                        SELECT K.etiketa AS ETIKETA
                        FROM kokalekua K, inbentarioa I, ekipamendua E
                        WHERE K.etiketa NOT IN (
                            SELECT etiketa
                            FROM kokalekua
                            WHERE amaieraData IS NULL
                        ) AND K.amaieraData < CURRENT_DATE
                        AND K.etiketa = I.etiketa
                        AND I.idEkipamendu = E.id
                        AND E.idKategoria = 4
                ) AS TOTAL";
            $emaitza = $this -> db -> select($sql);
            if($emaitza != null){
                foreach($emaitza as $total){
                    $zenbat["LIBRE"] = $total["TOTAL"];
                }
            } else{
                $zenbat["LIBRE"] = 0;
            }

            return $zenbat;
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
         * UPDATE egiteko funtzioa. Baliozkotze bikoitz bat dauka: hasieraData gaur baino lehenago den eta amaieraData gaur baino beranduago den begiratzen du.
         */
        public function put($json){
            $this -> db = new DB();
            $data = json_decode($json, true);
            if($data["amaieraData"] == "null"){
                $sql = "UPDATE kokalekua SET amaieraData = null WHERE etiketa = '" . $data["etiketa"] . "' AND hasieraData = '" . $data["hasieraData"] . "'";
            //Baliozkotzea: begiratzen du ea hasieraData gaur baino beranduago den edo amaieraData gaur baino lehenago den
            } else if(!($this -> gaurBainoBeranduago($data["hasieraData"])) && $this -> gaurBainoBeranduago($data["amaieraData"])){
                $sql = "UPDATE kokalekua SET amaieraData = '" . $data["amaieraData"]
                    . "' WHERE etiketa = '" . $data["etiketa"] . "' AND hasieraData = '" . $data["hasieraData"] . "'";
            }
                
            if($this -> db -> do($sql)){
                // UPDATE ondo
            } else{
                // UPDATE txarto
            }
                
        }
        /**
         * INSERT egiteko funtzioa. Baliozkotze batzuk dauzka: hasieraData gaur baino lehenago den eta amaieraData gaur baino beranduago den begiratzen du.
         * Erabiliko den ekipamendua libre dagoen edo ez begiratuko du ere.
         */
        public function post($json){
            $this -> db = new DB();
            $data = json_decode($json, true);
            //Baliozkotzea: begiratu behar da erabiliko den ekipamendua libre dagoen. 
            //Hau da: kokalekuan okupatuta agertzen EZ dela edo kokalekuan agertzen ez dela (inoiz ez delako erabili)
            $sqlSelect = "SELECT etiketa
            FROM inbentarioa
            WHERE etiketa NOT IN (
            SELECT etiketa
            FROM kokalekua
            ) 
            UNION
            SELECT etiketa
                        FROM kokalekua
                        WHERE etiketa NOT IN (
                        SELECT etiketa
                        FROM kokalekua
                        WHERE amaieraData IS NULL
                        ) AND amaieraData < CURRENT_DATE
                        AND etiketa = '" . $data["etiketa"] . "'";
            $result = $this -> db -> select($sqlSelect);
            if($result != null){
                //Baliozkotzea: begiratzen du ea hasieraData gaur baino beranduago den edo amaieraData gaur baino lehenago den
                if(!($this -> gaurBainoBeranduago($data["hasieraData"])) || $this -> gaurBainoBeranduago($data["amaieraData"])){
                    if($data["amaieraData"] == "null"){
                        $sql = "INSERT INTO kokalekua (etiketa, idGela, hasieraData) VALUES('" . $data["etiketa"]
                        . "', '" . $data["idGela"]
                        . "', '" . $data["hasieraData"] ."')"; 
                    } else{
                        $sql = "INSERT INTO kokalekua VALUES ('" . $data["etiketa"]
                            . "', '" . $data["idGela"]
                            . "', '" . $data["hasieraData"]
                            . "', '" . $data["amaieraData"] . "')";
                    }
                    if($this -> db -> do($sql)){
                        //Ondo
                    } else{
                        //Txarto
                    }
                } else{
                    //EZIN DA EGIN
                }
            }
        }
        /**
         * DELETE egiteko funtzioa. Kasu honetan bi gako nagusi ditu, beraz string bakar batean ailegatzen dira JSON-ean eta gero split erabiliz bereizten dira.
         */
        public function delete($json){
            $this -> db = new DB();
            $data = json_decode($json, true);

            for($i = 0; $i < count($data["id"]); $i++){
                $stringSplit = preg_split("/!/", $data["id"][$i]);
                $sql = "DELETE FROM kokalekua WHERE etiketa = '" . $stringSplit[0] . "' AND hasieraData = '" . $stringSplit[1] . "'";
                if($this -> db -> do($sql)){
                    // DELETE ondo
                } else{
                    // DELETE txarto
                }

            }
        }
    }

    header("Content-Type: application/json; charset=UTF-8");


    if($_SERVER["REQUEST_METHOD"] === "PUT"){
        $json = file_get_contents('php://input');
        $kokalekuaController = new KokalekuaController();
        $kokalekuaController -> put($json);
    }

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $json = file_get_contents('php://input');
        $kokalekuaController = new KokalekuaController();
        $kokalekuaController -> post($json);
    }

    if($_SERVER["REQUEST_METHOD"] === "DELETE"){
        $json = file_get_contents('php://input');
        $kokalekuaController = new KokalekuaController();
        $kokalekuaController -> delete($json);
    }

    if($_SERVER["REQUEST_METHOD"] === "GET"){
        $kokalekuaController = new KokalekuaController();
        if(isset($_GET["id"])){
            $kokaleku = $kokalekuaController -> getById($_GET["id"]);
            echo json_encode($kokaleku);
        }elseif(isset($_GET["zutabea"])){
            $kokaleku = $kokalekuaController -> getByFilter($_GET["zutabea"], $_GET["datua"]);
            echo json_encode($kokaleku);
        }elseif(isset($_GET["free"])){
            $etiketak = $kokalekuaController -> getFreeEkipamendu();
            echo json_encode($etiketak);
        }elseif(isset($_GET["portatil"])){
            $etiketak = $kokalekuaController -> getZenbatPortatil();
            echo json_encode($etiketak);
        }else{
            $kokaleku = $kokalekuaController -> getAll();
            echo json_encode($kokaleku);
        }
    }
?>