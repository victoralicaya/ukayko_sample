<div id="wishlist"> <!-- begin wishlist id for styling -->
	
<div class="page-title mb-4">
		<h1><?php echo HEADING_TITLE . UN_LABEL_DELIMITER . $wishlist->fields['name']; ?></h1>
</div>
	<div class="alert alert-info alert-dismissable">
		<button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo TEXT_DESCRIPTION; ?>
	</div>
	<?php 
    if ( $messageStack->size('wishlist') > 0 ) { 
        echo $messageStack->output('wishlist'); 
    }
    ?>
	<div class="card card--padding">
		<div class="card-body">
		<ul class="simple-list">
			<li>
            	<a href="<?php echo zen_href_link(UN_FILENAME_WISHLIST_EMAIL, 'wid='.$id, 'SSL'); ?>">
					<?php echo UN_TEXT_EMAIL_WISHLIST; ?>
              	</a>
           	</li>
			<li><a href="<?php echo zen_href_link(UN_FILENAME_WISHLIST_FIND, '', 'SSL'); ?>">
					<?php echo UN_TEXT_FIND_WISHLIST; ?>
              	</a>
           	</li>
			<li>
            	<a href="<?php echo zen_href_link(UN_FILENAME_WISHLISTS, '', 'SSL'); ?>">
					<?php echo UN_TEXT_MANAGE_WISHLISTS; ?>
                </a>
          	</li>
			<?php if ( UN_ALLOW_MULTIPLE_WISHLISTS===true ) { ?>
			<li>
            	<a href="<?php echo zen_href_link(UN_FILENAME_WISHLIST_MOVE, 'wid='.$id, 'SSL'); ?>">
					<?php echo UN_TEXT_WISHLIST_MOVE; ?>
               	</a>
          	</li>
			<?php } ?>
		</ul>
		</div>
	</div>
    <!-- control -->
    <?php echo zen_draw_form('control', zen_href_link(UN_FILENAME_WISHLIST, '', 'SSL'), 'get', 'class="control"'); ?>
    <?php echo zen_hide_session_id(); ?>
    <?php echo zen_draw_hidden_field('main_page', UN_FILENAME_WISHLIST); ?>
    <?php echo zen_draw_hidden_field('wid', $id); ?>
	<div class="sorter filter-row">
		<div class="d-flex gap-2">
			<div class="multiple">
				<label class="select-label d-none d-lg-inline" for="sort"><?php echo UN_TEXT_SORT . UN_LABEL_DELIMITER; ?></label>
				<div class="select-wrapper-sm d-lg-inline-block">
					<?php echo zen_draw_pull_down_menu('sort', $aSortOptions, (isset($_GET['sort']) ? $_GET['sort'] : ''), 'class="m" onchange="this.form.submit()"'); ?>
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

			<div class="multiple">
				<label class="select-label d-none d-lg-inline" for="layout"><?php echo UN_TEXT_VIEW . UN_LABEL_DELIMITER; ?></label>
				<div class="select-wrapper-sm d-lg-inline-block">
					<?php 
						echo un_draw_view_pull_down_menu('layout', '', (isset($_GET['layout']) ? $_GET['layout'] : ''), 'class="m" onchange="this.form.submit()"');
					?>
				</div>
			</div>
		</div>
		<div class="clearleft"></div>
	</div>
    </form>
    <!-- control -->
 
	<?php echo zen_draw_form('wishlist', zen_href_link(UN_FILENAME_WISHLIST, zen_get_all_get_params(array('action'), 'SSL') . 'action=un_update_wishlist')); ?>
	<?php echo zen_hide_session_id(); ?>
	<?php echo zen_draw_hidden_field('layout', isset($_REQUEST['layout'])? $_REQUEST['layout']: ''); ?>

	<div class="table-responsive table-container mt-3">
	<!-- product listing -->
        <table cellspacing="0" class="productlist table table-bordered table-striped">
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
                <input type="hidden" name="wishlist_quantity[]" value="<?php echo $products->fields['quantity']; ?>" />
                <input type="hidden" name="comment[]" value="<?php echo $products->fields['comment']; ?>" />  
                <?php echo $oWishlist->getTableRow($tdclass, $products); ?>
            </tr>
                <?php $rows++; ?>
                <?php $products->MoveNext(); ?>
            <?php } // end while products ?>
        
            <?php } else { ?>
            <tr><td colspan="99"><?php echo UN_TEXT_NO_PRODUCTS; ?></td></tr>
            <?php } ?>
        </table>
	<!-- end product listing -->
	</div>
	<?php if ($listing_split->number_of_rows > 0) {	?>
        <div class="buttons mb-20">
        <?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?>
        <?php echo zen_image_submit(UN_BUTTON_IMAGE_SAVE, UN_BUTTON_SAVE_ALT); ?></div>
    <?php } ?>

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

</div> <!-- end (un) id for styling -->