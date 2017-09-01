<?php
/**
 * @file
 * This file provides administration form for the module.
 */

/**
 * Provides form for cookie control popup.
 *
 * @param array $form
 * @param array $form_state
 *
 * @return mixed
 */
function eu_cookie_compliance_admin_form($form, $form_state) {
  $form = array();

  $popup_settings = eu_cookie_compliance_get_settings();

  $default_filter_format = filter_default_format();
  if ($default_filter_format == 'filtered_html') {
    $default_filter_format = 'full_html';
  }

  $form['eu_cookie_compliance'] = array(
    '#type' => 'item',
    '#tree' => TRUE,
  );

  $form['eu_cookie_compliance']['info'] = array(
    '#markup' => t('<p><strong>Note:</strong> <ul><li>The permission "Display EU Cookie Compliance popup" needs to be enabled for Anonymous and Authenticated users in order for the banner to appear.</li><li>In order for the module to work, <code>$scripts</code> needs to be output before <code>$page_bottom</code> in your <code>html.tpl.php</code>.</li></ul></p>'),
  );

  $form['eu_cookie_compliance']['popup_enabled'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable popup'),
    '#default_value' => isset($popup_settings['popup_enabled']) ? $popup_settings['popup_enabled'] : 0,
  );

  $form['popup_message'] = array(
    '#type' => 'fieldset',
    '#title' => t('Popup Message'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );

  $form['popup_message']['eu_cookie_compliance'] = array(
    '#type' => 'item',
    '#tree' => TRUE,
  );

  $form['popup_message']['eu_cookie_compliance']['popup_clicking_confirmation'] = array(
    '#type' => 'checkbox',
    '#title' => t('Consent by clicking'),
    '#description' => t('By default by clicking any link or button on the website the visitor accepts the cookie policy. Uncheck this box if you do not require this functionality. You may want to edit the pop-up message below accordingly.'),
    '#default_value' => isset($popup_settings['popup_clicking_confirmation']) ? $popup_settings['popup_clicking_confirmation'] : 1,
  );

  $form['popup_message']['eu_cookie_compliance']['popup_info'] = array(
    '#type' => 'text_format',
    '#title' => t('Popup message - requests consent'),
    '#default_value' => isset($popup_settings['popup_info']['value']) ? $popup_settings['popup_info']['value'] : '',
    '#required' => TRUE,
    '#format' => isset($popup_settings['popup_info']['format']) ? $popup_settings['popup_info']['format'] : $default_filter_format,
  );

  $form['popup_message']['eu_cookie_compliance']['popup_agree_button_message'] = array(
    '#type' => 'textfield',
    '#title' => t('Agree button label'),
    '#default_value' => isset($popup_settings['popup_agree_button_message']) ? $popup_settings['popup_agree_button_message'] : t('OK, I agree'),
    '#size' => 30,
    '#required' => TRUE,
  );

  $form['popup_message']['eu_cookie_compliance']['popup_disagree_button_message'] = array(
    '#type' => 'textfield',
    '#title' => t('Disagree button label'),
    '#default_value' => isset($popup_settings['popup_disagree_button_message']) ? $popup_settings['popup_disagree_button_message'] : t('No, give me more info'),
    '#size' => 30,
    '#required' => TRUE,
  );

  $form['thank_you'] = array(
    '#type' => 'fieldset',
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#title' => t('Thank You Message'),
  );

  $form['thank_you']['eu_cookie_compliance'] = array(
    '#type' => 'item',
    '#tree' => TRUE,
  );

  $form['thank_you']['eu_cookie_compliance']['popup_agreed_enabled'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable thank you message'),
    '#default_value' => isset($popup_settings['popup_agreed_enabled']) ? $popup_settings['popup_agreed_enabled'] : 1,
  );

  $form['thank_you']['eu_cookie_compliance']['popup_hide_agreed'] = array(
    '#type' => 'checkbox',
    '#title' => t('Clicking hides “Thank you” message'),
    '#default_value' => isset($popup_settings['popup_hide_agreed']) ? $popup_settings['popup_hide_agreed'] : 0,
    '#description' => t('Clicking a link or button hides the thank you message automatically.'),
  );

  $form['thank_you']['eu_cookie_compliance']['popup_agreed'] = array(
    '#type' => 'text_format',
    '#title' => t('Popup message - thank you for giving consent'),
    '#default_value' => isset($popup_settings['popup_agreed']['value']) ? $popup_settings['popup_agreed']['value'] : '',
    '#required' => TRUE,
    '#format' => isset($popup_settings['popup_agreed']['format']) ? $popup_settings['popup_agreed']['format'] : $default_filter_format,
  );

  $form['thank_you']['eu_cookie_compliance']['popup_find_more_button_message'] = array(
    '#type' => 'textfield',
    '#title' => t('More info button label'),
    '#default_value' => isset($popup_settings['popup_find_more_button_message']) ? $popup_settings['popup_find_more_button_message'] : t('More info'),
    '#size' => 30,
    '#required' => TRUE,
  );

  $form['thank_you']['eu_cookie_compliance']['popup_hide_button_message'] = array(
    '#type' => 'textfield',
    '#title' => t('Hide button label'),
    '#default_value' => isset($popup_settings['popup_hide_button_message']) ? $popup_settings['popup_hide_button_message'] : t('Hide'),
    '#size' => 30,
    '#required' => TRUE,
  );

  $form['privacy'] = array(
    '#type' => 'fieldset',
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#title' => t('Privacy Policy'),
  );

  $form['privacy']['eu_cookie_compliance'] = array(
    '#type' => 'item',
    '#tree' => TRUE,
  );

  $form['privacy']['eu_cookie_compliance']['popup_link'] = array(
    '#type' => 'textfield',
    '#title' => t('Privacy policy link'),
    '#default_value' => isset($popup_settings['popup_link']) ? $popup_settings['popup_link'] : '',
    '#size' => 60,
    '#maxlength' => 220,
    '#required' => TRUE,
    '#description' => t('Enter link to your privacy policy or other page that will explain cookies to your users. For external links prepend http://'),
  );

  $form['privacy']['eu_cookie_compliance']['popup_link_new_window'] = array(
    '#type' => 'checkbox',
    '#title' => t('Open privacy policy link in a new window'),
    '#default_value' => isset($popup_settings['popup_link_new_window']) ? $popup_settings['popup_link_new_window'] : 1,
  );

  $form['appearance'] = array(
    '#type' => 'fieldset',
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
    '#title' => t('Appearance'),
  );

  $form['appearance']['eu_cookie_compliance'] = array(
    '#type' => 'item',
    '#tree' => TRUE,
  );

  $form_color_picker_type = 'textfield';

  if (module_exists('jquery_colorpicker')) {
    $form_color_picker_type = 'jquery_colorpicker';
  }

  $form['appearance']['eu_cookie_compliance']['use_bare_css'] = array(
    '#type' => 'checkbox',
    '#title' => t('Include minimal CSS, I want to style the overlay in the theme CSS.'),
    '#default_value' => isset($popup_settings['use_bare_css']) ? check_plain($popup_settings['use_bare_css']) : 0,
    '#description' => t('This may be useful if you want the overlay to share the button style of your theme. Note that you will have to configure values like the overlay width, text color and background color in your CSS file.'),
  );

  $form['appearance']['eu_cookie_compliance']['popup_text_hex'] = array(
    '#type' => $form_color_picker_type,
    '#title' => t('Text Color'),
    '#default_value' => isset($popup_settings['popup_text_hex']) ? check_plain($popup_settings['popup_text_hex']) : 'ffffff',
    '#description' => t('Change the text color of the popup. Provide HEX value without the #.'),
    '#element_validate' => array('eu_cookie_compliance_validate_hex'),
  );

  $form['appearance']['eu_cookie_compliance']['popup_bg_hex'] = array(
    '#type' => $form_color_picker_type,
    '#title' => t('Background Color'),
    // Garland colors => 0779BF.
    '#default_value' => isset($popup_settings['popup_bg_hex']) ? check_plain($popup_settings['popup_bg_hex']) : '0779BF',
    '#description' => t('Change the background color of the popup. Provide HEX value without the #.'),
    '#element_validate' => array('eu_cookie_compliance_validate_hex'),
  );

  $form['appearance']['eu_cookie_compliance']['popup_height'] = array(
    '#type' => 'textfield',
    '#title' => t('Popup height in pixels'),
    '#default_value' => isset($popup_settings['popup_height']) ? $popup_settings['popup_height'] : '',
    '#size' => 5,
    '#maxlength' => 5,
    '#required' => FALSE,
    '#description' => t('Enter an integer value for a desired height in pixels or leave empty for automatically adjusted height. Do not set this value if you are using responsive theme.'),

  );

  $form['appearance']['eu_cookie_compliance']['popup_width'] = array(
    '#type' => 'textfield',
    '#title' => t('Popup width in pixels or a percentage value'),
    '#default_value' => isset($popup_settings['popup_width']) ? $popup_settings['popup_width'] : '100%',
    '#size' => 5,
    '#maxlength' => 5,
    '#required' => FALSE,
    '#description' => t('Set the width of the popup. This can be either an integer value or percentage of the screen width. For example: 200 or 50%.'),
  );

  $form['advanced'] = array(
    '#type' => 'fieldset',
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
    '#title' => t('Advanced'),
  );

  $form['advanced']['eu_cookie_compliance'] = array(
    '#type' => 'item',
    '#tree' => TRUE,
  );

  $form['advanced']['eu_cookie_compliance']['popup_position'] = array(
    '#type' => 'checkbox',
    '#title' => t('Place the pop-up at the top of the website'),
    '#default_value' => isset($popup_settings['popup_position']) ? $popup_settings['popup_position'] : 0,
    '#description' => t('By default the pop-up appears at the bottom of the website. Tick this box if you want it to appear at the top.'),
  );

  $form['advanced']['eu_cookie_compliance']['fixed_top_position'] = array(
    '#type' => 'checkbox',
    '#title' => t('If the banner is at the top, don’t scroll the banner with the page'),
    '#default_value' => isset($popup_settings['fixed_top_position']) ? $popup_settings['fixed_top_position'] : 0,
    '#description' => t('Use position:fixed for the banner when displayed at the top.'),
  );

  if (module_exists('geoip') || module_exists('smart_ip') || extension_loaded('geoip')) {
    $form['advanced']['eu_cookie_compliance']['eu_only'] = array(
      '#type' => 'checkbox',
      '#title' => t('Only display popup in EU countries'),
      '#default_value' => isset($popup_settings['eu_only']) ? $popup_settings['eu_only'] : 0,
      '#description' => 'You can limit the number of countries for which the banner is displayed by checking this option. If you want to provide a list of countries other than current EU states, you may place an array in <code>$conf[\'eu_cookie_compliance_eu_countries\']</code> in your <code>settings.php</code> file. Using the <a href="http://drupal.org/project/geoip">geoip</a> module or the <a href="http://drupal.org/project/smart_ip">smart_ip</a> module or the <a href="http://www.php.net/manual/fr/function.geoip-country-code-by-name.php">geoip_country_code_by_name()</a> PHP function.',
    );
    $form['advanced']['eu_cookie_compliance']['eu_only_js'] = array(
      '#type' => 'checkbox',
      '#title' => t('JavaScript-based (for Varnish): Only display popup in EU countries'),
      '#default_value' => isset($popup_settings['eu_only_js']) ? $popup_settings['eu_only_js'] : 0,
      '#description' => 'You can limit the number of countries for which the banner is displayed by checking this option. If you want to provide a list of countries other than current EU states, you may place an array in <code>$conf[\'eu_cookie_compliance_eu_countries\']</code> in your <code>settings.php</code> file. Using the <a href="http://drupal.org/project/geoip">geoip</a> module or the <a href="http://drupal.org/project/smart_ip">smart_ip</a> module or the <a href="http://www.php.net/manual/fr/function.geoip-country-code-by-name.php">geoip_country_code_by_name()</a> PHP function.',
    );
  }

  $form['advanced']['eu_cookie_compliance']['popup_delay'] = array(
    '#type' => 'textfield',
    '#title' => t('Popup time delay in milliseconds'),
    '#default_value' => isset($popup_settings['popup_delay']) ? $popup_settings['popup_delay'] : 1000,
    '#size' => 5,
    '#maxlength' => 5,
    '#required' => TRUE,
  );

  $form['advanced']['eu_cookie_compliance']['disagree_do_not_show_popup'] = array(
    '#type' => 'checkbox',
    '#title' => t('Do not show popup after user clicks on "Disagree" button.'),
    '#default_value' => isset($popup_settings['disagree_do_not_show_popup']) ? $popup_settings['disagree_do_not_show_popup'] : 0,
    '#description' => t('Enabling this will make it possible to record the fact that the user disagrees without the user having to see the privacy policy.'),
  );

  $form['advanced']['eu_cookie_compliance']['reload_page'] = array(
    '#type' => 'checkbox',
    '#title' => t('Reload page after user clicks on “Agree” button.'),
    '#default_value' => isset($popup_settings['reload_page']) ? $popup_settings['reload_page'] : 0,
  );

  $form['advanced']['eu_cookie_compliance']['popup_scrolling_confirmation'] = array(
    '#type' => 'checkbox',
    '#title' => t('Consent by scrolling'),
    '#default_value' => isset($popup_settings['popup_scrolling_confirmation']) ? $popup_settings['popup_scrolling_confirmation'] : 0,
    '#description' => t('Scrolling makes the visitors to accept the cookie policy. In some countries, like Italy, it is permitted.'),
  );

  $form['advanced']['eu_cookie_compliance_domain'] = array(
    '#type' => 'textfield',
    '#title' => t('Domain'),
    '#default_value' => variable_get('eu_cookie_compliance_domain', ''),
    '#description' => t('Sets the domain of the cookie to a specific url. Used when you need consistency across domains. This is language independent. Note: Make sure you actually enter a domain that the browser can make use of. For example if your site is accessible at both www.domain.com and domain.com, you will not be able to hide the banner at domain.com if your value for this field is www.domain.com.'),
  );

  $form['advanced']['eu_cookie_compliance_cookie_lifetime'] = array(
    '#type' => 'textfield',
    '#title' => t('Cookie lifetime'),
    '#default_value' => variable_get('eu_cookie_compliance_cookie_lifetime', 100),
    '#description' => t('How long does the system remember the user’s choice, in days.'),
  );

  // Adding option to add/remove popup on specified domains.
  $exclude_domains_option_active = array(
    0 => t('Add'),
    1 => t('Remove'),
  );
  $form['advanced']['eu_cookie_compliance']['domains_option'] = array(
    '#type' => 'radios',
    '#title' => t('Add/Remove popup on specified domains'),
    '#default_value' => isset($popup_settings['domains_option']) ? $popup_settings['domains_option'] : 1,
    '#options' => $exclude_domains_option_active,
    '#description' => t('Specify if you want to add or remove popup on the listed below domains.'),
  );
  $form['advanced']['eu_cookie_compliance']['domains_list'] = array(
    '#type' => 'textarea',
    '#title' => t('Domains list'),
    '#default_value' => isset($popup_settings['domains_list']) ? $popup_settings['domains_list'] : '',
    '#description' => t('Specify domains with protocol (e.g. http or https). Enter one domain per line.'),
  );

  $form['advanced']['eu_cookie_compliance']['exclude_paths'] = array(
    '#type' => 'textarea',
    '#title' => t('Exclude paths'),
    '#default_value' => isset($popup_settings['exclude_paths']) ? $popup_settings['exclude_paths'] : '',
    '#description' => t('Specify pages by using their paths. Enter one path per line. The ‘*’ character is a wildcard. Example paths are %blog for the blog page and %blog-wildcard for every personal blog. %front is the front page.', array('%blog' => 'blog', '%blog-wildcard' => 'blog/*', '%front' => '<front>')),
  );

  $form['advanced']['eu_cookie_compliance']['exclude_admin_pages'] = array(
    '#type' => 'checkbox',
    '#title' => t('Exclude admin pages'),
    '#default_value' => isset($popup_settings['exclude_admin_pages']) ? $popup_settings['exclude_admin_pages'] : '',
  );

  $form['advanced']['eu_cookie_compliance']['exclude_uid_1'] = array(
    '#type' => 'checkbox',
    '#title' => t('Don’t show the banner for UID 1.'),
    '#default_value' => isset($popup_settings['exclude_uid_1']) ? $popup_settings['exclude_uid_1'] : 0,
  );

  $form['advanced']['eu_cookie_compliance']['script_scope'] = array(
    '#type' => 'select',
    '#title' => t('Script scope'),
    '#options' => array('header' => 'Header (Scripts variable)', 'footer' => 'Footer (Page bottom variable)'),
    '#default_value' => isset($popup_settings['script_scope']) ? $popup_settings['script_scope'] : 'footer',
    '#description' => t('If you want to use the hasAgreed() function from other scripts, you may want to change this to header.'),
  );

  $form['advanced']['eu_cookie_compliance']['better_support_for_screen_readers'] = array(
    '#type' => 'checkbox',
    '#title' => t('Let screen readers see the banner before other links on the page.'),
    '#default_value' => isset($popup_settings['better_support_for_screen_readers']) ? $popup_settings['better_support_for_screen_readers'] : 0,
    '#description' => t('Enable this if you want to place the banner as the first HTML element on the page. This will make it possible for screen readers to close the banner without tabbing through all links on the page.'),
  );

  $form['#attached']['js'][] = drupal_get_path('module', 'eu_cookie_compliance'). '/js/eu_cookie_compliance.admin.js';

  return system_settings_form($form);
}

/**
 * Validates form for cookie control popup.
 *
 * @param array $form
 * @param array $form_state
 */
function eu_cookie_compliance_admin_form_validate($form, &$form_state) {
  if ((!preg_match('/^[1-9][0-9]{0,4}$/', $form_state['values']['eu_cookie_compliance']['popup_delay'])) && ($form_state['values']['eu_cookie_compliance']['popup_delay'] != '0')) {
    form_set_error('eu_cookie_compliance][popup_delay', t('Delay must be an integer value.'));
  }
  if (empty($form_state['values']['eu_cookie_compliance']['use_bare_css'])) {
    if (!preg_match('/^[1-9][0-9]{0,4}$/', $form_state['values']['eu_cookie_compliance']['popup_height']) && !empty($form_state['values']['eu_cookie_compliance']['popup_height'])) {
      form_set_error('eu_cookie_compliance][popup_height', t('Height must be an integer value .'));
    }
    if (!preg_match('/^[1-9][0-9]{1,4}\%?$/', $form_state['values']['eu_cookie_compliance']['popup_width'])) {
      form_set_error('eu_cookie_compliance][popup_width', t('Width must be an integer or a percentage value.'));
    }
  }
  else {
    $form_state['values']['eu_cookie_compliance']['popup_width'] = '';
    $form_state['values']['eu_cookie_compliance']['popup_height'] = '';
    $form_state['values']['eu_cookie_compliance']['popup_bg_hex'] = '';
    $form_state['values']['eu_cookie_compliance']['popup_text_hex'] = '';
  }
  $popup_link = $form_state['values']['eu_cookie_compliance']['popup_link'];
  // If the link contains a fragment then check if it validates then rewrite
  // link with full url.
  if ((strpos($popup_link, '#') !== FALSE) && (strpos($popup_link, 'http') === FALSE)) {
    $fragment = explode('#', $popup_link);
    $popup_link = url($fragment[0], array('fragment' => $fragment[1], 'absolute' => TRUE));
    form_set_error('eu_cookie_compliance][popup_link', t('Looks like your privacy policy link contains a fragment #. You should make this an absolute url, e.g. @link', array('@link' => $popup_link)));
  }

  $use_domain = FALSE;
  if (module_exists('domain')) {
    $domains = domain_domains();
    $use_domain = TRUE;
  }
  // Clear cache for all enabled themes.
  $themes = system_rebuild_theme_data();
  foreach ($themes as $theme) {
    if ($theme->status == 1) {
      if (module_exists('locale')) {
        $languages = locale_language_list();
      }
      else {
        global $language;
        $current_language = !empty($language->language) ? $language->language : 'en';
        $languages = array($current_language => $current_language);
      }
      foreach($languages as $key => $current_language) {
        if ($use_domain) {
          foreach ($domains as $domain) {
            cache_clear_all('eu_cookie_compliance_client_settings:' . $key . ':' . $theme->name . ':' . $domain['domain_id'], 'cache', TRUE);
          }
        }
        else {
          cache_clear_all('eu_cookie_compliance_client_settings:' . $key . ':' . $theme->name, 'cache', TRUE);
        }
      }
    }
  }
}

/**
 * Validate field for a HEX value if a value is set.
 *
 * @param array $element
 * @param array $form_state
 */
function eu_cookie_compliance_validate_hex($element, &$form_state) {
  if (!empty($element['#value']) && !preg_match('/^[0-9a-fA-F]{3,6}$/', $element['#value'])) {
    form_error($element, t('%name must be a HEX value (without leading #) or empty.', array('%name' => $element['#title'])));
  }
}
