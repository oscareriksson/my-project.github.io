<?php
/**
 * This is a Newton pagecontroller.
 *
 */
// Include the essential config-file which also creates the $newton variable with its defaults.
include(__DIR__.'/config.php');

$content = new CContent($newton['database']);

$newton['title'] = "Visa innehåll i Content";
$html = $content->getAllContent();

$newton['main'] = <<<EOD
    <h1>Hantera innehåll</h1>
    <ul>
    {$html}
    </ul>
    <p><a href='addcontent.php'>Nytt filmklipp</a></p>
        <p><a href='login.php'>Gå tillbaka</a></p>
EOD;


// Finally, leave it all to the rendering phase of Newton.
include(NEWTON_THEME_PATH);
