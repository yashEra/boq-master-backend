<?php
require './boq-master-backend/config/DbConnector.php';

use boq-master-backend\config\DbConnector;
use PDO;
use PDOException;

class Column{
    private $length;
    private $width;
    private $height;
    private $cement = 11; //11 50Kg bags for one cubic meter
    private $sand = 15;//cubic feet for one cubic meter
    private $metal = 30;// cubic feet for one cubic meter
    private $reinforcementBars = 3.556;//Reinforcement bars square meter -1 for Kg
    private $bindingWires = $reinforcementBars*0.01; //Binding wires square meter -1 for Kg
    private $numberOfColumns;

    public function __construct($length,$width,$height,$numberOfColumns)
    {
        $this->length = $length;
        $this->width = $width;
        $this->height = $height;
        $this->numberOfColumns = $numberOfColumns;
    }

    public function getVolOfColumn(){
        $vol = $this->length*$this->width*$this->height; // in cubic meters
        return $vol;
    } 

    public function getSqOfColumn(){
        $sq = $this->length*$this->width; // in square meters
        return $sq;
    } 

    public function getCementQuantityForColumn()
    {
        $cementQuantity = $this->cement * $this->getVolOfColumn();
        return $cementQuantity;
    }

    public function getCementPriceForColumn(){
        $dbcon = new DbConnector();
        try {
            $con = $dbcon->getConnection();
            $query = "SELECT price FROM cement";
            $pstmt = $con->prepare($query);
            $rs = $pstmt->execute();

            $cementPrice =  $rs * $this->getCementQuantityForColumn();
            return $cementPrice;
            
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function getSandQuantityForColumn()
    {
        $sandQuantity = $this->sand * $this->getVolOfColumn();
        return $sandQuantity;
    }

    public function getSandPriceForColumn(){
        $dbcon = new DbConnector();
        try {
            $con = $dbcon->getConnection();
            $query = "SELECT price FROM sand";
            $pstmt = $con->prepare($query);
            $rs = $pstmt->execute();

            $sandPrice =  $rs * $this->getSandQuantityForColumn();
            return $sandPrice;

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function getMetalQuantityForColumn()
    {
        $metalQuantity = $this->metal * $this->getVolOfColumn();
        return $metalQuantity;
    }

    public function getMetalPriceForColumn(){
        $dbcon = new DbConnector();
        try {
            $con = $dbcon->getConnection();
            $query = "SELECT price FROM metal";
            $pstmt = $con->prepare($query);
            $rs = $pstmt->execute();

            $metalPrice =  $rs * $this->getMetalQuantityForColumn();
            return $metalPrice;

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function getReinforcementQuantityForColumn()
    {
        $reinforcementQuantity = $this->reinforcementBars * $this->getSqOfColumn();
        return $reinforcementQuantity;
    }

    public function getReinforcementPriceForColumn(){
        $dbcon = new DbConnector();
        try {
            $con = $dbcon->getConnection();
            $query = "SELECT price FROM reinforcement";
            $pstmt = $con->prepare($query);
            $rs = $pstmt->execute();

            $reinforcementPrice =  $rs * $this->getReinforcementQuantityForColumn();
            return $reinforcementPrice;

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function getBindingWiresQuantityForColumn()
    {
        $bindingWiresQuantity = $this->bindingWires * $this->getSqOfColumn();
        return $bindingWiresQuantity;
    }

    public function getBindingWiresPriceForColumn(){
       $dbcon = new DbConnector();
        try {
            $con = $dbcon->getConnection();
            $query = "SELECT price FROM bindingWires";
            $pstmt = $con->prepare($query);
            $rs = $pstmt->execute();

            $bindingWiresPrice =  $rs * $this->getBindingWiresQuantityForColumn();
            return $bindingWiresPrice;

        } catch (Exception $ex) {
            echo $ex->getMessage();
        } 
    }

    public function getTotalCostForColumn(){
        $concreteCostOfColumn = $this->getCementPriceForColumn() + $this->getSandPriceForColumn() + $this->getMetalPriceForColumn(); // concrete cost for Columns
        $rCostOfColumn = $this->getReinforcementPriceForColumn() + $this->getBindingWiresPriceForColumn(); //steels and wires cost for Columns

        $totalColumnCost = ($concreteCostOfColumn + $rCostOfColumn)*$this->numberOfColumns;
        return $totalColumnCost;
    }
}
