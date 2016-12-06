<?php
namespace CreateMetaTags;

/**
 * Class MetaModel
 * @package CreateMetaTags
 */
class MetaModel
{
  const OG_LOCALE = 'en_US';
  const TWITTER_CARD_TYPE = 'summary_large_image';

  /**
   * @param null $post_id
   * @return array
   */
  public function find_site_meta($post_id = null) {
    $site_meta_data = [
      'keywords'    => $this->get_keywords(),
      'description' => $this->get_description($post_id),
    ];

    $site_meta_data = apply_filters('create_meta_tags_site_meta', $site_meta_data, $post_id);
    return $site_meta_data;
  }

  /**
   * @param null $post_id
   * @return array
   */
  public function find_ogp_data($post_id = null) {
    $ogp_data = [
      'title'       => $this->get_title(),
      'image'       => $this->get_image($post_id),
      'url'         => $this->get_url(),
      'description' => $this->get_description($post_id),
      'site_name'   => $this->get_site_name(),
      'type'        => $this->get_type($post_id),
      'locale'      => $this->get_locale(),
    ];

    $ogp_data = apply_filters('create_meta_tags_ogp', $ogp_data, $post_id);
    return $ogp_data;
  }

  /**
   * @param null $post_id
   * @return array
   */
  public function find_twitter_card_data($post_id = null) {
    $twitter_card_data = [
      'card'        => $this->get_card(),
      'site'        => $this->get_site(),
      'title'       => $this->get_title(),
      'image'       => $this->get_image($post_id),
      'description' => $this->get_description($post_id),
    ];

    $twitter_card_data = apply_filters('create_meta_tags_twitter_card', $twitter_card_data, $post_id);
    return $twitter_card_data;
  }

  /**
   * @return mixed|void
   */
  public function get_fb_app_id() {
    return get_option('create_meta_tags_facebook_app_id');
  }

  /**
   * @return bool
   */
  public function is_show_ogp() {
    return (bool) $this->get_fb_app_id();
  }

  /**
   * @return bool
   */
  public function is_show_twitter_cards() {
    return (bool) $this->get_site();
  }

  /**
   * @return string
   */
  private function get_title() {
    return wp_get_document_title();
  }

  /**
   * @param null $post_id
   * @return string
   */
  private function get_image($post_id = null) {
    if($post_id && has_post_thumbnail($post_id)) {
      return get_the_post_thumbnail_url($post_id, 'full');
    } elseif($image_id = get_option('create_meta_tags_image')) {
      $src = wp_get_attachment_image_src($image_id, 'full');
      if($src) {
        return current($src);
      }
      return null;
    } else {
      return null;
    }
  }

  /**
   * @return string
   */
  private function get_url() {
    return (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  }

  /**
   * @param null $post_id
   * @return mixed
   */
  private function get_description($post_id = null) {
    if($post_id) {
      return strip_tags(get_the_excerpt($post_id));
    } elseif(get_option('create_meta_tags_use_tag_line')) {
      return get_bloginfo('description');
    } else {
      return get_option('create_meta_tags_description');
    }
  }

  /**
   * @return string
   */
  private function get_keywords() {
    return get_option('create_meta_tags_keywords');
  }

  /**
   * @return string|void
   */
  private function get_site_name() {
    return get_bloginfo('name');
  }

  /**
   * @param null $post_id
   * @return string
   */
  private function get_type($post_id = null) {
    if($post_id) {
      return 'article';
    } else {
      return 'website';
    }
  }

  /**
   * @return string
   */
  private function get_locale() {
    return self::OG_LOCALE;
  }

  /**
   * @return string
   */
  private function get_card() {
    return self::TWITTER_CARD_TYPE;
  }

  /**
   * @return mixed|void
   */
  private function get_site() {
    return get_option('create_meta_tags_twitter_site');
  }
}