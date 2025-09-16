<!DOCTYPE html>
<html lang="ja">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <meta name="robots" content="max-image-preview:large">
  <meta name="format-detection" content="telephone=no">

  <?php if ( is_front_page() ) : ?>
  <title><?php echo the_title(); ?>｜<?php echo get_bloginfo('name'); ?></title>
  <meta name="description" content="<?php 
    $site_description = get_bloginfo('description');
    if (!empty($site_description)) {
      echo $site_description;
    } else {
      echo '「私たちは、次代に挑む動力となる」有光工業株式会社のWebサイトです。企業情報、農業機械、産業機械、採用情報などの情報がご覧いただけます。"';
    }
  ?>">
  <meta property="og:title" content="<?php echo the_title(); ?>｜<?php echo get_bloginfo('name'); ?>">
  <meta property="og:type" content="website">
  <meta property="og:description" content="<?php 
    $site_description = get_bloginfo('description');
    if (!empty($site_description)) {
      echo $site_description;
    } else {
      echo '「私たちは、次代に挑む動力となる」有光工業株式会社のWebサイトです。企業情報、農業機械、産業機械、採用情報などの情報がご覧いただけます。"';
    }
  ?>">
  <meta property="og:locale:alternate" content="ja_JP">
  <meta property="og:url" content="<?php echo get_permalink(); ?>">
  <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>">
  <meta name="twitter:card" content="summary">

  <?php elseif ( is_page()  ): ?>
  <title><?php echo the_title(); ?>｜<?php echo get_bloginfo('name'); ?></title>
  <meta property="og:title" content="<?php echo the_title(); ?>｜<?php echo get_bloginfo('name'); ?>">
  <meta property="og:type" content="article">
  <meta property="og:locale:alternate" content="ja_JP">
  <meta property="og:url" content="<?php echo get_permalink(); ?>">
  <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>">
  <meta name="twitter:card" content="summary">

  <?php elseif ( is_archive()  ): ?>
  <title><?php the_archive_title(); ?>｜<?php echo get_bloginfo('name'); ?></title>
  <meta property="og:title" content="<?php the_archive_title(); ?>｜<?php echo get_bloginfo('name'); ?>">
  <meta property="og:type" content="article">
  <meta property="og:locale:alternate" content="ja_JP">
  <meta property="og:url" content="<?php echo get_permalink(); ?>">
  <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>">
  <meta name="twitter:card" content="summary">

  <?php elseif ( is_single()  ): ?>
  <title><?php echo the_title(); ?>｜<?php echo get_bloginfo('name'); ?></title>
  <meta property="og:title" content="<?php echo the_title(); ?>｜<?php echo get_bloginfo('name'); ?>">
  <meta property="og:type" content="article">
  <meta property="og:locale:alternate" content="ja_JP">
  <meta property="og:url" content="<?php echo get_permalink(); ?>">
  <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>">
  <meta name="twitter:card" content="summary">
  <?php endif; ?>

  <?php if ( is_singular('product') || is_singular('news') ) : ?>
  <?php 
  $product_description = get_post_meta(get_the_ID(), '_product_description', true);
  if (!empty($product_description)): ?>
  <meta name="description" content="<?php echo esc_attr($product_description); ?>">
  <meta property="og:description" content="<?php echo esc_attr($product_description); ?>">
  <?php else: ?>
  <meta name="description" content="">
  <meta property="og:description" content="">
  <?php endif; ?>

  <?php elseif ( is_post_type_archive('product')  ): ?>
  <meta name="description" content="有光工業株式会社の製品一覧ページです。農業機械・産業機械を網羅し、検索機能を使って高圧ポンプ、洗浄機、泡洗浄装置など目的別・用途別に簡単に絞り込むことができます。">
  <meta property="og:description" content="有光工業株式会社の製品一覧ページです。農業機械・産業機械を網羅し、検索機能を使って高圧ポンプ、洗浄機、泡洗浄装置など目的別・用途別に簡単に絞り込むことができます。">

  <?php elseif ( is_post_type_archive('news') || is_tax('news_cat') ): ?>
  <meta name="description" content="有光工業株式会社のお知らせ一覧ページです。新商品情報、イベント出展、採用・社内の新体制や技術開発など、最新の企業活動や重要なお知らせを時系列でご確認いただけます。">
  <meta property="og:description" content="有光工業株式会社のお知らせ一覧ページです。新商品情報、イベント出展、採用・社内の新体制や技術開発など、最新の企業活動や重要なお知らせを時系列でご確認いただけます。">

  <?php elseif ( is_page('company')  ): ?>
  <meta name="description" content="有光工業株式会社の企業情報がご覧いただける企業情報ページです。ごあいさつ、会社概要、沿革、組織体制、事業所一覧、環境保全活動、品質保証体制がご覧いただけます。">
  <meta property="og:description" content="有光工業株式会社の企業情報がご覧いただける企業情報ページです。ごあいさつ、会社概要、沿革、組織体制、事業所一覧、環境保全活動、品質保証体制がご覧いただけます。">

  <?php elseif ( is_page('about')  ): ?>
  <meta name="description" content="有光工業株式会社の会社概要のページです。会社名、所在地、設立年、事業内容など、企業の基本情報を掲載しています。">
  <meta property="og:description" content="有光工業株式会社の会社概要のページです。会社名、所在地、設立年、事業内容など、企業の基本情報を掲載しています。">

  <?php elseif ( is_page('history')  ): ?>
  <meta name="description" content="有光工業株式会社の沿革ページです。1923年の創業以来の歩みを年表形式でご紹介。">
  <meta property="og:description" content="有光工業株式会社の沿革ページです。1923年の創業以来の歩みを年表形式でご紹介。">

  <?php elseif ( is_page('technology')  ): ?>
  <meta name="description" content="有光工業株式会社の技術情報を紹介するページです。ポンプのしくみ、調圧弁のしくみ、静電付加のしくみなどをわかりやすく解説しています。">
  <meta property="og:description" content="有光工業株式会社の技術情報を紹介するページです。ポンプのしくみ、調圧弁のしくみ、静電付加のしくみなどをわかりやすく解説しています。">

  <?php elseif ( is_page('classroom01')  ): ?>
  <meta name="description" content="有光工業株式会社の技術情報を紹介するページです。ポンプのしくみをわかりやすく解説します。">
  <meta property="og:description" content="有光工業株式会社の技術情報を紹介するページです。ポンプのしくみをわかりやすく解説します。">

  <?php elseif ( is_page('classroom02')  ): ?>
  <meta name="description" content="有光工業株式会社の技術情報を紹介するページです。ポンプ（オイル）についてをわかりやすく解説します。">
  <meta property="og:description" content="有光工業株式会社の技術情報を紹介するページです。ポンプ（オイル）についてをわかりやすく解説します。">

  <?php elseif ( is_page('classroom03')  ): ?>
  <meta name="description" content="有光工業株式会社の技術情報を紹介するページです。調圧弁のしくみをわかりやすく解説します。">
  <meta property="og:description" content="有光工業株式会社の技術情報を紹介するページです。調圧弁のしくみをわかりやすく解説します。">

  <?php elseif ( is_page('classroom04')  ): ?>
  <meta name="description" content="有光工業株式会社の技術情報を紹介するページです。アンローダバルブのしくみをわかりやすく解説します。">
  <meta property="og:description" content="有光工業株式会社の技術情報を紹介するページです。アンローダバルブのしくみをわかりやすく解説します。">

  <?php elseif ( is_page('classroom05')  ): ?>
  <meta name="description" content="有光工業株式会社の技術情報を紹介するページです。静電付加をわかりやすく解説します。">
  <meta property="og:description" content="有光工業株式会社の技術情報を紹介するページです。静電付加をわかりやすく解説します。">

  <?php elseif ( is_page('classroom06')  ): ?>
  <meta name="description" content="有光工業株式会社の技術情報を紹介するページです。圧力一定制御をわかりやすく解説します。">
  <meta property="og:description" content="有光工業株式会社の技術情報を紹介するページです。圧力一定制御をわかりやすく解説します。">

  <?php elseif ( is_page('classroom07')  ): ?>
  <meta name="description" content="有光工業株式会社の技術情報を紹介するページです。フォームクリーニングをわかりやすく解説します。">
  <meta property="og:description" content="有光工業株式会社の技術情報を紹介するページです。フォームクリーニングをわかりやすく解説します。">

  <?php elseif ( is_page('classroom08')  ): ?>
  <meta name="description" content="有光工業株式会社の技術情報を紹介するページです。少量散布をわかりやすく解説します。">
  <meta property="og:description" content="有光工業株式会社の技術情報を紹介するページです。少量散布をわかりやすく解説します。">

  <?php elseif ( is_page('recruit')  ): ?>
  <meta name="description" content="有光工業株式会社の採用情報ページです。新卒・中途採用の募集要項、業務内容、求める人材像、働く環境や福利厚生をわかりやすく掲載。製造、技術系、営業系など多様な職種で皆様の挑戦をお待ちしています。">
  <meta property="og:description" content="有光工業株式会社の採用情報ページです。新卒・中途採用の募集要項、業務内容、求める人材像、働く環境や福利厚生をわかりやすく掲載。製造、技術系、営業系など多様な職種で皆様の挑戦をお待ちしています。">

  <?php elseif ( is_page('arimitsu')  ): ?>
  <meta name="description" content="有光工業株式会社の会社概要のページです。会社名、所在地、設立年、事業内容など、企業の基本情報を掲載しています。">
  <meta property="og:description" content="有光工業株式会社の会社概要のページです。会社名、所在地、設立年、事業内容など、企業の基本情報を掲載しています。">

  <?php elseif ( is_page('recruitment')  ): ?>
  <meta name="description" content="有光工業株式会社の新卒・中途採用向け募集要項ページです。募集職種、勤務地、勤務条件、選考フロー、応募方法など、採用に関する詳細情報をご案内します。">
  <meta property="og:description" content="有光工業株式会社の新卒・中途採用向け募集要項ページです。募集職種、勤務地、勤務条件、選考フロー、応募方法など、採用に関する詳細情報をご案内します。">

  <?php elseif ( is_page('session')  ): ?>
  <meta name="description" content="有光工業の会社説明会・採用イベント情報を掲載しています。事業内容や働き方を詳しく知りたい方はぜひご参加ください。">
  <meta property="og:description" content="有光工業の会社説明会・採用イベント情報を掲載しています。事業内容や働き方を詳しく知りたい方はぜひご参加ください。">

  <?php elseif ( is_page('qanda')  ): ?>
  <meta name="description" content="新卒・中途採用に関するよくある質問を掲載しています。応募方法や選考フロー、会社説明会の参加方法など、就職活動中の皆さまの疑問にお答えします。">
  <meta property="og:description" content="新卒・中途採用に関するよくある質問を掲載しています。応募方法や選考フロー、会社説明会の参加方法など、就職活動中の皆さまの疑問にお答えします。">

  <?php elseif ( is_page('catalog')  ): ?>
  <meta name="description" content="有光工業株式会社のカタログダウンロードページです。高圧ポンプ、洗浄機、泡洗浄装置など各種製品のカタログをPDF形式でダウンロードいただけます。">
  <meta property="og:description" content="有光工業株式会社のカタログダウンロードページです。高圧ポンプ、洗浄機、泡洗浄装置など各種製品のカタログをPDF形式でダウンロードいただけます。">

  <?php elseif ( is_page('contact') || is_page('confirm') || is_page('complete') ): ?>
  <meta name="description" content="有光工業株式会社のお問い合わせページです。製品に関するご質問、技術的なご相談、資料請求、採用に関するお問い合わせなどを、専用フォームから受け付けています。">
  <meta property="og:description" content="有光工業株式会社のお問い合わせページです。製品に関するご質問、技術的なご相談、資料請求、採用に関するお問い合わせなどを、専用フォームから受け付けています。">

  <?php elseif ( is_page('privacypolicy')  ): ?>
  <meta name="description" content="有光工業株式会社のプライバシーポリシーです。個人情報の取得・利用・管理・第三者提供に関する方針を定め、適切な保護と安全管理に努めています。">
  <meta property="og:description" content="有光工業株式会社のプライバシーポリシーです。個人情報の取得・利用・管理・第三者提供に関する方針を定め、適切な保護と安全管理に努めています。">

  <?php endif; ?>

  <link rel="shortcut icon" href="<?php temp_path(); ?>/favicon.ico" type="image/vnd.microsoft.icon">
  <link rel="icon" href="<?php temp_path(); ?>/favicon.ico" type="image/vnd.microsoft.icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=BIZ+UDPMincho:wght@400&family=Noto+Sans+JP:wght@400;500;700;900&family=Roboto:wght@400;700&family=Lato:wght@700&display=swap" rel="stylesheet">

  <?php if ( is_singular('product') ) : ?>
  <!-- Splide -->
  <link rel="stylesheet" href="<?php assets_path(); ?>/css/splide.min.css">
  <?php endif; ?>

  <?php if ( is_page('classroom01') || is_page('classroom02') || is_page('classroom03') || is_page('classroom04') || is_page('classroom05') || is_page('classroom06') || is_page('classroom07') || is_page('classroom08') ) : ?>
  <link rel="stylesheet" href="<?php assets_path(); ?>/css/splide.min.css">
  <?php endif; ?>

  <!-- <link rel="preload" as="image" href="<?php img_path(); ?>/images/img_mv.jpg"> -->

  <?php if (is_404()) : ?>
  <meta http-equiv="refresh" content=" 3; url=<?php page_path(''); ?>">
  <?php endif; ?>

  <?php wp_head(); ?>
