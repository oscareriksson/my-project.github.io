<?php
/**
 * Config-file for Newton. Change settings here to affect installation.
 *
 */

/**
 * Set the error reporting.
 *
 */
error_reporting(-1);              // Report all type of errors
ini_set('display_errors', 1);     // Display all errors
ini_set('output_buffering', 0);   // Do not buffer outputs, write directly


/**
 * Define Newton paths.
 *
 */
define('NEWTON_INSTALL_PATH', __DIR__ . '/..');
define('NEWTON_THEME_PATH', NEWTON_INSTALL_PATH . '/theme/render.php');


/**
 * Include bootstrapping functions.
 *
 */
include(NEWTON_INSTALL_PATH . '/src/bootstrap.php');


/**
 * Start the session.
 *
 */
session_name(preg_replace('/[^a-z\d]/i', '', __DIR__));
session_start();


/**
 * Create the Newton variable.
 *
 */
$newton = array();

//Login/Admin-button
$user = new CUser();
!$user->IsAuthenticated() ? $logAd = "Login" : $logAd = "Administration";


/**
 * Site wide settings.
 *
 */
$newton['lang']         = 'sv';
$newton['title_append'] = ' | Din webbsida för filmer';

$newton['searchbox'] = <<<EOD
<div class="searchbox">
<form class="search-form" action="movies.php">
    <input class="search-input" required="" type="search" name="title" placeholder="Sök">
</form>
</div>
EOD;

$newton['corner'] = <<< EOD
    <div class='sitetitle'><a href='index.php'><img src='img/logo1.png'/></a></div>
EOD;

$newton['navbar'] = array(
    'items' => array(
  'home'  => array('text'=>'Nytt',  'url'=>'index.php'),
  'movies' => array('text'=>'Filmer', 'url'=>'movies.php'),
  'blog' => array('text'=>'Bilder', 'url'=>'blog.php'),
));



$newton['footer'] = <<<EOD
<footer><span class='sitefooter'>Copyright © 2015 RM Rental Movies (rentalmovies@info.com) | <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a></span></footer>
EOD;

/**
 * Settings for the database.
 *
 */
/*
  define('DB_PASSWORD', '1=9b{q3R');
 $newton['database']['dsn']            = 'mysql:host=sql113.byethost12.com;dbname=b12_17778531_oscar;';
 $newton['database']['username']       = 'b12_17778531';
 $newton['database']['password']       = 'Skidor95';
 $newton['database']['driver_options'] = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'");
*/
// Local

 define('DB_PASSWORD', '1=9b{q3R');
$newton['database']['dsn']            = 'mysql:host=localhost;dbname=oser15;';
$newton['database']['username']       = 'root';
$newton['database']['password']       = '';
$newton['database']['driver_options'] = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'");



/**
 * Theme related settings.
 *
 */
//$newton['stylesheet'] = 'css/style.css';
$newton['stylesheets'] = array('css/style.css');
$newton['favicon']    = 'img/logo.png';

$newton['stylesheets'][]        = 'https://fonts.googleapis.com/css?family=Average+Sans';
$newton['stylesheets'][] = 'https://fonts.googleapis.com/css?family=Marcellus+SC';
$newton['stylesheets'][] = 'https://fonts.googleapis.com/css?family=Roboto+Condensed';

/**
 * Settings for JavaScript.
 *
 */
$newton['modernizr'] = 'js/modernizr.js';
$newton['jquery'] = '//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js';
//$newton['jquery'] = null; // To disable jQuery
$newton['javascript_include'] = array();
//$newton['javascript_include'] = array('js/main.js'); // To add extra javascript files



/**
 * Google analytics.
 *
 */
$newton['google_analytics'] = 'UA-22093351-1'; // Set to null to disable google analytics
