<?php
/**
 * 英語サイト用パンくずリストを作成
 */
function english_breadcrumb() {
  global $post;

  // 現在のページまでの階層を取得
  $ancestors = [];
  if (is_page() && $post) {
    $ancestors = get_post_ancestors($post);
    $ancestors = array_reverse($ancestors); // 親 → 子の順に並べ替え
  }

  // ★ ARIMITSU ページを除外（slug が english のもの）
  $filtered_ancestors = [];
  foreach ($ancestors as $ancestor_id) {
    if (get_post_field('post_name', $ancestor_id) === 'english') {
      continue; // スキップ
    }
    $filtered_ancestors[] = $ancestor_id;
  }

  // 英語サイトのルートURLを固定で生成（テスト環境でも本番でもOK）
  $english_home = home_url('/english/');
  ?>
  <div class="p-breadcrumb en">
    <ol class="p-breadcrumb-list">
      <!-- ルート -->
      <li class="p-breadcrumb-item">
        <a href="<?php echo esc_url($english_home); ?>"><span>home</span></a>
      </li>

      <!-- 中間階層 -->
      <?php foreach ($filtered_ancestors as $ancestor_id) : ?>
        <li class="p-breadcrumb-item">
          <a href="<?php echo get_permalink($ancestor_id); ?>">
            <span><?php echo esc_html(get_the_title($ancestor_id)); ?></span>
          </a>
        </li>
      <?php endforeach; ?>

      <!-- 現在ページ -->
      <?php if (is_page()) : ?>
        <li class="p-breadcrumb-item"><span><?php the_title(); ?></span></li>
      <?php endif; ?>
    </ol>
  </div>

  <?php
  // --- 構造化データ JSON-LD ---
  $breadcrumb = [
    "@context" => "https://schema.org",
    "@type" => "BreadcrumbList",
    "itemListElement" => []
  ];

  $position = 1;

  // ルート
  $breadcrumb["itemListElement"][] = [
    "@type" => "ListItem",
    "position" => $position++,
    "name" => "home",
    "item" => $english_home
  ];

  // 中間階層
  foreach ($filtered_ancestors as $ancestor_id) {
    $breadcrumb["itemListElement"][] = [
      "@type" => "ListItem",
      "position" => $position++,
      "name" => get_the_title($ancestor_id),
      "item" => get_permalink($ancestor_id)
    ];
  }

  // 現在ページ
  if (is_page()) {
    $breadcrumb["itemListElement"][] = [
      "@type" => "ListItem",
      "position" => $position++,
      "name" => get_the_title(),
      "item" => get_permalink()
    ];
  }
  ?>
  <script type="application/ld+json">
  <?php echo json_encode($breadcrumb, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); ?>
  </script>
  <?php
}
