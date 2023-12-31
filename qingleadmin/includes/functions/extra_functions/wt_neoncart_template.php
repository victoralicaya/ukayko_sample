<?php
#WT_NEONCART_TEMPLATE_BASE#

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}
require_once zen_get_file_directory( DIR_FS_CATALOG . DIR_WS_FUNCTIONS  . '/extra_functions', 'wt_functions', 'false');

if (function_exists('zen_register_admin_page')) {
	if (!zen_page_key_exists('FILENAME_TEMPLATE_SETTINGS')) {
		zen_register_admin_page('FILENAME_TEMPLATE_SETTINGS', 'BOX_TOOLS_TEMPLATE_SETTINGS','FILENAME_WT_NEONCART_TEMPLATE', '', 'tools', 'Y', 20);
	}
}

function get_wt_neoncart_options( $name, $default = '', $lang_id = 0 ) {
	global $db;
	$tr_config = $db->Execute( "SELECT * FROM " .  TABLE_WT_NEONCART_TEMPLATE . " WHERE opt_name='" .  $name . "' and lang_id='" .  $lang_id . "'" );
	if(!isset($tr_config->fields['opt_value'])) $tr_config->fields['opt_value'] = '';
	return ( $tr_config->fields['opt_value'] != '' ) ? $tr_config->fields['opt_value'] : $default;
}
function wt_neoncart_update_options($name,$value='',$lang_id=0)
{
	global $db;
	$chk_keys = "select * from " .  TABLE_WT_NEONCART_TEMPLATE . " WHERE opt_name='" .  $name . "' and lang_id='" .  $lang_id . "'";
	$res_chk_keys = $db->Execute($chk_keys);
	$numsrows_chek_keys = $res_chk_keys->RecordCount();
	if($numsrows_chek_keys==0)
	{
		 $tr_qry = "INSERT INTO " .  TABLE_WT_NEONCART_TEMPLATE . "(lang_id,opt_name,opt_value) VALUES('" .  $lang_id . "','" .  $name . "','" .  $value . "')";
	}else
	{
		 $tr_qry = "UPDATE " .  TABLE_WT_NEONCART_TEMPLATE . " set opt_value='" .  zen_db_input($value) . "'  WHERE opt_name='" .  $name . "' and lang_id='" .  $lang_id . "'";
	}
	$tr_config = $db->Execute($tr_qry);
	return array("$name"=>"$value");
}
function wt_neoncart_draw_langinputbox ( $field_name, $val = '', $size = '' ) {
	// modified code for multi-language support
	$languages = zen_get_languages();
	$content = '';
	$content .= '<ul class="lang_in">';
	for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
		$content.= '<li>' . zen_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']). '&nbsp;';
		$content.= zen_draw_input_field( $field_name . '[' . $languages[$i]['id'] . ']', ( ( $val != '' ) ? $val : get_wt_neoncart_options( $field_name, '', $languages[$i]['id'] ) ), 'size="37" class="md-input"', true) . "</li>";
	}
	$content.='</ul>';
	// end modified code for multi-language support
	return  $content;
}
function wt_neoncart_draw_inputbox( $field_name, $val='', $size='', $param='' ) {
	return zen_draw_input_field($field_name, ( ( $val != '' ) ? $val : get_wt_neoncart_options( $field_name ) ) , 'size="' . ( ( $size != '' ) ? $size : '40' ) . '" class="md-input form-control"' . $param, true);
}
function wt_neoncart_draw_color_inputbox( $field_name, $default = '' ) {
	return zen_draw_input_field( $field_name,  get_wt_neoncart_options( $field_name, $default ) , 'size="10" class="md-input color form-control"', true );
}
function wt_neoncart_draw_yesnoradio( $field_name, $default = '' ) {
	return wt_neoncart_draw_radio( $field_name, array( 1 => array( 'label' => WT_A_YES ), 0 => array( 'label' => WT_A_NO ) ), get_wt_neoncart_options( $field_name, $default ) );
}
function wt_neoncart_draw_enabledisable_radio( $field_name, $default = '' ) {
	return wt_neoncart_draw_radio( $field_name, array( 1 => array( 'label' => WT_A_ENABLE ), 0 => array( 'label' => WT_A_DISABLE ) ), get_wt_neoncart_options( $field_name, $default ) );
}
function wt_neoncart_draw_radio( $field_name, $options, $selected ) {
	if ( !empty( $options ) ) {
		$content = '';
		$content .= '<ul class="inline-ul">';
		foreach( $options as $value => $radio ) {
			if(!isset($radio['params'])) $radio['params'] = '';
			if(!isset($radio['html'])) $radio['html'] = '';
			$checked = ( $value == $selected ) ? 'checked="checked"' : '';
			$content .= '<li class="radio-inline ' . ( !empty( $radio['li_class'] ) ? $radio['li_class'] : '' ) . '">
				<label class="radio">' .
				( ( !empty( $radio['label_image'] )  ) ? '<span class="label-image">' . $radio['label_image'] . '</span>' : '' ) . 
				'<span class="radio-input">' .
					'<input type="radio" name="' . $field_name . '" value="' . $value . '" ' . $checked . ' ' . wt_stringify_atts( $radio['params'] ) . ' />' .  
					( ( $radio['html']) ? $radio['html'] : '' ) . 
					'<span>' . ( ( !empty( $radio['label'] ) ) ? $radio['label'] : '' ) . '</span>' .
				'</span>' .
				'</label></li>';
		}
		$content .= '</ul>';
	}
	return $content;
}
function wt_neoncart_draw_textarea( $field_name, $val = '', $col = '', $row = '' ) {
	
	$content = '';
	$content .= zen_draw_textarea_field($field_name, '', (($col!='')? $col : '38.8'), (($row!='')? $row : '6'),(($val!='')? $val : get_wt_neoncart_options($field_name)),'class="md-input noEditor form-control"');   
	return $content;
}
function wt_neoncart_draw_langtextarea( $field_name, $val = '', $col = '', $row = '' ) {
	
	// modified code for multi-language support
	$languages = zen_get_languages();
	$content = '';
	$content .= '<ul class="lang_in">';	  
	for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
		$content.= '<li>' . zen_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']). '&nbsp;';
		$content.= zen_draw_textarea_field($field_name . '[' . $languages[$i]['id'] . ']','',(($col!='')? $col : '35.8'),'6',(($val!='')? $val : get_wt_neoncart_options( $field_name, '', $languages[$i]['id'] ) ),' class="md-input noEditor form-control"', true) . '</li>';
	}
	$content.='</ul>';	  
	// end modified code for multi-language support
	return  $content;
}
function wt_neoncart_draw_selectbox( $name, $ar, $val = '' ){
	$content = '';
	$content .= '<select class="form-control" name=' . $name . '>';
	$content .= '<option value="">Select Option</option>';
	if ( !empty( $ar ) ) {
		foreach( $ar as $k => $v ) {
			if ( $val != '' && $k == $val ){
				$content .= '<option value="' . $k . '" selected="selected">' . $v . '</option>';
			} else {
				$content .= '<option value="' . $k . '">' . $v . '</option>';
			}
			
		}
	}
	$content .= '</select>';
	return $content;
}
function wt_neoncart_fileupload($opt_name, $fname){
	$time=time();
	if($_FILES[$fname]['name']!=''){
	   $logo_fname = wt_neoncart_temp_dir('temp_upload_dir').$logo_image;
	   if ( $logo_fname && file_exists( $logo_fname ) ) { unlink($logo_fname); }
	}
	if ( !is_dir(wt_neoncart_temp_dir('temp_upload_dir')) ){ @mkdir(wt_neoncart_temp_dir('temp_upload_dir'), 0755); }		
	if ( !empty( $_FILES[$fname]['name'] ) ){
		$logo_ext = pathinfo($_FILES[$fname]['name'], PATHINFO_EXTENSION);
		$logo_onlyname = pathinfo($_FILES[$fname]['name'], PATHINFO_FILENAME);
		$logo_image_tname= $logo_onlyname . '_' . $time . "." .  $logo_ext;
		move_uploaded_file($_FILES[$fname]["tmp_name"], wt_neoncart_temp_dir('temp_upload_dir') . $logo_image_tname);
		wt_neoncart_update_options($opt_name, $logo_image_tname);
	}
}
//get current selected template
function wt_neoncart_temp_dir( $t = ''){
	global $db;
	$cur_template = "";
	$template_query = $db->Execute("select template_dir from " . TABLE_TEMPLATE_SELECT . " where template_language in (" . (int)$_SESSION['languages_id'] . ', 0' . ") order by template_language DESC");
	$template_dir = $template_query->fields['template_dir'];
	if($t=='temp_upload_dir'){
		$cur_template=DIR_FS_CATALOG.DIR_WS_IMAGES.$template_dir . '/uploads/';
	}else if($t=='temp_dir'){
		$cur_template=DIR_FS_CATALOG.DIR_WS_IMAGES.$template_dir . '/';
	}else{
		$cur_template=$template_dir;
	}
	return $cur_template;
}

