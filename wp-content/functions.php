<?php
/**
 * Functions
 */

/**
 * CSSとJavaScriptの読み込み
 *
 * @codex https://wpdocs.osdn.jp/%E3%83%8A%E3%83%93%E3%82%B2%E3%83%BC%E3%82%B7%E3%83%A7%E3%83%B3%E3%83%A1%E3%83%8B%E3%83%A5%E3%83%BC
 */
function my_script_init()
{
  // CSS読み込み
  wp_enqueue_style('my-style', get_template_directory_uri() . '/assets/css/style.css', array(), filemtime(get_theme_file_path('assets/css/style.css')),  'all');

  // JavaScript読み込み
  wp_enqueue_script('my-script', get_template_directory_uri() . '/assets/js/script.js', array(), filemtime(get_theme_file_path('assets/js/script.js')), true);
  
  // テーマディレクトリのURLをJavaScriptに渡す
  wp_localize_script('my-script', 'themeData', array(
    'templateUrl' => get_template_directory_uri(),
    'assetsUrl' => get_template_directory_uri() . '/assets'
  ));
  
  // AJAX用のURLをJavaScriptに渡す
  wp_localize_script('my-script', 'ajax_object', array(
    'ajax_url' => admin_url('admin-ajax.php')
  ));
  
  // 製品ページ用のJavaScript（条件付き読み込み）
  if (is_post_type_archive('product') || is_singular('product')) {
    wp_enqueue_script('product-script', get_template_directory_uri() . '/assets/js/product.js', array(), filemtime(get_theme_file_path('assets/js/product.js')), true);
    
    // product.jsにもAJAX URLを渡す
    wp_localize_script('product-script', 'ajax_object', array(
      'ajax_url' => admin_url('admin-ajax.php')
    ));
  }
}
add_action('wp_enqueue_scripts', 'my_script_init');

/**
 * デフォルトのjQueryを読み込ませない
 *
 * @codex http://keylopment.com/faq/1548/
 */
add_action('wp_print_scripts','notimport_script',100);
function notimport_script() {
  if (!is_admin()) {
    wp_deregister_script('jquery'); 
  }
}

/**
 * セキュリティー対策
 */

/**
 * wordpressバージョン情報の削除
 * @see　https://qiita.com/Taka96/items/b541b1fef0fa20add47d
 */
  remove_action('wp_head', 'wp_generator');

/**
 * 投稿者一覧ページを自動で生成されないようにする
 * @see　https://qiita.com/Taka96/items/b541b1fef0fa20add47d
 */
add_filter('author_rewrite_rules', '__return_empty_array');
function disable_author_archive() {
  if( preg_match( '#/author/.+#', $_SERVER['REQUEST_URI'] ) ){
    wp_redirect( esc_url( home_url( '/404.php' ) ) );
    exit;
  }
}
add_action('init', 'disable_author_archive');

/**
 * /?author=1 などでアクセスしたらリダイレクトさせる
 * @see https://www.webdesignleaves.com/pr/wp/wp_user_enumeration.html
 */
if (!is_admin()) {
  if (preg_match('/author=([0-9]*)/i', $_SERVER['QUERY_STRING'])) die();
  add_filter('redirect_canonical', 'my_shapespace_check_enum', 10, 2);
}
function my_shapespace_check_enum($redirect, $request)
{
  if (preg_match('/\?author=([0-9]*)(\/*)/i', $request)) die();
  else return $redirect;
}

/**
 * Windows Live Writerの削除
 */
remove_action('wp_head', 'wlwmanifest_link');

/**
 * 絵文字設定の削除
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/**
 * フィード配信の削除
 */
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);

/**
 * RSDの削除
 */
remove_action( 'wp_head', 'rsd_link' );

/**
 * REST APIの削除
 */
remove_action('wp_head', 'rest_output_link_wp_head');

/**
 * shortlinkの削除
 */
remove_action('wp_head', 'wp_shortlink_wp_head');

/**
 * ブロックエディタのCSSの削除
 */
add_action('wp_enqueue_scripts', function(){
	wp_dequeue_style('wp-block-library');
	wp_dequeue_style('global-styles');
});

// /**
//  * dashicons-css admin-bar-css の削除
//  */
// function remove_unwanted_styles() {
//   wp_dequeue_style('dashicons');
//   wp_dequeue_style('admin-bar');
// }
// add_action('wp_enqueue_scripts', 'remove_unwanted_styles', 999);

/**
 * hoverintent-js admin-bar の削除
 */
function remove_unwanted_scripts() {
  wp_dequeue_script('hoverintent-js');
  wp_dequeue_script('admin-bar');
}
add_action('wp_enqueue_scripts', 'remove_unwanted_scripts', 999);

/**
 * classic-theme-styles-inline-cssのCSSの削除
 */
add_action( 'wp_enqueue_scripts', 'remove_classic_theme_style' );
function remove_classic_theme_style() {
	wp_dequeue_style( 'classic-theme-styles' );
}

/**
 * Embed系のタグを削除
 */
remove_action('wp_head','rest_output_link_wp_head');
remove_action('wp_head','wp_oembed_add_discovery_links');
remove_action('wp_head','wp_oembed_add_host_js');

/**
 * 投稿メニュー・コメントを非表示
 */
function remove_menus () {
  remove_menu_page( 'edit.php' );
  remove_menu_page( 'edit-comments.php' );
}
add_action('admin_menu', 'remove_menus');


