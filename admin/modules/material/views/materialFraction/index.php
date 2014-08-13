<?php $this->widget('LeftMenu'); ?>
<section id="content">
<h2><?=$this->pageTitle?><span></span></h2>
<div class="clear"></div>
<?php $this->widget('WFilter', array(
    'strings' => array(
        array(
            new ListFilterElement('material_service_id', MaterialService::model()->getData()),
            new SubmitFilterElement()
        )
    )

)); ?>
<div class="clear"></div>
<?php
$this->widget('ModelTable', array(
    'dataProvider' => $dataProvider,
    'columns' => array(
        'id' => array('type' => 'id', 'width' => '50px'),
        'title' => array('type' => 'title', 'width' => '150px'),
        'materialService' => array('title' => 'Сервис материала', 'value' => function ($row){
            return $row->getRelation('materialService')->title;
        }),
    )
));
?>
<?php $this->widget('Pager', array(
    'pages' => $dataProvider->pages,
    'url' => $this->createUrl(''),
    'manyLabels' => array('объект','объекта','объектов'),
)); ?>              
</section>
