<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model xing\article\models\Article */

$this->title = '修改Article: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->articleId]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="article-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
