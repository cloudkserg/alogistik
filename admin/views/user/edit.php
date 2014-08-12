<?php $this->registerPackage('edit'); ?>
<?php $this->widget('LeftMenu'); ?>
<section id="content">


<h2><?=$this->pageTitle?><span></span></h2>
<form id="formEdit" method="POST">
	<?php $this->widget('EmailField',array(
			'model'		  => $item,
			'field'       => 'login',
			'label'		  => 'Логин(email)'
		));
	?>
	<?php $this->widget('TextField',array(
			'model'		  => $item,
			'field'       => 'fullname',
			'label'		  => 'Полное имя'
		));
	?>
	<?php $this->widget('CheckboxField',array(
			'model'		  => $item,
            'field'       => 'admin',
			'label'		  => 'Администратор'
		));
	?>
	<?php $this->widget('PassField',array(
			'model'		  => $item,
			'field'       => 'password',
			'label'		  => 'Пароль'
		));
	?>
	<?php $this->widget('PassField',array(
			'model'		  => $item,
			'field'       => 'repeatPassword',
			'label'		  => 'Повторение пароля'
		));
	?>
	<?php $this->widget('TextareaField',array(
			'model'		  => $item,
			'field'       => 'desc',
			'label'		  => 'Описание'
            
		));
	?>
	<?php $this->widget('CheckboxField',array(
			'model'		  => $item,
			'field'       => 'published',
			'label'		  => 'Активный'
		));
	?>

</form>
<!-- legend -->
<?php echo $this->renderPartial('/layouts/_legend'); ?>
</section>
