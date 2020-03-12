<?php
/**
 *
 * @throws \Exception
 *@var string $catDir
 * @var \xing\article\modules\article\Category $category
 * @var \xing\article\modules\group\Group $group
 */

use xing\article\logic\ArticleLogic;
use xing\article\modules\group\GroupSearch;
use xing\article\modules\group\logic\GroupLogic;

$regionId = \xing\article\modules\site\logic\SiteRegionLogic::domain2region()->regionId ?? null;
$where = ['G.status' => \xing\article\modules\group\map\GroupMap::STATUS_OPEN];
$order = ['G.groupId' => SORT_DESC];
$page = Yii::$app->request->get('page');
$list = GroupLogic::getLists($where, $regionId, null, $order, $page);

?>
<div class="main ption_a">
    <div id="content" class="f_l t_shadow ption_r">
        <div class="left_top_bg ption_a"></div>
        <h1 id="archive_title" class="fs24 f_w ption_r">当前位置： <a href='/'>首页</a> > <a
                    href='<?= $category->url ?>'><?= $category->regionName ?></a> > </h1>
        <div class="clear"></div>
        <div class="ption_r" style="background: none; padding-left: 50px;">
            <ul>
                <?php foreach (ArticleLogic::getDataProvider(15) as $article) { ?>
                    <a href="group/view?groupId=<?=$group['groupId']?>">

                        <li style="width: 120px; height: 150px;float: left; margin: 10px;">
                            <div stle="width: 100%;">
                                <?php if (count($group['avatars']) > 3) {
                                    foreach ($group['avatars'] as $avatar) { ?>
                                        <img src="<?=\xing\article\modules\site\logic\UploadLogic::getDataUrl($avatar)?>" style="width: 30px; height: 30px; padding: 0 1px 1px;" />
                                    <?php }
                                } else {?>
                                    <img width="130" height="130"
                                         src="/images/qr-code-index.jpg"
                                         class="attachment-post-thumbnail wp-post-image"/>
                                <?php } ?>
                            </div>
                            <h6 style="overflow:hidden; height: 20px;"><strong><?=$group['name']?></strong></h6>
                        </li>
                    </a>
                <?php } ?>
            </ul>

        </div>
        <div class="clear"></div>

        <div class="post ption_r" style="padding-bottom: 100px;">

            <div class="newer_older mt10" style="width: 50%; margin: 0 auto;">
                <span class="pre_post f_l">
                    <?php if ($page > 1) { ?>
                        <a href="group?page=<?=$page - 1?>">上一页</a>
                    <?php } ?>
                </span>
                <span class="next_post f_r">
                    <?php if (!empty($list) && count($list) >= 20) { ?>
                        <a href="group?page=<?=max($page + 1, 2)?>">下一页</a>
                    <?php }  ?>
                </span>
                <div class="clear"></div>
            </div>
        </div>
    </div>

    <?= $this->render('@apps/frontend/modules/article/views/article/default/_right', [
        'pageType' => 'list',
    ]) ?>
    <div class="clear"></div>
</div>
<div id="backtotop"><a href="javascript:void(0);">↑返回顶部</a></div>
<script type="text/javascript" src="http://www.diyuci.com/templets/default/js/base.js"></script>
</body>
</html>