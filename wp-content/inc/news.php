<?php

/**
 * カスタム投稿タイプ「最新情報」の作成
 */
function create_news_post_type() {
  register_post_type('news', array(
    'labels' => array(
      'name' => '最新情報',
      'singular_name' => '最新情報',
      'add_new' => '新規追加',
      'add_new_item' => '新しい最新情報を追加',
      'edit_item' => '最新情報を編集',
      'new_item' => '新しい最新情報',
      'view_item' => '最新情報を表示',
      'search_items' => '最新情報を検索',
      'not_found' => '最新情報が見つかりませんでした',
      'not_found_in_trash' => 'ゴミ箱に最新情報が見つかりませんでした',
      'all_items' => 'すべての最新情報',
      'menu_name' => '最新情報'
    ),
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'news'),
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => 5,
    'menu_icon' => 'dashicons-admin-post',
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'revisions'),
    'show_in_rest' => true,
    'taxonomies' => array('news_cat'),
  ));
}
add_action('init', 'create_news_post_type');

/**
 * カスタムタクソノミー「最新情報カテゴリー」の作成
 */
function create_news_taxonomy() {
  register_taxonomy('news_cat', 'news', array(
    'labels' => array(
      'name' => '最新情報カテゴリー',
      'singular_name' => '最新情報カテゴリー',
      'search_items' => 'カテゴリーを検索',
      'all_items' => 'すべてのカテゴリー',
      'parent_item' => '親カテゴリー',
      'parent_item_colon' => '親カテゴリー:',
      'edit_item' => 'カテゴリーを編集',
      'update_item' => 'カテゴリーを更新',
      'add_new_item' => '新しいカテゴリーを追加',
      'new_item_name' => '新しいカテゴリー名',
      'menu_name' => '最新情報カテゴリー',
    ),
    'hierarchical' => true,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_admin_column' => true,
    'show_in_nav_menus' => true,
    'show_tagcloud' => true,
    'rewrite' => array('slug' => 'news-category'),
    'show_in_rest' => true,
  ));
}
add_action('init', 'create_news_taxonomy');

/**
 * デフォルトカテゴリーの作成
 */
function create_default_news_categories() {
  $categories = array(
    array(
      'name' => '採用情報',
      'slug' => 'recruit'
    ),
    array(
      'name' => 'マスコミ',
      'slug' => 'media'
    ),
    array(
      'name' => '展示会',
      'slug' => 'exhibition'
    ),
    array(
      'name' => 'その他',
      'slug' => 'other'
    )
  );

  foreach ($categories as $category) {
    if (!term_exists($category['name'], 'news_cat')) {
      wp_insert_term($category['name'], 'news_cat', array(
        'slug' => $category['slug']
      ));
    }
  }
}
add_action('init', 'create_default_news_categories');


?>