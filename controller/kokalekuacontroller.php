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
            $sql = "SELECT * FROM kokalekua WHERE " . $zutabea. " = '" . $datua . "'"; 
            $emaitza = $this -> db -> select($sql);
            if(!$emaitza == null){
                foreach($emaitza as $gela){
                    $kokalekuak[] = new Kokalekua($kokalekua["etiketa"], $kokalekua["ekipamenduIzena"], $kokalekua["idGela"], $kokalekua["gelaIzena"], $kokalekua["hasieraData"], $kokalekua["amaieraData"]);
                }
    
                return $gelak;
            }
        }

        public function put($json){
            $this -> db = new DB();
            $data = json_decode($json, true);
            $sql = "UPDATE kokalekua SET hasieraData = " . $data["hasieraData"]
                . ", amaieraData = " . $data["amaieraData"]
                . " WHERE id = " . $data["id"];
            if($this -> db -> do($sql)){
                return true;
            } else{
                return false;
            }
        }

        public function post($json){
            $this -> db = new DB();
            $data = json_decode($json, true);
            $sql = "INSERT INTO kokalekua VALUES ('" . $data["etiketa"]
                . "', '" . $data["idGela"]
                . "', '" . $data["hasieraData"]
                . "', '" . $data["amaieraData"] . ")";
            if($this -> db -> do($sql)){
                //Ondo
            } else{
                //Txarto
            }
        }

        //HAU ERE BEGIRATU BEHAR DA
        public function delete($json){
            $this -> db = new DB();
            $data = json_decode($json, true);
            $sql = "DELETE FROM kokalekua WHERE id IN(";
            for($i = 0; $i < count($data["id"]); $i++){
                if($i == 0){
                    $sql = $sql . $data["id"][$i];
                }else{
                    $sql = $sql . "," . $data["id"][$i];
                }
            }

            $sql = $sql . ")";

            if($this -> db -> do($sql)){
                return true;
            } else{
                return true;
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
        }else{
            $kokaleku = $kokalekuaController -> getAll();
            echo json_encode($kokaleku);
        }
    }
?>