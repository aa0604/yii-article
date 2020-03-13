<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model xing\article\models\Article */

$this->title = '增加文章';
$this->params['breadcrumbs'][] = ['label' => '内容管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">

、
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
