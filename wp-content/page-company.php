<?php get_header(); 

$parent = get_post($post->post_parent);

if ($parent && $parent->post_name === 'english') {
    // 英語版 company
    get_template_part('template-parts/english-company');
} else {
    // 日本語版 company
    get_template_part('template-parts/company');
    get_template_part('template-parts/cta');
}
?>

<?php get_footer(); ?>
