<?php
namespace CreateMetaTags;

/**
 * Class MetaController
 * @package CreateMetaTags
 */
class MetaController
{
  protected $meta_model;
  protected $post_id;

  public function __construct() {
    $this->meta_model = new MetaModel();
  }

  /**
   * @param $post_id
   * @return array
   */
  public function share($post_id) {
    $data = $this->meta_model->find_share_data($post_id);
    return $data;
  }

  /**
   * @return string
   */
  public function site_meta() {
    $output = '';
    $post_id = null;
    if(is_single()) {
      global $post;
      $post_id = $post->ID;
    }
    $data = $this->meta_model->find_site_meta($post_id);
    foreach($data as $key => $value) {
      $output .= sprintf(
        '<meta name="%s" content="%s" />' . "\n",
        esc_attr($key),
        esc_attr($value)
      );
    }

    return $output;
  }

  /**
   * @return string
   */
  public function ogp() {
    $output = '';
    $post_id = null;
    if(is_single()) {
      global $post;
      $post_id = $post->ID;
    }
    $data = $this->meta_model->find_ogp_data($post_id);
    if($data && $fb_app_id = $this->meta_model->is_show_ogp()) {
      $output = '<meta property="fb:app_id" content="' . esc_html($fb_app_id) . '" />' . "\n";
      foreach($data as $key => $value) {
        $output .= sprintf(
          '<meta property="og:%s" content="%s" />' . "\n",
          esc_attr($key),
          esc_attr($value)
        );
      }
    }

    return $output;
  }

  /**
   * @return string
   */
  public function twitter_card() {
    $output = '';
    $post_id = null;
    if(is_single()) {
      global $post;
      $post_id = $post->ID;
    }
    $data = $this->meta_model->find_twitter_card_data($post_id);
    if($data && $this->meta_model->is_show_twitter_cards()) {
      foreach($data as $key => $value) {
        $output .= sprintf(
          '<meta name="twitter:%s" content="%s" />' . "\n",
          esc_attr($key),
          esc_attr($value)
        );
      }
    }

    return $output;
  }
}