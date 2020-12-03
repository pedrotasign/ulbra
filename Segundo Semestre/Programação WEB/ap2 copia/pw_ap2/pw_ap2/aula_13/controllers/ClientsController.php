<?php

class ClientsController
{
    public $ClientModel;

    public function __construct() //nao permite que tu volte para a mesma pagina e pede login de novo, ele chama automaticamente o __construct
    {
       
        require_once 'models/ClientsModel.php';
        $this->ClientModel = new ClientsModel();
    }

    public function listClients()
    {
        $this->ClientModel->getClients();
        $result = $this->ClientModel->getConsult();

        $arrayClients = [];

        while ($line = $result->fetch_assoc()) {
            array_push($arrayClients, $line);
        }
          
           header('Content-Type: application/json');
         echo json_encode($arrayClients);

        }

  

    public function insertClient(){

        $client = json_decode(file_get_contents('php:/input'));
    
        $arrayClient['name'] =$client -> name ;
        $arrayClient['email'] = $client -> email ;
        $arrayClient['phone'] = $client -> phone ;
        $arrayClient['address'] = $client -> address ; 

        $idClient = $this->ClientModel->insertClient($arrayClient);
        
        header('Content-Type: application/json');
        echo ('{"result":"true"}');

    }
        

       

    public function updateClient($idClient){
            
         $client =  json_decode(file_get_contents('php:/input'));
    
         $arrayClient['idClient'] = $idClient ;
         $arrayClient['name'] =$client -> name ;
         $arrayClient['email'] = $client -> email ;
         $arrayClient['phone'] = $client -> phone ;
         $arrayClient['address'] = $client -> address ;
 
         $this->ClientModel->updateClient($arrayClient);
         
        header('Content-Type: application/json');
        echo ('{"result":"true"}');
        }
}
?>