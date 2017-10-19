<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2016 Leo Feyer
 *
 * @license LGPL-3.0+
 */

/**
 * Table tl_wr_references_filter
 */
$GLOBALS['TL_DCA']['tl_wr_references_filter'] = array(
    'config' => array
    (
        'dataContainer' => 'Table',
        'enableVersioning' => true,
        'sql' => array
        (
            'keys' => array
            (
                'id' => 'primary',
            )
        )
    ),
    'list' => array
    (
        'sorting' => array
        (
            'mode' => 2,
            'fields' => array('filter'),
            'panelLayout' => 'sort,filter;search,limit',
        ),
        'label' => array
        (
            'fields'                  => array('title','filter'),
            'format'                  => '%s <span style="font-size: 0.9em;">[%s]</span>',
            'showColumns'   => true,
            'label_callback'=>array('tl_wr_references_filter','generateLabels')
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_wr_references_filter']['edit'],
                'href' => 'act=edit',
                'icon' => 'edit.gif'
            ),
            'delete' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_wr_references_filter']['delete'],
                'href' => 'act=delete',
                'icon' => 'delete.gif'
            )
        )
    ),
    'palettes' => array(
        'default' => '{references_content_legend},title,alias,teaser;{references_filter_legend},filter;'
    ),
    'fields' => array
    (
        'id' => array
        (
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ),
        'pid' => array
        (
            'foreignKey'              => 'tl_wr_references.id',
            'sql'                     => "int(10) unsigned NOT NULL default '0'",
            'relation'                => array('type'=>'belongsTo', 'load'=>'eager')
        ),
        'sorting' => array
        (
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'tstamp' => array
        (
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'title' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_wr_references_filter']['title'],
            'exclude' => true,
            'inputType' => 'text',
            'search' => true,
            'eval' => array('mandatory'=>true, 'decodeEntities'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql' => "varchar(255) NOT NULL default ''"
        ),
        'alias' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_wr_references_filter']['alias'],
            'exclude' => true,
            'inputType' => 'text',
            'search' => false,
            'eval' => array('rgxp'=>'alias', 'doNotCopy'=>true, 'maxlength'=>128, 'tl_class'=>'w50'),
            'save_callback' => array
            (
                array('tl_wr_references_filter', 'generateAlias')
            ),
            'sql' => "varchar(128) COLLATE utf8_bin NOT NULL default ''"
        ),
        'teaser' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_wr_references_filter']['teaser'],
            'inputType' => 'textarea',
            'search' => false,
            'sql' => 'text NULL',
            'eval' => array('tl_class'=>'clr'),
        ),
        'filter' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_wr_references_filter']['filter'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'select',
            'options_callback'        => array('tl_wr_references_filter', 'getFilterFields'),
            //'options'                 => array('Value1', 'Value2'),
            'eval'                    => array('multiple'=>false, 'mandatory'=>true, 'tl_class'=>'w50'),
            'sql'                     => "blob NULL"
        ),
    )
);
class tl_wr_references_filter extends Backend{
    public function generateAlias($varValue, DataContainer $dc)
    {
        $autoAlias = false;

        // Generate an alias if there is none
        if ($varValue == '')
        {
            $autoAlias = true;
            $varValue = StringUtil::generateAlias($dc->activeRecord->title);
        }

        $objAlias = $this->Database->prepare("SELECT id FROM tl_wr_references_filter WHERE id=? OR alias=?")
            ->execute($dc->id, $varValue);

        // Check whether the page alias exists
        if ($objAlias->numRows > 1)
        {
            if (!$autoAlias)
            {
                throw new Exception(sprintf($GLOBALS['TL_LANG']['ERR']['aliasExists'], $varValue));
            }

            $varValue .= '-' . $dc->id;
        }

        return $varValue;
    }
    public function getFilterFields(){
        $filter_options=[];
        \Controller::loadDataContainer('tl_wr_references');
        \System::loadLanguageFile('tl_wr_references');
        //var_dump($GLOBALS['TL_DCA']['tl_wr_references']['fields']);
        foreach($GLOBALS['TL_DCA']['tl_wr_references']['fields'] as $key => $value){
            if(preg_match("/filter/",$key)){
               $filter_options[$key]=$GLOBALS['TL_LANG']['tl_wr_references'][$key][0];
            }
        }
        return $filter_options;
    }
    public function getYears(){
        $years=[];
        foreach(range(2000, 2025) as $number) {
             array_push($years,$number);
        }
        return $years;
    }
    public function generateLabels(){
        \System::loadLanguageFile('tl_wr_references');
        $args = func_get_args();
        return array(
            $args[0][title], $GLOBALS['TL_LANG']['tl_wr_references'][$args[0]['filter']][0]
        );
    }
}
