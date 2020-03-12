<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model xing\article\models\Article */

$this->title = '增加Article';
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
