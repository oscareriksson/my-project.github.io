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

$id     = isset($_POST['id'])    ? strip_tags($_POST['id']) : (isset($_GET['id']) ? strip_tags($_GET['id']) : null);
$title  = isset($_POST['title']) ? $_POST['title'] : null;
$data = isset($_POST['data']) ? $_POST['data'] : null;
$type = isset($_POST['type']) ? strip_tags($_POST['type']) : null;

is_numeric($id) or die('Angivet ID måste vara numeriskt.');

$delete = $movie->getMovieById($id);

$title = htmlentities($delete->title, null, 'UTF-8');

$doDelete = null;
if (isset($_POST['delete'])) {
    $doDelete = $movie->deleteMovie($id);
}

$newton['title'] = "Radera innehåll";
$newton['main'] = <<<EOD
<h1>Ta bort film</h1>
<form method=post>
    <input type='hidden' name='id' value='{$id}'/>
    <p>Titel: <input type='text' name='title' value='{$title}' disabled/></p>
    <p><input type='submit' name='delete' value='Ta bort'></p>
    <p><a href='movieview.php'>Visa alla filmer</a></p>
    <p>{$doDelete}</p>
</form>
EOD;


// Finally, leave it all to the rendering phase of Newton.
include(NEWTON_THEME_PATH);
