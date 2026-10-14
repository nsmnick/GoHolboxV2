<?php
include __DIR__ . '/../_block-generics.php';
include __DIR__ . '/../_block-preview.php';

// Planyo's full booking form (the same plain-JavaScript embed as the live
// site's Booking page). Planyo's booking-utils.js fetches the form via JSONP
// and writes it into #planyo_content directly in our DOM — not an iframe —
// so _planyo-booking-form.scss can restyle it. The Planyo Booking Widget
// (price preview) submits to this page with resource/date/time parameters
// in the URL, which booking-utils.js reads to pre-fill this form.
//
// Only the values below differ from Planyo's stock snippet; keep the rest
// as Planyo supplies it.

if ($is_preview) {
    echo '<div style="padding:2rem;border:2px dashed #ccc;border-radius:12px;text-align:center;font-family:sans-serif;">'
        . '<strong>Planyo Booking Form</strong><br>'
        . '<span style="opacity:0.6;">The full booking form loads on the live page — it isn\'t shown in the editor.</span>'
        . '</div>';
    return;
}

if (!$hide_panel && !$preview_popup_image) {
    $booking_url = Theme\Utils::get_booking_page_url();
?>

<section class="planyo-booking-form <?php echo $generic_block_settings_classes; ?>">
    <div class="container <?php echo $generic_container_class; ?>">
        <div class="planyo-booking-form__card">

<script type="text/javascript">
var planyo_site_id='61399';
var planyo_default_mode='reserve';
var extra_search_fields='';
var sort_fields='';
var planyo_resource_ordering='name';
var planyo_include_js_library=true;
var planyo_attribs='resource_id=204557&mode=reserve';
var planyo_resource_id='';
var planyo_language='EN';
var ulap_script="jsonp";
var planyo_use_https=true;
var planyo_files_location=(planyo_use_https ? "https" : "http") + '://www.planyo.com/Plugins/PlanyoFiles';
var empty_mode=false;
</script>

<script type="text/javascript">
function get_param (name) {name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");var regexS = "[\\?&]"+name+"=([^&#]*)";var regex = new RegExp (regexS);var results = regex.exec (window.location.href);if (results == null) return null;else  return results[1];}
if (get_param('mode'))planyo_embed_mode = get_param('mode');
function get_full_planyo_file_path(name) {if(planyo_files_location.length==0||planyo_files_location.lastIndexOf('/')==planyo_files_location.length-1)return planyo_files_location+name; else return planyo_files_location+'/'+name;}
</script>
<link rel='stylesheet' href='https://www.planyo.com/schemes/?calendar=61399&detect_mobile=auto&sel=scheme_css' type='text/css' />
<div id='planyo_content' class='planyo'><img src='https://www.planyo.com/images/hourglass.gif' align='middle' alt='Loading…' /></div>
<script type='text/javascript' src='https://www.planyo.com/Plugins/PlanyoFiles/jquery.min.js'></script>
<script src='https://www.planyo.com/Plugins/PlanyoFiles/booking-utils.js' type='text/javascript'></script>
<noscript><a href='https://www.planyo.com/about-calendar.php?calendar=61399'>Make a reservation</a><br/><br/><a href='https://www.planyo.com/'>Reservation system powered by Planyo</a></noscript>

        </div>
    </div>
</section>

<!-- Planyo shopping cart widget (fixed-position cart icon) -->
<link rel='stylesheet' href='https://www.planyo.com/cart-styles.css' type='text/css' /><script type='text/javascript'>
document.pc_lang="EN"; document.pc_url_prefix = "<?php echo esc_js($booking_url); ?>"; document.planyo_cart_widget = 2;
</script><script type='text/javascript' src='https://www.planyo.com/cart-utils.js?v=9'></script>
<div id='planyo_cart_widget' class='planyo_cart_widget fixed_position' title='Shopping cart' onclick="planyo_show_cart_contents()"><div id='cart-icon'><div style='position: relative;top: -10px; left: 18px; background-color: #ff0033; text-align: center; width: 20px; height: 20px; border-radius: 20px;'><div style="font-family: inherit; padding-top: 3px; font-size: 11px; color: white; text-align: center; font-weight:bold"><span id='widget_items_in_cart' class='items_in_cart'>0</span></div></div></div><div style='float:none;clear:both;'></div></div><div id='pc_cart_parent' class='slide-out'><span class='title' id='pc_your_cart'>Your cart</span><div id='pc_close'><a href='javascript:planyo_hide_cart_contents()'>&times;</a></div><div id='pc_cart_contents' style='background-color:white'></div></div>
<script type='text/javascript'>
if(!window.planyo_site_id) window.planyo_site_id='61399';
</script>

<?php
}
?>
