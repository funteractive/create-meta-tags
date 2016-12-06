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

    $output = apply_filters('create_meta_tags_site_meta_output', $output, $post_id);
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
    if($data && $this->meta_model->is_show_ogp()) {
      $fb_app_id = $this->meta_model->get_fb_app_id();
      $output = '<meta property="fb:app_id" content="' . esc_html($fb_app_id) . '" />' . "\n";
      foreach($data as $key => $value) {
        $output .= sprintf(
          '<meta property="og:%s" content="%s" />' . "\n",
          esc_attr($key),
          esc_attr($value)
        );
      }
    }

    $output = apply_filters('create_meta_tags_ogp_output', $output, $post_id);
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

    $output = apply_filters('create_meta_tags_twitter_card_output', $output, $post_id);
    return $output;
  }
}