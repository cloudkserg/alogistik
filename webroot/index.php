<?php
define('ROOT_PATH', dirname(__DIR__));
//composer autolad
require_once(ROOT_PATH . '/vendor/autoload.php');

//load yii components classes
$commonParams = require_once(ROOT_PATH . '/common/config/params.php');
$environment = new Environment($commonParams);
$environment->loadYii();

//load aliases
require_once(ROOT_PATH . '/_paths.inc');

//define site
$sites = require_once(ROOT_PATH . '/common/config/sites.php');
$siteManager = new SiteManager($sites, $environment);

Yii::createWebApplication($siteManager->getYiiConfig());
//load listeners
$siteManager->onBootstrap();

//application load
Yii::app()->run();

