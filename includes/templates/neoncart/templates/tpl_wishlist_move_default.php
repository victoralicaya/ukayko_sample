<div id="wishlist"> <!-- begin wishlist id for styling -->
	<h1 class="tt-title noborder text-left"><?php echo HEADING_TITLE; ?></h1>
	<div class="alert alert-info alert-dismissable">
		<button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo TEXT_DESCRIPTION; ?>
  	</div>

	<?php 
    if ( $messageStack->size('wishlist_move') > 0 ) { 
        echo $messageStack->output('wishlist_move'); 
    }
    ?>

	<?php if ( UN_ALLOW_MULTIPLE_WISHLISTS===true ) { ?>
    <div class="tt-card-box">
        <ul class="tt-list-dot">
            <li>
                <a href="<?php echo zen_href_link(UN_FILENAME_WISHLIST_EDIT, 'op=add', 'SSL'); ?>">
                    <?php echo UN_TEXT_NEW_WISHLIST; ?>
                </a>
            </li>
            <li>
                <a href="<?php echo zen_href_link(UN_FILENAME_WISHLISTS, '', 'SSL'); ?>">
                    <?php echo UN_TEXT_MANAGE_WISHLISTS; ?>
                </a>
            </li>
        </ul>
	</div>
	<?php } ?>

    <!-- control -->
    <?php echo zen_draw_form('control', zen_href_link(UN_FILENAME_WISHLIST_MOVE, '', 'SSL'), 'get', 'class="control"'); ?>
    <?php echo zen_hide_session_id(); ?>
    <?php echo zen_draw_hidden_field('main_page', UN_FILENAME_WISHLIST_MOVE); ?>
    <?php echo zen_draw_hidden_field('wid', $id); ?>
    
	<div class="sorter filter-row">
		<div class="d-flex gap-2">
			<div class="multiple">
				<label class="select-label d-none d-lg-inline" for="sort"><?php echo UN_TEXT_SORT . UN_LABEL_DELIMITER; ?></label>
				<div class="select-wrapper-sm d-lg-inline-block">
					<?php 
						echo zen_draw_pull_down_menu('sort', $aSortOptions, (isset($_GET['sort']) ? $_GET['sort'] : ''), 'class="m" onchange="this.form.submit()"');
					?>
				</div>
			</div>
			<?php if ( UN_DISPLAY_CATEGORY_FILTER===true ) { ?>
			<div class="multiple">
				<label class="select-label d-none d-lg-inline" for="cPath"><?php echo UN_TEXT_SHOW . UN_LABEL_DELIMITER; ?></label>
				<div class="select-wrapper-sm d-lg-inline-block">
					<?php
					echo un_draw_categories_pull_down_menu('cPath', UN_TEXT_ALL_CATEGORIES, (isset($_GET['cPath']) ? $_GET['cPath'] : ''), 'class="m" onchange="this.form.submit()"');
					?>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
	</form>
    
	<!-- control -->
	<?php echo zen_draw_form('wishlist_move', zen_href_link(UN_FILENAME_WISHLIST_MOVE, '', 'SSL')); ?>
	<?php echo zen_hide_session_id(); ?>
    <?php echo zen_draw_hidden_field('meta-process', 1); ?>
    <?php echo zen_draw_hidden_field('wid', $id); ?>
	<div class="sorter filter-row mb-3">
		<div class="d-flex gap-2">
			<div class="single">
				<label class="select-label d-none d-lg-inline" for="wishlists_id"><?php echo LABEL_MOVETO . UN_LABEL_DELIMITER; ?></label>
				<div class="select-wrapper-sm d-lg-inline-block">
					<?php
						echo $oWishlist->getWishlistMenu('wishlists_id', (isset($_REQUEST['wid']) ? $_REQUEST['wid'] : ''), '');
					?>
				</div>
			</div>
			<?php echo zen_image_submit(BUTTON_IMAGE_SUBMIT, BUTTON_SUBMIT_ALT); ?>
		</div>
		
	</div>
    <div class="table-responsive table-container mt-3">
	<!-- product listing -->
        <table cellspacing="0" class="move-productlist table table-bordered table-striped">
            <tr class="heading">
                <?php echo $oWishlist->getTableHeader(); ?>
            </tr>
            <?php 
            if ($listing_split->number_of_rows > 0) {
                $rows = 0;
                $products = $db->Execute($listing_split->sql_query);
                while (!$products->EOF) {
                    if ( $rows & 1 ) {
                        $tdclass = 'even';
                    } else {
                        $tdclass = 'odd';
                    }
            ?>
            <tr>
                <input type="hidden" name="products_id[]" value="<?php echo $products->fields['products_id']; ?>" />
                <?php echo $oWishlist->getTableRow($tdclass, $products); ?>
            </tr>
                <?php $rows++; ?>
                <?php $products->MoveNext(); ?>
                <?php } // end while products ?>
            <?php } else { ?>
            <tr><td colspan="99"><?php echo UN_TEXT_NO_PRODUCTS; ?></td></tr>
            <?php } ?>
        </table>
   	</div>
	<!-- end product listing -->
	</form>
	<?php if (($listing_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) { ?>
	<div class="pagi-bot">
		<div class="prod-list-wrap group">
			<div class="navSplitPagesResult back"><?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></div>
			<div class="navSplitPagesLinks forward">
				<ul class="pagination"><?php echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y')), $paginateAsUL); ?></ul>
			</div>
		</div>
	</div>
	<?php } // end paging bottom ?>

	<div class="buttons">
		<?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?>
	</div>
</div> <!-- end (un) id for styling -->