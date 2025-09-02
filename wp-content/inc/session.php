<?php
// セッション用カスタムフィールド機能

// 管理画面でのメタボックス追加
function add_session_meta_boxes() {
    // 固定ページのrecruit/sessionスラッグのページIDを取得
    $session_page = get_page_by_path('recruit/session');
    if ($session_page && is_admin()) {
        global $post;
        if ($post && $post->ID == $session_page->ID) {
            // 説明会エリア
            add_meta_box(
                'session_events_meta',
                '説明会 イベント管理',
                'session_events_meta_callback',
                'page',
                'normal',
                'high'
            );
            
            // オープンカンパニーエリア
            add_meta_box(
                'open_company_events_meta',
                'オープンカンパニー イベント管理',
                'open_company_events_meta_callback',
                'page',
                'normal',
                'high'
            );
        }
    }
}
add_action('add_meta_boxes', 'add_session_meta_boxes');

// 説明会エリアのメタボックス
function session_events_meta_callback($post) {
    wp_nonce_field('session_events_meta_nonce', 'session_events_meta_nonce_field');
    
    // 保存されているデータを取得
    $session_events = get_post_meta($post->ID, '_session_events', true);
    if (!is_array($session_events)) {
        $session_events = array();
    }
    
    // 説明会全体の設定を取得
    $session_description = get_post_meta($post->ID, '_session_description', true);
    $session_publish_status = get_post_meta($post->ID, '_session_publish_status', true);
    if (empty($session_publish_status)) {
        $session_publish_status = 'published';
    }
    
    // 説明会全体の設定フィールド
    ?>
    <div style="border: 1px solid #ddd; padding: 15px; margin-bottom: 20px; background: #f0f8ff; border-radius: 4px;">
        <h4 style="margin-top: 0; color: #333;">説明会 全体設定</h4>
        <table class="form-table">
            <tr>
                <th><label>説明</label></th>
                <td>
                    <textarea name="session_description" rows="4" cols="50" style="width: 100%;" placeholder="説明会の概要説明を入力してください。"><?php echo esc_textarea($session_description); ?></textarea>
                </td>
            </tr>
            <tr>
                <th><label>公開設定</label></th>
                <td>
                    <label style="display: inline-block; margin-right: 15px; margin-bottom: 5px;">
                        <input type="radio" name="session_publish_status" value="published" <?php checked($session_publish_status === 'published'); ?> /> 公開
                    </label>
                    <label style="display: inline-block; margin-right: 15px; margin-bottom: 5px;">
                        <input type="radio" name="session_publish_status" value="draft" <?php checked($session_publish_status === 'draft'); ?> /> 非公開
                    </label>
                </td>
            </tr>
        </table>
    </div>
    <?php
    
    render_event_repeater('session', $session_events, '説明会');
}

// オープンカンパニーエリアのメタボックス
function open_company_events_meta_callback($post) {
    // 保存されているデータを取得
    $open_company_events = get_post_meta($post->ID, '_open_company_events', true);
    if (!is_array($open_company_events)) {
        $open_company_events = array();
    }
    
    // オープンカンパニー全体の設定を取得
    $open_company_description = get_post_meta($post->ID, '_open_company_description', true);
    $open_company_publish_status = get_post_meta($post->ID, '_open_company_publish_status', true);
    if (empty($open_company_publish_status)) {
        $open_company_publish_status = 'published';
    }
    
    // オープンカンパニー全体の設定フィールド
    ?>
    <div style="border: 1px solid #ddd; padding: 15px; margin-bottom: 20px; background: #f0f8ff; border-radius: 4px;">
        <h4 style="margin-top: 0; color: #333;">オープンカンパニー 全体設定</h4>
        <table class="form-table">
            <tr>
                <th><label>説明</label></th>
                <td>
                    <textarea name="open_company_description" rows="4" cols="50" style="width: 100%;" placeholder="オープンカンパニーの概要説明を入力してください。"><?php echo esc_textarea($open_company_description); ?></textarea>
                </td>
            </tr>
            <tr>
                <th><label>公開設定</label></th>
                <td>
                    <label style="display: inline-block; margin-right: 15px; margin-bottom: 5px;">
                        <input type="radio" name="open_company_publish_status" value="published" <?php checked($open_company_publish_status === 'published'); ?> /> 公開
                    </label>
                    <label style="display: inline-block; margin-right: 15px; margin-bottom: 5px;">
                        <input type="radio" name="open_company_publish_status" value="draft" <?php checked($open_company_publish_status === 'draft'); ?> /> 非公開
                    </label>
                </td>
            </tr>
        </table>
    </div>
    <?php
    
    render_event_repeater('open_company', $open_company_events, 'オープンカンパニー');
}

