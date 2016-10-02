<?php
/**
 * Plugin Name: Post Slider WD
 * Plugin URI: https://web-dorado.com/products/wordpress-post-slider-plugin.html
 * Description: Post Slider WD is designed to show off your selected posts of your website using in a slider. 
 * Version: 1.0.16
 * Author: WebDorado
 * Author URI: https://web-dorado.com/
 * License: GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

define('WD_PS_DIR', WP_PLUGIN_DIR . "/" . plugin_basename(dirname(__FILE__)));
define('WD_PS_URL', plugins_url(plugin_basename(dirname(__FILE__))));
define('WD_WDPS_NAME', plugin_basename(dirname(__FILE__)));
$upload_dir = wp_upload_dir();

$WD_PS_UPLOAD_DIR = str_replace(ABSPATH, '', $upload_dir['basedir']) . '/' . WD_WDPS_NAME;

// Plugin menu.
function wdps_options_panel() {
  add_menu_page('Post Slider WD', 'Post Slider WD', 'manage_options', 'sliders_wdps', 'wdps_sliders', WD_PS_URL . '/images/wd_slider.png');

  $sliders_page = add_submenu_page('sliders_wdps', __('Sliders','wdps_back'), __('Sliders','wdps_back'), 'manage_options', 'sliders_wdps', 'wdps_sliders');
  add_action('admin_print_styles-' . $sliders_page, 'wdps_styles');
  add_action('admin_print_scripts-' . $sliders_page, 'wdps_scripts');
  
  add_submenu_page('sliders_wdps', __('Get Pro', 'wdps_back'), __('Get Pro', 'wdps_back'), 'manage_options', 'licensing_wdps', 'wdps_licensing');
  add_submenu_page('sliders_wdps', __('Featured Plugins','wdps_back'), __('Featured Plugins','wdps_back'), 'manage_options', 'featured_plugins_wdps', 'wdps_featured');
  add_submenu_page('sliders_wdps', __('Featured Themes','wdps_back'), __('Featured Themes','wdps_back'), 'manage_options', 'featured_themes_wdps', 'wdps_featured_themes'); 
  $uninstall_page = add_submenu_page('sliders_wdps', __('Uninstall','wdps_back'), __('Uninstall','wdps_back'), 'manage_options', 'uninstall_wdps', 'wdps_sliders');
  add_action('admin_print_styles-' . $uninstall_page, 'wdps_styles');
  add_action('admin_print_scripts-' . $uninstall_page, 'wdps_scripts');
}
add_action('admin_menu', 'wdps_options_panel');

function wdps_sliders() {
   if (function_exists('current_user_can')) {
    if (!current_user_can('manage_options')) {
      die('Access Denied');
    }
  }
  else {
    die('Access Denied');
  }
  require_once(WD_PS_DIR . '/framework/WDW_PS_Library.php');
  $page = WDW_PS_Library::get('page');

  if (($page != '') && (($page == 'sliders_wdps') || ($page == 'uninstall_wdps') || ($page == 'WDPSShortcode'))) {
    require_once(WD_PS_DIR . '/admin/controllers/WDPSController' . (($page == 'WDPSShortcode') ? $page : ucfirst(strtolower($page))) . '.php');
    $controller_class = 'WDPSController' . ucfirst(strtolower($page));
    $controller = new $controller_class();
    $controller->execute();
  }
}

function wdps_licensing() {
  if (function_exists('current_user_can')) {
    if (!current_user_can('manage_options')) {
      die('Access Denied');
    }
  }
  else {
    die('Access Denied');
  }
  wp_register_style('wdps_licensing', WD_PS_URL . '/licensing/style.css', array(), get_option("wdps_version"));
  wp_print_styles('wdps_licensing');
  require_once(WD_PS_DIR . '/licensing/licensing.php');
}

function wdps_featured() {
  if (function_exists('current_user_can')) {
    if (!current_user_can('manage_options')) {
      die('Access Denied');
    }
  }
  else {
    die('Access Denied');
  }
  require_once(WD_PS_DIR . '/featured/featured.php');
  wp_register_style('wdps_featured', WD_PS_URL . '/featured/style.css', array(), get_option("wdps_version"));
  wp_print_styles('wdps_featured');
  spider_featured('post-slider');
}

function wdps_featured_themes() {
  if (function_exists('current_user_can')) {
    if (!current_user_can('manage_options')) {
      die('Access Denied');
    }
  }
  else {
    die('Access Denied');
  }
  require_once(WD_PS_DIR . '/featured/featured_themes.php');
  wp_register_style('wdps_featured_themes', WD_PS_URL . '/featured/themes_style.css', array(), get_option("wdps_version"));
  wp_print_styles('wdps_featured_themes');
  spider_featured_themes();
}

function wdps_frontend() {
  require_once(WD_PS_DIR . '/framework/WDW_PS_Library.php');
  $page = WDW_PS_Library::get('action');
  if (($page != '') && ($page == 'WDPSShare')) {
    require_once(WD_PS_DIR . '/frontend/controllers/WDPSController' . ucfirst($page) . '.php');
    $controller_class = 'WDPSController' . ucfirst($page);
    $controller = new $controller_class();
    $controller->execute();
  }
}

function wdps_ajax() {
  if (function_exists('current_user_can')) {
    if (!current_user_can('manage_options')) {
      die('Access Denied');
    }
  }
  else {
    die('Access Denied');
  }
  require_once(WD_PS_DIR . '/framework/WDW_PS_Library.php');
  $page = WDW_PS_Library::get('action');
  if ($page != '' && (($page == 'WDPSShortcode') || ($page == 'WDPSPosts') )) {
    require_once(WD_PS_DIR . '/admin/controllers/WDPSController' . ucfirst($page) . '.php');
    $controller_class = 'WDPSController' . ucfirst($page);
    $controller = new $controller_class();
    $controller->execute();
  }
}

function wdps_shortcode($params) {
  $params = shortcode_atts(array('id' => 0), $params);
  ob_start();
  wdps_front_end($params['id']);
  // return str_replace(array("\r\n", "\n", "\r"), '', ob_get_clean());
  return ob_get_clean();
}
add_shortcode('wdps', 'wdps_shortcode');

function wdp_slider($id) {
  echo wdps_front_end($id);
}

$wdps = 0;
function wdps_front_end($id) {
  require_once(WD_PS_DIR . '/frontend/controllers/WDPSControllerSlider.php');
  $controller = new WDPSControllerSlider();
  global $wdps;
  $controller->execute($id, 1, $wdps);
  $wdps++;
  return;
}

function wdps_media_button($context) {
  global $pagenow;
  if (in_array($pagenow, array('post.php', 'page.php', 'post-new.php', 'post-edit.php'))) {
    $context .= '
      <a onclick="tb_click.call(this); wdps_thickDims(); return false;" href="' . add_query_arg(array('action' => 'WDPSShortcode', 'TB_iframe' => '1'), admin_url('admin-ajax.php')) . '" class="wdps_thickbox button" style="padding-left: 0.4em;" title="Select post slider">
        <span class="wp-media-buttons-icon wdps_media_button_icon" style="vertical-align: text-bottom; background: url(' . WD_PS_URL . '/images/wd_slider.png) no-repeat scroll left top rgba(0, 0, 0, 0);"></span>
        Add Post Slider WD
      </a>';
  }
  return $context;
}
add_filter('media_buttons_context', 'wdps_media_button');
// Add the Slider button to editor.
add_action('wp_ajax_WDPSShortcode', 'wdps_ajax');
add_action('wp_ajax_WDPSPosts', 'wdps_ajax');

function wdps_admin_ajax() {
  ?>
  <script>
    var wdps_thickDims, wdps_tbWidth, wdps_tbHeight;
    wdps_tbWidth = 400;
    wdps_tbHeight = 200;
    wdps_thickDims = function() {
      var tbWindow = jQuery('#TB_window'), H = jQuery(window).height(), W = jQuery(window).width(), w, h;
      w = (wdps_tbWidth && wdps_tbWidth < W - 90) ? wdps_tbWidth : W - 40;
      h = (wdps_tbHeight && wdps_tbHeight < H - 60) ? wdps_tbHeight : H - 40;
      if (tbWindow.size()) {
        tbWindow.width(w).height(h);
        jQuery('#TB_iframeContent').width(w).height(h - 27);
        tbWindow.css({'margin-left': '-' + parseInt((w / 2),10) + 'px'});
        if (typeof document.body.style.maxWidth != 'undefined') {
          tbWindow.css({'top':(H-h)/2,'margin-top':'0'});
        }
      }
    };
  </script>
  <?php
}
add_action('admin_head', 'wdps_admin_ajax');

// Add images to Slider.
add_action('wp_ajax_wdps_UploadHandler', 'wdps_UploadHandler');
add_action('wp_ajax_postaddImage', 'wdps_filemanager_ajax');

// Upload.
function wdps_UploadHandler() {
  require_once(WD_PS_DIR . '/filemanager/UploadHandler.php');
}

function wdps_filemanager_ajax() { 
  if (function_exists('current_user_can')) {
    if (!current_user_can('manage_options')) {
      die('Access Denied');
    }
  }
  else {
    die('Access Denied');
  }
  global $wpdb;
  require_once(WD_PS_DIR . '/framework/WDW_PS_Library.php');
  $page = WDW_PS_Library::get('action');
  if (($page != '') && (($page == 'postaddImage') || ($page == 'addMusic'))) {
    require_once(WD_PS_DIR . '/filemanager/controller.php');
    $controller_class = 'FilemanagerController';
    $controller = new $controller_class();
    $controller->execute();
  }
}
// Slider Widget.
if (class_exists('WP_Widget')) {
  require_once(WD_PS_DIR . '/admin/controllers/WDPSControllerWidgetSlideshow.php');
  add_action('widgets_init', create_function('', 'return register_widget("WDPSControllerWidgetSlideshow");'));
}

// Activate plugin.
function wdps_activate() {
  wdps_install();
}
register_activation_hook(__FILE__, 'wdps_activate');

function wdps_install() {
  $version = get_option("wdps_version");
  $new_version = '1.0.16';
  if ($version && version_compare($version, $new_version, '<')) {
    require_once WD_PS_DIR . "/sliders-update.php";
    wdps_update($version);
    update_option("wdps_version", $new_version);
  }
  elseif (!$version) {
    require_once WD_PS_DIR . "/sliders-insert.php";
    wdps_insert();
    add_option("wdps_theme_version", '1.0.0', '', 'no');
    add_option("wdps_version", $new_version, '', 'no');
    add_option("wdps_version_1.0.0", 1, '', 'no');
  }
}
if (!isset($_GET['action']) || $_GET['action'] != 'deactivate') {
  add_action('admin_init', 'wdps_install');
}

// Plugin styles.
function wdps_styles() {
  $version = get_option("wdps_version");
  wp_admin_css('thickbox');
  wp_enqueue_style('wdps_tables', WD_PS_URL . '/css/wdps_tables.css', array(), $version);
  wp_enqueue_style('wdps_tables_640', WD_PS_URL . '/css/wdps_tables_640.css', array(), $version);
  wp_enqueue_style('wdps_tables_320', WD_PS_URL . '/css/wdps_tables_320.css', array(), $version);
  require_once(WD_PS_DIR . '/framework/WDW_PS_Library.php');
  $google_fonts = WDW_PS_Library::get_google_fonts();
  for ($i = 0; $i < count($google_fonts); $i = $i + 150) {
    $fonts = array_slice($google_fonts, $i, 150);
    $query = implode("|", str_replace(' ', '+', $fonts));
    $url = 'https://fonts.googleapis.com/css?family=' . $query . '&subset=greek,latin,greek-ext,vietnamese,cyrillic-ext,latin-ext,cyrillic';
    wp_enqueue_style('wdps_googlefonts' . $i, $url, null, null);
  }
}
// Plugin scripts.
function wdps_scripts() {
  $version = get_option("wdps_version");
  wp_enqueue_media();
  wp_enqueue_script('thickbox');
  wp_enqueue_script('jquery');
  wp_enqueue_script('jquery-ui-tooltip');
  wp_enqueue_script('jquery-ui-sortable');
  wp_enqueue_script('jquery-ui-draggable');
  wp_enqueue_script('wdps_admin', WD_PS_URL . '/js/wdps.js', array(), $version);
  wp_localize_script('wdps_admin', 'wdps_objectL10B', array(
    'saved'  => __('Items Succesfully Saved.', 'wdps_back'),
    'wdps_changes_mode_saved'  => __('Changes made in this table should be saved.', 'wdps_back'),
    'show_order'  => __('Show order column', 'wdps_back'),
    'wdps_select_image'  => __('You must select an image file.', 'wdps_back'),
    'wdps_select_audio'  => __('You must select an audio file.', 'wdps_back'),
    'text_layer'  => __('Add Text Layer', 'wdps_back'),
    'wdps_redirection_link'  => __('You can set a redirection link, so that the user will get to the mentioned location upon hitting the slide.<br />Use http:// and https:// for external links.', 'wdps_back'),
    'link_slide'  => __('Link the slide to:', 'wdps_back'),
    'published'  => __('Published:', 'wdps_back'),
    'add_post'  => __('Add Post', 'wdps_back'),
    'edit_post'  => __('Edit Post', 'wdps_back'),
    'add_hotspot'  => __('Add Hotspot Layer', 'wdps_back'),
    'add_social_buttons'  => __('Add Social Button Layer', 'wdps_back'),
    'none'  => __('None', 'wdps_back'),
    'bounce'  => __('Bounce', 'wdps_back'),
    'flash'  => __('Flash', 'wdps_back'),
    'pulse'  => __('Pulse', 'wdps_back'),
    'rubberBand'  => __('RubberBand', 'wdps_back'),
    'shake'  => __('Shake', 'wdps_back'),
    'swing'  => __('Swing', 'wdps_back'),
    'tada'  => __('Tada', 'wdps_back'),
    'wobble'  => __('Wobble', 'wdps_back'),
    'hinge'  => __('Hinge', 'wdps_back'),
    'lightSpeedIn'  => __('LightSpeedIn', 'wdps_back'),
    'rollIn'  => __('RollIn', 'wdps_back'),
    'bounceIn'  => __('BounceIn', 'wdps_back'),
    'bounceInDown'  => __('BounceInDown', 'wdps_back'),
    'bounceInLeft'  => __('BounceInLeft', 'wdps_back'),
    'bounceInRight'  => __('BounceInRight', 'wdps_back'),
    'bounceInUp'  => __('BounceInUp', 'wdps_back'),
    'fadeIn'  => __('FadeIn', 'wdps_back'),
    'fadeInDown'  => __('FadeInDown', 'wdps_back'),
    'fadeInDownBig'  => __('FadeInDownBig', 'wdps_back'),
    'fadeInLeft'  => __('FadeInLeft', 'wdps_back'),
    'fadeInLeftBig'  => __('FadeInLeftBig', 'wdps_back'),
    'fadeInRight'  => __('FadeInRight', 'wdps_back'),
    'fadeInRightBig'  => __('FadeInRightBig', 'wdps_back'),
    'fadeInUp'  => __('FadeInUp', 'wdps_back'),
    'fadeInUpBig'  => __('FadeInUpBig', 'wdps_back'),
    'flip'  => __('Flip', 'wdps_back'),
    'flipInX'  => __('FlipInX', 'wdps_back'),
    'flipInY'  => __('FlipInY', 'wdps_back'),
    'rotateIn'  => __('RotateIn', 'wdps_back'),
    'rotateInDownLeft'  => __('RotateInDownLeft', 'wdps_back'),
    'rotateInDownRight'  => __('RotateInDownRight', 'wdps_back'),
    'rotateInUpLeft'  => __('RotateInUpLeft', 'wdps_back'),
    'rotateInUpRight'  => __('RotateInUpRight', 'wdps_back'),
    'zoomIn'  => __('ZoomIn', 'wdps_back'),
    'zoomInDown'  => __('ZoomInDown', 'wdps_back'),
    'zoomInLeft'  => __('ZoomInLeft', 'wdps_back'),
    'zoomInRight'  => __('ZoomInRight', 'wdps_back'),
    'zoomInUp'  => __('ZoomInUp', 'wdps_back'),
    'lighter'  => __('Lighter', 'wdps_back'),
    'normal'  => __('Normal', 'wdps_back'),
    'bold'  => __('Bold', 'wdps_back'),
    'solid'  => __('Solid', 'wdps_back'),
    'dotted'  => __('Dotted', 'wdps_back'),
    'dashed'  => __('Dashed', 'wdps_back'),
    'wdps_double'  => __('Double', 'wdps_back'),
    'groove'  => __('Groove', 'wdps_back'),
    'ridge'  => __('Ridge', 'wdps_back'),
    'inset'  => __('Inset', 'wdps_back'),
    'outset'  => __('Outset', 'wdps_back'),
    'facebook'  => __('Facebook', 'wdps_back'),
    'google_plus'  => __('Google+', 'wdps_back'),
    'twitter'  => __('Twitter', 'wdps_back'),
    'pinterest'  => __('Pinterest', 'wdps_back'),
    'tumblr'  => __('Tumblr', 'wdps_back'),
    'top'  => __('Top', 'wdps_back'),
    'bottom'  => __('Bottom', 'wdps_back'),
    'left'  => __('Left', 'wdps_back'),
    'right'  => __('Right', 'wdps_back'),
    'wdps_drag_re_order'  => __('Drag to re-order', 'wdps_back'),
    'wdps_layer_title'  => __('Layer title', 'wdps_back'),
    'wdps_delete_layer'  => __('Are you sure you want to delete this layer ?', 'wdps_back'),
    'wdps_duplicate_layer'  => __('Duplicate layer', 'wdps_back'),
    'z_index'  => __('z-index', 'wdps_back'),
    'text'  => __('Text:', 'wdps_back'),
    'sample_text'  => __('Sample text', 'wdps_back'),
    'dimensions'  => __('Dimensions:', 'wdps_back'),
    'wdps_leave_blank'  => __('Leave blank to keep the initial width and height.', 'wdps_back'),
    'wdps_edit_image'  => __('Edit Image', 'wdps_back'),
    'wdps_alt'  => __('Alt:', 'wdps_back'),
    'wdps_set_HTML_attribute_specified'  => __('Set the HTML attribute specified in the IMG tag.', 'wdps_back'),
    'wdps_link'  => __('Link:', 'wdps_back'),
    'wdps_open_new_window'  => __('Open in a new window', 'wdps_back'),
    'wdps_use_links'  => __('Use http:// and https:// for external links.', 'wdps_back'),
    'position'  => __('Position:', 'wdps_back'),
    'wdps_in_addition'  => __('In addition you can drag and drop the layer to a desired position.', 'wdps_back'),
    'published'  => __('Published:', 'wdps_back'),
    'yes'  => __('Yes', 'wdps_back'),
    'no'  => __('No', 'wdps_back'),
    'color'  => __('Color:', 'wdps_back'),
    'size'  => __('Size:', 'wdps_back'),
    'font_family'  => __('Font family:', 'wdps_back'),
    'font_weight'  => __('Font weight:', 'wdps_back'),
    'padding'  => __('Padding:', 'wdps_back'),
    'use_css_type_value'  => __('Use CSS type values.', 'wdps_back'),
    'layer_characters_div'=> __('This will limit the number of characters for post content displayed as a text layer.', 'wdps_back'),
    'background_color'  => __('Background Color:', 'wdps_back'),
    'transparent'  => __('Transparent:', 'wdps_back'),
    'wdps_value_must'  => __('Value must be between 0 to 100.', 'wdps_back'),
    'radius'  => __('Radius:', 'wdps_back'),
    'shadow'  => __('Shadow:', 'wdps_back'),
    'text_layer_character_limit'  => __('Text layer character limit:', 'wdps_back'),
    'scale'  => __('Scale:', 'wdps_back'),
    'wdps_set_width_height'  => __('Set width and height of the image.', 'wdps_back'),
    'social_button'  => __('Social button:', 'wdps_back'),
    'effect_in'  => __('Effect in:', 'wdps_back'),
    'start'  => __('Start', 'wdps_back'),
    'effect'  => __('Effect', 'wdps_back'),
    'duration'  => __('Duration', 'wdps_back'),
    'some_effects'  => __('Some effects are disabled in free version.', 'wdps_back'),
    'effect_out'  => __('Effect out:', 'wdps_back'),
    'hotspot_text_position'  => __('Hotspot text position:', 'wdps_back'),
    'hotspot_width'  => __('Hotspot Width:', 'wdps_back'),
    'hotspot_background_color'  => __('Hotspot Background Color:', 'wdps_back'),
    'hotspot_border'  => __('Hotspot Border:', 'wdps_back'),
    'hotspot_radius'  => __('Hotspot Radius:', 'wdps_back'),
    'add_image_layer'  => __('Add Image Layer', 'wdps_back'),
    'duplicate_slide'  => __('Duplicate slide', 'wdps_back'),
    'delete_slide'  => __('Delete slide', 'wdps_back'),
    'remove'  => __('Delete', 'wdps_back'),
    'border'  => __('Border:', 'wdps_back'),
    'break_word'  => __('Break-word:', 'wdps_back'),
    'hover_color'  => __('Hover color:', 'wdps_back'),
    'wdps_default'  => __('Default', 'wdps_back'),
    'google_fonts'  => __('Google fonts', 'wdps_back'),
    'duplicate_message' => __('Do you want to duplicate selected items?', 'wdps_back'),
    'delete_message' => __('Do you want to delete selected items?', 'wdps_back'),
    'disabled_free_version' => __('This functionality is disabled in free version.', 'wdps_back'),
    'remove_slide' => __('Do you want to delete slide?', 'wdps_back'),
  ));
  wp_enqueue_script('jscolor', WD_PS_URL . '/js/jscolor/jscolor.js', array(), '1.3.9');
  wp_enqueue_style('wdps_font-awesome', WD_PS_URL . '/css/font-awesome/font-awesome.css', array(), '4.6.3');
  wp_enqueue_style('wdps_effects', WD_PS_URL . '/css/wdps_effects.css', array(), $version);
  wp_enqueue_style('wdps_tooltip', WD_PS_URL . '/css/jquery-ui-1.10.3.custom.css', array(), $version);
  require_once(WD_PS_DIR . '/framework/WDW_PS_Library.php');
  wp_localize_script('wdps_admin', 'wdps_objectGGF', WDW_PS_Library::get_google_fonts());
}

function wdps_front_end_scripts() {
   global $wpdb;
  $version = get_option("wdps_version");
  $rows = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "wdpslayer ORDER BY `depth` ASC");
  $font_array = array();
  foreach ($rows as $row) {
    if (isset($row->google_fonts) && ($row->google_fonts == 1) && ($row->ffamily != "") && !in_array($row->ffamily, $font_array)) {
      $font_array[] = $row->ffamily;
	  }
  }
  $query = implode("|", $font_array);
  if ($query != '') {
    $url = 'https://fonts.googleapis.com/css?family=' . $query . '&subset=greek,latin,greek-ext,vietnamese,cyrillic-ext,latin-ext,cyrillic';
  }
  if ($query != '') {
    wp_enqueue_style('wdps_googlefonts', $url, null, null);
  }
  wp_enqueue_script('jquery');
  wp_enqueue_script('wdps_jquery_mobile', WD_PS_URL . '/js/jquery.mobile.js', array(), $version);
  wp_enqueue_style('wdps_frontend', WD_PS_URL . '/css/wdps_frontend.css', array(), $version);
  wp_enqueue_script('wdps_frontend', WD_PS_URL . '/js/wdps_frontend.js', array(), $version);
  wp_enqueue_style('wdps_effects', WD_PS_URL . '/css/wdps_effects.css', array(), $version);

  wp_enqueue_style('wdps_font-awesome', WD_PS_URL . '/css/font-awesome/font-awesome.css', array(), '4.6.3');
}
add_action('wp_enqueue_scripts', 'wdps_front_end_scripts');

// Languages localization.
function wdps_language_load() {
  load_plugin_textdomain('wdps', FALSE, basename(dirname(__FILE__)) . '/languages');
  load_plugin_textdomain('wdps_back', FALSE, basename(dirname(__FILE__)) . '/languages/backend');
}
add_action('init', 'wdps_language_load');

if (is_admin() && (!defined('DOING_AJAX') || !DOING_AJAX)) {
	include_once(WD_PS_DIR . '/sliders-notices.php');
  new WDPS_Notices();
}
?>