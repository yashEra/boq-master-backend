<?php

class Wall
{
    private $height;
    private $width;
    private $length;

    public function __construct($height, $length)
    {
        $this->height = $height;
        $this->length = $length;
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
