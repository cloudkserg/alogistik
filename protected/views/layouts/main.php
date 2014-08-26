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
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png">
	<link rel="icon" type="image/png" href="/favicon-196x196.png" sizes="196x196">
	<link rel="icon" type="image/png" href="/favicon-160x160.png" sizes="160x160">
	<link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
	<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
	<meta name="msapplication-TileColor" content="#ae64a4">
	<meta name="msapplication-TileImage" content="/mstile-144x144.png">
</head>

<body>

    <section class="layout">

        <?php $this->renderPartial('protected.views.layouts.elements._header'); ?>
        
        <?=$content?>

    </section><!-- /end .layout -->

    <?php $this->renderPartial('protected.views.layouts.elements._footer'); ?>

    <div class="to-top-btn"></div>

    <?php $this->widget('Converter'); ?>

	<!--[if lt IE 9]>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/es5-shim/2.0.8/es5-shim.min.js"></script>
    <![endif]-->

    <script src="/js/main.min.js"></script>
    
    <!-- Yandex.Metrika counter --><script type="text/javascript">(function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter25953364 = new Ya.Metrika({id:25953364, webvisor:true, clickmap:true, trackLinks:true, accurateTrackBounce:true}); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="//mc.yandex.ru/watch/25953364" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->
	
</body>

</html>
