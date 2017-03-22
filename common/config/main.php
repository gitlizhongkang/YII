<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'session'=>[
        	'class'=>'yii\web\Session',
        	'timeout'=>3*24*3600,
	    ],
        'cache' => [
              'class' => 'yii\caching\MemCache',
              'servers' => [
                  [
                      'host' => 'localhost',
                      'port' => 11211,
                      'weight' => 60,
                  ],
                  [
                      'host' => 'localhost',
                      'port' => 11211,
                      'weight' => 40,
                  ],
             ],
          ],
    ],
    'language' => 'zh-CN',
];
