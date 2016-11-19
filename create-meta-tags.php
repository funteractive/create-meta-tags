<?php
/**
 * Plugin Name:     Create Meta Tags
 * Plugin URI:      https://github.com/funteractive/wp-meta-tags
 * Description:     Output meta description, keywords, opg, twitter cards on your site.
 * Author:          Keisuke Imura
 * Author URI:      https://funteractive.co.jp/
 * Text Domain:     create-meta-tags
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         CreateMetaTags
 */

if (!defined('ABSPATH'))
  exit();

define('WP_META_TAGS_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('WP_META_TAGS_PLUGIN_URL', plugin_dir_url(__FILE__));

require_once plugin_dir_path(__FILE__) . 'CreateMetaTags/AutoLoader.php';
$auto_loader = new CreateMetaTags\AutoLoader();
$auto_loader->registerDir(dirname(__FILE__) . '/wp-actions');
$auto_loader->registerDir(dirname(__FILE__) . '/controllers');
$auto_loader->registerDir(dirname(__FILE__) . '/models');
$auto_loader->register();

$actions = new CreateMetaTags\WPActions();
$actions->init();
