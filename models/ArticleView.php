<?php

namespace xing\article\models;

use xing\helper\exception\ModelYiiException;
use Yii;

/**
 * This is the model class for table "article_view".
 *
 * @property int $articleId
 * @property int $all 总浏览次数
 * @property int $year 年浏览次数
 * @property int $month 月浏览次数
 * @property int $day 日浏览次数
 * @property int $yearUpdateTime 年浏览上次更新时间
 * @property int $monthUpdateTime 月浏览上次更新时间
 * @property int $dayUpdateTime 日浏览上次更新时间
 *
 * @property Article $article
 */
class ArticleView extends \xing\helper\BaseActiveModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_view';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['articleId'], 'required'],
            [['articleId', 'all', 'year', 'month', 'day', 'yearUpdateTime', 'monthUpdateTime', 'dayUpdateTime'], 'integer'],
            [['articleId'], 'exist', 'skipOnError' => true, 'targetClass' => Article::className(), 'targetAttribute' => ['articleId' => 'articleId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'articleId' => 'Article ID',
            'all' => '总浏览次数',
            'year' => '年浏览次数',
            'month' => '月浏览次数',
            'day' => '日浏览次数',
            'yearUpdateTime' => '年浏览上次更新时间',
            'monthUpdateTime' => '月浏览上次更新时间',
            'dayUpdateTime' => '日浏览上次更新时间',
        ];
    }

    /**
     * @return \db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['articleId' => 'articleId']);
    }

    /**
     * @param $articleId
     * @return ArticleView|null
     */
    public static function one($articleId)
    {
        return self::findOne($articleId);
    }

    /**
     * 增加查看次数
     * @param $articleId
     * @param int $number
     * @return ArticleView|int|null
     * @throws ModelYiiException
     * @throws \Exception
     */
    public static function addViewNumber($articleId, $number = 1)
    {

        $m = self::one($articleId) ?: new self;
        $m->articleId  = $articleId;

        $time = time();

        // 更新年
        if ($m->yearUpdateTime != date('Y', $time)) {
            $m->year = 0;
            $m->yearUpdateTime = date('Y', $time);
        }
        // 更新月
        if ($m->monthUpdateTime != intval(date('m', $time))) {
            $m->month = 0;
            $m->monthUpdateTime = intval(date('m', $time));
        }
        // 更新日
        if ($m->dayUpdateTime != intval(date('d', $time))) {
            $m->day = 0;
            $m->dayUpdateTime = intval(date('d', $time));
        }
        $m->all += $number;
        $m->year += $number;
        $m->month += $number;
        $m->day += $number;
        if (!$m->save()) throw new ModelYiiException($m);
        return $m;
    }
}
