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
            'field'   => 'type',
            'label'   => 'Тип страницы',
            'options' => PageType::model()->getData()
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
<h3>Загрузить изображения</h3>
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

<h3>Загрузить файлы</h3>
<?php $this->widget('FileUploader', array(
        'field' =>  'file',
        'item'  =>  $item,
    )
);
?>

<?php $this->widget('FileList', array(
        'field'    =>  'file',
        'files'    =>  $item->files,
    )
);
?>

<!-- legend -->
<?php echo $this->renderPartial('admin.views.layouts._legend'); ?>
</section>
