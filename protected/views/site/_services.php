<?php foreach (array_reverse($services) as $service) : ?>
    <div class="service">
        <div class="service__inner">
            <div class="service__content">

                <div class="service__desc">
                <h2 class="service__head"><?=$service->title?></h2>
                </div><!-- /end .service__desc -->

                <div class="service__content_inner">
                <?php foreach ($service->serviceItems as $item) : ?>
                    <div class="service__item">
                        <h3 class="service__item_head"><?=$item->title?></h3>
                        <p class="service__item_needs_head">Необходимая техника:</p>
                        <p class="service__item_needs"><?=CarHelper::printItems($item->cars)?></p>
                    </div><!-- /end .service__item -->
                <?php endforeach; ?>
                </div><!-- /end .service__content_inner -->
            </div><!-- /end .service__content -->
        </div><!-- /end .service__inner -->
    </div><!-- /end .service -->
<?php endforeach; ?>
