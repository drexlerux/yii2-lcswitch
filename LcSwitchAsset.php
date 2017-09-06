<?php

namespace drexlerux\lcswitch;
use yii\web\AssetBundle;
/**
 * LcsWitch AssetBundle class for call lc switch bower-asset
 */

class LcSwitchAsset extends AssetBundle
{
    public $sourcePath = '@bower/lc-switch';
    public $js = [
        'lc_switch.min.js',
    ];

    public $css = [
        'lc_switch.css',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
