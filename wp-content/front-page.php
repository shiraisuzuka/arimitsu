<?php get_header(); ?>

<div class="p-top-mv">
  <div class="p-top-mv-image">
    <img src="<?php img_path(); ?>/img_mv.png" alt="" width="3213" height="2162">
    <div class="p-top-mv-inner">
      <p class="p-top-mv-title">私たちは、<br>次代に挑む<br>動力となる</p>
    </div>
  </div>
</div>

<div class="p-top-company l-section js-animation">
  <div class="l-section-inner">
    <p class="p-top-company-text">私たちの原点は<br class="u-show-br-sp">100年培った高圧ポンプ技術<br>それは挑戦する人々や企業に<br class="u-show-br-sp">新たな可能性を示すもの<br>社会や産業の課題に立ち向かい<br class="u-show-br-sp">未来を動かす『動力』こそが<br>私たちが目指す姿</p>
    <div class="p-top-company-btn">
      <a href="company" class="c-btn">有光工業について知る</a>
    </div>
    <div class="c-scroll-down">
      <div class="c-scroll-down-line"></div>
      <span class="c-scroll-down-text">scroll</span>
    </div>
  </div>
</div>

<section class="p-top-news l-section">
  <div class="p-top-news-inner l-section-inner">
    <hgroup class="c-title js-animation">
      <h2 class="c-title-ja">最新情報</h2>
      <p class="c-title-en">information</p>
    </hgroup>
    <ul class="p-top-news-list js-animation">
      <?php
      $news_query = new WP_Query(array(
        'post_type' => 'news',
        'posts_per_page' => 3,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC'
      ));

      if ($news_query->have_posts()) :
        while ($news_query->have_posts()) : $news_query->the_post();
          // カテゴリーを取得
          $categories = get_the_terms(get_the_ID(), 'news_cat');
          $category_name = '';
          if ($categories && !is_wp_error($categories)) {
            $category_name = $categories[0]->name;
          }
      ?>
      <li>
        <a href="<?php the_permalink(); ?>" class="p-top-news-item">
          <time datetime="<?php echo get_the_date('Y-m-d'); ?>" class="p-top-news-item-date"><?php echo get_the_date('Y.m.d'); ?></time>
          <?php if ($category_name) : ?>
          <div class="p-top-news-item-category-wrap"><span class="p-top-news-item-category"><?php echo esc_html($category_name); ?></span></div>
          <?php endif; ?>
          <h3 class="p-top-news-item-title"><?php the_title(); ?></h3>
        </a>
      </li>
      <?php
        endwhile;
        wp_reset_postdata();
      else :
      ?>
      <li>
        <p>最新情報がありません</p>
      </li>
      <?php endif; ?>
    </ul>
    <div class="p-top-news-btn js-animation">
      <a href="<?php page_path('news'); ?>" class="c-link-btn">一覧はこちら<i class="c-icon arrow-right"></i></a>
    </div>
  </div>
</section>

