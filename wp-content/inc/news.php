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
    'supports' => array('title', 'editor', 'revisions'),
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

/**
 * 最新情報用カスタムフィールドの追加
 */
function add_news_meta_boxes() {
  add_meta_box(
    'news_content',
    '本文テキスト',
    'news_content_callback',
    'news',
    'normal',
    'high'
  );
  
  add_meta_box(
    'news_images',
    '画像アップロード',
    'news_images_callback',
    'news',
    'normal',
    'high'
  );
}
add_action('add_meta_boxes', 'add_news_meta_boxes');

/**
 * 本文テキスト用メタボックスのコールバック
 */
function news_content_callback($post) {
  wp_nonce_field('news_content_nonce', 'news_content_nonce');
  
  $content = get_post_meta($post->ID, '_news_content', true);
  
  ?>
  <table class="form-table">
    <tr>
      <td>
        <textarea id="news_content" name="news_content" rows="10" style="width: 100%;" required><?php echo esc_textarea($content); ?></textarea>
        <p class="description">本文テキストを入力してください</p>
      </td>
    </tr>
  </table>
  <?php
}

/**
 * 画像アップロード用メタボックスのコールバック
 */
function news_images_callback($post) {
  wp_nonce_field('news_images_nonce', 'news_images_nonce');
  
  ?>
  <table class="form-table">
    <?php for ($i = 1; $i <= 6; $i++): 
      $image = get_post_meta($post->ID, '_news_image_' . $i, true);
    ?>
    <tr>
      <th><label for="news_image_<?php echo $i; ?>">画像<?php echo $i; ?></label></th>
      <td>
        <input type="hidden" id="news_image_<?php echo $i; ?>" name="news_image_<?php echo $i; ?>" value="<?php echo esc_attr($image); ?>" />
        <div id="news_image_<?php echo $i; ?>_preview">
          <?php if ($image): ?>
            <img src="<?php echo esc_url(wp_get_attachment_url($image)); ?>" style="max-width: 200px; height: auto;" />
          <?php endif; ?>
        </div>
        <button type="button" class="button" id="news_image_<?php echo $i; ?>_button">画像を選択</button>
        <button type="button" class="button" id="news_image_<?php echo $i; ?>_remove" <?php echo $image ? '' : 'style="display:none;"'; ?>>画像を削除</button>
      </td>
    </tr>
    <?php endfor; ?>
  </table>

  <script>
  jQuery(document).ready(function($) {
    for (var i = 1; i <= 6; i++) {
      (function(index) {
        var mediaUploader;
        $('#news_image_' + index + '_button').click(function(e) {
          e.preventDefault();
          if (mediaUploader) {
            mediaUploader.open();
            return;
          }
          mediaUploader = wp.media({
            title: '画像を選択',
            button: {
              text: '選択'
            },
            multiple: false
          });
          mediaUploader.on('select', function() {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#news_image_' + index).val(attachment.id);
            $('#news_image_' + index + '_preview').html('<img src="' + attachment.url + '" style="max-width: 200px; height: auto;" />');
            $('#news_image_' + index + '_remove').show();
          });
          mediaUploader.open();
        });

        $('#news_image_' + index + '_remove').click(function(e) {
          e.preventDefault();
          $('#news_image_' + index).val('');
          $('#news_image_' + index + '_preview').html('');
          $(this).hide();
        });
      })(i);
    }
  });
  </script>
  <?php
}

/**
 * カスタムフィールドの保存
 */
function save_news_meta($post_id) {
  // コンテンツフィールドの保存
  if (isset($_POST['news_content_nonce']) && wp_verify_nonce($_POST['news_content_nonce'], 'news_content_nonce')) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
      return;
    }

    if (!current_user_can('edit_post', $post_id)) {
      return;
    }

    if (isset($_POST['news_content'])) {
      update_post_meta($post_id, '_news_content', sanitize_textarea_field($_POST['news_content']));
    }
  }

  // 画像フィールドの保存
  if (isset($_POST['news_images_nonce']) && wp_verify_nonce($_POST['news_images_nonce'], 'news_images_nonce')) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
      return;
    }

    if (!current_user_can('edit_post', $post_id)) {
      return;
    }

    for ($i = 1; $i <= 6; $i++) {
      if (isset($_POST['news_image_' . $i])) {
        update_post_meta($post_id, '_news_image_' . $i, sanitize_text_field($_POST['news_image_' . $i]));
      }
    }
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
  
  for ($i = 1; $i <= 6; $i++) {
    $image_id = get_post_meta($post_id, '_news_image_' . $i, true);
    
    if ($image_id) {
      $images[] = array(
        'id' => $image_id,
        'url' => wp_get_attachment_url($image_id),
        'alt' => get_post_meta($image_id, '_wp_attachment_image_alt', true)
      );
    }
  }
  
  return $images;
}

/**
 * 最新情報の本文テキストを取得する関数（改行を<br>に変換）
 */
function get_news_content($post_id) {
  $content = get_post_meta($post_id, '_news_content', true);
  
  // 改行を<br>タグに変換
  return nl2br(esc_html($content));
}

?>