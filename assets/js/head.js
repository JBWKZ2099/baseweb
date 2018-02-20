/**
 * Events
 */
$(document).ready(() => {
  $(window).resize(function(e) {
  });
});

/**
 * /. Events
 */

/**
 * Functions
 */
//Ejemplo: var variable = getUrlVar("variable"); para ?variable=1 obtiene 1
function getUrlVar(variable) {
  var query = window.location.search.substring(1);
  var vars = query.split("&");
  for (var i=0;i<vars.length;i++) {
    var pair = vars[i].split("=");
    if(pair[0] == variable){return pair[1];}
  }
  return(false);
}
/**
 * /. Functions
 */