// イベントリピーター共通関数
function render_event_repeater($type, $events, $title) {
    ?>
    <div id="<?php echo $type; ?>-events-repeater">
        <div id="<?php echo $type; ?>-entries">
            <?php if (!empty($events)): ?>
                <?php foreach ($events as $index => $event): ?>
                    <?php render_single_event_form($type, $index, $event); ?>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-<?php echo $type; ?>-message" style="color: #666; font-style: italic;"><?php echo $title; ?>イベントが設定されていません。必要に応じて追加してください。</p>
            <?php endif; ?>
        </div>
        <div class="<?php echo $type; ?>-actions">
            <button type="button" class="button button-primary" onclick="add<?php echo ucfirst(str_replace('_', '', $type)); ?>Event()"><?php echo $title; ?>イベントを追加</button>
        </div>
    </div>
    
    <style>
    .<?php echo $type; ?>-event-entry {
        border: 1px solid #ddd;
        padding: 15px;
        margin-bottom: 15px;
        background: #f9f9f9;
        border-radius: 4px;
    }
    .<?php echo $type; ?>-event-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
        border-bottom: 1px solid #ddd;
        padding-bottom: 10px;
    }
    .<?php echo $type; ?>-event-header h4 {
        margin: 0;
        color: #333;
    }
    .<?php echo $type; ?>-event-table {
        margin-top: 10px;
    }
    .<?php echo $type; ?>-actions {
        margin-top: 20px;
        text-align: center;
    }
    .<?php echo $type; ?>-remove {
        background: #dc3232;
        border-color: #dc3232;
        color: white;
    }
    .<?php echo $type; ?>-remove:hover {
        background: #a02020;
        border-color: #a02020;
    }
    </style>
    <?php
}

// 単一イベントフォームの出力
function render_single_event_form($type, $index, $event = array()) {
    $date = isset($event['date']) ? esc_attr($event['date']) : '';
    $time = isset($event['time']) ? esc_attr($event['time']) : '';
    $number = isset($event['number']) ? esc_attr($event['number']) : '';
    $category = isset($event['category']) ? (array)$event['category'] : array();
    $status = isset($event['status']) ? $event['status'] : '';
    
    $title_prefix = ($type === 'session') ? '説明会' : 'オープンカンパニー';
    ?>
    <div class="<?php echo $type; ?>-event-entry" data-index="<?php echo $index; ?>">
        <div class="<?php echo $type; ?>-event-header">
            <h4><?php echo $title_prefix; ?>イベント <?php echo $index + 1; ?></h4>
            <button type="button" class="button <?php echo $type; ?>-remove" onclick="remove<?php echo ucfirst(str_replace('_', '', $type)); ?>Event(this)">削除</button>
        </div>
        <table class="form-table <?php echo $type; ?>-event-table">
            <tr>
                <th><label>日付</label></th>
                <td>
                    <input type="text" name="<?php echo $type; ?>_events[<?php echo $index; ?>][date]" value="<?php echo $date; ?>" placeholder="例: 7月30日（水）" style="width: 100%;" />
                </td>
            </tr>
            <tr>
                <th><label>時間</label></th>
                <td>
                    <input type="text" name="<?php echo $type; ?>_events[<?php echo $index; ?>][time]" value="<?php echo $time; ?>" placeholder="例: 10:00～11:00" style="width: 100%;" />
                </td>
            </tr>
            <tr>
                <th><label>No</label></th>
                <td>
                    <input type="text" name="<?php echo $type; ?>_events[<?php echo $index; ?>][number]" value="<?php echo $number; ?>" placeholder="例: No.A0056" style="width: 100%;" />
                </td>
            </tr>
            <tr>
                <th><label>カテゴリ</label></th>
                <td>
                    <label style="display: inline-block; margin-right: 15px; margin-bottom: 5px;">
                        <input type="checkbox" name="<?php echo $type; ?>_events[<?php echo $index; ?>][category][]" value="説明会" <?php checked(in_array('説明会', $category)); ?> /> 説明会
                    </label>
                    <label style="display: inline-block; margin-right: 15px; margin-bottom: 5px;">
                        <input type="checkbox" name="<?php echo $type; ?>_events[<?php echo $index; ?>][category][]" value="26卒" <?php checked(in_array('26卒', $category)); ?> /> 26年卒
                    </label>
                    <label style="display: inline-block; margin-right: 15px; margin-bottom: 5px;">
                        <input type="checkbox" name="<?php echo $type; ?>_events[<?php echo $index; ?>][category][]" value="オンライン" <?php checked(in_array('オンライン', $category)); ?> /> オンライン
                    </label>
                </td>
            </tr>
            <tr>
                <th><label>受付状況</label></th>
                <td>
                    <label style="display: inline-block; margin-right: 15px; margin-bottom: 5px;">
                        <input type="radio" name="<?php echo $type; ?>_events[<?php echo $index; ?>][status]" value="受付中" <?php checked($status === '受付中'); ?> /> 受付中
                    </label>
                    <label style="display: inline-block; margin-right: 15px; margin-bottom: 5px;">
                        <input type="radio" name="<?php echo $type; ?>_events[<?php echo $index; ?>][status]" value="終了" <?php checked($status === '終了'); ?> /> 終了
                    </label>
                </td>
            </tr>
        </table>
    </div>
    <?php
}



