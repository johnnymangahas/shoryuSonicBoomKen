<?php

class Team{
    private $name;
    private $healthPoints;
    private $attackPoints; //degree of hit ability 1 - 5
    private $attackSpeed; //cuts down on the distance to opponent(s) 1 - 5 
    private $xLocation;
    private $yLocation;
    private $movementSpeed;
    private $defenseModifier; //Modifier of attack hit + Speed from 10
    
    function __construct($name, $hp=100, $ap=5, $as=3, $x, $y, $movSpeed) {
        $this->name = $name;
        $this->healthPoints = $hp;
        $this->attackPoints = $ap;
        $this->attackSpeed = $as;
        $this->xLocation = $x;
        $this->yLocation = $y;
        $this->movementSpeed = $movSpeed;
        
        //To prevent ULTIMATE GODLY teams and provide balance, a defense modifier 
        //is set based on speed and attackPoints. The higher a team can attack, 
        //the less their defensive abilities.
        $this->setDefensiveModifier();
    }
    
    /**
     * Attack function will get an array of distances other teams are and calculate
     * the damage done to each. The return value will have the health points to
     * subtract from the other teams. Adding a boost modifier for a possible future
     * game mechanic to boos a team's attack for a limited time.
     *  
     * @param array $distances
     * @param float attack points modifier
     * 
     * @return array damage values for each team
     */
    public function attack($distances, $boost = 1){
        $damages = array();
       
        return $damages;
    }
    
    /**
     * Set the team's "natural" ability to fend off an attack. A high speed + 
     * high attack hit points ability ratio will balance out for lower defensive
     * abilities. Adding a parameter for possible changes in the future so it can
     * be modified for a limited time by some game mechanic.
     * 
     * @param type $update
     */
    public function setDefensiveModifier($update = 1){
        
        $this->defenseModifier = $update * (10 - ($this->attackPoints + $this->attackSpeed));
    }
    
    /**
     * Verify the user can move with the amount input on the move.
     * 
     * @param int length on the X axis
     * @param int height on the Y axis
     * 
     * @return array of integer locations
     */
    public function move($x, $y){
        $returnX = $x;
        if(!((int)$x >= $this->movementSpeed)){
           $returnX = null;
           print "Latitude Penalty!\n";
        }
        
        $returnY = $y;
        if(!((int)$y >= $this->movementSpeed) ){
           $returnY = null;
           print "Longitude Penalty\n";
        }
        
        return array('x' => $returnX, 'y' => $returnY);
    }
    
    
}
