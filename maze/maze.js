/* CSE326 : Web Application Development
 * Lab 11 - Maze game
 *
 */

var loser = null;  // whether the user has hit a wall
var end = false;
var flag = false;

window.onload = function() {

   $("end").onmouseover = overEnd;
   $("start").onclick = startClick;//reset
   var boundaries = $$("div#maze div.boundary");

   for(var i =0;i<boundaries.length;i++){
      boundaries[i].onmouseover = overBoundary;

   }
}

// called when mouse enters the walls;
// signals the end of the game with a loss
function overBoundary(event) {

   if(flag !== true){
      var boundaries = $$("div#maze div.boundary");
      for(var i =0; i<boundaries.length;i++){
         boundaries[i].addClassName("youlose");
      }loser=true;
      if(loser===true){
            $("status").textContent = "You lose :(";
      }
   }

}

// called when mouse is clicked on Start div;
// sets the maze back to its initial playable state
function startClick() {

   var boundaries = $$("div#maze div.boundary");
   for(var i =0; i<boundaries.length;i++){
      boundaries[i].removeClassName("youlose");
   }loser=false;
    flag = false;
   $("status").textContent = "Click the s to begin.";
}

// called when mouse is on top of the End div.
// signals the end of the game with a win
function overEnd() {

      if(loser!==true){
         $("status").textContent = "You win :)";
      }flag = true;

}

// test for mouse being over document.body so that the player
// can't cheat by going outside the maze
function overBody(event) {

   if(event.elements == document.body){
      overBoundary();
   }

}
