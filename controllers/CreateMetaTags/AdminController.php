<?php
namespace CreateMetaTags;

class AdminController
{
  const VIEWS_ROOT_PATH = 'views/';

  public function admin_menu() {
    add_options_page(
      __('Create Meta Tags', CREATE_META_TAGS_TEXT_DOMAIN),
      __('Create Meta Tags', CREATE_META_TAGS_TEXT_DOMAIN),
      'manage_options',
      'create-meta-tags',
      [$this, 'admin_page']
    );
  }

  public function admin_page() {
    $this->render('admin/settings.php');
  }

  public function admin_settings() {
    register_setting(CREATE_META_TAGS_TEXT_DOMAIN, 'create_meta_tags_facebook_app_id');
    register_setting(CREATE_META_TAGS_TEXT_DOMAIN, 'create_meta_tags_twitter_site');
    register_setting(CREATE_META_TAGS_TEXT_DOMAIN, 'create_meta_tags_keywords');
    register_setting(CREATE_META_TAGS_TEXT_DOMAIN, 'create_meta_tags_use_tag_line');
    register_setting(CREATE_META_TAGS_TEXT_DOMAIN, 'create_meta_tags_description');
    register_setting(CREATE_META_TAGS_TEXT_DOMAIN, 'create_meta_tags_image');
  }

  public function admin_css() {
    $screen = get_current_screen();
    if($screen->base === 'settings_page_create-meta-tags') {
      wp_enqueue_style('create_meta_tags_admin', CREATE_META_TAGS_PLUGIN_URL . 'assets/css/admin.css');
    }
  }

  public function admin_scripts() {
    $screen = get_current_screen();
    if($screen->base === 'settings_page_create-meta-tags') {
      wp_enqueue_media();
      wp_enqueue_script('vue', CREATE_META_TAGS_PLUGIN_URL . 'assets/vendor/js/vue.min.js');
      wp_enqueue_script('create_meta_tags_admin', CREATE_META_TAGS_PLUGIN_URL . 'assets/js/admin.js', false, false, true);
    }
  }

  private function render($file_path) {
    $path = CREATE_META_TAGS_PLUGIN_PATH . self::VIEWS_ROOT_PATH . $file_path;
    if(file_exists($path)) {
      include($path);
    }
  }
}
