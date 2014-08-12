<?php

$site = dirname(__FILE__);
Yii::setPathOfAlias('site', $site);
Yii::setPathOfAlias('common', $site . '/common');
Yii::setPathOfAlias('admin', $site . '/admin');
Yii::setPathOfAlias('protected', $site . '/protected');

Yii::setPathOfAlias('vendor', $site . '/vendor/');

//packages
Yii::setPathOfAlias('xtlan', $site . '/vendor/xtlan');
Yii::setPathOfAlias('cms', $site . '/vendor/xtlan/cms'); 
