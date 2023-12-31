<div id="wishlist"> <!-- begin wishlist id for styling -->
	<div class="page-title mb-4">
			<h1><?php echo TEXT_WISHLIST_FOR . '<b>'.$customers_name.'</b>'; ?></h1>
		</div>
    <!-- control -->
    <?php echo zen_draw_form('control', zen_href_link(UN_FILENAME_WISHLIST_FIND, '', 'SSL'), 'get', 'class="control"'); ?>
    <?php echo zen_hide_session_id(); ?>
    <?php echo zen_draw_hidden_field('main_page', UN_FILENAME_WISHLIST_FIND); ?>
    <?php echo zen_draw_hidden_field('wid', $wid); ?>
	
	<div class="sorter filter-row d-flex gap-2">
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

		<div class="multiple">
			<label class="select-label d-none d-lg-inline" for="layout"><?php echo UN_TEXT_VIEW . UN_LABEL_DELIMITER; ?></label>
			<div class="select-wrapper-sm d-lg-inline-block">
				<?php 
					echo un_draw_view_pull_down_menu('layout', '', (isset($_GET['layout']) ? $_GET['layout'] : ''), 'class="m" onchange="this.form.submit()"');
				?>
			</div>
		</div>
     </div>
     </form>
		<!-- control -->

	<?php echo zen_draw_form('wishlist', zen_href_link(UN_FILENAME_WISHLIST_FIND, zen_get_all_get_params(array('action')) . 'action=multiple_products_add_product', 'SSL')); ?>
     <?php echo zen_hide_session_id(); ?>
     <?php echo zen_draw_hidden_field('layout', isset($_REQUEST['layout'])? $_REQUEST['layout']: ''); ?>
     <?php echo zen_draw_hidden_field('wid', $wid); ?>

	<!-- product listing -->
        <div class="table-responsive table-container mt-3">
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

		<?php if ($listing_split->number_of_rows > 0 && (UN_ALLOW_MULTIPLE_PRODUCTS_CART_COMPACT) ) {	?>
            <div class="buttons">
				<?php echo zen_image_submit(BUTTON_IMAGE_IN_CART, BUTTON_IN_CART_ALT); ?>
           	</div>
        <?php } ?>
		</form>

		<?php if (($listing_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) { ?>
			<div class="pagi-bot">
				<div class="prod-list-wrap group">
					<div class="navSplitPagesResult back">
						<?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?>
					</div>
					<div class="navSplitPagesLinks forward">
						<ul class="pagination">
							<?php echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y')), $paginateAsUL); ?>
						</ul>
					</div>
				</div>
			</div>
		<?php } // end paging bottom ?>
        <div class="buttons">
	        <?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?>
        </div>
	</div> <!-- end (un) id for styling -->