</main>

<?php 
// englishページまたはその子ページかどうかを判定
$is_english_page = false;

// 現在のページがenglishの固定ページかチェック
if (is_page('english')) {
    $is_english_page = true;
}

// 現在のページがenglishの子ページかチェック
$current_page = get_queried_object();
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

// 現在のページのスラッグがenglishで始まるかチェック
if ($current_page && isset($current_page->post_name)) {
    $post_slug = $current_page->post_name;
    $uri = $_SERVER['REQUEST_URI'];
    if (strpos($uri, '/english/') !== false || strpos($uri, '/english') !== false) {
        $is_english_page = true;
    }
}
?>

<?php if ($is_english_page): ?>
<footer class="l-footer en">
  <div class="l-section-inner">
    <p class="l-footer-copyright"><small>Copyright &copy; Arimitsu Industry Co.,Ltd. All Rights Reserved.</small></p>
  </div>
</footer>

<?php else: ?>
<footer class="l-footer">
  <div class="l-section-inner l-footer-inner">
    <div class="l-footer-info">
      <a href="<?php page_path(); ?>" class="l-footer-logo"><img src="<?php img_path(); ?>/logo_white.svg" alt="有光工業株式会社" width="186" height="29"></a>
      <p class="l-footer-company">有光工業株式会社</p>
      <address class="l-footer-address">〒537-0001 大阪市東成区深江北1-3-7</address>
      <p class="l-footer-copyright"><small>Copyright &copy; Arimitsu Industry Co.,Ltd. All Rights Reserved.</small></p>
    </div>
    <div>
      <div class="l-footer-nav">
        <ul class="l-footer-nav-list">
          <li class="l-footer-nav-item">
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
          <li class="l-footer-nav-item">
            <span class="no-arrow">製品</span>
            <ul>
              <li>
                <a href="<?php page_path('product'); ?>">製品一覧</a>
              </li>
              <li>
                <a href="<?php echo esc_url(get_post_type_archive_link('product') . '?product_categories[]=agricultural_machinery'); ?>">01農業機械</a>
              </li>
              <li>
                <a href="<?php echo esc_url(get_post_type_archive_link('product') . '?product_categories[]=pump'); ?>">02 ポンプ</a>
              </li>
              <li>
                <a href="<?php echo esc_url(get_post_type_archive_link('product') . '?product_categories[]=cleaning_machine'); ?>">03 洗浄機</a>
              </li>
              <li>
                <a href="<?php echo esc_url(get_post_type_archive_link('product') . '?product_categories[]=attachment'); ?>">04 アタッチメント<span>（洗浄機のノズル等）</span></a>
              </li>
              <li>
                <a href="<?php echo esc_url(get_post_type_archive_link('product') . '?product_categories[]=mist'); ?>">05 ミスト</a>
              </li>
              <li>
                <a href="<?php echo esc_url(get_post_type_archive_link('product') . '?product_categories[]=other_product'); ?>">06 その他<span>（オートマット、トルミング等）</span></a>
              </li>
              <li>
                <a href="catalog">カタログダウンロード</a>
              </li>
              <li>
                <a href="https://www.youtube.com/channel/UCIGZY9G9hTRGFn40E016o5Q" target="_blank">動画一覧</a>
              </li>
            </ul>
          </li>
          <li class="l-footer-nav-item">
            <span class="no-arrow">最新情報</span>
            <ul>
              <li>
                <a href="<?php page_path('news'); ?>">お知らせ一覧</a>
              </li>
            </ul>
          </li>
        </ul>
        <ul class="l-footer-nav-list">
          <li class="l-footer-nav-item">
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
          <li class="l-footer-nav-item">
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
      </div>
      <ul class="l-footer-bottom">
        <li>
          <a href="<?php page_path('sitemap'); ?>">サイトマップ</a>
        </li>
        <li>
          <a href="<?php page_path('privacypolicy'); ?>">プライバシーポリシー</a>
        </li>
      </ul>
    </div>
  </div>
</footer>
<?php endif; ?>

<!-- jQuery -->
<script src="<?php assets_path(); ?>/js/jquery-3.7.1.min.js"></script>

<!-- GSAP -->  
<script src="<?php assets_path(); ?>/js/gsap.min.js"></script>
<script src="<?php assets_path(); ?>/js/ScrollTrigger.min.js"></script>

<?php if ( is_front_page() ) : ?>
<script src="<?php assets_path(); ?>/js/splide.min.js"></script>
<?php endif; ?>

<?php if ( is_singular('product') ) : ?>
<!-- Splide -->
<script src="<?php assets_path(); ?>/js/splide.min.js"></script>

<!-- jQuery Match Height -->
<script src="<?php assets_path(); ?>/js/jquery.matchHeight-min.js"></script>
<?php endif; ?>

<?php if ( is_page('classroom01') || is_page('classroom02') || is_page('classroom03') || is_page('classroom04') || is_page('classroom05') || is_page('classroom06') || is_page('classroom07') || is_page('classroom08') ) : ?>
<script src="<?php assets_path(); ?>/js/splide.min.js"></script>
<script src="<?php assets_path(); ?>/js/technology.js"></script>
<?php endif; ?>

<?php if ( is_page('recruit') || is_page('recruitment') || is_page('qanda') ) : ?>
<script src="<?php assets_path(); ?>/js/recruit.js"></script>
<?php endif; ?>

<?php if ( is_page('catalog') ) : ?>
<!-- jQuery Match Height -->
<script src="<?php assets_path(); ?>/js/jquery.matchHeight-min.js"></script>
<script src="<?php assets_path(); ?>/js/catalog.js"></script>
<?php endif; ?>

<?php if ($is_english_page): if ( is_page('agricultural-machinery') || is_page('industrial-machinery') ) : ?>
<script src="<?php assets_path(); ?>/js/english.js"></script>
<?php endif; endif; ?>

<?php wp_footer(); ?>

</body>
</html>