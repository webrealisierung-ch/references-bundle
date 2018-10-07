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
class ContentReferencesList extends \ContentElement
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_wr_references_list';

	public function __construct($objElement, $strColumn)
    {

        \Controller::loadDataContainer('tl_wr_references');

        parent::__construct($objElement, $strColumn);
    }

    /**
     * Remove name attributes in the back end so the form is not validated
     *
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE') {
            /** @var \BackendTemplate|object $objTemplate */
            $objTemplate = new \BackendTemplate('be_wildcard');

            $objTemplate->wildcard = '### References List ###';

            return $objTemplate->parse();
        }

        return parent::generate();

    }
        /**
	 * Generate the content element
	 */


	protected function compile()
    {

        // Get Filters as array
        $filters = $this->composeFiltersAsArray();

        $this->Template->Filters = $filters;
        $this->Template->FiltersAsJson = json_encode($filters);

        //Create Objects as Json


        //
        \Input::setGet('object', \Input::get('object'));
        $getObject=\Input::get('object');

        //Search all Filter fields in the data container
        $filter_options = array();
        $arrGetFilters = array();

        foreach($GLOBALS['TL_DCA']['tl_wr_references']['fields'] as $key => $value){
            if(preg_match("/filter/",$key)){
                $filter_options[$key]=$this->$key;
                \Input::setPost($key, \Input::Post($key));
                if(\Input::Post($key)&&\Input::Post($key)!="default"){
                    $arrGetFilters[$key]=\Input::Post($key);
                }
            }
        }

        if($getObject){
            $item = WrReferencesModel::findByAlias($getObject);
            $this->Template->Item = $item;
        }
        elseif($arrGetFilters && $this->activateFilter){
            $items = WrReferencesModel::findByFilters($arrGetFilters);
            $this->Template->Items = $items;
        }else{
            $items = WrReferencesModel::findByFilters($filter_options);
            $this->Template->Items = $items;
        }
    }

    private function composeFiltersAsArray(){

        $filters = array();

        foreach($GLOBALS['TL_DCA']['tl_wr_references']['fields'] as $key => $value){

            if(preg_match("/filter/",$key)){

                $multiple = $value['eval']['multiple'];
                $title = $value['label'][0];

                $filter = array(
                    'title' => (is_string($title)) ? $title : $key,
                    'multiple' => (is_bool($multiple)) ? $multiple : false,
                    'values' => array()
                );

                $filterObj = WrReferencesFilterModel::findByFilter($key,array('order'=>'alias DESC'));

                foreach($filterObj as $filterData){
                    $filter['values'][] = array(
                            'alias' => $filterData->alias,
                            'title' => $filterData->title,
                            'active' => false
                    );
                };

                $filters[] = $filter;

                unset($name);
                unset($multiple);

            }
        }

        return $filters;

    }

}