</head>
<body>

<?php 
// recruitページまたはその子ページかどうかを判定
$is_recruit_page = false;
$is_english_page = false;

// 現在のページがrecruitの固定ページかチェック
if (is_page('recruit')) {
    $is_recruit_page = true;
}

// 現在のページがenglishの固定ページかチェック
if (is_page('english')) {
    $is_english_page = true;
}

// 現在のページがrecruitの子ページかチェック
$current_page = get_queried_object();
if ($current_page && isset($current_page->post_parent)) {
    $ancestors = get_post_ancestors($current_page->ID);
    foreach ($ancestors as $ancestor_id) {
        $ancestor = get_post($ancestor_id);
        if ($ancestor && $ancestor->post_name === 'recruit') {
            $is_recruit_page = true;
            break;
        }
    }
}
if ($current_page && isset($current_page->post_parent)) {
    $ancestors = get_post_ancestors($current_page->ID);
    foreach ($ancestors as $ancestor_id) {
        $ancestor = get_post($ancestor_id);
        if ($ancestor && $ancestor->post_name === 'english') {
            $is_english_page = true;
            break;
        }
    }
}


// 現在のページのスラッグがrecruitで始まるかチェック
if ($current_page && isset($current_page->post_name)) {
    $post_slug = $current_page->post_name;
    $uri = $_SERVER['REQUEST_URI'];
    if (strpos($uri, '/recruit/') !== false || strpos($uri, '/recruit') !== false) {
        $is_recruit_page = true;
    }
}
if ($current_page && isset($current_page->post_name)) {
    $post_slug = $current_page->post_name;
    $uri = $_SERVER['REQUEST_URI'];
    if (strpos($uri, '/english/') !== false || strpos($uri, '/english') !== false) {
        $is_english_page = true;
    }
}
?>

