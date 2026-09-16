<?php
include __DIR__ . '/../_block-generics.php';
include __DIR__ . '/../_block-preview.php';

if (!$preview_popup_image && !$hide_panel) {
    $heading = get_field('heading');
    $content = get_field('content');

    if (!$heading && !$content) {
        return;
    }
?>

<section class="faq-card-panel <?php echo $generic_block_settings_classes; ?>">
    <div class="container <?php echo esc_attr($generic_container_class); ?>">
        <?php if ($heading) : ?>
            <h2 class="faq-card-panel__heading"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>

        <?php if ($content) : ?>
            <div class="faq-card-panel__content"><?php echo wp_kses_post($content); ?></div>
        <?php endif; ?>
    </div>
</section>

<?php
}
?>
