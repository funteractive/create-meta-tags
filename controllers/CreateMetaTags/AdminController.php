<?php
namespace CreateMetaTags;

class AdminController
{
  const VIEWS_ROOT_PATH = 'views/';

  public function admin_menu() {
    add_options_page(
      _('Create Meta Tags'),
      _('Create Meta Tags'),
      'manage_options',
      'create-meta-tags',
      [$this, 'admin_page']
    );
  }

  public function admin_page() {
    $this->render('admin/settings.php');
  }

  private function render($file_path) {
    $path = CREATE_META_TAGS_PLUGIN_PATH . self::VIEWS_ROOT_PATH . $file_path;
    if(file_exists($path)) {
      include($path);
    }
  }
}