// データの保存
function save_session_events_meta($post_id) {
    // ナンス確認
    if (!isset($_POST['session_events_meta_nonce_field']) || 
        !wp_verify_nonce($_POST['session_events_meta_nonce_field'], 'session_events_meta_nonce')) {
        return;
    }
    
    // 自動保存の場合は処理しない
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // 権限確認
    if (!current_user_can('edit_page', $post_id)) {
        return;
    }
    
    // recruit/sessionページかどうか確認
    $session_page = get_page_by_path('recruit/session');
    if (!$session_page || $post_id != $session_page->ID) {
        return;
    }
    
    // 説明会全体設定の保存
    if (isset($_POST['session_description'])) {
        $session_description = wp_kses_post($_POST['session_description']);
        update_post_meta($post_id, '_session_description', $session_description);
    } else {
        delete_post_meta($post_id, '_session_description');
    }
    
    if (isset($_POST['session_publish_status'])) {
        $session_publish_status = sanitize_text_field($_POST['session_publish_status']);
        update_post_meta($post_id, '_session_publish_status', $session_publish_status);
    } else {
        update_post_meta($post_id, '_session_publish_status', 'published');
    }
    
    // オープンカンパニー全体設定の保存
    if (isset($_POST['open_company_description'])) {
        $open_company_description = wp_kses_post($_POST['open_company_description']);
        update_post_meta($post_id, '_open_company_description', $open_company_description);
    } else {
        delete_post_meta($post_id, '_open_company_description');
    }
    
    if (isset($_POST['open_company_publish_status'])) {
        $open_company_publish_status = sanitize_text_field($_POST['open_company_publish_status']);
        update_post_meta($post_id, '_open_company_publish_status', $open_company_publish_status);
    } else {
        update_post_meta($post_id, '_open_company_publish_status', 'published');
    }
    
    // 説明会イベントの保存
    if (isset($_POST['session_events'])) {
        $session_events = array();
        foreach ($_POST['session_events'] as $event) {
            $clean_event = array();
            $clean_event['date'] = sanitize_text_field($event['date']);
            $clean_event['time'] = sanitize_text_field($event['time']);
            $clean_event['number'] = sanitize_text_field($event['number']);
            $clean_event['category'] = isset($event['category']) ? array_map('sanitize_text_field', $event['category']) : array();
            $clean_event['status'] = isset($event['status']) ? sanitize_text_field($event['status']) : '';
            $session_events[] = $clean_event;
        }
        update_post_meta($post_id, '_session_events', $session_events);
    } else {
        delete_post_meta($post_id, '_session_events');
    }
    
    // オープンカンパニーイベントの保存
    if (isset($_POST['open_company_events'])) {
        $open_company_events = array();
        foreach ($_POST['open_company_events'] as $event) {
            $clean_event = array();
            $clean_event['date'] = sanitize_text_field($event['date']);
            $clean_event['time'] = sanitize_text_field($event['time']);
            $clean_event['number'] = sanitize_text_field($event['number']);
            $clean_event['category'] = isset($event['category']) ? array_map('sanitize_text_field', $event['category']) : array();
            $clean_event['status'] = isset($event['status']) ? sanitize_text_field($event['status']) : '';
            $open_company_events[] = $clean_event;
        }
        update_post_meta($post_id, '_open_company_events', $open_company_events);
    } else {
        delete_post_meta($post_id, '_open_company_events');
    }
}
add_action('save_post', 'save_session_events_meta');

