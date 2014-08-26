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
            'field'   => 'service_id',
            'label'   => 'Сервис',
            'options' => Service::model()->getData()
        )
    );
    ?>
    <?php $this->widget('RelationsField', array(
            'model'   => $item,
            'field'   => 'cars',
            'label'   => 'Машины'
        )
    );
    ?>
    <?php $this->widget('TextareaField',array(
            'model' => $item,
            'field' => 'text',
            'label' => 'Текст',
            'fck'   => true
        )
    );
    ?>
</form>

<!-- legend -->
<?php echo $this->renderPartial('admin.views.layouts._legend'); ?>
</section>
