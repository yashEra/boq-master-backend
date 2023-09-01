<?php

class Slab
{
    private $length; // length of the slab
    private $width; // width of the slab
    private $thickness; // thickness of the slab
    private $cement = 11; //11 50Kg bags for one cubic meter
    private $sand = 15; //cubic feet for one cubic meter
    private $metal = 30; // cubic feet for one cubic meter
    private $reinforcementBars = 20.202; //Reinforcement bars square meter -1 for Kg
    private $bindingWires = 20.202 * 0.01; //Binding wires square meter -1 for Kg
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

    public function getCementPriceForSlab()
    {
        $cementPrice = $this->cement * $this->getVolOfSlab();
        return $cementPrice;
    }

    public function getSandPriceForSlab()
    {
        $sandPrice = $this->sand * $this->getVolOfSlab();
        return $sandPrice;
    }

    public function getMetalPriceForSlab()
    {
        $metalPrice = $this->metal * $this->getVolOfSlab();
        return $metalPrice;
    }

    public function getReinforcementPriceForSlab()
    {
        $reinforcementPrice = $this->reinforcementBars * $this->getSqOfSlab();
        return $reinforcementPrice;
    }

    public function getBindingWiresPriceForSlab()
    {
        $bindingWiresPrice = $this->bindingWires * $this->getSqOfSlab();
        return $bindingWiresPrice;
    }

    public function getTotalCostForSlab()
    {
        $concreteCostOfSlab = $this->getCementPriceForSlab() + $this->getSandPriceForSlab() + $this->getMetalPriceForSlab(); // concrete cost for slab
        $rCostOfSlab = $this->getReinforcementPriceForSlab() + $this->getBindingWiresPriceForSlab(); //steels and wires cost for slab

        $totalSlabCost = ($concreteCostOfSlab + $rCostOfSlab) * $this->numberOfSlabs;
        return $totalSlabCost;
    }
}
