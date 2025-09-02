<?php
/**
 * MW WP Form - お問い合わせ内容による条件分岐メール送信
 */

/**
 * お問い合わせ内容の選択肢によってメール内容を変更する
 * 
 * @param object $Mail メールオブジェクト
 * @param array $values フォームの値
 * @param object $Data データオブジェクト
 * @return object $Mail
 */
function arimitsu_conditional_mail($Mail, $values, $Data) {
    // お問い合わせ内容を取得
    $inquiry_type = $Data->get('type');
    
    // 基本的な送信者情報を取得
    $company = $Data->get('company') ? $Data->get('company') : '（未入力）';
    $department = $Data->get('department') ? $Data->get('department') : '（未入力）';
    $name = $Data->get('name') ? $Data->get('name') : '（未入力）';
    $name_kana = $Data->get('name_kana') ? $Data->get('name_kana') : '（未入力）';
    $post_code = $Data->get('post_code1') . '-' . $Data->get('post_code2');
    $prefectures = $Data->get('prefectures') ? $Data->get('prefectures') : '（未選択）';
    $city = $Data->get('city') ? $Data->get('city') : '（未入力）';
    $building = $Data->get('building') ? $Data->get('building') : '（未入力）';
    $tel = $Data->get('tel') ? $Data->get('tel') : '（未入力）';
    $fax = $Data->get('fax') ? $Data->get('fax') : '（未入力）';
    $email = $Data->get('email') ? $Data->get('email') : '（未入力）';
    $purchase = $Data->get('purchase') ? $Data->get('purchase') : '（未入力）';
    $industry = $Data->get('industry') ? implode('、', (array)$Data->get('industry')) : '（未選択）';
    $content_detail = $Data->get('content_detail') ? $Data->get('content_detail') : '（未入力）';
    
    // お問い合わせ内容による条件分岐
    switch ($inquiry_type) {
        case '製品に関して':
            $Mail->body = generate_product_inquiry_mail($name, $company, $department, $name_kana, $post_code, $prefectures, $city, $building, $tel, $fax, $email, $purchase, $industry, $content_detail, $inquiry_type);
            break;
            
        case '修理に関して':
            $Mail->body = generate_repair_inquiry_mail($name, $company, $department, $name_kana, $post_code, $prefectures, $city, $building, $tel, $fax, $email, $purchase, $industry, $content_detail, $inquiry_type);
            break;
            
        case 'お見積もりデモのご依頼':
            $Mail->body = generate_estimate_demo_mail($name, $company, $department, $name_kana, $post_code, $prefectures, $city, $building, $tel, $fax, $email, $purchase, $industry, $content_detail, $inquiry_type);
            break;
            
        case 'その他':
            $Mail->body = generate_other_inquiry_mail($name, $company, $department, $name_kana, $post_code, $prefectures, $city, $building, $tel, $fax, $email, $purchase, $industry, $content_detail, $inquiry_type);
            break;
            
        default:
            // デフォルトのメール内容
            $Mail->body = generate_default_inquiry_mail($name, $company, $department, $name_kana, $post_code, $prefectures, $city, $building, $tel, $fax, $email, $purchase, $industry, $content_detail, $inquiry_type);
            break;
    }
    
    return $Mail;
}

/**
 * 製品に関するお問い合わせメールテンプレート
 */
function generate_product_inquiry_mail($name, $company, $department, $name_kana, $post_code, $prefectures, $city, $building, $tel, $fax, $email, $purchase, $industry, $content_detail, $inquiry_type) {
    return $name . "様

この度は弊社製品についてお問い合わせいただき、誠にありがとうございます。
製品に関するご質問・ご相談について、担当者より詳しくご案内させていただきます。

製品カタログや詳細資料をご希望の場合は、別途お送りいたします。
ご不明な点がございましたら、お気軽にお声がけください。

担当：製品営業部
電話：06-6973-2001（代表）
メール：info@arimitsu.co.jp

" . generate_common_mail_content($name, $company, $department, $name_kana, $post_code, $prefectures, $city, $building, $tel, $fax, $email, $purchase, $industry, $content_detail, $inquiry_type);
}

/**
 * 修理に関するお問い合わせメールテンプレート
 */
function generate_repair_inquiry_mail($name, $company, $department, $name_kana, $post_code, $prefectures, $city, $building, $tel, $fax, $email, $purchase, $industry, $content_detail, $inquiry_type) {
    return $name . "様

この度は修理に関するお問い合わせをいただき、誠にありがとうございます。
製品の修理・メンテナンスについて、サービス担当者より迅速にご対応いたします。

修理のお見積りや部品の在庫状況など、詳細につきましては
改めて担当者よりご連絡させていただきます。

担当：サービス部
電話：06-6973-2001（代表）
緊急時：080-xxxx-xxxx（サービス直通）
メール：service@arimitsu.co.jp

" . generate_common_mail_content($name, $company, $department, $name_kana, $post_code, $prefectures, $city, $building, $tel, $fax, $email, $purchase, $industry, $content_detail, $inquiry_type);
}

