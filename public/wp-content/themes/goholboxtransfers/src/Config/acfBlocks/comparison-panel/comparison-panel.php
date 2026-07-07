<?php
include __DIR__ . '/../_block-generics.php';
include __DIR__ . '/../_block-preview.php';

if (!$preview_popup_image && !$hide_panel) {
    $meta      = get_field('meta_heading');
    $heading   = get_field('main_heading');
    $paragraph = get_field('paragraph');
    $levels    = get_field('levels') ?: [];
    $features  = get_field('features') ?: [];

    if (!$levels || !$features) {
        echo '<p style="padding:2rem;opacity:0.4;font-style:italic;">Add at least 2 levels and 1 feature row to show this comparison table.</p>';
        return;
    }

    $level_count = min(count($levels), 3);

    $tick = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 13l4.5 4.5L19 7" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>';
    $cross = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 5l14 14M19 5L5 19" stroke="currentColor" stroke-width="3" stroke-linecap="round"/></svg>';
?>

<section class="comparison-panel animate fade-up <?php echo $generic_block_settings_classes; ?>">
    <div class="container <?php echo $generic_container_class; ?>">

        <?php if ($meta) : ?>
            <p class="comparison-panel__meta"><?php echo esc_html($meta); ?></p>
        <?php endif; ?>

        <?php if ($heading) : ?>
            <h2 class="comparison-panel__heading"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>

        <?php if ($paragraph) : ?>
            <p class="comparison-panel__paragraph"><?php echo esc_html($paragraph); ?></p>
        <?php endif; ?>

        <div class="comparison-panel__wrap">
            <table class="comparison-panel__table">
                <thead>
                    <tr>
                        <th class="comparison-panel__row-head"></th>
                        <?php for ($i = 0; $i < $level_count; $i++) :
                            $level_price = $levels[$i]['level_price'] ?? '';
                        ?>
                            <th>
                                <?php echo esc_html($levels[$i]['level_label'] ?? ''); ?>
                                <?php if ($level_price) : ?>
                                    <span class="comparison-panel__price"><?php echo esc_html($level_price); ?></span>
                                <?php endif; ?>
                            </th>
                        <?php endfor; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($features as $row) : ?>
                        <tr>
                            <td class="comparison-panel__feature"><?php echo esc_html($row['feature_label'] ?? ''); ?></td>
                            <?php for ($i = 1; $i <= $level_count; $i++) :
                                $included = !empty($row['level_' . $i . '_included']);
                            ?>
                                <td class="comparison-panel__icon <?php echo $included ? 'comparison-panel__icon--yes' : 'comparison-panel__icon--no'; ?>">
                                    <?php echo $included ? $tick : $cross; ?>
                                </td>
                            <?php endfor; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</section>

<?php
}
?>
