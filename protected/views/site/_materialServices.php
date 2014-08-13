<div class="service sale-materials js-scrollspy" data-nav-id="goods">
    <img class="sale-materials__background_crossfade_helper" src=""/>
    <img class="sale-materials__background_holder" src=""/>

    <div class="service__inner sale-materials__inner">
        <div class="service__content">

            <div class="service__desc">
                <h2 class="service__head">Продажа сыпучих строительных материалов</h2>
                <p class="service__desc_additional">Бесплатная&nbsp;доставка для грузов больше 5&nbsp;тонн</p>

                <?php if (isset($priceFile)) : ?>
                   <a class="service__download_price_btn" href="<?=FileHelper::firstFile($pricePage)?>">Скачать прайс-лист</a>
                <?php endif; ?>
            </div><!-- /end .service__desc -->

            <div class="service__content_inner">
            <?php foreach ($services as $service) : ?>
                <div class="sale-material" data-bg="<?=ImageHelper::firstImage($service->first, 'bg')?>" 
                    data-popup-data='{
                        "desc": "<?=$service->text?>", 
                        "types": [
                        <?php $arrHelper = new ArrayHelper($service->fractions); foreach ($service->fractions as $key => $fraction) : ?>
                            {"type":"<?=$fraction->title?>", "price": "<?=$fraction->price?>"}
                            <?php if (!$arrHelper->isLastKey($key)) : ?>
                                ,
                            <?php endif; ?>
                        <?php endforeach; ?>
                        ]
                    }'
                >

                        <div class="sale-material__img_container">
                            <img class="sale-material__img" src="<?=ImageHelper::firstImage($service, 'alt')?>" alt="altText"/>
                            <div class="sale-material__see_more">
                                <p class="sale-material__see_more_text">Узнать<br/>больше</p>
                            </div>
                        </div>
                    <h3 class="sale-material__name"><?=$service->material->title?></h3>
                    <p class="sale-material__price"><?=$service->begin_price?><span class="ruble">p</span></p>
                </div><!-- /end .sale-material -->
            <?php endforeach; ?>


            </div><!-- /end .service__content_inner -->
        </div><!-- /end .service__content -->
    </div><!-- /end .service__inner -->
</div><!-- /end .service -->