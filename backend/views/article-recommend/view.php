<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model xing\article\models\ArticleRecommend */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '推荐位', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-recommend-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->recommendId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->recommendId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定删除吗？',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'recommendId',
            'title',
            'createTime:datetime',
            'updateTime:datetime',
        ],
    ]) ?>

</div>
