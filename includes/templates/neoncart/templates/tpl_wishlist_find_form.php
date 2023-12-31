<div id="wishlist"> <!-- begin wishlist id for styling -->
	<h1 class="tt-title noborder text-left"><?php echo HEADING_TITLE; ?></h1>
    
	<div class="alert alert-info alert-dismissable">
		<button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo TEXT_DESCRIPTION; ?>
	</div>
	
    <?php if ( zen_not_null($message) ) { ?>
		<div class="alert alert-danger alert-dismissable">
			<button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button>
			<?php echo $message; ?>
       	</div>
	<?php } ?>

	<!-- search -->
	<?php echo zen_draw_form('wishlist_find', zen_href_link(UN_FILENAME_WISHLIST_FIND, '', 'SSL')); ?>
    <?php echo zen_hide_session_id(); ?>
    <?php echo zen_draw_hidden_field('meta-process', 1); ?>
	<div class="find-wishlist tt-card-box">
		<h4 class="tt-title"><?php echo LEGEND_HEADING_TITLE; ?></h4>
		<div class="group">
            <div class="formrow">
                <label class="block" for="firstname"><?php echo LEGEND_FORM_FIRSTNAME . UN_LABEL_DELIMITER; ?></label>
                <input type="text" name="firstname" class="l" value="<?php echo isset($_POST['firstname'])? $_POST['firstname'] : ''; ?>" />
            </div>
            <div class="formrow">
                <label class="block" for="lastname"><?php echo LEGEND_FORM_LASTNAME . UN_LABEL_DELIMITER; ?></label>
                <input type="text" name="lastname" class="l" value="<?php echo isset($_POST['lastname'])? $_POST['lastname'] : ''; ?>" />
            </div>
        
            <div class="formrow">
                <label class="block" for="email"><?php echo LEGEND_FORM_EMAIL . UN_LABEL_DELIMITER; ?></label>
                <input type="text" name="email" class="l" value="<?php echo isset($_POST['email'])? $_POST['email'] : ''; ?>" />
            </div>
        </div> <!-- end group -->
        <div class="buttons">
			<?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?>
			<?php echo zen_image_submit(BUTTON_IMAGE_SEARCH, BUTTON_SEARCH_ALT); ?>
		</div>
    </div>
	</form>
	<!-- search -->
	
	<?php if ( isset($records) && $records->RecordCount() > 1 ) { ?>
		<div class="wishlist-result">
			<?php $rows = 0; ?>
			<?php while (!$records->EOF) { ?>
				<?php $rows++; ?>
			<div class="tt-card-box">
            	<h4 class="tt-title><?php echo $rows; ?>. <a href="<?php echo zen_href_link(UN_FILENAME_WISHLIST_FIND, 'wid='.$records->fields['id'], 'SSL'); ?>"><?php echo un_get_fullname($records->fields['customers_firstname'], $records->fields['customers_lastname'], $records->fields['customers_email_address']) . FIND_RESULT_WISHLIST_OWNER; ?></a></h4>
				<ul class="tt-list-dot">
					<?php $location = un_get_citystate($records->fields['entry_city'], $records->fields['entry_state'], 'Unknown'); ?>
					<?php if ( !un_is_empty($location) ) { ?>
						<li><?php echo FIND_RESULT_LOCATION . UN_LABEL_DELIMITER; ?>&nbsp;<?php echo $location; ?></li>
					<?php } ?>
					<?php if ( !un_is_empty($records->fields['name']) ) { ?>
						<li><?php echo FIND_RESULT_LIST_NAME . UN_LABEL_DELIMITER; ?>&nbsp;<?php echo $records->fields['name']; ?></li>
					<?php } ?>
					<?php if ( !un_is_empty($records->fields['comment']) ) { ?>
						<li><?php echo FIND_RESULT_LIST_COMMENT . UN_LABEL_DELIMITER; ?>&nbsp;<?php echo $records->fields['comment']; ?></li>
					<?php } ?>
				</ul>
          	</div>
			<?php $records->MoveNext(); ?>
			<?php } // end while records ?>
        </div>
	<?php } // end if records > 1  ?>

</div> <!-- end (un) id for styling -->