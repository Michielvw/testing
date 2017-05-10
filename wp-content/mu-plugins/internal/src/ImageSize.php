<?php
class ImageSize
{
    private $id = -1;
    private $item = [];

    public function register($name)
    {
        $this->id++;
        $this->item[$this->id] = [];
        $this->item[$this->id]['name'] = $name;
        return $this;
    }

    public function setWidth($width)
    {
        $this->item[$this->id]['width'] = $width;
        return $this;
    }

    public function setHeight($height)
    {
        $this->item[$this->id]['height'] = $height;
        return $this;
    }

    public function crop($crop = true)
    {
        $this->item[$this->id]['crop'] = $crop;
        return $this;
    }

    public function add()
    {
        $name   = $this->item[$this->id]['name'];
        $width  = isset($this->item[$this->id]['width']) ? $this->item[$this->id]['width'] : 9999;
        $height = isset($this->item[$this->id]['height']) ? $this->item[$this->id]['height'] : 9999;
        $crop   = isset($this->item[$this->id]['crop']) ? $this->item[$this->id]['crop'] : false;

        add_image_size($name, $width, $height, $crop);
    }
}