//install sql file
function wt_neoncart_setup_sql(){
	// get values
	$action = $_POST['action'];
	$selected = $_POST['compare_id'];
	$compare_array = array();
	$comp_images = '';
	$compare_warning = '';

	$comp_value_count = count($_SESSION['compare']);

	// add new products selected
	if ($action == 'add') {
		if ($comp_value_count < COMPARE_VALUE_COUNT) {
			$compare_array[] = $selected;
			foreach ($_SESSION['compare'] as $c) {
				if ($c != $selected) {
					$compare_array[] = $c;
				}
			}
			$_SESSION['compare'] = array_unique($compare_array);
		} else {
			$compare_warning = '<div id="compareWarning">only' .  COMPARE_VALUE_COUNT  . 'items can be compared at one time</div>';
		}
	} 

	// remove products
	if ($action == 'remove') {
		foreach ($_SESSION['compare'] as $rValue) {
			if ($rValue != $selected) {
				$removed_compare_array[] = $rValue;
			}
			$_SESSION['compare'] = array_unique($removed_compare_array);
		}
	}

	// return new value for the session
	foreach ($_SESSION['compare'] as $value) {
		if (!empty($value)) {
			$product_comp_image = $db->Execute(
				"SELECT p.products_id, p.master_categories_id, pd.products_name, p.products_image
				 FROM " . TABLE_PRODUCTS . " p
				 LEFT JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd
				 ON pd.products_id=p.products_id
				 WHERE p.products_id='" .  $value . "'"
			);
			$comp_images .= '<div class="compareAdded"><a href="' . zen_href_link(zen_get_info_page($product_comp_image->fields['products_id']), 'cPath=' . (zen_get_generated_category_path_rev($product_comp_image->fields['master_categories_id'])) . '&products_id=' . $product_comp_image->fields['products_id']) . '">' . zen_image(DIR_WS_IMAGES . $product_comp_image->fields['products_image'], $product_comp_image->fields['products_name'], '', '35', 'class="listingProductImage"') . '</a><div>' . '<a onclick="javascript: compareNew(' . $product_comp_image->fields['products_id'] . ', \'remove\')" alt="remove">Remove</a>' . '</div></div>';
		}
	}

	// return HTML view of found products
	if (!empty($comp_images)) {
		echo '<div id="compareMainWrapper"><div class="compareAdded compareButton">' . '<a href="index.php?main_page=compare" alt="compare">' . '<span class="cssButton">Default</span></a></div>' . $comp_images . '</div>';
	}
	echo '<br class="clearBoth" />';

	// send back warning if more than allowed is selected
	echo $compare_warning;
}

