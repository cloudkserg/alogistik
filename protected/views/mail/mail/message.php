<?php if (Text::encode($filter->orderType) == 'material'):?>
	<?=Text::encode($filter->fio)?> заказал <?=Text::encode($filter->weightString)?> <?=Text::encode($filter->materialName)?> по <?=Text::encode($filter->cost)?> руб. за 	тонну, на общую сумму <?=Text::encode($filter->totalCost)?> без учёта доставки.<br />
	Адрес для доставки: <?=Text::encode($filter->address)?><br />
	Связаться с покупателем вы можете по телефону <?=Text::encode($filter->phone)?>
<?php else:?>
	<?=Text::encode($filter->fio)?> заказал <?=Text::encode($filter->technicType)?> <?=Text::encode($filter->technicName)?> по <?=Text::encode($filter->price)?> руб. за час<br />
	Связаться с заказчиком вы можете по телефону <?=Text::encode($filter->phone)?>, адрес <?=Text::encode($filter->address)?>
<?php endif;?>
