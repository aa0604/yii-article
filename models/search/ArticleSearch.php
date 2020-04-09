<?php

namespace xing\article\models\search;

use xing\article\models\ArticleCategory;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use xing\article\models\Article;

/**
 * ArticleSearch represents the model behind the search form of `xing\article\models\Article`.
 */
class ArticleSearch extends Article
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['articleId', 'categoryId', 'sorting', 'allowComment', 'createTime', 'updateTime', 'userId', 'status'], 'integer'],
            [['type', 'title', 'content'], 'safe'],
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
        $query = Article::find();
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
            'type' => $this->type,
            'sorting' => $this->sorting,
            'allowComment' => $this->allowComment,
            'createTime' => $this->createTime,
            'updateTime' => $this->updateTime,
            'userId' => $this->userId,
            'status' => $this->status,
        ]);
        
        if (!empty($this->categoryId))
            $query->andWhere(['categoryId' => ArticleCategory::readAllChildren($this->categoryId)]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
