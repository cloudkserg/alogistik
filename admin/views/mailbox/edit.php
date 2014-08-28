<?php $this->registerPackage('admin.edit'); ?>
<?php $this->widget('LeftMenu'); ?>
<section id="content">

<h2><?=$this->pageTitle?><span></span></h2>
<form id="formEdit" method="POST">
    <?php $this->widget('TextField',array(
            'model' => $item,
            'field' => 'title',
            'label' => 'Название'
        )
    );
    ?>
    <?php $this->widget('EmailField',array(
            'model' => $item,
            'field' => 'mail',
            'label' => 'Почтовый ящик'
        )
    );
    ?>
</form>


<!-- legend -->
<?php echo $this->renderPartial('admin.views.layouts._legend'); ?>
</section>
