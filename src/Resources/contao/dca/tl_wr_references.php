<?php

if(TL_MODE=="BE"){
    $GLOBALS['TL_CSS'][]="bundles/wrreferences/css/be/references.css";
}

/**
 * Table tl_wr_references
 */
$GLOBALS['TL_DCA']['tl_wr_references'] = array(
    'config' => array
    (
        'dataContainer' => 'Table',
        'sql' => array
        (
            'keys' => array
            (
             'id' => 'primary'
            )
        )
    ),
    'list' => array
    (
        'sorting' => array
        (
            'mode' => 2,
            'fields' => array('title'),
            'panelLayout' => 'sort,filter;search,limit',
        ),
        'label' => array
        (
            'fields'            => array('title','filter1', 'filter2', 'filter3'),
            'showColumns'       => true,
            'label_callback'    => array('tl_wr_references','generateLabel')
        ),
        'global_operations' => array
        (
            'filter' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_wr_references']['filter'],
                'href'                => 'table=tl_wr_references_filter',
                'class'               => 'header_filter',
                'attributes'          => 'onclick="Backend.getScrollOffset()"',
            ),
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_wr_references']['edit'],
                'href' => 'act=edit',
                'icon' => 'edit.gif'
            ),
            'delete' => array
            (
                'label' => &$GLOBALS['TL_LANG']['tl_wr_references']['delete'],
                'href' => 'act=delete',
                'icon' => 'delete.gif'
            )
        ),
    ),
    // Palettes
    'palettes' => array(
        '__selector__' => array('published'),
        'default' => '{references_content_legend},title,alias,teaser,description;{references_image_legend},singleSRC,singleSize,gallerySRC;{references_filter_legend},filter1,filter2,filter3;{publish_legend},published;'
    ),
    // Subpalettes
    'subpalettes' => array
    (
        'published'                   => 'start,stop'
    ),
    'fields' => array
    (
        'id' => array
        (
            'label' => array('id'),
            'search' => false,
            'sql' => "int(10) unsigned NOT NULL auto_increment"
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
            'label' => &$GLOBALS['TL_LANG']['tl_wr_references']['title'],
            'exclude' => true,
            'inputType' => 'text',
            'search' => true,
            'eval' => array('mandatory'=>true, 'decodeEntities'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
            'sql' => "varchar(255) NOT NULL default ''"
        ),
        'alias' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_wr_references']['alias'],
            'exclude' => true,
            'inputType' => 'text',
            'search' => false,
            'eval' => array('rgxp'=>'alias', 'doNotCopy'=>true, 'maxlength'=>128, 'tl_class'=>'w50'),
            'save_callback' => array
            (
                array('tl_wr_references', 'generateAlias')
            ),
            'sql' => "varchar(128) COLLATE utf8_bin NOT NULL default ''"
        ),
        'teaser' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_wr_references']['teaser'],
            'inputType' => 'textarea',
            'search' => false,
            'eval' => array('mandatory'=>true,'tl_class'=>'clr'),
            'sql' => 'text NULL'
        ),
        'description' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_wr_references']['description'],
            'inputType' => 'textarea',
            'search' => true,
            'eval' => array('mandatory'=>true,'rte'=>'tinyMCE','tl_class'=>'clr'),
            'sql' => 'text NULL'
        ),
        'singleSRC' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_wr_references']['singleSRC'],
            'inputType' => 'fileTree',
            'eval' => array('fieldType'=>'radio', 'filesOnly'=>true, 'extensions'=>'gif,jpg,jpeg,png', 'mandatory'=>false, 'tl_class'=>'clr'),
            'sql' => "blob NULL",
        ),
        'singleSize' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_wr_references']['singleSize'],
            'inputType' => 'imageSize ',
            'eval' => array('fieldType'=>'radio', 'filesOnly'=>true, 'extensions'=>'gif,jpg,jpeg,png', 'mandatory'=>false, 'tl_class'=>'clr'),
            'sql' => "blob NULL",
        ),
        'gallerySRC' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_wr_references']['gallerySRC'],
            'inputType' => 'fileTree',
            'eval' => array('multiple'=>true, 'fieldType'=>'checkbox', 'orderField'=>'orderSRC', 'extensions'=>'gif,jpg,jpeg,png', 'files'=>true, 'mandatory'=>false),
            'sql' => "blob NULL",
        ),

        'orderSRC' => array
        (
            'label' => &$GLOBALS['TL_LANG']['tl_wr_references']['orderSRC'],
            'sql' => "blob NULL"
        ),
        'filter1' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_wr_references']['filter1'],
            'exclude'                 => true,
            'search'                  => true,
            'filter'                  => true,
            'inputType'               => 'select',
            //'options'                 => array('2010', '2011', '2012', '2013', '2014', '2015', '2016', '2017', '2018', '2019', '2020', '2021', '2022','2023'),
            'options_callback'        => array('tl_wr_references','getFilterOptions'),
            'eval'                    => array('multiple'=>false, 'mandatory'=>true, 'chosen'=>true, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'filter2' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_wr_references']['filter2'],
            'exclude'                 => true,
            'search'                  => true,
            'filter'                  => true,
            'inputType'               => 'select',
            'options_callback'        => array('tl_wr_references', 'getFilterOptions'),
            'eval'                    => array('multiple'=>false, 'mandatory'=>true, 'chosen'=>true, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'filter3' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_wr_references']['filter3'],
            'exclude'                 => true,
            'search'                  => true,
            'filter'                  => true,
            'inputType'               => 'select',
            'options_callback'        => array('tl_wr_references', 'getFilterOptions'),
            'eval'                    => array('doNotCopy'=>true, 'mandatory'=>true, 'multiple'=>true, 'chosen'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'published' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_wr_references']['published'],
            'exclude'                 => true,
            'filter'                  => true,
            'flag'                    => 2,
            'inputType'               => 'checkbox',
            'eval'                    => array('submitOnChange'=>true, 'doNotCopy'=>true),
            'sql'                     => "char(1) NOT NULL default ''"
        ),
        'start' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_wr_references']['start'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
            'sql'                     => "varchar(10) NOT NULL default ''"
        ),
        'stop' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_wr_references']['stop'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
            'sql'                     => "varchar(10) NOT NULL default ''"
        )
    )
);
class tl_wr_references extends Backend{
    public function generateAlias($varValue, DataContainer $dc)
    {
        $autoAlias = false;

        // Generate an alias if there is none
        if ($varValue == '')
        {
            $autoAlias = true;
            $varValue = StringUtil::generateAlias($dc->activeRecord->title);
        }

        $objAlias = $this->Database->prepare("SELECT id FROM tl_wr_references WHERE id=? OR alias=?")
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
    public function getFilterOptions( DataContainer $dc){
        $listValues = array();
        if($dc->field){
            $filterOptions = \WrReferencesFilterModel::findByFilter($dc->field);
        } else{
            $filterOptions = \WrReferencesFilterModel::findAll();
        }

        if($filterOptions){
            while ($filterOptions->next()){
                $listValues[$filterOptions->alias]=$filterOptions->title;
            }
            arsort($listValues);
        }
        return $listValues;
    }

    public function generateLabel($values, $label, DataContainer $dc){

        $filter1Label=$this->generateFilterLabel($values,'filter1');
        $filter2Label=$this->generateFilterLabel($values,'filter2');
        $filter3Label=$this->generateFilterLabel($values,'filter3');

        $labels = array(
            $values['title'], $filter1Label, $filter2Label, $filter3Label,
        );

        return $labels;
    }

    protected function generateFilterLabel($values,$field){
        $filter = Contao\StringUtil::deserialize($values[$field]);
        $filterLabel = '';
        if(is_array($filter)){
            $first = true;
            foreach($filter as $value){
                $filterValue = \WrReferencesFilterModel::findByAlias($value)->title;
                $filterLabel .= ($first)?$filterValue: ", ".$filterValue;
                $first = false;
            }
        } elseif(is_string($filter)){
            $filterLabel=\WrReferencesFilterModel::findByAlias($values[$field])->title;
        } else{
            $filterLabel = '';
        }
        return $filterLabel;
    }
}
