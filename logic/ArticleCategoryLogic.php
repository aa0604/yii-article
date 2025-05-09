<?php
/**
 * Created by PhpStorm.
 * User: xing.chen
 * Date: 2018/9/17
 * Time: 14:22
 */

namespace xing\article\logic;

use xing\article\models\ArticleCategory;
use Yii;

class ArticleCategoryLogic
{

    /**
     * 读取当前url页面的栏目id
     * @return int|null
     * @throws \Exception
     */
    public static function getCurrentCategoryId()
    {
        $dir = static::getCurrentCategoryDir();
        return ArticleCategory::dirByCategoryId($dir);
    }

    /**
     * 获取当面页面的栏目目录名
     * @return array|mixed
     * @throws \Exception
     */
    public static function getCurrentCategoryDir()
    {
        $category = Yii::$app->request->get('dir') ?: preg_replace('/(.*)\//', '', $_SERVER['REDIRECT_URL']);
        if (empty($category)) throw new \Exception('没有这个栏目');
        return $category;
    }

    public static function getCategoryPath($categoryId)
    {
        $list = [];
        $nnn = 0;
        do {
            $category = ArticleCategory::findOne($category->parentId ?? $categoryId);
            if (empty($category->parentId)) break;
            $list[] = $category->toArray();
        } while (++ $nnn < 100);
        return $list;
    }
}
