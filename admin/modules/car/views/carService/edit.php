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
    <?php $this->widget('TextareaField',array(
            'model' => $item,
            'field' => 'text',
            'label' => 'Текст',
            'fck'   => false
        )
    );
    ?>
    <?php $this->widget('ListField', array(
            'model'   => $item,
            'field'   => 'car_id',
            'label'   => 'Машина',
            'options' => Car::model()->getData()
        )
    );
    ?>
    <?php $this->widget('TextField',array(
            'model' => $item,
            'field' => 'begin_price',
            'label' => 'Цена'
        )
    );
    ?>
    <?php $this->widget('TextField',array(
            'model' => $item,
            'field' => 'min_order',
            'label' => 'Минимальный заказ'
        )
    );
    ?>
    <?php $this->widget('TextField',array(
            'model' => $item,
            'field' => 'length',
            'label' => 'Длина'
        )
    );
    ?>
    <?php $this->widget('TextField',array(
            'model' => $item,
            'field' => 'width',
            'label' => 'Ширина'
        )
    );
    ?>
    <?php $this->widget('TextField',array(
            'model' => $item,
            'field' => 'height',
            'label' => 'Высота'
        )
    );
    ?>
</form>
<h3>Загрузить изображения (размеры не менее <b>600 x 376</b>)</h3>
<?php $this->widget('ImageUploader', array(
            'field' =>  'image',
            'item'  =>  $item,
        )
    );
?>
<?php $this->widget('ImageList', array(
        'field'    =>  'image',
        'images'   =>  $item->images,
    )
);
?>


<!-- legend -->
<?php echo $this->renderPartial('admin.views.layouts._legend'); ?>
</section>
