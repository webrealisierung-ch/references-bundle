<?php


namespace Wr\ReferencesBundle\Reference;


class Reference
{
    public $title;
    public $alias;
    public $teaser;
    public $description;
    public $singleSRC;
    public $galleryImages = array();
    public $gallerySRC;
    public $orderSRC;
    public $filter1;
    public $filter2;
    public $filter3;
    public $published;
    public $start;
    public $stop;

    public function __construct($Reference)
    {

        $this->title = $Reference->title;
        $this->alias = $Reference->alias;
        $this->teaser = $Reference->teaser;
        $this->description = $Reference->description;
        $this->singleSRC = $Reference->singleSRC;
        $this->orderSRC = $Reference->orderSRC;
        $this->filter1 = $Reference->filter1;
        $this->filter2 = $Reference->filter2;
        $this->filter3 = $Reference->filter3;
        $this->published = $Reference->published;
        $this->start = $Reference->start;
        $this->stop = $Reference->stop;

        $this->gallerySRC = $Reference->gallerySRC;

        $uuids = deserialize($Reference->gallerySRC);
        foreach ($uuids as $uuid){

            $fileObj = \FilesModel::findByUuid(\StringUtil::binToUuid($uuid));
            switch ($fileObj->type){
                case 'file':
                    $this->galleryImages[] = new \File($fileObj->path);
                    break;
                case 'folder':
                    $subFilesObj = \FilesModel::findByPid($fileObj->uuid);
                    foreach($subFilesObj as $subFileObj){
                        if($subFileObj->type === 'folder') break;
                        $this->galleryImages[] = new \File($subFileObj->path);
                    }
                    break;
            }
        }
    }



}