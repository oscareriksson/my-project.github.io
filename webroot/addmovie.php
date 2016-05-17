<?php
/**
 * This is a Newton pagecontroller.
 *
 */
// Include the essential config-file which also creates the $newton variable with its defaults.
include(__DIR__.'/config.php');

$user = new CUser();
if(!$user->IsAuthenticated())
{
    die("Uppgiften kräver inloggning.");
}

$movie = new CMovie($newton['database']);

$save = isset($_POST['save']) ? true : false;
$title = isset($_POST['title']) ? $_POST['title'] : null;


$output = null;

if ($save) {
    $title = empty($title) ? null : $title;
    if (isset($title)) {
        $output = $movie->createMovie();
    }
}

$newton['title'] = "Lägg till i movie";
$newton['main'] = <<<EOD
<h1>Lägg till</h1>
<div class='output'>
<form method=post>
<p>Titel: <input type='text' name='title' required/></p>
<p><input type='submit' name='save' value='Spara'/></p>
<a href='movieview.php'>Visa allt innehåll</a><br>
<output>{$output}</output>
</form>
</div>
EOD;


// Finally, leave it all to the rendering phase of Newton.
include(NEWTON_THEME_PATH);
