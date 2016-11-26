<?php
namespace CreateMetaTags;

/**
 * Class MetaModel
 * @package CreateMetaTags
 */
class MetaModel
{
  const OG_LOCALE = 'ja_JP';
  const KEYWORDS  = 'キーワード';
  const DESCRIPTION = 'サイトの説明';
  const TWITTER_CARD_TYPE = 'summary_large_image';
  const TWITTER_SITE = '';

  /**
   * @param null $post_id
   * @return array
   */
  public function find_site_meta($post_id = null) {
    $site_meta_data = [
      'keywords'    => $this->get_keywords($post_id),
      'description' => $this->get_description($post_id),
    ];

    return $site_meta_data;
  }

  /**
   * @param null $post_id
   * @param null $feature_id
   * @return array
   */
  public function find_ogp_data($post_id = null, $feature_id = null) {
    $ogp_data = [
      'title'       => $this->get_title(),
      'image'       => $this->get_image($post_id, $feature_id),
      'url'         => $this->get_url(),
      'description' => $this->get_description($post_id),
      'site_name'   => $this->get_site_name(),
      'type'        => $this->get_type($post_id),
      'locale'      => $this->get_locale(),
    ];

    return $ogp_data;
  }

  /**
   * @param null $post_id
   * @param null $feature_id
   * @return array
   */
  public function find_twitter_card_data($post_id = null, $feature_id = null) {
    $twitter_card_data = [
      'card'        => $this->get_card(),
      'site'        => $this->get_site(),
      'title'       => $this->get_title(),
      'image'       => $this->get_image($post_id, $feature_id),
      'description' => $this->get_description($post_id),
    ];

    return $twitter_card_data;
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
    } else {
      return home_url() . '/ogimg.png';
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
    } else {
      return self::DESCRIPTION;
    }
  }

  /**
   * @return string
   */
  private function get_keywords() {
    return self::KEYWORDS;
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
   * @return string
   */
  private function get_site() {
    return self::TWITTER_SITE;
  }
}