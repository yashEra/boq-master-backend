<?php

require './boq-master-backend/config/DbConnector.php';

use boq-master-backend\config\DbConnector;
use PDO;
use PDOException;

class Slab
{
    private $length; // length of the slab
    private $width; // width of the slab
    private $thickness; // thickness of the slab
    private $cement = 11; //11 50Kg bags for one cubic meter
    private $sand = 15; //cubic feet for one cubic meter
    private $metal = 30; // cubic feet for one cubic meter
    private $reinforcementBars = 20.202; //Reinforcement bars square meter -1 for Kg
    private $bindingWires = $reinforcementBars * 0.01; //Binding wires square meter -1 for Kg
    private $numberOfSlabs;

    public function __construct($length, $width, $thickness, $numberOfSlabs)
    {
        $this->length = $length;
        $this->width = $width;
        $this->thickness = $thickness;
        $this->numberOfSlabs = $numberOfSlabs;
    }

    public function getVolOfSlab()
    {
        $vol = $this->length * $this->width * $this->thickness; // in cubic meters
        return $vol;
    }

    public function getSqOfSlab()
    {
        $sq = $this->length * $this->width; // in square meters
        return $sq;
    }

    public function getCementQuantityForSlab()
    {
        $cementQuantity = $this->cement * $this->getVolOfSlab();
        return $cementQuantity;
    }

    public function getCementPriceForSlab()
    {
        $dbcon = new DbConnector();
        try {
            $con = $dbcon->getConnection();
            $query = "SELECT price FROM cement";
            $pstmt = $con->prepare($query);
            $rs = $pstmt->execute();

            $cementPrice =  $rs * $this->getCementQuantityForSlab();
            return $cementPrice;
            
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function getSandQuantityForSlab()
    {
        $sandQuantity = $this->sand * $this->getVolOfSlab();
        return $sandQuantity;
    }

    public function getSandPriceForSlab()
    {
        $dbcon = new DbConnector();
        try {
            $con = $dbcon->getConnection();
            $query = "SELECT price FROM sand";
            $pstmt = $con->prepare($query);
            $rs = $pstmt->execute();

            $sandPrice =  $rs * $this->getSandQuantityForSlab();
            return $sandPrice;

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function getMetalQuantityForSlab()
    {
        $metalQuantity = $this->metal * $this->getVolOfSlab();
        return $metalQuantity;
    }

    public function getMetalPriceForSlab()
    {
        $dbcon = new DbConnector();
        try {
            $con = $dbcon->getConnection();
            $query = "SELECT price FROM metal";
            $pstmt = $con->prepare($query);
            $rs = $pstmt->execute();

            $metalPrice =  $rs * $this->getMetalQuantityForSlab();
            return $metalPrice;

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function getReinforcementQuantityForSlab()
    {
        $reinforcementQuantity = $this->reinforcementBars * $this->getSqOfSlab();
        return $reinforcementQuantity;
    }

    public function getReinforcementPriceForSlab()
    {
        $dbcon = new DbConnector();
        try {
            $con = $dbcon->getConnection();
            $query = "SELECT price FROM reinforcement";
            $pstmt = $con->prepare($query);
            $rs = $pstmt->execute();

            $reinforcementPrice =  $rs * $this->getReinforcementQuantityForSlab();
            return $reinforcementPrice;

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function getBindingWiresQuantityForSlab()
    {
        $bindingWiresQuantity = $this->bindingWires * $this->getSqOfSlab();
        return $bindingWiresQuantity;
    }

    public function getBindingWiresPriceForSlab()
    {
        $dbcon = new DbConnector();
        try {
            $con = $dbcon->getConnection();
            $query = "SELECT price FROM bindingWires";
            $pstmt = $con->prepare($query);
            $rs = $pstmt->execute();

            $bindingWiresPrice =  $rs * $this->getBindingWiresQuantityForSlab();
            return $bindingWiresPrice;

        } catch (Exception $ex) {
            echo $ex->getMessage();
        } 
    }

    public function getTotalCostForSlab()
    {
        $concreteCostOfSlab = $this->getCementPriceForSlab() + $this->getSandPriceForSlab() + $this->getMetalPriceForSlab(); // concrete cost for slab
        $rCostOfSlab = $this->getReinforcementPriceForSlab() + $this->getBindingWiresPriceForSlab(); //steels and wires cost for slab

        $totalSlabCost = ($concreteCostOfSlab + $rCostOfSlab) * $this->numberOfSlabs;
        return $totalSlabCost;
    }
}
