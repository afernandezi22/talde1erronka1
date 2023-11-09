<?php
    require "controller.php";
    require "../repository/db.php";
    require "../model/kokalekua.php";
    class KokalekuaController extends Controller{
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

        public function getByFilter($zutabea, $datua){
            $this -> db = new DB();
            $sql = "SELECT K.etiketa as etiketa, E.izena as ekipamenduIzena, K.idGela as idGela, G.izena as gelaIzena, K.hasieraData as hasieraData, K.amaieraData as amaieraData  
            FROM ekipamendua E, gela G, inbentarioa I, kokalekua K 
            WHERE K.etiketa = I.etiketa 
            AND I.idEkipamendu =  E.id
            AND K.idGela = G.id
            AND " . $zutabea . " = '" . $datua . "'";
            $emaitza = $this -> db -> select($sql);
            foreach($emaitza as $kokalekua){
                $kokalekuak[] = new Kokalekua($kokalekua["etiketa"], $kokalekua["ekipamenduIzena"], $kokalekua["idGela"], $kokalekua["gelaIzena"], $kokalekua["hasieraData"], $kokalekua["amaieraData"]);
            }

            return $kokalekuak;
        }

        public function getFreeEkipamendu(){
            $this -> db = new DB();
            $sqlSelect = "WITH CTE AS (
                SELECT I.etiketa AS etiketa, E.izena as izena,
                ROW_NUMBER() OVER (PARTITION BY E.izena ORDER BY E.izena) as rn
                FROM inbentarioa I, ekipamendua E
                WHERE etiketa NOT IN (
                SELECT etiketa
                FROM kokalekua
                ) AND id = idEkipamendu
                UNION
                SELECT K.etiketa AS etiketa, E.izena AS izena,
                ROW_NUMBER() OVER (PARTITION BY E.izena ORDER BY E.izena) as rn
                FROM kokalekua K, inbentarioa I, ekipamendua E
                WHERE K.etiketa NOT IN (
                SELECT etiketa
                FROM kokalekua
                WHERE amaieraData IS NULL
                ) AND amaieraData < CURRENT_DATE
                AND K.etiketa = I.etiketa
                AND I.idEkipamendu = E.id
            )
            SELECT etiketa, izena FROM CTE WHERE rn = 1";
            $emaitza = $this -> db -> select($sqlSelect);
            $etiketak = []; 
            foreach($emaitza as $libre){
                $libreak[] = array("etiketa" => $libre["etiketa"], "izena" => $libre["izena"]);
            }

            return $libreak;
        }

        public function gaurBainoBeranduago($dataStr){
            $data = DateTime::createFromFormat("Y-m-d", $dataStr);    
            $gaur = new DateTime();

            if($data > $gaur){
                return true;
            }else {
                return false;
            }
        }

        public function put($json){
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
                    $sql = "UPDATE kokalekua SET etiketa = '" . $data["etiketa"] . "', hasieraData = " . $data["hasieraData"]
                        . ", amaieraData = " . $data["amaieraData"]
                        . " WHERE id = " . $data["id"];
                    if($this -> db -> do($sql)){
                        // UPDATE ondo
                    } else{
                        // UPDATE txarto
                    }
                }
            }
        }

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
                    $sql = "INSERT INTO kokalekua VALUES ('" . $data["etiketa"]
                        . "', '" . $data["idGela"]
                        . "', '" . $data["hasieraData"]
                        . "', '" . $data["amaieraData"] . "')";
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
        }else{
            $kokaleku = $kokalekuaController -> getAll();
            echo json_encode($kokaleku);
        }
    }
?>
