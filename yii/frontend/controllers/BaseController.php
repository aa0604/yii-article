<?php

namespace xing\article\yii\frontend\controllers;

use xing\article\modules\user\User;
use yii\web\NotFoundHttpException;

class BaseController extends \yii\web\Controller
{
    public $userId;
    public $user;

    public function init()
    {
        $this->user = Yii::$app->user->identity;
        $this->userId = Yii::$app->user->getId();;
        parent::init();
    }


    /**
     * @param \Exception $e
     */
    public function showError($e)
    {
        if (YII_DEBUG) {
            throw $e;
        } else {
            exit($e->getMessage());
        }
    }

    public function actionError()
    {
        exit('出错了');
    }
}
