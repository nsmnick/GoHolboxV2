<?php
include __DIR__ . '/../_block-generics.php';
include __DIR__ . '/../_block-preview.php';

// Each plan's embed code is kept as an exact, separate literal block rather
// than templated with variables — they differ in more than just the
// resource_id (e.g. the pick-up time option lists and rental_time_value
// aren't identical across plans), so parameterising risked introducing a
// subtle mismatch. Add a new plan by pasting its full Planyo snippet in as
// its own <template data-plan="..."> below, and add a matching tab button.
//
// The visitor picks the plan here (not the CMS) — each plan is wrapped in
// a <template>, which is inert (no ids collide, no scripts run) until
// planyo-plan-switcher.js clones the chosen one into
// .planyo-booking-panel__active-widget. Rendering all 4 live at once
// isn't an option: Planyo's own field ids (start_time, rental_prop_From,
// res_form_buttons, etc.) are NOT unique per plan, only the date/form/
// price-preview ids carry a per-plan suffix — so more than one plan live
// in the DOM at a time would break getElementById-based lookups Planyo's
// own code relies on.

if (!$hide_panel && !$preview_popup_image) {
?>

<section class="planyo-booking-panel animate fade-in <?php echo $generic_block_settings_classes; ?>">
    <div class="container <?php echo $generic_container_class; ?>">
        <div class="planyo-booking-panel__widget">

            <div class="planyo-booking-panel__plan-picker" role="tablist" aria-label="Choose your vehicle">
                <button type="button" class="planyo-booking-panel__plan-tab is-active" data-plan="standard_van" role="tab" aria-selected="true">
                    Standard Van
                    <span>Up to 5 people</span>
                </button>
                <button type="button" class="planyo-booking-panel__plan-tab" data-plan="large_van" role="tab" aria-selected="false">
                    Large Standard Van
                    <span>6&ndash;9 people</span>
                </button>
                <button type="button" class="planyo-booking-panel__plan-tab" data-plan="premium_suburban" role="tab" aria-selected="false">
                    Premium Suburban
                    <span>1&ndash;5 people, door to door</span>
                </button>
                <button type="button" class="planyo-booking-panel__plan-tab" data-plan="premium_toyota" role="tab" aria-selected="false">
                    Premium Toyota
                    <span>1&ndash;10 people</span>
                </button>
            </div>

            <div class="planyo-booking-panel__active-widget"></div>

            <p class="planyo-booking-panel__note">*Ensure you are selecting the correct number of passengers for chosen vehicle</p>

            <template data-plan="standard_van">

<div id='planyo_price_preview_widget' class='planyo horizontal-widget'>
<script type='text/javascript' src='https://www.planyo.com/utils.js'></script>
<script type='text/javascript' src='https://www.planyo.com/wrappers.js'></script>
<link rel='stylesheet' href='https://www.planyo.com/Plugins/PlanyoFiles/bootstrap-planyo.min.css' type='text/css' />

<link rel='stylesheet' href='https://www.planyo.com/schemes/?calendar=61399&sel=scheme_css' type='text/css' />
<style type='text/css'>
#planyo_price_preview_formPST44657 label {display:block;float:none;width:100%}
form#planyo_price_preview_formPST44657 li.planyo_static_help {margin-left:0px;}
</style>
<form id='planyo_price_preview_formPST44657' name='search_form' class='planyo   form-inline' action='https://goholboxtransfers.com/booking/' role='form' method='get'><input type='hidden' value="61399" id='calendar' name='calendar' /><input type='hidden' value="1" id='submitted' name='submitted' /><input type='hidden' value="https://goholboxtransfers.com/booking/" id='feedback_url' name='feedback_url' />  <div style='position:absolute;visibility:hidden;z-index:5000;' class='picker_dropdown ' id='one_datePST44657cal' onmousedown='var e=arguments[0] || window.event;e.stopPropagation();' onclick='var e=arguments[0] || window.event;e.stopPropagation();' ></div>
        <script type='text/javascript'>
              js_set_event(document.getElementById('one_datePST44657cal'), 'click', 'js_dummy',false);
                      document.first_weekday=1;
        </script>
      <script type='text/javascript'>
            document.new_scheme=1;
      document.s_prev = "previous";
document.s_next = "next";
document.s_today = "today";
document.s_day = "day";
document.s_days = "days";
document.s_week = "week";
document.s_weeks = "weeks";
document.s_weekday = "weekday";
document.s_month = "month";
document.s_single_res = "single resource";
document.s_weekdays_short = eval('[\"M\", \"T\", \"W\", \"T\", \"F\", \"S\", \"S\"]');
document.s_weekdays_med = eval('[\"Mon\", \"Tue\", \"Wed\", \"Thu\", \"Fri\", \"Sat\", \"Sun\"]');
document.s_weekdays_long = ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"];
document.s_months_short = eval('[\"Jan\", \"Feb\", \"Mar\", \"Apr\", \"May\", \"Jun\", \"Jul\", \"Aug\", \"Sep\", \"Oct\", \"Nov\", \"Dec\"]');
document.s_months_long = eval('[\"January\", \"February\", \"March\", \"April\", \"May\", \"June\", \"July\", \"August\", \"September\", \"October\", \"November\", \"December\"]');
document.s_all = "All";
document.s_showall = "Show all";
document.s_areav = "are available.";
document.s_clickres = "Click to make reservation.";
document.s_partav = "Available for part-day rental only. Click on the date above for details.";
document.s_outof = "out of";
document.s_unav = "Unavailable";
document.s_noav = "Unavailable";
document.s_show_more = "show more";
document.s_av = "Available";
document.s_vacation = "Vacations";
document.s_allday = "All day";
document.s_day_view = "show day";
document.s_month_view = "show month";
document.s_more = "more";
    if (!document.date_format) document.date_format = "d F Y";

js_set_event(document, 'mousedown', 'js_close_calendar',false);

    </script>
  <div class='form-group planyo-form-item-group datefld  single-col' id='row_one_datePST44657'><label class='control-label'>Date<em>*</em></label><div class='input-group '><input class='with-status-border form-control'  type='text' id='one_datePST44657' name='one_datePST44657'  autocomplete='off'  value="" onchange="planyo_show_price_preview(44657)" onfocus="js_close_calendar();planyo_price_prev_context(204557);js_show_calendar('one_datePST44657','planyo_show_price_preview(44657)');" onmousedown="var e=arguments[0] || window.event;e.stopPropagation();" onclick="var e=arguments[0] || window.event;e.stopPropagation();"  /><span class='input-group-addon input-group-append' onclick="js_close_calendar();planyo_price_prev_context(204557);js_show_calendar('one_datePST44657','planyo_show_price_preview(44657)');"><span class='input-group-text'> <a class='planyo-cal-icon' target='_self' onclick="planyo_price_prev_context(204557);js_show_calendar('one_datePST44657','planyo_show_price_preview(44657)');" id="one_datePST44657calref">&#160;</a></span></span></div></div><div class='form-group planyo-form-item-group   single-col' id='row_start_time'><label class='control-label'>Pick Up Time</label><select class='with-status-border form-control' name='start_time' id='start_time'  onchange="planyo_show_price_preview(44657)" >
<option selected='selected' value="4" >04:00&nbsp;</option>
<option  value="4.5" >04:30&nbsp;</option>
<option  value="5" >05:00&nbsp;</option>
<option  value="5.5" >05:30&nbsp;</option>
<option  value="6" >06:00&nbsp;</option>
<option  value="6.5" >06:30&nbsp;</option>
<option  value="7" >07:00&nbsp;</option>
<option  value="7.5" >07:30&nbsp;</option>
<option  value="8" >08:00&nbsp;</option>
<option  value="8.5" >08:30&nbsp;</option>
<option  value="9" >09:00&nbsp;</option>
<option  value="9.5" >09:30&nbsp;</option>
<option  value="10" >10:00&nbsp;</option>
<option  value="10.5" >10:30&nbsp;</option>
<option  value="11" >11:00&nbsp;</option>
<option  value="11.5" >11:30&nbsp;</option>
<option  value="12" >12:00&nbsp;</option>
<option  value="12.5" >12:30&nbsp;</option>
<option  value="13" >13:00&nbsp;</option>
<option  value="13.5" >13:30&nbsp;</option>
<option  value="14" >14:00&nbsp;</option>
<option  value="14.5" >14:30&nbsp;</option>
<option  value="15" >15:00&nbsp;</option>
<option  value="15.5" >15:30&nbsp;</option>
<option  value="16" >16:00&nbsp;</option>
<option  value="16.5" >16:30&nbsp;</option>
<option  value="17" >17:00&nbsp;</option>
<option  value="17.5" >17:30&nbsp;</option>
<option  value="18" >18:00&nbsp;</option>
<option  value="18.5" >18:30&nbsp;</option>
<option  value="19" >19:00&nbsp;</option>
<option  value="19.5" >19:30&nbsp;</option>
<option  value="20" >20:00&nbsp;</option>
<option  value="20.5" >20:30&nbsp;</option>
<option  value="21" >21:00&nbsp;</option>
<option  value="21.5" >21:30&nbsp;</option>
<option  value="22" >22:00&nbsp;</option>
<option  value="22.5" >22:30&nbsp;</option>
<option  value="23" >23:00&nbsp;</option>
<option  value="23.5" >23:30&nbsp;</option>
<option  value="24" >24:00&nbsp;</option>
</select>
</div><input type='hidden' value="2.5" id='rental_time_value' name='rental_time_value' /><div class='form-group planyo-form-item-group   single-col' id='row_rental_prop_From'><label class='control-label'>From</label><select class='with-status-border form-control' name='rental_prop_From' id='rental_prop_From'  onchange="planyo_show_price_preview(44657)" >
<option value='none'>---</option>
<option  value="Holbox Ferry (Chiquila)" >Holbox Ferry (Chiquila)&nbsp;</option>
<option  value="Akumal" >Akumal&nbsp;</option>
<option  value="Cancun" >Cancun&nbsp;</option>
<option  value="Cancun Airport" >Cancun Airport&nbsp;</option>
<option  value="El Cuyo" > El Cuyo&nbsp;</option>
<option  value="Playa Del Carmen/Ferry Cozumel/Mayacoba" >Playa Del Carmen/Ferry Cozumel/Mayacoba&nbsp;</option>
<option  value="Ferry Isla Mujeres" > Ferry Isla Mujeres&nbsp;</option>
<option  value="Costa Mujeres/Punta Sam" >Costa Mujeres/Punta Sam&nbsp;</option>
<option  value="Isla Blanca" >Isla Blanca&nbsp;</option>
<option  value="Puerto Morelos" >Puerto Morelos&nbsp;</option>
<option  value="Tulum" >Tulum&nbsp;</option>
</select>
</div><div class='form-group planyo-form-item-group   single-col' id='row_rental_prop_To'><label class='control-label'>To</label><select class='with-status-border form-control' name='rental_prop_To' id='rental_prop_To'  onchange="planyo_show_price_preview(44657)" >
<option value='none'>---</option>
<option  value="Akumal" >Akumal&nbsp;</option>
<option  value="Cancun" >Cancun&nbsp;</option>
<option  value="Cancun Airport" >Cancun Airport&nbsp;</option>
<option  value="El Cuyo" >El Cuyo&nbsp;</option>
<option  value="Playa del Carmen/Ferry Cozumel/Mayacoba" >Playa del Carmen/Ferry Cozumel/Mayacoba&nbsp;</option>
<option  value="Ferry Isla Mujeres" >Ferry Isla Mujeres&nbsp;</option>
<option  value="Costa Mujeres/Punta Sam" >Costa Mujeres/Punta Sam&nbsp;</option>
<option  value="Isla Blanca" >Isla Blanca&nbsp;</option>
<option  value="Puerto Morelos" >Puerto Morelos&nbsp;</option>
<option  value="Tulum" >Tulum&nbsp;</option>
<option  value="Holbox Ferry (Chiquila)" >Holbox Ferry (Chiquila)&nbsp;</option>
</select>
</div><div class='form-group planyo-form-item-group   single-col' id='row_rental_prop_persons'><label class='control-label'>Number of persons</label><select class='with-status-border form-control' name='rental_prop_persons' id='rental_prop_persons'  onchange="planyo_show_price_preview(44657)" >
<option value='none'>---</option>
<option  value="1" >1&nbsp;</option>
<option  value="2" >2&nbsp;</option>
<option  value="3" >3&nbsp;</option>
<option  value="4" >4&nbsp;</option>
<option  value="5" >5&nbsp;</option>
</select>
</div><input type='hidden' value="15" id='granulation' name='granulation' /><input type='hidden' value="fetch_price" id='mode' name='mode' /><input type='hidden' value="1" id='include_reserve_button' name='include_reserve_button' /><input type='hidden' value="1" id='html_mode' name='html_mode' /><input type='hidden' value="204557" id='resource_id' name='resource_id' /><input type='hidden' value="EN" id='custom-language' name='custom-language' /><div id='res_form_buttons' >
</div>
<input type='hidden' value='true' id='submitted_field' name='submitted' /><input type='hidden' name='form_sec' value='3029fa00cb8b69afcd38042cd40b8d371bbd11e4c1d12864a4d988fc601be548' /></form>
</div>

<div id='planyo_price_preview_parentPST44657'>
<div id='planyo_price_previewPST44657'></div>
</div>
<script type='text/javascript' src='https://www.planyo.com/Plugins/PlanyoFiles/jquery-3.6.4.min.js'></script>
<script type='text/javascript'>
window.planyo_resource_id=204557;
document.picker_preview_sync_priceprev=1;
</script>
<script type='text/javascript' src='https://www.planyo.com/Plugins/PlanyoFiles/price-preview.js'></script>
<iframe name='ppemb204557' style='display:none' width='10' height='10' src='https://www.planyo.com/embed-calendar.php?resource_id=204557&calendar=61399'></iframe>

            </template>

            <template data-plan="large_van">

<div id='planyo_price_preview_widget' class='planyo horizontal-widget'>
<script type='text/javascript' src='https://www.planyo.com/utils.js'></script>
<script type='text/javascript' src='https://www.planyo.com/wrappers.js'></script>
<link rel='stylesheet' href='https://www.planyo.com/Plugins/PlanyoFiles/bootstrap-planyo.min.css' type='text/css' />

<link rel='stylesheet' href='https://www.planyo.com/schemes/?calendar=61399&sel=scheme_css' type='text/css' />
<style type='text/css'>
#planyo_price_preview_formPST35272 label {display:block;float:none;width:100%}
form#planyo_price_preview_formPST35272 li.planyo_static_help {margin-left:0px;}
</style>
<form id='planyo_price_preview_formPST35272' name='search_form' class='planyo   form-inline' action='https://goholboxtransfers.com/booking/' role='form' method='get'><input type='hidden' value="61399" id='calendar' name='calendar' /><input type='hidden' value="1" id='submitted' name='submitted' /><input type='hidden' value="https://goholboxtransfers.com/booking/" id='feedback_url' name='feedback_url' />  <div style='position:absolute;visibility:hidden;z-index:5000;' class='picker_dropdown ' id='one_datePST35272cal' onmousedown='var e=arguments[0] || window.event;e.stopPropagation();' onclick='var e=arguments[0] || window.event;e.stopPropagation();' ></div>
        <script type='text/javascript'>
              js_set_event(document.getElementById('one_datePST35272cal'), 'click', 'js_dummy',false);
                      document.first_weekday=1;
        </script>
      <script type='text/javascript'>
            document.new_scheme=1;
      document.s_prev = "previous";
document.s_next = "next";
document.s_today = "today";
document.s_day = "day";
document.s_days = "days";
document.s_week = "week";
document.s_weeks = "weeks";
document.s_weekday = "weekday";
document.s_month = "month";
document.s_single_res = "single resource";
document.s_weekdays_short = eval('[\"M\", \"T\", \"W\", \"T\", \"F\", \"S\", \"S\"]');
document.s_weekdays_med = eval('[\"Mon\", \"Tue\", \"Wed\", \"Thu\", \"Fri\", \"Sat\", \"Sun\"]');
document.s_weekdays_long = ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"];
document.s_months_short = eval('[\"Jan\", \"Feb\", \"Mar\", \"Apr\", \"May\", \"Jun\", \"Jul\", \"Aug\", \"Sep\", \"Oct\", \"Nov\", \"Dec\"]');
document.s_months_long = eval('[\"January\", \"February\", \"March\", \"April\", \"May\", \"June\", \"July\", \"August\", \"September\", \"October\", \"November\", \"December\"]');
document.s_all = "All";
document.s_showall = "Show all";
document.s_areav = "are available.";
document.s_clickres = "Click to make reservation.";
document.s_partav = "Available for part-day rental only. Click on the date above for details.";
document.s_outof = "out of";
document.s_unav = "Unavailable";
document.s_noav = "Unavailable";
document.s_show_more = "show more";
document.s_av = "Available";
document.s_vacation = "Vacations";
document.s_allday = "All day";
document.s_day_view = "show day";
document.s_month_view = "show month";
document.s_more = "more";
    if (!document.date_format) document.date_format = "d F Y";

js_set_event(document, 'mousedown', 'js_close_calendar',false);

    </script>
  <div class='form-group planyo-form-item-group datefld  single-col' id='row_one_datePST35272'><label class='control-label'>Date<em>*</em></label><div class='input-group '><input class='with-status-border form-control'  type='text' id='one_datePST35272' name='one_datePST35272'  autocomplete='off'  value="" onchange="planyo_show_price_preview(35272)" onfocus="js_close_calendar();planyo_price_prev_context(204935);js_show_calendar('one_datePST35272','planyo_show_price_preview(35272)');" onmousedown="var e=arguments[0] || window.event;e.stopPropagation();" onclick="var e=arguments[0] || window.event;e.stopPropagation();"  /><span class='input-group-addon input-group-append' onclick="js_close_calendar();planyo_price_prev_context(204935);js_show_calendar('one_datePST35272','planyo_show_price_preview(35272)');"><span class='input-group-text'> <a class='planyo-cal-icon' target='_self' onclick="planyo_price_prev_context(204935);js_show_calendar('one_datePST35272','planyo_show_price_preview(35272)');" id="one_datePST35272calref">&#160;</a></span></span></div></div><div class='form-group planyo-form-item-group   single-col' id='row_start_time'><label class='control-label'>Pick Up Time</label><select class='with-status-border form-control' name='start_time' id='start_time'  onchange="planyo_show_price_preview(35272)" >
<option selected='selected' value="4" >04:00&nbsp;</option>
<option  value="4.5" >04:30&nbsp;</option>
<option  value="5" >05:00&nbsp;</option>
<option  value="5.5" >05:30&nbsp;</option>
<option  value="6" >06:00&nbsp;</option>
<option  value="6.5" >06:30&nbsp;</option>
<option  value="7" >07:00&nbsp;</option>
<option  value="7.5" >07:30&nbsp;</option>
<option  value="8" >08:00&nbsp;</option>
<option  value="8.5" >08:30&nbsp;</option>
<option  value="9" >09:00&nbsp;</option>
<option  value="9.5" >09:30&nbsp;</option>
<option  value="10" >10:00&nbsp;</option>
<option  value="10.5" >10:30&nbsp;</option>
<option  value="11" >11:00&nbsp;</option>
<option  value="11.5" >11:30&nbsp;</option>
<option  value="12" >12:00&nbsp;</option>
<option  value="12.5" >12:30&nbsp;</option>
<option  value="13" >13:00&nbsp;</option>
<option  value="13.5" >13:30&nbsp;</option>
<option  value="14" >14:00&nbsp;</option>
<option  value="14.5" >14:30&nbsp;</option>
<option  value="15" >15:00&nbsp;</option>
<option  value="15.5" >15:30&nbsp;</option>
<option  value="16" >16:00&nbsp;</option>
<option  value="16.5" >16:30&nbsp;</option>
<option  value="17" >17:00&nbsp;</option>
<option  value="17.5" >17:30&nbsp;</option>
<option  value="18" >18:00&nbsp;</option>
<option  value="18.5" >18:30&nbsp;</option>
<option  value="19" >19:00&nbsp;</option>
<option  value="19.5" >19:30&nbsp;</option>
<option  value="20" >20:00&nbsp;</option>
<option  value="20.5" >20:30&nbsp;</option>
<option  value="21" >21:00&nbsp;</option>
<option  value="21.5" >21:30&nbsp;</option>
<option  value="22" >22:00&nbsp;</option>
</select>
</div><input type='hidden' value="2.5" id='rental_time_value' name='rental_time_value' /><div class='form-group planyo-form-item-group   single-col' id='row_rental_prop_From'><label class='control-label'>From</label><select class='with-status-border form-control' name='rental_prop_From' id='rental_prop_From'  onchange="planyo_show_price_preview(35272)" >
<option value='none'>---</option>
<option  value="Holbox Ferry (Chiquila)" >Holbox Ferry (Chiquila)&nbsp;</option>
<option  value="Akumal" >Akumal&nbsp;</option>
<option  value="Cancun" >Cancun&nbsp;</option>
<option  value="Cancun Airport" >Cancun Airport&nbsp;</option>
<option  value="El Cuyo" > El Cuyo&nbsp;</option>
<option  value="Playa Del Carmen/Ferry Cozumel/Mayacoba" >Playa Del Carmen/Ferry Cozumel/Mayacoba&nbsp;</option>
<option  value="Ferry Isla Mujeres" > Ferry Isla Mujeres&nbsp;</option>
<option  value="Costa Mujeres/Punta Sam" >Costa Mujeres/Punta Sam&nbsp;</option>
<option  value="Isla Blanca" >Isla Blanca&nbsp;</option>
<option  value="Puerto Morelos" >Puerto Morelos&nbsp;</option>
<option  value="Tulum" >Tulum&nbsp;</option>
</select>
</div><div class='form-group planyo-form-item-group   single-col' id='row_rental_prop_To'><label class='control-label'>To</label><select class='with-status-border form-control' name='rental_prop_To' id='rental_prop_To'  onchange="planyo_show_price_preview(35272)" >
<option value='none'>---</option>
<option  value="Akumal" >Akumal&nbsp;</option>
<option  value="Cancun" >Cancun&nbsp;</option>
<option  value="Cancun Airport" >Cancun Airport&nbsp;</option>
<option  value="El Cuyo" >El Cuyo&nbsp;</option>
<option  value="Playa del Carmen/Ferry Cozumel/Mayacoba" >Playa del Carmen/Ferry Cozumel/Mayacoba&nbsp;</option>
<option  value="Ferry Isla Mujeres" >Ferry Isla Mujeres&nbsp;</option>
<option  value="Costa Mujeres/Punta Sam" >Costa Mujeres/Punta Sam&nbsp;</option>
<option  value="Isla Blanca" >Isla Blanca&nbsp;</option>
<option  value="Puerto Morelos" >Puerto Morelos&nbsp;</option>
<option  value="Tulum" >Tulum&nbsp;</option>
<option  value="Holbox Ferry (Chiquila)" >Holbox Ferry (Chiquila)&nbsp;</option>
</select>
</div><div class='form-group planyo-form-item-group   single-col' id='row_rental_prop_persons'><label class='control-label'>Number of persons</label><select class='with-status-border form-control' name='rental_prop_persons' id='rental_prop_persons'  onchange="planyo_show_price_preview(35272)" >
<option value='none'>---</option>
<option  value="1" >1&nbsp;</option>
<option  value="2" >2&nbsp;</option>
<option  value="3" >3&nbsp;</option>
<option  value="4" >4&nbsp;</option>
<option  value="5" >5&nbsp;</option>
</select>
</div><input type='hidden' value="15" id='granulation' name='granulation' /><input type='hidden' value="fetch_price" id='mode' name='mode' /><input type='hidden' value="1" id='include_reserve_button' name='include_reserve_button' /><input type='hidden' value="1" id='html_mode' name='html_mode' /><input type='hidden' value="204935" id='resource_id' name='resource_id' /><input type='hidden' value="EN" id='custom-language' name='custom-language' /><div id='res_form_buttons' >
</div>
<input type='hidden' value='true' id='submitted_field' name='submitted' /><input type='hidden' name='form_sec' value='3029fa00cb8b69afcd38042cd40b8d371bbd11e4c1d12864a4d988fc601be548' /></form>
</div>

<div id='planyo_price_preview_parentPST35272'>
<div id='planyo_price_previewPST35272'></div>
</div>
<script type='text/javascript' src='https://www.planyo.com/Plugins/PlanyoFiles/jquery-3.6.4.min.js'></script>
<script type='text/javascript'>
window.planyo_resource_id=204935;
document.picker_preview_sync_priceprev=1;
</script>
<script type='text/javascript' src='https://www.planyo.com/Plugins/PlanyoFiles/price-preview.js'></script>
<iframe name='ppemb204935' style='display:none' width='10' height='10' src='https://www.planyo.com/embed-calendar.php?resource_id=204935&calendar=61399'></iframe>

            </template>

            <template data-plan="premium_suburban">

<div id='planyo_price_preview_widget' class='planyo horizontal-widget'>
<script type='text/javascript' src='https://www.planyo.com/utils.js'></script>
<script type='text/javascript' src='https://www.planyo.com/wrappers.js'></script>
<link rel='stylesheet' href='https://www.planyo.com/Plugins/PlanyoFiles/bootstrap-planyo.min.css' type='text/css' />

<link rel='stylesheet' href='https://www.planyo.com/schemes/?calendar=61399&sel=scheme_css' type='text/css' />
<style type='text/css'>
#planyo_price_preview_formPST19130 label {display:block;float:none;width:100%}
form#planyo_price_preview_formPST19130 li.planyo_static_help {margin-left:0px;}
</style>
<form id='planyo_price_preview_formPST19130' name='search_form' class='planyo   form-inline' action='https://goholboxtransfers.com/booking/' role='form' method='get'><input type='hidden' value="61399" id='calendar' name='calendar' /><input type='hidden' value="1" id='submitted' name='submitted' /><input type='hidden' value="https://goholboxtransfers.com/booking/" id='feedback_url' name='feedback_url' />  <div style='position:absolute;visibility:hidden;z-index:5000;' class='picker_dropdown ' id='one_datePST19130cal' onmousedown='var e=arguments[0] || window.event;e.stopPropagation();' onclick='var e=arguments[0] || window.event;e.stopPropagation();' ></div>
        <script type='text/javascript'>
              js_set_event(document.getElementById('one_datePST19130cal'), 'click', 'js_dummy',false);
                      document.first_weekday=1;
        </script>
      <script type='text/javascript'>
            document.new_scheme=1;
      document.s_prev = "previous";
document.s_next = "next";
document.s_today = "today";
document.s_day = "day";
document.s_days = "days";
document.s_week = "week";
document.s_weeks = "weeks";
document.s_weekday = "weekday";
document.s_month = "month";
document.s_single_res = "single resource";
document.s_weekdays_short = eval('[\"M\", \"T\", \"W\", \"T\", \"F\", \"S\", \"S\"]');
document.s_weekdays_med = eval('[\"Mon\", \"Tue\", \"Wed\", \"Thu\", \"Fri\", \"Sat\", \"Sun\"]');
document.s_weekdays_long = ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"];
document.s_months_short = eval('[\"Jan\", \"Feb\", \"Mar\", \"Apr\", \"May\", \"Jun\", \"Jul\", \"Aug\", \"Sep\", \"Oct\", \"Nov\", \"Dec\"]');
document.s_months_long = eval('[\"January\", \"February\", \"March\", \"April\", \"May\", \"June\", \"July\", \"August\", \"September\", \"October\", \"November\", \"December\"]');
document.s_all = "All";
document.s_showall = "Show all";
document.s_areav = "are available.";
document.s_clickres = "Click to make reservation.";
document.s_partav = "Available for part-day rental only. Click on the date above for details.";
document.s_outof = "out of";
document.s_unav = "Unavailable";
document.s_noav = "Unavailable";
document.s_show_more = "show more";
document.s_av = "Available";
document.s_vacation = "Vacations";
document.s_allday = "All day";
document.s_day_view = "show day";
document.s_month_view = "show month";
document.s_more = "more";
    if (!document.date_format) document.date_format = "d F Y";

js_set_event(document, 'mousedown', 'js_close_calendar',false);

    </script>
  <div class='form-group planyo-form-item-group datefld  single-col' id='row_one_datePST19130'><label class='control-label'>Date<em>*</em></label><div class='input-group '><input class='with-status-border form-control'  type='text' id='one_datePST19130' name='one_datePST19130'  autocomplete='off'  value="" onchange="planyo_show_price_preview(19130)" onfocus="js_close_calendar();planyo_price_prev_context(250685);js_show_calendar('one_datePST19130','planyo_show_price_preview(19130)');" onmousedown="var e=arguments[0] || window.event;e.stopPropagation();" onclick="var e=arguments[0] || window.event;e.stopPropagation();"  /><span class='input-group-addon input-group-append' onclick="js_close_calendar();planyo_price_prev_context(250685);js_show_calendar('one_datePST19130','planyo_show_price_preview(19130)');"><span class='input-group-text'> <a class='planyo-cal-icon' target='_self' onclick="planyo_price_prev_context(250685);js_show_calendar('one_datePST19130','planyo_show_price_preview(19130)');" id="one_datePST19130calref">&#160;</a></span></span></div></div><div class='form-group planyo-form-item-group   single-col' id='row_start_time'><label class='control-label'>Pick Up Time</label><select class='with-status-border form-control' name='start_time' id='start_time'  onchange="planyo_show_price_preview(19130)" >
<option selected='selected' value="4" >04:00&nbsp;</option>
<option  value="4.5" >04:30&nbsp;</option>
<option  value="5" >05:00&nbsp;</option>
<option  value="5.5" >05:30&nbsp;</option>
<option  value="6" >06:00&nbsp;</option>
<option  value="6.5" >06:30&nbsp;</option>
<option  value="7" >07:00&nbsp;</option>
<option  value="7.5" >07:30&nbsp;</option>
<option  value="8" >08:00&nbsp;</option>
<option  value="8.5" >08:30&nbsp;</option>
<option  value="9" >09:00&nbsp;</option>
<option  value="9.5" >09:30&nbsp;</option>
<option  value="10" >10:00&nbsp;</option>
<option  value="10.5" >10:30&nbsp;</option>
<option  value="11" >11:00&nbsp;</option>
<option  value="11.5" >11:30&nbsp;</option>
<option  value="12" >12:00&nbsp;</option>
<option  value="12.5" >12:30&nbsp;</option>
<option  value="13" >13:00&nbsp;</option>
<option  value="13.5" >13:30&nbsp;</option>
<option  value="14" >14:00&nbsp;</option>
<option  value="14.5" >14:30&nbsp;</option>
<option  value="15" >15:00&nbsp;</option>
<option  value="15.5" >15:30&nbsp;</option>
<option  value="16" >16:00&nbsp;</option>
<option  value="16.5" >16:30&nbsp;</option>
<option  value="17" >17:00&nbsp;</option>
<option  value="17.5" >17:30&nbsp;</option>
<option  value="18" >18:00&nbsp;</option>
<option  value="18.5" >18:30&nbsp;</option>
<option  value="19" >19:00&nbsp;</option>
<option  value="19.5" >19:30&nbsp;</option>
<option  value="20" >20:00&nbsp;</option>
<option  value="20.5" >20:30&nbsp;</option>
<option  value="21" >21:00&nbsp;</option>
<option  value="21.5" >21:30&nbsp;</option>
<option  value="22" >22:00&nbsp;</option>
<option  value="22.5" >22:30&nbsp;</option>
<option  value="23" >23:00&nbsp;</option>
<option  value="23.5" >23:30&nbsp;</option>
<option  value="24" >24:00&nbsp;</option>
</select>
</div><input type='hidden' value="2" id='rental_time_value' name='rental_time_value' /><div class='form-group planyo-form-item-group   single-col' id='row_rental_prop_From'><label class='control-label'>From</label><select class='with-status-border form-control' name='rental_prop_From' id='rental_prop_From'  onchange="planyo_show_price_preview(19130)" >
<option value='none'>---</option>
<option  value="Holbox Ferry (Chiquila)" >Holbox Ferry (Chiquila)&nbsp;</option>
<option  value="Akumal" >Akumal&nbsp;</option>
<option  value="Cancun" >Cancun&nbsp;</option>
<option  value="Cancun Airport" >Cancun Airport&nbsp;</option>
<option  value="El Cuyo" > El Cuyo&nbsp;</option>
<option  value="Playa Del Carmen/Ferry Cozumel/Mayacoba" >Playa Del Carmen/Ferry Cozumel/Mayacoba&nbsp;</option>
<option  value="Ferry Isla Mujeres" > Ferry Isla Mujeres&nbsp;</option>
<option  value="Costa Mujeres/Punta Sam" >Costa Mujeres/Punta Sam&nbsp;</option>
<option  value="Isla Blanca" >Isla Blanca&nbsp;</option>
<option  value="Puerto Morelos" >Puerto Morelos&nbsp;</option>
<option  value="Tulum" >Tulum&nbsp;</option>
</select>
</div><div class='form-group planyo-form-item-group   single-col' id='row_rental_prop_To'><label class='control-label'>To</label><select class='with-status-border form-control' name='rental_prop_To' id='rental_prop_To'  onchange="planyo_show_price_preview(19130)" >
<option value='none'>---</option>
<option  value="Akumal" >Akumal&nbsp;</option>
<option  value="Cancun" >Cancun&nbsp;</option>
<option  value="Cancun Airport" >Cancun Airport&nbsp;</option>
<option  value="El Cuyo" >El Cuyo&nbsp;</option>
<option  value="Playa del Carmen/Ferry Cozumel/Mayacoba" >Playa del Carmen/Ferry Cozumel/Mayacoba&nbsp;</option>
<option  value="Ferry Isla Mujeres" >Ferry Isla Mujeres&nbsp;</option>
<option  value="Costa Mujeres/Punta Sam" >Costa Mujeres/Punta Sam&nbsp;</option>
<option  value="Isla Blanca" >Isla Blanca&nbsp;</option>
<option  value="Puerto Morelos" >Puerto Morelos&nbsp;</option>
<option  value="Tulum" >Tulum&nbsp;</option>
<option  value="Holbox Ferry (Chiquila)" >Holbox Ferry (Chiquila)&nbsp;</option>
</select>
</div><div class='form-group planyo-form-item-group   single-col' id='row_rental_prop_persons'><label class='control-label'>Number of persons</label><select class='with-status-border form-control' name='rental_prop_persons' id='rental_prop_persons'  onchange="planyo_show_price_preview(19130)" >
<option value='none'>---</option>
<option  value="1" >1&nbsp;</option>
<option  value="2" >2&nbsp;</option>
<option  value="3" >3&nbsp;</option>
<option  value="4" >4&nbsp;</option>
<option  value="5" >5&nbsp;</option>
</select>
</div><input type='hidden' value="15" id='granulation' name='granulation' /><input type='hidden' value="fetch_price" id='mode' name='mode' /><input type='hidden' value="1" id='include_reserve_button' name='include_reserve_button' /><input type='hidden' value="1" id='html_mode' name='html_mode' /><input type='hidden' value="250685" id='resource_id' name='resource_id' /><input type='hidden' value="EN" id='custom-language' name='custom-language' /><div id='res_form_buttons' >
</div>
<input type='hidden' value='true' id='submitted_field' name='submitted' /><input type='hidden' name='form_sec' value='3029fa00cb8b69afcd38042cd40b8d371bbd11e4c1d12864a4d988fc601be548' /></form>
</div>

<div id='planyo_price_preview_parentPST19130'>
<div id='planyo_price_previewPST19130'></div>
</div>
<script type='text/javascript' src='https://www.planyo.com/Plugins/PlanyoFiles/jquery-3.6.4.min.js'></script>
<script type='text/javascript'>
window.planyo_resource_id=250685;
document.picker_preview_sync_priceprev=1;
</script>
<script type='text/javascript' src='https://www.planyo.com/Plugins/PlanyoFiles/price-preview.js'></script>
<iframe name='ppemb250685' style='display:none' width='10' height='10' src='https://www.planyo.com/embed-calendar.php?resource_id=250685&calendar=61399'></iframe>

            </template>

            <template data-plan="premium_toyota">

<div id='planyo_price_preview_widget' class='planyo horizontal-widget'>
<script type='text/javascript' src='https://www.planyo.com/utils.js'></script>
<script type='text/javascript' src='https://www.planyo.com/wrappers.js'></script>
<link rel='stylesheet' href='https://www.planyo.com/Plugins/PlanyoFiles/bootstrap-planyo.min.css' type='text/css' />

<link rel='stylesheet' href='https://www.planyo.com/schemes/?calendar=61399&sel=scheme_css' type='text/css' />
<style type='text/css'>
#planyo_price_preview_formPST35834 label {display:block;float:none;width:100%}
form#planyo_price_preview_formPST35834 li.planyo_static_help {margin-left:0px;}
</style>
<form id='planyo_price_preview_formPST35834' name='search_form' class='planyo   form-inline' action='https://goholboxtransfers.com/booking/' role='form' method='get'><input type='hidden' value="61399" id='calendar' name='calendar' /><input type='hidden' value="1" id='submitted' name='submitted' /><input type='hidden' value="https://goholboxtransfers.com/booking/" id='feedback_url' name='feedback_url' />  <div style='position:absolute;visibility:hidden;z-index:5000;' class='picker_dropdown ' id='one_datePST35834cal' onmousedown='var e=arguments[0] || window.event;e.stopPropagation();' onclick='var e=arguments[0] || window.event;e.stopPropagation();' ></div>
        <script type='text/javascript'>
              js_set_event(document.getElementById('one_datePST35834cal'), 'click', 'js_dummy',false);
                      document.first_weekday=1;
        </script>
      <script type='text/javascript'>
            document.new_scheme=1;
      document.s_prev = "previous";
document.s_next = "next";
document.s_today = "today";
document.s_day = "day";
document.s_days = "days";
document.s_week = "week";
document.s_weeks = "weeks";
document.s_weekday = "weekday";
document.s_month = "month";
document.s_single_res = "single resource";
document.s_weekdays_short = eval('[\"M\", \"T\", \"W\", \"T\", \"F\", \"S\", \"S\"]');
document.s_weekdays_med = eval('[\"Mon\", \"Tue\", \"Wed\", \"Thu\", \"Fri\", \"Sat\", \"Sun\"]');
document.s_weekdays_long = ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"];
document.s_months_short = eval('[\"Jan\", \"Feb\", \"Mar\", \"Apr\", \"May\", \"Jun\", \"Jul\", \"Aug\", \"Sep\", \"Oct\", \"Nov\", \"Dec\"]');
document.s_months_long = eval('[\"January\", \"February\", \"March\", \"April\", \"May\", \"June\", \"July\", \"August\", \"September\", \"October\", \"November\", \"December\"]');
document.s_all = "All";
document.s_showall = "Show all";
document.s_areav = "are available.";
document.s_clickres = "Click to make reservation.";
document.s_partav = "Available for part-day rental only. Click on the date above for details.";
document.s_outof = "out of";
document.s_unav = "Unavailable";
document.s_noav = "Unavailable";
document.s_show_more = "show more";
document.s_av = "Available";
document.s_vacation = "Vacations";
document.s_allday = "All day";
document.s_day_view = "show day";
document.s_month_view = "show month";
document.s_more = "more";
    if (!document.date_format) document.date_format = "d F Y";

js_set_event(document, 'mousedown', 'js_close_calendar',false);

    </script>
  <div class='form-group planyo-form-item-group datefld  single-col' id='row_one_datePST35834'><label class='control-label'>Date<em>*</em></label><div class='input-group '><input class='with-status-border form-control'  type='text' id='one_datePST35834' name='one_datePST35834'  autocomplete='off'  value="" onchange="planyo_show_price_preview(35834)" onfocus="js_close_calendar();planyo_price_prev_context(214867);js_show_calendar('one_datePST35834','planyo_show_price_preview(35834)');" onmousedown="var e=arguments[0] || window.event;e.stopPropagation();" onclick="var e=arguments[0] || window.event;e.stopPropagation();"  /><span class='input-group-addon input-group-append' onclick="js_close_calendar();planyo_price_prev_context(214867);js_show_calendar('one_datePST35834','planyo_show_price_preview(35834)');"><span class='input-group-text'> <a class='planyo-cal-icon' target='_self' onclick="planyo_price_prev_context(214867);js_show_calendar('one_datePST35834','planyo_show_price_preview(35834)');" id="one_datePST35834calref">&#160;</a></span></span></div></div><div class='form-group planyo-form-item-group   single-col' id='row_start_time'><label class='control-label'>Pick Up Time</label><select class='with-status-border form-control' name='start_time' id='start_time'  onchange="planyo_show_price_preview(35834)" >
<option selected='selected' value="4" >04:00&nbsp;</option>
<option  value="4.5" >04:30&nbsp;</option>
<option  value="5" >05:00&nbsp;</option>
<option  value="5.5" >05:30&nbsp;</option>
<option  value="6" >06:00&nbsp;</option>
<option  value="6.5" >06:30&nbsp;</option>
<option  value="7" >07:00&nbsp;</option>
<option  value="7.5" >07:30&nbsp;</option>
<option  value="8" >08:00&nbsp;</option>
<option  value="8.5" >08:30&nbsp;</option>
<option  value="9" >09:00&nbsp;</option>
<option  value="9.5" >09:30&nbsp;</option>
<option  value="10" >10:00&nbsp;</option>
<option  value="10.5" >10:30&nbsp;</option>
<option  value="11" >11:00&nbsp;</option>
<option  value="11.5" >11:30&nbsp;</option>
<option  value="12" >12:00&nbsp;</option>
<option  value="12.5" >12:30&nbsp;</option>
<option  value="13" >13:00&nbsp;</option>
<option  value="13.5" >13:30&nbsp;</option>
<option  value="14" >14:00&nbsp;</option>
<option  value="14.5" >14:30&nbsp;</option>
<option  value="15" >15:00&nbsp;</option>
<option  value="15.5" >15:30&nbsp;</option>
<option  value="16" >16:00&nbsp;</option>
<option  value="16.5" >16:30&nbsp;</option>
<option  value="17" >17:00&nbsp;</option>
<option  value="17.5" >17:30&nbsp;</option>
<option  value="18" >18:00&nbsp;</option>
<option  value="18.5" >18:30&nbsp;</option>
<option  value="19" >19:00&nbsp;</option>
<option  value="19.5" >19:30&nbsp;</option>
<option  value="20" >20:00&nbsp;</option>
<option  value="20.5" >20:30&nbsp;</option>
<option  value="21" >21:00&nbsp;</option>
<option  value="21.5" >21:30&nbsp;</option>
<option  value="22" >22:00&nbsp;</option>
<option  value="22.5" >22:30&nbsp;</option>
<option  value="23" >23:00&nbsp;</option>
<option  value="23.5" >23:30&nbsp;</option>
<option  value="24" >24:00&nbsp;</option>
</select>
</div><input type='hidden' value="2" id='rental_time_value' name='rental_time_value' /><div class='form-group planyo-form-item-group   single-col' id='row_rental_prop_From'><label class='control-label'>From</label><select class='with-status-border form-control' name='rental_prop_From' id='rental_prop_From'  onchange="planyo_show_price_preview(35834)" >
<option value='none'>---</option>
<option  value="Holbox Ferry (Chiquila)" >Holbox Ferry (Chiquila)&nbsp;</option>
<option  value="Akumal" >Akumal&nbsp;</option>
<option  value="Cancun" >Cancun&nbsp;</option>
<option  value="Cancun Airport" >Cancun Airport&nbsp;</option>
<option  value="El Cuyo" > El Cuyo&nbsp;</option>
<option  value="Playa Del Carmen/Ferry Cozumel/Mayacoba" >Playa Del Carmen/Ferry Cozumel/Mayacoba&nbsp;</option>
<option  value="Ferry Isla Mujeres" > Ferry Isla Mujeres&nbsp;</option>
<option  value="Costa Mujeres/Punta Sam" >Costa Mujeres/Punta Sam&nbsp;</option>
<option  value="Isla Blanca" >Isla Blanca&nbsp;</option>
<option  value="Puerto Morelos" >Puerto Morelos&nbsp;</option>
<option  value="Tulum" >Tulum&nbsp;</option>
</select>
</div><div class='form-group planyo-form-item-group   single-col' id='row_rental_prop_To'><label class='control-label'>To</label><select class='with-status-border form-control' name='rental_prop_To' id='rental_prop_To'  onchange="planyo_show_price_preview(35834)" >
<option value='none'>---</option>
<option  value="Akumal" >Akumal&nbsp;</option>
<option  value="Cancun" >Cancun&nbsp;</option>
<option  value="Cancun Airport" >Cancun Airport&nbsp;</option>
<option  value="El Cuyo" >El Cuyo&nbsp;</option>
<option  value="Playa del Carmen/Ferry Cozumel/Mayacoba" >Playa del Carmen/Ferry Cozumel/Mayacoba&nbsp;</option>
<option  value="Ferry Isla Mujeres" >Ferry Isla Mujeres&nbsp;</option>
<option  value="Costa Mujeres/Punta Sam" >Costa Mujeres/Punta Sam&nbsp;</option>
<option  value="Isla Blanca" >Isla Blanca&nbsp;</option>
<option  value="Puerto Morelos" >Puerto Morelos&nbsp;</option>
<option  value="Tulum" >Tulum&nbsp;</option>
<option  value="Holbox Ferry (Chiquila)" >Holbox Ferry (Chiquila)&nbsp;</option>
</select>
</div><div class='form-group planyo-form-item-group   single-col' id='row_rental_prop_persons'><label class='control-label'>Number of persons</label><select class='with-status-border form-control' name='rental_prop_persons' id='rental_prop_persons'  onchange="planyo_show_price_preview(35834)" >
<option value='none'>---</option>
<option  value="1" >1&nbsp;</option>
<option  value="2" >2&nbsp;</option>
<option  value="3" >3&nbsp;</option>
<option  value="4" >4&nbsp;</option>
<option  value="5" >5&nbsp;</option>
</select>
</div><input type='hidden' value="15" id='granulation' name='granulation' /><input type='hidden' value="fetch_price" id='mode' name='mode' /><input type='hidden' value="1" id='include_reserve_button' name='include_reserve_button' /><input type='hidden' value="1" id='html_mode' name='html_mode' /><input type='hidden' value="214867" id='resource_id' name='resource_id' /><input type='hidden' value="EN" id='custom-language' name='custom-language' /><div id='res_form_buttons' >
</div>
<input type='hidden' value='true' id='submitted_field' name='submitted' /><input type='hidden' name='form_sec' value='3029fa00cb8b69afcd38042cd40b8d371bbd11e4c1d12864a4d988fc601be548' /></form>
</div>

<div id='planyo_price_preview_parentPST35834'>
<div id='planyo_price_previewPST35834'></div>
</div>
<script type='text/javascript' src='https://www.planyo.com/Plugins/PlanyoFiles/jquery-3.6.4.min.js'></script>
<script type='text/javascript'>
window.planyo_resource_id=214867;
document.picker_preview_sync_priceprev=1;
</script>
<script type='text/javascript' src='https://www.planyo.com/Plugins/PlanyoFiles/price-preview.js'></script>
<iframe name='ppemb214867' style='display:none' width='10' height='10' src='https://www.planyo.com/embed-calendar.php?resource_id=214867&calendar=61399'></iframe>

            </template>

        </div>
    </div>
</section>

<?php
}
?>
