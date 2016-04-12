<?php

/**
 * Singleton class for the map since only 1 is needed for this game and created
 * at the start.
 *
 * @author john
 */
class Map {
    private $length;
    private $height;
    private static $mapInstance;
    
    public static function getInstance($x=10, $y=10){
        if(null == static::$mapInstance){
            static::$mapInstance = new Map($x, $y);
        }
        
        return static::$mapInstance;
    }
    
    protected function __construct($x, $y) {
        $this->length = $x;
        $this->height = $y;
    }
    
    /**
     * Only to prevent cloning
     */
    private function __clone() {
    }
    
    /**
     * Only to prevent unserializing
     */
    private function __wakeup() {
    }
}
