<?php
// Category / tag / date archives for blog posts (the "Latest News / <category>"
// links on single posts point here). Same layout as the Posts page (home.php);
// a category archive opens the gallery pre-filtered to that category.
// Destinations and Activities keep their own archive-*.php templates.
get_header();

$posts_page_id       = (int) get_option('page_for_posts');
// Drop WordPress's "Category: " / "Tag: " prefix — just the name.
add_filter('get_the_archive_title_prefix', '__return_empty_string');
$archive_title       = wp_strip_all_tags(get_the_archive_title());
$archive_hero_url    = $posts_page_id ? (get_the_post_thumbnail_url($posts_page_id, 'full') ?: '') : '';
$archive_category_id = is_category() ? (int) get_queried_object_id() : 0;

include __DIR__ . '/partials/news-archive.php';

get_footer();
