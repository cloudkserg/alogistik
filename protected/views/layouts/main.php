<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Alfa logistic</title>

	<meta name="description" content="" />
	<meta name="author" content="" />

	<meta name="viewport" content="width=1000"/>
    
    <link rel="stylesheet" href="/css/main.css" media="all" />

    <script src="/js/detect.min.js"></script>

    <!-- favicons hell -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

    <link rel="apple-touch-icon" href="/apple-touch-icon-57x57.png" sizes="57x57">
    <link rel="apple-touch-icon" href="/apple-touch-icon-60x60.png" sizes="60x60">
    <link rel="apple-touch-icon" href="/apple-touch-icon-72x72.png" sizes="72x72">
    <link rel="apple-touch-icon" href="/apple-touch-icon-76x76.png" sizes="76x76">
    <link rel="apple-touch-icon" href="/apple-touch-icon-114x114.png" sizes="114x114">
    <link rel="apple-touch-icon" href="/apple-touch-icon-120x120.png" sizes="120x120">
    <link rel="apple-touch-icon" href="/apple-touch-icon-144x144.png" sizes="144x144">
    <link rel="apple-touch-icon" href="/apple-touch-icon-152x152.png" sizes="152x152">

    <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="/favicon-160x160.png" sizes="160x160">
    <link rel="icon" type="image/png" href="/favicon-196x196.png" sizes="196x196">

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/mstile-144x144.png">
</head>

<body>

    <section class="layout">

        <?php $this->renderPartial('protected.views.layouts.elements._header'); ?>
        
        <?=$content?>

        <div class="overlay"></div>

    </section><!-- /end .layout -->

    <?php $this->renderPartial('protected.views.layouts.elements._footer'); ?>

    <div class="to-top-btn"></div>

    <?php $this->widget('Converter'); ?>

    <script src="js/main.min.js"></script>
    <script src="http://api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
	
</body>

</html>
