<?php

 class ServiceCookies{   

    private $CookieName;

    private $utilities;

    public function __construct(){
        session_start();
        $this->CookieName = "estudiantesList";
        $this->utilities = new Utilities();
    }

    public function Add($item){

        $estudiantes = $this->GetList();

        if(count($estudiantes) == 0){
            $item->Id = 1;
        }else{

            $lastElement = $this->utilities->getLastElement($estudiantes);

            $item->Id = $lastElement->Id + 1;
        }      

        array_push($estudiantes, $item);        

        setcookie($this->CookieName,json_encode($estudiantes),$this->GetCookieTime(), "/");

    }

    public function Edit($item){      

        $estudiantes = $this->GetList();
        
        $index = $this->utilities->getIndexElement($estudiantes,"Id",$item->Id);

        if($index !== null){
            $estudiantes[$index] = $item;

            setcookie($this->CookieName,json_encode($estudiantes),$this->GetCookieTime(), "/");    
        }             
    }

    public function Delete($id){
        $estudiantes = $this->GetList();

        $index = $this->utilities->getIndexElement($estudiantes,"Id",$id);

        if(count($estudiantes) > 0){
            unset($estudiantes[$index]);
            
            setcookie($this->CookieName,json_encode($estudiantes),$this->GetCookieTime(), "/");
        }
    }

    public function GetById($id){

        $estudiantes = $this->GetList();

        $estudiante = $this->utilities->searchProperty($estudiantes,"Id",$id);     
        
        return $estudiante[0];
    }

    public function GetList(){

       $estudiantes = array();

       if(isset($_COOKIE[$this->CookieName])){

         $estudiantes =(array) json_decode($_COOKIE[$this->CookieName]); 

       }
       return $estudiantes;
    }

    private function GetCookieTime(){
        return time() + 60 * 60 * 24 * 30;
    }   
   
}


?>



