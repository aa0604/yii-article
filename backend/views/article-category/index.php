<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel xing\article\models\search\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '栏目管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-category-index form-inline">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('增加', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <table class="table table-striped table-bordered"><thead>
        <tr>
            <th>栏目id</th>
            <th>栏目名称</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($list as $categoryId => $name) { ?>
        <tr data-key="2">
            <td><?=$categoryId?></td>
            <td>
                <?=Html::a($name, ['/article/article/index', 'ArticleSearch' => ['categoryId' => $categoryId]])?>
            </td>
            <td>
                <a href="/article/article-category/update?id=<?=$categoryId?>" title="更新" aria-label="更新" data-pjax="0"></a>
                <a href="/article/article-category/delete?id=<?=$categoryId?>" title="删除" aria-label="删除" data-pjax="0" data-confirm="您确定要删除此项吗？" data-method="post"><span class="glyphicon glyphicon-trash"></span></a>
            </td>
        </tr>
        <?php }?>
        </tbody></table>
</div>
