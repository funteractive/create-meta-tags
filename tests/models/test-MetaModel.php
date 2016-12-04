<?php
namespace CreateMetaTags;

class Test_Models_MetaModel extends \WP_UnitTestCase
{
  protected $meta_model;

  const KEYWORDS         = 'foo,bar,baz';
  const BLOG_DESCRIPTION = 'Just another WordPress site';
  const DESCRIPTION      = 'Lorem ipsum dolor sit amet, vix viderer eripuit forensibus cu. Iusto nostrum at mea. Nec ne errem iisque maluisset. Prima nostrud ut usu. Id quo iisque nominati efficiantur.';
  const POST_EXCERPT     = 'This is post excerpt.';
  const FB_APP_ID        = 12345678;
  const TWITTER_SITE     = '@example';

  public function setUp() {
    parent::setUp();

    $this->meta_model = new MetaModel();
  }

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
    $post_id = self::factory()->post->create_and_get([
      'post_excerpt' => self::POST_EXCERPT
    ]);
    add_option('create_meta_tags_keywords', self::KEYWORDS);
    add_option('create_meta_tags_description', self::DESCRIPTION);
    $this->assertequals([
      'keywords'    => self::KEYWORDS,
      'description' => self::POST_EXCERPT,
    ], $this->meta_model->find_site_meta($post_id));
  }

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
