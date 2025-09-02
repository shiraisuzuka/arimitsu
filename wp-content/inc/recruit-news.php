<?php
/**
 * 採用お知らせ（recruit-news）カスタム投稿タイプ
 */

/**
 * 採用お知らせカスタム投稿タイプの登録
 */
function create_recruit_news_post_type() {
  $args = array(
    'labels' => array(
      'name' => '採用お知らせ',
      'singular_name' => '採用お知らせ',
      'add_new' => '新規追加',
      'add_new_item' => '新しい採用お知らせを追加',
      'edit_item' => '採用お知らせを編集',
      'new_item' => '新しい採用お知らせ',
      'view_item' => '採用お知らせを表示',
      'search_items' => '採用お知らせを検索',
      'not_found' => '採用お知らせが見つかりませんでした',
      'not_found_in_trash' => 'ゴミ箱に採用お知らせはありません',
      'menu_name' => '採用お知らせ'
    ),
    'public' => true,
    'publicly_queryable' => false, // 一覧ページ・詳細ページなし
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => false, // URLリライトなし
    'capability_type' => 'post',
    'has_archive' => false, // アーカイブページなし
    'hierarchical' => false,
    'menu_position' => 5,
    'menu_icon' => 'dashicons-megaphone',
    'supports' => array('title', 'editor', 'custom-fields'),
    'show_in_rest' => true,
  );
  register_post_type('recruit-news', $args);
}
add_action('init', 'create_recruit_news_post_type');

/**
 * 採用お知らせのカスタムフィールド（メタボックス）を追加
 */
function add_recruit_news_meta_boxes() {
  add_meta_box(
    'recruit_news_link',
    'リンク先設定',
    'recruit_news_link_callback',
    'recruit-news',
    'normal',
    'high'
  );
}
add_action('add_meta_boxes', 'add_recruit_news_meta_boxes');

/**
 * リンク先カスタムフィールドのHTML出力
 */
function recruit_news_link_callback($post) {
  // nonceフィールドを追加（セキュリティ対策）
  wp_nonce_field('recruit_news_save_meta', 'recruit_news_meta_nonce');
  
  // 既存の値を取得
  $link_url = get_post_meta($post->ID, '_recruit_news_link_url', true);
  
  echo '<table class="form-table">';
  echo '<tr>';
  echo '<th><label for="recruit_news_link_url">リンク先URL</label></th>';
  echo '<td>';
  echo '<input type="url" id="recruit_news_link_url" name="recruit_news_link_url" value="' . esc_attr($link_url) . '" style="width: 100%;" placeholder="https://example.com/page" />';
  echo '<p class="description">リンク先のURLを入力してください。</p>';
  echo '</td>';
  echo '</tr>';
  echo '</table>';
}

/**
 * カスタムフィールドの保存処理
 */
function save_recruit_news_meta($post_id) {
  // nonceの検証
  if (!isset($_POST['recruit_news_meta_nonce']) || !wp_verify_nonce($_POST['recruit_news_meta_nonce'], 'recruit_news_save_meta')) {
    return;
  }
  
  // 自動保存の場合は処理しない
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }
  
  // 権限チェック
  if (!current_user_can('edit_post', $post_id)) {
    return;
  }
  
  // リンクURLの保存
  if (isset($_POST['recruit_news_link_url'])) {
    $link_url = sanitize_url($_POST['recruit_news_link_url']);
    update_post_meta($post_id, '_recruit_news_link_url', $link_url);
  }
}
add_action('save_post', 'save_recruit_news_meta');

/**
 * 採用お知らせを取得して出力する関数（もっと表示する機能対応）
 */
function get_recruit_news_list($initial_limit = 3) {
  // 全ての採用お知らせを取得
  $args = array(
    'post_type' => 'recruit-news',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC'
  );
  
  $recruit_news = get_posts($args);
  
  if (!empty($recruit_news)) {
    echo '<ul class="p-recruit-news">';
    
    foreach ($recruit_news as $index => $news) {
      $link_url = get_post_meta($news->ID, '_recruit_news_link_url', true);
      $post_date = get_the_date('Y.m.d', $news->ID);
      $post_datetime = get_the_date('Y-m-d', $news->ID);
      
      // 初期表示件数を超える場合は非表示クラスを追加
      $hidden_class = ($index >= $initial_limit) ? ' style="display: none;" data-hidden="true"' : '';
      
      echo '<li' . $hidden_class . '>';
      
      // リンクURLがある場合は通常のリンク、ない場合はno-linkクラス付きのaタグを出力
      if (!empty($link_url)) {
        echo '<a href="' . esc_url($link_url) . '">';
      } else {
        echo '<a href="#" class="no-link">';
      }
      echo '<time datetime="' . esc_attr($post_datetime) . '">' . esc_html($post_date) . '</time>';
      echo '<h3>' . esc_html($news->post_title) . '</h3>';
      echo '</a>';
      
      echo '</li>';
    }
    
    echo '</ul>';
    
    // 全体の件数が初期表示件数を超える場合のみ「もっと表示する」ボタンを表示
    if (count($recruit_news) > $initial_limit) {
      echo '<button class="p-recruit-news-btn js-recruit-news-more">もっと表示する</button>';
    }
  } else {
    echo '<ul class="p-recruit-news">';
    echo '<li>採用お知らせはありません。</li>';
    echo '</ul>';
  }
}

/**
 * 採用お知らせの件数を取得する関数
 */
function get_recruit_news_count() {
  $args = array(
    'post_type' => 'recruit-news',
    'post_status' => 'publish',
    'posts_per_page' => -1
  );
  
  $recruit_news = get_posts($args);
  return count($recruit_news);
}
?>
