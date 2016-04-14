<?php

class Team{
    private $name;
    private $healthPoints;
    private $attackPoints; //degree of hit ability 1 - 5
    private $attackSpeed; //cuts down on the distance to opponent(s) 1 - 5 
    private $movementSpeed;
    private $defenseModifier; //Modifier of attack hit + Speed from 10
    private $aggressionModifier; //Fight or flight type of player
    
    function __construct($name, $x, $y, $hp=100) {
        $this->name = $name;
        $this->healthPoints = $hp;
        
        //Attack is balanced in that if the player hits big then speed is slower, 
        // and vice versa. The minimum is 3 so that the range of total damage is closer.
        $this->attackPoints = mt_rand(3,10);
        $this->attackSpeed = 10-$this->attackPoints;
        $this->movementSpeed = mt_rand(2,4);
        
        //To prevent ULTIMATE GODLY teams and provide balance, a defense modifier 
        //is set based on speed and attackPoints. The higher a team can attack, 
        //the less their defensive abilities.
        $this->setDefensiveModifier();
        
        //$this->setAggressionModifier();
        //return $this;
    }
    
    public function getName(){
        return $this->name;
    }
    
    /**
     * Getter for current team health points
     * 
     * @return number $healthPoints
     */
    public function getTeamHP(){
        return $this->healthPoints;
       
    }
    
    /**
     * Getter function for the team's defense modifier
     * 
     * @return int $defensiveModifier
     */
    public function getDefensiveModifier(){
        return $this->defenseModifier;
    }
    
    /**
     *  Getter function for movementSpeed
     * 
     * @return int $movementSpeed
     */
    public function getMovementSpeed(){
        return $this->movementSpeed;
    }
    
    /**
     * Attack function will get a distance to another team and calculate
     * the damage done that specific team. The return value will have the health points to
     * subtract from the other team. Adding a boost modifier for a possible future
     * game mechanic to boos a team's attack for a limited time.
     *  
     * @param int $distanceMod - Larger ranged hit can be less accurate
     * @param int $opponentDefMod - Defensive ability mitigates damage
     * @param float attack points modifier
     * 
     * @return array damage values for each team
     */
    public function attack($distanceMod, $opponentDefMod, $boost = 1){
        
        //An attack will always be a positive value;
        $damage = 1;
        
        //Attack speed is the number of hits the player can do per attack
        for($i = 1; $i <= $this->attackSpeed; $i++){
            $trueHitValue = $this->attackPoints;
            
            //if the distance is 0, then there is no distance mitigator
            if($distanceMod){
                //Stay true to attack always hitting. The furher away, the less
                // potential damage
                $min = (floor($trueHitValue * (1-($distanceMod%100)/100)) >= 1) ?: 1;
                $trueHitValue = mt_rand($min, $trueHitValue); 
            }
            
            //modify the damage further by the opponents ability to mitigate damage
            if($opponentDefMod){
                $min = (floor($trueHitValue * ($opponentDefMod/10)) >= 1) ?: 1;
                $trueHitValue = mt_rand($min, $trueHitValue);
            }
            
            $damage = $damage + $trueHitValue;
        }
       
        return $damage;
    }
    
    /**
     * Substract the damage value from the team's health points pool, and
     *  return the team's current health value;
     * 
     * @param float $damage
     * @return float $healthPoints
     */
    public function adjustHealthPoints($damage=1){
        $this->healthPoints = $this->healthPoints - $damage;
        
        //Would be fun to show an overkill value later
        return $this->healthPoints;
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
     * Simulates a fight or flight. Not sure if I have time for this in the initial
     * write up, but would be nice (and more realistic) rather than a random binary choice.
     * 
     * @param type $update
     */
    public function setAggressionModifier($update = 1){
        
        $this->aggressionModifier = mt_rand(1, 2);
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
