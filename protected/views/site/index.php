<section class="main-content">

    <?php $this->renderPartial('_materialServices', array('services' => $materialServices, 'page' => $materialPage))?>
    
    <?php $this->renderPartial('_carServices', array('services' => $carServices, 'page' => $carPage))?>
    
    <?php $this->renderPartial('_services', array('services' => $services))?>


    <div class="about js-scrollspy" data-nav-id="about">
        <div class="about__inner">
            <div class="about__advantages">
                <h4 class="about__advantage">У нас работают квалифицинованные специалисты</h4>
                <h4 class="about__advantage">Скидка на самосвалы<br/>при заказе погрузчика<br/>или экскаватора</h4>
                <h4 class="about__advantage">Скидки<br/>для постоянных<br/>клиентов</h4>
                <h4 class="about__advantage">17 лет на рынке<br/>нерудных материалов</h4>
                <h4 class="about__advantage">Работаем<br/>по Омской области</h4>
                <h4 class="about__advantage">Работаем<br/>24 часа в сутки </h4>
            </div><!-- /end .about__advantages -->
        </div><!-- /end .about__inner -->
    </div><!-- /end .about -->

    <div class="contacts js-scrollspy" data-nav-id="contacts">
        <div id="map" class="contacts__map">

        </div><!-- /end .contacts__map -->
        <div class="contacts__sticker">
            <p class="contacts__item">ООО "АльфаЛогистик",<br/>
                8&nbsp;800&nbsp;200&nbsp;00&nbsp;00</p>
            <p class="contacts__item">Юридический адрес:<br/>
                644073, г. Омск,<br/>
                ул. Звездная, д. 6, корп. 1, кв. 11
            <p class="contacts__item">Реквизиты:<br/>
                ИНН: 5507236034<br/>
                ОГРН: 1135543000328
        </div>
    </div><!-- /end .contacts -->

</section><!-- /end .main-content -->