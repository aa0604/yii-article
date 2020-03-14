<?php

namespace apps\backend\controllers;

use xing\upload\UploadYiiLogic;
use Yii;

/**
 * Class UEditorController
 * 负责UEditor后台响应
 * @package crazydb\ueditor
 */
class UeditorController extends \xing\ueditor\UEditorController
{
    public $config = [
        'imagePathFormat' => '/upload/Store/{yyyy}{mm}{dd}/{time}{rand:6}',
        'scrawlPathFormat' => '/upload/Store/{yyyy}{mm}{dd}/{time}{rand:6}',
        'snapscreenPathFormat' => '/upload/Store/{yyyy}{mm}{dd}/{time}{rand:6}',
        'catcherPathFormat' => '/upload/Store/{yyyy}{mm}{dd}/{time}{rand:6}',
        'videoPathFormat' => '/upload/video/{yyyy}{mm}{dd}/{time}{rand:6}',
        'filePathFormat' => '/upload/file/{yyyy}{mm}{dd}/{rand:4}_{filename}',
        'imageManagerListPath' => '/upload/image/',
        'fileManagerListPath' => '/upload/file/',
    ];
    /**
     * 各种上传
     * @param $fieldName
     * @param $config
     * @param $base64
     * @return array
     */
    protected function upload($fieldName, $config, $base64 = 'upload')
    {
        $return = UploadYiiLogic::ApiUpload($fieldName, 'Article');
        return [
            'state' => 'SUCCESS',
            'url' => $return['url'],
            'thumbnail' => $return['url'],
            'width' => 500,
            'height' => 500
        ];
    }
}
