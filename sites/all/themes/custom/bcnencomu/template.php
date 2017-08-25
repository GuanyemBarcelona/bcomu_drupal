<?php
define('CANDIDACY_HEAD_NID', 162);
define('CANDIDACY_COUNCIL_NID', 173);
define('CANDIDACY_COUNCIL_JULY_NID', 1495);
define('CANDIDACY_COORDINATION2015_NID', 1671);
define('CANDIDACY_GUARANTEES2015_NID', 1673);
define('CALENDAR_NID', 3);
define('ENCOMUMAP_NID', 1062);
define('ENCOMU_FORM_NID', 1808);
define('CRONOGRAMA_NID', 1875);
define('ESPAIS_EIXOS_NID', 2037);
define('ESPAIS_GRUPS_NID', 2054);
define('ESPAIS_COMIS_NID', 2053);
define('RELATEM_CANVI_TID', 584);
define('INTERNACIONAL_TID', 588);
define('EQUIP_BCOMU_NID', 1617);

// Auto-rebuild the theme registry during theme development.
if (theme_get_setting('clear_registry')) {
	// Rebuild .info data.
	system_rebuild_theme_data();
	// Rebuild theme registry.
	drupal_theme_rebuild();
}

/**
 * Implements hook_html_head_alter().
 */
function bcnencomu_html_head_alter(&$head_elements) {
	// This meta uses 'about' attribute, which is non-standard
	unset($head_elements['rdf_node_title']);
}

/**
 * Implements hook_admin_paths_alter().
 */
function bcnencomu_admin_paths_alter(&$paths) {
  $paths['node/*'] = FALSE;
}

/**
 * Preprocesses the wrapping HTML.
 *
 * @param array &$vars
 *   Template variables.
 */
function bcnencomu_preprocess_html(&$vars) {
	if ($vars['is_front']) {
   	$vars['head_title'] = $vars['head_title_array']['name'];
  }

	// Setup IE meta tag to force IE rendering mode
	$meta_ie_render_engine = array(
		'#type' => 'html_tag',
		'#tag' => 'meta',
		'#attributes' => array(
			'content' =>  'IE=edge,chrome=1',
			'http-equiv' => 'X-UA-Compatible',
		)
	);
	drupal_add_html_head($meta_ie_render_engine, 'meta_ie_render_engine');

	// Mobile viewport optimized: h5bp.com/viewport
	// Add this for the Responsive web
	$meta_viewport = array(
		'#type' => 'html_tag',
		'#tag' => 'meta',
		'#attributes' => array(
			'content' =>  'initial-scale=1.0, width=device-width',
			'name' => 'viewport',
		),
	);
  drupal_add_html_head($meta_viewport, 'meta_viewport');

  // globalsign domain verification meta
  $meta_globalsign_domain_verification = array(
		'#type' => 'html_tag',
		'#tag' => 'meta',
		'#attributes' => array(
			'content' =>  'jWUMrdTC0yyEo-WRh7KwWE1x4bjogM-RFYNZp6ZIbL',
			'name' => 'globalsign-domain-verification',
		),
	);
  drupal_add_html_head($meta_globalsign_domain_verification, 'meta_globalsign_domain_verification');

  $vars['environment'] = variable_get('environment', 'dev');

  // PAGE FORMATS
  // if is body, print just the contents of the body, without anything else (to use in async calls that also need the wrapping)
	$vars['is_format_body'] = bcnencomu_is_format('body');
	// if is async, print just the content, without anything else (pure data to use in async calls)
	$vars['is_format_ajax'] = bcnencomu_is_format('async');
	// if is oasis, print just the content and also styles (<head>) and scripts (useful for an overlay showing just the content but with styles)
	$vars['is_format_oasis'] = bcnencomu_is_format('oasis');
}

function bcnencomu_is_format($format){
	return (arg(0) == $format || (isset($_GET[$format]) && $_GET[$format] == '1'));
}

