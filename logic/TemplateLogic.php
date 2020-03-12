<?php
/**
 * Created by PhpStorm.
 * User: xing.chen
 * Date: 2018/9/17
 * Time: 14:22
 */

namespace xing\article\logic;


class TemplateLogic
{

    public static function getArticleTemplate()
    {

    }

    public static function getTemplatePath($templateName, $type = '')
    {
        return 'default/'.$templateName.'.php';
    }
}