<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=conditions.<br />
 * Loaded automatically by index.php?main_page=conditions.
 * Displays conditions page.
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: DrByte 2020 Dec 25 Modified in v1.5.8-alpha $
 */
?>
<div class="centerColumn" id="conditions">
	<div class="page-title mb-4">
		<h1 id="conditionsHeading"><?php echo HEADING_TITLE; ?></h1>
	</div>
	<?php if (DEFINE_CONDITIONS_STATUS >= 1 and DEFINE_CONDITIONS_STATUS <= 2) { ?>
	<div id="conditionsMainContent" class="content">
	<?php
	/**
	 * require the html_define for the conditions page
	 */
	  require($define_page);
	?>
	</div>
	<?php } ?>

	<div class="buttonRow back"><?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>
</div>