function bcnencomu_preprocess_page(&$vars, $hook) {
	$header = drupal_get_http_header("status");
	if($header == "404 Not Found" || $header == "403 Forbidden" || $header == "500 Internal server error") {
	   $vars['error']['info'] = t($header);
	   $vars['theme_hook_suggestions'][] = 'page__error';
	}

	if (isset($vars['node_title'])) {
		$vars['title'] = $vars['node_title'];
	}

	$vars['is_format_ajax'] = bcnencomu_is_format('async');
	$vars['is_format_oasis'] = bcnencomu_is_format('oasis');

	// home page
    if ($vars['is_front']){
        // is there an agenda
        if (isset($vars['page']['content_bottom']['views_highlighted_agenda-agenda_block'])){
            $vars['classes_array'][] = 'has-agenda';
        }
    }

	// Adding a class to #page in wireframe mode
	if (theme_get_setting('wireframe_mode')) {
		$vars['classes_array'][] = 'wireframe-mode';
	}

	// Adding classes wether #navigation is here or not
	if (!empty($vars['main_menu']) or !empty($vars['sub_menu'])) {
		$vars['classes_array'][] = 'with-navigation';
	}

    // Adding class if is there a sidebar first
    if (!empty($vars['page']['sidebar_first'])) {
        $vars['classes_array'][] = 'with-sidebar';
    }

	// must show title
	$vars['must_show_title'] = FALSE;
	if ((arg(0) == 'node' && arg(1) == 'add')){
		$vars['must_show_title'] = TRUE;
	}

	// taxonomy page
	if (arg(0) == 'taxonomy' && arg(1) == 'term' && is_numeric(arg(2))) {
		$vars['page']['content']['system_main']['nodes']['#prefix'] = '<div class="term-nodes">';
        $vars['page']['content']['system_main']['nodes']['#suffix'] = '</div>';
        // relatem el canvi page class
        if (arg(2) == RELATEM_CANVI_TID){
          $vars['classes_array'][] = 'page-relatem-canvi';
        }
        // internacional page class
        if (arg(2) == INTERNACIONAL_TID){
          $vars['classes_array'][] = 'page-internacional';
        }
	}

  // calendar page
  if (arg(0) == 'node' && arg(1) == CALENDAR_NID) {
    $vars['classes_array'][] = 'calendar-page';
  }

  // en comu map page
  if (arg(0) == 'node' && arg(1) == ENCOMUMAP_NID) {
    $vars['classes_array'][] = 'encomu-map-page';
  }

  // page without header blocks
  if (empty($vars['page']['header'])){
    $vars['classes_array'][] = 'page-without-navigation';
  }

  // en comu form page
  if (arg(0) == 'node' && arg(1) == ENCOMU_FORM_NID) {
    unset($vars['logo']);
  }

  // cronograma Qui som page
  if (arg(0) == 'node' && arg(1) == CRONOGRAMA_NID) {
    $vars['classes_array'][] = 'cronograma-page';
    $vars['page']['sidebar_first'] = FALSE;
  }

  // mapa del canvi
    if (_is_mapa_del_canvi_url()){
        $vars['classes_array'][] = 'mapa-del-canvi';
    }
}

function bcnencomu_preprocess_region(&$vars) {
  $vars['is_format_ajax'] = bcnencomu_is_format('async');
	$vars['is_format_oasis'] = bcnencomu_is_format('oasis');
}

function bcnencomu_preprocess_search_result(&$vars){
	$node_obj = $vars['result']['node'];

}

function _is_mapa_del_canvi_url(){
    $currentAlias = gh_get_current_alias();
    return (!empty($currentAlias) && (in_array($currentAlias[0], array('mapa-del-canvi', 'mapa-del-cambio'))));
}

