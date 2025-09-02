<?php
/**
 * 募集要項ページ用のオリジナルカスタムフィールド
 */

/**
 * メタボックスの追加
 */
function add_recruitment_meta_boxes() {
    // 募集要項ページにのみ表示
    $screen = get_current_screen();
    if ($screen && $screen->id === 'page') {
        global $post;
        if ($post && $post->post_name === 'recruitment') {
            add_meta_box(
                'recruitment_fields',
                '募集要項設定',
                'recruitment_meta_box_callback',
                'page',
                'normal',
                'high'
            );
        }
    }
}
add_action('add_meta_boxes', 'add_recruitment_meta_boxes');

/**
 * メタボックスのコールバック関数（新卒採用部分）
 */
function recruitment_meta_box_callback($post) {
    // ナンスフィールドを追加（セキュリティ）
    wp_nonce_field('recruitment_meta_box', 'recruitment_meta_box_nonce');
    
    // 既存の値を取得
    $meta_data = get_post_meta($post->ID, '_recruitment_data', true);
    if (!$meta_data) {
        $meta_data = array();
    }
    
    ?>
    <style>
        .recruitment-tabs {
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
        }
        .recruitment-tab {
            display: inline-block;
            padding: 10px 20px;
            background: #f1f1f1;
            border: 1px solid #ddd;
            border-bottom: none;
            cursor: pointer;
            margin-right: 5px;
        }
        .recruitment-tab.active {
            background: #fff;
            border-bottom: 1px solid #fff;
            margin-bottom: -1px;
        }
        .recruitment-tab-content {
            display: none;
        }
        .recruitment-tab-content.active {
            display: block;
        }
        .recruitment-field {
            margin-bottom: 15px;
        }
        .recruitment-field label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .recruitment-field input[type="text"],
        .recruitment-field textarea {
            width: 100%;
            padding: 5px;
        }
        .recruitment-field textarea {
            height: 80px;
        }
        .recruitment-section {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            background: #f9f9f9;
        }
        .recruitment-section h4 {
            margin-top: 0;
            color: #333;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
        }
    </style>
    
    <div class="recruitment-tabs">
        <div class="recruitment-tab active" data-tab="shinsotsu">新卒採用</div>
        <div class="recruitment-tab" data-tab="chuuto">中途採用</div>
    </div>
    
    <!-- 新卒採用タブ -->
    <div class="recruitment-tab-content active" id="tab-shinsotsu">
        
        <!-- 2026年度学卒者募集要領 -->
        <div class="recruitment-section">
            <h4>2026年度学卒者募集要領</h4>
            
            <div class="recruitment-field">
                <label>採用職種</label>
                <textarea name="recruitment[shinsotsu_requirements][saiyou_shokushu]"><?php echo esc_textarea($meta_data['shinsotsu_requirements']['saiyou_shokushu'] ?? ''); ?></textarea>
            </div>
            
            <div class="recruitment-field">
                <label>採用人数</label>
                <textarea name="recruitment[shinsotsu_requirements][saiyou_ninzu]"><?php echo esc_textarea($meta_data['shinsotsu_requirements']['saiyou_ninzu'] ?? ''); ?></textarea>
            </div>
            
            <div class="recruitment-field">
                <label>勤務地</label>
                <textarea name="recruitment[shinsotsu_requirements][kinmu_chi]"><?php echo esc_textarea($meta_data['shinsotsu_requirements']['kinmu_chi'] ?? ''); ?></textarea>
            </div>
            
            <div class="recruitment-field">
                <label>勤務時間</label>
                <textarea name="recruitment[shinsotsu_requirements][kinmu_jikan]"><?php echo esc_textarea($meta_data['shinsotsu_requirements']['kinmu_jikan'] ?? ''); ?></textarea>
            </div>
            
            <div class="recruitment-field">
                <label>休日</label>
                <textarea name="recruitment[shinsotsu_requirements][kyujitsu]"><?php echo esc_textarea($meta_data['shinsotsu_requirements']['kyujitsu'] ?? ''); ?></textarea>
            </div>
            
            <div class="recruitment-field">
                <label>初任給</label>
                <textarea name="recruitment[shinsotsu_requirements][shoninkyuu]"><?php echo esc_textarea($meta_data['shinsotsu_requirements']['shoninkyuu'] ?? ''); ?></textarea>
            </div>
            
            <div class="recruitment-field">
                <label>諸手当</label>
                <textarea name="recruitment[shinsotsu_requirements][shoteate]"><?php echo esc_textarea($meta_data['shinsotsu_requirements']['shoteate'] ?? ''); ?></textarea>
            </div>
            
            <div class="recruitment-field">
                <label>社会保険</label>
                <textarea name="recruitment[shinsotsu_requirements][shakai_hoken]"><?php echo esc_textarea($meta_data['shinsotsu_requirements']['shakai_hoken'] ?? ''); ?></textarea>
            </div>
            
            <div class="recruitment-field">
                <label>福利厚生</label>
                <textarea name="recruitment[shinsotsu_requirements][fukuri_kousei]"><?php echo esc_textarea($meta_data['shinsotsu_requirements']['fukuri_kousei'] ?? ''); ?></textarea>
            </div>
            
            <div class="recruitment-field">
                <label>採用実績大学</label>
                <textarea name="recruitment[shinsotsu_requirements][saiyou_jisseki_daigaku]"><?php echo esc_textarea($meta_data['shinsotsu_requirements']['saiyou_jisseki_daigaku'] ?? ''); ?></textarea>
            </div>
            
            <div class="recruitment-field">
                <label>採用実績高校</label>
                <textarea name="recruitment[shinsotsu_requirements][saiyou_jisseki_koukou]"><?php echo esc_textarea($meta_data['shinsotsu_requirements']['saiyou_jisseki_koukou'] ?? ''); ?></textarea>
            </div>
            
            <div class="recruitment-field">
                <label>採用実績人員</label>
                <textarea name="recruitment[shinsotsu_requirements][saiyou_jisseki_jinin]"><?php echo esc_textarea($meta_data['shinsotsu_requirements']['saiyou_jisseki_jinin'] ?? ''); ?></textarea>
            </div>
        </div>
        
        <!-- 一次入社試験 -->
        <div class="recruitment-section">
            <h4>一次入社試験</h4>
            
            <div class="recruitment-field">
                <label>説明</label>
                <textarea name="recruitment[shinsotsu_exam][exam_description]"><?php echo esc_textarea($meta_data['shinsotsu_exam']['exam_description'] ?? ''); ?></textarea>
            </div>
        </div>
        
        <!-- 新卒採用の連絡先 -->
        <div class="recruitment-section">
            <h4>連絡先（新卒採用）</h4>
            
            <div class="recruitment-field">
                <label>郵便番号</label>
                <textarea name="recruitment[shinsotsu_contact][postal_code]"><?php echo esc_textarea($meta_data['shinsotsu_contact']['postal_code'] ?? ''); ?></textarea>
            </div>
            
            <div class="recruitment-field">
                <label>住所</label>
                <textarea name="recruitment[shinsotsu_contact][address]"><?php echo esc_textarea($meta_data['shinsotsu_contact']['address'] ?? ''); ?></textarea>
            </div>
            
            <div class="recruitment-field">
                <label>担当者</label>
                <textarea name="recruitment[shinsotsu_contact][contact_person]"><?php echo esc_textarea($meta_data['shinsotsu_contact']['contact_person'] ?? ''); ?></textarea>
            </div>
            
            <div class="recruitment-field">
                <label>電話番号</label>
                <textarea name="recruitment[shinsotsu_contact][phone]"><?php echo esc_textarea($meta_data['shinsotsu_contact']['phone'] ?? ''); ?></textarea>
            </div>
            
            <div class="recruitment-field">
                <label>FAX番号</label>
                <textarea name="recruitment[shinsotsu_contact][fax]"><?php echo esc_textarea($meta_data['shinsotsu_contact']['fax'] ?? ''); ?></textarea>
            </div>
            
            <div class="recruitment-field">
                <label>Eメール</label>
                <textarea name="recruitment[shinsotsu_contact][email]"><?php echo esc_textarea($meta_data['shinsotsu_contact']['email'] ?? ''); ?></textarea>
            </div>
        </div>
    </div>
    
    <!-- 中途採用タブ -->
    <div class="recruitment-tab-content" id="tab-chuuto">
        
        <!-- 営業 -->
        <div class="recruitment-section">
            <h4>営業</h4>
            
            <div class="recruitment-field">
                <label>職務内容</label>
                <textarea name="recruitment[chuuto_sales][job_content]"><?php echo esc_textarea($meta_data['chuuto_sales']['job_content'] ?? ''); ?></textarea>
            </div>
            
            <div class="recruitment-field">
                <label>応募資格</label>
                <textarea name="recruitment[chuuto_sales][qualifications]"><?php echo esc_textarea($meta_data['chuuto_sales']['qualifications'] ?? ''); ?></textarea>
            </div>
            
            <div class="recruitment-field">
                <label>勤務地</label>
                <textarea name="recruitment[chuuto_sales][location]"><?php echo esc_textarea($meta_data['chuuto_sales']['location'] ?? ''); ?></textarea>
            </div>
        </div>
        
        <!-- サービスエンジニア -->
        <div class="recruitment-section">
            <h4>サービスエンジニア</h4>
            
            <div class="recruitment-field">
                <label>職務内容</label>
                <textarea name="recruitment[chuuto_engineer][job_content]"><?php echo esc_textarea($meta_data['chuuto_engineer']['job_content'] ?? ''); ?></textarea>
            </div>
            
            <div class="recruitment-field">
                <label>応募資格</label>
                <textarea name="recruitment[chuuto_engineer][qualifications]"><?php echo esc_textarea($meta_data['chuuto_engineer']['qualifications'] ?? ''); ?></textarea>
            </div>
            
            <div class="recruitment-field">
                <label>勤務地</label>
                <textarea name="recruitment[chuuto_engineer][location]"><?php echo esc_textarea($meta_data['chuuto_engineer']['location'] ?? ''); ?></textarea>
            </div>
        </div>
        
        <!-- 組立作業職 -->
        <div class="recruitment-section">
            <h4>組立作業職</h4>
            
            <div class="recruitment-field">
                <label>職務内容</label>
                <textarea name="recruitment[chuuto_assembly][job_content]"><?php echo esc_textarea($meta_data['chuuto_assembly']['job_content'] ?? ''); ?></textarea>
            </div>
            
            <div class="recruitment-field">
                <label>応募資格</label>
                <textarea name="recruitment[chuuto_assembly][qualifications]"><?php echo esc_textarea($meta_data['chuuto_assembly']['qualifications'] ?? ''); ?></textarea>
            </div>
            
            <div class="recruitment-field">
                <label>勤務地</label>
                <textarea name="recruitment[chuuto_assembly][location]"><?php echo esc_textarea($meta_data['chuuto_assembly']['location'] ?? ''); ?></textarea>
            </div>
        </div>
        
        <!-- 労働条件 -->
        <div class="recruitment-section">
            <h4>労働条件</h4>
            
            <div class="recruitment-field">
                <label>給与イメージ</label>
                <textarea name="recruitment[chuuto_labor][salary_image]"><?php echo esc_textarea($meta_data['chuuto_labor']['salary_image'] ?? ''); ?></textarea>
            </div>
            
            <div class="recruitment-field">
                <label>昇給</label>
                <textarea name="recruitment[chuuto_labor][raise]"><?php echo esc_textarea($meta_data['chuuto_labor']['raise'] ?? ''); ?></textarea>
            </div>
            
            <div class="recruitment-field">
                <label>賞与</label>
                <textarea name="recruitment[chuuto_labor][bonus]"><?php echo esc_textarea($meta_data['chuuto_labor']['bonus'] ?? ''); ?></textarea>
            </div>
            
            <div class="recruitment-field">
                <label>勤務時間</label>
                <textarea name="recruitment[chuuto_labor][work_time]"><?php echo esc_textarea($meta_data['chuuto_labor']['work_time'] ?? ''); ?></textarea>
            </div>
            
            <div class="recruitment-field">
                <label>休日</label>
                <textarea name="recruitment[chuuto_labor][holiday]"><?php echo esc_textarea($meta_data['chuuto_labor']['holiday'] ?? ''); ?></textarea>
            </div>
            
            <div class="recruitment-field">
                <label>諸手当</label>
                <textarea name="recruitment[chuuto_labor][allowance]"><?php echo esc_textarea($meta_data['chuuto_labor']['allowance'] ?? ''); ?></textarea>
            </div>
            
            <div class="recruitment-field">
                <label>社会保険</label>
                <textarea name="recruitment[chuuto_labor][insurance]"><?php echo esc_textarea($meta_data['chuuto_labor']['insurance'] ?? ''); ?></textarea>
            </div>
        </div>
        
        <!-- 中途採用の連絡先 -->
        <div class="recruitment-section">
            <h4>連絡先（中途採用）</h4>
            
            <div class="recruitment-field">
                <label>郵便番号</label>
                <textarea name="recruitment[chuuto_contact][postal_code]"><?php echo esc_textarea($meta_data['chuuto_contact']['postal_code'] ?? ''); ?></textarea>
            </div>
            
            <div class="recruitment-field">
                <label>住所</label>
                <textarea name="recruitment[chuuto_contact][address]"><?php echo esc_textarea($meta_data['chuuto_contact']['address'] ?? ''); ?></textarea>
            </div>
            
            <div class="recruitment-field">
                <label>担当者</label>
                <textarea name="recruitment[chuuto_contact][contact_person]"><?php echo esc_textarea($meta_data['chuuto_contact']['contact_person'] ?? ''); ?></textarea>
            </div>
            
            <div class="recruitment-field">
                <label>電話番号</label>
                <textarea name="recruitment[chuuto_contact][phone]"><?php echo esc_textarea($meta_data['chuuto_contact']['phone'] ?? ''); ?></textarea>
            </div>
            
            <div class="recruitment-field">
                <label>FAX番号</label>
                <textarea name="recruitment[chuuto_contact][fax]"><?php echo esc_textarea($meta_data['chuuto_contact']['fax'] ?? ''); ?></textarea>
            </div>
            
            <div class="recruitment-field">
                <label>Eメール</label>
                <textarea name="recruitment[chuuto_contact][email]"><?php echo esc_textarea($meta_data['chuuto_contact']['email'] ?? ''); ?></textarea>
            </div>
        </div>
    </div>
    
    <script>
        jQuery(document).ready(function($) {
            $('.recruitment-tab').click(function() {
                var tabId = $(this).data('tab');
                
                // タブの切り替え
                $('.recruitment-tab').removeClass('active');
                $(this).addClass('active');
                
                // コンテンツの切り替え
                $('.recruitment-tab-content').removeClass('active');
                $('#tab-' + tabId).addClass('active');
            });
        });
    </script>
    <?php
}

