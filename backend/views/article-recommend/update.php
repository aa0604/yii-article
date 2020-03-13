<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model xing\article\models\ArticleRecommend */

$this->title = '修改Article Recommend: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'article Recommends', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->recommendId]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="article-recommend-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
