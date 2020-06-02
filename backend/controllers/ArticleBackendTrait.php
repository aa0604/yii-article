<?php

namespace xing\article\backend\controllers;

use xing\helper\text\StringHelper;
use xing\ueditor\UEditorTrait;
use Yii;
use xing\article\models\Article;
use xing\article\models\ArticleData;
use xing\article\models\search\ArticleSearch;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

trait ArticleBackendTrait
{
    use UEditorTrait;

    public $viewPath = '@xing/article/backend/views/article/';



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
                $articleData = new ArticleData();
                $articleData->load(Yii::$app->request->post());

                $model->load(Yii::$app->request->post());
                is_array($model->thumbnail) && $model->thumbnail = implode(',', $model->thumbnail);
                $model->createTime = date('Y-m-d H:i:s');
                $model->description = StringHelper::strCut(strip_tags($articleData->content), 500);
                if (!$model->save()) throw new \Exception('保存失败'. implode(',', $model->getFirstErrors()));

                $articleData->articleId = $model->articleId;
                if (!$articleData->save())
                    throw new \Exception('保存失败'. implode(',', $articleData->getFirstErrors()));

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
                $articleData = ArticleData::findOne($model->articleId);
                $articleData->load(Yii::$app->request->post());

                $model->load(Yii::$app->request->post());
                is_array($model->thumbnail) && $model->thumbnail = implode(',', $model->thumbnail);
                $model->updateTime = date('Y-m-d H:i:s');
                empty($model->description) && $model->description = StringHelper::strCut(strip_tags($articleData->content), 500);
                if (!$model->save()) throw new \Exception('保存失败'. implode(',', $model->getFirstErrors()));

                $articleData->articleId = $model->articleId;
                if (!$articleData->save()) throw new \Exception('保存失败'. implode(',', $articleData->getFirstErrors()));

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