<?php

namespace xing\article\models;

use Yii;

/**
 * This is the model class for table "article_vote_up".
 *
 * @property int $voteId
 * @property int $articleId 文章id
 * @property int $userId 用户
 * @property string|null $createTime 时间
 *
 * @property Article $article
 * @property User $user
 */
class ArticleVoteUp extends \xing\helper\yii\BaseActiveModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article_vote_up';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['articleId', 'userId'], 'required'],
            [['articleId', 'userId'], 'integer'],
            [['createTime'], 'safe'],
            [['articleId', 'userId'], 'unique', 'targetAttribute' => ['articleId', 'userId']],
            [['articleId'], 'exist', 'skipOnError' => true, 'targetClass' => Article::className(), 'targetAttribute' => ['articleId' => 'articleId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'voteId' => 'Vote ID',
            'articleId' => '文章id',
            'userId' => '用户',
            'createTime' => '时间',
        ];
    }

    /**
     * Gets query for [[Article]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['articleId' => 'articleId']);
    }


    public function afterSave($insert, $changedAttributes)
    {
        $update = ['voteUp' => new \yii\db\Expression('voteUp + 1')];
        $insert && Article::updateAll($update, ['articleId' => $this->articleId]);
        parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete()
    {
        Article::updateAll(['voteUp' => new \yii\db\Expression('voteUp - 1')], ['articleId' => $this->articleId]);
        parent::afterDelete();
    }
    public static function create($userId, $articleId)
    {
        $m =  new self();
        $m->articleId = $articleId;
        $m->userId = $userId;
        $m->createTime = date('Y-m-d H:i:s');
        $m->logicSave();
    }
}
