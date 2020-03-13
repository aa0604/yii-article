<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model xing\article\models\ArticleRecommend */

$this->title = '增加Article Recommend';
$this->params['breadcrumbs'][] = ['label' => 'article Recommends', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-recommend-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
