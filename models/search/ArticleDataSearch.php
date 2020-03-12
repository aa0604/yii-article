<?php

namespace xing\article\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use xing\article\models\ArticleData;

/**
 * ArticleDataSearch represents the model behind the search form of `xing\article\models\ArticleData`.
 */
class ArticleDataSearch extends ArticleData
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['articleId'], 'integer'],
            [['content'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ArticleData::find();
        $order = [];
        if (isset($params['sort']) && !empty($params['sort'])) {
            $order = $params['sort'];
            unset($query['sort']);
        } elseif (isset($this->primaryKey()[0]) && !empty($this->primaryKey()[0])) {
            $order = [$this->primaryKey()[0] => SORT_DESC];
        }
        $query->orderBy($order);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => false,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'articleId' => $this->articleId,
        ]);

        $query->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
