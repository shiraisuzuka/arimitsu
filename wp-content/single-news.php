<?php get_header(); ?>

<div class="p-lower-mv">
  <div class="l-section-inner">
  <?php breadcrumb(); ?>
  </div>
</div>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<article class="p-news-detail">
  <div class="l-section-inner">
    <div class="p-news-detail-inner">
      <div class="p-news-detail-header">
        <time datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date('Y.m.d'); ?></time>
        <h1><?php the_title(); ?></h1>
      </div>
      <div class="p-news-detail-contents">
        <?php
        $content = get_news_content(get_the_ID());
        if ($content) {
          echo '<p>' . $content . '</p>';
        }
        
        $images = get_news_images(get_the_ID());
        if (!empty($images)) {
          $image_groups = array_chunk($images, 2);
          
          foreach ($image_groups as $group) {
            echo '<div class="col">';
            foreach ($group as $image) {
              echo '<figure><img src="' . esc_url($image['url']) . '" alt="' . esc_attr($image['alt']) . '" loading="lazy"></figure>';
            }
            echo '</div>';
          }
        }
        ?>
      </div>
    </div>
  </div>
</article>
<?php endwhile; endif; ?>

<div class="l-section">
  <div class="l-section-inner">
    <a href="<?php page_path('news'); ?>" class="c-link-back-btn"><i class="c-icon arrow-left"></i>お知らせ一覧に戻る</a>
  </div>
</div>

<?php get_footer(); ?>