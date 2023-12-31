<?php
/**
 * Page Template
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: DrByte 2020 Jul 10 Modified in v1.5.8-alpha $
 */
?>
<div class="centerColumn" id="gvRedeemDefault">
<div class="page-title mb-4">
<h1 id="gvRedeemDefaultHeading"><?php echo HEADING_TITLE; ?></h1>
</div>

<div id="gvRedeemDefaultMessage" class="card card--padding"><?php echo sprintf($message, $_GET['gv_no']); ?></div>

<div id="gvRedeemDefaultMainContent" class="card card--padding"><?php echo TEXT_INFORMATION; ?></div>

<div class="buttonRow forward"><?php echo '<a href="' . ($_GET['goback'] == 'true' ? zen_href_link(FILENAME_GV_FAQ) : zen_href_link(FILENAME_DEFAULT)) . '">' . zen_image_button(BUTTON_IMAGE_CONTINUE, BUTTON_CONTINUE_ALT) . '</a>'; ?></div>

</div>