<section class="p-top-product l-section">
  <div class="p-top-product-inner">
    <div class="l-section-inner">
      <div class="p-top-product-contents">
        <div class="p-top-product-header js-animation">
          <hgroup class="c-title">
            <h2 class="c-title-ja">製品</h2>
            <p class="c-title-en">products</p>
          </hgroup>
          <a href="<?php page_path('product'); ?>" class="c-link-btn u-hide-sp">製品一覧<i class="c-icon arrow-right"></i></a>
        </div>
        <ul class="p-top-product-list">
          <li class="p-top-product-item js-animation">
            <div class="p-top-product-item-inner">
              <span class="p-top-product-item-number">01</span>
              <div class="p-top-product-item-content">
                <a href="<?php echo esc_url(get_post_type_archive_link('product') . '?product_categories[]=agricultural_machinery'); ?>">
                  <h3 class="p-top-product-item-title">農業機械</h3>
                </a>
                <div class="p-top-product-item-col">
                  <a href="DUMMY">カタログ一覧</a>
                  <a href="DUMMY" target="_blank">動画一覧</a>
                </div>
              </div>
            </div>
          </li>
          <li class="p-top-product-item js-animation">
            <div class="p-top-product-item-inner">
              <span class="p-top-product-item-number">02</span>
              <div class="p-top-product-item-content">
                <a href="<?php echo esc_url(get_post_type_archive_link('product') . '?product_categories[]=pump'); ?>">
                  <h3 class="p-top-product-item-title">ポンプ</h3>
                </a>
                <div class="p-top-product-item-col">
                  <a href="DUMMY">カタログ一覧</a>
                  <a href="DUMMY" target="_blank">動画一覧</a>
                </div>
              </div>
            </div>
          </li>
          <li class="p-top-product-item js-animation">
            <div class="p-top-product-item-inner">
              <span class="p-top-product-item-number">03</span>
              <div class="p-top-product-item-content">
                <a href="<?php echo esc_url(get_post_type_archive_link('product') . '?product_categories[]=cleaning_machine'); ?>">
                  <h3 class="p-top-product-item-title">洗浄機</h3>
                </a>
                <div class="p-top-product-item-col">
                  <a href="DUMMY">カタログ一覧</a>
                  <a href="DUMMY" target="_blank">動画一覧</a>
                </div>
              </div>
            </div>
          </li>
          <li class="p-top-product-item js-animation">
            <div class="p-top-product-item-inner">
              <span class="p-top-product-item-number">04</span>
              <div class="p-top-product-item-content">
                <a href="<?php echo esc_url(get_post_type_archive_link('product') . '?product_categories[]=attachment'); ?>">
                  <h3 class="p-top-product-item-title">アタッチメント <span>（洗浄機のノズル等）</span></h3>
                </a>
                <div class="p-top-product-item-col">
                  <a href="DUMMY">カタログ一覧</a>
                  <a href="DUMMY" target="_blank">動画一覧</a>
                </div>
              </div>
            </div>
          </li>
          <li class="p-top-product-item js-animation">
            <div class="p-top-product-item-inner">
              <span class="p-top-product-item-number">05</span>
              <div class="p-top-product-item-content">
                <a href="<?php echo esc_url(get_post_type_archive_link('product') . '?product_categories[]=mist'); ?>">
                  <h3 class="p-top-product-item-title">ミスト</h3>
                </a>
                <div class="p-top-product-item-col">
                  <a href="DUMMY">カタログ一覧</a>
                  <a href="DUMMY" target="_blank">動画一覧</a>
                </div>
              </div>
            </div>
          </li>
          <li class="p-top-product-item js-animation">
            <div class="p-top-product-item-inner">
              <span class="p-top-product-item-number">06</span>
              <div class="p-top-product-item-content">
                <a href="<?php echo esc_url(get_post_type_archive_link('product') . '?product_categories[]=other_product'); ?>">
                  <h3 class="p-top-product-item-title">その他 <span>（オートマット、トルミング等）</span></h3>
                </a>
                <div class="p-top-product-item-col">
                  <a href="DUMMY">カタログ一覧</a>
                  <a href="DUMMY" target="_blank">動画一覧</a>
                </div>
              </div>
            </div>
          </li>
        </ul>
        <a href="<?php page_path('product'); ?>" class="c-link-btn u-hide-pc js-animation">製品一覧<i class="c-icon arrow-right"></i></a>
      </div>
    </div>
    <figure class="p-top-product-image js-animation">
      <img src="<?php img_path(); ?>/img_product_01.jpg" alt="" loading="lazy" width="1600" height="1200">
      <span class="p-top-product-image-text is-pc">washer</span>
    </figure>
  </div>
</section>

<section class="p-top-link l-section">
  <div class="l-section-inner">
    <div class="p-top-link-row">
      <a href="<?php page_path('recruit'); ?>" class="p-top-link-btn js-animation">
        <picture>
          <source srcset="<?php img_path(); ?>/img_recruit.jpg" media="(min-width: 768px)" width="2400" height="520">
          <img src="<?php img_path(); ?>/sp/img_recruit.jpg" alt="" loading="lazy" width="688" height="400">
        </picture>
        <div class="p-top-link-btn-inner">
          <div class="p-top-link-btn-contents">
            <h2 class="p-top-link-btn-title">採用について<i class="c-icon arrow-right"></i></h2>
            <p class="p-top-link-btn-text">採用情報は<br class="u-show-br-sp">こちらからご覧ください。</p>
          </div>
          <span class="p-top-link-btn-en">careers</span>
        </div>
      </a>
      <a href="<?php page_path('contact'); ?>" class="p-top-link-btn contact js-animation">
        <picture>
          <source srcset="<?php img_path(); ?>/img_contact.jpg" media="(min-width: 768px)" width="2400" height="520">
          <img src="<?php img_path(); ?>/sp/img_contact.jpg" alt="" loading="lazy" width="688" height="400">
        </picture>
        <div class="p-top-link-btn-inner">
          <div class="p-top-link-btn-contents">
            <h2 class="p-top-link-btn-title">お問い合わせ<i class="c-icon arrow-right cl-green"></i></h2>
            <p class="p-top-link-btn-text">各種お問い合わせや<br class="u-show-br-sp">ご要望がございましたら、<br class="u-show-br-sp">お気軽にご連絡ください。</p>
          </div>
          <span class="p-top-link-btn-en">contact</span>
        </div>
      </a>
    </div>
  </div>
</section>

<?php get_footer(); ?>
