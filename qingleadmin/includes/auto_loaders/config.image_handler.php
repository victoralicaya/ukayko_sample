<?php
// -----
// Part of the "Image Handler" plugin, v5.0.0 and later, by Cindy Merkin a.k.a. lat9 (cindy@vinosdefrutastropicales.com)
// Copyright (c) 2017-2022 Vinos de Frutas Tropicales
//
// Last updated: IH 5.3.0
//
if (!defined('IS_ADMIN_FLAG') || IS_ADMIN_FLAG !== true) {
    exit('Illegal Access');
} 

// -----
// Load the plugin's initialization script.
//
$autoLoadConfig[199][] = [
    'autoType' => 'init_script',
    'loadFile' => 'init_image_handler.php'
];