/**
 * メタボックスのデータを保存
 */
function save_recruitment_meta_box($post_id) {
    // ナンスの確認
    if (!isset($_POST['recruitment_meta_box_nonce']) || 
        !wp_verify_nonce($_POST['recruitment_meta_box_nonce'], 'recruitment_meta_box')) {
        return;
    }

    // 自動保存の場合は何もしない
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // 権限の確認
    if (!current_user_can('edit_page', $post_id)) {
        return;
    }

    // データの保存
    if (isset($_POST['recruitment'])) {
        update_post_meta($post_id, '_recruitment_data', $_POST['recruitment']);
    }
}
add_action('save_post', 'save_recruitment_meta_box');

/**
 * 改行を<br>タグに変換するヘルパー関数
 */
function recruitment_nl2br($text) {
    if (empty($text)) {
        return '';
    }
    return nl2br($text);
}

/**
 * カスタムフィールドの値を取得するヘルパー関数
 */
function get_recruitment_field($post_id, $field_path) {
    $data = get_post_meta($post_id, '_recruitment_data', true);
    if (!$data) {
        return '';
    }
    
    $keys = explode('.', $field_path);
    $value = $data;
    
    foreach ($keys as $key) {
        if (isset($value[$key])) {
            $value = $value[$key];
        } else {
            return '';
        }
    }
    
    return $value;
}
