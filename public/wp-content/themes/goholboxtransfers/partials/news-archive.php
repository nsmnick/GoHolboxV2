<?php
// Shared blog archive layout — used by home.php (the Settings > Reading
// "Posts page") and archive.php (category/tag/date archives). Renders the
// same hero as the Destinations/Activities listings, then the News Gallery
// Vue app (category filter + load more) that the News Gallery Panel block
// uses, pre-filtered to the current category on a category archive.
//
// Expects: $archive_title (string), $archive_hero_url (string, may be ''),
// $archive_category_id (int, 0 for all posts).
?>

<section class="cpt-archive cpt-archive--news">
    <div class="cpt-archive__hero" <?php if ($archive_hero_url) : ?>style="background-image: url('<?php echo esc_url($archive_hero_url); ?>')"<?php endif; ?>>
        <div class="cpt-archive__hero-overlay" aria-hidden="true"></div>
        <canvas class="hero-panel__wave" aria-hidden="true"></canvas>
        <div class="cpt-archive__hero-content container">
            <h1 class="cpt-archive__title"><?php echo esc_html($archive_title); ?></h1>
        </div>
    </div>
</section>

<section class="news-gallery-panel news-gallery-panel--archive">
    <div class="container">
        <div id="vue-app" data-app="posts-gallery" data-config="<?php echo esc_attr(wp_json_encode(['defaultCategoryID' => (int) $archive_category_id])); ?>"></div>
    </div>
</section>
