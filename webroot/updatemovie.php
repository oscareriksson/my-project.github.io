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
$save = isset($_POST['save']) ? $_POST['save'] : null;

is_numeric($id) or die('ID is not numeric.');

$output = null;
if ($save) {
    $output = $movie->updateMovieTable();
}

$update = null;
$update = $movie->getMovieById($id);

$title = htmlentities($update->title, null, 'UTF-8');
$text = htmlentities($update->text, null, 'UTF-8');
$category = htmlentities($update->category, null, 'UTF-8');
$image = htmlentities($update->image, null, 'UTF-8');
$created = htmlentities($update->created, null, 'UTF-8');

$genreEx = $movie->getDistinctGenre();

$newton['title'] = "Ändra innehållet i Movie";

$newton['main'] = <<<EOD
    <h1>Ändra filmer</h1>
    <output style='color:green;margin:10px;font-weight:600;'>{$output}</output>
    <div class='output'>
    <form enctype="multipart/form-data" method=post>
       <input type='hidden' name='id' value='{$id}'/>
       <p><label>Titel:<br/><input type='text' name='title' value='{$title}'/></label></p>
       <p><label>Kategori:<br/><input type='text' name='category' value='{$category}'/></label></p>{$genreEx}
       <p><label>Text:<br/><textarea rows="10" cols="50" name='text'>{$text}</textarea></label></p>
       <p><label>Bild:<br/><img src='img/{$image}' alt='Current img' style='max-width:200px;'><br/><input type='file' name='image' id='image'/></label></p>
       <p><label>Publiceringsdatum:<br/><input type='text' name='created' value='{$created}'/></label></p>
       <p><input type='submit' name='save' value='Spara'/> <input type='reset' value='Återställ'/></p>
    </fieldset>
  </form>
  <p><a href='movieview.php'>Visa allt innehåll</a></p>
</div>

EOD;

// Finally, leave it all to the rendering phase of Newton.
include(NEWTON_THEME_PATH);