// フロントエンド用の関数：イベントデータを取得
function get_session_events($event_type = 'session') {
    $session_page = get_page_by_path('recruit/session');
    if (!$session_page) {
        return array();
    }
    
    if ($event_type === 'session') {
        $events = get_post_meta($session_page->ID, '_session_events', true);
    } elseif ($event_type === 'open_company') {
        $events = get_post_meta($session_page->ID, '_open_company_events', true);
    } else {
        return array();
    }
    
    if (!is_array($events)) {
        return array();
    }
    
    return $events;
}

// フロントエンド用の関数：イベントリストのHTMLを出力
function display_session_events($event_type = 'session') {
    $session_page = get_page_by_path('recruit/session');
    if (!$session_page) {
        return;
    }
    
    // 全体設定の公開状況を確認
    $session_publish_status = get_post_meta($session_page->ID, '_session_publish_status', true);
    $open_company_publish_status = get_post_meta($session_page->ID, '_open_company_publish_status', true);
    
    if (empty($session_publish_status)) {
        $session_publish_status = 'published';
    }
    if (empty($open_company_publish_status)) {
        $open_company_publish_status = 'published';
    }
    
    // 現在のエリアが非公開の場合は何も表示しない
    $current_publish_status = ($event_type === 'session') ? $session_publish_status : $open_company_publish_status;
    if ($current_publish_status === 'draft') {
        echo '<p>現在、予定されているイベントはありません。</p>';
        return;
    }
    
    $events = get_session_events($event_type);
    
    if (empty($events)) {
        echo '<p>現在、予定されているイベントはありません。</p>';
        return;
    }
    
    echo '<ul class="p-session-list">';
    foreach ($events as $event) {
        // 終了ステータスのチェック
        $status = isset($event['status']) ? $event['status'] : '';
        $status_class = ($status === '終了') ? 'end' : '';
        
        echo '<li class="' . $status_class . '">';
        echo '<p class="date">' . esc_html($event['date']) . '</p>';
        echo '<p class="time">' . esc_html($event['time']) . '</p>';
        echo '<p class="number">' . esc_html($event['number']) . '</p>';
        echo '<div class="category">';
        
        if (!empty($event['category'])) {
            $has_online = in_array('オンライン', $event['category']);
            
            foreach ($event['category'] as $cat) {
                if ($cat === 'オンライン') {
                    echo '<p class="on">' . esc_html($cat) . '</p>';
                } else {
                    echo '<p class="on">' . esc_html($cat) . '</p>';
                }
            }
            
            // オンラインがチェックされていない場合はオフラインを表示
            if (!$has_online) {
                echo '<p class="off">オフライン</p>';
            }
        } else {
            // カテゴリが設定されていない場合はオフラインを表示
            echo '<p class="off">オフライン</p>';
        }
        
        echo '</div>';
        
        // ステータス表示
        $status_text = !empty($status) ? $status : '';
        echo '<p class="status">' . esc_html($status_text) . '</p>';
        
        echo '</li>';
    }
    echo '</ul>';
}

