<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

require_once '../Classess/PartsOfConstructions/Slab_Process.php';

echo 'process';

$data = json_decode(file_get_contents("php://input"), true);


if ($_SERVER["REQUEST_METHOD"]) {
    if (empty($_POST['length']) || empty($_POST['width']) || empty($_POST['thickness'])) {
        header('Location:');
    } else {
        $length = $_POST['length'];
        $width = $_POST['width'];
        $thickness = $_POST['thickness'];
        $numberOfSlabs = $_POST['numberOfSlabs'];

        $slab_process = new Slab($length, $width, $thickness, $numberOfSlabs);
        $slab_process->getVolOfSlab();
        $slab_process->getSqOfSlab();
        $slab_process->getCementPriceForSlab();
        $slab_process->getSandPriceForSlab();
        $slab_process->getMetalPriceForSlab();
        $slab_process->getReinforcementPriceForSlab();
        $slab_process->getBindingWiresPriceForSlab();
        $slab_process->getTotalCostForSlab();
    }
}
