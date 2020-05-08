<?php

namespace xing\article\models;

use common\modules\user\UserSqcTask;
use PHPUnit\Framework\StaticAnalysis\HappyPath\AssertNotInstanceOf\A;
use xing\article\logic\ArticleUrlLogic;
use Yii;

/**
 * This is the model class for table "article".
 *
 * @property int $articleId 主键自增id
 * @property int $categoryId 栏目
 * @property int|null $userId 发表用户
 * @property string $title 标题
 * @property int|null $type 文章类型
 * @property int|null $status 状态：1正常 0禁止显示
 * @property int|null $voteUp 赞数量
 * @property string|null $keywords 关键词
 * @property string|null $description 描述
 * @property int|null $sorting 排序
 * @property string|null $model 文章模型（继承相应栏目）
 * @property int|null $allowComment 是否允许评论，1是0否
 * @property int|null $commentNumber 评论数量
 * @property string|null $url 指定链接
 * @property string|null $thumbnail 缩略图
 * @property string|null $createTime 创建时间
 * @property string|null $updateTime 修改时间
 * @property string|null $template 使用模板，留空则使用栏目设置的模板
 *
 * @property Category $category
 * @property ArticleData $articleData
 * @property User $author
 * @property ArticleView $articleView
 */
class Article extends \xing\helper\yii\BaseActiveModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['categoryId', 'userId', 'type', 'status', 'sorting', 'allowComment', 'recommendId', 'voteUp', 'commentNumber'], 'integer'],
            [['createTime', 'updateTime'], 'safe'],
            [['title'], 'string', 'max' => 300],
            [['keywords'], 'string', 'max' => 100],
            [['description', 'url'], 'string', 'max' => 500],
            [['model'], 'string', 'max' => 30],
            [['thumbnail'], 'string', 'max' => 200],
            [['template'], 'string', 'max' => 2000],
            [['categoryId'], 'exist', 'skipOnError' => true, 'targetClass' => ArticleCategory::className(), 'targetAttribute' => ['categoryId' => 'categoryId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'articleId' => 'id',
            'categoryId' => '栏目',
            'userId' => '发表用户',
            'title' => '标题',
            'type' => '文章类型',
            'status' => '状态',
            'voteUp' => '赞数量',
            'recommendId' => '推荐位',
            'keywords' => '关键词',
            'description' => '描述',
            'sorting' => '排序',
            'model' => '文章模型',
            'allowComment' => '允许评论',
            'commentNumber' => '评论数量',
            'url' => '指定链接',
            'thumbnail' => '缩略图',
            'createTime' => '创建时间',
            'updateTime' => '修改时间',
            'template' => '使用模板',
        ];
    }

    public function beforeSave($insert)
    {
        $insert ? $this->createTime = date('Y-m-d H:i:s') : $this->updateTime = date('Y-m-d H:i:s');
        if (is_array($this->thumbnail)) $this->thumbnail = $this->thumbnail = implode(',', $this->thumbnail);
        return parent::beforeSave($insert);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ArticleCategory::className(), ['categoryId' => 'categoryId']);
    }

    /**
     * Gets query for [[ArticleData]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticleData()
    {
        return $this->hasOne(ArticleData::className(), ['articleId' => 'articleId']);
    }

    /**
     * Gets query for [[ArticleView]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticleView()
    {
        return $this->hasOne(ArticleView::className(), ['articleId' => 'articleId']);
    }
    public function getArticleComment()
    {
        return $this->hasMany(ArticleComment::className(), ['articleId' => 'articleId']);
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

    /**
     * 读取文章列表（用于api输出或带附表的查询输出）
     * @param $where
     * @param $page
     * @param string $leftJoin
     * @param int $pageSize
     * @return array
     */
    public static function readList($where, $page, $leftJoin = '', $pageSize = 15)
    {
        $model = static::getModel($page, $pageSize)
            ->from(static::tableName() . ' A')
            ->where($where)
            ->orderBy(['sorting' => SORT_DESC, 'articleId' => SORT_DESC]);
        if (!empty($leftJoin)) $model->leftJoin($leftJoin);
        return $model->asArray()->all();
    }
}