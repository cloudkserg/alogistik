
<div class="service sale-materials js-scrollspy" data-nav-id="goods">
    <img class="sale-materials__background_crossfade_helper" src=""/>
    <img class="sale-materials__background_holder" src=""/>

    <div class="service__inner sale-materials__inner">
        <div class="service__content">

            <div class="service__desc">
                <h2 class="service__head">Продажа сыпучих строительных материалов</h2>
                <p class="service__desc_additional">Бесплатная&nbsp;доставка для грузов больше 5&nbsp;тонн</p>

                <?php if (isset($priceFile)) : ?>
                   <a class="service__download_price_btn" href="<?=PFileHelper::firstFile($pricePage)?>">Скачать прайс-лист</a>
                <?php endif; ?>
            </div><!-- /end .service__desc -->

            <div class="service__content_inner">
            <?php foreach ($services as $service) : ?>
                <div class="sale-material" data-bg="<?=PImageHelper::firstImage($service->getRelation('mainFraction'), 'bg')?>" 
                    data-popup-data='<?=ServiceHelper::generatePopupData($service)?>'>

                        <a class="sale-material__img_container" href="#<?=str_replace(' ', '-', $service->getRelation('material')->title)?>">
                            <img class="sale-material__img" src="<?=PImageHelper::firstImage($service->getRelation('mainFraction'), 'alt')?>" alt="altText"/>
                            <div class="sale-material__see_more">
                                <p class="sale-material__see_more_text">Узнать<br/>больше</p>
                            </div>
                        </a>
                    <h3 class="sale-material__name"><?=$service->getRelation('material')->title?></h3>
                    <p class="sale-material__price"><?=$service->begin_price?><span class="ruble">p</span></p>
                </div><!-- /end .sale-material -->
            <?php endforeach; ?>


            </div><!-- /end .service__content_inner -->
        </div><!-- /end .service__content -->
    </div><!-- /end .service__inner -->
</div><!-- /end .service -->
