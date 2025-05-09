<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model xing\article\models\ArticleRecommend */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-recommend-form">

    <?php $form = ActiveForm::begin([
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
    'template' => '<label class="col-sm-2 control-label">{label}</label><div class="col-sm-5">{input}</div>',
    ],
    ]); ?>
<div class="panel panel-primary">
    <div class="panel-heading">
             </div>
    <div class="panel-body">

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>


        <div class="form-group text-center">
            <?= Html::submitButton('提交', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
</div>

    <?php ActiveForm::end(); ?>

</div>