function bcnencomu_preprocess_node(&$vars) {
	$node_obj = $vars['elements']['#node'];

	// Add a striping class.
	$vars['classes_array'][] = 'node-' . $vars['zebra'];

	// Add view mode class (if not teaser, because it already has it)
	if ($vars['view_mode'] != 'teaser') $vars['classes_array'][] = 'node-' . $vars['view_mode'];

	// mapa del canvi
    $vars['is_mapa_del_canvi'] = _is_mapa_del_canvi_url();

    // blog
    $vars['is_blog'] = ($node_obj->nid == 5);

	// entity title
    if ($vars['view_mode'] == 'full') {
        if ($node_obj->nid == 29 || $node_obj->nid == 3 || $vars['is_blog'] || $vars['is_mapa_del_canvi']) { // home, calendar, blog, mapa del canvi
            unset($vars['title']);
        } else {
            $entity_title = field_get_items('node', $node_obj, 'title_field');
            if (isset($entity_title[0]['safe_value'])) {
                $vars['title'] = $entity_title[0]['safe_value'];
            }
        }
    }

	// body and summary
	$body = field_get_items('node', $node_obj, 'body');
	if (isset($body[0]['safe_value'])){
		$vars['node_body_html'] = $body[0]['safe_value'];
		$summary = $body[0]['safe_value'];
		if (isset($body[0]['safe_summary']) && $body[0]['safe_summary'] != ''){
			$summary = $body[0]['safe_summary'];
		}
		$vars['node_body_summary_html'] = gh_truncate($summary, 160);
	}

	// default image styles: teaser and full
  $image = field_get_items('node', $node_obj, 'field_image'); // single image
	$images = field_get_items('node', $node_obj, 'field_images'); // multiple images
  if (isset($image[0]['uri'])){
    $teaser_uri = $image[0]['uri'];
  }else if (isset($images[0]['uri'])){
    $teaser_uri = $images[0]['uri'];
  }
	if ($vars['view_mode'] == 'teaser'){
    if (isset($teaser_uri)){
      $teaser_style = 'one_fourth';
      $vars['classes_array'][] = 'with-image';
      $vars['teaser_image'] = theme('image_style', array('path' => $teaser_uri, 'style_name' => $teaser_style));
    }
  }else if ($vars['view_mode'] == 'slider'){
    if (isset($teaser_uri)){
      $teaser_style = 'slider_home';
      $vars['teaser_image'] = theme('image_style', array('path' => $teaser_uri, 'style_name' => $teaser_style));
    }
  }else if ($vars['view_mode'] == 'highlighted'){
    if (isset($teaser_uri)){
      $vars['classes_array'][] = 'with-image';
      $vars['teaser_image'] = theme('image', array('path' => $teaser_uri));
    }
	}else if ($vars['view_mode'] == 'full'){
		$gallery_style = 'gallery';
		$zoomable = TRUE;
		$show_thumbnails = TRUE;
		switch ($vars['type']) {
			case 'photo_album':
				$gallery_style = 'album_photo';
				//$show_thumbnails = TRUE;
				break;
		}
		$image_gallery = bcnencomu_render_image_gallery($images, $gallery_style, $show_thumbnails, $zoomable);
		if ($image_gallery !== FALSE) $vars['image_gallery'] = $image_gallery;
	}

  // share links
  if ($vars['view_mode'] == 'full' && !$vars['is_blog']){
    $vars['share_links'] = bcnencomu_render_share_links($node_obj->nid);
  }

	// other type specific fields
	switch ($vars['type']) {
		case 'page': /********** PAGE **********/
			if ($vars['view_mode'] == 'full'){
        // Candidacies pages
        if (in_array($node_obj->nid, array(CANDIDACY_HEAD_NID, CANDIDACY_COUNCIL_NID, CANDIDACY_COUNCIL_JULY_NID))){
          $vars['theme_hook_suggestions'][] = 'node__candidacies';
          $vars['classes_array'][] = 'node-page-candidacies';
          if ($node_obj->nid == CANDIDACY_HEAD_NID){
            // head
            $vars['candidacies_list'] = views_embed_view('candidacies', 'block');
          }else if ($node_obj->nid == CANDIDACY_COUNCIL_NID){
            // council March 2015
            $vars['candidacies_list'] = views_embed_view('candidacies', 'block_1');
          }else if ($node_obj->nid == CANDIDACY_COUNCIL_JULY_NID){
            // council July 2015
            $vars['candidacies_list'] = views_embed_view('candidacies2', 'block');
          }
        }
      }
			break;
		case 'post': /********** BLOG POST **********/
    case 'press': /********** PRESS **********/
      $vars['theme_hook_suggestions'][] = 'node__article';
      $vars['classes_array'][] = 'node-post-like';

			// date
		  $vars['date'] = gh_get_date_array($node_obj->created, 'day', TRUE);

      // category
      $category_field = 'field_post_category';
      if ($vars['type'] == 'press'){
        $category_field = 'field_press_category';
      }
      $category = field_view_field('node', $node_obj, $category_field, array('label' => 'hidden'));
      $vars['category'] = render($category);

      // hashtag
      $hashtag = field_get_items('node', $node_obj,'field_hashtag');
      if (isset($hashtag[0]['safe_value'])){
        $vars['hashtag'] = $hashtag[0]['safe_value'];
      }

		  if ($vars['view_mode'] == 'full'){
        // tags
        $tags = field_view_field('node', $node_obj, 'field_tags', array('label' => 'hidden'));
        $vars['tags'] = render($tags);

		  	// node navigation
		  	//$node_nav = bcnencomu_render_node_navigation($node_obj->nid);
		  	//if ($node_nav !== FALSE) $vars['node_nav'] = $node_nav;

		  	// lead
		  	$lead = field_get_items('node', $node_obj, 'field_lead');
		  	if (isset($lead[0]['safe_value'])){
                $vars['lead'] = $lead[0]['safe_value'];
            }
		  }
			break;
    case 'banner':
      $link = field_get_items('node', $node_obj,'field_link');
      $vars['external_link'] = FALSE;
      if (isset($link[0]['attributes']['target'])){
        $vars['external_link'] = ($link[0]['attributes']['target'] == '_blank');
      }
      $hide_button = field_get_items('node', $node_obj,'field_hide_button');
      $vars['hide_button'] = ($hide_button[0]['value'] == '1');
      break;
		case 'video': /********** VIDEO **********/
			// youtube
			$youtube_video = field_get_items('node', $node_obj,'field_youtube_url');
			if (isset($youtube_video[0]['safe_value'])){
				$vars['youtube_uri'] = $youtube_video[0]['safe_value'];
			}
			// embed
			$embed_video = field_get_items('node', $node_obj,'field_embed');
			if (isset($embed_video[0]['safe_value'])){
				$vars['video_html'] = $embed_video[0]['safe_value'];
			}
			break;
    case 'candidacy_person': /********** CANDIDACY PERSON **********/
      if ($vars['view_mode'] == 'teaser'){
        // photo
        $photo = field_get_items('node', $node_obj, 'field_candidacy_photo');
        if (isset($photo[0]['uri'])){
          $vars['photo'] = theme('image_style', array('path' => $photo[0]['uri'], 'style_name' => 'candidacy_person'));
        }
      }else{
        // type
        $type = field_get_items('node', $node_obj, 'field_candidacy_type');
        if (isset($type[0]['tid'])){
          $type_tid = $type[0]['tid'];
        	if ($type_tid == 63){
        		$list_nid = CANDIDACY_HEAD_NID; // Head
        	}else{
        		// july first date: the starting date of the July 2015 council candidacy
        		$july2015_candidacy_date = mktime(0,0,0,7,1,2015);
            // types for the september internal candidacies (coordination, which englobes management nd representatives, and guarantees)
            $coordination_sept2015_tids = array(460, 461);
            $guarantees_sept2015_tid = 462;
        		if ($node_obj->created < $july2015_candidacy_date){
        			$list_nid = CANDIDACY_COUNCIL_NID; // Council March 2015
        		}else{
              if ($type_tid == $guarantees_sept2015_tid){
                $list_nid = CANDIDACY_GUARANTEES2015_NID; // Guarantees September 2015
              }else if (in_array($type_tid, $coordination_sept2015_tids)){
                $list_nid = CANDIDACY_COORDINATION2015_NID; // Coordination September 2015
              }else{
                $list_nid = CANDIDACY_COUNCIL_JULY_NID; // Council July 2015
              }
            }
        	}
        	if (isset($list_nid)) $vars['list_uri'] = gh_get_node_path_alias($list_nid);
        }
      }
      break;
    case 'eix_tematic':
      // back to list link
      $espai_nids = array(
        547 => ESPAIS_EIXOS_NID,
        578 => ESPAIS_GRUPS_NID,
        549 => ESPAIS_COMIS_NID,
      );
      $espai_type = field_get_items('node', $node_obj, 'field_space_bcomu');
      if (!empty($espai_type)){
        $espai_type_tid = $espai_type[0]['tid'];
        $vars['back_link'] = l(t("Back to the list"), 'node/' . $espai_nids[$espai_type_tid], array('attributes' => array('data-action' => 'go-back')));
      }
      $web_field = field_get_items('node', $node_obj, 'field_grup_web');
      if (!empty($web_field)){
        $vars['web_link'] = l(t("Visit our web"), $web_field[0]['url'], array('attributes' => array('rel' => 'external')));
      }
      $facebook_field = field_get_items('node', $node_obj, 'field_grup_facebook');
      if (!empty($facebook_field)){
        $vars['facebook_link'] = l(t("Visit our Facebook page"), $facebook_field[0]['url'], array('attributes' => array('rel' => 'external')));
      }
      $twitter_field = field_get_items('node', $node_obj, 'field_grup_twitter');
      if (!empty($twitter_field)){
        $vars['twitter_link'] = l(t("Read our Twitter"), 'https://twitter.com/' . $twitter_field[0]['safe_value'], array('attributes' => array('rel' => 'external')));
      }
      break;
    case 'office': /********** OFFICE (NOMENAMENT) **********/
      if ($vars['view_mode'] == 'full'){
        $destination = $node_obj->field_office_destination[LANGUAGE_NONE][0]['tid'];
        if ($destination == 431){ // destination: BComu
          $vars['link_to_equip_bcomu'] = l('< ' . t("Back to the team"),'node/' . EQUIP_BCOMU_NID, ['attributes' => ['data-action' => 'back']]);
        }
      }
      break;
	}
}

