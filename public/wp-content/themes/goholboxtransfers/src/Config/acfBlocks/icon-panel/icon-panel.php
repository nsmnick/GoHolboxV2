<?php
include __DIR__ . '/../_block-generics.php';
include __DIR__ . '/../_block-preview.php';

if (!$preview_popup_image && !$hide_panel) {
    $heading   = get_field('heading');
    $paragraph = get_field('paragraph');
    $icons     = get_field('icons') ?: [];

    $icons = array_values(array_filter($icons, function ($row) {
        return !empty($row['icon_label']);
    }));

    if (!$icons) {
        echo '<p style="padding:2rem;opacity:0.4;font-style:italic;">Add at least one item to show this panel.</p>';
        return;
    }
?>

<section class="icon-panel animate fade-up <?php echo $generic_block_settings_classes; ?>">
    <div class="container <?php echo $generic_container_class; ?>">

        <?php if ($heading) : ?>
            <h2 class="icon-panel__heading"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>

        <?php if ($paragraph) : ?>
            <p class="icon-panel__paragraph"><?php echo esc_html($paragraph); ?></p>
        <?php endif; ?>

        <div class="icon-panel__grid">
            <?php foreach ($icons as $icon_row) :
                $label       = $icon_row['icon_label'];
                $description = $icon_row['icon_description'] ?? '';
                $link        = $icon_row['button']['button_link'] ?? null;
                $colour      = $icon_row['button']['button_colour'] ?? 'gold';
                $is_button   = $link && !empty($link['url']);
                $tag         = $is_button ? 'a' : 'div';
                $item_class  = 'icon-panel__item' . ($is_button ? ' button' . ($colour !== 'gold' ? ' button--' . $colour : '') : '');

                // Handles both ID and array return formats for the Icon field
                $icon_field = $icon_row['icon'] ?? null;
                if (is_array($icon_field)) {
                    $image_id = $icon_field['ID'] ?? $icon_field['id'] ?? 0;
                } else {
                    $image_id = (int) $icon_field;
                }
            ?>
                <<?php echo $tag; ?>
                    class="<?php echo esc_attr($item_class); ?>"
                    <?php if ($is_button) : ?>
                        href="<?php echo esc_url($link['url']); ?>"
                        <?php if (!empty($link['target'])) : ?>target="<?php echo esc_attr($link['target']); ?>" rel="noopener noreferrer"<?php endif; ?>
                    <?php endif; ?>
                >
                    <?php if ($image_id) : ?>
                        <span class="icon-panel__icon">
                            <?php echo wp_get_attachment_image($image_id, 'thumbnail', false, ['loading' => 'lazy']); ?>
                        </span>
                    <?php endif; ?>

                    <span class="icon-panel__label"><?php echo esc_html($label); ?></span>

                    <?php if ($description) : ?>
                        <p class="icon-panel__description"><?php echo esc_html($description); ?></p>
                    <?php endif; ?>
                </<?php echo $tag; ?>>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<?php
}
?>
