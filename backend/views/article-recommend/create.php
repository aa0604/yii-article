<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model xing\article\models\ArticleRecommend */

$this->title = '增加';
$this->params['breadcrumbs'][] = ['label' => '推荐位', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-recommend-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
