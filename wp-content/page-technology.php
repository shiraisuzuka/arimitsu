<?php get_header(); 

$parent = get_post($post->post_parent);

if ($parent && $parent->post_name === 'english') {
    // 英語版 technology
    get_template_part('template-parts/english-technology');
} else {
    // 日本語版 technology
    get_template_part('template-parts/technology');
    get_template_part('parts/cta');
}
?>

<?php get_footer(); ?>
