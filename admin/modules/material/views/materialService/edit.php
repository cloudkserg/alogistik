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
            'field'   => 'material_id',
            'label'   => 'Материал',
            'options' => Material::model()->getData()
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
    <?php $this->widget('ListField', array(
            'model'   => $item,
            'field'   => 'unit',
            'label'   => 'Единица измерения',
            'options' => MaterialUnit::model()->getData()
        )
    );
    ?>
    <?php $this->widget('CheckboxField',array(
            'model' => $item,
            'field' => 'use_fraction',
            'label' => 'Использовать картинку из фракции'
        )
    );
    ?>
</form>
<h3>Загрузить изображения (размеры не менее <b>460 x 346</b>)</h3>
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
