<?php

error_reporting(E_ALL);
    ini_set('display_errors', 1);
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: *");
    
    require_once '../Classess/PartsOfConstructions/Tiebeam.php';
    
    echo 'process';
    
    $data = json_decode(file_get_contents("php://input"), true);
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if (empty($_POST['length']) || empty($_POST['width']) || empty($_POST['height'])) {
            header('Location:');
        } else {
            $length = $_POST['length'];
            $width = $_POST['width'];
            $height = $_POST['height'];

            $tiebeam_process = new Tiebeam($length,$width,$height);
            $tiebeam_process->getVolOfTiebeam();
            $tiebeam_process->getSqOfTiebeam();
            $tiebeam_process->getCementQuantityForTiebeam();
            $tiebeam_process->getCementPriceForTiebeam();
            $tiebeam_process->getSandQuantityForTiebeam();
            $tiebeam_process->getSandPriceForTiebeam();
            $tiebeam_process->getMetalQuantityForTiebeam();
            $tiebeam_process->getMetalPriceForTiebeam();
            $tiebeam_process->getReinforcementQuantityForTiebeam();
            $tiebeam_process->getReinforcementPriceForTiebeam();
            $tiebeam_process->getBindingWiresQuantityForTiebeam();
            $tiebeam_process->getBindingWiresPriceForTiebeam();
            $tiebeam_process->getTotalCostForTiebeam();

?>