<?php $this->widget('LeftMenu'); ?>
<section id="content">
<h2><?=$this->pageTitle?><span></span></h2>
<div class="clear"></div>
<?php
$this->widget('ModelTable', array(
    'dataProvider' => $dataProvider,
    'columns' => array(
        'id' => array('type' => 'id', 'width' => '50px'),
        'title' => array('type' => 'title', 'width' => '150px'),
        'material' => array('title' => 'Материал', 'value' => function ($row){
            return $row->getRelation('material')->title;
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
