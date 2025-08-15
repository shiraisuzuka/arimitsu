<?php get_header(); ?>

<div class="p-lower-mv">
  <div class="l-section-inner">
    <?php breadcrumb(); ?>
    <hgroup class="p-lower-mv-title">
      <h1>製品一覧</h1>
      <p>products</p>
    </hgroup>
  </div>
</div>

<div class="p-product-wrapper l-section">
  <div class="l-section-inner">
    <div class="p-product-wrapper-col">
      <div class="p-product-search">
        <div class="p-product-search-input">
          <form action="<?php echo esc_url(get_post_type_archive_link('product')); ?>" method="GET" class="p-product-search-input-form">
            <input type="search" name="search" placeholder="フリーワードで探す" class="p-product-search-input-input" value="<?php echo esc_attr(isset($_GET['search']) ? $_GET['search'] : ''); ?>">
            <button type="submit" class="p-product-search-input-submit"><i class="c-icon search"></i></button>
          </form>
        </div>
        <?php
        $total_products_query = new WP_Query(array(
          'post_type' => 'product',
          'posts_per_page' => -1,
          'post_status' => 'publish',
          'fields' => 'ids'
        ));
        $total_products_count = $total_products_query->found_posts;
        
        // 現在選択されているカテゴリーを取得
        $selected_product_categories = isset($_GET['product_categories']) ? $_GET['product_categories'] : array();
        $selected_purpose_categories = isset($_GET['purpose_categories']) ? $_GET['purpose_categories'] : array();
        ?>
        <div class="p-product-search-input p-product-search-detail">
          <form action="<?php echo esc_url(get_post_type_archive_link('product')); ?>" method="GET">
            <div class="p-product-search-detail-head">
              <p class="p-product-search-detail-title">条件で探す</p>
              <a href="<?php echo get_post_type_archive_link('product'); ?>" class="p-product-search-detail-reset">リセット</a>
            </div>
            <button class="p-product-search-detail-spbtn"><i class="c-icon arrow-down cl-green"></i></button>
            <div class="p-product-search-detail-contents-wrapper">
              <div class="p-product-search-detail-contents">
                <p class="p-product-search-detail-contents-title">製品から探す</p>
                <div class="p-product-search-detail-contents-list">
                  <label class="p-product-search-detail-contents-item">
                    <input type="checkbox" name="product_categories[]" value="agricultural_machinery" class="checkbox category-checkbox" <?php checked(in_array('agricultural_machinery', $selected_product_categories)); ?>>
                    農業機械
                  </label>
                  <label class="p-product-search-detail-contents-item">
                    <input type="checkbox" name="product_categories[]" value="pump" class="checkbox category-checkbox" <?php checked(in_array('pump', $selected_product_categories)); ?>>
                    ポンプ
                  </label>
                  <label class="p-product-search-detail-contents-item">
                    <input type="checkbox" name="product_categories[]" value="cleaning_machine" class="checkbox category-checkbox" <?php checked(in_array('cleaning_machine', $selected_product_categories)); ?>>
                    洗浄機
                  </label>
                  <label class="p-product-search-detail-contents-item">
                    <input type="checkbox" name="product_categories[]" value="attachment" class="checkbox category-checkbox" <?php checked(in_array('attachment', $selected_product_categories)); ?>>
                    アタッチメント（洗浄機のノズル等）
                  </label>
                  <label class="p-product-search-detail-contents-item">
                    <input type="checkbox" name="product_categories[]" value="mist" class="checkbox category-checkbox" <?php checked(in_array('mist', $selected_product_categories)); ?>>
                    ミスト
                  </label>
                  <label class="p-product-search-detail-contents-item">
                    <input type="checkbox" name="product_categories[]" value="other_product" class="checkbox category-checkbox" <?php checked(in_array('other_product', $selected_product_categories)); ?>>
                    その他（オートマット、トルミング等）
                  </label>
                </div>
              </div>
              <div class="p-product-search-detail-contents">
                <p class="p-product-search-detail-contents-title">目的・用途から探す</p>
                <div class="p-product-search-detail-contents-list">
                  <label class="p-product-search-detail-contents-item">
                    <input type="checkbox" name="purpose_categories[]" value="spray_chemicals" class="checkbox category-checkbox" <?php checked(in_array('spray_chemicals', $selected_purpose_categories)); ?>>
                    薬剤/肥料をまく
                  </label>
                  <label class="p-product-search-detail-contents-item">
                    <input type="checkbox" name="purpose_categories[]" value="high_pressure_motor" class="checkbox category-checkbox" <?php checked(in_array('high_pressure_motor', $selected_purpose_categories)); ?>>
                    高圧で洗浄する（モーター）
                  </label>
                  <label class="p-product-search-detail-contents-item">
                    <input type="checkbox" name="purpose_categories[]" value="high_pressure_engine" class="checkbox category-checkbox" <?php checked(in_array('high_pressure_engine', $selected_purpose_categories)); ?>>
                    高圧で洗浄する（エンジン）
                  </label>
                  <label class="p-product-search-detail-contents-item">
                    <input type="checkbox" name="purpose_categories[]" value="high_pressure_hot_water" class="checkbox category-checkbox" <?php checked(in_array('high_pressure_hot_water', $selected_purpose_categories)); ?>>
                    高圧で洗浄する（温水）
                  </label>
                  <label class="p-product-search-detail-contents-item">
                    <input type="checkbox" name="purpose_categories[]" value="wash_containers" class="checkbox category-checkbox" <?php checked(in_array('wash_containers', $selected_purpose_categories)); ?>>
                    容器/器具/パレット/部品を洗う
                  </label>
                  <label class="p-product-search-detail-contents-item">
                    <input type="checkbox" name="purpose_categories[]" value="wash_other_items" class="checkbox category-checkbox" <?php checked(in_array('wash_other_items', $selected_purpose_categories)); ?>>
                    その他のものを洗う
                  </label>
                  <label class="p-product-search-detail-contents-item">
                    <input type="checkbox" name="purpose_categories[]" value="foam_wash" class="checkbox category-checkbox" <?php checked(in_array('foam_wash', $selected_purpose_categories)); ?>>
                    泡で洗う
                  </label>
                  <label class="p-product-search-detail-contents-item">
                    <input type="checkbox" name="purpose_categories[]" value="water_pressure_supply" class="checkbox category-checkbox" <?php checked(in_array('water_pressure_supply', $selected_purpose_categories)); ?>>
                    水圧を供給する
                  </label>
                  <label class="p-product-search-detail-contents-item">
                    <input type="checkbox" name="purpose_categories[]" value="cooling_dust_deodorizing" class="checkbox category-checkbox" <?php checked(in_array('cooling_dust_deodorizing', $selected_purpose_categories)); ?>>
                    冷却/防塵/消臭する
                  </label>
                  <label class="p-product-search-detail-contents-item">
                    <input type="checkbox" name="purpose_categories[]" value="other_purpose" class="checkbox category-checkbox" <?php checked(in_array('other_purpose', $selected_purpose_categories)); ?>>
                    その他
                  </label>
                </div>
              </div>
              <div class="p-product-search-detail-contents">
                <div class="p-product-search-detail-contents-submit">
                  <input type="submit" name="submit" value="検索する（<?php echo $total_products_count; ?>件）" id="category-search-submit">
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <?php
      // ページネーション用の設定
      $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
      $posts_per_page = 12;
      
      // 検索キーワードを取得
      $search_keyword = isset($_GET['search']) ? sanitize_text_field($_GET['search']) : '';
      
      $selected_product_categories = isset($_GET['product_categories']) ? array_map('sanitize_text_field', $_GET['product_categories']) : array();
      $selected_purpose_categories = isset($_GET['purpose_categories']) ? array_map('sanitize_text_field', $_GET['purpose_categories']) : array();
      
      $args = array(
        'post_type' => 'product',
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
        'post_status' => 'publish'
      );
      
      if (!empty($selected_product_categories) || !empty($selected_purpose_categories)) {
        $meta_query = array('relation' => 'AND');
        
        if (!empty($selected_product_categories)) {
          $product_meta_query = array('relation' => 'OR');
          foreach ($selected_product_categories as $category) {
            $product_meta_query[] = array(
              'key' => '_product_categories',
              'value' => '"' . $category . '"',
              'compare' => 'LIKE'
            );
          }
          $meta_query[] = $product_meta_query;
        }
        
        if (!empty($selected_purpose_categories)) {
          $purpose_meta_query = array('relation' => 'OR');
          foreach ($selected_purpose_categories as $category) {
            $purpose_meta_query[] = array(
              'key' => '_purpose_categories',
              'value' => '"' . $category . '"',
              'compare' => 'LIKE'
            );
          }
          $meta_query[] = $purpose_meta_query;
        }
        
        $args['meta_query'] = $meta_query;
      }
      
      if (!empty($search_keyword)) {
        if (!empty($selected_product_categories) || !empty($selected_purpose_categories)) {
          $category_search_args = $args;
          $category_search_args['posts_per_page'] = -1;
          $category_search_args['fields'] = 'ids';
          $category_search_query = new WP_Query($category_search_args);
          $category_post_ids = $category_search_query->posts;
          
          if (!empty($category_post_ids)) {
            $keyword_search_args = array(
              'post_type' => 'product',
              'posts_per_page' => -1,
              'post_status' => 'publish',
              'post__in' => $category_post_ids,
              'fields' => 'ids',
              'meta_query' => array(
                'relation' => 'OR',
                array(
                  'key' => '_product_lineup_model',
                  'value' => $search_keyword,
                  'compare' => 'LIKE'
                ),
                array(
                  'key' => '_product_lineup_name',
                  'value' => $search_keyword,
                  'compare' => 'LIKE'
                ),
                array(
                  'key' => '_product_basic_copy',
                  'value' => $search_keyword,
                  'compare' => 'LIKE'
                )
              )
            );
            $keyword_meta_query = new WP_Query($keyword_search_args);
            $keyword_meta_ids = $keyword_meta_query->posts;
            
            $title_search_args = array(
              'post_type' => 'product',
              'posts_per_page' => -1,
              'post_status' => 'publish',
              'post__in' => $category_post_ids,
              's' => $search_keyword,
              'fields' => 'ids'
            );
            $title_search_query = new WP_Query($title_search_args);
            $title_post_ids = $title_search_query->posts;
            
            $all_post_ids = array_unique(array_merge($keyword_meta_ids, $title_post_ids));
          } else {
            $all_post_ids = array();
          }
        } else {
          $keyword_meta_args = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'fields' => 'ids',
            'meta_query' => array(
              'relation' => 'OR',
              array(
                'key' => '_product_lineup_model',
                'value' => $search_keyword,
                'compare' => 'LIKE'
              ),
              array(
                'key' => '_product_lineup_name',
                'value' => $search_keyword,
                'compare' => 'LIKE'
              ),
              array(
                'key' => '_product_basic_copy',
                'value' => $search_keyword,
                'compare' => 'LIKE'
              )
            )
          );
          $keyword_meta_query = new WP_Query($keyword_meta_args);
          $keyword_meta_ids = $keyword_meta_query->posts;
          
          $title_search_args = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            's' => $search_keyword,
            'fields' => 'ids'
          );
          $title_search_query = new WP_Query($title_search_args);
          $title_post_ids = $title_search_query->posts;
          
          $all_post_ids = array_unique(array_merge($keyword_meta_ids, $title_post_ids));
        }
        
        if (!empty($all_post_ids)) {
          $args = array(
            'post_type' => 'product',
            'posts_per_page' => $posts_per_page,
            'paged' => $paged,
            'post_status' => 'publish',
            'post__in' => $all_post_ids,
            'orderby' => 'post__in'
          );
        } else {
          // 検索結果がない場合
          $args['post__in'] = array(0); // 存在しないIDを指定して結果を0にする
        }
      }
      
      $product_query = new WP_Query($args);
      $total_posts = $product_query->found_posts;
      
      $start_post = ($paged - 1) * $posts_per_page + 1;
      $end_post = min($paged * $posts_per_page, $total_posts);
      ?>
      
      <div class="p-product-list">
        <div class="p-product-list-head">
          <p class="p-product-list-head-text"><?php echo $total_posts; ?>件中、<?php echo $start_post; ?>〜<?php echo $end_post; ?>件を表示</p>
          <a href="<?php echo get_post_type_archive_link('product'); ?>" class="p-product-list-head-reset">絞り込みをリセット</a>
        </div>
        
        <?php if ($product_query->have_posts()) : ?>
        <ul class="p-product-list-list">
          <?php while ($product_query->have_posts()) : $product_query->the_post(); ?>
            <?php
            $basic_copy = get_post_meta(get_the_ID(), '_product_basic_copy', true);
            $lineup_image = get_post_meta(get_the_ID(), '_product_lineup_image', true);
            
            if (!$lineup_image) {
              $lineup_image = get_post_meta(get_the_ID(), '_product_image1', true);
            }
            ?>
            <li class="p-product-list-item">
              <a href="<?php the_permalink(); ?>">
                <?php if ($lineup_image): ?>
                  <figure class="p-product-list-item-img">
                    <img src="<?php echo esc_url(wp_get_attachment_url($lineup_image)); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" loading="lazy" width="424" height="282">
                  </figure>
                <?php else: ?>
                  <figure class="p-product-list-item-img">
                    <img src="<?php img_path(); ?>/dummy/img_product_01.jpg" alt="<?php echo esc_attr(get_the_title()); ?>" loading="lazy" width="424" height="282">
                  </figure>
                <?php endif; ?>
                
                <?php if ($basic_copy): ?>
                  <p class="p-product-list-item-text"><?php echo esc_html(wp_trim_words($basic_copy, 30, '...')); ?></p>
                <?php endif; ?>
                
                <h2 class="p-product-list-item-title"><?php the_title(); ?></h2>
              </a>
            </li>
          <?php endwhile; ?>
        </ul>
        <?php else: ?>
        <div class="p-product-list-no-results">
          <?php if (!empty($search_keyword)): ?>
            <p>「<?php echo esc_html($search_keyword); ?>」に該当する製品が見つかりませんでした。</p>
            <p>別のキーワードで検索するか、<a href="<?php echo get_post_type_archive_link('product'); ?>">すべての製品を表示</a>してください。</p>
          <?php else: ?>
            <p>製品が見つかりませんでした。</p>
          <?php endif; ?>
        </div>
        <?php endif; ?>
      </div>
    </div>
    
    <?php
    // ページネーションの表示
    if ($product_query->max_num_pages > 1) :
      $big = 999999999;

      $search_params = '';
      if (!empty($search_keyword)) {
        $search_params .= '&search=' . urlencode($search_keyword);
      }
      if (!empty($selected_product_categories)) {
        foreach ($selected_product_categories as $category) {
          $search_params .= '&product_categories[]=' . urlencode($category);
        }
      }
      if (!empty($selected_purpose_categories)) {
        foreach ($selected_purpose_categories as $category) {
          $search_params .= '&purpose_categories[]=' . urlencode($category);
        }
      }
      
      $pagination_links = paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))) . $search_params,
        'format' => '?paged=%#%' . $search_params,
        'current' => max(1, get_query_var('paged')),
        'total' => $product_query->max_num_pages,
        'prev_text' => '',
        'next_text' => '',
        'type' => 'array',
        'show_all' => false,
        'end_size' => 1,
        'mid_size' => 2
      ));
    ?>
    <div class="p-pagination">
      <?php
      // 前に戻るボタン
      if ($paged <= 1) {
        echo '<a class="prev page-numbers non-active" href="#"></a>';
      } else {
        $prev_link = get_pagenum_link($paged - 1) . $search_params;
        echo '<a class="prev page-numbers" href="' . esc_url($prev_link) . '"></a>';
      }
      
      // ページ番号リンク
      if ($pagination_links) {
        foreach ($pagination_links as $link) {
          if (strpos($link, 'prev') === false && strpos($link, 'next') === false) {
            if (strpos($link, 'current') !== false) {
              echo str_replace('page-numbers', 'page-numbers current', $link);
            } else {
              echo $link;
            }
          }
        }
      }
      
      // 次へボタン
      if ($paged >= $product_query->max_num_pages) {
        echo '<a class="next page-numbers non-active" href="#"></a>';
      } else {
        $next_link = get_pagenum_link($paged + 1) . $search_params;
        echo '<a class="next page-numbers" href="' . esc_url($next_link) . '"></a>';
      }
      ?>
    </div>
    <?php 
    endif; 

    wp_reset_postdata();
    ?>

    <?php get_template_part('inc/cta'); ?>
  </div>
</div>

<?php get_footer(); ?>