function bcnencomu_preprocess_comment(&$vars) {
	$comment = $vars['elements']['#comment'];

	$vars['picture'] = theme('user_picture', array('account' => $comment));

  if ($comment->depth > 1) {
    unset($vars['content']['links']['comment']['#links']['comment-reply']);
  }
}

function bcnencomu_preprocess_taxonomy_term(&$vars) {
  // candidacies council district
  if ($vars['vid'] == 6){
    $vars['list_uri'] = gh_get_node_path_alias(CANDIDACY_COUNCIL_NID);
  }
}

function bcnencomu_preprocess_block(&$vars, $hook) {
	// Add a striping class.
	//$vars['classes_array'][] = 'block-' . $vars['zebra'];

	// is this a navigation block
	$vars['is_navigation'] = ($vars['block']->module == 'menu' || in_array($vars['block']->delta, array('main-menu')));
}

/*
 * Implements hook_block_view_alter
 */
function bcnencomu_block_view_alter(&$data, $block) {

}

/**
 * Return a themed breadcrumb trail.
 *
 * @param $breadcrumb
 *   An array containing the breadcrumb links.
 * @return
 *   A string containing the breadcrumb output.
 */
function bcnencomu_breadcrumb($vars) {
	$breadcrumb = $vars['breadcrumb'];  // Determine if we are to display the breadcrumb.
	$show_breadcrumb = theme_get_setting('bcnencomu_breadcrumb');
	if ($show_breadcrumb == 'yes' || ($show_breadcrumb == 'admin' && arg(0) == 'admin')) {

		// Optionally get rid of the homepage link.
		$show_breadcrumb_home = theme_get_setting('bcnencomu_breadcrumb_home');
		if (!$show_breadcrumb_home) {
			array_shift($breadcrumb);
		}
		// Return the breadcrumb with separators.
		if (!empty($breadcrumb)) {
			$breadcrumb_separator = theme_get_setting('bcnencomu_breadcrumb_separator');
			$trailing_separator = $title = '';
			if (theme_get_setting('bcnencomu_breadcrumb_title')) {
				$item = menu_get_item();
				if (!empty($item['tab_parent'])) {
					// If we are on a non-default tab, use the tab's title.
					$title = check_plain($item['title']);
				}
				else {
					$title = drupal_get_title();
				}
				if ($title) {
					$trailing_separator = $breadcrumb_separator;
				}
			}
			elseif (theme_get_setting('bcnencomu_breadcrumb_trailing')) {
				$trailing_separator = $breadcrumb_separator;
			}
			// Provide a navigational heading to give context for breadcrumb links to
			// screen-reader users. Make the heading invisible with .element-invisible.
			$heading = '<h2 class="element-invisible sure">' . t('You are here') . '</h2>';


			return $heading . '<div class="breadcrumb">' . implode($breadcrumb_separator, $breadcrumb) . $trailing_separator . $title . '</div>';
		}
	}
	// Otherwise, return an empty string.
	return '';
}

