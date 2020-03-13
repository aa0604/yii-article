<?php
/**
 * Created by PhpStorm.
 * User: xing.chen
 * Date: 2017/9/26
 * Time: 19:42
 */

namespace backend\controllers;

use xing\upload\UploadYiiLogic;
use Yii;

/**
 * 本类的方法通常为某个上传部件而制作
 * Class FileUploadController
 * @package admin\controllers
 */
class FileUploadController extends \rest\Controller
{

    public function actionXing()
    {
        try {
            $return = UploadYiiLogic::ApiUpload('file', Yii::$app->request->post('module'));
            return [
                'msg' => null,
                'code' => 0,
                'url' => $return['url'],
                'attachment' => $return['saveUrl'],
            ];
        } catch (\Exception $e) {
            return ['msg' => $e->getMessage(), 'code' => 1];
        }
    }
}