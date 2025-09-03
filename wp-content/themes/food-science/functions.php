<?php

add_action('wp_head', function () {
  echo '<meta name="oreore" content="テストで入れてみます">';
});

// テーマサポート
add_theme_support('title-tag'); //タイトルタグを適切なものにする
add_theme_support('post-thumbnails'); //アイキャッチ画像を有効化する
add_theme_support('menus'); //カスタムメニューを有効化する(管理画面でメニュー作成が可能になる)

// titleタグの区切り文字を変更する
add_filter('document_title_separator', 'my_document_title_separator');
function my_document_title_separator($separator)
{
  $separator = '|';
  return $separator;
}

/**
 * Contact Form 7の時には整形機能をOFFにする
 */
add_filter('wpcf7_autop_or_not', 'my_wpcf7_autop');
function my_wpcf7_autop()
{
  return false;
}


/**
 * ショートコードの例
 */
function my_shortcode_func($param)
{
  if ($param['weather'] === '☀️') {
    return "<p>{$param['weather']}今日は快晴です！</p>";
  } elseif ($param['weather'] === '☔️') {
    return "<p>{$param['weather']}今日は雨です...</p>";
  }
}
// 1: ショートコード名 / 2: 動かす関数
add_shortcode('my_shortcode', 'my_shortcode_func');

/**
 * メインクエリを変更する
 */
add_action('pre_get_posts', 'my_pre_get_posts');
function my_pre_get_posts($query)
{
  // 管理ページ、メインクエリ以外は処理しない
  if (is_admin() || !$query->is_main_query()) {
    return; //処理しない（関数の処理をここでストップする）
  }

  // トップページの場合
  if ($query->is_home()) {
    $query->set('posts_per_page', 3);
    return;
  }
}

/**
 * 「保護中」の文字を削除する
 */
add_filter('protected_title_format', 'my_protected_title');
function my_protected_title($title)
{
  return '%s';
}


add_filter('the_password_form', 'my_password_form');
function my_password_form()
{
  remove_filter('the_content', 'wpautop');
  $wp_login_url = wp_login_url();
  $html = <<<HTML
    <p>パスワードを入力してください</p>
    <form class="post-password-form" action="{$wp_login_url}?action=postpass">
      <input type="password" name="post_password">
      <input type="submit" name="送信" value="送信">
    </form>
HTML;
  return $html;
}


/**
 * ブロックエディターにCSSを読み込む
 */
add_action('after_setup_theme', 'my_editor_support');
function my_editor_support()
{
  add_theme_support('editor-styles');
  add_editor_style('assets/css/editor-style.css');
}
