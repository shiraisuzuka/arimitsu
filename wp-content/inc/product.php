<?php
/**
 * カスタム投稿「製品」の設定
 */

/**
 * カスタム投稿タイプ「製品」を登録
 */
function register_product_post_type() {
    $labels = array(
        'name'                  => '製品',
        'singular_name'         => '製品',
        'menu_name'             => '製品',
        'name_admin_bar'        => '製品',
        'archives'              => '製品アーカイブ',
        'attributes'            => '製品属性',
        'parent_item_colon'     => '親製品:',
        'all_items'             => 'すべての製品',
        'add_new_item'          => '新しい製品を追加',
        'add_new'               => '新規追加',
        'new_item'              => '新しい製品',
        'edit_item'             => '製品を編集',
        'update_item'           => '製品を更新',
        'view_item'             => '製品を表示',
        'view_items'            => '製品を表示',
        'search_items'          => '製品を検索',
        'not_found'             => '見つかりませんでした',
        'not_found_in_trash'    => 'ゴミ箱に見つかりませんでした',
        'featured_image'        => 'アイキャッチ画像',
        'set_featured_image'    => 'アイキャッチ画像を設定',
        'remove_featured_image' => 'アイキャッチ画像を削除',
        'use_featured_image'    => 'アイキャッチ画像として使用',
        'insert_into_item'      => '製品に挿入',
        'uploaded_to_this_item' => 'この製品にアップロード',
        'items_list'            => '製品リスト',
        'items_list_navigation' => '製品リストナビゲーション',
        'filter_items_list'     => '製品リストをフィルター',
    );
    
    $args = array(
        'label'                 => '製品',
        'description'           => '製品の投稿タイプ',
        'labels'                => $labels,
        'supports'              => array('title'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-products',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );
    
    register_post_type('product', $args);
}
add_action('init', 'register_product_post_type', 0);

/**
 * 製品のカスタムフィールドを追加
 */
function add_product_custom_fields() {
    // 基本情報
    add_meta_box(
        'product_basic_info',
        '基本情報',
        'product_basic_info_callback',
        'product',
        'normal',
        'high'
    );
    
    // 特徴
    add_meta_box(
        'product_features',
        '特徴',
        'product_features_callback',
        'product',
        'normal',
        'high'
    );
    
    // 製品画像
    add_meta_box(
        'product_images',
        '製品画像',
        'product_images_callback',
        'product',
        'normal',
        'high'
    );
    
    // 製品ラインナップ
    add_meta_box(
        'product_lineup',
        '製品ラインナップ',
        'product_lineup_callback',
        'product',
        'normal',
        'high'
    );
    
    // カテゴリー
    add_meta_box(
        'product_categories',
        'カテゴリー',
        'product_categories_callback',
        'product',
        'normal',
        'high'
    );
    
    // ディスクリプション
    add_meta_box(
        'product_description',
        'ディスクリプション',
        'product_description_callback',
        'product',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_product_custom_fields');

/**
 * 基本情報のカスタムフィールド
 */
function product_basic_info_callback($post) {
    wp_nonce_field(basename(__FILE__), 'product_nonce');
    
    $basic_copy = get_post_meta($post->ID, '_product_basic_copy', true);
    $catalog_pdf = get_post_meta($post->ID, '_product_catalog_pdf', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="product_basic_copy">コピー <span style="color: red;">*</span></label></th>
            <td>
                <textarea id="product_basic_copy" name="product_basic_copy" rows="5" cols="50" style="width: 100%;" required><?php echo esc_textarea($basic_copy); ?></textarea>
            </td>
        </tr>
        <tr>
            <th><label for="product_catalog_pdf">カタログのPDFリンク <span style="color: red;">*</span></label></th>
            <td>
                <input type="url" id="product_catalog_pdf" name="product_catalog_pdf" value="<?php echo esc_url($catalog_pdf); ?>" style="width: 100%;" required />
            </td>
        </tr>
    </table>
    <?php
}

/**
 * 特徴のカスタムフィールド
 */
function product_features_callback($post) {
    $features_text = get_post_meta($post->ID, '_product_features_text', true);
    $features_image1 = get_post_meta($post->ID, '_product_features_image1', true);
    $features_image2 = get_post_meta($post->ID, '_product_features_image2', true);
    $video_link = get_post_meta($post->ID, '_product_video_link', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="product_features_text">テキスト</label></th>
            <td>
                <textarea id="product_features_text" name="product_features_text" rows="5" cols="50" style="width: 100%;"><?php echo esc_textarea($features_text); ?></textarea>
            </td>
        </tr>
        <tr>
            <th><label for="product_features_image1">画像1</label></th>
            <td>
                <input type="hidden" id="product_features_image1" name="product_features_image1" value="<?php echo esc_attr($features_image1); ?>" />
                <div id="features_image1_preview">
                    <?php if ($features_image1): ?>
                        <img src="<?php echo wp_get_attachment_url($features_image1); ?>" style="max-width: 200px; height: auto;" />
                    <?php endif; ?>
                </div>
                <button type="button" class="button" onclick="openMediaUploader('product_features_image1', 'features_image1_preview')">画像を選択</button>
                <button type="button" class="button" onclick="removeImage('product_features_image1', 'features_image1_preview')">画像を削除</button>
            </td>
        </tr>
        <tr>
            <th><label for="product_features_image2">画像2</label></th>
            <td>
                <input type="hidden" id="product_features_image2" name="product_features_image2" value="<?php echo esc_attr($features_image2); ?>" />
                <div id="features_image2_preview">
                    <?php if ($features_image2): ?>
                        <img src="<?php echo wp_get_attachment_url($features_image2); ?>" style="max-width: 200px; height: auto;" />
                    <?php endif; ?>
                </div>
                <button type="button" class="button" onclick="openMediaUploader('product_features_image2', 'features_image2_preview')">画像を選択</button>
                <button type="button" class="button" onclick="removeImage('product_features_image2', 'features_image2_preview')">画像を削除</button>
            </td>
        </tr>
        <tr>
            <th><label for="product_video_link">動画リンク</label></th>
            <td>
                <input type="url" id="product_video_link" name="product_video_link" value="<?php echo esc_url($video_link); ?>" style="width: 100%;" />
            </td>
        </tr>
    </table>
    <?php
}

/**
 * 製品画像のカスタムフィールド
 */
function product_images_callback($post) {
    ?>
    <table class="form-table">
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <?php
            $image_id = get_post_meta($post->ID, "_product_image{$i}", true);
            ?>
            <tr>
                <th><label for="product_image<?php echo $i; ?>">製品画像<?php echo $i; ?></label></th>
                <td>
                    <input type="hidden" id="product_image<?php echo $i; ?>" name="product_image<?php echo $i; ?>" value="<?php echo esc_attr($image_id); ?>" />
                    <div id="product_image<?php echo $i; ?>_preview">
                        <?php if ($image_id): ?>
                            <img src="<?php echo wp_get_attachment_url($image_id); ?>" style="max-width: 200px; height: auto;" />
                        <?php endif; ?>
                    </div>
                    <button type="button" class="button" onclick="openMediaUploader('product_image<?php echo $i; ?>', 'product_image<?php echo $i; ?>_preview')">画像を選択</button>
                    <button type="button" class="button" onclick="removeImage('product_image<?php echo $i; ?>', 'product_image<?php echo $i; ?>_preview')">画像を削除</button>
                </td>
            </tr>
        <?php endfor; ?>
    </table>
    <?php
}

/**
 * 製品ラインナップのカスタムフィールド
 */
function product_lineup_callback($post) {
    $lineup_image = get_post_meta($post->ID, '_product_lineup_image', true);
    $lineup_model = get_post_meta($post->ID, '_product_lineup_model', true);
    $lineup_name = get_post_meta($post->ID, '_product_lineup_name', true);
    $lineup_link = get_post_meta($post->ID, '_product_lineup_link', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="product_lineup_image">画像 <span style="color: red;">*</span></label></th>
            <td>
                <input type="hidden" id="product_lineup_image" name="product_lineup_image" value="<?php echo esc_attr($lineup_image); ?>" required />
                <div id="lineup_image_preview">
                    <?php if ($lineup_image): ?>
                        <img src="<?php echo wp_get_attachment_url($lineup_image); ?>" style="max-width: 200px; height: auto;" />
                    <?php endif; ?>
                </div>
                <button type="button" class="button" onclick="openMediaUploader('product_lineup_image', 'lineup_image_preview')">画像を選択</button>
                <button type="button" class="button" onclick="removeImage('product_lineup_image', 'lineup_image_preview')">画像を削除</button>
            </td>
        </tr>
        <tr>
            <th><label for="product_lineup_model">型番 <span style="color: red;">*</span></label></th>
            <td>
                <textarea id="product_lineup_model" name="product_lineup_model" rows="3" cols="50" style="width: 100%;" required><?php echo esc_textarea($lineup_model); ?></textarea>
            </td>
        </tr>
        <tr>
            <th><label for="product_lineup_name">名称 <span style="color: red;">*</span></label></th>
            <td>
                <textarea id="product_lineup_name" name="product_lineup_name" rows="3" cols="50" style="width: 100%;" required><?php echo esc_textarea($lineup_name); ?></textarea>
            </td>
        </tr>
        <tr>
            <th><label for="product_lineup_link">リンク設定 <span style="color: red;">*</span></label></th>
            <td>
                <input type="url" id="product_lineup_link" name="product_lineup_link" value="<?php echo esc_url($lineup_link); ?>" style="width: 100%;" required />
            </td>
        </tr>
    </table>
    <?php
}

/**
 * カテゴリーのカスタムフィールド
 */
function product_categories_callback($post) {
    // 製品から選ぶカテゴリー
    $product_categories = get_post_meta($post->ID, '_product_categories', true);
    if (!is_array($product_categories)) {
        $product_categories = array();
    }
    
    // 目的・用途から選ぶカテゴリー
    $purpose_categories = get_post_meta($post->ID, '_purpose_categories', true);
    if (!is_array($purpose_categories)) {
        $purpose_categories = array();
    }
    
    $product_options = array(
        'agricultural_machinery' => '農業機械',
        'pump' => 'ポンプ',
        'cleaning_machine' => '洗浄機',
        'attachment' => 'アタッチメント（洗浄機のノズル等）',
        'mist' => 'ミスト',
        'other_product' => 'その他（オートマット、トルミング等）'
    );
    
    $purpose_options = array(
        'spray_chemicals' => '薬剤/肥料をまく',
        'high_pressure_motor' => '高圧で洗浄する（モーター）',
        'high_pressure_engine' => '高圧で洗浄する（エンジン）',
        'high_pressure_hot_water' => '高圧で洗浄する（温水）',
        'wash_containers' => '容器/器具/パレット/部品を洗う',
        'wash_other_items' => 'その他のものを洗う',
        'foam_wash' => '泡で洗う',
        'water_pressure_supply' => '水圧を供給する',
        'cooling_dust_deodorizing' => '冷却/防塵/消臭する',
        'other_purpose' => 'その他'
    );
    ?>
    <table class="form-table">
        <tr>
            <th><strong>製品から選ぶ</strong></th>
            <td>
                <?php foreach ($product_options as $key => $label): ?>
                    <label style="display: inline-block; margin-right: 15px; margin-bottom: 5px;">
                        <input type="checkbox" name="product_categories[]" value="<?php echo esc_attr($key); ?>" <?php checked(in_array($key, $product_categories)); ?> />
                        <?php echo esc_html($label); ?>
                    </label>
                <?php endforeach; ?>
            </td>
        </tr>
        <tr>
            <th><strong>目的・用途から選ぶ</strong></th>
            <td>
                <?php foreach ($purpose_options as $key => $label): ?>
                    <label style="display: inline-block; margin-right: 15px; margin-bottom: 5px;">
                        <input type="checkbox" name="purpose_categories[]" value="<?php echo esc_attr($key); ?>" <?php checked(in_array($key, $purpose_categories)); ?> />
                        <?php echo esc_html($label); ?>
                    </label>
                <?php endforeach; ?>
            </td>
        </tr>
    </table>
    <?php
}

/**
 * ディスクリプションのカスタムフィールド
 */
function product_description_callback($post) {
    $description = get_post_meta($post->ID, '_product_description', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="product_description">ディスクリプション</label></th>
            <td>
                <textarea id="product_description" name="product_description" rows="4" cols="50" style="width: 100%;"><?php echo esc_textarea($description); ?></textarea>
            </td>
        </tr>
    </table>
    <?php
}

/**
 * カスタムフィールドの保存
 */
function save_product_custom_fields($post_id) {
    // nonce チェック
    if (!isset($_POST['product_nonce']) || !wp_verify_nonce($_POST['product_nonce'], basename(__FILE__))) {
        return $post_id;
    }
    
    // 自動保存の場合は何もしない
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    
    // 権限チェック
    if (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }
    
    // 必須項目のバリデーション
    $errors = array();
    
    // 基本情報の必須チェック
    if (empty($_POST['product_basic_copy'])) {
        $errors[] = 'コピーは必須項目です。';
    }
    if (empty($_POST['product_catalog_pdf'])) {
        $errors[] = 'カタログのPDFリンクは必須項目です。';
    }
    
    // 製品ラインナップの必須チェック
    if (empty($_POST['product_lineup_image'])) {
        $errors[] = '製品ラインナップの画像は必須項目です。';
    }
    if (empty($_POST['product_lineup_model'])) {
        $errors[] = '型番は必須項目です。';
    }
    if (empty($_POST['product_lineup_name'])) {
        $errors[] = '名称は必須項目です。';
    }
    if (empty($_POST['product_lineup_link'])) {
        $errors[] = 'リンク設定は必須項目です。';
    }
    
    // エラーがある場合は管理画面にメッセージを表示
    if (!empty($errors)) {
        foreach ($errors as $error) {
            add_action('admin_notices', function() use ($error) {
                echo '<div class="notice notice-error is-dismissible"><p>' . esc_html($error) . '</p></div>';
            });
        }
        return $post_id;
    }
    
    // 基本情報
    if (isset($_POST['product_basic_copy'])) {
        update_post_meta($post_id, '_product_basic_copy', sanitize_textarea_field($_POST['product_basic_copy']));
    }
    if (isset($_POST['product_catalog_pdf'])) {
        update_post_meta($post_id, '_product_catalog_pdf', esc_url_raw($_POST['product_catalog_pdf']));
    }
    
    // 特徴
    if (isset($_POST['product_features_text'])) {
        update_post_meta($post_id, '_product_features_text', sanitize_textarea_field($_POST['product_features_text']));
    }
    if (isset($_POST['product_features_image1'])) {
        update_post_meta($post_id, '_product_features_image1', intval($_POST['product_features_image1']));
    }
    if (isset($_POST['product_features_image2'])) {
        update_post_meta($post_id, '_product_features_image2', intval($_POST['product_features_image2']));
    }
    if (isset($_POST['product_video_link'])) {
        update_post_meta($post_id, '_product_video_link', esc_url_raw($_POST['product_video_link']));
    }
    
    // 製品画像
    for ($i = 1; $i <= 5; $i++) {
        if (isset($_POST["product_image{$i}"])) {
            update_post_meta($post_id, "_product_image{$i}", intval($_POST["product_image{$i}"]));
        }
    }
    
    // 製品ラインナップ
    if (isset($_POST['product_lineup_image'])) {
        update_post_meta($post_id, '_product_lineup_image', intval($_POST['product_lineup_image']));
    }
    if (isset($_POST['product_lineup_model'])) {
        update_post_meta($post_id, '_product_lineup_model', sanitize_textarea_field($_POST['product_lineup_model']));
    }
    if (isset($_POST['product_lineup_name'])) {
        update_post_meta($post_id, '_product_lineup_name', sanitize_textarea_field($_POST['product_lineup_name']));
    }
    if (isset($_POST['product_lineup_link'])) {
        update_post_meta($post_id, '_product_lineup_link', esc_url_raw($_POST['product_lineup_link']));
    }
    
    // カテゴリー
    if (isset($_POST['product_categories']) && is_array($_POST['product_categories'])) {
        $product_categories = array_map('sanitize_text_field', $_POST['product_categories']);
        update_post_meta($post_id, '_product_categories', $product_categories);
    } else {
        update_post_meta($post_id, '_product_categories', array());
    }
    
    if (isset($_POST['purpose_categories']) && is_array($_POST['purpose_categories'])) {
        $purpose_categories = array_map('sanitize_text_field', $_POST['purpose_categories']);
        update_post_meta($post_id, '_purpose_categories', $purpose_categories);
    } else {
        update_post_meta($post_id, '_purpose_categories', array());
    }
    
    // ディスクリプション
    if (isset($_POST['product_description'])) {
        update_post_meta($post_id, '_product_description', sanitize_textarea_field($_POST['product_description']));
    }
}
add_action('save_post', 'save_product_custom_fields');

/**
 * 管理画面にメディアアップローダーのJavaScriptを追加
 */
function product_admin_scripts() {
    global $post_type;
    if ($post_type == 'product') {
        wp_enqueue_media();
        ?>
        <script>
        function openMediaUploader(inputId, previewId) {
            var mediaUploader = wp.media({
                title: '画像を選択',
                button: {
                    text: '選択'
                },
                multiple: false
            });
            
            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                document.getElementById(inputId).value = attachment.id;
                document.getElementById(previewId).innerHTML = '<img src="' + attachment.url + '" style="max-width: 200px; height: auto;" />';
            });
            
            mediaUploader.open();
        }
        
        function removeImage(inputId, previewId) {
            document.getElementById(inputId).value = '';
            document.getElementById(previewId).innerHTML = '';
        }
        </script>
        <?php
    }
}
add_action('admin_footer', 'product_admin_scripts');
?>