/*
 *   Converts a string to a suitable html ID attribute.
 *
 *    http://www.w3.org/TR/html4/struct/global.html#h-7.5.2 specifies what makes a
 *    valid ID attribute in HTML. This function:
 *
 *   - Ensure an ID starts with an alpha character by optionally adding an 'n'.
 *   - Replaces any character except A-Z, numbers, and underscores with dashes.
 *   - Converts entire string to lowercase.
 *
 *   @param $string
 *     The string
 *   @return
 *     The converted string
 */
function bcnencomu_id_safe($string) {
	// Replace with dashes anything that isn't A-Z, numbers, dashes, or underscores.
	$string = strtolower(preg_replace('/[^a-zA-Z0-9_-]+/', '-', $string));
	// If the first character is not a-z, add 'n' in front.
	if (!ctype_lower($string{0})) { // Don't use ctype_alpha since its locale aware.
		$string = 'id' . $string;
	}
	return $string;
}



/**
 * Generate the HTML output for a menu link and submenu.
 *
 * @param $vars
 *   An associative array containing:
 *   - element: Structured array data for a menu link.
 *
 * @return
 *   A themed HTML string.
 *
 * @ingroup themeable
 */
function bcnencomu_menu_link(array $vars) {
	$element = $vars['element'];

	$sub_menu = '';

	// Adding a class depending on the TITLE of the link (not constant)
	$element['#attributes']['class'][] = bcnencomu_id_safe($element['#title']);
	// Adding a class depending on the ID of the link (constant)
	if (isset($element['#original_link']['mlid']) && !empty($element['#original_link']['mlid'])) {
		$element['#attributes']['class'][] = 'mid-' . $element['#original_link']['mlid'];

		// changing some link
		/*if ($element['#original_link']['mlid'] == 796){
			$element['#localized_options']['attributes']['rel'] = 'external';
		}*/
	}

	if ($element['#below']) {
		$sub_menu = drupal_render($element['#below']);
	}
	$output = l($element['#title'], $element['#href'], $element['#localized_options']);

	return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

/**
 * Override or insert variables into theme_menu_local_task().
 */
function bcnencomu_preprocess_menu_local_task(&$vars) {
	$link =& $vars['element']['#link'];

	// If the link does not contain HTML already, check_plain() it now.
	// After we set 'html'=TRUE the link will not be sanitized by l().
	if (empty($link['localized_options']['html'])) {
		$link['title'] = check_plain($link['title']);
	}
	$link['localized_options']['html'] = TRUE;
	$link['title'] = '<span class="tab">' . $link['title'] . '</span>';
}

/*
 * Duplicate of theme_menu_local_tasks() but adds clearfix to tabs.
 */
function bcnencomu_menu_local_tasks(&$vars) {
	$output = '';

	if (!empty($vars['primary'])) {
		$vars['primary']['#prefix'] = '<h2 class="element-invisible">' . t('Primary tabs') . '</h2>';
		$vars['primary']['#prefix'] .= '<ul class="tabs primary clearfix">';
		$vars['primary']['#suffix'] = '</ul>';
		$output .= drupal_render($vars['primary']);
	}
	if (!empty($vars['secondary'])) {
		$vars['secondary']['#prefix'] = '<h2 class="element-invisible">' . t('Secondary tabs') . '</h2>';
		$vars['secondary']['#prefix'] .= '<ul class="tabs secondary clearfix">';
		$vars['secondary']['#suffix'] = '</ul>';
		$output .= drupal_render($vars['secondary']);
	}

	return $output;
}

// disable annoying grippie in textareas
function bcnencomu_textarea($vars) {
	$element = $vars['element'];
	$element['#attributes']['name'] = $element['#name'];
	$element['#attributes']['id'] = $element['#id'];
	$element['#attributes']['cols'] = $element['#cols'];
	$element['#attributes']['rows'] = $element['#rows'];
	_form_set_class($element, array('form-textarea'));

	$wrapper_attributes = array(
		'class' => array('form-textarea-wrapper'),
	);

	// Add resizable behavior.
	if (!empty($element['#resizable'])) {
		$wrapper_attributes['class'][] = 'resizable';
	}

	$output = '<div' . drupal_attributes($wrapper_attributes) . '>';
	$output .= '<textarea' . drupal_attributes($element['#attributes']) . '>' . check_plain($element['#value']) . '</textarea>';
	$output .= '</div>';
	return $output;
}
