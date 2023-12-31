<?php
/**
 * Override Template for common/tpl_main_page.php
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: DrByte 2020 Jul 10 Modified in v1.5.8-alpha $
 */
?>

<body id="popupShippingEstimator">
<div class="shippingEstimatorWrapper biggerText">
<p><?php echo '<a href="javascript:window.close()">' . TEXT_CURRENT_CLOSE_WINDOW . '</a>'; ?></p>
      <?php require(DIR_WS_MODULES . zen_get_module_directory('shipping_estimator.php')); ?>
<p><?php echo '<a href="javascript:window.close()">' . TEXT_CURRENT_CLOSE_WINDOW . '</a>'; ?></p>
</div>
<?php
/**                                                                                                                                                                                                       
* load the loader JS files
*/
//print_r($RC_loader_files['jscript'] );exit;
if(!empty($RC_loader_files)){
  foreach($RC_loader_files['jscript'] as $file)
	if($file['include']) {
	  include($file['src']);
	} else if(!$RI_CJLoader->get('minify_js') || $file['external']) {
	  echo '<script type="text/javascript" src="'.$file['src'].'"></script>'."\n";
	} else {
	  echo '<script type="text/javascript" src="min/?f='.$file['src'].'&'.$RI_CJLoader->get('minify_time').'"></script>'."\n";
	}
}
//DEBUG: echo '';
?>
</body>