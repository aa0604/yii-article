<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model xing\article\models\Category */

$this->title = '修改Article Category: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'article Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->categoryId]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="article-category-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
