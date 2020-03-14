<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use xing\article\models\ArticleData;

/* @var $this yii\web\View */
/* @var $model xing\article\models\Article */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="article-form">

    <?php $form = ActiveForm::begin([
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
    'template' => '<label class="col-sm-2 control-label">{label}</label><div class="col-sm-8">{input}</div>',
    ],
    ]); ?>
<div class="panel panel-primary">
    <div class="panel-heading">
             </div>
    <div class="panel-body">

        <div class="form-group field-categoryId">
            <label class="col-sm-2 control-label"><label class="control-label" for="article-title">文章内容</label></label>
            <div class="col-sm-8">
                <select id="categoryid" class="form-control" name="<?=$model->formName()?>[categoryId]" aria-required="true">
                    <?php
                    foreach (\xing\article\models\Category::dropDownTrue() as $categoryId => $name) {
                        $v = \xing\article\models\Category::findOne($categoryId);
                        ?>
                        <?php if (!empty($v->childrenIds)) { ?>
                            <optgroup label="&nbsp;&nbsp;&emsp;<?=$name?>" style="font-weight: 300;color:#ccc;"><?=$name?></optgroup>
                        <?php } else { ?>
                            <option value="<?=$categoryId?>" style="color:#333;"><?=$name?></option>
                        <?php }}?>
                </select>
            </div>
        </div>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'placeholder' => '标题对搜索排名很重要，成为标题党也很重要']) ?>

        <?= $form->field($model, 'keywords')->textInput(['placeholder' => '以英文逗号或空格分隔，一般最多不要超过7个']) ?>

        <?= $form->field($model, 'description')->textarea(['maxlength' => true, 'placeholder' => '描述，写不写都可以，以后程序会自动生成，不超500字']) ?>

        <div class="form-group field-article-title">
            <label class="col-sm-2 control-label"><label class="control-label" for="article-title">文章内容</label></label>
            <div class="col-sm-8">
                <?= \xing\ueditor\UEditor::widget([
                    'model' => ArticleData::findOne($model->articleId ?? 0) ?: new ArticleData,
                    'attribute' => 'content',
                    'config' => [
                        //client config @see http://fex-team.github.io/ueditor/#start-config
                        'serverUrl' => [\yii\helpers\Url::to(['ueditor-config'])],//确保serverUrl正确指向后端地址
                    ]
                ]) ?>
            </div>
        </div>



        <?= $form->field($model, 'type')->dropDownList([0 => '普通文章']) ?>

    <?= $form->field($model, 'sorting')->textInput(['value' => $model->sorting ?: 0]) ?>

        <?= $form->field($model, 'allowComment')->dropDownList([1 => '是', 0 => '否']) ?>


        <div class="form-group text-center">
            <?= Html::submitButton('提交', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
</div>

    <?php ActiveForm::end(); ?>

</div>