<?php
/**
 *
 * @var \xing\article\models\Article $article
 * @var string $catDir
 * @var \xing\article\models\Category $category
 * @throws \Exception
 */

use xing\article\logic\ArticleLogic;

?>
<div class="main ption_a">
    <div id="content" class="f_l t_shadow ption_r">
        <div class="left_top_bg ption_a"></div>
        <h1 id="archive_title" class="fs24 f_w ption_r">当前位置： <a href='/'>首页</a> > <a
                    href='<?= $category->url ?>'><?= $category->regionName ?></a> > </h1>
        <?php foreach (ArticleLogic::getDataProvider(15) as $article) { ?>
            <div class="post ption_r">
                <div class="circle">
                    <div class="type"><?=date('d', strtotime($article->createTime))?><small><?=date('m', $article->createTime)?>月</small></div>
                </div>
                <h3 class="post_title fs24 f_w"><a href="<?=$article->url?>" rel="bookmark" class="dq"><?= $article->regionTitle ?></a></h3>
                <div class="meta">
                    <div class="thumb f_l"><a href="<?=$article->url?>" title="<?= $article->regionTitle ?>"><img width="126" height="126"
                                                                                                                  src="/dyc/images/defaultpic.gif"
                                                                                                                  class="attachment-post-thumbnail wp-post-image"
                                                                                                                  alt="<?= $article->keywords ?>"/></a>
                    </div>
                    <p class="meta_info"><span class="mr10">时间: <?=date('Y年m月d日', strtotime($article->createTime))?> </span> <span class="mr10">所属分类: <a href="<?=$article->category->url?>" rel="category tag" class="dq"><?=$article->category->name?></a> </span> <span class="mr10">人气<?=$article->articleView->all?></span>
                    </p>
                    <p class="meta_content"><?=\xing\article\logic\ArticleLogic::strCut($article->articleData->content)?></p>
                    <p><a class="more_link" href="<?=$article->url?>"><em>Read more >></em></a></p>
                    <div class="clear"></div>
                </div>
                <div class="comments ption_a fs20"><em><a rel="nofollow" href="<?=$article->url?>#comments"><?=$article->articleView->all?></a></em>
                </div>
            </div>
        <?php } ?>

        <div class="post ption_r">
            <div id="page_nav">
                <div class='wp-pagenavi'>
                    <?= \yii\widgets\LinkPager::widget(['pagination' => \xing\article\models\Article::getPagination()]); ?>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>

    <?= $this->render('_right', [
        'pageType' => 'list',
    ]) ?>
    <div class="clear"></div>
</div>
<div id="backtotop"><a href="javascript:void(0);">↑返回顶部</a></div>
<script type="text/javascript" src="http://www.diyuci.com/templets/default/js/base.js"></script>
</body>
</html>