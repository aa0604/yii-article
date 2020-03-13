<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model xing\article\models\search\ArticleRecommendSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-recommend-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'recommendId') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'createTime') ?>

    <?= $form->field($model, 'updateTime') ?>

    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-default']) ?>
        <div class="help-block"></div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
