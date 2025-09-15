<?php get_header(); 

$ancestors = get_post_ancestors($post->ID); 
$top_parent_id = $ancestors ? end($ancestors) : $post->ID;
$top_parent = get_post($top_parent_id);

if ($top_parent && $top_parent->post_name === 'english') {
    // 英語版 classroom07
    get_template_part('template-parts/english-classroom07');
    get_template_part('parts/english-technology');
} else {
    // 日本語版 classroom07
    get_template_part('template-parts/classroom07');
    get_template_part('parts/technology');
    get_template_part('parts/cta');
}
?>

<?php get_footer(); ?>
