<?php

namespace xing\article\api\controllers;

use xing\ueditor\UEditorTrait;
use Yii;
use xing\article\models\Article;
use xing\article\models\ArticleData;
use xing\article\models\search\ArticleSearch;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

trait ArticleApiTrait
{
    use UEditorTrait;

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
     * Lists all article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render($this->viewPath . 'index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single article model.
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
     * @return string|\web\Response
     * @throws \Exception
     */
    public function actionCreate()
    {
        $model = new Article();

        if (Yii::$app->request->isPost) {

            $db = $model::getDb()->beginTransaction();
            try {

                $model->load(Yii::$app->request->post());
                $model->createTime = date('Y-m-d H:i:s');
                if (!$model->save()) throw new \Exception('保存失败');

                $articleData = new ArticleData();
                $articleData->load(Yii::$app->request->post());
                $articleData->articleId = $model->articleId;
                if (!$articleData->save()) throw new \Exception('保存失败');

                $db->commit();

                return $this->redirect(['index']);
            } catch (\Exception $e) {
                $db->rollBack();
                $this->showError($e);
            }
        }

        return $this->render($this->viewPath . 'create', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @return string|\web\Response
     * @throws NotFoundHttpException
     * @throws \Exception
     * @throws \db\Exception
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isPost) {

            $db = $model::getDb()->beginTransaction();
            try {

                $model->load(Yii::$app->request->post());
                $model->updateTime = date('Y-m-d H:i:s');
                if (!$model->save()) throw new \Exception('保存失败');

                $articleData = ArticleData::findOne($model->articleId);
                $articleData->load(Yii::$app->request->post());
                $articleData->articleId = $model->articleId;
                if (!$articleData->save()) throw new \Exception('保存失败');

                $db->commit();

                return $this->redirect(['index']);
            } catch (\Exception $e) {
                $db->rollBack();
                $this->showError($e);
            }
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
            // return $this->redirect(['view', 'id' => $model->articleId]);
        }

        return $this->render($this->viewPath . 'update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing article model.
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
     * Finds the article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}