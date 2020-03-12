<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model xing\article\models\Category */

$this->title = '增加Article Category';
$this->params['breadcrumbs'][] = ['label' => 'article Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-category-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
