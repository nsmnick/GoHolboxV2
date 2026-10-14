<?php
// Blog posts index — the page chosen under Settings > Reading > "Posts page".
// Title and hero image come from that page (its title and Featured Image),
// so the client can rename/re-image it without a code change.
get_header();

$posts_page_id       = (int) get_option('page_for_posts');
$archive_title       = $posts_page_id ? get_the_title($posts_page_id) : 'Latest News';
$archive_hero_url    = $posts_page_id ? (get_the_post_thumbnail_url($posts_page_id, 'full') ?: '') : '';
$archive_category_id = 0;

include __DIR__ . '/partials/news-archive.php';

get_footer();
