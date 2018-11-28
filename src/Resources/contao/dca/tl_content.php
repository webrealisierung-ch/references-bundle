<?php

\System::loadLanguageFile('tl_wr_references');
\Controller::loadDataContainer('tl_wr_references');
\Controller::loadDataContainer('tl_wr_references_filter');



$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'activateFilter';

$GLOBALS['TL_DCA']['tl_content']['palettes']['wr_references_list'] = "{type_legend},type,headline;{filter_legend},activateFilter;{image_legend},size;{template_legend:hide},customTpl;";
$GLOBALS['TL_DCA']['tl_content']['palettes']['wr_references_filter'] = "{type_legend},type;{filter_legend},tl_references_filters;{template_legend:hide},customTpl;";

$GLOBALS['TL_DCA']['tl_content']['subpalettes']['activateFilter'] = 'filter1,filter2,filter3';

$GLOBALS['TL_DCA']['tl_content']['fields']['filter1'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_wr_references']['filter1'],
    'exclude'                 => true,
    'search'                  => true,
    'inputType'               => 'select',
    'options_callback'        => array('tl_wr_references','getFilterOptions'),
    'eval'                    => array('multiple'=>false, 'includeBlankOption'=>true, 'tl_class'=>'w50 clr'),
    'sql'                     => "varchar(255) NULL"
);
$GLOBALS['TL_DCA']['tl_content']['fields']['filter2'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_wr_references']['filter2'],
    'exclude'                 => true,
    'search'                  => true,
    'inputType'               => 'select',
    'options_callback'        => array('tl_wr_references', 'getFilterOptions'),
    'eval'                    => array('multiple'=>false, 'includeBlankOption'=>true, 'tl_class'=>'w50'),
    'sql'                     => "varchar(255) NULL"
);
$GLOBALS['TL_DCA']['tl_content']['fields']['filter3'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_wr_references']['filter3'],
    'exclude'                 => true,
    'search'                  => true,
    'inputType'               => 'select',
    'options_callback'        => array('tl_wr_references', 'getFilterOptions'),
    'eval'                    => array('doNotCopy'=>true, 'multiple'=>true, 'chosen'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50 clr'),
    'sql'                     => "varchar(255) NULL"
);
$GLOBALS['TL_DCA']['tl_content']['fields']['activateFilter'] = array
(
    'exclude'                 => true,
    'label'                   => &$GLOBALS['TL_LANG']['tl_wr_references']['activateFilter'],
    'inputType'               => 'checkbox',
    'eval'                    => array('submitOnChange'=>true),
    'sql'                     => "char(1) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_content']['fields']['tl_references_filters'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_wr_references']['tl_references_filters'],
    'exclude'                 => true,
    'search'                  => true,
    'inputType'               => 'select',
    'options_callback'        => array('tl_wr_references_filter', 'getFilterFields'),
    'eval'                    => array('doNotCopy'=>true, 'multiple'=>true, 'chosen'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50'),
    'sql'                     => "varchar(255) NULL"
);

class tl_content_wr_references_filter{

}