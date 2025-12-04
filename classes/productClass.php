<?php

class productClass
{
    public $title;
    public $description;
    public $icon;

    public function __construct($title, $description, $icon = "layers")
    {
        $this->title = $title;
        $this->description = $description;
        $this->icon = $icon;
    }

    public function toArray()
    {
        return [
            "title" => $this->title,
            "description" => $this->description,
            "icon" => $this->icon
        ];
    }
}