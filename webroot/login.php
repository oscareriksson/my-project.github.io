<?php
/**
 * This is a Newton pagecontroller.
 *
 */
// Include the essential config-file which also creates the $newton variable with its defaults.
include(__DIR__.'/config.php');

$userBase = new CUser();

if (isset($_POST['login'])) {
    $userBase->Login($_POST['username'], $_POST['password'], $newton['database']);
}

$newton['title'] = "Login";

$output = $userBase->IsAuthenticated() ? "<p>Du är inloggad som " . $userBase->getAcronym() . " (" . $userBase->getName() . ") </p>" : "<p>Du är inte inloggad.</p>";

if ($userBase->IsAuthenticated()) {
    $newton['title'] = "Administration";
    $output .= <<<EOD
    <p><a href='contentview.php'>Hantera filmer</a></p>
    <p><a href='movieview.php'>Hantera bilder</a></p>
EOD;
}
else {
    $output .= <<<EOD
    <form method='post'>
    <fieldset>
    <legend>Login</legend>
    <p>Du kan logga in med admin/admin eller doe/doe.</p>
    <p>User: <input type='text' name='username'></p>
    <p>Password: <input type='password' name='password'></p>
    <p><input type='submit' name='login' value='Login'></p>
    </form>
EOD;
}

$newton['main'] = <<<EOD
<h1>{$newton['title']}</h1>
<div class='output'>
<p>{$userBase->getResult()}</p>
<output>{$output}</output>
<p><a href='logout.php'>Logga ut</a></p>
</div>
EOD;

// Finally, leave it all to the rendering phase of Newton.
include(NEWTON_THEME_PATH);
