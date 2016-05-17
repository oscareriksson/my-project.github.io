<?php
/**
 * This is a Newton pagecontroller.
 *
 */
// Include the essential config-file which also creates the $newton variable with its defaults.
include(__DIR__.'/config.php');



// Do it and store it all in variables in the Newton container.
$newton['title'] = "404";
$newton['header'] = "";
$newton['main'] = "This is a Newton 404. Document is not here.";
$newton['footer'] = "";

// Send the 404 header
header("HTTP/1.0 404 Not Found");


// Finally, leave it all to the rendering phase of Newton.
include(NEWTON_THEME_PATH);
