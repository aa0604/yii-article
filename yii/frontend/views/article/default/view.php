<?php
/**
 *
 * @throws \Exception
 * @var string $catDir
 * @var \xing\article\modules\article\Article $article
 */
use xing\article\logic\ArticleLogic;
use xing\article\modules\site\logic\SiteRegionLogic;
$this->title = $article->regionTitle . ' - 交友微信群';
$this->metaTags[] = '<meta name="keywords" content="交友微信群,活动微信群,脱单微信群"/>';
$this->metaTags[] = '<meta name="description" content="交友微信群网，专注做高质量的交友微信群，不放其他乱七八糟的群，使用小程序精准定位，拒绝异地加入同城群，为大家提供优质的微信群交友环境.."/>';

?>
<div class="main ption_a">
    <div id="content" class="single f_l t_shadow ption_r">
        <div class="left_top_bg ption_a"></div>
        <div class="post ption_r" id="post-854">
            <div class="circle">
                <div class="single_type" class="archives_date"></div>
            </div>
            <div class="date"> <?= date('d', $article->createTime) ?> <small><?= date('m', $article->createTime) ?>月</small></div>
            <h1 class="post_title fs24 f_w"><?= $article->regionTitle ?></h1>
            <div class="meta">
                <div class="meta_info">
                    <div class="f_l">
                    <span class="mr10">当前位置：
                        <a href='/'>首页</a> >
                        <a href='<?=$article->category->url?>'><?=$article->category->name?></a></span>
                        <span class="mr10"> 人气 <?= ArticleLogic::showViewNumber($article->articleId)?> </span> <span class="mr10"> </span>
                    </div>
                    <div class="f_r">

                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="single_text">
                <div class="single_header_ads"><!--  /*686*30自定义标签云  --></div>
                <?= $article->regionTitle ?><br/>
                <?= SiteRegionLogic::formatRegionName($article->articleData->content) ?>
                <div id="share">
                    <!--MOB SHARE BEGIN-->
                    <span class=" -mob-share-open">如果这篇文章对你有帮助，请<a href="javascript: void(0)" style="color:blue">分享</a>给朋友 </span>

                    <div class="-mob-share-ui" style="display: none">
                        <ul class="-mob-share-list">
                            <li class="-mob-share-weibo"><p>新浪微博</p></li>
                            <li class="-mob-share-qzone"><p>QQ空间</p></li>
                            <li class="-mob-share-qq"><p>QQ好友</p></li>
                            <li class="-mob-share-douban"><p>豆瓣</p></li>
                            <li class="-mob-share-facebook"><p>Facebook</p></li>
                            <li class="-mob-share-twitter"><p>Twitter</p></li>
                        </ul>
                        <div class="-mob-share-close">取消</div>
                    </div>
                    <div class="-mob-share-ui-bg"></div>
                    <script id="-mob-share" src="http://f1.webshare.mob.com/code/mob-share.js?appkey=2db64cd7c19a8"></script>
                    <!--MOB SHARE END-->
                </div>
                <div class="clear"></div>
            </div>
            <div class="single_footer_ads">
                <!--<div class="single_footer_ads_border"> /*588*98自定义标签云  </div>--></div>
            <div class="clear"></div>

            <?php
            $last = ArticleLogic::getLastArticle($article->articleId);
            $next = ArticleLogic::getNextArticle($article->articleId);
            ?>
            <div class="newer_older mt10">
                <span class="pre_post f_l">
                    上一篇：
                    <?php if (!empty($last)) { ?>
                        <a href='<?= $last->url ?>'><?= $last->regionTitle ?></a>
                    <?php } else {?>
                    没有了
                    <?php } ?>
                </span>
                <span class="next_post f_r">
                    下一篇：
                    <?php if (!empty($next)) { ?>
                        <a href='<?= $next->url ?>'><?= $next->regionTitle ?></a>
                    <?php } else {?>
                        没有了
                    <?php } ?>
                </span>
                <div class="clear"></div>
            </div>
        </div>
        <div class="post ption_r">
            本文地址：<a href="<?= $article->url ?>" rel="bookmark"><?= $article->url ?></a>
            </p></div>
        <div id="page_nav222">
            <div class='wp-pagenavi'><!--分站
--></div>
        </div>
        <div class="clear"></div>
    </div>
    <?= $this->render('_right', [
        'pageType' => 'view',
    ]) ?>
    <div class="clear"></div>
</div>
<div id="backtotop"><a href="javascript:void(0);">↑返回顶部</a></div>
<script type="text/javascript" src="/js/base.js"></script>
</body>
</html>