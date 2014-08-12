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

//define app
$consoleManager = new ConsoleManager('admin', __DIR__, $environment);

//load application
Yii::createConsoleApplication($consoleManager->getYiiConfig());
$consoleManager->onBootstrap();

Yii::app()->run();



