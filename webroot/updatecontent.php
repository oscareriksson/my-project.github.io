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

$content = new CContent($newton['database']);

$id     = isset($_POST['id'])    ? strip_tags($_POST['id']) : (isset($_GET['id']) ? strip_tags($_GET['id']) : null);
$save = isset($_POST['save']) ? $_POST['save'] : null;

is_numeric($id) or die('ID is not numeric.');

$output = null;
if ($save) {
    $output = $content->updateContentTable();
}

$update = null;
$update = $content->getContentById($id);

$title = htmlentities($update->title, null, 'UTF-8');
$slug = htmlentities($update->slug, null, 'UTF-8');
$url = htmlentities($update->url, null, 'UTF-8');
$data = htmlentities($update->DATA, null, 'UTF-8');
$type = htmlentities($update->TYPE, null, 'UTF-8');
$image = htmlentities($update->image, null, 'UTF-8');
$youtube = htmlentities($update->youtube, null, 'UTF-8');

$getType = $content->getType($id, $youtube, $image);

$newton['title'] = "Ändra innehåll i Content";

$newton['main'] = <<<EOD
    <h1>Ändra innehåll</h1>
    <output style='color:green;margin:10px;font-weight:600;'>{$output}</output>
    <div class='output'>
    <form enctype="multipart/form-data" method=post>
       <input type='hidden' name='id' value='{$id}'/>
       <p><label>Titel:<br/><input type='text' name='title' value='{$title}'/></label></p>
       <p><label>Slug:<br/><input type='text' name='slug' value='{$slug}'/></label></p>
       <p><label>Url:<br/><input type='text' name='url' value='{$url}'/></label></p>
       <p><label>Text:<br/><textarea rows="10" cols="50" name='DATA'>{$data}</textarea></label></p>
       <p><label>Type:<br/><input type='text' name='TYPE' value='{$type}'/></label></p>
       <p><label>Bild:<br/><img src='img/{$image}' alt='Current img' style='max-width:200px;'><br/><input type='file' name='image' id='image' value='{$image}'/></label></p>
       <p><input type='hidden' name='image' value='{$image}'/><label>Youtube-länk:<br/><input type='text' name='youtube' value='{$youtube}'/></label></p>
       <p><input type='submit' name='save' value='Spara'/> <input type='reset' value='Återställ'/></p>
       <p><a href='contentview.php'>Visa allt innehåll</a></p>
    </fieldset>
  </form>
</div>

EOD;

// Finally, leave it all to the rendering phase of Newton.
include(NEWTON_THEME_PATH);
