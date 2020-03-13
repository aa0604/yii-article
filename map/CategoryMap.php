<?php
/**
 * Created by PhpStorm.
 * User: xing.chen
 * Date: 2018/9/17
 * Time: 20:33
 */

namespace xing\article\map;


class CategoryMap
{

    // 栏目模板
    public static $categoryTemplate = [
        'lists' => '列表页',
        'category-index' => '栏目首页',
    ];

    // 文章模板
    public static $articleTemplate = [
        'view' => '默认模板',
    ];

    // 新闻栏目目录名
    public static $newCategoryDir = 'zhenghunjiaoyou';
    // 新闻栏目 id
    public static $newCategoryId = 3;
}