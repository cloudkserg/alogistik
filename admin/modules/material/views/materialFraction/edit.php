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
    <?php $this->widget('ListField', array(
            'model'   => $item,
            'field'   => 'material_service_id',
            'label'   => 'Сервис материала',
            'options' => MaterialService::model()->getData()
        )
    );
    ?>
    <?php $this->widget('TextField',array(
            'model' => $item,
            'field' => 'price',
            'label' => 'Цена'
        )
    );
    ?>
</form>

<!-- legend -->
<?php echo $this->renderPartial('admin.views.layouts._legend'); ?>
</section>
