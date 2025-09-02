<?php get_header(); ?>

<div class="p-lower-mv">
  <div class="l-section-inner">
    <?php breadcrumb(); ?>
  </div>
</div>

<div class="c-header">
  <div class="l-section-inner">
    <hgroup>
      <h1 class="c-title-ja">説明会・イベント</h1>
      <p class="c-title-en">events</p>
    </hgroup>
    <figure>
      <img src="<?php img_path(); ?>/recruit/session/img_header.jpg" alt="" loading="lazy" width="1588" height="600">
    </figure>
  </div>
</div>

<?php
// 公開状況を確認
$session_page = get_page_by_path('recruit/session');
$session_publish_status = 'published';
$open_company_publish_status = 'published';

if ($session_page) {
  $session_publish_status = get_post_meta($session_page->ID, '_session_publish_status', true);
  $open_company_publish_status = get_post_meta($session_page->ID, '_open_company_publish_status', true);
  
  if (empty($session_publish_status)) {
    $session_publish_status = 'published';
  }
  if (empty($open_company_publish_status)) {
    $open_company_publish_status = 'published';
  }
}

// 両方とも非公開の場合
if ($session_publish_status === 'draft' && $open_company_publish_status === 'draft') {
?>
<div class="l-section">
  <div class="l-section-inner">
    <div class="coming-soon-message" style="text-align: center;">
      <h2>Coming Soon</h2>
    </div>
  </div>
</div>
<?php
} else {
  // 通常のセクション表示
?>
<section class="c-sticky l-section">
  <div class="l-section-inner">
    <div class="c-sticky-link">
      <ul>
        <li><a href="#session">説明会</a></li>
        <li><a href="#open">オープンカンパニー</a></li>
      </ul>
    </div>
    <div class="c-sticky-contents">
      <div id="session" class="c-section-row">
        <h2 class="c-section-row-title">説明会</h2>
        <div class="c-section-row-text">
          <?php
          $session_description = get_section_description('session');
          if (!empty($session_description)) {
            echo wp_kses_post(nl2br($session_description));
          }
          ?>
        </div>
        <?php display_session_events('session'); ?>
      </div>
      <div id="open" class="c-section-row">
        <h2 class="c-section-row-title">オープンカンパニー</h2>
        <div class="c-section-row-text">
          <?php
          $open_company_description = get_section_description('open_company');
          if (!empty($open_company_description)) {
            echo wp_kses_post(nl2br($open_company_description));
          }
          ?>
        </div>
        <?php display_session_events('open_company'); ?>
      </div>
    </div>
  </div>
</section>
<?php
}
?>

<?php get_footer(); ?>