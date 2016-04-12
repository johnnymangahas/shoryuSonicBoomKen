#!/bin/php

<?php
//require classes here

// Command line options to start the battle are map length and height and number of teams 
$options = getopt("x:y:numTeams:");

// Set the map size and total teams fighting, otherwise defaults
$mapLength = (!empty($options['x'])) ? $options['x'] : 10;
$mapHeight = (!empty($options['y'])) ? $options['y'] : 10;
$numTeams = (!empty($options['numTeams'])) ? $options['numTeams'] : 2;

// Set the array of Team Objects
$teamsArray = array();
// $deadTeams = array(); //commented out for now, might use for end game statistics

// Set each team's statistics, otherwise random generator
for($i = 0; $i < $numTeams;$i++){

  //Create a new Team object and instantiate team stats
  
}

// Battle Time! - Begin series of movements and attacks till all but 1 team is alive
// In a more modernized game, a client would make the calls to backend endpoints. 
// For simplicity, we will make the endpoint "calls" here.
do{

  // Print out team action, if attack, then show -health points on defensive team(s)

  // If team has zero health points, pop off array and re-sort
  
}while(count($teamsArray) > 1);

print "Team ".$teamsArray[0]->name." WINS!";
