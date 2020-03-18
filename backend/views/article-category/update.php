<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model xing\article\models\ArticleCategory */

$this->title = '修改栏目';
$this->params['breadcrumbs'][] = ['label' => '栏目', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->categoryId]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="article-category-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
