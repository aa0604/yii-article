<?php
/**
 * Created by PhpStorm.
 * User: xing.chen
 * Date: 2018/9/18
 * Time: 0:20
 */

namespace xing\article\logic;


use xing\article\map\LanguageMap;

class LanguageLogic
{

    /**
     * 获取语言
     * @param string $key 键
     * @return mixed|null
     */
    public static function getLanguageContrast(string $key)
    {
        return LanguageMap::$languageContrast[$key] ?? null;
    }
    /**
     * 获取默认语言
     * @return string
     */
    public static function getDefaultLanguage()
    {
        return LanguageMap::LANGUAGE_DEFAULT;
    }
}