<?php
/**
 * カスタム投稿「製品」の設定
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
        'supports'              => array('title', 'editor'),
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
    
    $listing_image = get_post_meta($post->ID, '_product_listing_image', true);
    $basic_copy = get_post_meta($post->ID, '_product_basic_copy', true);
    $catalog_name1 = get_post_meta($post->ID, '_product_catalog_name1', true);
    $catalog_link1 = get_post_meta($post->ID, '_product_catalog_pdf', true);
    $catalog_name2 = get_post_meta($post->ID, '_product_catalog_name2', true);
    $catalog_link2 = get_post_meta($post->ID, '_product_catalog_pdf2', true);
    $catalog_name3 = get_post_meta($post->ID, '_product_catalog_name3', true);
    $catalog_link3 = get_post_meta($post->ID, '_product_catalog_pdf3', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="product_listing_image">一覧画像 <span style="color: red;">*</span></label></th>
            <td>
                <input type="hidden" id="product_listing_image" name="product_listing_image" value="<?php echo esc_attr($listing_image); ?>" required />
                <div id="listing_image_preview">
                    <?php if ($listing_image): ?>
                        <img src="<?php echo wp_get_attachment_url($listing_image); ?>" style="max-width: 200px; height: auto;" />
                    <?php endif; ?>
                </div>
                <button type="button" class="button" onclick="openMediaUploader('product_listing_image', 'listing_image_preview')">画像を選択</button>
                <button type="button" class="button" onclick="removeImage('product_listing_image', 'listing_image_preview')">画像を削除</button>
            </td>
        </tr>
        <tr>
            <th><label for="product_basic_copy">コピー <span style="color: red;">*</span></label></th>
            <td>
                <textarea id="product_basic_copy" name="product_basic_copy" rows="5" cols="50" style="width: 100%;" required><?php echo esc_textarea($basic_copy); ?></textarea>
            </td>
        </tr>
        <tr>
            <th><label for="product_catalog_name1">カタログ名1</label></th>
            <td>
                <input type="text" id="product_catalog_name1" name="product_catalog_name1" value="<?php echo esc_attr($catalog_name1); ?>" style="width: 100%;" />
            </td>
        </tr>
        <tr>
            <th><label for="product_catalog_pdf">カタログリンク1</label></th>
            <td>
                <input type="url" id="product_catalog_pdf" name="product_catalog_pdf" value="<?php echo esc_url($catalog_link1); ?>" style="width: 100%;" />
            </td>
        </tr>
        <tr>
            <th><label for="product_catalog_name2">カタログ名2</label></th>
            <td>
                <input type="text" id="product_catalog_name2" name="product_catalog_name2" value="<?php echo esc_attr($catalog_name2); ?>" style="width: 100%;" />
            </td>
        </tr>
        <tr>
            <th><label for="product_catalog_pdf2">カタログリンク2</label></th>
            <td>
                <input type="url" id="product_catalog_pdf2" name="product_catalog_pdf2" value="<?php echo esc_url($catalog_link2); ?>" style="width: 100%;" />
            </td>
        </tr>
        <tr>
            <th><label for="product_catalog_name3">カタログ名3</label></th>
            <td>
                <input type="text" id="product_catalog_name3" name="product_catalog_name3" value="<?php echo esc_attr($catalog_name3); ?>" style="width: 100%;" />
            </td>
        </tr>
        <tr>
            <th><label for="product_catalog_pdf3">カタログリンク3</label></th>
            <td>
                <input type="url" id="product_catalog_pdf3" name="product_catalog_pdf3" value="<?php echo esc_url($catalog_link3); ?>" style="width: 100%;" />
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
    $features_image3 = get_post_meta($post->ID, '_product_features_image3', true);
    $features_image4 = get_post_meta($post->ID, '_product_features_image4', true);
    $features_image5 = get_post_meta($post->ID, '_product_features_image5', true);
    $video_link = get_post_meta($post->ID, '_product_video_link', true);
    $customer_voice_link = get_post_meta($post->ID, '_product_customer_voice_link', true);
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
            <th><label for="product_features_image3">画像3</label></th>
            <td>
                <input type="hidden" id="product_features_image3" name="product_features_image3" value="<?php echo esc_attr($features_image3); ?>" />
                <div id="features_image3_preview">
                    <?php if ($features_image3): ?>
                        <img src="<?php echo wp_get_attachment_url($features_image3); ?>" style="max-width: 200px; height: auto;" />
                    <?php endif; ?>
                </div>
                <button type="button" class="button" onclick="openMediaUploader('product_features_image3', 'features_image3_preview')">画像を選択</button>
                <button type="button" class="button" onclick="removeImage('product_features_image3', 'features_image3_preview')">画像を削除</button>
            </td>
        </tr>
        <tr>
            <th><label for="product_features_image4">画像4</label></th>
            <td>
                <input type="hidden" id="product_features_image4" name="product_features_image4" value="<?php echo esc_attr($features_image4); ?>" />
                <div id="features_image4_preview">
                    <?php if ($features_image4): ?>
                        <img src="<?php echo wp_get_attachment_url($features_image4); ?>" style="max-width: 200px; height: auto;" />
                    <?php endif; ?>
                </div>
                <button type="button" class="button" onclick="openMediaUploader('product_features_image4', 'features_image4_preview')">画像を選択</button>
                <button type="button" class="button" onclick="removeImage('product_features_image4', 'features_image4_preview')">画像を削除</button>
            </td>
        </tr>
        <tr>
            <th><label for="product_features_image5">画像5</label></th>
            <td>
                <input type="hidden" id="product_features_image5" name="product_features_image5" value="<?php echo esc_attr($features_image5); ?>" />
                <div id="features_image5_preview">
                    <?php if ($features_image5): ?>
                        <img src="<?php echo wp_get_attachment_url($features_image5); ?>" style="max-width: 200px; height: auto;" />
                    <?php endif; ?>
                </div>
                <button type="button" class="button" onclick="openMediaUploader('product_features_image5', 'features_image5_preview')">画像を選択</button>
                <button type="button" class="button" onclick="removeImage('product_features_image5', 'features_image5_preview')">画像を削除</button>
            </td>
        </tr>
        <tr>
            <th><label for="product_video_link">動画リンク</label></th>
            <td>
                <input type="url" id="product_video_link" name="product_video_link" value="<?php echo esc_url($video_link); ?>" style="width: 100%;" />
            </td>
        </tr>
        <tr>
            <th><label for="product_customer_voice_link">お客様の声</label></th>
            <td>
                <input type="url" id="product_customer_voice_link" name="product_customer_voice_link" value="<?php echo esc_url($customer_voice_link); ?>" style="width: 100%;" />
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
    $lineup_data = get_post_meta($post->ID, '_product_lineup_data', true);
    if (!is_array($lineup_data) || empty($lineup_data)) {
        $legacy_image = get_post_meta($post->ID, '_product_lineup_image', true);
        $legacy_model = get_post_meta($post->ID, '_product_lineup_model', true);
        $legacy_name = get_post_meta($post->ID, '_product_lineup_name', true);
        $legacy_link = get_post_meta($post->ID, '_product_lineup_link', true);
        
        if ($legacy_image || $legacy_model || $legacy_name || $legacy_link) {
            $lineup_data = array(
                array(
                    'image' => $legacy_image,
                    'model' => $legacy_model,
                    'name' => $legacy_name,
                    'link' => $legacy_link
                )
            );
        } else {
            $lineup_data = array();
        }
    }
    ?>
    <div id="product-lineup-repeater">
        <div id="lineup-entries">
            <?php if (!empty($lineup_data)): ?>
                <?php foreach ($lineup_data as $index => $entry): ?>
                    <div class="lineup-entry" data-index="<?php echo $index; ?>">
                        <div class="lineup-entry-header">
                            <h4>製品ラインナップ <?php echo $index + 1; ?></h4>
                            <button type="button" class="button lineup-remove" onclick="removeLineupEntry(this)">削除</button>
                        </div>
                        <table class="form-table lineup-table">
                            <tr>
                                <th><label>画像 <span style="color: red;">*</span></label></th>
                                <td>
                                    <input type="hidden" name="product_lineup[<?php echo $index; ?>][image]" value="<?php echo esc_attr($entry['image']); ?>" class="lineup-image-input" />
                                    <div class="lineup-image-preview">
                                        <?php if (!empty($entry['image'])): ?>
                                            <img src="<?php echo wp_get_attachment_url($entry['image']); ?>" style="max-width: 200px; height: auto;" />
                                        <?php endif; ?>
                                    </div>
                                    <button type="button" class="button lineup-select-image">画像を選択</button>
                                    <button type="button" class="button lineup-remove-image">画像を削除</button>
                                </td>
                            </tr>
                            <tr>
                                <th><label>型番</label></th>
                                <td>
                                    <textarea name="product_lineup[<?php echo $index; ?>][model]" rows="3" cols="50" style="width: 100%;" class="lineup-model"><?php echo esc_textarea($entry['model']); ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <th><label>名称</label></th>
                                <td>
                                    <textarea name="product_lineup[<?php echo $index; ?>][name]" rows="3" cols="50" style="width: 100%;" class="lineup-name"><?php echo esc_textarea($entry['name']); ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <th><label>リンク設定</label></th>
                                <td>
                                    <input type="url" name="product_lineup[<?php echo $index; ?>][link]" value="<?php echo esc_url($entry['link']); ?>" style="width: 100%;" class="lineup-link" />
                                </td>
                            </tr>
                        </table>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-lineup-message" style="color: #666; font-style: italic;">製品ラインナップが設定されていません。必要に応じて追加してください。</p>
            <?php endif; ?>
        </div>
        <div class="lineup-actions">
            <button type="button" class="button button-primary" onclick="addLineupEntry()">ラインナップを追加</button>
        </div>
    </div>
    
    <style>
    .lineup-entry {
        border: 1px solid #ddd;
        padding: 15px;
        margin-bottom: 15px;
        background: #f9f9f9;
        border-radius: 4px;
    }
    .lineup-entry-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
        border-bottom: 1px solid #ddd;
        padding-bottom: 10px;
    }
    .lineup-entry-header h4 {
        margin: 0;
        color: #333;
    }
    .lineup-table {
        margin-top: 10px;
    }
    .lineup-actions {
        margin-top: 20px;
        text-align: center;
    }
    .lineup-remove {
        background: #dc3232;
        border-color: #dc3232;
        color: white;
    }
    .lineup-remove:hover {
        background: #a02020;
        border-color: #a02020;
    }
    </style>
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
 * 製品のカスタムフィールド保存処理
 */
