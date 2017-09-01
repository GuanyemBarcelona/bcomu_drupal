<?php
/**
 * @file
 * Documentation for the EU Cookie Compliance module.
 *
 * This file contains no working PHP code; it exists to provide additional
 * documentation for doxygen as well as to document hooks in the standard
 * Drupal manner.
 */

/**
 * @defgroup EU Cookie Compliance hooks
 *
 * @{
 * Hooks that can be implemented to externally extend the EU Cookie Compliance module.
 */

/**
 * Take control of EU Cookie Compliance path exclusion.
 *
 * @param boolean $excluded
 *   Whether this path is excluded from cookie compliance behavior.
 * @param string $path
 *   Current string path.
 * @param string $setting
 *   Admin variable of excluded paths.
 */
function hook_eu_cookie_compliance_path_match_alter(&$excluded, $path, $setting) {
  $node = menu_get_object('node');
  if ($node && $node->type === 'my_type') {
    $excluded = TRUE;
  }
}

/**
 * @}
 * End hook documentation.
 */
