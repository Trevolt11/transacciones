<?php

 class ServiceSession{   

    private $sessionName;

    private $utilities;

    public function __construct(){
        session_start();
        $this->sessionName = "transasList";
        $this->utilities = new Utilities();
    }

    public function Add($item){

        $transas = $this->GetList();

        if(count($transas) == 0){
            $item->Id = 1;
        }else{

            $lastElement = $this->utilities->getLastElement($transas);

            $item->Id = $lastElement->Id + 1;
        }      

        array_push($transas, $item);

       $_SESSION[$this->sessionName] = $transas;         
    }

    public function Edit($item){      

        $transas = $this->GetList();
        
        $index = $this->utilities->getIndexElement($transas,"Id",$item->Id);

        if($index !== null){
            $transas[$index] = $item;
            $_SESSION[$this->sessionName] = $transas;    
        }             
    }

    public function Delete($id){
        $transas = $this->GetList();

        $index = $this->utilities->getIndexElement($transas,"Id",$id);

        if(count($transas) > 0){
            unset($transas[$index]);
            $_SESSION[$this->sessionName] = $transas;  
        }
    }

    public function GetById($id){

        $transas = $this->GetList();

        $transa = $this->utilities->searchProperty($transas,"Id",$id);     
        
        return $transa[0];
    }



    public function GetList(){

        $transas = isset($_SESSION[ $this->sessionName]) ? $_SESSION[ $this->sessionName] : [];
        
        return $transas;

    }

    
   
}


?>



