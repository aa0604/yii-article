<?php

namespace xing\article\models;

use Yii;

/**
 * This is the model class for table "article_recommend".
 *
 * @property int $recommendId 主键
 * @property string $title 标题
 * @property int $createTime 创建时间
 * @property int $updateTime 修改时间
 */
class ArticleRecommend extends \xing\helper\BaseActiveModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_recommend';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['createTime', 'updateTime'], 'integer'],
            [['title'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'recommendId' => '主键',
            'title' => '标题',
            'createTime' => '创建时间',
            'updateTime' => '修改时间',
        ];
    }
}
