<?php


namespace Wr\ReferencesBundle\Reference;

use Contao\File;
use Contao\FilesModel;

class Reference
{

    public $ReferenceModel;

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

    public function __construct($Reference, array $size = NULL)
    {

        $this->ReferenceModel = $Reference;

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
        $this->titleImageSize = $size;
        $this->galleryImageSize = $size;

        if($this->singleSRC) {

            $titleImageModel = FilesModel::findByUuid($this->singleSRC);

            if($titleImageModel->path) {

                $titleImageFile = new File($titleImageModel->path);

                $this->titleImage = self::generateImage($titleImageFile->path,$this->titleImageSize,$this->imageFactory);

            }

        }

        $uuids = deserialize($Reference->gallerySRC);
        foreach ($uuids as $uuid){

            $fileObj = FilesModel::findByUuid(\StringUtil::binToUuid($uuid));

            switch ($fileObj->type){
                case 'file':
                    $this->galleryImages[] = self::generateImage($fileObj->path,$this->galleryImageSize,$this->imageFactory);
                    break;
                case 'folder':
                    $subFilesObj = FilesModel::findByPid($fileObj->uuid);
                    foreach($subFilesObj as $subFileObj){
                        if($subFileObj->type === 'folder') break;
                        $this->galleryImages[] = self::generateImage($subFileObj->path,$this->galleryImageSize,$this->imageFactory);
                    }
                    break;
            }
        }
    }

    static function generateImage($ImagePath, $size, $imageFactory){
        if(!empty($ImagePath)) {

            $ImageFile = new File($ImagePath);

            if($ImageFile->exists() && $ImageFile->isImage && is_array($size)){
                return $imageFactory->create(TL_ROOT . "/" . rawurldecode($ImageFile->path), $size)->getUrl(TL_ROOT);
            } elseif(file_exists(TL_ROOT.'/'.$ImageFile->path)){
                return $ImageFile->path;
            }

        }
        return '';
    }
}