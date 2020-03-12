<?php
/**
 * Created by PhpStorm.
 * User: xing.chen
 * Date: 2018/9/17
 * Time: 14:56
 */

namespace xing\article\logic;


use xing\helper\exception\ModelYiiException;
use xing\article\models\Article;
use xing\article\models\Category;
use xing\article\models\ArticleView;
use xing\article\models\search\ArticleSearch;
use xing\helper\text\StringHelper;
use Yii;

class ArticleLogic
{

    /**
     * @param $articleId
     * @param null $categoryId
     * @return array|Article|null
     */
    public static function getLastArticle($articleId, $categoryId = null)
    {
        return Article::find()
            ->filterWhere(['categoryId' => $categoryId])
            ->andWhere(['<', 'articleId', $articleId])
            ->orderBy(['articleId' => SORT_DESC])
            ->one();
    }

    /**
     * @param $articleId
     * @param null $categoryId
     * @return array|Article|null
     */
    public static function getNextArticle($articleId, $categoryId = null)
    {
        return Article::find()
            ->filterWhere(['categoryId' => $categoryId])
            ->andWhere(['>', 'articleId', $articleId])
            ->orderBy(['articleId' => SORT_ASC])
            ->one();
    }

    /**
     * @param $articleId
     * @return Category|null
     */
    public static function getCategory($articleId)
    {
        $categoryId = Article::readInfo($articleId)->categoryId ?? null;
        return $categoryId ? Category::findOne($categoryId) : null;
    }


    /**
     * 文章列表数据
     * @param int $number
     * @param null $categoryId
     * @param null $page
     * @return $this[]|array|\yii\db\ActiveRecord[]
     * @throws \Exception
     */
    public static function getDataProvider($number = 20, $categoryId = null, $page = null)
    {
        is_null($categoryId) && $categoryId = CategoryLogic::getCurrentCategoryId();
        $category = Category::findOne($categoryId);
        if (empty($category)) throw new \Exception('栏目不存在');

        $whereId = explode(',', $category->childrenIds);
        is_null($page) && $page = Yii::$app->request->get('page');

        // 读取模型
        $model = static::getArticleModel($category->model);

        $list = Article::getLists(['categoryId' => $whereId, 'pre-page' => $number, 'page' => $page, 'sort' => ['articleId' => SORT_DESC]]);
        return $list;
    }

    public static function getArticleModel($model)
    {
        $class = '\xing\article\models\Article' . ucwords($model);
        return new $class();
    }

    /**
     * 获取文章列表
     * @param $categoryId
     * @param $number
     * @param array $sort
     * @param null $recommendId
     * @return Article[]|array|\yii\db\ActiveRecord[]
     */
    public static function getList($categoryId = null, $number = 20, $sort = ['articleId' => SORT_DESC], $recommendId = null)
    {
        $childrenIds = $categoryId ? (Category::findOne($categoryId)->childrenIds ?? null) : null;
        empty($childrenIds) && $childrenIds = $categoryId;
        $params = ['per-page' => $number, 'sort' => $sort];
        !empty($childrenIds) && $params['categoryId'] = explode(',', $childrenIds);

        $list = Article::getLists($params);
        return $list;
    }

    /**
     * 输出查看次数
     * @param $articleId
     * @return int
     * @throws \Exception
     */
    public static function showViewNumber($articleId)
    {
        $m = ArticleView::addViewNumber($articleId);
        return $m->all;
    }

    public static function strCut($content, $len = 250, $dot = '…')
    {
        return StringHelper::strCut(strip_tags($content), $len, $dot);
    }
}