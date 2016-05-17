<?php
/**
 * This is a Newton pagecontroller.
 *
 */
// Include the essential config-file which also creates the $newton variable with its defaults.
include(__DIR__.'/config.php');

$altnews = new CAlterNews($newton['database']);
$newMov = $altnews->getNewMovies(3);
$popMov = $altnews->getPopularMovies(8);
$newBlog = $altnews->getNewBlogs(3);
$genres = $altnews->getGenres(9);

// Define what to include to make the plugin to work
$newton['stylesheets'][]        = 'css/slideshow.css';
$newton['javascript_include'][] = 'js/slideshow.js';

// Do it and store it all in variables in the Newton container.
$newton['title'] = "RM Rental Movies";

$newton['slideshow'] = <<<EOD
    {$newMov}
EOD;

$newton['main'] = <<<EOD
<div class='latestHead'><h1><span class='arrowDown'>&#x2193;</span>&nbsp;&nbsp;&nbsp;Ny Vetenskap</h1></div>
<div class='moviesContainer'>
<div class='popMovies'>
{$popMov}
</div>
</div>
EOD;

// Finally, leave it all to the rendering phase of Newton.
include(NEWTON_THEME_PATH);
