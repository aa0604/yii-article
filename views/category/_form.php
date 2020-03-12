<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model xing\article\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-category-form">

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

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'parentId')->dropDownList(\xing\article\models\Category::dropDownTrue(0, true),['value' => $model->parentId ?: '0']) ?>
        <?= $form->field($model, 'dir')->textInput(['maxlength' => true]) ?>

        <?=$form->field($model, 'image')->widget('xing\webuploader\yii2\FileInput')?>

        <?= $form->field($model, 'categoryTemplate')->dropDownList(\common\map\article\CategoryMap::$categoryTemplate) ?>

        <?= $form->field($model, 'articleTemplate')->dropDownList(\common\map\article\CategoryMap::$articleTemplate) ?>

        <?= $form->field($model, 'display')->dropDownList([1 => '是', 0 => '否']) ?>

        <?= $form->field($model, 'sorting')->textInput(['value' => $model->sorting ?: '0']) ?>

        <div class="form-group text-center">
            <?= Html::submitButton('提交', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
</div>

    <?php ActiveForm::end(); ?>

</div>
