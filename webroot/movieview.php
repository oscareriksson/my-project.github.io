<?php
/**
 * This is a Newton pagecontroller.
 *
 */
// Include the essential config-file which also creates the $newton variable with its defaults.
include(__DIR__.'/config.php');

$movie = new CMovie($newton['database']);

$newton['title'] = "Visa innehåll i Movie";
$html = $movie->getAllMovies();

$newton['main'] = <<<EOD
    <h1>Hantera filmer</h1>
    <ul>
    {$html}
    </ul>
    <p><a href='addmovie.php'>Ny film</a></p>
    <p><a href='login.php'>Gå tillbaka</a></p>
EOD;


// Finally, leave it all to the rendering phase of Newton.
include(NEWTON_THEME_PATH);
