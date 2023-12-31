<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=create_account.
 * Displays Create Account form.
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: DrByte 2020 Dec 25 Modified in v1.5.8-alpha $
 */
?>
<div class="centerColumn container-indent tt-login-form" id="createAcctDefault">
    <h1 id="createAcctDefaultHeading" class="tt-title noborder text-left"><?php echo HEADING_TITLE; ?></h1>
    <?php echo zen_draw_form('createAccountForm', zen_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'), 'post', 'onsubmit="return check_form(createAccountForm);" id="createAccountForm"') . zen_draw_hidden_field('action', 'process') . zen_draw_hidden_field('email_pref_html', 'email_format'); ?>
    <h6 id="createAcctDefaultLoginLink" class="tt-title"><?php echo sprintf(TEXT_ORIGIN_LOGIN, zen_href_link(FILENAME_LOGIN, zen_get_all_get_params(['action']), 'SSL')); ?></h6>
    <fieldset class="form-default">
        <!--<legend><?php echo CATEGORY_PERSONAL; ?></legend>-->
        <?php require($template->get_template_dir('tpl_modules_create_account.php', DIR_WS_TEMPLATE, $current_page_base, 'templates') . '/tpl_modules_create_account.php'); ?>
    </fieldset>
	<div class="row">
		<div class="col-lg-12">
			<div class="form-group text-end mt-2">
				<div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_SUBMIT, BUTTON_SUBMIT_ALT, '', 'btn-border'); ?></div>
			</div>
		</div>
	</div>
    <?php echo '</form>'; ?>
</div>