<?php

/**
 * @copyright 2017 Webrealisierung GmbH
 *
 * @license LGPL-3.0+
 */

/**
 * @author Daniel Steuri <mail@webrealisierung.ch>
 * @package Wr\TeamBundle
 */


//Load the Stylesheet in the back end
if(TL_MODE=="BE"){
    $GLOBALS['TL_CSS'][]="bundles/wrreferences/css/be/references.css";
}


/**
 * BACK END MODULES
 */
$GLOBALS['BE_MOD']['wr']['wr_references'] = array
(
        'tables' => array('tl_wr_references','tl_wr_references_filter'),
        'icon' => 'system/modules/wr_references/assets/icon/house.png',
);

/**
 * CONTENT ELEMENTS
 */
$GLOBALS['TL_CTE']['wr']['wr_references_list'] = 'ContentReferencesList';
$GLOBALS['TL_CTE']['wr']['wr_references_filter'] = 'ContentReferencesFilter';
