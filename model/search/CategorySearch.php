<?php

namespace xing\article\modules\article\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use xing\article\modules\article\Category;

/**
 * ArticleCategorySearch represents the model behind the search form of `common\models\article\ArticleCategory`.
 */
class CategorySearch extends Category
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categoryId', 'parentId', 'sorting', 'createTime', 'updateTime'], 'integer'],
            [['name', 'childrenIds', 'image', 'display'], 'safe'],
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
        $query = Category::find();
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
            'categoryId' => $this->categoryId,
            'parentId' => $this->parentId,
            'sorting' => $this->sorting,
            'createTime' => $this->createTime,
            'updateTime' => $this->updateTime,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'childrenIds', $this->childrenIds])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'display', $this->display]);

        return $dataProvider;
    }
}
