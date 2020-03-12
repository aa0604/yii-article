<?php

namespace xing\article\modules\article;

use xing\article\logic\ArticleUrlLogic;
use Yii;

/**
 * This is the model class for table "article".
 *
 * @property int $articleId 主键自增id
 * @property int $categoryId 栏目
 * @property int $type 文章类型
 * @property string $title 标题
 * @property string $template 文章模板
 * @property string $keywords 关键词
 * @property string $description 描述
 * @property int $sorting 排序
 * @property int $allowComment 是否允许评论，1是0否
 * @property string $url 指定链接
 * @property int $createTime 创建时间
 * @property int $updateTime 修改时间
 *
 * @property string $regionTitle 地域站标题
 *
 * @property Category $category
 * @property ArticleData $articleData
 * @property ArticleView $articleView
 */
class Article extends BaseActiveModel
{

    public $regionTitle;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categoryId', 'sorting', 'allowComment', 'createTime', 'updateTime', 'type'], 'integer'],
            [['title'], 'string', 'max' => 300],
            [['keywords'], 'string', 'max' => 100],
            [['description', 'url'], 'string', 'max' => 500],
            [['categoryId'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['categoryId' => 'categoryId']],
            [['template'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'articleId' => '文章id',
            'categoryId' => '栏目',
            'type' => '文章类型',
            'title' => '标题',
            'template' => '文章模板',
            'keywords' => '关键词',
            'description' => '描述',
            'sorting' => '排序',
            'allowComment' => '是否允许评论，1是0否',
            'url' => '指定链接',
            'createTime' => '创建时间',
            'updateTime' => '修改时间',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['categoryId' => 'categoryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticleData()
    {
        return $this->hasOne(ArticleData::className(), ['articleId' => 'articleId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticleView()
    {
        return $this->hasOne(ArticleView::className(), ['articleId' => 'articleId']);
    }

    public function afterFind()
    {
        empty($this->url) && $this->url = ArticleUrlLogic::articleUrl($this->articleId, $this->category->dir);
        parent::afterFind();
    }

    /**
     * @param $articleId
     * @return Article|null
     */
    public static function readInfo($articleId)
    {
        return self::findOne($articleId);
    }
}
