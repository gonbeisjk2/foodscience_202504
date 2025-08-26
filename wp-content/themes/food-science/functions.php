<?php

add_action('wp_head', function () {
  echo '<meta name="oreore" content="テストで入れてみます">';
});

// テーマサポート
add_theme_support('title-tag'); //タイトルタグを適切なものにする