function wt_neoncart_create_table_sql(){
	global $db;
	$table_exits=wt_neoncart_checkdb_tables(WT_NEONCART_TEMPLATE_TABLES);
	if(empty($table_exits)){
		wt_neoncart_execute_sql(WT_NEONCART_TEMPLATE_CREATETABLE_SQL,DB_DATABASE,DB_PREFIX);
	}
}
function wt_neoncart_generate_categories_pull_down($name,$val,$other=''){
	global $languages_id, $db;
	$cat_array = array();
	$categories_query = "select c.categories_id, cd.categories_name, c.parent_id
									from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd
									where c.categories_id = cd.categories_id
									and c.categories_status=1 " .
									" and cd.language_id = '" . (int)$_SESSION['languages_id'] . "' " .
									" order by c.parent_id, c.sort_order, cd.categories_name";
	$categories = $db->Execute($categories_query);
	while (!$categories->EOF) {
		$cat_array[$categories->fields['parent_id']][$categories->fields['categories_id']] = array('name' => $categories->fields['categories_name'], 'count' => 0);
		$categories->MoveNext();
	}
	$cat_options_list='';
	$level=0;
	$dess='';
	$content='<select name="' . $name . '" ' . $other . '>';
	$content.=draw_categories_options($cat_array[0],$cat_array,$level,$dess,$val);
	$content.='</select>';
	return $content;
}
function draw_categories_options($parentid,$cat_array,$level,$dess,$val){
	if($level!=0){
		$dess=$dess . '---';
	}
	$level++;
	if(!empty($parentid)){
		foreach($parentid as $k=>$v){
			$selected=($val==$k)? 'selected="selected"' : '';
			$cat_options_list.='<option ' . $selected . ' value="' . $k . '">' . $dess.$v['name'] . '</option>';
			if(!empty($cat_array)){
				$cat_options_list.=draw_categories_options($cat_array[$k],$cat_array,$level,$dess,$val);
			}
		}
	}
	return $cat_options_list;	
}
function wt_neoncart_generate_fontfamily_pull_down($name,$val,$other=''){
	$_names = "ABeeZee,Abel,Abril Fatface,Aclonica,Acme,Actor,Adamina,Advent Pro,Aguafina Script,Akronim,Aladin,Aldrich,Alegreya,Alegreya SC,Alex Brush,Alfa Slab One,Alice,Alike,Alike Angular,Allan,Allerta,Allerta Stencil,Allura,Almendra,Almendra SC,Amarante,Amaranth,Amatic SC,Amethysta,Anaheim,Andada,Andika,Angkor,Annie Use Your Telescope,Anonymous Pro,Antic,Antic Didone,Antic Slab,Anton,Arapey,Arbutus,Arbutus Slab,Architects Daughter,Archivo Black,Archivo Narrow,Arimo,Arizonia,Armata,Artifika,Arvo,Asap,Asset,Asul,Atomic Age,Aubrey,Audiowide,Autour One,Average,Average Sans,Averia Gruesa Libre,Averia Libre,Averia Sans Libre,Averia Serif Libre,Bad Script,Balthazar,Bangers,Basic,Battambang,Baumans,Bayon,Belgrano,Belleza,BenchNine,Bentham,Berkshire Swash,Bevan,Bigshot One,Bilbo,Bilbo Swash Caps,Bitter,Black Ops One,Bokor,Bonbon,Boogaloo,Bowlby One,Bowlby One SC,Brawler,Bree Serif,Bubblegum Sans,Buda,Buenard,Butcherman,Butterfly Kids,Cabin,Cabin Condensed,Cabin Sketch,Caesar Dressing,Cagliostro,Calligraffitti,Cambo,Candal,Cantarell,Cantata One,Cantora One,Capriola,Cardo,Carme,Carrois Gothic,Carrois Gothic SC,Carter One,Caudex,Cedarville Cursive,Ceviche One,Changa One,Chango,Chau Philomene One,Chela One,Chelsea Market,Chenla,Cherry Cream Soda,Cherry Swash,Chewy,Chicle,Chivo,Cinzel,Cinzel Decorative,Coda,Coda Caption,Codystar,Combo,Comfortaa,Coming Soon,Concert One,Condiment,Content,Contrail One,Convergence,Cookie,Copse,Corben,Courgette,Cousine,Coustard,Covered By Your Grace,Crafty Girls,Creepster,Crete Round,Crimson Text,Crushed,Cuprum,Cutive,Cutive Mono,Damion,Dancing Script,Dangrek,Dawning of a New Day,Days One,Delius,Delius Swash Caps,Delius Unicase,Della Respira,Devonshire,Didact Gothic,Diplomata,Diplomata SC,Doppio One,Dorsa,Dosis,Dr Sugiyama,Droid Sans,Droid Sans Mono,Droid Serif,Duru Sans,Dynalight,EB Garamond,Eagle Lake,Eater,Economica,Electrolize,Emblema One,Emilys Candy,Engagement,Enriqueta,Erica One,Esteban,Euphoria Script,Ewert,Exo,Expletus Sans,Fanwood Text,Fascinate,Fascinate Inline,Faster One,Fasthand,Federant,Federo,Felipa,Fenix,Finger Paint,Fjord One,Flamenco,Flavors,Fondamento,Fontdiner Swanky,Forum,Francois One,Fredericka the Great,Fredoka One,Freehand,Fresca,Frijole,Fugaz One,Georgia,GFS Didot,GFS Neohellenic,Galdeano,Galindo,Gentium Basic,Gentium Book Basic,Geo,Geostar,Geostar Fill,Germania One,Give You Glory,Glass Antiqua,Glegoo,Gloria Hallelujah,Goblin One,Gochi Hand,Gorditas,Goudy Bookletter 1911,Graduate,Gravitas One,Great Vibes,Griffy,Gruppo,Gudea,Habibi,Hammersmith One,Handlee,Hanuman,Happy Monkey,Headland One,Henny Penny,Herr Von Muellerhoff,Holtwood One SC,Hind,Homemade Apple,Homenaje,IM Fell DW Pica,IM Fell DW Pica SC,IM Fell Double Pica,IM Fell Double Pica SC,IM Fell English,IM Fell English SC,IM Fell French Canon,IM Fell French Canon SC,IM Fell Great Primer,IM Fell Great Primer SC,Iceberg,Iceland,Imprima,Inconsolata,Inder,Indie Flower,Inika,Irish Grover,Istok Web,Italiana,Italianno,Jacques Francois,Jacques Francois Shadow,Jim Nightshade,Jockey One,Jolly Lodger,Josefin Sans,Josefin Slab,Judson,Julee,Julius Sans One,Junge,Jura,Just Another Hand,Just Me Again Down Here,Kameron,Karla,Kaushan Script,Kelly Slab,Kenia,Khmer,Kite One,Knewave,Kotta One,Koulen,Kranky,Kreon,Kristi,Krona One,La Belle Aurore,Lancelot,Lato,League Script,Leckerli One,Ledger,Lekton,Lemon,Life Savers,Lilita One,Limelight,Linden Hill,Lobster,Lobster Two,Londrina Outline,Londrina Shadow,Londrina Sketch,Londrina Solid,Lora,Love Ya Like A Sister,Loved by the King,Lovers Quarrel,Luckiest Guy,Lusitana,Lustria,Macondo,Macondo Swash Caps,Magra,Maiden Orange,Mako,Marcellus,Marcellus SC,Marck Script,Marko One,Marmelad,Marvel,Mate,Mate SC,Maven Pro,McLaren,Meddon,MedievalSharp,Medula One,Megrim,Meie Script,Merienda One,Merriweather,Metal,Metal Mania,Metamorphous,Metrophobic,Michroma,Miltonian,Miltonian Tattoo,Miniver,Miss Fajardose,Modern Antiqua,Molengo,Molle,Monofett,Monoton,Monsieur La Doulaise,Montaga,Montez,Montserrat,Montserrat Alternates,Montserrat Subrayada,Moul,Moulpali,Mountains of Christmas,Mr Bedfort,Mr Dafoe,Mrs Saint Delafield,Mrs Sheppards,Muli,Mystery Quest,Neucha,Neuton,News Cycle,Niconne,Nixie One,Nobile,Nokora,Norican,Nosifer,Nothing You Could Do,Noticia Text,Nova Cut,Nova Flat,Nova Mono,Nova Oval,Nova Round,Nova Script,Nova Slim,Nova Square,Numans,Nunito,Odor Mean Chey,Offside,Old Standard TT,Oldenburg,Oleo Script,Open Sans,Open Sans Condensed,Oranienbaum,Orbitron,Oregano,Orienta,Original Surfer,Oswald,Over the Rainbow,Overlock,Overlock SC,Ovo,Oxygen,Oxygen Mono,PT Mono,PT Sans,PT Sans Caption,PT Sans Narrow,PT Serif,PT Serif Caption,Pacifico,Paprika,Parisienne,Passero One,Passion One,Patrick Hand,Patua One,Paytone One,Peralta,Permanent Marker,Petit Formal Script,Petrona,Philosopher,Piedra,Pinyon Script,Plaster,Play,Playball,Playfair Display,Playfair Display SC,Podkova,Poiret One,Poller One,Poly,Pompiere,Pontano Sans,Poppins,Port Lligat Sans,Port Lligat Slab,Prata,Preahvihear,Press Start 2P,Princess Sofia,Prociono,Prosto One,Puritan,Quando,Quantico,Quattrocento,Quattrocento Sans,Questrial,Quicksand,Qwigley,Racing Sans One,Radley,Raleway,Raleway Dots,Rammetto One,Ranchers,Rancho,Rationale,Redressed,Reenie Beanie,Revalia,Ribeye,Ribeye Marrow,Righteous,Rochester,Rock Salt,Rokkitt,Romanesco,Ropa Sans,Rosario,Rosarivo,Rouge Script,Ruda,Ruge Boogie,Ruluko,Ruslan Display,Russo One,Ruthie,Rye,Sail,Salsa,Sanchez,Sancreek,Sansita One,Sarina,Satisfy,Scada,Schoolbell,Seaweed Script,Sevillana,Seymour One,Shadows Into Light,Shadows Into Light Two,Shanti,Share,Share Tech,Share Tech Mono,Shojumaru,Short Stack,Siemreap,Sigmar One,Signika,Signika Negative,Simonetta,Sirin Stencil,Six Caps,Skranji,Slackey,Smokum,Smythe,Sniglet,Snippet,Sofadi One,Sofia,Sonsie One,Sorts Mill Goudy,Source Code Pro,Source Sans Pro,Special Elite,Spicy Rice,Spinnaker,Spirax,Squada One,Stalinist One,Stardos Stencil,Stint Ultra Condensed,Stint Ultra Expanded,Stoke,Strait,Sue Ellen Francisco,Sunshiney,Supermercado One,Suwannaphum,Swanky and Moo Moo,Syncopate,Tangerine,Taprom,Telex,Tenor Sans,The Girl Next Door,Tienne,Tinos,Titan One,Titillium Web,Trade Winds,Trocchi,Trochut,Trykker,Tulpen One,Ubuntu,Ubuntu Condensed,Ubuntu Mono,Ultra,Uncial Antiqua,Underdog,Unica One,UnifrakturCook,UnifrakturMaguntia,Unkempt,Unlock,Unna,VT323,Varela,Varela Round,Vast Shadow,Vibur,Vidaloka,Viga,Voces,Volkhov,Vollkorn,Voltaire,Waiting for the Sunrise,Wallpoet,Walter Turncoat,Warnes,Wellfleet,Wire One,Yanone Kaffeesatz,Yellowtail,Yeseva One,Yesteryear,Zeyada";
	
	$names = explode(',', $_names);
	$content = '';
	$content .= ' <select name="' . $name . '" ' . $other . ' class="form-control">';
	foreach ( $names as $n ) {
		if ( $n == $val ) {
			$content .= '<option selected="selected" val="' . $n . '">' . $n . '</option>';
		} else {
			$content .= '<option val="' . $n . '">' . $n . '</option>';
		}
	}
	$content .= '</select>';
	return $content;
}