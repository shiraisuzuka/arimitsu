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

  <?php if ( is_singular('product') ) : ?>
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
  <?php endif; ?>

  <link rel="shortcut icon" href="<?php temp_path(); ?>/favicon.ico" type="image/vnd.microsoft.icon">
  <link rel="icon" href="<?php temp_path(); ?>/favicon.ico" type="image/vnd.microsoft.icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=BIZ+UDPMincho:wght@400&family=Noto+Sans+JP:wght@400;500;700;900&family=Roboto:wght@400;700&display=swap" rel="stylesheet">

  <?php if ( is_singular('product') ) : ?>
  <!-- Splide -->
  <link rel="stylesheet" href="<?php assets_path(); ?>/css/splide.min.css">
  <?php endif; ?>

  <!-- <link rel="preload" as="image" href="<?php img_path(); ?>/images/img_mv.jpg"> -->

  <?php if (is_404()) : ?>
  <meta http-equiv="refresh" content=" 3; url=<?php page_path(''); ?>">
  <?php endif; ?>

  <?php wp_head(); ?>
</head>
<body>
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
          <select name="" id="" class="l-header-nav-select">
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
                <a href="<?php page_path('recruit/interview'); ?>">有光を知る</a>
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
                <a href="<?php page_path('recruit/interview'); ?>">有光を知る</a>
              </li>
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
            <select name="" id="" class="l-header-nav-select">
              <option value="jp">JP</option>
              <option value="en">EN</option>
            </select>
          </li>
        </ul>
      </nav>
    </div>
  </header>

  <main class="l-main">