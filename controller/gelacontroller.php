<?php
    require "controller.php";
    require "../repository/db.php";
    require "../model/gela.php";
    class GelaController extends Controller{
        public function getAll(){
            $this -> db = new DB();
            $sql = "SELECT * FROM gela";
            $emaitza = $this -> db -> select($sql);
            foreach($emaitza as $gela){
                $gelak[] = new Gela($gela["id"], $gela["izena"], $gela["taldea"]);
            }

            return $gelak;
        }

        public function getById($id){
            $this -> db = new DB();
            $sql = "SELECT * FROM gela WHERE id = " . $id;
            $emaitza = $this -> db -> select($sql);
            foreach($emaitza as $gela){
                $gelak[] = new Gela($gela["id"], $gela["izena"], $gela["taldea"]);
            }

            return $gelak;
        }

        public function put($json){
        
        }
    }

    // $froga = new GelaController();
    // $emaitza = $froga -> getById(2);
    // var_dump($emaitza);

    // $gela = new Gela(1, "FROGA", "FROGA");
    // $jsonGela = json_encode($gela);

    // Verifica si la solicitud es de tipo POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        echo 'El nombre es: ' . $data['urtea'];
        // echo $jsonGela;
    } else {
        // Si la solicitud no es de tipo POST, muestra un mensaje de error
        echo 'Error: Esta página solo acepta solicitudes POST.';
    }

?>