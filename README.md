# shoryuSonicBoomKen
This is a fun code concept to simulate attacks, defense, and movement. 
For simplicity, attacks always hit but I will use distance and defensive modifiers to simulate partial hits. 
 
The "game" will load by command line with the size of a map in X and Y coordinates and a number of players. 
If no parameters are given, then a default of 10x10 map and 2 players will be given. 
On game load, a series of questions will be asked for each player's stats: 

Health Points, 
Attack Modifier (how hard to hit), 
Attack Speed (length of time in seconds between attack), 
Defensive Modifier (percent modifier on hit range), 
Movement Speed (how many spaces a player can move per turn)  

Once the teams/players are set, a command prompt will be entered: 
1 for attack, 2 for movement, {blank} enter for random

The next team/player will only have 1 option to move or attack, and the next team will have an option. 

The game will end when a team/player has no healh points left.
