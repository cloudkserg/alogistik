<?php $this->registerPackage('table'); ?>
<?php $this->widget('LeftMenu'); ?>
<section id="content">
<h2><?=$this->pageTitle?><span></span></h2>
<?php
$this->widget('ModelTable', array(
    'dataProvider' => $dataProvider,
    'columns' => array(
        'id' => array('type' => 'id', 'width' => '50px'),
        'fullname' => array('width' => '150px'),
        'login' => array('width' => '150px', 'type' => 'title'),
        'admin' => array( 'type' => 'checkbox'),
        'desc' => array(),
    )
));
?>
<?php $this->widget('Pager', array(
    'pages' => $dataProvider->pages,
    'url' => $this->createUrl(''),
    'manyLabels' => array('пользователь','пользователя','пользователей'),
)); ?>              
</section>
