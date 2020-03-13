
<?php
use xing\article\modules\site\Region;
use \xing\article\modules\group\logic\GroupUserLogic;


$aboutContent = '<p>有效的扩大自己的社交圈，比如你在' .($region->name ?? '你家附近'). '认识有100个朋友，你一定过得很比较开心。</p>';

$footerContent = '<p>群里都是附近的人，定期举行活动，有效应扩大你的交际圈子</p>';
?>

<div id="sidebar" class="f_l ption_r">
    <div class="right_top_bg ption_a"></div>
    <div class="box"><h3 class="box_title ption_r mb20 f_l"><span class="15953980198">关于我们</span></h3>
        <div class="box_content ption_r" id="about">
            <?= $aboutContent ?>

        </div>
    </div>
    <div class="box"><h3 class="box_title mb20 f_l"><span class="15953980198">推荐微信群</span></h3>
        <div class="box_content" id="hot">
            <ul>
                <?php foreach (\xing\article\modules\site\SiteRegion::getGoodCity( 5) as $v) {?>

                    <li><a href="/wangzhantuiguang/151.html" title="SEM《地域词精确匹配》" class="dq"><?=$v->name?>交友微信群</a> <small>
                           马上进入获取<?=$v->name?>交友微信群二维码
                        </small></li>
                <?php }?>

            </ul>
        </div>
    </div>
    <?php if (isset($pageType) && $pageType != 'group') { ?>
        <div class="box"><h3 class="box_title mb20 f_l"><span class="15953980198">最新加入</span></h3>
            <div class="box_content r_comments">
                <ul id="rcslider">
                    <?php foreach (GroupUserLogic::region2list($siteRegion->regionId ?? 0) as $v) {?>
                        <li><img src='<?=\xing\upload\UploadYiiLogic::getDataUrl($v['avatar'])?>' class='avatar avatar-32 photo' height='32' width='32'/>
                            <?=$v['nickname']?> <?=$v['sex'] ? '男' : '女'?> <?=substr($v['birthDay'], 2, 2)?>年
                            <br class="dq">
                            加入时间：<?=$v['joinTime']?>
                            <br>
                        </li>
                    <?php }?>

                    <div class="feat_bottom_line"></div>
                </ul>
            </div>
        </div>
    <?php } ?>
    <div class="box"><h3 class="box_title mb20 f_l"><span class="15953980198">分站入口</span></h3>
        <div class="box_content" id="link">
            <div class="link_category l_r">
                <ul class='xoxo blogroll'>
                    <?php foreach (\xing\article\modules\site\SiteRegion::getGoodCity() as $v) { ?>
                        <li><a href="<?= $v->url ?>"><?=$v->name?>></a></li>
                    <?php }?>
                </ul>
            </div>
        </div>
    </div>
    <div id="float" class="box">
        <div class="footer">

            <?= $footerContent ?>

            <?php if (isset($pageType) && $pageType == '111') { ?>

            <p><a href="http://seo.chinaz.com/www.jywxq.com" target="_blank">站长查询</a> | <a
                        href="https://www.aizhan.com/cha/www.jywxq.com" target="_blank">爱站查询</a></p></div>
            <?php } ?>
    </div>
</div>