<?php if ($is_recruit_page): ?>
<header class="l-header recruit">
  <div class="l-header-inner">
    <div class="l-header-logo">
      <a href="<?php page_path('recruit'); ?>"><img src="<?php img_path(); ?>/logo_white.svg" alt="有光工業株式会社" loading="lazy" width="336" height="29"></a>
    </div>
    <button class="l-header-nav-btn">
      <span></span>
      <span></span>
    </button>
    <nav class="l-header-nav-hamburger">
      <ul class="l-header-nav-hamburger-list">
        <li class="l-header-nav-hamburger-item">
          <span class="no-arrow">採用情報</span>
          <ul>
            <li>
              <a href="<?php page_path('recruit'); ?>">採用情報</a>
            </li>
            <li>
              <a href="<?php page_path('recruit/recruitment'); ?>">募集要項</a>
            </li>
            <li>
              <a href="<?php page_path('recruit/arimitsu'); ?>">有光を知る</a>
            </li>
            <li>
              <a href="<?php page_path('recruit/session'); ?>">説明会・イベント</a>
            </li>
            <li>
              <a href="<?php page_path('recruit/qanda'); ?>">Q&A</a>
            </li>
          </ul>
        </li>
      </ul>
      <ul class="l-header-nav-hamburger-bottom">
        <li>
          <a href="<?php page_path('sitemap'); ?>">サイトマップ</a>
        </li>
        <li>
          <a href="<?php page_path('privacypolicy'); ?>">プライバシーポリシー</a>
        </li>
      </ul>
      <div class="l-header-nav-hamburger-contact">
        <a href="https://job.rikunabi.com/2026/company/r313312020/" target="_blank" class="recruit-btn">エントリー（新卒）</a>
        <a href="https://doda.jp/DodaFront/View/CompanyJobs/j_id__10007455316/" target="_blank" class="recruit-btn">エントリー（中途）</a>
      </div>
    </nav>
    <nav class="l-header-nav">
      <ul class="l-header-nav-list">
        <li class="l-header-nav-item">
          <a href="<?php page_path('recruit/recruitment'); ?>">募集要項</a>
        </li>
        <li class="l-header-nav-item">
          <a href="<?php page_path('recruit/arimitsu'); ?>">有光を知る</a>
        </li>
        <li class="l-header-nav-item">
          <a href="<?php page_path('recruit/session'); ?>">説明会・イベント</a>
        </li>
        <li class="l-header-nav-item">
          <a href="<?php page_path('recruit/qanda'); ?>">Q&A</a>
        </li>
        <li class="l-header-nav-item">
          <a href="<?php page_path('') ?>" target="_blank">コーポレートサイト</a>
        </li>
      </ul>
      <ul class="l-header-nav-recruit">
        <li>
          <a href="https://job.rikunabi.com/2026/company/r313312020/" target="_blank" class="recruit-btn">エントリー（新卒）</a>
        </li>
        <li>
          <a href="https://doda.jp/DodaFront/View/CompanyJobs/j_id__10007455316/" target="_blank" class="recruit-btn">エントリー（中途）</a>
        </li>
      </ul>
    </nav>
  </div>
