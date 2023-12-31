<?php
/**
 * Side Box Template: Searchbox
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: DrByte 2020 Dec 25 Modified in v1.5.8-alpha $
 */
$content = '';
$content .= '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent centeredContent">';
$content .= zen_draw_form('quick_find', zen_href_link(FILENAME_SEARCH_RESULT, '', $request_type, false), 'get');
$content .= zen_draw_hidden_field('main_page', FILENAME_SEARCH_RESULT);
$content .= zen_draw_hidden_field('search_in_description', '1') . zen_hide_session_id();

  if (strtolower(IMAGE_USE_CSS_BUTTONS) == 'yes') {
    $content .= zen_draw_input_field('keyword', '', 'size="18" maxlength="100" placeholder="' . SEARCH_DEFAULT_TEXT . '"') . zen_image_submit (BUTTON_IMAGE_SEARCH,HEADER_SEARCH_BUTTON, '', 'mt-1 btn-sm');
    $content .= '<a class="mt-2 mx-2" href="' . zen_href_link(FILENAME_ADVANCED_SEARCH) . '">' . BOX_SEARCH_ADVANCED_SEARCH . '</a>';
  } else {
    $content .= zen_draw_input_field('keyword', '', 'size="18" maxlength="100" placeholder="' . SEARCH_DEFAULT_TEXT . '" onfocus="if (this.value == \'' . SEARCH_DEFAULT_TEXT . '\') this.value = \'\';" onblur="if (this.value == \'\') this.value = \'' . SEARCH_DEFAULT_TEXT . '\';"') . '<input type="submit" class="mt-1 btn--sm" value="' . HEADER_SEARCH_BUTTON . '" style="width: 50px" />';
    $content .= '<a class="mt-2 mx-2" href="' . zen_href_link(FILENAME_ADVANCED_SEARCH) . '">' . BOX_SEARCH_ADVANCED_SEARCH . '</a>';
  }

  $content .= "</form>";
  $content .= '</div>';
