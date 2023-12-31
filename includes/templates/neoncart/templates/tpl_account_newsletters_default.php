<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=account_newsletters.
 * Subscribe/Unsubscribe from General Newsletter
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: DrByte 2020 Dec 25 Modified in v1.5.8-alpha $
 */
?>
<div class="centerColumn" id="acctNewslettersDefault">
    <?php echo zen_draw_form('account_newsletter', zen_href_link(FILENAME_ACCOUNT_NEWSLETTERS, '', 'SSL')) . zen_draw_hidden_field('action', 'process'); ?>
    <h1 id="acctNewslettersDefaultHeading" class="tt-title noborder text-left"><?php echo HEADING_TITLE; ?></h1>
    <?php if ($messageStack->size('newsletter') > 0) echo $messageStack->output('newsletter'); ?>

    <div class="tt-card-box">
        <h4 class="tt-title"><?php echo MY_NEWSLETTERS_GENERAL_NEWSLETTER; ?></h4>
        <?php echo zen_draw_checkbox_field('newsletter_general', '1', (($newsletter->fields['customers_newsletter'] == '1') ? true : false), 'id="newsletter"'); ?>
        <label class="checkboxLabel" for="newsletter"><?php echo MY_NEWSLETTERS_GENERAL_NEWSLETTER_DESCRIPTION; ?></label>
    </div>
    <div class="buttonsRow">
        <div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_UPDATE, BUTTON_UPDATE_ALT); ?></div> 
        <div class="buttonRow back">
            <?php echo '<a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?>
        </div>
    </div>
    </form>
</div>