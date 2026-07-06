<?php
include __DIR__ . '/../_block-generics.php';
include __DIR__ . '/../_block-preview.php';

if (!$preview_popup_image && !$hide_panel) {
    $heading = get_field('heading');
    $button  = get_field('button');
    $link    = $button['button_link'] ?? null;
    $colour  = $button['button_colour'] ?? 'gold';
    $btn_class = 'button' . ($colour !== 'gold' ? ' button--' . $colour : '');
?>

<section class="link-panel animate fade-up <?php echo $generic_block_settings_classes; ?>">
    <div class="container <?php echo $generic_container_class; ?>">

        <?php if ($heading) : ?>
            <h2 class="link-panel__heading"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>

        <?php if ($link && !empty($link['url'])) : ?>
            <a
                class="<?php echo esc_attr($btn_class); ?>"
                href="<?php echo esc_url($link['url']); ?>"
                <?php if (!empty($link['target'])) : ?>target="<?php echo esc_attr($link['target']); ?>" rel="noopener noreferrer"<?php endif; ?>
            >
                <?php echo esc_html($link['title'] ?: 'Find out more'); ?>
            </a>
        <?php endif; ?>

    </div>
</section>

<?php
}
?>
