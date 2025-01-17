<?php
class ClientsController{

    var $ClientModel;

    public function __construct(){
        if(!isset($_SESSION["login"])){
            header("Location: index.php?c=m&a=l");
        }else{
            require_once("models/ClientsModel.php");
            $this -> ClientModel = new ClientsModel();
        }
    }

    function  listClients(){
        
        $this -> ClientModel -> listClients();
        $result = $this -> ClientModel -> getConsult();

        $arrayClient = array();

        while($line = $result -> fetch_assoc()){
            array_push($arrayClient,$line);
        }

        require_once("views/Templates/header.php");
        require_once("views/clients/listClients.php");
        require_once("views/Templates/footer.php");
    }

    public function insertClient(){

        require_once("views/Templates/header.php");
        require_once("views/clients/insertClient.php");
        require_once("views/Templates/footer.php");
    }

    public function insertClientAction(){
        $arrayClient['name'] = $_POST['name'];
        $arrayClient['email'] = $_POST['email'];
        $arrayClient['phone'] = $_POST['phone'];
        $arrayClient['address'] = $_POST['address'];

        $this -> ClientModel -> insertClient($arrayClient);

        header("Location: index.php?c=c&a=lc");

    }

    public function updateClient($idClient){
        
        $this -> ClientModel -> getClient($idClient);
        $result = $this -> ClientModel -> getConsult();
        if($arrayClient = $result->fetch_assoc()){
            require_once('views/Templates/Header.php');
            require_once('views/clients/updateClient.php');
            require_once('views/Templates/Footer.php');
        }

    }

    public function updateClientAction($idClient){
        $arrayClient['idClient'] = $idClient;
        $arrayClient['name'] = $_POST['name'];
        $arrayClient['email'] = $_POST['email'];
        $arrayClient['phone'] = $_POST['phone'];
        $arrayClient['address'] = $_POST['address'];

        $this -> ClientModel -> updateClient($arrayClient);

        // redirecionamento
        header("Location: index.php?c=c&a=lc");
    }

    public function deleteClient($idClient){
        $this -> ClientModel -> deleteClient($idClient);
        header("Location: index.php?c=c&a=lc");
    }
    
}
?>