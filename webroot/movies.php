<?php
/**
 * This is a Newton pagecontroller.
 *
 */
// Include the essential config-file which also creates the $newton variable with its defaults.
include(__DIR__.'/config.php');

$title = isset($_GET['title']) ? $_GET['title'] : null;
$genre = isset($_GET['genre']) ? $_GET['genre'] : null;
$id = isset($_GET['id']) ? $_GET['id'] : null;
$orderby  = isset($_GET['orderby']) ? strtolower($_GET['orderby']) : 'id';
$order    = isset($_GET['order'])   ? strtolower($_GET['order'])   : 'asc';
$hits     = isset($_GET['hits'])  ? $_GET['hits']  : 8;
$page     = isset($_GET['page'])  ? $_GET['page']  : 1;
$year1 = isset($_GET['year1']) && !empty($_GET['year1']) ? $_GET['year1'] : null;
$year2 = isset($_GET['year2']) && !empty($_GET['year2']) ? $_GET['year2'] : null;


// Check that incoming parameters are valid
is_numeric($hits) or die('Check: Hits must be numeric.');
is_numeric($page) or die('Check: Page must be numeric.');
in_array($orderby, array('id', 'price', 'title', 'year')) or die('Not valid column');
in_array($order, array('asc', 'desc')) or die ('Not valid sort order');

$title = htmlentities($title);
$genre = htmlentities($genre);
$id = htmlentities($id);
$orderby = htmlentities($orderby);
$order = htmlentities($order);
$hits = htmlentities($hits);
$page = htmlentities($page);
$year1 = htmlentities($year1);
$year2 = htmlentities($year2);

// Do it and store it all in variables in the Newton container.
$newton['title'] = "Filmdatabas";

$movieSearch = new CMovieSearch($newton['database'], $title, $genre, $orderby, $order, $hits, $page, $year1, $year2);
$htmlTable = new CHTMLTable($hits, $page, $newton['database']);

if(!$id) {
    $output = $movieSearch->viewSearchField();
    $output .= $movieSearch->viewGenres();
    $output .= $htmlTable->viewHTMLTable($movieSearch->getRes(), $movieSearch->getMaxRows());
}
else {
    $output = $htmlTable->viewMovie($id);
}

$newton['main'] = <<<EOD
    {$output}
EOD;

// Finally, leave it all to the rendering phase of Newton.
include(NEWTON_THEME_PATH);
