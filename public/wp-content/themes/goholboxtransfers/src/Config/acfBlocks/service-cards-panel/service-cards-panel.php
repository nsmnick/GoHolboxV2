<?php
include __DIR__ . '/../_block-generics.php';
include __DIR__ . '/../_block-preview.php';

if (!$preview_popup_image && !$hide_panel) {
    $heading = get_field('heading');
    $intro   = get_field('intro');
    $cards   = get_field('cards') ?: [];

    if (!$heading && !$cards) {
        return;
    }

    $cards          = array_slice($cards, 0, 3);
    $count_modifier = [1 => '', 2 => ' service-cards-panel__grid--two', 3 => ' service-cards-panel__grid--three'][count($cards)] ?? '';

    $render_button = function ($button, $default_label) {
        $link = $button['button_link'] ?? null;

        if (!$link || empty($link['url'])) {
            return;
        }

        $colour    = $button['button_colour'] ?? 'gold';
        $btn_class = 'button' . ($colour !== 'gold' ? ' button--' . $colour : '');
        ?>
        <a
            class="<?php echo esc_attr($btn_class); ?>"
            href="<?php echo esc_url($link['url']); ?>"
            <?php if (!empty($link['target'])) : ?>target="<?php echo esc_attr($link['target']); ?>" rel="noopener noreferrer"<?php endif; ?>
        >
            <?php echo esc_html($link['title'] ?: $default_label); ?>
            <span aria-hidden="true">→</span>
        </a>
        <?php
    };
?>

<section class="service-cards-panel <?php echo $generic_block_settings_classes; ?>">
    <div class="container <?php echo esc_attr($generic_container_class); ?>">

        <?php if ($heading || $intro) : ?>
            <div class="service-cards-panel__heading">
                <?php if ($heading) : ?>
                    <h2><?php echo esc_html($heading); ?></h2>
                <?php endif; ?>

                <?php if ($intro) : ?>
                    <p class="service-cards-panel__intro"><?php echo esc_html($intro); ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if ($cards) : ?>
            <div class="service-cards-panel__grid<?php echo esc_attr($count_modifier); ?>">
                <?php foreach ($cards as $card) :
                    $images          = $card['images'] ?: [];
                    $label           = $card['label'] ?? '';
                    $title           = $card['title'] ?? '';
                    $passengers      = $card['passengers'] ?? '';
                    $card_intro      = $card['intro'] ?? '';
                    $features        = $card['features'] ?: [];
                    $vehicles_label  = $card['vehicles_label'] ?? '';
                    $vehicles        = $card['vehicles'] ?: [];
                    $price_amount    = $card['price_amount'] ?? '';
                    $price_suffix    = $card['price_suffix'] ?? '';
                    $included_items  = $card['included_items'] ?: [];
                    $vip_message     = $card['vip_message'] ?? '';
                    $excluded_items  = $card['excluded_items'] ?: [];
                    $has_slider_nav  = count($images) > 1;
                ?>
                    <div class="service-cards-panel__card">

                        <?php if ($images) : ?>
                            <div class="service-cards-panel__slider service-card-swiper">
                                <div class="swiper-wrapper">
                                    <?php foreach ($images as $slide) :
                                        $image_id = $slide['image'] ?? null;

                                        if (!$image_id) {
                                            continue;
                                        }
                                    ?>
                                        <div class="swiper-slide service-cards-panel__slide">
                                            <?php echo wp_get_attachment_image($image_id, 'large'); ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <?php if ($has_slider_nav) : ?>
                                    <div class="service-card-swiper__nav">
                                        <button class="service-card-swiper__btn service-card-swiper__btn--prev" type="button" aria-label="Previous image">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" width="18" height="18"><polyline points="15 18 9 12 15 6"/></svg>
                                        </button>
                                        <button class="service-card-swiper__btn service-card-swiper__btn--next" type="button" aria-label="Next image">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" width="18" height="18"><polyline points="9 18 15 12 9 6"/></svg>
                                        </button>
                                    </div>
                                    <div class="service-card-swiper__pagination"></div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($label) : ?>
                            <div class="service-cards-panel__label"><?php echo esc_html($label); ?></div>
                        <?php endif; ?>

                        <?php if ($title) : ?>
                            <h3 class="service-cards-panel__title"><?php echo esc_html($title); ?></h3>
                        <?php endif; ?>

                        <?php if ($passengers) : ?>
                            <div class="service-cards-panel__passengers"><?php echo esc_html($passengers); ?></div>
                        <?php endif; ?>

                        <?php if ($card_intro) : ?>
                            <p class="service-cards-panel__card-intro"><?php echo esc_html($card_intro); ?></p>
                        <?php endif; ?>

                        <?php if ($features) : ?>
                            <div class="service-cards-panel__features">
                                <?php foreach ($features as $feature) :
                                    $feature_text = $feature['text'] ?? '';

                                    if (!$feature_text) {
                                        continue;
                                    }
                                ?>
                                    <div class="service-cards-panel__feature">
                                        <span class="service-cards-panel__check" aria-hidden="true">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" width="11" height="11"><polyline points="20 6 9 17 4 12"/></svg>
                                        </span>
                                        <span><?php echo esc_html($feature_text); ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($vehicles_label || $vehicles) : ?>
                            <div class="service-cards-panel__vehicles">
                                <?php if ($vehicles_label) : ?>
                                    <div class="service-cards-panel__vehicles-label"><?php echo esc_html($vehicles_label); ?></div>
                                <?php endif; ?>

                                <?php if ($vehicles) : ?>
                                    <div class="service-cards-panel__vehicles-list">
                                        <?php foreach ($vehicles as $i => $vehicle) :
                                            $vehicle_text = $vehicle['text'] ?? '';

                                            if (!$vehicle_text) {
                                                continue;
                                            }
                                        ?>
                                            <?php if ($i > 0) : ?><span class="service-cards-panel__divider-dot" aria-hidden="true">•</span><?php endif; ?>
                                            <?php echo esc_html($vehicle_text); ?>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($price_amount) : ?>
                            <div class="service-cards-panel__price">
                                From <strong><?php echo esc_html($price_amount); ?></strong> <?php echo esc_html($price_suffix); ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($included_items || $vip_message || $excluded_items) : ?>
                            <div class="service-cards-panel__accordion faq-panel__accordion">

                                <?php if ($included_items) : ?>
                                    <details class="faq-item">
                                        <summary class="faq-item__summary">
                                            <span class="faq-item__question">Included</span>
                                        </summary>
                                        <div class="faq-item__content">
                                            <ul class="service-cards-panel__list service-cards-panel__list--included">
                                                <?php foreach ($included_items as $item) :
                                                    $item_text = $item['text'] ?? '';

                                                    if (!$item_text) {
                                                        continue;
                                                    }
                                                ?>
                                                    <li><?php echo esc_html($item_text); ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </details>
                                <?php endif; ?>

                                <?php if ($vip_message || $excluded_items) : ?>
                                    <details class="faq-item">
                                        <summary class="faq-item__summary">
                                            <span class="faq-item__question">Not Included</span>
                                        </summary>
                                        <div class="faq-item__content">
                                            <?php if ($vip_message) : ?>
                                                <div class="service-cards-panel__vip-message"><?php echo wp_kses_post(wpautop($vip_message)); ?></div>
                                            <?php else : ?>
                                                <ul class="service-cards-panel__list service-cards-panel__list--excluded">
                                                    <?php foreach ($excluded_items as $item) :
                                                        $item_text = $item['text'] ?? '';

                                                        if (!$item_text) {
                                                            continue;
                                                        }
                                                    ?>
                                                        <li><?php echo esc_html($item_text); ?></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </div>
                                    </details>
                                <?php endif; ?>

                            </div>
                        <?php endif; ?>

                        <?php $render_button($card['check_prices_button'] ?? [], 'Check Prices'); ?>
                        <?php $render_button($card['more_info_button'] ?? [], 'More Info'); ?>

                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>

<?php
}
?>
