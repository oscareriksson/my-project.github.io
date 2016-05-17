<?php
/**
 * Theme related functions.
 *
 */

/**
 * Get title for the webpage by concatenating page specific title with site-wide title.
 *
 * @param string $title for this page.
 * @return string/null wether the favicon is defined or not.
 */
function get_title($title) {
  global $newton;
  return $title . (isset($newton['title_append']) ? $newton['title_append'] : null);
}

/**
 * Create a navigation bar / menu for the site.
 *
 * @param string $menu for the navigation bar.
 * @return string as the html for the menu.
 */

function generateMenu($navbar) {
  $html = "<nav>\n";
  foreach($navbar['items'] as $item) {
    $selected = (basename($_SERVER['PHP_SELF'])) == $item['url'] ? 'selected' : null;
    $html .= "<li><a href='{$item['url']}' class='{$selected}'>{$item['text']}</a></li>";
  }
  $html .= "</nav>\n";
  return $html;
}
