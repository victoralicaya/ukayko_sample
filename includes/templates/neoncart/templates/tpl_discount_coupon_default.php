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
<div class="centerColumn" id="discountcouponInfo">
<div class="page-title mb-4">
<h1 id="discountcouponInfoHeading"><?php echo HEADING_TITLE; ?></h1>
</div>
<div id="discountcouponInfoMainContent" class="content card card--padding">
<?php if ((DEFINE_DISCOUNT_COUPON_STATUS >= 1 and DEFINE_DISCOUNT_COUPON_STATUS <= 2) && $text_coupon_help == '') {
  require($define_page);
 } else {
  echo $text_coupon_help;
} ?>
</div>

<?php echo zen_draw_form('discount_coupon', zen_href_link(FILENAME_DISCOUNT_COUPON, 'action=lookup', 'SSL', false)); ?>
<div class="card card--padding">
<fieldset>
<legend class="h4-style"><?php echo TEXT_DISCOUNT_COUPON_ID_INFO; ?></legend>
<label class="inputLabel" for="lookup-discount-coupon"><?php echo TEXT_DISCOUNT_COUPON_ID; ?></label>
<?php echo zen_draw_input_field('lookup_discount_coupon', (isset($_POST['lookup_discount_coupon'])) ? $_POST['lookup_discount_coupon'] : '', 'size="40" id="lookup-discount-coupon" autofocus', 'search');?>
</fieldset>
</div>

<?php if ($text_coupon_help == '') { ?>
<div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_SEND, BUTTON_LOOKUP_ALT); ?></div>
<?php } else { ?>
<div class="buttonRow forward"><?php echo '<a href="' . zen_href_link(FILENAME_DISCOUNT_COUPON) . '">' . zen_image_button(BUTTON_IMAGE_CANCEL, BUTTON_CANCEL_ALT) . '</a>&nbsp;&nbsp;' . zen_image_submit(BUTTON_IMAGE_SEND, BUTTON_LOOKUP_ALT); ?></div>
<?php } ?>
<div class="buttonRow back"><?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>
<br class="clearBoth" />
</form>
</div>
