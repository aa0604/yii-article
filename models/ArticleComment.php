<?php

namespace xing\article\models;

use common\modules\user\User;
use Yii;

/**
 * This is the model class for table "article_comment".
 *
 * @property int $commentId
 * @property int $articleId 文章id
 * @property int $userId 用户
 * @property int $parentId 父id
 * @property int $status 状态
 * @property string $content 内容
 * @property string $createTime 创建日期
 *
 * @property Article $article
 * @property User $user
 */
class ArticleComment extends \xing\helper\yii\BaseActiveModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article_comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['articleId', 'userId', 'content'], 'required'],
            [['articleId', 'userId'], 'integer'],
            [['content'], 'string', 'max' => 1500],
            [['articleId'], 'exist', 'skipOnError' => true, 'targetClass' => Article::className(), 'targetAttribute' => ['articleId' => 'articleId']],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'userId']],
            [['createTime'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'commentId' => 'Comment ID',
            'articleId' => '文章id',
            'userId' => '用户',
            'parentId' => '父id',
            'status' => '状态',
            'content' => '内容',
            'createTime' => 'createTime',
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
        $where = ['articleId' => $this->articleId];
        if ($insert || ($this->status && $this->status != $this->getOldAttribute('status'))) {
            $this->createTime = date('Y-m-d H:i:s');
            // 增加
            Article::updateAll(['commentNumber' => new \yii\db\Expression('commentNumber + 1')], $where);
        } else if ($this->status != $this->getOldAttribute('status') && !$this->status) {
            // 减少
            Article::updateAll(['commentNumber' => new \yii\db\Expression('commentNumber - 1')], $where);
        }
        parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete()
    {
        Article::updateAll(['commentNumber' => new \yii\db\Expression('commentNumber - 1')], ['articleId' => $this->articleId]);
        parent::afterDelete();
    }
}
