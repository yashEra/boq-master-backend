<?php

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

    public function getCementPriceForTiebeam()
    {
        $cementPrice = $this->cement * $this->getVolOfTiebeam();
        return $cementPrice;
    }

    public function getSandPriceForTiebeam()
    {
        $sandPrice = $this->sand * $this->getVolOfTiebeam();
        return $sandPrice;
    }

    public function getMetalPriceForTiebeam()
    {
        $metalPrice = $this->metal * $this->getVolOfTiebeam();
        return $metalPrice;
    }

    public function getReinforcementPriceForTiebeam()
    {
        $reinforcementPrice = $this->reinforcementBars * $this->getSqOfTiebeam();
        return $reinforcementPrice;
    }

    public function getBindingWiresPriceForTiebeam()
    {
        $bindingWiresPrice = $this->bindingWires * $this->getSqOfTiebeam();
        return $bindingWiresPrice;
    }

    public function getTotalCostForTiebeam()
    {
        $concreteCostOfTiebeam = $this->getCementPriceForTiebeam() + $this->getSandPriceForTiebeam() + $this->getMetalPriceForTiebeam(); // concrete cost for Tiebeam
        $rCostOfTiebeam = $this->getReinforcementPriceForTiebeam() + $this->getBindingWiresPriceForTiebeam(); //steels and wires cost for Tiebeam

        $totalTiebeamCost = $concreteCostOfTiebeam + $rCostOfTiebeam;
        return $totalTiebeamCost;
    }
}
