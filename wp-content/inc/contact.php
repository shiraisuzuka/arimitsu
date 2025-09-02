<?php

/**
 * セッションの初期化
 * MW WP Formのセッション管理とアクセス制御のために必要
 */
function init_session() {
    if (!session_id()) {
        session_start();
    }
}
add_action('init', 'init_session');

/**
 * 確認画面・完了画面への直接アクセスを防ぐ機能（改良版）
 */
function prevent_direct_access_to_form_pages() {
    // 管理画面やAJAXリクエストの場合はスキップ
    if (is_admin() || wp_doing_ajax()) {
        return;
    }
    
    // 確認画面の制御
    if (is_page('confirm')) {
        // POSTデータがある場合（通常のフォーム送信）は許可
        if (!empty($_POST)) {
            return;
        }
        
        // リファラーチェック（直接アクセスの防止）
        $referer = wp_get_referer();
        if (!$referer) {
            wp_redirect(home_url('/contact/'));
            exit;
        }
        
        // お問い合わせページまたは確認画面自体からのアクセスは許可
        if (strpos($referer, '/contact/') !== false || strpos($referer, '/contact/confirm/') !== false) {
            return;
        }
        
        // その他の場合はリダイレクト
        wp_redirect(home_url('/contact/'));
        exit;
    }
    
    // 完了画面の制御
    if (is_page('complete')) {
        // POSTデータがある場合（フォーム送信完了）は許可
        if (!empty($_POST)) {
            // セッションに完了フラグを設定
            if (!session_id()) {
                session_start();
            }
            $_SESSION['mwform_completed'] = true;
            return;
        }
        
        // セッションに完了フラグがある場合は許可
        if (!session_id()) {
            session_start();
        }
        if (isset($_SESSION['mwform_completed'])) {
            return;
        }
        
        // リファラーチェック
        $referer = wp_get_referer();
        if ($referer && strpos($referer, '/contact/confirm/') !== false) {
            return;
        }
        
        // その他の場合はリダイレクト
        wp_redirect(home_url('/contact/'));
        exit;
    }
}
add_action('template_redirect', 'prevent_direct_access_to_form_pages');

/**
 * 完了画面表示後にセッションをクリア（遅延実行）
 */
function clear_form_session_after_complete() {
    if (is_page('complete')) {
        if (!session_id()) {
            session_start();
        }
        // JavaScript実行後にセッションをクリア
        add_action('wp_footer', function() {
            echo '<script>
                setTimeout(function() {
                    // 5秒後にセッションクリアのAJAXリクエストを送信
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "' . admin_url('admin-ajax.php') . '", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xhr.send("action=clear_mwform_session");
                }, 5000);
            </script>';
        });
    }
}
add_action('wp', 'clear_form_session_after_complete');

/**
 * AJAXでセッションをクリア
 */
function ajax_clear_mwform_session() {
    if (!session_id()) {
        session_start();
    }
    if (isset($_SESSION['mwform_completed'])) {
        unset($_SESSION['mwform_completed']);
    }
    wp_die();
}
add_action('wp_ajax_clear_mwform_session', 'ajax_clear_mwform_session');
add_action('wp_ajax_nopriv_clear_mwform_session', 'ajax_clear_mwform_session');


?>