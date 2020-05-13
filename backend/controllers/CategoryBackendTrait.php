<?php


namespace xing\article\backend\controllers;

use Yii;
use xing\article\models\ArticleCategory;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

trait CategoryBackendTrait
{
    public $viewPath = '@xing/article/backend/views/article-category/';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    /**
     * Displays a single Category model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render($this->viewPath . 'view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Lists all StoreCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $list = ArticleCategory::dropDownTrue(0, false);

        return $this->render($this->viewPath . 'index', [
            'list' => $list,
        ]);
    }


    /**
     * @return string|\web\Response
     * @throws \Exception
     */
    public function actionCreate()
    {
        $model = new ArticleCategory();
        if ($model->load(Yii::$app->request->post())) {
            if (empty($_POST[$model->formName()]['url'])) $model->url = '';
            if (!$model->save()) return $this->render($this->viewPath . 'create', ['model' => $model,]);
            ArticleCategory::updateAllChildren($model);
            return $this->redirect(['index','parentId='. $model->parentId]);
        } else {
            return $this->render($this->viewPath . 'create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing StoreCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if (empty($_POST[$model->formName()]['url'])) $model->url = '';
            if (!$model->save()) return $this->render($this->viewPath . 'create', ['model' => $model,]);
            ArticleCategory::updateAllChildren($model);
            return $this->redirect(['index','parentId='. $model->parentId]);
        } else {
            return $this->render($this->viewPath . 'update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ArticleCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ArticleCategory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}