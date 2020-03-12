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
        $this->user = User::getTokenToUser();
        $this->userId = $this->user->userid ?? null;
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
