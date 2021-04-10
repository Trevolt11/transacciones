<?php

 class ServiceFile{   

    public $fileHandler;
    public $directory;
    public $filename;
    private $utilities;

    public function __construct($isRoot = false){

        $prefijo = ($isRoot) ? "estudiantes/" : "";
        $this->directory = "{$prefijo}data";
        $this->filename = "estudiantes";
        $this->utilities = new Utilities();
        $this->fileHandler = new JsonFileHandler($this->directory,$this->filename);
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

        $this->fileHandler->SaveFile($estudiantes);

    }

    public function Edit($item){      

        $estudiantes = $this->GetList();
        
        $index = $this->utilities->getIndexElement($estudiantes,"Id",$item->Id);

        if($index !== null){
            $estudiantes[$index] = $item;

            $this->fileHandler->SaveFile($estudiantes);
        }             
    }

    public function Delete($id){
        $estudiantes = $this->GetList();

        $index = $this->utilities->getIndexElement($estudiantes,"Id",$id);

        if(count($estudiantes) > 0){
            unset($estudiantes[$index]);
                        
            $this->fileHandler->SaveFile($estudiantes);
        }
    }

    public function GetById($id){

        $estudiantes = $this->GetList();

        $estudiante = $this->utilities->searchProperty($estudiantes,"Id",$id);     
        
        return $estudiante[0];
    }

    public function GetList(){

        $estudiantes = $this->fileHandler->ReadFile();
        
        if ($estudiantes == false) {          
            return array();
        }

        return (array)$estudiantes;
    }  
   
}


?>



