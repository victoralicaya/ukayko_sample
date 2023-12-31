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
<div class="centerColumn" id="passwordForgotten">
	<div class="page-title mb-4">
		<h1 id="passwordforgotten_heading" class="tt-title noborder text-left"> <?php echo HEADING_TITLE; ?> </h1>
	</div>
    <?php if ($messageStack->size('password_forgotten') > 0) echo $messageStack->output('password_forgotten'); ?>
		<?php echo zen_draw_form('password_forgotten', zen_href_link(FILENAME_PASSWORD_FORGOTTEN, 'action=process', 'SSL')); ?>
        <div id="passwordForgottenMainContent" class="alert alert-info alert-dismissable"><?php echo TEXT_MAIN; ?></div>
		<div class="alert-text forward"><?php echo FORM_REQUIRED_INFORMATION; ?></div>
		<label for="email-address">
			<?php echo ENTRY_EMAIL_ADDRESS . (zen_not_null(ENTRY_EMAIL_ADDRESS_TEXT) ? '<span class="alert-text">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>': '' ); ?>
        </label>
		<?php echo zen_draw_input_field('email_address', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_email_address', '40') . ' id="email-address" autocomplete="username" placeholder="' . ENTRY_EMAIL_ADDRESS_TEXT . '" required', 'email'); ?>
		<br class="clearBoth" />
		<div class="buttonRows d-flex gap-2 mt-4">
			<div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_SUBMIT, BUTTON_SUBMIT_ALT); ?></div> 
			<div class="buttonRow back"><?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>
		</div>
</form>
</div>