<?php get_header(); ?>

<div class="p-lower-mv">
  <div class="l-section-inner">
  <?php breadcrumb(); ?>
  </div>
</div>

<section class="p-product-detail l-section-small">
  <div class="p-product-detail-inner l-section-inner">
    <div class="p-product-detail-contents">
      <h1 class="p-product-detail-title"><?php the_title(); ?></h1>
      <?php 
      $basic_copy = get_post_meta(get_the_ID(), '_product_basic_copy', true);
      if ($basic_copy): ?>
        <p class="p-product-detail-lead"><?php echo nl2br(esc_html($basic_copy)); ?></p>
      <?php endif; ?>
      <?php 
      $catalog_pdf = get_post_meta(get_the_ID(), '_product_catalog_pdf', true);
      $catalog_pdf2 = get_post_meta(get_the_ID(), '_product_catalog_pdf2', true);
      $catalog_pdf3 = get_post_meta(get_the_ID(), '_product_catalog_pdf3', true);
      
      if ($catalog_pdf || $catalog_pdf2 || $catalog_pdf3): ?>
        <div class="p-product-detail-catalogs">
          <?php if ($catalog_pdf): ?>
            <a href="<?php echo esc_url($catalog_pdf); ?>" target="_blank" class="c-link-btn">カタログを見る［PDF］<i class="c-icon arrow-right"></i></a>
          <?php endif; ?>
          <?php if ($catalog_pdf2): ?>
            <a href="<?php echo esc_url($catalog_pdf2); ?>" target="_blank" class="c-link-btn">カタログを見る2［PDF］<i class="c-icon arrow-right"></i></a>
          <?php endif; ?>
          <?php if ($catalog_pdf3): ?>
            <a href="<?php echo esc_url($catalog_pdf3); ?>" target="_blank" class="c-link-btn">カタログを見る3［PDF］<i class="c-icon arrow-right"></i></a>
          <?php endif; ?>
        </div>
      <?php endif; ?>
      <?php 
      $features_text = get_post_meta(get_the_ID(), '_product_features_text', true);
      $features_image1 = get_post_meta(get_the_ID(), '_product_features_image1', true);
      $features_image2 = get_post_meta(get_the_ID(), '_product_features_image2', true);
      $features_image3 = get_post_meta(get_the_ID(), '_product_features_image3', true);
      $features_image4 = get_post_meta(get_the_ID(), '_product_features_image4', true);
      $features_image5 = get_post_meta(get_the_ID(), '_product_features_image5', true);
      $video_link = get_post_meta(get_the_ID(), '_product_video_link', true);
      
      if ($features_text || $features_image1 || $features_image2 || $features_image3 || $features_image4 || $features_image5 || $video_link): ?>
      <div class="p-product-detail-future">
        <h2 class="p-product-detail-future-title">特徴</h2>
        <?php if ($features_text): ?>
          <p class="p-product-detail-future-text"><?php echo nl2br(esc_html($features_text)); ?></p>
        <?php endif; ?>
        
        <?php if ($features_image1 || $features_image2 || $features_image3 || $features_image4 || $features_image5): ?>
        <div class="p-product-detail-future-images">
          <?php if ($features_image1): ?>
            <figure><img src="<?php echo esc_url(wp_get_attachment_url($features_image1)); ?>" alt="" loading="lazy" width="1600" height="1200"></figure>
          <?php endif; ?>
          <?php if ($features_image2): ?>
            <figure><img src="<?php echo esc_url(wp_get_attachment_url($features_image2)); ?>" alt="" loading="lazy" width="1600" height="1200"></figure>
          <?php endif; ?>
          <?php if ($features_image3): ?>
            <figure><img src="<?php echo esc_url(wp_get_attachment_url($features_image3)); ?>" alt="" loading="lazy" width="1600" height="1200"></figure>
          <?php endif; ?>
          <?php if ($features_image4): ?>
            <figure><img src="<?php echo esc_url(wp_get_attachment_url($features_image4)); ?>" alt="" loading="lazy" width="1600" height="1200"></figure>
          <?php endif; ?>
          <?php if ($features_image5): ?>
            <figure><img src="<?php echo esc_url(wp_get_attachment_url($features_image5)); ?>" alt="" loading="lazy" width="1600" height="1200"></figure>
          <?php endif; ?>
        </div>
        <?php endif; ?>
        
        <?php if ($video_link): ?>
          <a href="<?php echo esc_url($video_link); ?>" target="_blank" class="c-link-btn"><span>動画を見る</span><i class="c-icon arrow-right"></i></a>
        <?php endif; ?>
      </div>
      <?php endif; ?>
    </div>
    <?php 
    $product_images = array();
    for ($i = 1; $i <= 5; $i++) {
      $image_id = get_post_meta(get_the_ID(), "_product_image{$i}", true);
      if ($image_id) {
        $product_images[] = $image_id;
      }
    }
    
    if (!empty($product_images)): ?>
    <div class="p-product-detail-images">
      <div id="main-slide" class="p-product-detail-images-main splide">
        <div class="splide__track">
          <div class="splide__list">
            <?php foreach ($product_images as $image_id): ?>
            <div class="splide__slide">
              <img src="<?php echo esc_url(wp_get_attachment_url($image_id)); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" width="1132" height="582">
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      <div id="thumbnail-slide" class="p-product-detail-images-thumbnail splide">
        <div class="splide__track">
          <ul class="splide__list">
            <?php foreach ($product_images as $image_id): ?>
            <li class="splide__slide">
              <img src="<?php echo esc_url(wp_get_attachment_url($image_id)); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" width="1132" height="582">
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
    <?php endif; ?>
  </div>
</section>

