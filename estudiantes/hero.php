<?php

    class Hero{

        public $Id;
        public $Name;
        public $Apellido;
        public $Description;


        public function __construct($id,$name,$apellido,$description)
        {

            $this->Id = $id;
            $this->Name = $name;
            $this->Apellido = $apellido;
            $this->Description = $description;


            
        }

    }

?>