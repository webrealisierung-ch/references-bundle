<?php


namespace Wr\ReferencesBundle\Reference;

use Contao\File;
use Contao\FilesModel;

class Reference
{

    public $title;
    public $alias;
    public $teaser;
    public $description;
    public $singleSRC;
    public $titleImage;
    public $galleryImages = array();
    public $gallerySRC;
    public $orderSRC;
    public $filter1;
    public $filter2;
    public $filter3;
    public $published;
    public $start;
    public $stop;

    protected $titleImageSize;
    protected $galleryImageSize;

    protected $imageFactory;


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
        $this->imageFactory = \Contao\System::getContainer()->get('contao.image.image_factory');


        if($this->singleSRC) {

            $titleImageModel = FilesModel::findByUuid($this->singleSRC);

            if($titleImageModel->path) {

                $titleImageFile = new File($titleImageModel->path);

                if($titleImageFile->exists() && $titleImageFile->isImage && is_array($this->size)){
                    $this->titleImage = $this->imageFactory->create(TL_ROOT . "/" . rawurldecode($titleImageFile->path), $this->size)->getUrl(TL_ROOT);
                } elseif(file_exists(TL_ROOT.'/'.$titleImageFile->path)){
                    $this->titleImage = $titleImageModel->path;
                }
            }

        }

        $uuids = deserialize($Reference->gallerySRC);
        foreach ($uuids as $uuid){

            $fileObj = FilesModel::findByUuid(\StringUtil::binToUuid($uuid));
            switch ($fileObj->type){
                case 'file':
                    $this->galleryImages[] = new File($fileObj->path);
                    break;
                case 'folder':
                    $subFilesObj = FilesModel::findByPid($fileObj->uuid);
                    foreach($subFilesObj as $subFileObj){
                        if($subFileObj->type === 'folder') break;
                        $this->galleryImages[] = new File($subFileObj->path);
                    }
                    break;
            }
        }
    }

    public function setTitleImageSize(array $size){
        $this->titleImageSize = $size;
    }

    public function setGalleryImageSize(array $size){
        $this->galleryImageSize = $size;
    }

}