<section class="p-product-lineup l-section-small">
<?php 
// 現在の投稿の製品ラインナップデータを取得
$lineup_data = get_product_lineup_data(get_the_ID());

// 空でないエントリーがあるかチェック
$has_valid_lineup = false;
if (!empty($lineup_data)) {
  foreach ($lineup_data as $lineup) {
    if (!empty($lineup['image']) || !empty($lineup['model']) || !empty($lineup['name']) || !empty($lineup['link'])) {
      $has_valid_lineup = true;
      break;
    }
  }
}

if ($has_valid_lineup): ?>
  <div class="p-product-lineup-inner l-section-inner">
    <h2 class="p-product-lineup-title">製品ラインナップ</h2>
    <ul class="p-product-lineup-list" id="product-lineup-list">
      <?php 
      $initial_count = 10;
      $total_count = count($lineup_data);
      
      for ($i = 0; $i < min($initial_count, $total_count); $i++):
        $lineup = $lineup_data[$i];
        $lineup_image = $lineup['image'];
        $lineup_model = $lineup['model'];
        $lineup_name = $lineup['name'];
        $lineup_link = $lineup['link'];
        
        // 画像が設定されていない場合は製品画像1を使用
        if (!$lineup_image) {
          $lineup_image = get_post_meta(get_the_ID(), '_product_image1', true);
        }
        
        $item_class = $i >= $initial_count ? 'p-product-lineup-item hidden-item' : 'p-product-lineup-item';
      ?>
      <li class="<?php echo esc_attr($item_class); ?>">
        <?php if ($lineup_link): ?>
        <a href="<?php echo esc_url($lineup_link); ?>" target="_blank">
        <?php else: ?>
        <a href="<?php echo esc_url(get_permalink()); ?>">
        <?php endif; ?>
          <?php if ($lineup_image): ?>
          <figure class="p-product-lineup-item-img">
            <img src="<?php echo esc_url(wp_get_attachment_url($lineup_image)); ?>" alt="<?php echo esc_attr($lineup_name ? $lineup_name : get_the_title()); ?>" loading="lazy" width="424" height="282">
          </figure>
          <?php endif; ?>
          <div class="p-product-lineup-item-contents">
            <?php if ($lineup_model): ?>
              <p class="p-product-lineup-item-text"><?php echo nl2br(esc_html($lineup_model)); ?></p>
            <?php endif; ?>
            <?php if ($lineup_name): ?>
              <h3 class="p-product-lineup-item-title"><?php echo nl2br(esc_html($lineup_name)); ?></h3>
            <?php endif; ?>
          </div>
          <?php if ($lineup_link): ?>
            <div class="c-link-btn">仕様表［PDF］<i class="c-icon arrow-right"></i></div>
          <?php endif; ?>
        </a>
      </li>
      <?php endfor; ?>
      
      <?php 
      // 隠れているアイテムを追加
      if ($total_count > $initial_count):
        for ($i = $initial_count; $i < $total_count; $i++):
          $lineup = $lineup_data[$i];
          $lineup_image = $lineup['image'];
          $lineup_model = $lineup['model'];
          $lineup_name = $lineup['name'];
          $lineup_link = $lineup['link'];
          
          // 画像が設定されていない場合は製品画像1を使用
          if (!$lineup_image) {
            $lineup_image = get_post_meta(get_the_ID(), '_product_image1', true);
          }
      ?>
      <li class="p-product-lineup-item hidden-item" style="display: none;">
        <?php if ($lineup_link): ?>
        <a href="<?php echo esc_url($lineup_link); ?>" target="_blank">
        <?php else: ?>
        <a href="<?php echo esc_url(get_permalink()); ?>">
        <?php endif; ?>
          <?php if ($lineup_image): ?>
          <figure class="p-product-lineup-item-img">
            <img src="<?php echo esc_url(wp_get_attachment_url($lineup_image)); ?>" alt="<?php echo esc_attr($lineup_name ? $lineup_name : get_the_title()); ?>" loading="lazy" width="424" height="282">
          </figure>
          <?php endif; ?>
          <div class="p-product-lineup-item-contents">
            <?php if ($lineup_model): ?>
              <p class="p-product-lineup-item-text"><?php echo nl2br(esc_html($lineup_model)); ?></p>
            <?php endif; ?>
            <?php if ($lineup_name): ?>
              <h3 class="p-product-lineup-item-title"><?php echo nl2br(esc_html($lineup_name)); ?></h3>
            <?php else: ?>
              <h3 class="p-product-lineup-item-title"><?php echo esc_html(get_the_title()); ?></h3>
            <?php endif; ?>
          </div>
          <?php if ($lineup_link): ?>
            <div class="c-link-btn">仕様表［PDF］<i class="c-icon arrow-right"></i></div>
          <?php else: ?>
            <div class="c-link-btn">詳細を見る<i class="c-icon arrow-right"></i></div>
          <?php endif; ?>
        </a>
      </li>
      <?php 
        endfor;
      endif;
      ?>
    </ul>
    
    <?php if ($total_count > $initial_count): ?>
    <button class="p-product-lineup-btn" id="load-more-products" data-loaded="<?php echo esc_attr($initial_count); ?>" data-total="<?php echo esc_attr($total_count); ?>">
      もっと表示する
    </button>
    <?php endif; ?>
  </div>
<?php endif; ?>
  <div class="l-section-inner">
    <div class="p-product-lineup-back">
      <a href="<?php page_path('product'); ?>" class="c-link-back-btn"><i class="c-icon arrow-left"></i>製品一覧に戻る</a>
    </div>
    <?php get_template_part('inc/cta'); ?>
  </div>
</section>

<?php get_footer(); ?>