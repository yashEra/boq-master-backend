<?php

include '../RowMaterials/Bricks.php';

class Wall

{
    private $height;
    private $width;
    private $length;
    private $typeOfBrick;
    private $numberOfClayBricks = 71.46; //for 1 squre meeter
    private $numberOfCementBricks = 71.46;

    public function __construct($height, $length, $typeOfBrick)
    {
        $this->height = $height;
        $this->length = $length;
        $this->typeOfBrick = $typeOfBrick;
    }

    public function getWallArea()
    {
        $wallArea = $this->height * $this->length;

        return $wallArea;
    }
    public function getBricksQuantity()
    {
        //$cost;

        if ($this->typeOfBrick === "clayBrick") {
            $bricksQuantity = $this->numberOfClayBricks * getWallArea();
        } else {

            $bricksQuantity = $this->numberOfCementBricks * getWallArea();
        }


        return $bricksQuantity;
    }

    public function getCement()
    {
        //$cost;
        if ($this->typeOfBrick === "clayBrick") {
            $cementQuantity = "";
        } else {
        }


        //return $cementQuantity;
    }

    public function getSand()
    {
        //$cost;
        if ($this->typeOfBrick === "clayBrick") {
            $sandQuantity = "";
        } else {
        }


        return $sandQuantity;
    }


    public function getWallCost()
    {
        //$cost;

        if ($this->typeOfBrick === "clayBrick") {

            $cost = $this->numberOfClayBricks * getWallArea();
        }


        return $cost;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function setHeight($height)
    {
        $this->height = $height;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function setWidth($width)
    {
        $this->width = $width;
    }

    public function getLength()
    {
        return $this->length;
    }

    public function setLength($length)
    {
        $this->length = $length;
    }
}
