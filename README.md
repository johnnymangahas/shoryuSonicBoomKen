# shoryuSonicBoomKen
This is a fun code concept to simulate attacks, defense, and movement. 
For simplicity, attacks always hit but I will use distance and defensive modifiers to simulate partial hits.
Also, the game's first rendition will be a turn based system. 
 
The "game" will load by command line with the size of a map in X and Y coordinates and a number of players. 
If no parameters are given, then a default of 10x10 map and 2 players will be given. 
On game load, a series of questions will be asked for each player's stats: 

Health Points, 
Attack Modifier (how hard to hit), 
Attack Speed (length of time in seconds between attack), 
Defensive Modifier (percent modifier on hit range), 
Movement Speed (how many spaces a player can move per turn)  

Nice To Have: 
1) A way to simulate a team's thought process to fight or flight (move) depending on current health points, hit ability, etc.
2) Service the distance of each team from each other. Currently re-checking the distance each turn.
3) Boost modifiers for attacks and defense.

Once the teams/players are set, a random binary selection will determine the course
of action for each player: 
1 for attack, 0 for movement

This will continue until there is one team left, the eventual winner.