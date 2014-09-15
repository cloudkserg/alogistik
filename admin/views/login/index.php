<!DOCTYPE HTML>
<?php 
    Yii::app()->clientScript->registerPackage('cms.login'); 
?>

<html lang="ru-RU">
<head>
     <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
</head>
<body>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
        <title>Авторизация</title>
        
        <!--[if IE]>
            <link rel="stylesheet" type="text/css" href="<?=GetUrl::assetsUrl('xtlan.cms.webroot')?>/css/ie.css" media="all" />
	    <![endif]-->
    </head>
    <body id="login">
        <div id="wrapper">
                <div id="logo"><img src="<?=GetUrl::assetsUrl('xtlan.cms.webroot')?>/i/loginLogo.png" alt="Логотип" /></div>
				<form method="POST" action="<?=GetUrl::url('/login/login')?>">
					<h1 class="login">Панель управления сайтом</h1>
					<p>                        
						<div class="user <?=!empty($errorLogin) ? 'autherror' : ''?>">
                            <input type="text" name="User[login]" id="log" value="<?=$login?>" placeholder="логин">
                        </div>
					</p>
					<p>
						<div class="passwd <?=!empty($errorPassword) ? 'autherror' : ''?>">
                            <input type="password" name="User[password]" id="password" placeholder="пароль">
                        </div>
					</p>
					<p>
						<input type="checkbox" name="User[remember]" id="remember">
						<label for="User[remember]">запомнить пароль</label>
					</p>
					<input type="submit" id="logPassButton" value="Войти" />
					<!--<a href="#" title=""><span  class="pseudo_link">вспомнить пароль</span></a>-->
				</form>

        </div>
    <footer>
        <p>Разработка «<a href="http://apparat.ws" title="apparat">«Аппарат»</a>», 2014</p>
        <small>© «<a href="<?php echo GetUrl::getBaseUrl(); ?>/" title="Перейти на сайт">© ООО «АльфаЛогистик»</a>», 2000—<?php echo date("Y"); ?></small> </footer> <div id="ajaxLoader">
    </footer>
</body>
