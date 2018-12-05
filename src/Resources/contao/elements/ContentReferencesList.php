<?php

namespace Contao;

use Wr\ReferencesBundle\Reference\Reference;

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
        \Contao\System::loadLanguageFile('tl_wr_references');
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

        $imageSize = deserialize($this->size);

        $this->Template->size = $imageSize;

        // Get Filters as array
        $filters = $this->composeFiltersAsArray();

        $this->Template->Filters = $filters;
        $this->Template->FiltersAsJson = json_encode($filters);


        \Input::setGet('object', \Input::get('object'));
        $getObject=\Input::get('object');

        if($getObject){
            $item = WrReferencesModel::findByAlias($getObject);
            $this->Template->Item = $item;
        } elseif( $this->activateFilter){

            $arrGetFilters = array();

            foreach($GLOBALS['TL_DCA']['tl_wr_references']['fields'] as $key => $value){
                if(preg_match("/filter/",$key) && $this->$key){
                    $arrGetFilters[$key] = deserialize($this->$key);
                }
            }

            $items = WrReferencesModel::findByFiltersAndPublished($arrGetFilters);
        } else{
            $items = WrReferencesModel::findAll(array(
                'column' => array('published=?'),
                'value' => array(1)
            ));
        }

        $referenceItems = array();

        foreach($items as $item){

            if(is_array($imageSize)){
                $Reference = new Reference($item,$imageSize);
            } else{
                $Reference = new Reference($item);
            }

            $referenceItems[] = $Reference;
        }

        $this->Template->Items = $referenceItems;
    }

    private function composeFiltersAsArray(){

        $filters = array();

        foreach($GLOBALS['TL_DCA']['tl_wr_references']['fields'] as $key => $value){

            if(preg_match("/filter/",$key)){

                $multiple = $value['eval']['multiple'];
                $title = $value['label'][0];

                $filter = array(
                    'alias' => $key,
                    'title' => (is_string($title)) ? $title : $key,
                    'multiple' => (is_bool($multiple)) ? $multiple : false,
                    'values' => array(),
                    'visible' => false,
                    'active' => false,
                );

                $filterObj = WrReferencesFilterModel::findByFilter($key,array('order'=>'alias DESC'));

                foreach($filterObj as $filterData){
                    $filter['values'][] = array(
                        'alias' => $filterData->alias,
                        'title' => $filterData->title,
                        'active' => false
                    );
                };

                $filters[$key] = $filter;

                unset($name);
                unset($multiple);

            }
        }

        return $filters;

    }

}
