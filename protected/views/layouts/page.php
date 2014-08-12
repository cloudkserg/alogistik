<?php
$this->registerPackage('jquery');
$this->registerPackage('/js/html5.js');
$this->registerScriptFile('/js/PaginatorAjax.js');

$this->registerCssFile('/css/reset.css');
$this->registerCssFile('/css/typography.css');
$this->registerCssFile('/css/style.css');

?>
<!DOCTYPE html>
<head>	
    <meta charset="utf-8" />		
    <title><?= $this->pageTitle ?></title>
	<link rel="shortcut icon" href="/favicon.png"/>
</head>
<body>
    <!-- wrapper (начало)-->
    <div id="wrapper" class="wrapper__bgTop">
        <div class="wrapper__bgBottom">
            <?php $this->renderPartial('protected.views.layouts.elements.header_page'); ?>
            <section class="middle hidden">
                <div class="middle__content">
                    <?=$content?>
                </div>
            </section>
            <?php $this->renderPartial('protected.views.layouts.elements.footer_page'); ?>
        </div>
    </div>
    <!-- wrapper конец-->
</body>
</html>