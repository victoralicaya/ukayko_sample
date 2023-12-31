<?php
/**
 * Page Template
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: DrByte 2020 Dec 25 Modified in v1.5.8-alpha $
 */
?>
<div class="centerColumn" id="timeoutDefault">
<?php
    if (zen_is_logged_in()) {
?>
<div class="page-title mb-3">
<h1 id="timeoutDefaultHeading" class="tt-title noborder text-left"><?php echo HEADING_TITLE_LOGGED_IN; ?></h1>
</div>
<div id="timeoutDefaultContent" class="content"><?php echo TEXT_INFORMATION_LOGGED_IN; ?></div>
<?php
  } else {
?>
    <div class="page-title mb-3">
<h1 id="timeoutDefaultHeading" class="tt-title noborder text-left"><?php echo HEADING_TITLE; ?></h1>
    </div>
<div id="timeoutDefaultContent" class="content alert alert-info alert-dismissable"><?php echo TEXT_INFORMATION; ?></div>
<?php echo zen_draw_form('login', zen_href_link(FILENAME_LOGIN, 'action=process', 'SSL')); ?>
<fieldset>
<div class="tt-shopcart-box card card--padding">
<div class="card-body">
		<h4><?php echo HEADING_RETURNING_CUSTOMER; ?></h4>

<label class="inputLabel" for="login-email-address"><?php echo ENTRY_EMAIL_ADDRESS; ?></label>
<?php echo zen_draw_input_field('email_address', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_email_address', '40') . ' id="login-email-address" autocomplete="username"', 'email'); ?>
<br class="clearBoth">

<label class="inputLabel" for="login-password"><?php echo ENTRY_PASSWORD; ?></label>
<?php echo zen_draw_password_field('password', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_password', 40) . ' id="login-password" autocomplete="current-password"'); ?>
<br class="clearBoth">
<?php echo zen_draw_hidden_field('securityToken', $_SESSION['securityToken']); ?>
<div class="row">
<div class="col-auto mr-auto buttonRow forward">
<div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_LOGIN, BUTTON_LOGIN_ALT); ?></div>
</div>
<div class="col-auto align-self-end buttonRow back important">
<div class="buttonRow back important"><?php echo '<a href="' . zen_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL') . '">' . TEXT_PASSWORD_FORGOTTEN . '</a>'; ?></div>
</div>
</div>
</div>
</div>
</fieldset>



</form>
<br class="clearBoth">
<?php
 }
 ?>
</div>
