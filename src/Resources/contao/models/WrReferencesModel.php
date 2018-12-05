<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2016 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao;

class WrReferencesModel extends \Model
{

	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'tl_wr_references';

    public static function findByFilters(array $filters=array(), $arrOptions=array()){
        $t = static::$strTable;

        $arrColumns = array();
        $arrayValues = array();
        foreach($filters as $key => $value){
            $value=deserialize($value);
            if(!is_array($value) && !empty($value)){
                if(empty($arrColumns[0])){
                    $arrColumns[0]= $arrColumns[0]."$t.$key=?";
                } else{
                    $arrColumns[0]= $arrColumns[0]." AND $t.$key=?";
                }
                $arrayValues[]=$value;
            }
            elseif (is_array($value)){
                foreach($value as $v){
                    if(!is_array($v)){
                        if(empty($arrColumns[0])){
                            $arrColumns[0]= $arrColumns[0]."$t.$key LIKE ?";
                        } else{
                            $arrColumns[0]= $arrColumns[0]." AND $t.$key LIKE ?";
                        }
                        $arrayValues[]="%".$v."%";
                    }
                }
            }
        }

        if($arrayValues){
            return static::findBy($arrColumns,$arrayValues,$arrOptions);
        } else {
            return static::findAll();
        }
    }
    public static function findByFiltersAndPublished(array $filters=array(), $arrOptions=array()){
        $t = static::$strTable;

        $arrColumns = array();
        $arrayValues = array();
        foreach($filters as $key => $value){
            $value=deserialize($value);
            if(!is_array($value) && !empty($value)){
                if(empty($arrColumns[0])){
                    $arrColumns[0]= $arrColumns[0]."$t.$key=?";
                } else{
                    $arrColumns[0]= $arrColumns[0]." AND $t.$key=?";
                }
                $arrayValues[]=$value;
            }
            elseif (is_array($value)){
                foreach($value as $v){
                    if(!is_array($v)){
                        if(empty($arrColumns[0])){
                            $arrColumns[0]= $arrColumns[0]."$t.$key LIKE ?";
                        } else{
                            $arrColumns[0]= $arrColumns[0]." AND $t.$key LIKE ?";
                        }
                        $arrayValues[]="%".$v."%";
                    }
                }
            }
        }

        if($arrayValues){
            $arrayValues[] = 1;
            $arrColumns[0] = $arrColumns[0]." AND $t.published = ?";
            return static::findBy($arrColumns,$arrayValues,$arrOptions);
        } else {
            return static::findAll(array(
                'column' => array('published=?'),
                'value' => array(1)
            ));
        }
    }
}
