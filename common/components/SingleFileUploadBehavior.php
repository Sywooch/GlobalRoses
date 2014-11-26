<?php
/**
 * Project GlobalRoses
 * File SingleFileUploadBehavior.php
 * @author Andreas Kondylis
 * @version 0.1
 * Date 11/13/14 8:29 PM
 */
namespace common\components;

use Yii;
use yii\db\BaseActiveRecord;
use yii\behaviors\AttributeBehavior;

/**
 * Class SingleFileUploadBehavior
 * @package common\components
 * @author Andreas Kondylis
 * @version 0.1
 */
class SingleFileUploadBehavior extends AttributeBehavior
{

    /**
     * @var mixed|\yii\web\UploadedFile attributeFileTmp the attribute for rendering the file input
     * widget for upload on the form
     */
    public $attributeFileTmp = 'upload_file';

    public $attributeFile = 'file';

    public $attributeFilename = 'file_name_original';

    public function events()
    {
        return [
            BaseActiveRecord::EVENT_AFTER_INSERT => 'upload',
            BaseActiveRecord::EVENT_BEFORE_UPDATE => 'check_update',
        ];
    }

    public function upload($event)
    {
        $upload_file = $this->owner->{$this->attributeFileTmp};
        if ($upload_file == null) {
            return true;
        }

        $original_name = $upload_file->name;
        $ext = end(explode('.', $original_name));

        $this->owner->{$this->attributeFile} = Yii::$app->security->generateRandomString() . ".{$ext}";
        $this->owner->{$this->attributeFilename} = $original_name;

        $path = $this->owner->getFolderPath();
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        $filePath = $this->owner->getFilePath();
        if ($upload_file->saveAs($filePath)) {
            $this->owner->{$this->attributeFileTmp} = null;
            $this->owner->save(false, [$this->attributeFile, $this->attributeFilename]);
            return true;
        }
        return false;
    }

    public function check_update($event)
    {
        $upload_file = $this->owner->{$this->attributeFileTmp};
        if ($upload_file == false) {
            return true;
        }

        $oldFilePath = $this->owner->getFilePath();
        $upload = $this->upload($event);
        @unlink($oldFilePath);
        return $upload;
    }
}
