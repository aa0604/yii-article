<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model xing\article\models\Article */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '内容管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->articleId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->articleId], [
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
            'articleId',
            [
                'attribute' => 'categoryId',
                'format' => 'raw',
                'value' => function($data) {
                    $categoryName = \xing\article\models\Category::readByName($data->categoryId);
                    return Html::a($categoryName, '?categoryId=' . $data->categoryId);
                }
            ],
            'type',
            'title',
            'sorting',
            'allowComment',
            'createTime:datetime',
            'updateTime:datetime',
            [
                'label' => '文章内容',
                'format' => 'raw',
                'value' => function($data) {
                    return \xing\article\models\ArticleData::showContent($data->categoryId);
                }
            ],
        ],
    ]) ?>

</div>
