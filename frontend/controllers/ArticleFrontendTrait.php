<?php
/**
 * Created by PhpStorm.
 * User: xing.chen
 * Date: 2018/9/16
 * Time: 23:30
 */

namespace xing\article\frontend\controllers;

use xing\helper\exception\ModelYiiException;
use xing\article\logic\TemplateLogic;
use xing\article\models\Article;
use Yii;
use xing\article\models\ArticleCategory;

trait ArticleFrontendTrait
{

    public function actionIndex()
    {

        $template = TemplateLogic::getTemplatePath('index');
        return $this->render($template, []);
    }

    public function actionLists()
    {
        try {

            $catDir = \xing\article\logic\ArticleCategoryLogic::getCurrentCategoryDir();
            $category = ArticleCategory::dirByCategory($catDir);
            if (empty($category)) throw new \Exception('没有这个栏目');

            $template = TemplateLogic::getTemplatePath($category->categoryTemplate ?: 'lists');

            return $this->render($template, ['category' => $category, 'catDir' => $catDir]);
        } catch (\Exception $e) {
            $this->showError($e);
        }
    }

    public function actionView()
    {
        try {

            $articleId = Yii::$app->request->get('articleId');
            $article = Article::readInfo($articleId);
            if (empty($article)) throw new \Exception('没有这篇文章');

            $catDir = \xing\article\logic\ArticleCategoryLogic::getCurrentCategoryDir();
            $category = ArticleCategory::dirByCategory($catDir);
            if (empty($category)) throw new \Exception('没有这个栏目');

            $templateName = $article->template ?: $category->articleTemplate ?: 'view';
            $template = TemplateLogic::getTemplatePath($templateName);

            return $this->render($template, ['catDir' => $catDir, 'article' => $article]);
        } catch (\Exception $e) {
            $this->showError($e);
        }
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