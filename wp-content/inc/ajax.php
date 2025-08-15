<?php
/**
 * AJAX処理
 */

/**
 * AJAX: カテゴリー検索の投稿数を取得
 */
function get_product_count() {
  $selected_product_categories = isset($_POST['product_categories']) ? array_map('sanitize_text_field', $_POST['product_categories']) : array();
  $selected_purpose_categories = isset($_POST['purpose_categories']) ? array_map('sanitize_text_field', $_POST['purpose_categories']) : array();
  
  $args = array(
    'post_type' => 'product',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'fields' => 'ids'
  );
  
  // カテゴリー検索がある場合の処理
  if (!empty($selected_product_categories) || !empty($selected_purpose_categories)) {
    $meta_query = array('relation' => 'AND');
    
    if (!empty($selected_product_categories)) {
      $product_meta_query = array('relation' => 'OR');
      foreach ($selected_product_categories as $category) {
        $product_meta_query[] = array(
          'key' => '_product_categories',
          'value' => '"' . $category . '"',
          'compare' => 'LIKE'
        );
      }
      $meta_query[] = $product_meta_query;
    }
    
    if (!empty($selected_purpose_categories)) {
      $purpose_meta_query = array('relation' => 'OR');
      foreach ($selected_purpose_categories as $category) {
        $purpose_meta_query[] = array(
          'key' => '_purpose_categories',
          'value' => '"' . $category . '"',
          'compare' => 'LIKE'
        );
      }
      $meta_query[] = $purpose_meta_query;
    }
    
    $args['meta_query'] = $meta_query;
  }
  
  $query = new WP_Query($args);
  $count = $query->found_posts;
  
  wp_send_json_success(array('count' => $count));
}
add_action('wp_ajax_get_product_count', 'get_product_count');
add_action('wp_ajax_nopriv_get_product_count', 'get_product_count');
?>
