<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: *");
    
    require_once '../Classess/PartsOfConstructions/Columns.php';
    
    echo 'process';
    
    $data = json_decode(file_get_contents("php://input"), true);
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if (empty($_POST['length']) || empty($_POST['width']) || empty($_POST['height'])) {
            header('Location:');
        } else {
            $length = $_POST['length'];
            $width = $_POST['width'];
            $height = $_POST['height'];
            $numberOfColumns = $_POST['numberOfColumns'];

            $column_process = new Column($length,$width,$height,$numberOfColumns);
            $column_process->getVolOfColumn();
            $column_process->getSqOfColumn();
            $column_process->getCementQuantityForColumn();
            $column_process->getCementPriceForColumn();
            $column_process->getSandQuantityForColumn();
            $column_process->getSandPriceForColumn();
            $column_process->getMetalQuantityForColumn();
            $column_process->getMetalPriceForColumn();
            $column_process->getReinforcementQuantityForColumn();
            $column_process->getReinforcementPriceForColumn();
            $column_process->getBindingWiresQuantityForColumn();
            $column_process->getBindingWiresPriceForColumn();
            $column_process->getTotalCostForColumn();
    }
}
