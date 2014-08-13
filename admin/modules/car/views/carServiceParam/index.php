<?php $this->widget('LeftMenu'); ?>
<section id="content">
<h2><?=$this->pageTitle?><span></span></h2>
<div class="clear"></div>
<?php $this->widget('WFilter', array(
    'strings' => array(
        array(
            new ListFilterElement('car_service_id', CarService::model()->getData()),
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
        'carService' => array('title' => 'Сервис машины', 'value' => function ($row){
            return $row->getRelation('carService')->title;
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
