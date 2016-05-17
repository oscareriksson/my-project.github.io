<?php
/**
 * This is a Newton pagecontroller.
 *
 */
// Include the essential config-file which also creates the $newton variable with its defaults.
include(__DIR__.'/config.php');

$hits     = isset($_GET['hits'])  ? $_GET['hits']  : 8;
$page     = isset($_GET['page'])  ? $_GET['page']  : 1;
$slug = isset($_GET['slug']) ? $_GET['slug'] : null;
$category = isset($_GET['category']) ? $_GET['category'] : null;


// Check that incoming parameters are valid
is_numeric($hits) or die('Check: Hits must be numeric.');
is_numeric($page) or die('Check: Page must be numeric.');

$hits = htmlentities($hits);
$page = htmlentities($page);
$slug = htmlentities($slug);
$category = htmlentities($category);

$blog = new CBlog($newton['database']);

$html = $blog->showBlogContent($hits, $page, $slug, $category);

$amount = null;
$nav = null;
$blogreturn = "<div class='blog-return'><a href='blog.php'>&#10096; Tillbaka till bloggen</a></div>";

if(!$slug) {
    $nav = $blog->getPageNavigation($hits, $page);
    $amount = $blog->getHitsPerPage(array('2','4','8'));
    $blogreturn = null;
}

$html .= $blogreturn;

$newton['title'] = "Blogg";
$newton['main'] = <<<EOD
    <div class='blog-header'><h1><a href='blog.php'>{$newton['title']}</a></h1></div>
    {$amount}
    {$html}
    {$nav}
EOD;

// Finally, leave it all to the rendering phase of Newton.
include(NEWTON_THEME_PATH);
