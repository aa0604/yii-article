<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model xing\article\models\ArticleRecommend */

$this->title = '修改';
$this->params['breadcrumbs'][] = ['label' => '推荐位', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->recommendId]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="article-recommend-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