/**
 * pタグとbrタグの自動挿入を解除
 */
// add_action('init', 'disable_output');

// function disable_output()
// {
//   remove_filter('the_content', 'wpautop');  // 本文欄
//   remove_filter('the_title', 'wpautop');  // タイトル欄
//   remove_filter('comment_text', 'wpautop');  // コメント欄
//   remove_filter('the_excerpt', 'wpautop');  // 抜粋欄
// }

/*
 * テンプレートパスを返す
 */
function temp_path()
{
  echo esc_url(get_template_directory_uri());
}
/* assetsパスを返す */
function assets_path()
{
  echo esc_url(get_template_directory_uri() . '/assets');
}
/* 画像パスを返す */
function img_path()
{
  echo esc_url(get_template_directory_uri() . '/assets/images');
}
/* mediaフォルダへのURL */
function uploads_path()
{
  echo esc_url(wp_upload_dir()['baseurl']);
}

/* ホームURLのパスを返す
 *
 * $page = worksの場合、https://xxxx.co.jp/works/ を返す
 * 呼び出しは、<?php page_path('works'); ?> で実施する
 *
*/
function page_path($page = "")
{
  $page = $page . '/';
  echo esc_url(home_url($page));
}

/**
 * WordPressで自動出力されるタイトル系のカスタマイズ
 * @see https://haniwaman.com/customize-title/
 */
function change_archive_title( $title ) {
	if ( is_post_type_archive() ) {
		$title = post_type_archive_title( "", false );
	} elseif ( is_tax() ) {
    $title = single_term_title( "", false );
  }
	return $title;
};
add_filter( 'get_the_archive_title', 'change_archive_title' );

/* サムネイルを有効にする */
add_theme_support('post-thumbnails');

/**
 * the_archive_title 余計な文字を削除
 * @see https://naoyu.net/archive-title-hook/
 */
add_filter( 'get_the_archive_title', function ($title) {
  if (is_category()) {
      $title = single_cat_title('',false);
  } elseif (is_tag()) {
      $title = single_tag_title('',false);
  } elseif (is_tax()) {
      $title = single_term_title('',false);
  } elseif (is_post_type_archive() ){
    $title = post_type_archive_title('',false);
  } elseif (is_date()) {
      $title = get_the_time('Y年n月');
  } elseif (is_search()) {
      $title = '検索結果：'.esc_html( get_search_query(false) );
  } elseif (is_404()) {
      $title = '「404」ページが見つかりません';
  } else {

  }
  return $title;
});

/**
 * WebPファイルの有効化
 * @see https://wordpress.news-vouge.com/wordpress-webp/
 */
function add_file_types_to_uploads( $mimes ) {
  $mimes['webp'] = 'image/webp';
  return $mimes;
}
add_filter( 'upload_mimes', 'add_file_types_to_uploads' );

/**
 * スラッグに記事IDを自動で指定する方法
 * @see https://liginc.co.jp/576942
 */
function slug_auto_setting( $slug, $post_ID, $post_status, $post_type ) {
  $post = get_post($post_ID);

  if ( $post_type == 'news' && $post->post_date_gmt == '0000-00-00 00:00:00' ) {
    $slug = generate_news_sequential_slug();
    return $slug;
  }

  // 製品投稿の場合は連番スラッグを生成
  if ( $post_type == 'product' && $post->post_date_gmt == '0000-00-00 00:00:00' ) {
    $slug = generate_product_sequential_slug();
    return $slug;
  }

  return $slug;
}

/**
 * 最新情報投稿用の連番スラッグを生成
 */
function generate_news_sequential_slug() {
  global $wpdb;
  
  $max_number = $wpdb->get_var(
    "SELECT MAX(CAST(post_name AS UNSIGNED)) 
     FROM {$wpdb->posts} 
     WHERE post_type = 'news' 
     AND post_status IN ('publish', 'draft', 'private', 'pending') 
     AND post_name REGEXP '^[0-9]+$'"
  );
  
  $next_number = $max_number ? intval($max_number) + 1 : 1;
  
  return sprintf('%02d', $next_number);
}
add_filter( 'wp_unique_post_slug', 'slug_auto_setting', 10, 4 );

/**
 * 製品投稿用の連番スラッグを生成
 */
function generate_product_sequential_slug() {
  global $wpdb;
  
  $max_number = $wpdb->get_var(
    "SELECT MAX(CAST(post_name AS UNSIGNED)) 
     FROM {$wpdb->posts} 
     WHERE post_type = 'product' 
     AND post_status IN ('publish', 'draft', 'private', 'pending') 
     AND post_name REGEXP '^[0-9]+$'"
  );
  
  $next_number = $max_number ? intval($max_number) + 1 : 1;
  
  return sprintf('%02d', $next_number);
}
add_filter( 'wp_unique_post_slug', 'slug_auto_setting', 10, 4 );

/*
  inc/breadcrumb.php
  - パンくずリストの設定
*/
include get_template_directory() . '/inc/breadcrumb.php';

/*
  inc/product.php
  - カスタム投稿「製品」の設定
*/
include get_template_directory() . '/inc/product.php';

/*
  inc/product.php
  - カスタム投稿「最新情報」の設定
*/
include get_template_directory() . '/inc/news.php';

/*
  inc/ajax.php
  - AJAX処理の設定
*/
include get_template_directory() . '/inc/ajax.php';




?>
