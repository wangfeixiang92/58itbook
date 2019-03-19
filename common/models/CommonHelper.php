<?php

namespace common\models;

use Yii;

class CommonHelper
{

    /**
     * 获取资源文件地址
     * @param      $file
     * @param bool $appendTimestamp
     *
     * @return string
     */
    public static function getAssetUrl($file, $appendTimestamp = true)
    {
        if (!$file) return '';

        $basePath = Yii::getAlias('@webroot');
        $baseUrl = Yii::getAlias('@web');

        if ($appendTimestamp && ($timestamp = @filemtime("$basePath/$file")) > 0) {
            return "$baseUrl$file?v=$timestamp";
        } else {
            return "$baseUrl$file";
        }
    }

}