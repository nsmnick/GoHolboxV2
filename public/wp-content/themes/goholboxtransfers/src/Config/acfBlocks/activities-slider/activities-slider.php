<?php
// Activities Slider — deliberately the same panel as the Destination Slider
// (slider-panel): its fields are identical apart from the slide picker's post
// type (Activities vs Destinations), so it renders through the same template,
// styles (_airport-slider.scss) and Swiper setup (sliders.js) rather than
// keeping a second copy in step. Change the look in slider-panel.php /
// _airport-slider.scss and both sliders follow.
include __DIR__ . '/../slider-panel/slider-panel.php';
