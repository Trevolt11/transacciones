<?php

require_once 'hero.php';
require_once '../helpers/utilities.php';
require_once '../FileHandler/IFileHandler.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/SerializationFileHandler.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once 'serviceSession.php';
require_once 'ServiceCookies.php';
require_once 'ServiceFile.php';

$service = new ServiceFile();

    $containId = isset($_GET["id"]);

    if($containId){

        $service->Delete($_GET["id"]);
    }

    header("Location: ../index.php");
    exit();
?>