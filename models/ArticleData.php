<?php

namespace xing\article\models;

use Yii;

/**
 * This is the model class for table "article_data".
 *
 * @property int $articleId 主键id，关联article::id
 * @property string $content 文章内容
 *
 * @property Article $article
 */
class ArticleData extends \xing\helper\yii\BaseActiveModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['articleId', 'content'], 'required'],
            [['articleId'], 'integer'],
            [['content'], 'string'],
            [['articleId'], 'unique'],
            [['articleId'], 'exist', 'skipOnError' => true, 'targetClass' => Article::className(), 'targetAttribute' => ['articleId' => 'articleId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'articleId' => '主键id，关联article::id',
            'content' => '文章内容',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['articleId' => 'articleId']);
    }

    /**
     * 读取并格式化内容
     * @param $articleId
     * @return string
     */
    public static function showContent($articleId)
    {
        return self::findOne($articleId)->content ?? '';
    }
}
