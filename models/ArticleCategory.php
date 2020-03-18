<?php

namespace xing\article\models;

use xing\article\logic\ArticleUrlLogic;
use xing\upload\UploadYiiLogic;
use Yii;

/**
 * This is the model class for table "article_category".
 *
 * @property int $categoryId 栏目id
 * @property string $name 栏目名称
 * @property int $parentId 栏目上级id
 * @property string $childrenIds 子id
 * @property string $model 文章模型
 * @property string $url 指定链接
 * @property string $image 栏目图片
 * @property int $display 是否显示：1是0否
 * @property int $sorting 排序，降序
 * @property string $dir 目录名
 * @property string $categoryTemplate 模板名
 * @property string $articleTemplate 模板名
 * @property int $createTime 创建时间
 * @property int $updateTime 修改时间
 *
 * @property string $regionName 地方栏目名称
 *
 * @property Article[] $articles
 */
class ArticleCategory extends \xing\helper\yii\BaseActiveModel
{

    public $regionName;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parentId', 'sorting', 'createTime', 'updateTime', 'display'], 'integer'],
            [['name'], 'string', 'max' => 300],
            [['url'], 'string', 'max' => 500],
            [['childrenIds'], 'string', 'max' => 10000],
            [['image'], 'string', 'max' => 200],
            [['dir'], 'string', 'max' => 20],
            [['model'], 'string', 'max' => 30],
            [['categoryTemplate', 'articleTemplate'], 'string', 'max' => 200],
            ['parentId', 'default', 'value' => 0],
            [['dir'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'categoryId' => '栏目id',
            'name' => '栏目名称',
            'parentId' => '栏目上级id',
            'dir' => '栏目目录',
            'categoryTemplate' => '栏目模板',
            'articleTemplate' => '文章模板',
            'childrenIds' => '子id',
            'model' => '文章模型',
            'url' => '指定链接',
            'image' => '栏目图片',
            'display' => '是否显示：1是0否',
            'sorting' => '排序，降序',
            'createTime' => '创建时间',
            'updateTime' => '修改时间',
        ];
    }

    /**
     * @return \db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['categoryId' => 'categoryId']);
    }


    public function afterFind()
    {
        parent::afterFind();
        (empty($this->url) && !empty($this->dir)) && $this->url = ArticleUrlLogic::categoryDirByUrl($this->dir);
    }

    /**
     * @param int $parentId
     * @param bool $showEmpty
     * @return array
     */
    public static function dropDownTrue($parentId = 0, $showEmpty = false)
    {
        $data = static::readCategoryTrue($parentId);
        $return = [];
        if ($showEmpty) $return['0'] = is_string($showEmpty) ? $showEmpty : '作为一级栏目';
        if (empty($data)) return $return;

        return static::_dropDownTrue($data);
    }

    /**
     * @param $data
     * @param string $fh
     * @return array
     */
    public static function _dropDownTrue($data, $fh = '')
    {
        static $return, $nnn;
        $fh .= '| ';
        if (empty($data)) return [];
        foreach ($data as $v) {
            $return[$v['categoryId']] =  $fh. $v['name'];
            if (isset($v['data']) && !empty($v['data'])) static::_dropDownTrue($v['data'], $fh);
            $nnn ++;
        }
        if ($nnn >= 1000) exit('循环了1000次，应该没这么多栏目吧？为避免造成无限循环，终止程序了');
        return $return;
    }

    /**
     * 读取栏目树
     * @param int $parentId
     * @param bool $bindIndex
     * @return array|\db\ActiveRecord[]
     */
    public static function readCategoryTrue($parentId = 0, $bindIndex = false, $childrenKey = 'data')
    {
        $m = self::find()->where(['parentId' => $parentId])->asArray()->orderBy(['sorting' => SORT_DESC]);
        if ($bindIndex) $m->indexBy('categoryId');
        $data = $m->all();
        if (empty($data)) return $data;

        static $nnn;
        if (++$nnn > 100) exit('无限循环？');

        # 获取子栏目：如果有下级结构，则读取下级结构，否则读取属性值
        foreach ($data as $k => $v) {
            $data[$k]['image'] = UploadYiiLogic::getDataUrl($v['image']);
            if (!empty($v['childrenIds'])) {
                $data[$k]['data'] = static::readCategoryTrue($v['categoryId']);
            }
        }
        return $data;
    }

    /**
     * 更新一条线上的所有父子关系
     * @param $m
     * @throws \Exception
     */
    public static function updateAllChildren($m)
    {
        $helper = \xing\helper\yii\ARObjectHelper::model($m);
        $topId = $helper->getTopParentId('parentId', $m->categoryId);
        $helper->updateAllChildren('parentId', 'childrenIds', $topId);
    }

    /**4
     * 读取
     * 所有子id
     * @param $categoryId
     * @return string
     * @throws \Exception
     */
    public static function readAllChildren($categoryId)
    {
        $helper = \xing\helper\yii\ARObjectHelper::model(new self);
        $ids = $helper->getChildren('parentId', $categoryId);
        return $ids ? $ids . ',' . $categoryId : '';
    }

    /**
     * 读取栏目名称
     * @param $categoryId
     * @return string
     */
    public static function readByName($categoryId)
    {
        return static::readFieldValue('name', $categoryId);
    }

    /**
     * 根据栏目目录名返回数据
     * @param $dir
     * @return Category|null
     */
    public static function dirByCategory($dir)
    {
        $dir = preg_replace('/(.*)\//', '', $dir);
        return self::findOne(['dir' => $dir]);
    }

    /**
     * 根据栏目目录名返回栏目id
     * @param $dir
     * @return int|null
     */
    public static function dirByCategoryId($dir)
    {
        return static::dirByCategory($dir)->categoryId ?? null;
    }

    /**
     * 读取栏目数据
     * @param int $parentId 从哪个栏目开始读取
     * @param int $display 是否显示
     * @return array|\db\ActiveRecord[]
     */
    public static function readNavBar($parentId = 0, $display = 1)
    {
        $category = self::findOne($parentId);
        if (empty($category)) return [];

        $ids = implode(',', $category->childrenIds);
        return self::find()
            ->where(['categoryId' => $ids, 'display' => $display])
            ->select('categoryId, name, dir, image')
            ->limit($number)
            ->all();
    }

    /**
     * 读取栏目数据
     * @param int $parentId 从哪个栏目开始读取
     * @param int $number 读取数据
     * @param int $display 是否显示
     * @return array|Category[]
     */
    public static function readList($parentId = 0, $number = 20, $display = 1)
    {
        return self::find()
            ->where(['parentId' => $parentId, 'display' => $display])
            ->select('categoryId, name, dir, image, url')
            ->limit($number)
            ->orderBy(['sorting' => SORT_DESC])
            ->all();
    }
}
