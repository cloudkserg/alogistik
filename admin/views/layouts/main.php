<?php
Yii::app()->clientScript->registerPackage('jquery');
Yii::app()->clientScript->registerPackage('admin.core');
Yii::app()->clientScript->registerPackage('admin.ajax');
?>
<!DOCTYPE HTML>
<html lang="ru-RU">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
        <title><?=$this->pageTitle?></title>

    </head>
    <body>
        <div id="wrapper">
         <?php if (!Yii::app()->user->isGuest) : ?>
                <?php echo $this->renderPartial('application.views.layouts._header'); ?>
           <?php endif; ?>
           <?=$content;?>
        </div>
        <footer>
            <p>Разработка «<a href="http://ixtlan.org" title="ixtlan">ixtlan</a>», 2011</p>
            <small>© «<a href="<?php echo GetUrl::getBaseUrl(); ?>/" title="Перейти на сайт"><?=Yii::app()->name?></a>», 2012—<?php echo date("Y"); ?></small>
        </footer>
        <div id="ajaxLoader">

        </div>
</body>
</html>
