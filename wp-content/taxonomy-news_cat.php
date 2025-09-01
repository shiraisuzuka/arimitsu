<?php get_header(); ?>

<div class="p-lower-mv">
  <div class="l-section-inner">
    <?php breadcrumb(); ?>
    <hgroup class="p-lower-mv-title">
      <h1>最新情報</h1>
      <p>news</p>
    </hgroup>
  </div>
</div>

<section class="l-section">
  <div class="l-section-inner">
    <ul class="p-news-category">
      <?php
      $current_category = get_queried_object();
      $current_cat_id = is_tax('news_cat') ? $current_category->term_id : 0;
      ?>
      <li>
        <a href="<?php echo get_post_type_archive_link('news'); ?>" class="<?php echo ($current_cat_id == 0) ? 'is-active' : ''; ?>">全て</a>
      </li>
      <?php
      $category_order = array('採用情報', 'マスコミ', '展示会', 'その他');
      
      foreach ($category_order as $category_name) {
        $category = get_term_by('name', $category_name, 'news_cat');
        if ($category && !is_wp_error($category)) {
          $is_active = ($current_cat_id == $category->term_id) ? 'is-active' : '';
          echo '<li>';
          echo '<a href="' . get_term_link($category) . '" class="' . $is_active . '">' . esc_html($category->name) . '</a>';
          echo '</li>';
        }
      }
      ?>
    </ul>
    <div class="p-news-list">
      <ul class="p-top-news-list">
        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        
        $args = array(
          'post_type' => 'news',
          'posts_per_page' => 10,
          'paged' => $paged,
          'post_status' => 'publish'
        );
        
        if (is_tax('news_cat')) {
          $args['tax_query'] = array(
            array(
              'taxonomy' => 'news_cat',
              'field'    => 'slug',
              'terms'    => get_queried_object()->slug,
            ),
          );
        }
        
        $news_query = new WP_Query($args);
        
        if ($news_query->have_posts()) :
          while ($news_query->have_posts()) : $news_query->the_post();
            // 投稿日から7日以内かチェック（NEW表示用）
            $post_date = get_the_date('U');
            $current_date = current_time('timestamp');
            $is_new = (($current_date - $post_date) < (7 * 24 * 60 * 60));
            
            $terms = get_the_terms(get_the_ID(), 'news_cat');
            $category_name = '';
            if ($terms && !is_wp_error($terms)) {
              $category_name = $terms[0]->name;
            }
        ?>
        <li>
          <a href="<?php the_permalink(); ?>" class="p-top-news-item">
            <time datetime="<?php echo get_the_date('Y-m-d'); ?>" class="p-top-news-item-date"><?php echo get_the_date('Y.m.d'); ?></time>
            <div class="p-top-news-item-category-wrap">
              <span class="p-top-news-item-category"><?php echo esc_html($category_name); ?></span>
              <?php if ($is_new) : ?>
              <span class="p-top-news-item-category-new">NEW</span>
              <?php endif; ?>
            </div>
            <h2 class="p-top-news-item-title"><?php the_title(); ?></h2>
          </a>
        </li>
        <?php
          endwhile;
        else :
        ?>
        <li>
          <p>投稿が見つかりませんでした。</p>
        </li>
        <?php endif; ?>
      </ul>
    </div>
    <?php
    $current_page = max(1, get_query_var('paged'));
    $total_pages = $news_query->max_num_pages;
    
    if ($total_pages > 1) :
      $pagination_args = array(
        'base'      => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
        'format'    => '?paged=%#%',
        'current'   => $current_page,
        'total'     => $total_pages,
        'prev_text' => '',
        'next_text' => '',
        'type'      => 'array',
        'mid_size'  => 2,
        'end_size'  => 1,
      );
      
      $pagination_links = paginate_links($pagination_args);
    ?>
    <div class="p-pagination">
      <?php
      if ($current_page > 1) {
        $prev_link = get_pagenum_link($current_page - 1);
        echo '<a class="prev page-numbers" href="' . esc_url($prev_link) . '"></a>';
      } else {
        echo '<a class="prev page-numbers non-active" href="#"></a>';
      }
      
      if ($pagination_links) {
        foreach ($pagination_links as $link) {
          if (strpos($link, 'prev') === false && strpos($link, 'next') === false) {
            echo $link;
          }
        }
      }
      
      if ($current_page < $total_pages) {
        $next_link = get_pagenum_link($current_page + 1);
        echo '<a class="next page-numbers" href="' . esc_url($next_link) . '"></a>';
      } else {
        echo '<a class="next page-numbers non-active" href="#"></a>';
      }
      ?>
    </div>
    <?php 
    else :
    ?>
    <div class="p-pagination">
      <a class="prev page-numbers non-active" href="#"></a>
      <span class="page-numbers current">1</span>
      <a class="next page-numbers non-active" href="#"></a>
    </div>
    <?php endif;
    
    wp_reset_postdata();
    ?>
  </div>
</section>

<?php get_footer(); ?>
