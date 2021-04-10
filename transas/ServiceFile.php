<?php

 class ServiceFile{   

    public $fileHandler;
    public $directory;
    public $filename;
    private $utilities;

    public function __construct($isRoot = false){

        $prefijo = ($isRoot) ? "transas/" : "";
        $this->directory = "{$prefijo}data";
        $this->filename = "transas";
        $this->utilities = new Utilities();
        $this->fileHandler = new JsonFileHandler($this->directory,$this->filename);
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

        $this->fileHandler->SaveFile($transas);

    }

    public function Edit($item){      

        $transas = $this->GetList();
        
        $index = $this->utilities->getIndexElement($transas,"Id",$item->Id);

        if($index !== null){
            $transas[$index] = $item;

            $this->fileHandler->SaveFile($transas);
        }             
    }

    public function Delete($id){
        $transas = $this->GetList();

        $index = $this->utilities->getIndexElement($transas,"Id",$id);

        if(count($transas) > 0){
            unset($transas[$index]);
                        
            $this->fileHandler->SaveFile($transas);
        }
    }

    public function GetById($id){

        $transas = $this->GetList();

        $transa = $this->utilities->searchProperty($transas,"Id",$id);     
        
        return $transa[0];
    }

    public function GetList(){

        $transas = $this->fileHandler->ReadFile();
        
        if ($transas == false) {          
            return array();
        }

        return (array)$transas;
    }  
   
}


?>



