<?php

class BaseModel {
    public $Id;
    
    public static function createInstance($id) {
        $instance = new self();
        $instance->Id = $id;
        return $instance;
    }
}