/**
 * お見積もり・デモのご依頼メールテンプレート
 */
function generate_estimate_demo_mail($name, $company, $department, $name_kana, $post_code, $prefectures, $city, $building, $tel, $fax, $email, $purchase, $industry, $content_detail, $inquiry_type) {
    return $name . "様

この度はお見積もり・デモンストレーションのご依頼をいただき、誠にありがとうございます。
ご要望に応じた最適なソリューションをご提案させていただきます。

デモンストレーションの日程調整や詳細なお見積もりにつきまして、
営業担当者より2営業日以内にご連絡いたします。

担当：営業部
電話：06-6973-2001（代表）
メール：sales@arimitsu.co.jp

" . generate_common_mail_content($name, $company, $department, $name_kana, $post_code, $prefectures, $city, $building, $tel, $fax, $email, $purchase, $industry, $content_detail, $inquiry_type);
}

/**
 * その他のお問い合わせメールテンプレート
 */
function generate_other_inquiry_mail($name, $company, $department, $name_kana, $post_code, $prefectures, $city, $building, $tel, $fax, $email, $purchase, $industry, $content_detail, $inquiry_type) {
    return $name . "様

この度はお問い合わせいただき、誠にありがとうございます。
お客様のご質問・ご相談について、適切な担当者より
詳しくご回答させていただきます。

内容を確認の上、2営業日以内にご連絡いたします。

担当：お客様サポート
電話：06-6973-2001（代表）
メール：info@arimitsu.co.jp

" . generate_common_mail_content($name, $company, $department, $name_kana, $post_code, $prefectures, $city, $building, $tel, $fax, $email, $purchase, $industry, $content_detail, $inquiry_type);
}

/**
 * デフォルトのお問い合わせメールテンプレート
 */
function generate_default_inquiry_mail($name, $company, $department, $name_kana, $post_code, $prefectures, $city, $building, $tel, $fax, $email, $purchase, $industry, $content_detail, $inquiry_type) {
    return $name . "様

この度はお問い合わせいただき、誠にありがとうございます。
お客様のお問い合わせ内容を確認し、担当者より
改めてご連絡させていただきます。

担当：お客様サポート
電話：06-6973-2001（代表）
メール：info@arimitsu.co.jp

" . generate_common_mail_content($name, $company, $department, $name_kana, $post_code, $prefectures, $city, $building, $tel, $fax, $email, $purchase, $industry, $content_detail, $inquiry_type);
}

/**
 * 共通のメール内容部分を生成
 */
function generate_common_mail_content($name, $company, $department, $name_kana, $post_code, $prefectures, $city, $building, $tel, $fax, $email, $purchase, $industry, $content_detail, $inquiry_type) {
    return "
─ご送信内容の確認─────────────────

[ お問い合わせ内容 ]: " . $inquiry_type . "
[ 会社名 ]: " . $company . "
[ 部署名 ]: " . $department . "
[ お名前 ]: " . $name . "
[ お名前（ふりがな） ]: " . $name_kana . "
[ 郵便番号 ]: " . $post_code . "
[ 都道府県 ]: " . $prefectures . "
[ 市区町村 ]: " . $city . "
[ ビル/マンション名 ]: " . $building . "
[ 電話番号 ]: " . $tel . "
[ FAX番号 ]: " . $fax . "
[ メールアドレス ]: " . $email . "
[ ご購入先 ]: " . $purchase . "
[ 業種 ]: " . $industry . "
[ 製品に関するお問い合わせ ]: " . $content_detail . "

──────────────────────────

このメールに心当たりの無い場合は、お手数ですが
下記連絡先までお問い合わせください。
この度はお問い合わせいただき、重ねてお礼申し上げます。

＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝

有光工業株式会社
〒537-0025 大阪市東成区中道1丁目10番21号
TEL: 06-6973-2001
FAX: 06-6973-2072
E-mail: info@arimitsu.co.jp
https://www.arimitsu.co.jp/

＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
";
}

// MW WP Formのフィルターフックに関数を追加
// 注意：フォーム識別子は実際のフォームIDに合わせて変更してください
add_filter('mwform_auto_mail_mw-wp-form-137', 'arimitsu_conditional_mail', 10, 3);

?>
