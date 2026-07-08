<?php
include __DIR__ . '/../_block-generics.php';
include __DIR__ . '/../_block-preview.php';

if (!$preview_popup_image && !$hide_panel) {
    $meta      = get_field('meta_heading');
    $heading   = get_field('main_heading');
    $paragraph = get_field('paragraph');
    $plans     = get_field('plans') ?: [];

    if (!$plans) {
        echo '<p style="padding:2rem;opacity:0.4;font-style:italic;">Add at least 2 plans to show this pricing panel.</p>';
        return;
    }

    $count = min(count($plans), 3);
    $count_class = ['', 'one', 'two', 'three'][$count];

    $tick = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 13l4.5 4.5L19 7" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>';
?>

<section class="pricing-panel animate fade-up <?php echo $generic_block_settings_classes; ?>">
    <div class="container <?php echo $generic_container_class; ?>">

        <?php if ($meta) : ?>
            <p class="pricing-panel__meta"><?php echo esc_html($meta); ?></p>
        <?php endif; ?>

        <?php if ($heading) : ?>
            <h2 class="pricing-panel__heading"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>

        <?php if ($paragraph) : ?>
            <p class="pricing-panel__paragraph"><?php echo esc_html($paragraph); ?></p>
        <?php endif; ?>

        <div class="pricing-panel__grid pricing-panel__grid--<?php echo $count_class; ?>">
            <?php foreach (array_slice($plans, 0, 3) as $plan) :
                $name       = $plan['plan_name'] ?? '';
                $price      = $plan['plan_price'] ?? '';
                $price_note = $plan['plan_price_note'] ?? '';
                $features   = $plan['plan_features'] ?? [];
                $link       = $plan['button']['button_link'] ?? null;
                $colour     = $plan['button']['button_colour'] ?? 'gold';
                $btn_class  = 'button' . ($colour !== 'gold' ? ' button--' . $colour : '');
                $image_id   = $plan['plan_image'] ?? null;
            ?>
                <div class="pricing-panel__card">
                    <?php if ($image_id) : ?>
                        <div class="pricing-panel__card-image">
                            <?php echo wp_get_attachment_image($image_id, 'medium', false, ['loading' => 'lazy']); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($name) : ?>
                        <p class="pricing-panel__card-name"><?php echo esc_html($name); ?></p>
                    <?php endif; ?>

                    <?php if ($price) : ?>
                        <p class="pricing-panel__card-price">
                            <?php echo esc_html($price); ?>
                            <?php if ($price_note) : ?>
                                <span class="pricing-panel__card-price-note"><?php echo esc_html($price_note); ?></span>
                            <?php endif; ?>
                        </p>
                    <?php endif; ?>

                    <?php if ($features) : ?>
                        <ul class="pricing-panel__card-features">
                            <?php foreach ($features as $feature) :
                                $feature_text = $feature['feature_text'] ?? '';
                                if (!$feature_text) {
                                    continue;
                                }
                            ?>
                                <li>
                                    <span class="pricing-panel__card-tick"><?php echo $tick; ?></span>
                                    <?php echo esc_html($feature_text); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <?php if ($link && !empty($link['url'])) : ?>
                        <div class="pricing-panel__card-button-wrap">
                            <a
                                class="<?php echo esc_attr($btn_class); ?>"
                                href="<?php echo esc_url($link['url']); ?>"
                                <?php if (!empty($link['target'])) : ?>target="<?php echo esc_attr($link['target']); ?>" rel="noopener noreferrer"<?php endif; ?>
                            >
                                <?php echo esc_html($link['title'] ?: 'Book Now'); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<?php
}
?>
