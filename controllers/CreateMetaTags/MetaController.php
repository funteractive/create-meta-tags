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
    $post_id = null;
    if(is_single()) {
      global $post;
      $post_id = $post->ID;
    }
    $data = $this->meta_model->find_site_meta($post_id);
    $output = '';
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
    $post_id = null;
    $feature_id = null;
    if(is_single()) {
      global $post;
      $post_id = $post->ID;
    } elseif (is_tax('features')) {
      $feature = get_queried_object();
      if($feature) {
        $feature_id = $feature->term_id;
      }
    }
    $data = $this->meta_model->find_ogp_data($post_id, $feature_id);
    $output = '<meta property="fb:app_id" content="' . LIBZLIFE_FB_APP_ID . '" />' . "\n";
    foreach($data as $key => $value) {
      $output .= sprintf(
        '<meta property="og:%s" content="%s" />' . "\n",
        esc_attr($key),
        esc_attr($value)
      );
    }

    return $output;
  }

  /**
   * @return string
   */
  public function twitter_card() {
    $post_id = null;
    if(is_single()) {
      global $post;
      $post_id = $post->ID;
    }
    $data = $this->meta_model->find_twitter_card_data($post_id, $feature_id);
    $output = '';
    foreach($data as $key => $value) {
      $output .= sprintf(
        '<meta name="twitter:%s" content="%s" />' . "\n",
        esc_attr($key),
        esc_attr($value)
      );
    }

    return $output;
  }
}