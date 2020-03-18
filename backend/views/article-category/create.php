<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model xing\article\models\ArticleCategory */

$this->title = '增加栏目';
$this->params['breadcrumbs'][] = ['label' => '栏目', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-category-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
