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
