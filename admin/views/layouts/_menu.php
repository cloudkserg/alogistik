<div class="tab-menu">
    <ul>
        <?php
            $this->widget('PointMenu', array(
                    'label'  => 'Машины',
                    'links' => array(
                        new ALink(new AModuleUrl('/car/car'), 'Машины'),
                        new ALink(new AModuleUrl('/car/carService'), 'Сервисы машин'),
                        new ALink(new AModuleUrl('/car/carServiceParam'), 'Параметры сервисов'),
                    )
                )
            );
        ?>
        <?php
            $this->widget('PointMenu', array(
                    'label'  => 'Материалы',
                    'links' => array(
                        new ALink(new AModuleUrl('/material/material'), 'Материалы'),
                        new ALink(new AModuleUrl('/material/materialService'), 'Сервисы материалов'),
                        new ALink(new AModuleUrl('/material/materialFraction'), 'Фракции сервисов'),
                    )
                )
            );
        ?>
        <?php
            $this->widget('PointMenu', array(
                    'label'  => 'Услуги',
                    'links' => array(
                        new ALink(new AModuleUrl('/service/service'), 'Услуги'),
                        new ALink(new AModuleUrl('/service/serviceItem'), 'Объекты услуг'),
                    )
                )
            );
        ?>
        <?php
            $this->widget('PointMenu', array(
                    'label'  => 'Страницы',
                    'links' => array(
                        new ALink(new AModuleUrl('/page/page'), 'Страницы'),
                    )
                )
            );
        ?>
        <?php if (Yii::app()->user->checkAccess('admin')): ?>
            <?php $this->widget('PointMenu', array(
                'label' => 'Админка',
                'links' => array(
                    new ALink(new AUrl('/user'), 'Пользователи'),
                    new ALink(new AUrl('/mailbox'), 'Почтовые ящики'),
                )
            )); ?>
        <?php endif; ?>
    </ul>
</div>
<div class="menu"></div>
