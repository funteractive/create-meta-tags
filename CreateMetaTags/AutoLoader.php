<?php
namespace CreateMetaTags;

class AutoLoader
{
  /**
   * オートローダーが探しにいくディレクトリ
   * @var
   */
  protected $dirs;

  /**
   * __autoload()の実装として、下記のautoLoad()を登録する
   */
  public function register()
  {
    spl_autoload_register(array($this, 'autoLoad'));
  }

  /**
   * 探索ディレクトリを登録するメソッド
   * @param $dir
   */
  public function registerDir($dir)
  {
    $this->dirs[] = $dir;
  }

  /**
   * autoloadはインスタンス生成時に呼ばれるがそのとき対象となるクラス名を引数として引き受ける
   * namespaceに関係なく読み込む
   * @param $className
   */
  public function autoLoad($className)
  {
    foreach ($this->dirs as $dir) {
      // replace the namespace prefix with the base directory, replace namespace
      // separators with directory separators in the relative class name, append
      // with .php
      $file = $dir . '/' . str_replace('\\', '/', $className) . '.php';
      if (is_readable($file)) {
        require $file;
        return;
      }
    }
  }
}