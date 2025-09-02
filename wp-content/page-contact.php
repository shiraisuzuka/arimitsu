<?php get_header(); ?>

<div class="p-lower-mv">
  <div class="l-section-inner">
    <?php breadcrumb(); ?>
    <hgroup class="p-lower-mv-title">
      <h1>お問い合わせ</h1>
      <p>contact</p>
    </hgroup>
  </div>
</div>

<section class="l-section">
  <div class="l-section-inner">
    <div class="p-contact">
      <?php if (have_posts()) {
        while (have_posts()) : the_post();
          the_content();
        endwhile;
      } ?>      
    </div>
  </div>
</section>

<?php get_footer(); ?>