</header>

<?php elseif ($is_english_page): ?>
<header class="l-header en">
  <div class="l-header-inner">
    <h1 class="l-header-logo">
      <a href="<?php page_path('english'); ?>"><img src="<?php img_path(); ?>/logo_color.svg" alt="有光工業株式会社" loading="lazy" width="336" height="29"></a>
    </h1>
    <button class="l-header-nav-btn">
      <span></span>
      <span></span>
    </button>
    <nav class="l-header-nav-hamburger">
      <div class="l-header-nav-hamburger-select">
        <select class="l-header-nav-select" data-url-jp="<?php echo esc_url( home_url('/') ); ?>" data-url-en="<?php echo esc_url( home_url('/english/') ); ?>">
          <option value="jp">JP</option>
          <option value="en">EN</option>
        </select>
      </div>
      <ul class="l-header-nav-hamburger-list">
        <li class="l-header-nav-hamburger-item">
          <a href="<?php page_path('english/company'); ?>">about us</a>
        </li>
        <li class="l-header-nav-hamburger-item">
          <a href="<?php page_path('english/agricultural-machinery'); ?>">agricultural machinery</a>
        </li>

        <li class="l-header-nav-hamburger-item">
          <a href="<?php page_path('english/industrial-machinery'); ?>">industrial machinery</a>
        </li>
      </ul>
    </nav>
    <nav class="l-header-nav">
      <ul class="l-header-nav-list">
        <li class="l-header-nav-item">
          <a href="<?php page_path('english/company'); ?>">about us</a>
        </li>
        <li class="l-header-nav-item">
          <a href="<?php page_path('english/agricultural-machinery'); ?>">agricultural machinery</a>
        </li>
        <li class="l-header-nav-item">
          <a href="<?php page_path('english/industrial-machinery'); ?>">industrial machinery</a>
        </li>
      </ul>
      <ul class="l-header-nav-btns">
        <li>
          <select class="l-header-nav-select" data-url-jp="<?php echo esc_url( home_url('/') ); ?>" data-url-en="<?php echo esc_url( home_url('/english/') ); ?>">
            <option value="jp">JP</option>
            <option value="en">EN</option>
          </select>
        </li>
      </ul>
    </nav>
  </div>
