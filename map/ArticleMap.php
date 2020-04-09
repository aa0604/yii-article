<?php

namespace xing\article\map;

class ArticleMap
{
    const SUFFIX = '';
    const STATUS_SHOW = '1';
    const STATUS_CLOSE = '0';

    public static $status = [
        self::STATUS_SHOW => '显示',
        self::STATUS_CLOSE => '不显示',
    ];
}