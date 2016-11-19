<?php
namespace CreateMetaTags;

class WPActions
{
  protected $meta_controller;

  public function __construct() {
    $this->meta_controller = new MetaController();
  }

  public function init() {
    add_action('wp_head', [$this, 'output_site_meta']);
    add_action('wp_head', [$this, 'output_ogp']);
    add_action('wp_head', [$this, 'output_twitter_card']);
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
