<?php
namespace CreateMetaTags;

class WPActions
{
  protected $meta_controller;
  protected $admin_controller;

  public function __construct() {
    $this->meta_controller = new MetaController();
    $this->admin_controller = new AdminController();
  }

  public function init() {
    add_action('wp_head', [$this, 'output_site_meta']);
    add_action('wp_head', [$this, 'output_ogp']);
    add_action('wp_head', [$this, 'output_twitter_card']);

    add_action('admin_menu',[$this->admin_controller, 'admin_menu']);
    add_action('admin_init',[$this->admin_controller, 'admin_settings']);
    add_action('admin_print_styles', [$this->admin_controller, 'admin_css']);
    add_action('admin_enqueue_scripts', [$this->admin_controller, 'admin_scripts']);
  }

  /**
   * Output keywords & description.
   */
  public function output_site_meta() {
    $site_meta = $this->meta_controller->site_meta();
    echo $site_meta;
  }

  /**
   * Output OGP.
   */
  public function output_ogp() {
    $ogp = $this->meta_controller->ogp();
    echo $ogp;
  }

  /**
   * Output Twitter Card.
   */
  public function output_twitter_card() {
    $twitter_card = $this->meta_controller->twitter_card();
    echo $twitter_card;
  }
}
