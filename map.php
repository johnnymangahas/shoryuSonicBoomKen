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
    private $totalTeams;
    private $teamLocations;
    private static $mapInstance;
    
    /**
     * Singleton class creation (if not already done) with base values
     * 
     * @param type $x
     * @param type $y
     * @param type $numTeams
     * @return Map
     */
    public static function getInstance($x=10, $y=10, $numTeams=2){
        if(null == static::$mapInstance){
            static::$mapInstance = new Map($x, $y, $numTeams);
        }
        
        return static::$mapInstance;
    }
    
    /**
     * The map will have a defined size, max amount of teams, and initial location
     * on the map for each team.
     * 
     * @param type $x
     * @param type $y
     * @param type $numTeams
     */
    protected function __construct($x, $y, $numTeams) {
        $this->length = $x;
        $this->height = $y;
        $this->totalTeams = $numTeams;
        
        //For simplicity, the array index equals the team number in the teams array
        for($i = 0; $i < $this->totalTeams; $i++){
            $latitude = mt_rand(0, $this->length);
            $longitude = mt_rand(0, $this->height);
            $this->teamLocations[] = array('x'=>$latitude, 'y'=>$longitude);
        }
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
    
    /**
     * Gets the team's current location on the x/y map
     * 
     * @param int $team array index 
     * @return array integer latitude and longitude
     */
    public function getTeamLocation($team){
        return $this->teamLocations[$team];
    }
    
    /**
     * Use the Map object to determine the distance between the players
     * 
     * @param int $teamAttack
     * @param int $teamOpponent
     * 
     * @return float hypotenuse of the triangular distance
     */
    public function getPlayerDistance($teamAttack, $teamOpponent){
        $attackerLocation = $this->getTeamLocation($teamAttack);
        $opponentLocation = $this->getTeamLocation($teamOpponent);
        
        $xDiff = abs($attackerLocation['x'] - $opponentLocation['x']);
        $yDiff = abs($attackerLocation['y'] - $attackerLocation['y']);
        
        // Get the hypotenuse c = sqrt(a^2 + b^2)
        return sqrt(pow($xDiff, 2)+pow($yDiff, 2));
    }
    
    /**
     * Set the player on the moved part of the map. If the player reaches the edge
     * of the map even with greater movement, the player is stuck at the edge 
     * (e.g. no looping to the other side a la PacMan).
     * 
     * @param int movement count on the x-axis
     * @param int movement count on the y-axis
     * @param int $team index on team array
     * 
     * @return array value of team location
     */
    public function teamMovement($x, $y, $team){
        
        //Set the player's new x-axis location
        if((($this->teamLocations[$team]['x'] + (int)$x) >= 0) && (($this->teamLocations[$team]['x']+(int)$x) <= $this->length)){
            $this->teamLocations[$team]['x'] += (int)$x;
        } 
        elseif($x < 0){
            $this->teamLocations[$team]['x'] = 0;
        }
        else{
            $this->teamLocations[$team]['x'] = $this->length;
        }
        
        //Set the player's new y-axis location
        if((($this->teamLocations[$team]['y'] + (int)$y) >= 0) && (($this->teamLocations[$team]['y']+(int)$y) <= $this->height)){
            $this->teamLocations[$team]['y'] += (int)$y;
        } 
        elseif($y < 0){
            $this->teamLocations[$team]['y'] = 0;
        }
        else{
            $this->teamLocations[$team]['y'] = $this->height;
        }
        
        return $this->teamLocations[$team];
    }
}
