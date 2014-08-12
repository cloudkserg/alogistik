<div class="tab-menu">
    <ul>
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
                    'label'  => 'Сервисы',
                    'links' => array(
                        new ALink(new AModuleUrl('/service/service'), 'Сервисы'),
                        new ALink(new AModuleUrl('/service/serviceItem'), 'Объекты сервисов'),
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
                )
            )); ?>
        <?php endif; ?>
    </ul>
</div>
<div class="menu"></div>
