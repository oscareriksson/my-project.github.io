<?php
/**
 * This is a Newton pagecontroller.
 *
 */
// Include the essential config-file which also creates the $newton variable with its defaults.
include(__DIR__.'/config.php');

$cpage = new CPage($newton['database']);

$html = $cpage->showPageContent();

$newton['title'] =  $cpage->getTitle();

$newton['main'] = <<<EOD
<div class='output'>
{$html}
</div>
EOD;

// Finally, leave it all to the rendering phase of Newton.
include(NEWTON_THEME_PATH);
