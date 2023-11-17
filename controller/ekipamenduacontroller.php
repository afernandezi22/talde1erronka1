<?php
    // header("Access-Control-Allow-Headers:{$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    // header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    // header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    /**
     * @file
     * Contiene la definición de la clase y funciones relacionadas.
     */
    require "controller.php";
    require "../repository/db.php";
    require "../model/ekipamendua.php";
    class EkipamenduaController extends Controller{
        
        public function getAll(){
            $this -> db = new DB();
            $sql = "SELECT E.id, E.izena, E.deskribapena, E.marka, E.modelo, E.stock, E.idKategoria, K.izena AS kategoriaIzena FROM ekipamendua E, kategoria K 
            WHERE K.id = E.idKategoria";
            $emaitza = $this -> db -> select($sql);
            if(!$emaitza == null){
                foreach($emaitza as $ekipamendua){
                    $ekipamenduak[] = new Ekipamendua($ekipamendua["id"], $ekipamendua["izena"], $ekipamendua["deskribapena"], $ekipamendua["marka"], $ekipamendua["modelo"], $ekipamendua["stock"], $ekipamendua["idKategoria"], $ekipamendua["kategoriaIzena"]);
                }
                return $ekipamenduak;
            }
        }

        public function getById($id){
            $this -> db = new DB();
            $sql = "SELECT E.id, E.izena, E.deskribapena, E.marka, E.modelo, E.stock, E.idKategoria, K.izena AS kategoriaIzena FROM ekipamendua E, kategoria K 
            WHERE K.id = E.idKategoria AND E.id = " . $id;
            $emaitza = $this -> db -> select($sql);
            
            if(!$emaitza == null){
                foreach($emaitza as $ekipamendua){
                    $ekipamenduak[] = new Ekipamendua($ekipamendua["id"], $ekipamendua["izena"], $ekipamendua["deskribapena"], $ekipamendua["marka"], $ekipamendua["modelo"], $ekipamendua["stock"], $ekipamendua["idKategoria"], $ekipamendua["kategoriaIzena"]);
                }
                return $ekipamenduak;
            }
        }

        public function getByMarkaModelo($marka, $modelo){
            $this -> db = new DB();
            $sql = "SELECT E.id, E.izena, E.deskribapena, E.marka, E.modelo, E.stock, E.idKategoria, K.izena AS kategoriaIzena FROM ekipamendua E, kategoria K 
            WHERE K.id = E.idKategoria AND E.marka = '" . $marka . "' AND E.modelo = '" . $modelo . "'";
            $emaitza = $this -> db -> select($sql);
            
            if(!$emaitza == null){
                foreach($emaitza as $ekipamendua){
                    $ekipamenduak[] = new Ekipamendua($ekipamendua["id"], $ekipamendua["izena"], $ekipamendua["deskribapena"], $ekipamendua["marka"], $ekipamendua["modelo"], $ekipamendua["stock"], $ekipamendua["idKategoria"], $ekipamendua["kategoriaIzena"]);
                }
                return $ekipamenduak;
            }
        }

	    public function getByFilter($zutabea, $datua){
            $this -> db = new DB();
            $sql = "SELECT E.id, E.izena, E.deskribapena, E.marka, E.modelo, E.stock, E.idKategoria, K.izena AS kategoriaIzena FROM ekipamendua E, kategoria K 
            WHERE K.id = E.idKategoria AND E." . $zutabea. " = '" . $datua . "'"; 
            $emaitza = $this -> db -> select($sql);
            if(!$emaitza == null){
                foreach($emaitza as $ekipamendua){
                    $ekipamenduak[] = new Ekipamendua($ekipamendua["id"], $ekipamendua["izena"], $ekipamendua["deskribapena"], $ekipamendua["marka"], $ekipamendua["modelo"], $ekipamendua["stock"], $ekipamendua["idKategoria"], $ekipamendua["kategoriaIzena"]);
                }
    
                return $ekipamenduak;
            }
        }

        public function put($json){
            $this -> db = new DB();
            $data = json_decode($json, true);
            $sql = "UPDATE ekipamendua SET izena = '" . $data["izena"]
                . "', deskribapena = '" . $data["deskribapena"]
                . "', marka = '" . $data["marka"]
                . "', modelo = '" . $data["modelo"]
                . "', idKategoria = " . $data["idKategoria"]
                . " WHERE id = " . $data["id"];
            if($this -> db -> do($sql)){
                //Ondo
            } else{
                //Txarto
            }
        }

        public function post($json){
            $this -> db = new DB();
            $data = json_decode($json, true);

            //Baliozkotzea: ezin da marka eta modelo bera duen zerbait txertatu
            $sql = "SELECT * FROM ekipamendua WHERE marka = '" . $data["marka"] . "' AND modelo = '" . $data["modelo"] . "'";
            $result = $this -> db -> select($sql);
            if($result == null){
                $sql = "INSERT INTO ekipamendua (izena, deskribapena, marka, modelo, stock, idKategoria) VALUES ('" . $data["izena"]
                    . "', '" . $data["deskribapena"]
                    . "', '" . $data["marka"]
                    . "', '" . $data["modelo"]
                    . "', 0"
                    . ", " . $data["idKategoria"] . ")";
                    if($this -> db -> do($sql)){
                        return true;
                    } else{
                        return false;
                    }
            } else{
                echo "ezin da";
            }
        }

        public function delete($json){
            $this -> db = new DB();
            $data = json_decode($json, true);
            $sql = "DELETE FROM ekipamendua WHERE id IN(";
            for($i = 0; $i < count($data["id"]); $i++){
                //Baliozkotzea: ez da ezabatuko stock-a badago.
                $sqlSelect = "SELECT stock FROM ekipamendua WHERE id =" . $data["id"][$i];
                $result = $this -> db -> select($sqlSelect);
                foreach($result as $row){
                    $stock = $row["stock"];
                }
                if($stock <= 0){
                    $sql = $sql . $data["id"][$i] . ",";
                } else {
                    //Baliozkotzea: ez da ezabatuko
                }
            }

            $sql = $sql . "0)";
            if($this -> db -> do($sql)){
                //Ondo
            } else{
                //Txarto
            }
        }
    }

    header("Content-Type: application/json; charset=UTF-8");

    if($_SERVER["REQUEST_METHOD"] === "PUT"){
        $json = file_get_contents('php://input');
        $ekipamenduController = new EkipamenduaController();
        $ekipamenduController -> put($json);
    }

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $json = file_get_contents('php://input');
        $ekipamenduController = new EkipamenduaController();
        $ekipamenduController -> post($json);
    }

    if($_SERVER["REQUEST_METHOD"] === "DELETE"){
        $json = file_get_contents('php://input');
        $ekipamenduController = new EkipamenduaController();
        $ekipamenduController -> delete($json);
    }

    if($_SERVER["REQUEST_METHOD"] === "GET"){
        $ekipamenduController = new EkipamenduaController();
        if(!empty($_GET["id"])){
            $ekipamendu = $ekipamenduController -> getById($_GET["id"]);
            echo json_encode($ekipamendu);
        }elseif(isset($_GET["zutabea"])){
            $ekipamendu = $ekipamenduController -> getByFilter($_GET["zutabea"], $_GET["datua"]);
            echo json_encode($ekipamendu);
        }elseif(isset($_GET["marka"]) && isset($_GET["modelo"])){
            $ekipamendu = $ekipamenduController -> getByMarkaModelo($_GET["marka"], $_GET["modelo"]);
            echo json_encode($ekipamendu);
        }else{
            $ekipamendu = $ekipamenduController -> getAll();
            echo json_encode($ekipamendu);
        }
    }
?>
