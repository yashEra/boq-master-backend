<?php
require_once '../../config/DbConnector.php';

$dbobj = new DbConnector();


class Bricks{

   private $clayBlength = 0.215;
   private $clayBheight = 0.065;
   private $clayBwidth = 0.102;

   private $cementBlength = 0.215;
   private $cementBheight = 0.065;
   private $cementBwidth = 0.102;
   

public function getVolOfClayBricks(){

    $vol = $this->clayBheight*$this->clayBlength*$this->clayBwidth;

    return $vol;

}

public function getVolOfCementBricks(){

    $vol = $this->cementBheight*$this->cementBlength*$this->cementBwidth;

    return $vol;

}

public function getPriceOfClayBrick(){

    $dbobj = new DbConnector();
    $conn = $dbobj->getConnection();
    $sql = "SELECT price FROM raw_materials WHERE material_name=clay_brick";

    $pstmt = $conn->prepare($sql);
    $rs= $pstmt->execute();

    


}

public function priceOfCementBricks(){
    $dbobj = new DbConnector();
    $conn = $dbobj->getConnection();

    $sql = "SELECT price FROM raw_materials WHERE material_name=cement_brick";
}
}