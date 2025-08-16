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
    'supports' => array('title', 'editor', 'excerpt', 'author', 'revisions', 'custom-fields'),
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
    'お知らせ',
    '展示会情報',
    'マスコミ情報',
    'その他'
  );

  foreach ($categories as $category) {
    if (!term_exists($category, 'news_cat')) {
      wp_insert_term($category, 'news_cat');
    }
  }
}
add_action('init', 'create_default_news_categories');

/**
 * 最新情報用カスタムフィールドの追加
 */
function add_news_meta_boxes() {
  add_meta_box(
    'news_images',
    '画像アップロード（最大2枚）',
    'news_images_callback',
    'news',
    'normal',
    'high'
  );
}
add_action('add_meta_boxes', 'add_news_meta_boxes');

/**
 * 画像アップロード用メタボックスのコールバック
 */
function news_images_callback($post) {
  wp_nonce_field('news_images_nonce', 'news_images_nonce');
  
  $image1 = get_post_meta($post->ID, '_news_image_1', true);
  $image2 = get_post_meta($post->ID, '_news_image_2', true);
  
  ?>
  <table class="form-table">
    <tr>
      <th><label for="news_image_1">画像1</label></th>
      <td>
        <input type="hidden" id="news_image_1" name="news_image_1" value="<?php echo esc_attr($image1); ?>" />
        <div id="news_image_1_preview">
          <?php if ($image1): ?>
            <img src="<?php echo esc_url(wp_get_attachment_url($image1)); ?>" style="max-width: 200px; height: auto;" />
          <?php endif; ?>
        </div>
        <button type="button" class="button" id="news_image_1_button">画像を選択</button>
        <button type="button" class="button" id="news_image_1_remove" <?php echo $image1 ? '' : 'style="display:none;"'; ?>>画像を削除</button>
      </td>
    </tr>
    <tr>
      <th><label for="news_image_2">画像2</label></th>
      <td>
        <input type="hidden" id="news_image_2" name="news_image_2" value="<?php echo esc_attr($image2); ?>" />
        <div id="news_image_2_preview">
          <?php if ($image2): ?>
            <img src="<?php echo esc_url(wp_get_attachment_url($image2)); ?>" style="max-width: 200px; height: auto;" />
          <?php endif; ?>
        </div>
        <button type="button" class="button" id="news_image_2_button">画像を選択</button>
        <button type="button" class="button" id="news_image_2_remove" <?php echo $image2 ? '' : 'style="display:none;"'; ?>>画像を削除</button>
      </td>
    </tr>
  </table>

  <script>
  jQuery(document).ready(function($) {
    // 画像1用
    var mediaUploader1;
    $('#news_image_1_button').click(function(e) {
      e.preventDefault();
      if (mediaUploader1) {
        mediaUploader1.open();
        return;
      }
      mediaUploader1 = wp.media({
        title: '画像を選択',
        button: {
          text: '選択'
        },
        multiple: false
      });
      mediaUploader1.on('select', function() {
        var attachment = mediaUploader1.state().get('selection').first().toJSON();
        $('#news_image_1').val(attachment.id);
        $('#news_image_1_preview').html('<img src="' + attachment.url + '" style="max-width: 200px; height: auto;" />');
        $('#news_image_1_remove').show();
      });
      mediaUploader1.open();
    });

    $('#news_image_1_remove').click(function(e) {
      e.preventDefault();
      $('#news_image_1').val('');
      $('#news_image_1_preview').html('');
      $(this).hide();
    });

    // 画像2用
    var mediaUploader2;
    $('#news_image_2_button').click(function(e) {
      e.preventDefault();
      if (mediaUploader2) {
        mediaUploader2.open();
        return;
      }
      mediaUploader2 = wp.media({
        title: '画像を選択',
        button: {
          text: '選択'
        },
        multiple: false
      });
      mediaUploader2.on('select', function() {
        var attachment = mediaUploader2.state().get('selection').first().toJSON();
        $('#news_image_2').val(attachment.id);
        $('#news_image_2_preview').html('<img src="' + attachment.url + '" style="max-width: 200px; height: auto;" />');
        $('#news_image_2_remove').show();
      });
      mediaUploader2.open();
    });

    $('#news_image_2_remove').click(function(e) {
      e.preventDefault();
      $('#news_image_2').val('');
      $('#news_image_2_preview').html('');
      $(this).hide();
    });
  });
  </script>
  <?php
}

/**
 * カスタムフィールドの保存
 */
function save_news_meta($post_id) {
  if (!isset($_POST['news_images_nonce']) || !wp_verify_nonce($_POST['news_images_nonce'], 'news_images_nonce')) {
    return;
  }

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }

  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  if (isset($_POST['news_image_1'])) {
    update_post_meta($post_id, '_news_image_1', sanitize_text_field($_POST['news_image_1']));
  }

  if (isset($_POST['news_image_2'])) {
    update_post_meta($post_id, '_news_image_2', sanitize_text_field($_POST['news_image_2']));
  }
}
add_action('save_post', 'save_news_meta');

/**
 * メディアアップローダーのスクリプトを読み込み
 */
function enqueue_news_admin_scripts($hook) {
  global $post;
  
  if ($hook == 'post-new.php' || $hook == 'post.php') {
    if ('news' === $post->post_type) {
      wp_enqueue_media();
    }
  }
}
add_action('admin_enqueue_scripts', 'enqueue_news_admin_scripts');

/**
 * 最新情報の画像を取得する関数
 */
function get_news_images($post_id) {
  $images = array();
  
  $image1_id = get_post_meta($post_id, '_news_image_1', true);
  $image2_id = get_post_meta($post_id, '_news_image_2', true);
  
  if ($image1_id) {
    $images[] = array(
      'id' => $image1_id,
      'url' => wp_get_attachment_url($image1_id),
      'alt' => get_post_meta($image1_id, '_wp_attachment_image_alt', true)
    );
  }
  
  if ($image2_id) {
    $images[] = array(
      'id' => $image2_id,
      'url' => wp_get_attachment_url($image2_id),
      'alt' => get_post_meta($image2_id, '_wp_attachment_image_alt', true)
    );
  }
  
  return $images;
}

?>