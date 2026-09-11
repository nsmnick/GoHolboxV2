<?php
include __DIR__ . '/../_block-generics.php';
include __DIR__ . '/../_block-preview.php';

if (!$preview_popup_image && !$hide_panel) {
    $heading      = get_field('heading');
    $intro        = get_field('intro_text');
    $steps        = get_field('steps') ?: [];
    $note_heading = get_field('note_title');
    $notes        = get_field('note_items') ?: [];

    if (!$heading && !$steps) {
        return;
    }
?>

<section class="how-to-calculate-panel <?php echo $generic_block_settings_classes; ?>">
    <div class="container <?php echo esc_attr($generic_container_class); ?>">
        <div class="how-to-calculate-panel__card">

            <?php if ($heading || $intro) : ?>
                <div class="how-to-calculate-panel__heading">
                    <?php if ($heading) : ?>
                        <h2><?php echo esc_html($heading); ?></h2>
                    <?php endif; ?>

                    <?php if ($intro) : ?>
                        <p class="how-to-calculate-panel__intro"><?php echo esc_html($intro); ?></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if ($steps) : ?>
                <div class="how-to-calculate-panel__steps">
                    <?php foreach ($steps as $i => $step) :
                        $step_heading = $step['step_title'] ?? '';
                        $step_text    = $step['step_text'] ?? '';
                    ?>
                        <div class="how-to-calculate-panel__step">
                            <span class="how-to-calculate-panel__number"><?php echo esc_html($i + 1); ?></span>

                            <?php if ($step_heading) : ?>
                                <h3><?php echo esc_html($step_heading); ?></h3>
                            <?php endif; ?>

                            <?php if ($step_text) : ?>
                                <p><?php echo esc_html($step_text); ?></p>
                            <?php endif; ?>

                            <?php if ($i < count($steps) - 1) : ?>
                                <span class="how-to-calculate-panel__step-arrow" aria-hidden="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" width="22" height="22"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                                </span>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if ($note_heading || $notes) : ?>
                <div class="how-to-calculate-panel__note">
                    <?php if ($note_heading) : ?>
                        <div class="how-to-calculate-panel__note-heading">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18"><circle cx="12" cy="12" r="9"/><line x1="12" y1="11" x2="12" y2="16"/><circle cx="12" cy="7.5" r="0.5" fill="currentColor" stroke="none"/></svg>
                            <?php echo esc_html($note_heading); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($notes) : ?>
                        <div class="how-to-calculate-panel__note-grid">
                            <?php foreach ($notes as $note) :
                                $note_text = $note['note_text'] ?? '';

                                if (!$note_text) {
                                    continue;
                                }
                            ?>
                                <div class="how-to-calculate-panel__note-item">
                                    <span class="how-to-calculate-panel__note-check" aria-hidden="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" width="11" height="11"><polyline points="20 6 9 17 4 12"/></svg>
                                    </span>
                                    <span><?php echo wp_kses_post($note_text); ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>

<?php
}
?>
