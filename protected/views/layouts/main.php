<?php
$this->registerPackage('jquery');
$this->registerScriptFile('/js/html5.js');

$this->registerCssFile('/css/style.css');
$this->registerCssFile('/css/reset.css');
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
	<title><?=$this->pageTitle?></title>
	<link rel="shortcut icon" href="/favicon.png"/>
</head>
<body>
        <?php $this->renderPartial('protected.views.layouts.elements.header_main')?>
            <section class="middle__main">
                <?=$content?>
            </section>
        <?php $this->renderPartial('protected.views.layouts.elements.footer_main');?>
        <div class="borderBottom__main"></div>
</body>
</html>