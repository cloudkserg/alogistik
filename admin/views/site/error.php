<?php
$this->pageTitle=Yii::app()->name . ' - Error';
?>

<h2>Error <?php echo $error['code']; ?></h2>

<div class="error">
<?php echo CHtml::encode($error['message']); ?>
<?php echo "<br/>".Yii::app()->controller->id; ?>
</div>
