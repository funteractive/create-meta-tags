<?php
namespace CreateMetaTags;

class Test_Models_MetaModel extends \WP_UnitTestCase
{
  protected $meta_model;

  const KEYWORDS          = 'foo,bar,baz';
  const BLOG_DESCRIPTION  = 'Just another WordPress site';
  const DESCRIPTION       = 'Lorem ipsum dolor sit amet, vix viderer eripuit forensibus cu. Iusto nostrum at mea. Nec ne errem iisque maluisset. Prima nostrud ut usu. Id quo iisque nominati efficiantur.';
  const POST_EXCERPT      = 'This is post excerpt.';
  const FB_APP_ID         = 12345678;
  const TWITTER_SITE      = '@example';
  const TWITTER_CARD_TYPE = 'summary_large_image';

  public function setUp() {
    parent::setUp();

    $this->meta_model = new MetaModel();
  }

  /**
   * find_site_meta
   */
  public function test_find_site_meta() {
    add_option('create_meta_tags_keywords', self::KEYWORDS);
    add_option('create_meta_tags_description', self::DESCRIPTION);
    $this->assertEquals([
      'keywords'    => self::KEYWORDS,
      'description' => self::DESCRIPTION,
    ], $this->meta_model->find_site_meta());
  }

  public function test_find_site_meta_when_use_tag_line() {
    add_option('blogdescription', self::BLOG_DESCRIPTION);
    add_option('create_meta_tags_use_tag_line', 1);
    add_option('create_meta_tags_keywords', self::KEYWORDS);
    add_option('create_meta_tags_description', self::DESCRIPTION);
    $this->assertequals([
      'keywords'    => self::KEYWORDS,
      'description' => self::BLOG_DESCRIPTION,
    ], $this->meta_model->find_site_meta());
  }

  public function test_find_site_meta_for_single() {
    $post = self::factory()->post->create_and_get([
      'post_excerpt' => self::POST_EXCERPT
    ]);
    add_option('create_meta_tags_keywords', self::KEYWORDS);
    add_option('create_meta_tags_description', self::DESCRIPTION);
    $this->assertequals([
      'keywords'    => self::KEYWORDS,
      'description' => self::POST_EXCERPT,
    ], $this->meta_model->find_site_meta($post->ID));
  }

  /**
   * find_ogp_data
   */
  public function test_find_ogp_data() {
    $attachment_id = $this->factory->attachment->create_object('image.jpg', 0, [
      'post_mime_type' => 'image/jpeg',
      'post_type' => 'attachment'
    ]);
    $attachment_src = wp_get_attachment_image_src($attachment_id, 'full');
    $attachment_src = $attachment_src[0];

    add_option('create_meta_tags_description', self::DESCRIPTION);
    add_option('create_meta_tags_image', $attachment_id);

    $this->assertequals([
      'title'       => get_bloginfo('name'),
      'image'       => $attachment_src,
      'url'         => home_url(),
      'description' => self::DESCRIPTION,
      'site_name'   => get_bloginfo('name'),
      'type'        => 'website',
      'locale'      => 'en_US',
    ], $this->meta_model->find_ogp_data());
  }

  /**
   * find_twitter_card_data
   */
  public function test_find_twitter_card_data() {
    $attachment_id = $this->factory->attachment->create_object('image.jpg', 0, [
      'post_mime_type' => 'image/jpeg',
      'post_type' => 'attachment'
    ]);
    $attachment_src = wp_get_attachment_image_src($attachment_id, 'full');
    $attachment_src = $attachment_src[0];

    add_option('create_meta_tags_description', self::DESCRIPTION);
    add_option('create_meta_tags_image', $attachment_id);
    add_option('create_meta_tags_twitter_site', self::TWITTER_SITE);

    $this->assertequals([
      'card'        => self::TWITTER_CARD_TYPE,
      'site'        => self::TWITTER_SITE,
      'title'       => get_bloginfo('name'),
      'image'       => $attachment_src,
      'description' => self::DESCRIPTION,
    ], $this->meta_model->find_twitter_card_data());
  }

  /**
   * Other functions.
   */
  public function test_get_fb_app_id() {
    add_option('create_meta_tags_facebook_app_id', self::FB_APP_ID);
    $this->assertEquals(self::FB_APP_ID, $this->meta_model->get_fb_app_id());
  }

  public function test_is_show_ogp() {
    $this->assertFalse($this->meta_model->is_show_ogp());
    add_option('create_meta_tags_facebook_app_id', self::FB_APP_ID);
    $this->assertTrue($this->meta_model->is_show_ogp());
  }

  public function test_is_show_twitter_cards() {
    $this->assertFalse($this->meta_model->is_show_twitter_cards());
    add_option('create_meta_tags_twitter_site', self::TWITTER_SITE);
    $this->assertTrue($this->meta_model->is_show_twitter_cards());
  }
}