</header>

<?php else: ?>
<header class="l-header">
  <div class="l-header-inner">
    <h1 class="l-header-logo">
      <a href="<?php page_path(); ?>"><img src="<?php img_path(); ?>/logo_color.svg" alt="有光工業株式会社" width="336" height="29"></a>
    </h1>
    <button class="l-header-nav-btn">
      <span></span>
      <span></span>
    </button>
    <nav class="l-header-nav-hamburger">
      <div class="l-header-nav-hamburger-select">
        <select class="l-header-nav-select" data-url-jp="<?php echo esc_url( home_url('/') ); ?>" data-url-en="<?php echo esc_url( home_url('/english/') ); ?>">
          <option value="jp">JP</option>
          <option value="en">EN</option>
        </select>
      </div>
      <ul class="l-header-nav-hamburger-list">
        <li class="l-header-nav-hamburger-item">
          <span class="no-arrow">企業情報</span>
            <ul>
              <li>
                <a href="<?php page_path('company'); ?>">企業情報</a>
              </li>
              <li>
                <a href="<?php page_path('company/about'); ?>">会社概要</a>
              </li>
              <li>
                <a href="<?php page_path('company/history'); ?>">沿革</a>
              </li>
            </ul>
        </li>
        <li class="l-header-nav-hamburger-item">
          <span class="no-arrow">製品</span>
          <ul>
            <li>
              <a href="<?php page_path('product'); ?>">製品一覧</a>
            </li>
            <li>
              <a href="DUMMY">01農業機械</a>
            </li>
            <li>
              <a href="DUMMY">02ポンプ</a>
            </li>
            <li>
              <a href="DUMMY">03洗浄機</a>
            </li>
            <li>
              <a href="DUMMY">04アタッチメント<span>（洗浄機のノズル等）</span></a>
            </li>
            <li>
              <a href="DUMMY">05ミスト</a>
            </li>
            <li>
              <a href="DUMMY">06その他<span>（オートマット、トルミング等）</span></a>
            </li>
            <li>
              <a href="<?php page_path('catalog'); ?>">カタログダウンロード</a>
            </li>
            <li>
              <a href="https://www.youtube.com/channel/UCIGZY9G9hTRGFn40E016o5Q" target="_blank">動画一覧</a>
            </li>
          </ul>
        </li>
        <li class="l-header-nav-hamburger-item">
          <span class="no-arrow">最新情報</span>
          <ul>
            <li>
              <a href="<?php page_path('news'); ?>">お知らせ一覧</a>
            </li>
          </ul>
        </li>
        <li class="l-header-nav-hamburger-item">
          <span class="no-arrow">技術情報</span>
          <ul>
            <li>
              <a href="<?php page_path('technology'); ?>">技術情報</a>
            </li>
            <li>
              <a href="<?php page_path('technology/classroom01'); ?>">ポンプのしくみ</a>
            </li>
            <li>
              <a href="<?php page_path('technology/classroom02'); ?>">ポンプ（オイル）について</a>
            </li>
            <li>
              <a href="<?php page_path('technology/classroom03'); ?>">調圧弁のしくみ</a>
            </li>
            <li>
              <a href="<?php page_path('technology/classroom04'); ?>">アンローダバルブのしくみ</a>
            </li>
            <li>
              <a href="<?php page_path('technology/classroom05'); ?>">静電付加</a>
            </li>
            <li>
              <a href="<?php page_path('technology/classroom06'); ?>">圧力一定制御</a>
            </li>
            <li>
              <a href="<?php page_path('technology/classroom07'); ?>">フォームクリーニング</a>
            </li>
            <li>
              <a href="<?php page_path('technology/classroom08'); ?>">少量散布</a>
            </li>
          </ul>
        </li>
        <li class="l-header-nav-hamburger-item">
          <span class="no-arrow">採用情報</span>
          <ul>
            <li>
              <a href="<?php page_path('recruit'); ?>">採用情報</a>
            </li>
            <li>
              <a href="<?php page_path('recruit/recruitment'); ?>">募集要項</a>
            </li>
            <li>
              <a href="<?php page_path('recruit/arimitsu'); ?>">有光を知る</a>
            </li>
            <li>
              <a href="<?php page_path('recruit/session'); ?>">説明会・イベント</a>
            </li>
            <li>
              <a href="<?php page_path('recruit/qanda'); ?>">Q&A</a>
            </li>
          </ul>
        </li>
      </ul>
      <ul class="l-header-nav-hamburger-bottom">
        <li>
          <a href="<?php page_path('sitemap'); ?>">サイトマップ</a>
        </li>
        <li>
          <a href="<?php page_path('privacypolicy'); ?>">プライバシーポリシー</a>
        </li>
      </ul>
      <div class="l-header-nav-hamburger-contact">
        <a href="<?php page_path('contact'); ?>" class="l-header-nav-contact c-btn">お問い合わせ</a>
      </div>
    </nav>
    <nav class="l-header-nav">
      <ul class="l-header-nav-list">
        <li class="l-header-nav-item">
          <span>企業情報</span>
          <ul class="l-header-nav-sub-list">
            <li>
              <a href="<?php page_path('company'); ?>">企業情報</a>
            </li>
            <li>
              <a href="<?php page_path('company/about'); ?>">会社概要</a>
            </li>
            <li>
              <a href="<?php page_path('company/history'); ?>">沿革</a>
            </li>
          </ul>
        </li>
        <li class="l-header-nav-item">
          <span>製品</span>
          <ul class="l-header-nav-sub-list">
            <li>
              <a href="<?php page_path('product'); ?>">製品一覧</a>
            </li>
            <li>
              <a href="<?php echo esc_url(get_post_type_archive_link('product') . '?product_categories[]=agricultural_machinery'); ?>">01農業機械</a>
            </li>
            <li>
              <a href="<?php echo esc_url(get_post_type_archive_link('product') . '?product_categories[]=pump'); ?>">02ポンプ</a>
            </li>
            <li>
              <a href="<?php echo esc_url(get_post_type_archive_link('product') . '?product_categories[]=cleaning_machine'); ?>">03洗浄機</a>
            </li>
            <li>
              <a href="<?php echo esc_url(get_post_type_archive_link('product') . '?product_categories[]=attachment'); ?>">04アタッチメント<span>（洗浄機のノズル等）</span></a>
            </li>
            <li>
              <a href="<?php echo esc_url(get_post_type_archive_link('product') . '?product_categories[]=mist'); ?>">05ミスト</a>
            </li>
            <li>
              <a href="<?php echo esc_url(get_post_type_archive_link('product') . '?product_categories[]=other_product'); ?>">06その他<span>（オートマット、トルミング等）</span></a>
            </li>
            <li>
              <a href="catalog">カタログダウンロード</a>
            </li>
            <li>
              <a href="https://www.youtube.com/channel/UCIGZY9G9hTRGFn40E016o5Q" target="_blank">動画一覧</a>
            </li>
          </ul>
        </li>
        <li class="l-header-nav-item">
          <span>最新情報</span>
          <ul class="l-header-nav-sub-list">
            <li>
              <a href="<?php page_path('news'); ?>">お知らせ一覧</a>
            </li>
          </ul>
        </li>
        <li class="l-header-nav-item">
          <span>技術情報</span>
          <ul class="l-header-nav-sub-list">
            <li>
              <a href="<?php page_path('technology'); ?>">技術情報</a>
            </li>
            <li>
              <a href="<?php page_path('technology/classroom01'); ?>">ポンプのしくみ</a>
            </li>
            <li>
              <a href="<?php page_path('technology/classroom02'); ?>">ポンプ（オイル）について</a>
            </li>
            <li>
              <a href="<?php page_path('technology/classroom03'); ?>">調圧弁のしくみ</a>
            </li>
            <li>
              <a href="<?php page_path('technology/classroom04'); ?>">アンローダバルブのしくみ</a>
            </li>
            <li>
              <a href="<?php page_path('technology/classroom05'); ?>">静電付加</a>
            </li>
            <li>
              <a href="<?php page_path('technology/classroom06'); ?>">圧力一定制御</a>
            </li>
            <li>
              <a href="<?php page_path('technology/classroom07'); ?>">フォームクリーニング</a>
            </li>
            <li>
              <a href="<?php page_path('technology/classroom08'); ?>">少量散布</a>
            </li>
          </ul>
        </li>
        <li class="l-header-nav-item">
          <span>採用情報</span>
          <ul class="l-header-nav-sub-list">
            <li>
              <a href="<?php page_path('recruit'); ?>">採用情報</a>
            </li>
            <li>
              <a href="<?php page_path('recruit/recruitment'); ?>">募集要項</a>
            </li>
            <li>
              <a href="<?php page_path('recruit/arimitsu'); ?>">有光を知る</a>
            </li>
            <li>
              <a href="<?php page_path('recruit/session'); ?>">説明会・イベント</a>
            </li>
            <li>
            <li>
              <a href="<?php page_path('recruit/qanda'); ?>">Q&A</a>
            </li>
          </ul>
        </li>
      </ul>
      <ul class="l-header-nav-btns">
        <li>
          <a href="<?php page_path('contact'); ?>" class="l-header-nav-contact c-btn">お問い合わせ</a>
        </li>
        <li>
          <select class="l-header-nav-select" data-url-jp="<?php echo esc_url( home_url('/') ); ?>" data-url-en="<?php echo esc_url( home_url('/english/') ); ?>">
            <option value="jp">JP</option>
            <option value="en">EN</option>
          </select>
        </li>
      </ul>
    </nav>
  </div>
</header>
<?php endif; ?>

<main class="l-main">