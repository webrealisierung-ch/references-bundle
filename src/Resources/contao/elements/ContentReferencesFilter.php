<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2016 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao;

/**
 * Front end content element "References List".
 *
 * @author Webrealisierung GmbH <https://webrealisierung.ch>
 */
class ContentReferencesFilter extends \ContentElement
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_wr_references_filter';


    public function generate()
    {
        if (TL_MODE == 'BE') {
            /** @var \BackendTemplate|object $objTemplate */
            $objTemplate = new \BackendTemplate('be_wildcard');

            $objTemplate->wildcard = '### References Filters ###';

            return $objTemplate->parse();
        }

        return parent::generate();

    }


	/**
	 * Generate the content element
	 */


	protected function compile()
    {
        \System::loadLanguageFile('tl_wr_references');

        $getFilters=deserialize($this->tl_references_filters);
        $selectFields="";
        foreach($getFilters as $filter){
            \Input::setPost($filter, \Input::Post($filter));
            $selectedValue=\Input::Post($filter);
            $filterValues=\WrReferencesFilterModel::findByFilter($filter);
            $selectField="<select name='".$filter."' onchange='wrrefertenzform.submit()'><option value='default'>".$GLOBALS['TL_LANG']['tl_wr_references'][$filter][0]."</option>";
            foreach($filterValues as $filterValue){
                if($selectedValue===$filterValue->alias){
                    $selected=" selected";
                }else{
                    $selected="";
                }
                $selectField .= "<option value='".$filterValue->alias."'".$selected.">".$filterValue->title."</option>";
            }
            $selectField .= "</select>";
            $selectFields .= $selectField;
        }
        $this->Template->href = $this->generateFrontendUrl($GLOBALS['objPage']->row());
        $this->Template->selectFilters=$selectFields;
        return;
    }
}