// 全体設定の説明文を取得する関数
function get_section_description($event_type = 'session') {
    $session_page = get_page_by_path('recruit/session');
    if (!$session_page) {
        return '';
    }
    
    if ($event_type === 'session') {
        $description = get_post_meta($session_page->ID, '_session_description', true);
    } elseif ($event_type === 'open_company') {
        $description = get_post_meta($session_page->ID, '_open_company_description', true);
    } else {
        return '';
    }
    
    return $description;
}

// JavaScript機能を追加
function session_admin_scripts() {
    global $post;
    if ($post && get_page_by_path('recruit/session') && $post->ID == get_page_by_path('recruit/session')->ID) {
        ?>
        <script type="text/javascript">
        jQuery(document).ready(function($) {
            var sessionIndex = $('.session-event-entry').length;
            var openCompanyIndex = $('.open_company-event-entry').length;
            
            // 説明会イベント追加
            window.addSessionEvent = function() {
                var newEvent = `
                    <div class="session-event-entry" data-index="${sessionIndex}">
                        <div class="session-event-header">
                            <h4>説明会イベント ${sessionIndex + 1}</h4>
                            <button type="button" class="button session-remove" onclick="removeSessionEvent(this)">削除</button>
                        </div>
                        <table class="form-table session-event-table">
                            <tr>
                                <th><label>日付</label></th>
                                <td>
                                    <input type="text" name="session_events[${sessionIndex}][date]" value="" placeholder="例: 7月30日（水）" style="width: 100%;" />
                                </td>
                            </tr>
                            <tr>
                                <th><label>時間</label></th>
                                <td>
                                    <input type="text" name="session_events[${sessionIndex}][time]" value="" placeholder="例: 10:00～11:00" style="width: 100%;" />
                                </td>
                            </tr>
                            <tr>
                                <th><label>No</label></th>
                                <td>
                                    <input type="text" name="session_events[${sessionIndex}][number]" value="" placeholder="例: No.A0056" style="width: 100%;" />
                                </td>
                            </tr>
                            <tr>
                                <th><label>カテゴリ</label></th>
                                <td>
                                    <label style="display: inline-block; margin-right: 15px; margin-bottom: 5px;">
                                        <input type="checkbox" name="session_events[${sessionIndex}][category][]" value="説明会" /> 説明会
                                    </label>
                                    <label style="display: inline-block; margin-right: 15px; margin-bottom: 5px;">
                                        <input type="checkbox" name="session_events[${sessionIndex}][category][]" value="26卒" /> 26年卒
                                    </label>
                                    <label style="display: inline-block; margin-right: 15px; margin-bottom: 5px;">
                                        <input type="checkbox" name="session_events[${sessionIndex}][category][]" value="オンライン" /> オンライン
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <th><label>受付状況</label></th>
                                <td>
                                    <label style="display: inline-block; margin-right: 15px; margin-bottom: 5px;">
                                        <input type="radio" name="session_events[${sessionIndex}][status]" value="受付中" /> 受付中
                                    </label>
                                    <label style="display: inline-block; margin-right: 15px; margin-bottom: 5px;">
                                        <input type="radio" name="session_events[${sessionIndex}][status]" value="終了" /> 終了
                                    </label>
                                </td>
                            </tr>
                        </table>
                    </div>
                `;
                
                $('.no-session-message').remove();
                $('#session-entries').append(newEvent);
                sessionIndex++;
                updateSessionNumbers();
            };
            
            // オープンカンパニーイベント追加
            window.addOpencompanyEvent = function() {
                var newEvent = `
                    <div class="open_company-event-entry" data-index="${openCompanyIndex}">
                        <div class="open_company-event-header">
                            <h4>オープンカンパニーイベント ${openCompanyIndex + 1}</h4>
                            <button type="button" class="button open_company-remove" onclick="removeOpencompanyEvent(this)">削除</button>
                        </div>
                        <table class="form-table open_company-event-table">
                            <tr>
                                <th><label>日付</label></th>
                                <td>
                                    <input type="text" name="open_company_events[${openCompanyIndex}][date]" value="" placeholder="例: 7月30日（水）" style="width: 100%;" />
                                </td>
                            </tr>
                            <tr>
                                <th><label>時間</label></th>
                                <td>
                                    <input type="text" name="open_company_events[${openCompanyIndex}][time]" value="" placeholder="例: 10:00～11:00" style="width: 100%;" />
                                </td>
                            </tr>
                            <tr>
                                <th><label>No</label></th>
                                <td>
                                    <input type="text" name="open_company_events[${openCompanyIndex}][number]" value="" placeholder="例: No.A0056" style="width: 100%;" />
                                </td>
                            </tr>
                            <tr>
                                <th><label>カテゴリ</label></th>
                                <td>
                                    <label style="display: inline-block; margin-right: 15px; margin-bottom: 5px;">
                                        <input type="checkbox" name="open_company_events[${openCompanyIndex}][category][]" value="説明会" /> 説明会
                                    </label>
                                    <label style="display: inline-block; margin-right: 15px; margin-bottom: 5px;">
                                        <input type="checkbox" name="open_company_events[${openCompanyIndex}][category][]" value="26卒" /> 26年卒
                                    </label>
                                    <label style="display: inline-block; margin-right: 15px; margin-bottom: 5px;">
                                        <input type="checkbox" name="open_company_events[${openCompanyIndex}][category][]" value="オンライン" /> オンライン
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <th><label>受付状況</label></th>
                                <td>
                                    <label style="display: inline-block; margin-right: 15px; margin-bottom: 5px;">
                                        <input type="radio" name="open_company_events[${openCompanyIndex}][status]" value="受付中" /> 受付中
                                    </label>
                                    <label style="display: inline-block; margin-right: 15px; margin-bottom: 5px;">
                                        <input type="radio" name="open_company_events[${openCompanyIndex}][status]" value="終了" /> 終了
                                    </label>
                                </td>
                            </tr>
                        </table>
                    </div>
                `;
                
                $('.no-open_company-message').remove();
                $('#open_company-entries').append(newEvent);
                openCompanyIndex++;
                updateOpenCompanyNumbers();
            };
            
            // 説明会イベント削除
            window.removeSessionEvent = function(button) {
                $(button).closest('.session-event-entry').remove();
                updateSessionNumbers();
                
                if ($('.session-event-entry').length === 0) {
                    $('#session-entries').append('<p class="no-session-message" style="color: #666; font-style: italic;">説明会イベントが設定されていません。必要に応じて追加してください。</p>');
                }
            };
            
            // オープンカンパニーイベント削除
            window.removeOpencompanyEvent = function(button) {
                $(button).closest('.open_company-event-entry').remove();
                updateOpenCompanyNumbers();
                
                if ($('.open_company-event-entry').length === 0) {
                    $('#open_company-entries').append('<p class="no-open_company-message" style="color: #666; font-style: italic;">オープンカンパニーイベントが設定されていません。必要に応じて追加してください。</p>');
                }
            };
            
            // 説明会の番号更新
            function updateSessionNumbers() {
                $('.session-event-entry').each(function(index) {
                    $(this).attr('data-index', index);
                    $(this).find('h4').text('説明会イベント ' + (index + 1));
                    
                    $(this).find('input[name*="session_events"], textarea[name*="session_events"], select[name*="session_events"]').each(function() {
                        var name = $(this).attr('name');
                        var fieldName = name.match(/\[(\w+)\](\[\])?$/);
                        if (fieldName) {
                            var newName = 'session_events[' + index + '][' + fieldName[1] + ']' + (fieldName[2] || '');
                            $(this).attr('name', newName);
                        }
                    });
                });
            }
            
            // オープンカンパニーの番号更新
            function updateOpenCompanyNumbers() {
                $('.open_company-event-entry').each(function(index) {
                    $(this).attr('data-index', index);
                    $(this).find('h4').text('オープンカンパニーイベント ' + (index + 1));
                    
                    $(this).find('input[name*="open_company_events"], textarea[name*="open_company_events"], select[name*="open_company_events"]').each(function() {
                        var name = $(this).attr('name');
                        var fieldName = name.match(/\[(\w+)\](\[\])?$/);
                        if (fieldName) {
                            var newName = 'open_company_events[' + index + '][' + fieldName[1] + ']' + (fieldName[2] || '');
                            $(this).attr('name', newName);
                        }
                    });
                });
            }
        });
        </script>
        <?php
    }
}
add_action('admin_footer', 'session_admin_scripts');
?>
