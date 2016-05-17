<?php
/**
 * This is a Newton pagecontroller.
 *
 */
// Include the essential config-file which also creates the $newton variable with its defaults.
include(__DIR__.'/config.php');

$dice = new CDiceView();

// Do it and store it all in variables in the Newton container.
$newton['title'] = "Kasta tärning";

$newton['main'] = "
<h1>Tävling!</h1>
<div class='gameRules'>
<p>Just nu har vi en tävling på Rental Movies där du kan vinna en gratis hyrfilm hos oss.<br>
Tävlingen utförs direkt här på hemsidan och reglerna är enkla:</p>
<p>Nå 100 poäng genom att slå tärningen och spara dina värden.</p>
<p>Slår du en etta innan du sparat dina poäng så förloras poängen för den rundan.</p>
<p>Spelet startar när du slår tärningen.</p>
</div>
<div class='gameMenu'>
<ul>
<li><a href='?roll'>Kasta tärning</a></li>
<li><a href='?save'>Spara poäng</a></li>
<li><a href='?newgame'>Starta nytt</a></li>
</ul>
</div>
<div class='gameContent'>
" . $dice->View() . "</div>
";



// Finally, leave it all to the rendering phase of Newton.
include(NEWTON_THEME_PATH);
