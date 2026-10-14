<?php
include __DIR__ . '/../_block-generics.php';
include __DIR__ . '/../_block-preview.php';

// Customer Reviews — static review cards (one per platform: Tripadvisor /
// Google), each with the platform logo, a star rating, a quote, the
// reviewer's name, and a button through to that platform's
// reviews. Content is entered in the CMS; nothing is pulled from
// Tripadvisor or Google at page load (this replaced the auto-updating
// Tripadvisor widget / Google Reviews shortcode embeds).
//
// Logos are the official artwork, bundled in /images/review-logos/ (the
// Tripadvisor owl is cropped from Tripadvisor's own horizontal lockup) so
// the panel never depends on a third-party server.

if (!$hide_panel && !$preview_popup_image) {
    $heading = get_field('heading');
    $intro   = get_field('intro');
    // Only a real array of rows — if the field definitions and saved
    // content ever get out of step (e.g. an old field group JSON on the
    // server), ACF can hand back the raw row count instead, which must not
    // reach count()/foreach below.
    $reviews = get_field('reviews');
    $reviews = is_array($reviews) ? array_values(array_filter($reviews, 'is_array')) : [];

    if (!$reviews) {
        if (!empty($is_preview)) {
            echo '<p style="padding:2rem;opacity:0.4;font-style:italic;">No reviews added yet — edit the block to add a Tripadvisor and/or Google review card.</p>';
        }
        return;
    }

    $logo_dir  = get_stylesheet_directory_uri() . '/images/review-logos/';
    $platforms = [
        'tripadvisor' => ['name' => 'Tripadvisor', 'default_label' => 'Read our Tripadvisor reviews'],
        'google'      => ['name' => 'Google',      'default_label' => 'Read our Google reviews'],
    ];

    $star = '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M12 2.5l2.94 5.96 6.58.96-4.76 4.64 1.12 6.55L12 17.52l-5.88 3.09 1.12-6.55L2.48 9.42l6.58-.96L12 2.5z"/></svg>';
    $arrow = '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M7 17L17 7M9 7h8v8"/></svg>';
?>

<section class="tripadvisor-reviews-panel <?php echo $generic_block_settings_classes; ?>">
    <div class="container <?php echo esc_attr($generic_container_class); ?>">

        <?php if ($heading || $intro) : ?>
            <div class="tripadvisor-reviews-panel__intro-wrap">
                <?php if ($heading) : ?>
                    <h2 class="tripadvisor-reviews-panel__heading"><?php echo esc_html($heading); ?></h2>
                <?php endif; ?>
                <?php if ($intro) : ?>
                    <div class="tripadvisor-reviews-panel__intro"><?php echo wp_kses_post($intro); ?></div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="tripadvisor-reviews-panel__cards tripadvisor-reviews-panel__cards--<?php echo count($reviews) === 1 ? 'one' : 'many'; ?>">
            <?php foreach ($reviews as $review) :
                $platform_key = $review['platform'] ?? 'tripadvisor';
                $platform     = $platforms[$platform_key] ?? $platforms['tripadvisor'];
                $rating       = max(0, min(5, (int) ($review['rating'] ?? 5)));
                $quote        = trim((string) ($review['quote'] ?? ''));
                $name         = $review['reviewer_name'] ?? '';
                // "button" is a clone of the shared Component - Link field
                // group (display: Group, prefixed field names), so the link
                // itself is button_link — same shape as the Pricing Panel's.
                // Its button_colour isn't used: these buttons always use the
                // panel's own gradient style, as designed.
                $link         = $review['button']['button_link'] ?? null;
            ?>
                <article class="review-card review-card--<?php echo esc_attr($platform_key); ?>">

                    <div class="review-card__logo">
                        <?php if ($platform_key === 'google') : ?>
                            <img src="<?php echo esc_url($logo_dir . 'google.svg'); ?>" alt="Google" width="74" height="24" class="review-card__logo-google">
                        <?php else : ?>
                            <img src="<?php echo esc_url($logo_dir . 'tripadvisor-icon.svg'); ?>" alt="" width="28" height="28" class="review-card__logo-icon">
                            <span class="review-card__logo-name">Tripadvisor</span>
                        <?php endif; ?>
                    </div>

                    <?php if ($rating) : ?>
                        <div class="review-card__stars" role="img" aria-label="<?php echo esc_attr($rating . ' out of 5 stars'); ?>">
                            <?php echo str_repeat($star, $rating); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($quote) : ?>
                        <blockquote class="review-card__quote">
                            <p>&ldquo;<?php echo nl2br(esc_html($quote)); ?>&rdquo;</p>
                        </blockquote>
                    <?php endif; ?>

                    <?php if ($name) : ?>
                        <p class="review-card__meta">
                            <span class="review-card__name"><?php echo esc_html($name); ?></span>
                        </p>
                    <?php endif; ?>

                    <?php if ($link && !empty($link['url'])) : ?>
                        <a
                            class="review-card__button"
                            href="<?php echo esc_url($link['url']); ?>"
                            <?php if (!empty($link['target'])) : ?>target="<?php echo esc_attr($link['target']); ?>" rel="noopener noreferrer"<?php endif; ?>
                        >
                            <span><?php echo esc_html($link['title'] ?: $platform['default_label']); ?></span>
                            <?php echo $arrow; ?>
                        </a>
                    <?php endif; ?>

                </article>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<?php
}
?>