function save_product_custom_fields($post_id, $post, $update) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (wp_is_post_revision($post_id)) return;
    
    if ($post->post_type !== 'product') return;
    
    if (!current_user_can('edit_post', $post_id)) return;
    
    if (!isset($_POST['product_listing_image']) && !isset($_POST['product_basic_copy']) && !isset($_POST['product_catalog_name1']) && !isset($_POST['product_catalog_pdf']) && !isset($_POST['product_catalog_name2']) && !isset($_POST['product_catalog_pdf2']) && !isset($_POST['product_catalog_name3']) && !isset($_POST['product_catalog_pdf3'])) {
        return;
    }
    
    if (isset($_POST['product_nonce']) && !wp_verify_nonce($_POST['product_nonce'], basename(__FILE__))) {
        return;
    }
    
    // 公開時または公開済み投稿の編集時に必須項目をチェック
    $original_post_status = isset($_POST['original_post_status']) ? $_POST['original_post_status'] : '';
    $current_post_status = $post->post_status;
    
    // 新規公開または既に公開済みの投稿の場合はバリデーション実行
    if ($current_post_status === 'publish' || $original_post_status === 'publish') {
        $errors = array();
        
        // 基本情報の必須チェック
        if (empty($_POST['product_listing_image']) || $_POST['product_listing_image'] === '0' || !intval($_POST['product_listing_image'])) {
            $errors[] = '一覧画像は必須項目です。';
        }
        if (empty($_POST['product_basic_copy']) || !trim($_POST['product_basic_copy'])) {
            $errors[] = 'コピーは必須項目です。';
        }
        
        // 製品ラインナップのバリデーション
        if (isset($_POST['product_lineup']) && is_array($_POST['product_lineup'])) {
            foreach ($_POST['product_lineup'] as $index => $lineup) {
                $has_content = !empty($lineup['image']) || !empty($lineup['model']) || !empty($lineup['name']) || !empty($lineup['link']);
                
                if ($has_content) {
                    $lineup_num = $index + 1;
                    if (empty($lineup['image']) || $lineup['image'] === '0' || !intval($lineup['image'])) {
                        $errors[] = "製品ラインナップ {$lineup_num} の画像は必須項目です。";
                    }
                }
            }
        }
        
        // エラーがある場合は保存を中止
        if (!empty($errors)) {
            $error_message = ($current_post_status === 'publish' && $original_post_status === 'publish') 
                ? '必須項目が未入力のため保存できません。' 
                : '必須項目が未入力のため公開できません。';
            
            wp_die(
                $error_message . '<br><br>• ' . implode('<br>• ', $errors) . '<br><br><a href="javascript:history.back()">戻る</a>',
                '保存エラー',
                array('back_link' => true)
            );
        }
    }
    
    // 基本情報
    if (isset($_POST['product_listing_image'])) {
        update_post_meta($post_id, '_product_listing_image', intval($_POST['product_listing_image']));
    }
    if (isset($_POST['product_basic_copy'])) {
        update_post_meta($post_id, '_product_basic_copy', sanitize_textarea_field($_POST['product_basic_copy']));
    }
    if (isset($_POST['product_catalog_name1'])) {
        update_post_meta($post_id, '_product_catalog_name1', sanitize_text_field($_POST['product_catalog_name1']));
    }
    if (isset($_POST['product_catalog_pdf'])) {
        update_post_meta($post_id, '_product_catalog_pdf', esc_url_raw($_POST['product_catalog_pdf']));
    }
    if (isset($_POST['product_catalog_name2'])) {
        update_post_meta($post_id, '_product_catalog_name2', sanitize_text_field($_POST['product_catalog_name2']));
    }
    if (isset($_POST['product_catalog_pdf2'])) {
        update_post_meta($post_id, '_product_catalog_pdf2', esc_url_raw($_POST['product_catalog_pdf2']));
    }
    if (isset($_POST['product_catalog_name3'])) {
        update_post_meta($post_id, '_product_catalog_name3', sanitize_text_field($_POST['product_catalog_name3']));
    }
    if (isset($_POST['product_catalog_pdf3'])) {
        update_post_meta($post_id, '_product_catalog_pdf3', esc_url_raw($_POST['product_catalog_pdf3']));
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
    if (isset($_POST['product_features_image3'])) {
        update_post_meta($post_id, '_product_features_image3', intval($_POST['product_features_image3']));
    }
    if (isset($_POST['product_features_image4'])) {
        update_post_meta($post_id, '_product_features_image4', intval($_POST['product_features_image4']));
    }
    if (isset($_POST['product_features_image5'])) {
        update_post_meta($post_id, '_product_features_image5', intval($_POST['product_features_image5']));
    }
    if (isset($_POST['product_video_link'])) {
        update_post_meta($post_id, '_product_video_link', esc_url_raw($_POST['product_video_link']));
    }
    if (isset($_POST['product_customer_voice_link'])) {
        update_post_meta($post_id, '_product_customer_voice_link', esc_url_raw($_POST['product_customer_voice_link']));
    }
    
    // 製品画像
    for ($i = 1; $i <= 5; $i++) {
        if (isset($_POST["product_image{$i}"])) {
            update_post_meta($post_id, "_product_image{$i}", intval($_POST["product_image{$i}"]));
        }
    }
    
    // 製品ラインナップ
    if (isset($_POST['product_lineup']) && is_array($_POST['product_lineup'])) {
        $lineup_data = array();
        foreach ($_POST['product_lineup'] as $lineup) {
            $has_content = !empty($lineup['image']) || !empty($lineup['model']) || !empty($lineup['name']) || !empty($lineup['link']);
            
            if ($has_content) {
                $lineup_data[] = array(
                    'image' => intval($lineup['image']),
                    'model' => sanitize_textarea_field($lineup['model']),
                    'name' => sanitize_textarea_field($lineup['name']),
                    'link' => esc_url_raw($lineup['link'])
                );
            }
        }
        
        if (!empty($lineup_data)) {
            update_post_meta($post_id, '_product_lineup_data', $lineup_data);
        } else {
            delete_post_meta($post_id, '_product_lineup_data');
        }
        
        delete_post_meta($post_id, '_product_lineup_image');
        delete_post_meta($post_id, '_product_lineup_model');
        delete_post_meta($post_id, '_product_lineup_name');
        delete_post_meta($post_id, '_product_lineup_link');
    } else {
        delete_post_meta($post_id, '_product_lineup_data');
        delete_post_meta($post_id, '_product_lineup_image');
        delete_post_meta($post_id, '_product_lineup_model');
        delete_post_meta($post_id, '_product_lineup_name');
        delete_post_meta($post_id, '_product_lineup_link');
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


add_action('save_post', 'save_product_custom_fields', 10, 3);



/**
 * 管理画面でメディアライブラリを有効化
 */
function product_enqueue_admin_scripts($hook) {
    global $post_type;
    
    // 製品の投稿編集画面でのみ実行
    if (($hook == 'post-new.php' || $hook == 'post.php') && $post_type == 'product') {
        wp_enqueue_media();
        
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_style('thickbox');
        

    }
}
add_action('admin_enqueue_scripts', 'product_enqueue_admin_scripts');

/**
 * 管理画面にメディアアップローダーのJavaScriptを追加
 */
function product_admin_scripts() {
    global $post_type;
    if ($post_type == 'product') {
        ?>
        <script type="text/javascript">
        jQuery(document).ready(function($) {
            if (typeof wp === 'undefined' || typeof wp.media === 'undefined') {
                return;
            }
            
            window.openMediaUploader = function(inputId, previewId) {
                var mediaUploader = wp.media({
                    title: '画像を選択',
                    button: {
                        text: '選択'
                    },
                    multiple: false,
                    library: {
                        type: 'image'
                    }
                });
                
                mediaUploader.on('select', function() {
                    var attachment = mediaUploader.state().get('selection').first().toJSON();
                    $('#' + inputId).val(attachment.id);
                    $('#' + previewId).html('<img src="' + attachment.url + '" style="max-width: 200px; height: auto;" />');
                });
                
                mediaUploader.open();
            };
            
            window.removeImage = function(inputId, previewId) {
                $('#' + inputId).val('');
                $('#' + previewId).html('');
            };
            
            var lineupIndex = $('.lineup-entry').length;
            
            window.addLineupEntry = function() {
                var newEntry = $(`
                    <div class="lineup-entry" data-index="${lineupIndex}">
                        <div class="lineup-entry-header">
                            <h4>製品ラインナップ ${lineupIndex + 1}</h4>
                            <button type="button" class="button lineup-remove" onclick="removeLineupEntry(this)">削除</button>
                        </div>
                        <table class="form-table lineup-table">
                            <tr>
                                <th><label>画像 <span style="color: red;">*</span></label></th>
                                <td>
                                    <input type="hidden" name="product_lineup[${lineupIndex}][image]" value="" class="lineup-image-input" />
                                    <div class="lineup-image-preview"></div>
                                    <button type="button" class="button lineup-select-image">画像を選択</button>
                                    <button type="button" class="button lineup-remove-image">画像を削除</button>
                                </td>
                            </tr>
                            <tr>
                                <th><label>型番</label></th>
                                <td>
                                    <textarea name="product_lineup[${lineupIndex}][model]" rows="3" cols="50" style="width: 100%;" class="lineup-model"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <th><label>名称</label></th>
                                <td>
                                    <textarea name="product_lineup[${lineupIndex}][name]" rows="3" cols="50" style="width: 100%;" class="lineup-name"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <th><label>リンク設定</label></th>
                                <td>
                                    <input type="url" name="product_lineup[${lineupIndex}][link]" value="" style="width: 100%;" class="lineup-link" />
                                </td>
                            </tr>
                        </table>
                    </div>
                `);
                
                $('.no-lineup-message').remove();
                
                $('#lineup-entries').append(newEntry);
                lineupIndex++;
                updateLineupNumbers();
                toggleRemoveButtons();
            };
            
            window.removeLineupEntry = function(button) {
                $(button).closest('.lineup-entry').remove();
                updateLineupNumbers();
                toggleRemoveButtons();
                
                if ($('.lineup-entry').length === 0) {
                    $('#lineup-entries').append('<p class="no-lineup-message" style="color: #666; font-style: italic;">製品ラインナップが設定されていません。必要に応じて追加してください。</p>');
                }
            };
            
            function updateLineupNumbers() {
                $('.lineup-entry').each(function(index) {
                    $(this).attr('data-index', index);
                    $(this).find('h4').text('製品ラインナップ ' + (index + 1));
                    
                    $(this).find('input[name*="product_lineup"]').each(function() {
                        var name = $(this).attr('name');
                        var fieldName = name.match(/\[(\w+)\]$/)[1];
                        $(this).attr('name', `product_lineup[${index}][${fieldName}]`);
                    });
                    $(this).find('textarea[name*="product_lineup"]').each(function() {
                        var name = $(this).attr('name');
                        var fieldName = name.match(/\[(\w+)\]$/)[1];
                        $(this).attr('name', `product_lineup[${index}][${fieldName}]`);
                    });
                });
            }
            
            function toggleRemoveButtons() {
                $('.lineup-remove').show();
            }
            
            $(document).on('click', '.lineup-select-image', function() {
                var button = $(this);
                var entry = button.closest('.lineup-entry');
                var imageInput = entry.find('.lineup-image-input');
                var imagePreview = entry.find('.lineup-image-preview');
                
                var mediaUploader = wp.media({
                    title: '画像を選択',
                    button: {
                        text: '選択'
                    },
                    multiple: false,
                    library: {
                        type: 'image'
                    }
                });
                
                mediaUploader.on('select', function() {
                    var attachment = mediaUploader.state().get('selection').first().toJSON();
                    imageInput.val(attachment.id);
                    imagePreview.html('<img src="' + attachment.url + '" style="max-width: 200px; height: auto;" />');
                });
                
                mediaUploader.open();
            });
            
            $(document).on('click', '.lineup-remove-image', function() {
                var button = $(this);
                var entry = button.closest('.lineup-entry');
                entry.find('.lineup-image-input').val('');
                entry.find('.lineup-image-preview').html('');
            });
            
            toggleRemoveButtons();
            
            // バリデーション関数を統合（公開時のみ）
            function validateProductFields(forceValidation) {
                var hasError = false;
                var errorMessages = [];
                
                // forceValidationがtrueの場合は強制的にバリデーション実行
                if (!forceValidation) {
                    // 投稿ステータスを確認
                    var currentPostStatus = $('#post_status').val();
                    var originalPostStatus = $('#original_post_status').val();
                    var publishButton = $('#publish');
                    var isPublishing = false;
                    
                    // 公開ボタンの状態を詳細にチェック
                    if (publishButton.length > 0) {
                        var buttonText = publishButton.val();
                        isPublishing = (buttonText === '公開' || buttonText === '更新' || buttonText === 'Publish' || buttonText === 'Update');
                    }
                    
                    // 新規公開または既に公開済みの投稿の編集の場合
                    if (currentPostStatus === 'publish' || originalPostStatus === 'publish') {
                        isPublishing = true;
                    }
                    
                    // 下書き保存の場合はバリデーションをスキップ
                    if (!isPublishing) {
                        return { hasError: false, errorMessages: [] };
                    }
                }
                
                // 基本情報の必須チェック（公開時のみ）
                var listingImage = $('#product_listing_image').val();
                var basicCopy = $('#product_basic_copy').val();
                var catalogPdf = $('#product_catalog_pdf').val();
                
                // 一覧画像のバリデーション（空文字、0、null、undefinedをすべてチェック）
                if (!listingImage || listingImage === '' || listingImage === '0') {
                    hasError = true;
                    errorMessages.push('一覧画像は必須項目です。');
                }
                if (!basicCopy || !basicCopy.trim()) {
                    hasError = true;
                    errorMessages.push('コピーは必須項目です。');
                }
                
                // 製品ラインナップのバリデーション（公開時のみ）
                $('.lineup-entry').each(function(index) {
                    var $entry = $(this);
                    var image = $entry.find('.lineup-image-input').val();
                    var model = $entry.find('.lineup-model').val();
                    var name = $entry.find('.lineup-name').val();
                    var link = $entry.find('.lineup-link').val();
                    
                    var hasAnyContent = image || (model && model.trim()) || (name && name.trim()) || (link && link.trim());
                    
                    if (hasAnyContent) {
                        var lineupNum = index + 1;
                        if (!image || image === '' || image === '0') {
                            hasError = true;
                            errorMessages.push('製品ラインナップ ' + lineupNum + ' の画像は必須項目です。');
                        }

                    }
                });
                
                return { hasError: hasError, errorMessages: errorMessages };
            }
            
            // フォーム送信時とボタンクリック時の共通処理
            function handleValidation(e) {
                // クリックされたボタンを確認
                var clickedButton = $(e.target);
                var isDraftSave = clickedButton.attr('id') === 'save-post' || clickedButton.val() === '下書きとして保存';
                
                // 下書き保存の場合はバリデーションをスキップ
                if (isDraftSave) {
                    return true;
                }
                
                // 公開時は強制的にバリデーション実行
                var validation = validateProductFields(true);
                
                if (validation.hasError) {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    alert('公開できませんでした。以下の項目を確認してください：\n\n• ' + validation.errorMessages.join('\n• '));
                    return false;
                }
            }
            
            // フォーム送信時のバリデーション
            $('form#post').on('submit', function(e) {
                // 送信トリガーを確認
                var submitButton = $('input[type="submit"]:focus, button[type="submit"]:focus');
                if (submitButton.length === 0) {
                    submitButton = $('#publish');
                }
                
                var isDraftSave = submitButton.attr('id') === 'save-post' || submitButton.val() === '下書きとして保存';
                var currentPostStatus = $('#post_status').val();
                var originalPostStatus = $('#original_post_status').val();
                
                // 下書き保存でない場合、または公開済み投稿の編集の場合はバリデーション実行
                var shouldValidate = !isDraftSave || (currentPostStatus === 'publish' || originalPostStatus === 'publish');
                
                if (shouldValidate) {
                    var validation = validateProductFields(true);
                    if (validation.hasError) {
                        e.preventDefault();
                        e.stopImmediatePropagation();
                        
                        var errorTitle = (currentPostStatus === 'publish' && originalPostStatus === 'publish') 
                            ? '保存できませんでした。' 
                            : '公開できませんでした。';
                        
                        alert(errorTitle + '以下の項目を確認してください：\n\n• ' + validation.errorMessages.join('\n• '));
                        return false;
                    }
                }
            });
            
            // 公開ボタンクリック時のバリデーション
            $('#publish').on('click', function(e) {
                var validation = validateProductFields(true);
                if (validation.hasError) {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    
                    var currentPostStatus = $('#post_status').val();
                    var originalPostStatus = $('#original_post_status').val();
                    var errorTitle = (currentPostStatus === 'publish' && originalPostStatus === 'publish') 
                        ? '保存できませんでした。' 
                        : '公開できませんでした。';
                    
                    alert(errorTitle + '以下の項目を確認してください：\n\n• ' + validation.errorMessages.join('\n• '));
                    return false;
                }
            });
            
            // 下書き保存ボタンはバリデーションをスキップ
            
            // ブロックエディタ用のAPI Fetchインターセプト（公開時のみ）
            if (typeof wp !== 'undefined' && wp.data && wp.apiFetch) {
                wp.apiFetch.use(function(options, next) {
                    if (options.path && options.path.includes('/wp/v2/product') && 
                        (options.method === 'POST' || options.method === 'PUT')) {
                        
                        // 投稿ステータスを確認
                        var postStatus = options.data && options.data.status;
                        var currentPostStatus = $('#post_status').val();
                        var originalPostStatus = $('#original_post_status').val();
                        
                        // 公開時または公開済み投稿の編集時にバリデーション実行
                        if (postStatus === 'publish' || currentPostStatus === 'publish' || originalPostStatus === 'publish') {
                            var validation = validateProductFields(true);
                            
                            if (validation.hasError) {
                                var errorMessage = (currentPostStatus === 'publish' && originalPostStatus === 'publish') 
                                    ? '保存できませんでした。必須項目を確認してください。' 
                                    : '公開できませんでした。必須項目を確認してください。';
                                
                                wp.data.dispatch('core/notices').createErrorNotice(
                                    errorMessage,
                                    { id: 'product-validation-error', isDismissible: true }
                                );
                                
                                var alertMessage = (currentPostStatus === 'publish' && originalPostStatus === 'publish') 
                                    ? '保存できませんでした。以下の項目を確認してください：\n\n• ' 
                                    : '公開できませんでした。以下の項目を確認してください：\n\n• ';
                                
                                alert(alertMessage + validation.errorMessages.join('\n• '));
                                
                                return Promise.reject(new Error('バリデーションエラー: ' + validation.errorMessages.join(', ')));
                            } else {
                                wp.data.dispatch('core/notices').removeNotice('product-validation-error');
                            }
                        }
                    }
                    
                    return next(options);
                });
            }
        });
        </script>
        <?php
    }
}
add_action('admin_footer', 'product_admin_scripts');

/**
 * 製品ラインナップデータを取得する
 */
function get_product_lineup_data($post_id) {
    $lineup_data = get_post_meta($post_id, '_product_lineup_data', true);
    
    if (is_array($lineup_data) && !empty($lineup_data)) {
        return $lineup_data;
    }
    
    $legacy_image = get_post_meta($post_id, '_product_lineup_image', true);
    $legacy_model = get_post_meta($post_id, '_product_lineup_model', true);
    $legacy_name = get_post_meta($post_id, '_product_lineup_name', true);
    $legacy_link = get_post_meta($post_id, '_product_lineup_link', true);
    
    if ($legacy_image || $legacy_model || $legacy_name || $legacy_link) {
        return array(
            array(
                'image' => $legacy_image,
                'model' => $legacy_model,
                'name' => $legacy_name,
                'link' => $legacy_link
            )
        );
    }
    
    return array();
}


?>

