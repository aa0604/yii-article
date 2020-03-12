<?php
/**
 * Created by PhpStorm.
 * User: xing.chen
 * Date: 2018/9/18
 * Time: 0:08
 */

namespace xing\article\map;


class LanguageMap
{

    # 默认语言（关系到入库，和相关默认字段）
    const LANGUAGE_DEFAULT = 'zh-CN';

    // 语言键转换对照键值
    public static $languageContrast = [
        'zh' => 'zh-CN',
        'en' => 'en-US',
        'en-US' => 'en-US',
        'zh-Hans' => 'zh-CN',
        'zh-CN' => 'zh-CN',
        'zh-cn' => 'zh-CN',
        'zh-HK' => 'zh-HK',
        'zh-TW' => 'zh-HK',
        'zh-Hant' => 'zh-HK',
        'it' => 'it-IT',
        'it-IT' => 'it-IT',
        'fr' => 'fr-FR',
        'fr-FR' => 'fr-FR',
        'ru' => 'ru-RU',
        'ru-RU' => 'ru-RU',
        'es' => 'es-ES',
        'es-ES' => 'es-ES',
        'ja' => 'ja-JP',
        'ja-JP' => 'ja-JP',
        'de' => 'de-DE',
        'de-DE' => 'de-DE',
    ];

    // 语言配置
    public static $language = [
        'en-US' => '英文',
        'zh-CN' => '简体中文',
        'zh-HK' => '繁体中文',
        'it-IT' => '意大利语',
        'fr-FR' => '法语',
        'ru-RU' => '俄语',
        'es-ES' => '西班牙语',
        'ja-JP' => '日语',
        'de-DE' => '德语'
    ];

}