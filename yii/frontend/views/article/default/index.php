<?php
/* @var $this \yii\web\View */
use xing\article\modules\site\logic\SiteRegionLogic;

$this->title = SiteRegionLogic::formatRegionName('{地名}交友微信群大全官网');
$this->metaTags[] = '<meta name="keywords" content="交友微信群,活动微信群,脱单微信群"/>';
$this->metaTags[] = '<meta name="description" content="交友微信群网，专注做高质量的交友微信群，不放其他乱七八糟的群，使用小程序精准定位，拒绝异地加入同城群，为大家提供优质的微信群交友环境.."/>';
?>
<div class="main ption_a">
    <div id="content" class="f_l t_shadow ption_r">
        <div class="left_top_bg ption_a"></div>
        <div id="announcement_box" class="ption_a">
            <div id="announcement">
                <ul style="margin-top: 0px;">
                    <li><a href="/">我们专注于交友微信群</a></li>

                    <?php foreach (\xing\article\logic\ArticleLogic::getList(\xing\article\map\ArticleCategoryMap::$newCategoryId, 3) as $article) {?>
                    <li><span class="mr10"></span><a href="<?= $article->url ?>" style="font-style: normal;"><?= $article->regionTitle ?></a></li>
                    <?php } ?>

                </ul>
            </div>
            <div class="announcement_remove"><a title="关闭" href="javascript:void(0)"
                                                onClick="$('#announcement_box').slideUp('slow');"><span
                        id="announcement_close">×</span></a></div>
        </div>
        <div class="post ption_r">
            <div class="meta">
                <p class="meta_info"><a href="#">交友微信群小程序已更新至0.3.<?= date('d')?></a></p>
                <p class="meta_content">
                    现在的交友软件都很坑，使用我们的小程序，可以解决不靠谱，交友难的问题。<strong href="#">使用小程序的朋友，三个月就脱单了，还能认识到一群住附近的朋友，下班有空就约饭，生活惬意无比。</strong>
                </p>
                <p class="meta_content">
                    经过深入研究，脱单直接的阻碍是距离。不住在你家附近的朋友很难约，特别是在观察期的异性男女。
                </p>
                <p class="meta_content">
                    现在的人脱单都很难，特别是在一线城市，回来两个小时的约会是痛苦的，很多人都败在距离上。<a href="#">详情..</a>
                </p>
            </div>
        </div>
        <?php foreach (\xing\article\logic\ArticleLogic::getList() as $article) {?>
            <div class="post ption_r">
                <div class="circle">
                    <div class="type"><?=date('d', $article->createTime)?><small><?=date('m', $article->createTime)?>月</small></div>
                </div>
                <h3 class="post_title fs24 f_w"><a href="<?=$article->url?>" rel="bookmark" class="dq"><?= $article->regionTitle ?></a></h3>
                <div class="meta">
                    <div class="thumb f_l"><a href="<?=$article->url?>" title="<?= $article->regionTitle ?>"><img width="126" height="126"
                                                                                                 src="/dyc/images/defaultpic.gif"
                                                                                                 class="attachment-post-thumbnail wp-post-image"
                                                                                                 alt="<?= $article->keywords ?>"/></a>
                    </div>
                    <p class="meta_info"><span class="mr10">时间: <?=date('Y年m月d日', $article->createTime)?> </span> <span class="mr10">所属分类: <a href="<?=$article->category->url?>" rel="category tag" class="dq"><?=$article->category->name?></a> </span> <span class="mr10">人气<?=$article->articleView->all?></span>
                    </p>
                    <p class="meta_content"><?=\xing\article\logic\ArticleLogic::strCut($article->articleData->content)?></p>
                    <p><a class="more_link" href="<?=$article->url?>"><em>阅读更多 >></em></a></p>
                    <div class="clear"></div>
                </div>
                <div class="comments ption_a fs20"><em><a rel="nofollow" href="<?=$article->url?>#comments"><?=$article->articleView->all?></a></em>
                </div>
            </div>
        <?php } ?>

        <div id="page_nav222">
            <div class='wp-pagenavi'><!--分站

--></div>
        </div>
    </div>

    <?= $this->render('_right', [
        'pageType' => 'index',
    ]) ?>
    <div class="clear"></div>
</div>