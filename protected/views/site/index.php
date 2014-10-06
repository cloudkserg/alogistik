<section class="main-content">

    <?php $this->renderPartial('_materialServices', array('services' => $materialServices, 'page' => $materialPage))?>  
    
    <div class="main-content__inner js-scrollspy" data-nav-id="services">
    
	    <?php $this->renderPartial('_carServices', array('services' => $carServices, 'page' => $carPage))?>
	    
	    <?php $this->renderPartial('_services', array('services' => $services))?>
    
    </div><!-- /end .main-content__inner -->


    <div class="about js-scrollspy" data-nav-id="about">
        <div class="about__inner">
            <div class="about__advantages">
                <h4 class="about__advantage">Только опытные специалисты</h4>
				<h4 class="about__advantage">Большой собственный автопарк</h4>
				<h4 class="about__advantage">Скидки<br/>постоянным<br/>клиентам</h4>
				<h4 class="about__advantage">14&nbsp;лет&nbsp;на&nbsp;рынке нерудных материалов</h4>
				<h4 class="about__advantage">Работаем по&nbsp;городу<br/>и области</h4>
				<h4 class="about__advantage">Работаем<br/>24&nbsp;часа&nbsp;в&nbsp;сутки, 7&nbsp;дней&nbsp;в&nbsp;неделю</h4>
            </div><!-- /end .about__advantages -->
        </div><!-- /end .about__inner -->
    </div><!-- /end .about -->

    <div class="contacts js-scrollspy" data-nav-id="contacts">
        <div id="map" class="contacts__map">

        </div><!-- /end .contacts__map -->
        <div class="contacts__sticker">
			<p class="contacts__item"><b>ООО «АльфаЛогистик»</b><br/>
				<a class="contacts__item_phone" href="tel:+7(3812)38-26-07">+7&nbsp;(3812)</span>&nbsp;38-26-07</a><br>
				<a class="contacts__item_email" href="mailto:mail@alogistic.ru">mail@alogistic.ru</a>
            </p>
			<p class="contacts__item">Юридический адрес:<br/>
				<span class="contacts__item_address">644073, г. Омск,<br/>
				ул. Звездная, д. 6/1</span>
			<p class="contacts__item">Реквизиты:<br/>
				ИНН: 5507236034<br/>
				ОГРН: 1135543000328
		</div>
    </div><!-- /end .contacts -->

</section><!-- /end .main-content -->
