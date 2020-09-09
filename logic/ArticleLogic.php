<?php
/**
 * Created by PhpStorm.
 * User: xing.chen
 * Date: 2018/9/17
 * Time: 14:56
 */

namespace xing\article\logic;


use xing\article\models\ArticleData;
use xing\helper\exception\ModelYiiException;
use xing\article\models\Article;
use xing\article\models\ArticleCategory;
use xing\article\models\ArticleView;
use xing\article\models\search\ArticleSearch;
use xing\helper\text\StringHelper;
use Yii;

class ArticleLogic
{

    public static function create($categoryId, $title, $content, $keywords, $thumb = null)
    {

        $db = Article::getDb()->beginTransaction();
        try {

            $description = StringHelper::strCut(strip_tags($content), 500);
            $article = Article::create($categoryId, $title, $keywords, $description, $thumb);
            ArticleData::create($article->articleId, $content);
            $db->commit();
            return $article;
        } catch (\Exception $e) {
            $db->rollBack();
            throw $e;
        }
    }
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
        return $categoryId ? ArticleCategory::findOne($categoryId) : null;
    }


    /**
     * 文章列表数据
     * @param int $number
     * @param null $categoryId
     * @param null $page
     * @return Article[]|array|\db\ActiveRecord[]
     * @throws \Exception
     */
    public static function getDataProvider($number = 20, $categoryId = null, $page = null)
    {
        is_null($categoryId) && $categoryId = ArticleCategoryLogic::getCurrentCategoryId();
        $category = ArticleCategory::findOne($categoryId);
        if (empty($category)) throw new \Exception('栏目不存在');

        $whereId = $category->childrenIds ? explode(',', $category->childrenIds) : $categoryId;
        is_null($page) && $page = Yii::$app->request->get('page');

        // 读取模型
        $model = static::getArticleModel($category->model);

        $list = Article::getLists(['categoryId' => $whereId, 'per-page' => $number, 'page' => $page, 'sort' => ['articleId' => SORT_DESC]]);
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
     * @param null $recommendId
     * @param array $order
     * @param int $page
     * @return Article[]|array|\db\ActiveRecord[]
     */
    public static function getList($categoryId = null, $number = 20, $recommendId = null, $order = [], $page = 1)
    {
        $where = [];
        if (!empty($categoryId)) {
            $childrenIds = ArticleCategory::findOne($categoryId)->childrenIds ?? $categoryId;
            $where['categoryId'] = explode(',', $childrenIds ?: $categoryId);
        }
        !empty($recommendId) && $where['recommendId'] = $recommendId;

        $list = Article::getModel($page, $number)
            ->orderBy($order ? $order : ['sorting' => SORT_DESC, 'articleId' => SORT_DESC])
            ->where($where)
            ->all();
        return $list;
    }

    /**
     * 获取指定文章id附近的文章
     * @param $articleId
     * @param $number
     * @param null $recommendId
     * @return Article[]|\yii\db\ActiveRecord[]
     */
    public static function getLastList($articleId, $number, $recommendId = null)
    {
        return Article::getModel(1, $number)
            ->orderBy($order ? $order : ['sorting' => SORT_DESC, 'articleId' => SORT_DESC])
            ->where(['<', 'articleId', $articleId])
            ->andFilterWhere(['recommendId' => $recommendId])
            ->all();
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