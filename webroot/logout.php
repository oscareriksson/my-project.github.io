<?php
/**
 * This is a Newton pagecontroller.
 *
 */
// Include the essential config-file which also creates the $newton variable with its defaults.
include(__DIR__.'/config.php');

$logout = isset($_POST['logout']) ? $_POST['logout'] : null;

$newton['title'] = "Logga ut";

$user = new CUser();

if($logout) {
    $user->Logout($logout);
}

$output = $user->IsAuthenticated() ? "Du är inloggad som " . $user->getAcronym() . " (" . $user->getName() . ")": "Du är inte inloggad.";

$newton['main'] = <<<EOD
<h1>{$newton['title']}</h1>
<div class='output'>
<form action='logout.php' method='post'>
<p><input type='submit' name='logout' value='Logout'></p>
</form>
<p>{$output}</p>
</div>
EOD;


// Finally, leave it all to the rendering phase of Newton.
include(NEWTON_THEME_PATH);
