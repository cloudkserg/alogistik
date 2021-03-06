<div class="service rent-spec-technics">
    <div class="service__inner rent-spec-technics__inner">
        <div class="service__content">
            <div class="service__desc">
                <h2 class="service__head">Аренда самосвалов и&nbsp;спецтехники</h2>
                <p class="service__desc_additional">Вся спецтехника арендуется только&nbsp;с&nbsp;водителем</p>

				<?php if (isset($page)) : ?>
                	<a class="service__download_price_btn" href="<?=PFileHelper::firstFile($page)?>" target="_blank">Скачать прайс-лист</a>
					<p class="service__price_desc">В прайс-листе содержится информация обо всех услугах, технике и их стоимости</p>
                <?php endif; ?>
            </div>

            <div class="service__content_inner">
            <?php foreach ($services as $service) : ?>
                <div class="rent-spec-technic" data-popup-data='<?=ServiceHelper::generateTechnicPopupData($service)?>'>
                    <a class="rent-spec-technic__img_container" href="#<?php echo str_replace(' ', '-', $service->car->title).'-'.str_replace(' ', '-', $service->title)?>">
                        <img class="rent-spec-technic__img" src="<?=PImageHelper::firstImage($service, 'alt')?>" alt="altText"/>
                        <div class="rent-spec-technic__see_more">
                            <p class="rent-spec-technic__see_more_text">Узнать больше</p>
                        </div>
                    </a>
                    <h3 class="rent-spec-technic__name"><?=$service->title?></h3>
                    <p class="rent-spec-technic__desc"><?=$service->car->title?></p>
                    <p class="rent-spec-technic__price"><b><?=$service->begin_price?><span class="ruble">p</span></b>&nbsp;в&nbsp;час</p>
                </div><!-- /end .rent-spec-technic -->
            <?php endforeach; ?>
            </div><!-- /end .service__content_inner -->
        </div><!-- /end .service__content -->
    </div><!-- /end .service__inner -->
</div><!-- /end .service -->
