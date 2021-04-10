<?php

 class ServiceCookies{   

    private $CookieName;

    private $utilities;

    public function __construct(){
        session_start();
        $this->CookieName = "transasList";
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

        setcookie($this->CookieName,json_encode($transas),$this->GetCookieTime(), "/");

    }

    public function Edit($item){      

        $transas = $this->GetList();
        
        $index = $this->utilities->getIndexElement($transas,"Id",$item->Id);

        if($index !== null){
            $transas[$index] = $item;

            setcookie($this->CookieName,json_encode($transas),$this->GetCookieTime(), "/");    
        }             
    }

    public function Delete($id){
        $transas = $this->GetList();

        $index = $this->utilities->getIndexElement($transas,"Id",$id);

        if(count($transas) > 0){
            unset($transas[$index]);
            
            setcookie($this->CookieName,json_encode($transas),$this->GetCookieTime(), "/");
        }
    }

    public function GetById($id){

        $transas = $this->GetList();

        $transa = $this->utilities->searchProperty($transas,"Id",$id);     
        
        return $transa[0];
    }

    public function GetList(){

       $transas = array();

       if(isset($_COOKIE[$this->CookieName])){

         $transas =(array) json_decode($_COOKIE[$this->CookieName]); 

       }
       return $transas;
    }

    private function GetCookieTime(){
        return time() + 60 * 60 * 24 * 30;
    }   
   
}


?>



