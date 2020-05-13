<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel xing\article\models\search\ArticleRecommendSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '推荐位';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-recommend-index form-inline">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('增加', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 不显示搜索框 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'recommendId',
            'title',
            'createTime',
            'updateTime',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
        ],
    ]); ?>
</div>
