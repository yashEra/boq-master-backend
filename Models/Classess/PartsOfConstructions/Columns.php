<?php

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

    public function getCementPriceForColumn(){
        $cementPrice = $this->cement* $this->getVolOfColumn();
        return $cementPrice;
    }

    public function getSandPriceForColumn(){
        $sandPrice = $this->sand* $this->getVolOfColumn();
        return $sandPrice;
    }

    public function getMetalPriceForColumn(){
        $metalPrice = $this->metal* $this->getVolOfColumn();
        return $metalPrice;
    }

    public function getReinforcementPriceForColumn(){
        $reinforcementPrice = $this->reinforcementBars* $this->getSqOfColumn();
        return $reinforcementPrice;
    }

    public function getBindingWiresPriceForColumn(){
        $bindingWiresPrice = $this->bindingWires* $this->getSqOfColumn();
        return $bindingWiresPrice;
    }

    public function getTotalCostForColumn(){
        $concreteCostOfColumn = $this->getCementPriceForColumn() + $this->getSandPriceForColumn() + $this->getMetalPriceForColumn(); // concrete cost for Columns
        $rCostOfColumn = $this->getReinforcementPriceForColumn() + $this->getBindingWiresPriceForColumn(); //steels and wires cost for Columns

        $totalColumnCost = ($concreteCostOfColumn + $rCostOfColumn)*$this->numberOfColumns;
        return $totalColumnCost;
    }
}
