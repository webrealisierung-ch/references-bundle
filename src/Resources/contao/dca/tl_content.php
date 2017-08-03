<?php

\System::loadLanguageFile('tl_wr_references');
\Controller::loadDataContainer('tl_wr_references');
\Controller::loadDataContainer('tl_wr_references_filter');

$GLOBALS['TL_DCA']['tl_content']['palettes']['wr_references_list'] = "{type_legend},type,headline;{filter_legend},filter1,filter2,filter3,activateFilter;";
$GLOBALS['TL_DCA']['tl_content']['palettes']['wr_references_filter'] = "{type_legend},type;{filter_legend},tl_references_filters;";

$GLOBALS['TL_DCA']['tl_content']['fields']['filter1'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_wr_references']['filter1'],
    'exclude'                 => true,
    'search'                  => true,
    'inputType'               => 'select',
    'options_callback'        => array('tl_wr_references','getFilterOptions'),
    'eval'                    => array('multiple'=>false, 'includeBlankOption'=>true, 'tl_class'=>'w50'),
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
    'eval'                    => array('doNotCopy'=>true, 'multiple'=>true, 'chosen'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50'),
    'sql'                     => "varchar(255) NULL"
);
$GLOBALS['TL_DCA']['tl_content']['fields']['activateFilter'] = array
(
    'exclude'                 => true,
    'label'                   => &$GLOBALS['TL_LANG']['tl_article']['activateFilter'],
    'inputType'               => 'checkbox',
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