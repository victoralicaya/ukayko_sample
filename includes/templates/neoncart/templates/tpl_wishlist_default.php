<div id="wishlist"> <!-- begin wishlist id for styling -->
	<h1 class="tt-title noborder text-left"><?php echo HEADING_TITLE . UN_LABEL_DELIMITER . $wishlist->fields['name']; ?></h1>
	<div class="alert alert-info alert-dismissable">
		<button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php echo TEXT_DESCRIPTION; ?>
	</div>
	<?php 
		if ( $messageStack->size('wishlist') > 0 ) { 
			echo $messageStack->output('wishlist'); 
		}
	?>
	<div class="tt-card-box tt-card-bg">
        <ul class="tt-list-dot">
            <li>
            	<a href="<?php echo zen_href_link(UN_FILENAME_WISHLIST_EMAIL, 'wid='.$id, 'SSL'); ?>">
					<?php echo UN_TEXT_EMAIL_WISHLIST; ?>
               	</a>
           	</li>
            <li>
            	<a href="<?php echo zen_href_link(UN_FILENAME_WISHLIST_FIND, '', 'SSL'); ?>">
					<?php echo UN_TEXT_FIND_WISHLIST; ?>
            	</a>
            </li>
            <li>
            	<a href="<?php echo zen_href_link(UN_FILENAME_WISHLISTS, '', 'SSL'); ?>">
					<?php echo UN_TEXT_MANAGE_WISHLISTS; ?>
               	</a>
           	</li>
            <?php if ( UN_ALLOW_MULTIPLE_WISHLISTS ) { ?>
            <li>
            	<a href="<?php echo zen_href_link(UN_FILENAME_WISHLIST_MOVE, 'wid='.$id, 'SSL'); ?>">
					<?php echo UN_TEXT_WISHLIST_MOVE; ?>
               	</a>
            </li>
            <?php } ?>
        </ul>
	</div>
	<!-- control -->
	<?php echo zen_draw_form('control', zen_href_link(UN_FILENAME_WISHLIST, '', 'SSL'), 'get', 'class="control"'); ?>	
	<?php echo zen_hide_session_id(); ?>
	<?php echo zen_draw_hidden_field('main_page', UN_FILENAME_WISHLIST); ?>
	<?php echo zen_draw_hidden_field('wid', $id); ?>

	<div class="sorter filter-row mb-2">
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

			<div class="multiple">
				<label class="select-label d-none d-lg-inline" for="layout"><?php echo UN_TEXT_VIEW . UN_LABEL_DELIMITER; ?></label>
				<div class="select-wrapper-sm d-lg-inline-block">
					<?php
						echo un_draw_view_pull_down_menu('layout', '', (isset($_GET['layout']) ? $_GET['layout'] : ''), 'class="m" onchange="this.form.submit()"');
					?>
				</div>
			</div>
			<div class="clearleft"></div>	
		</div>
	</div>
	</form>
	<!-- control -->

	<!-- product listing -->
	<?php
	if ($listing_split->number_of_rows > 0) { ?>
	<div class="wishlist-list">
		<div id="productListing" class="tt-product-listing product-listing tt-view row-view tt-col-one">
			<?php 
				$rows = 0;
				$products = $db->Execute($listing_split->sql_query);
				while (!$products->EOF) {
					//echo zen_draw_form('cart_quantity', zen_href_link(UN_FILENAME_WISHLIST, zen_get_all_get_params(array('action'), 'SSL') . 'action=add_product'));
					echo zen_hide_session_id();
					
					if ( $rows & 1 ) {
						$tdclass = 'even';
					} else {
						$tdclass = 'odd';
					}
					$products_price = zen_get_products_display_price($products->fields['products_id']);
					$attributes_stored = $oWishlist->wishlist_get_attributes($products->fields['products_id']);
			?>
			<div class="col-12 tt-col-item">
				<div class="carparts_product_listlayout product-item products-item-list wishlist-item wishlist<?php echo (!un_is_empty($tdclass)? '-'.$tdclass: ''); ?>" data-bg-color="#f0eeee">
					<?php 
					echo zen_draw_hidden_field('layout', isset($_REQUEST['layout'])? $_REQUEST['layout']: '');
					if (is_array($attributes_stored)) { 
						foreach ($attributes_stored as $option => $value){
							echo '<input type="hidden" name="id[' . $option . ']" value="' . $value . '">';
						}	
					}	
					?>
					<div class="item_image">
						<?php echo '<a class="prd-img" href="' . zen_href_link(zen_get_info_page($products->fields['products_id']), 'products_id=' . $products->fields['products_id'], 'SSL') . '">'.zen_image(DIR_WS_IMAGES . $products->fields['products_image'], $products->fields['products_name'], IMAGE_PRODUCT_LISTING_WIDTH, IMAGE_PRODUCT_LISTING_HEIGHT, '').'</a>'; ?>
					</div>
					<div class="item_content text-left">
						<h2 class="item_title">
							<a href="<?php echo zen_href_link(zen_get_info_page($products->fields['products_id']), 'products_id=' . $products->fields['products_id'], 'SSL');?>"> <?php echo $products->fields['products_name']; ?> </a>
						</h2>
						<div class="product-description mt-1 mb-2">
							<?php if ( SHOW_PRODUCT_INFO_DATE_AVAILABLE && ( $products->fields['products_date_available'] > date('Y-m-d H:i:s') ) ) { ?>
							<div class="notabene">
								<?php echo sprintf(UN_TEXT_DATE_AVAILABLE, zen_date_short($products->fields['products_date_available'])); ?>
							</div>
							<?php } ?>
							<ul class="product_action_btns ul_li clearfix">		
								<?php //attributes
								if (is_array($attributes_stored)) {
									if (PRODUCTS_OPTIONS_SORT_ORDER=='0') {
										$options_order_by= ' ORDER BY LPAD(popt.products_options_sort_order,11,"0")';
									} else {
										$options_order_by= ' ORDER BY popt.products_options_name';
									}
									echo '<div class="cartAttribsList">';
									foreach ($attributes_stored as $option => $value) {
										$attributes = "SELECT popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix FROM " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa
										WHERE pa.products_id = :productsID
										AND pa.options_id = :optionsID
										AND pa.options_id = popt.products_options_id
										AND pa.options_values_id = :optionsValuesID
										AND pa.options_values_id = poval.products_options_values_id
										AND popt.language_id = :languageID
										AND poval.language_id = :languageID " . $options_order_by;
					
										$attributes = $db->bindVars($attributes, ':productsID', $products->fields['products_id'], 'integer');             //$products[$i]['id'], 'integer');
										$attributes = $db->bindVars($attributes, ':optionsID', $option, 'integer');
										$attributes = $db->bindVars($attributes, ':optionsValuesID', $value, 'integer');
										$attributes = $db->bindVars($attributes, ':languageID', $_SESSION['languages_id'], 'integer');
										$attributes_values = $db->Execute($attributes);
									//clr 030714 determine if attribute is a text attribute and assign to $attr_value temporarily
										if ($value == PRODUCTS_OPTIONS_VALUES_TEXT_ID) {
											$attributeHiddenField .= zen_draw_hidden_field('id[' . $products[$i]['id'] . '][' . TEXT_PREFIX . $option . ']',  $products[$i]['attributes_values'][$option]);
											$attr_value = htmlspecialchars($products[$i]['attributes_values'][$option], ENT_COMPAT, CHARSET, TRUE);
										} else {
											$attributeHiddenField .= zen_draw_hidden_field('id[' . $products->fields['products_id'] . '][' . $option . ']', $value);
											$attr_value = $attributes_values->fields['products_options_values_name'];
										}
				
										$attrArray[$option]['products_options_name'] = $attributes_values->fields['products_options_name'];
										$attrArray[$option]['options_values_id'] = $value;
										$attrArray[$option]['products_options_values_name'] = $attr_value;
										$attrArray[$option]['options_values_price'] = $attributes_values->fields['options_values_price'];
										$attrArray[$option]['price_prefix'] = $attributes_values->fields['price_prefix'];
								?>
								<li><?php echo $attrArray[$option]['products_options_name'] . TEXT_OPTION_DIVIDER . nl2br($attrArray[$option]['products_options_values_name']); ?>
								</li>
					
								<?php } //end foreach [attributes]
									?>
								<?php
									echo '</div>';
									}
								?>
							</ul>
							<?php echo zen_draw_form('wishlist', zen_href_link(UN_FILENAME_WISHLIST, zen_get_all_get_params(array('action'), 'SSL') . 'action=un_update_wishlist', 'SSL')); ?>
							<?php echo zen_hide_session_id(); ?>
							<?php echo zen_draw_hidden_field('layout', isset($_REQUEST['layout'])? $_REQUEST['layout']: ''); ?>
							<div class="wishlistfields">
								<input type="hidden" name="products_id[]" value="<?php echo $products->fields['products_id']; ?>" />
								<?php if (is_array($attributes_stored)) { ?>
									<input type="hidden" name="id[]" value="<?php echo $attributes_stored; ?>" />
								<?php } ?>
								<?php //print_r($pr_attr);?>
								<!-- buttons -->
								<ul class="product_action_btns ul_li clearfix">
									<?php if ( $products->fields['date_added'] ) { ?>
									<li>
										<label class="tabbed-m"><?php echo UN_TEXT_DATE_ADDED . UN_LABEL_DELIMITER; ?></label> 
										<span class="label"><?php echo zen_date_short($products->fields['date_added']); ?></span>
									</li>
									<?php } ?>
									<li>
										<label class="tabbed-m" for="wishlist_quantity[]"><?php echo UN_TEXT_QUANTITY . UN_LABEL_DELIMITER; ?>
										</label>
										<?php echo zen_draw_input_field('wishlist_quantity[]', $products->fields['quantity'], 'size="2" maxlength="3" class="xs"'); ?>
									</li>
									<li>
										<label class="tabbed-m" for="comment[]"><?php echo UN_TEXT_COMMENT . UN_LABEL_DELIMITER; ?></label>
										<?php 
											echo zen_draw_input_field('comment[]', $products->fields['comment'], 'maxlength="255" class="l"');
										?>
									</li>
									<li>
										<label class="tabbed-m select-label d-none d-lg-inline" for="priority[]"><?php echo UN_TEXT_PRIORITY . UN_LABEL_DELIMITER; ?></label>
										<div class="select-wrapper-sm">
											<?php 
												echo un_draw_priority_pull_down_menu('priority[]', '', $products->fields['priority'], 'class="l"');
											?>
										</div>
									</li>
								</ul>
								<?php echo zen_image_submit(UN_BUTTON_IMAGE_SAVE, UN_BUTTON_SAVE_ALT, '', 'mt-2'); ?>
							</div> <!-- end div.wishlistfields -->
							</form><!--end wishlist form--><hr class="mt-3 mb-3"/>
						</div>
						<div class="item_price mb-2">
							<?php echo ((zen_has_product_attributes_values((int)$products->fields['products_id']) and $flag_show_product_info_starting_at == 1) ? TEXT_BASE_PRICE : '') . $products_price; ?>
						</div>
						<div class="prd-hover">
							<div class="prd-action">
								<?php
									$display_qty = (($flag_show_product_info_in_cart_qty == 1) ? '<p>' . PRODUCTS_ORDER_QTY_TEXT_IN_CART . '1' . '</p>' : '');
									if ($products_qty_box_status == 0 or $products_quantity_order_max== 1) {
										// hide the quantity box and default to 1
										$the_button = '<input type="hidden" name="cart_quantity" value="1" />' . zen_draw_hidden_field('products_id', $products->fields['products_id']) . zen_image_submit(BUTTON_IMAGE_IN_CART, BUTTON_IN_CART_ALT);
									} else {
										// show the quantity box
										$the_button = PRODUCTS_ORDER_QTY_TEXT . '<input type="text" name="cart_quantity" value="' . (zen_get_buy_now_qty($products->fields['products_id'])) . '" maxlength="6" size="4" /><br />' . zen_get_products_quantity_min_units_display($products->fields['products_id']) . '<br />' . zen_draw_hidden_field('products_id', $products->fields['products_id']) . zen_image_submit(BUTTON_IMAGE_IN_CART, BUTTON_IN_CART_ALT);
									}		
									$display_button = zen_get_buy_now_button($products->fields['products_id'], $the_button);
								?>
								<?php echo zen_draw_form('cart_quantity', zen_href_link(UN_FILENAME_WISHLIST, zen_get_all_get_params(array('action'), 'SSL') . 'action=add_product')); ?>
								<?php if ($display_qty != '' or $display_button != '') { ?>
									<div class="extendedCart d-inline">
										<?php
											echo $display_qty;
											echo $display_button;
										?>
									</div>		
								<?php } ?>
								<?php echo '<a href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=un_remove_wishlist&products_id=' . $products->fields['products_id'], 'SSL') . '" title="'.UN_TEXT_REMOVE_WISHLIST.'">' . zen_image_button(BUTTON_IMAGE_DELETE, BUTTON_DELETE_ALT) . '</a>'; ?>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>		
		<?php $rows ++; ?>
		<?php $products->MoveNext(); ?>
		<?php } // end while products ?>
		</div>
	</div>
	<?php } else { ?>
		<div class="alert alert-danger alert-dismissable">
			<?php echo UN_TEXT_NO_PRODUCTS; ?>
		</div>	
	<?php } // end if products ?>
	<!-- end product listing -->

	<?php if (($listing_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) { ?>
		<div class="carparts_pagination_nav ul_li my-4 pagi-bot">
			<div id="allProductsListingBottomNumber" class="navSplitPagesResult back">
				<?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?>
			</div>
			<div id="allProductsListingBottomLinks" class="navSplitPagesLinks forward">
				<?php echo TEXT_RESULT_PAGE . $listing_split->display_links($max_display_page_links, zen_get_all_get_params(array('page', 'info', 'x', 'y', 'main_page')), $paginateAsUL); ?>
			</div>
		</div>
	<?php } // end paging bottom ?>
	<div class="buttons">
		<?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?>
	</div>
</div> <!-- end (un) id for styling -->