<?php
require './boq-master-backend/config/DbConnector.php';

use boq-master-backend\config\DbConnector;
use PDO;
use PDOException;

class Tiebeams
{
    private $length;
    private $width;
    private $height;
    private $cement = 11; //11 50Kg bags for one cubic meter
    private $sand = 15; //cubic feet for one cubic meter
    private $metal = 30; // cubic feet for one cubic meter
    private $reinforcementBars = 3.556; //Reinforcement bars square meter -1 for Kg
    private $bindingWires = $reinforcementBars * 0.01; //Binding wires square meter -1 for Kg

    public function __construct($length, $width, $height)
    {
        $this->length = $length;
        $this->width = $width;
        $this->height = $height;
    }

    public function getVolOfTiebeam()
    {
        $vol = $this->length * $this->width * $this->height; // in cubic meters
        return $vol;
    }

    public function getSqOfTiebeam()
    {
        $sq = $this->length * $this->width; // in square meters
        return $sq;
    }

    public function getCementQuantityForTiebeam()
    {
        $cementQuantity = $this->cement * $this->getVolOfTiebeam();
        return $cementQuantity;
    }

    public function getCementPriceForTiebeam()
    {
        $dbcon = new DbConnector();
        try {
            $con = $dbcon->getConnection();
            $query = "SELECT price FROM cement";
            $pstmt = $con->prepare($query);
            $rs = $pstmt->execute();

            $cementPrice =  $rs * $this->getCementQuantityForTiebeam();
            return $cementPrice;
            
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function getSandQuantityForTiebeam()
    {
        $sandQuantity = $this->sand * $this->getVolOfTiebeam();
        return $sandQuantity;
    }

    public function getSandPriceForTiebeam()
    {
        $dbcon = new DbConnector();
        try {
            $con = $dbcon->getConnection();
            $query = "SELECT price FROM sand";
            $pstmt = $con->prepare($query);
            $rs = $pstmt->execute();

            $sandPrice =  $rs * $this->getSandQuantityForTiebeam();
            return $sandPrice;

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function getMetalQuantityForTiebeam()
    {
        $metalQuantity = $this->metal * $this->getVolOfTiebeam();
        return $metalQuantity;
    }

    public function getMetalPriceForTiebeam()
    {
        $dbcon = new DbConnector();
        try {
            $con = $dbcon->getConnection();
            $query = "SELECT price FROM metal";
            $pstmt = $con->prepare($query);
            $rs = $pstmt->execute();

            $metalPrice =  $rs * $this->getMetalQuantityForTiebeam();
            return $metalPrice;

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function getReinforcementQuantityForTiebeam()
    {
        $reinforcementQuantity = $this->reinforcementBars * $this->getSqOfTiebeam();
        return $reinforcementQuantity;
    }

    public function getReinforcementPriceForTiebeam()
    {
        $dbcon = new DbConnector();
        try {
            $con = $dbcon->getConnection();
            $query = "SELECT price FROM reinforcement";
            $pstmt = $con->prepare($query);
            $rs = $pstmt->execute();

            $reinforcementPrice =  $rs * $this->getReinforcementQuantityForTiebeam();
            return $reinforcementPrice;

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function getBindingWiresQuantityForTiebeam()
    {
        $bindingWiresQuantity = $this->bindingWires * $this->getSqOfTiebeam();
        return $bindingWiresQuantity;
    }

    public function getBindingWiresPriceForTiebeam()
    {
        $dbcon = new DbConnector();
        try {
            $con = $dbcon->getConnection();
            $query = "SELECT price FROM bindingWires";
            $pstmt = $con->prepare($query);
            $rs = $pstmt->execute();

            $bindingWiresPrice =  $rs * $this->getBindingWiresQuantityForTiebeam();
            return $bindingWiresPrice;

        } catch (Exception $ex) {
            echo $ex->getMessage();
        } 
    }

    public function getTotalCostForTiebeam()
    {
        $concreteCostOfTiebeam = $this->getCementPriceForTiebeam() + $this->getSandPriceForTiebeam() + $this->getMetalPriceForTiebeam(); // concrete cost for Tiebeam
        $rCostOfTiebeam = $this->getReinforcementPriceForTiebeam() + $this->getBindingWiresPriceForTiebeam(); //steels and wires cost for Tiebeam

        $totalTiebeamCost = $concreteCostOfTiebeam + $rCostOfTiebeam;
        return $totalTiebeamCost;
    }
}
