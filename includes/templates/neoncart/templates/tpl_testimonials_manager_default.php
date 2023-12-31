<?php
/**
 * Testimonials Manager
 *
 * @package Template System
 * @copyright 2007 Clyde Jones
  * @copyright Portions Copyright 2003-2007 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: Testimonials_Manager.php v1.5.4
 */ 
?>
<div class="centerColumn" id="testimonialDefault">

   <?php
      $testimonial_info = '';
      if ( (!empty($page_check->fields['testimonials_city'])) and (!empty($page_check->fields['testimonials_country'])) ) {
      $testimonial_info .= NAME_SEPARATOR . $page_check->fields['testimonials_city'] . CITY_STATE_SEPARATOR . $page_check->fields['testimonials_country'];
      }
      if ( (!empty($page_check->fields['testimonials_city'])) and (empty($page_check->fields['testimonials_country'])) ) {
      $testimonial_info .= NAME_SEPARATOR . $page_check->fields['testimonials_city'];
      }
      if ( (empty($page_check->fields['testimonials_city'])) and (!empty($page_check->fields['testimonials_country'])) ) {
      $testimonial_info .= NAME_SEPARATOR . $page_check->fields['testimonials_country'];
      }
      if (!empty($page_check->fields['testimonials_company'])) {
      $testimonial_info .= NAME_SEPARATOR . $page_check->fields['testimonials_company'];
      }
      ?>
   <div class="tt-post-single">
		<h1 class="tt-title"><?php echo $page_check->fields['testimonials_title']; ?></h1>
		<div class="tt-autor">
			<?php echo TESTIMONIALS_BY; ?><strong><?php echo $page_check->fields['testimonials_name']; ?></strong>
            <?php echo $testimonial_info; ?>
            <?php if (DISPLAY_TESTIMONIALS_DATE_PUBLISHED == 'true') { echo zen_date_long($date_published); } ?>
		</div>
		<div class="tt-post-content">
			<?php $testimonials_image = zen_image(DIR_WS_IMAGES . $page_check->fields['testimonials_image'], $page_check->fields['testimonials_title'], TESTIMONIAL_IMAGE_WIDTH, TESTIMONIAL_IMAGE_HEIGHT);?>
			<?php if ( !empty( $testimonials_image ) ) { ?>
			<div class="tt-post-img testimonialImage">
				<?php if (($page_check->fields['testimonials_url']) == ('http://') or ($page_check->fields['testimonials_url']) == ('')) {
					  echo $testimonials_image;
				   }
				   else
				   {
					  echo '<a href="' . $page_check->fields['testimonials_url'] . '" target="_blank">' . $testimonials_image . '</a>';
				   }
				?>
			</div>
			<?php } ?>
			<p><?php echo nl2br($page_check->fields['testimonials_html_text']); ?></p>
		</div>
   </div>
   <div class="testimonial-links buttonsRow mt-3">
      <div class="buttonRow back">
         <?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?>
      </div>
      <div class="buttonRow forward">
         <a href="<?php echo zen_href_link(FILENAME_TESTIMONIALS_MANAGER_ALL, '', 'SSL'); ?>"><?php echo zen_image_button(BUTTON_IMAGE_VIEW_TESTIMONIALS, BUTTON_VIEW_TESTIMONIALS_ALT); ?></a>
      </div>
      <div class="buttonRow forward">
            <a href="<?php echo zen_href_link(FILENAME_TESTIMONIALS_ADD, '', 'SSL'); ?>"><?php echo zen_image_button(BUTTON_IMAGE_TESTIMONIALS, BUTTON_TESTIMONIALS_ADD_ALT); ?></a>
      </div>
   </div>
</div>