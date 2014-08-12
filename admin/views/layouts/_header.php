<header>
<div id="logo"><a title="Перейти на главную страницу панели управления" href="<?=GetUrl::url('/default/index')?>"></div>
    <h1>Панель управления</h1>
    <section>
        <a id="site" href="/" title="На сайт"><span>На сайт</span> →</a>
        <p>
            Вы&nbsp;—&nbsp;<a href="mailto:<?php echo Yii::app()->user->login; ?>" title="">
            <?php echo Yii::app()->user->login; ?><span></span></a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="<?=GetUrl::url('/cache/clear')?>">Очистить кеш</a>
            <a id="logout" href="<?=GetUrl::url('/login/logout')?>" title="Выйти из учетной записи">Выход<i></i></a>
        </p>
    </section>
</header>
<nav id="mainNav">
    <?php echo $this->renderPartial('application.views.layouts._menu'); ?>
</nav>

