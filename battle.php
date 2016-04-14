<?php
//require classes here. In a current era mobile game, an autoloader would be here.
require "./map.php";
require "./team.php";

// Command line options to start the battle are map length and height and number of teams 
$options = getopt("x:y:numTeams:");

// Set the map size and total teams fighting, otherwise defaults
$mapLength = (!empty($options['x'])) ? $options['x'] : 10;
$mapHeight = (!empty($options['y'])) ? $options['y'] : 10;
$numTeams = (!empty($options['numTeams'])) ? $options['numTeams'] : 2;

//Create the new Game Map
$gameMap = Map::getInstance($mapLength, $mapHeight, $numTeams);
          
// Set the array of Team Objects
$teamsArray = array();
//TO-DO: $deadTeams = array(); //commented out for now, might use for end game statistics

// Set each team's statistics, otherwise random generator
for($i = 0; $i < $numTeams;$i++){

  //Create a new Team object and store in the Teams array.
  $teamLocation = $gameMap->getTeamLocation($i);
  $newTeam = new Team("Team".$i, $teamLocation['x'], $teamLocation['y']);
  
  print "Team: Team".$i." at starting location: X=>".$teamLocation['x']." Y=>".$teamLocation['y'].PHP_EOL;
          
  $teamsArray[] = $newTeam;
}

// Battle Time! - Begin series of movements and attacks till all but 1 team is alive
// In a more modernized game, a client would make the calls to backend endpoints, 
//  the client would also output the view values.
// For simplicity, we will make the endpoint "calls" here by random generator in 
// the switch statement below. If I had more time, I'd have liked to have designed
// a more human like way of deducting a fight or flight action.
do{
    
    foreach($teamsArray as $index=>$teamAction){
        //This team's turn to random pick an action. Would like to add an aggression
        //modifier to enhance a simulation team's choice to fight or flight
        print "\nTeam".$index."'s Turn...\n";
        switch(mt_rand(0,1)){
            case 1:
                $distances = array();
                
                //Get the distances of the current team to others
                for($teamIndex = 0; $teamIndex < $numTeams; $teamIndex++){
                    
                    if( ($teamIndex == $index) || ($teamsArray[$teamIndex]->getTeamHP() <= 0) ){
                        continue; //skip current team
                    }
                    
                    //Need the map object to figure out distance
                    $distance = $gameMap->getPlayerDistance($index, $teamIndex);
                
                    //Now that the distance is known between teams, get the team attack info
                    $damage = $teamAction->attack($distance, $teamsArray[$teamIndex]->getDefensiveModifier());
                    
                    //Subtract the damage from the opponent
                    $opponentHP = $teamsArray[$teamIndex]->adjustHealthPoints($damage);
                    print "Team".$index." attacks Team".$teamIndex." for hit cost: -".$damage." HP\n";
                    
                    //Team has no health left after attack, pop team out of the array
                    // and re-organize the array
                    if($opponentHP <= 0){
                        unset($teamsArray[$teamIndex]);
                        $teamsArray = array_values($teamsArray);
                        print "Team".$teamIndex." has lost!\n";
                    }
                }
                
                break;
            default:
                //Get the movementSpeed of Team and randomize X and Y distance
                $teamSpeed = $teamAction->getMovementSpeed();
                $xMovement = mt_rand(-$teamSpeed, $teamSpeed);
                $yMovement = mt_rand(-$teamSpeed, $teamSpeed);
                
                //Call on the map object to move the player
                $gameMap->teamMovement($xMovement, $yMovement, $index);
                print "Team".$index." chooses to move\n";
                
                break;
        }
    }
}while(count($teamsArray) != 1);

print "\n\nTeam ".$teamsArray[0]->getName()." WINS!\n\n";
