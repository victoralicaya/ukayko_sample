<?php
/**
 * Module Template
 *
 * Allows entry of new addresses during checkout stages
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: DrByte 2021 Jun 14 Modified in v1.5.8-alpha $
 */
?>
<div class="tt-card-box" id="checkoutNewAddress">
  <fieldset>
    <h4 class="tt-title"><?php echo TITLE_PLEASE_SELECT; ?></h4>
    <div class="alert-text forward"><?php echo FORM_REQUIRED_INFORMATION; ?></div>
    <?php
      if (ACCOUNT_GENDER == 'true') {
    ?>
      <?php echo zen_draw_radio_field('gender', 'm', '', 'id="gender-male"') . '<label class="radioButtonLabel" for="gender-male">' . MALE . '</label>' .   zen_draw_radio_field('gender', 'f', '', 'id="gender-female" ') . '<label class="radioButtonLabel" for="gender-female">' . FEMALE . '</label>' . (!empty(ENTRY_GENDER_TEXT) ? '<span class="alert alert-text">' . ENTRY_GENDER_TEXT . '</span>': ''); ?>
      <br class="clearBoth" />
    <?php
      }
    ?>
    <label class="inputLabel" for="firstname"><?php echo ENTRY_FIRST_NAME; ?><?php echo (zen_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="alert-text">' . ENTRY_FIRST_NAME_TEXT . '</span>': '');?></label>
    <?php echo zen_draw_input_field('firstname', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_firstname', '40') . ' id="firstname" placeholder="' . ENTRY_FIRST_NAME_TEXT . '"' . ((int)ENTRY_FIRST_NAME_MIN_LENGTH > 0 ? ' required' : '')); ?>
    <br class="clearBoth" />

    <label class="inputLabel" for="lastname"><?php echo ENTRY_LAST_NAME; ?><?php echo (zen_not_null(ENTRY_LAST_NAME_TEXT) ? '<span class="alert-text">' . ENTRY_LAST_NAME_TEXT . '</span>': '');?></label>
    <?php echo zen_draw_input_field('lastname', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_lastname', '40') . ' id="lastname" placeholder="' . ENTRY_LAST_NAME_TEXT . '"' . ((int)ENTRY_LAST_NAME_MIN_LENGTH > 0 ? ' required' : '')); ?>
    <br class="clearBoth" />

    <?php
      if (ACCOUNT_COMPANY == 'true') {
    ?>
    <label class="inputLabel" for="company"><?php echo ENTRY_COMPANY; ?><?php echo (zen_not_null(ENTRY_COMPANY_TEXT) ? '<span class="alert-text">' . ENTRY_COMPANY_TEXT . '</span>': '');?></label>
    <?php echo zen_draw_input_field('company', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_company', '40') . ' id="company" autocomplete="organization" placeholder="' . ENTRY_COMPANY_TEXT . '"' . (ACCOUNT_COMPANY == 'true' && (int)ENTRY_COMPANY_MIN_LENGTH != 0 ? ' required' : '')); ?>
    <br class="clearBoth" />
    <?php
      }
    ?>

    <label class="inputLabel" for="street-address"><?php echo ENTRY_STREET_ADDRESS; ?><?php echo (zen_not_null(ENTRY_STREET_ADDRESS_TEXT) ? '<span class="alert-text">' . ENTRY_STREET_ADDRESS_TEXT . '</span>': '');?></label>
      <?php echo zen_draw_input_field('street_address', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_street_address', '40') . ' id="street-address" placeholder="' . ENTRY_STREET_ADDRESS_TEXT . '"' . ((int)ENTRY_STREET_ADDRESS_MIN_LENGTH > 0 ? ' required' : '')); ?>
    <br class="clearBoth" />

    <?php
      if (ACCOUNT_SUBURB == 'true') {
    ?>
    <label class="inputLabel" for="suburb"><?php echo ENTRY_SUBURB; ?><?php echo (zen_not_null(ENTRY_SUBURB_TEXT) ? '<span class="alert-text">' . ENTRY_SUBURB_TEXT . '</span>': '');?></label>
    <?php echo zen_draw_input_field('suburb', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_suburb', '40') . ' id="suburb" autocomplete="address-line2" placeholder="' . ENTRY_SUBURB_TEXT . '"'); ?>
    <br class="clearBoth" />
    <?php
      }
    ?>

    <label class="inputLabel" for="city"><?php echo ENTRY_CITY; ?><?php echo (zen_not_null(ENTRY_CITY_TEXT) ? '<span class="alert-text">' . ENTRY_CITY_TEXT . '</span>': '');?></label>
    <?php echo zen_draw_input_field('city', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_city', '40') . ' id="city" placeholder="' . ENTRY_CITY_TEXT . '"'. ((int)ENTRY_CITY_MIN_LENGTH > 0 ? ' required' : '')); ?>
    <br class="clearBoth" />

    <?php
      if (ACCOUNT_STATE == 'true') {
        if ($flag_show_pulldown_states == true) {
    ?>
    <label class="inputLabel" for="stateZone" id="zoneLabel"><?php echo ENTRY_STATE; ?><?php echo zen_not_null(ENTRY_STATE_TEXT) ? '<span class="alert-text">' . ENTRY_STATE_TEXT . '</span>': ''; ?></label>
    <?php
          echo zen_draw_pull_down_menu('zone_id', zen_prepare_country_zones_pull_down($selected_country), $zone_id, 'id="stateZone"');
          /*if (zen_not_null(ENTRY_STATE_TEXT)) echo '&nbsp;<span class="alert">' . ENTRY_STATE_TEXT . '</span>'; */
        }
    ?>

    <?php if ($flag_show_pulldown_states == true) { ?>
    <br class="clearBoth" id="stBreak" />
    <?php } ?>
    <label class="inputLabel" for="state" id="stateLabel"><?php echo $state_field_label; ?></label>
    <?php
        echo zen_draw_input_field('state', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_state', '40') . ' id="state" placeholder="' . ENTRY_STATE_TEXT . '"');

        if ($flag_show_pulldown_states == false) {
          echo zen_draw_hidden_field('zone_id', $zone_name, ' ');
        }
    ?>
    <br class="clearBoth" />
    <?php
      }
    ?>

    <label class="inputLabel" for="postcode"><?php echo ENTRY_POST_CODE; ?><?php echo (zen_not_null(ENTRY_POST_CODE_TEXT) ? '<span class="alert-text">' . ENTRY_POST_CODE_TEXT . '</span>': '');?></label>
    <?php echo zen_draw_input_field('postcode', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_postcode', '40') . ' id="postcode" placeholder="' . ENTRY_POST_CODE_TEXT . '"' . ((int)ENTRY_POSTCODE_MIN_LENGTH > 0 ? ' required' : '')); ?>
    <br class="clearBoth" />

    <label class="inputLabel" for="country"><?php echo ENTRY_COUNTRY; ?><?php echo (zen_not_null(ENTRY_COUNTRY_TEXT) ? '<span class="alert-text">' . ENTRY_COUNTRY_TEXT . '</span>': '');?></label>
    <?php echo zen_get_country_list('zone_country_id', $selected_country, 'id="country" placeholder="' . ENTRY_COUNTRY_TEXT . '"' . ($flag_show_pulldown_states == true ? ' onchange="update_zone(this.form);"' : '')); ?>
    <br class="clearBoth" />
    <div class="buttonRow forward text-end"><?php echo zen_draw_hidden_field('action', 'submit') . zen_image_submit(BUTTON_IMAGE_CONTINUE, BUTTON_CONTINUE_ALT); ?></div>
  </fieldset>
</div>
