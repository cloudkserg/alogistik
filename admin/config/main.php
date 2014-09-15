<?php
// Массив наcтроек
return array(
    'sourceLanguage'=>'ru',
    'name' => 'ООО «АльфаЛогистик»',

    // preloading 'log' component
    'preload'=>array('log'),

    'packages' => array(
        'vendor.xtlan.admin',
        'vendor.xtlan.file',
        'vendor.xtlan.image',
        'vendor.xtlan.menu',
        'vendor.xtlan.process',

        'admin.modules.car',
        'admin.modules.material',
        'admin.modules.page',
        'admin.modules.service'
    ),

    // autoloading model and component classes
    'import' => array(
            //Модели
            'admin.models.filters.*',
            'admin.models.*',

            //Вспомогательные вещи
            'admin.components.*',
    ),

    'modules' => array(
        'image' => array(
            'class' => 'xtlan.image.ImageModule',
            'modelPaths' => array(
            ),
            'processPath' => 'admin'
        ),
        'file' => array(
            'class' => 'xtlan.file.FileModule',
            'modelPaths' => array(
            )
        ),

        'car',
        'material',
        'page',
        'service'

    ),

    // application components
    'components' => array(
        //cache component
        'cache' => array(
            'class'=>'CApcCache'
        ),

        //user component
        'user' => array(
            'class'=>'xtlan.admin.components.AdminWebUser',
            // enable cookie-based authentication
            //'allowAutoLogin' => true,
            'loginUrl' => '/admin/login/login',
        ),

        //ajax
        'ajax' => array(
            'class' => 'Ajax'
        ),


        // urlmanager component
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules'=>array(
                'admin/page/index' => 'page',
                'admin/'=>'site/index',
                'admin/<_c>'=>'<_c>',
                'admin/<_c>/<_a>'=>'<_c>/<_a>',
                'admin/<_c>/<_a>/<_p>'=>'<_c>/<_a>/<_p>',
            ),
        ),

        //error component
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),

        //log component
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            ),
        ),
    ),

);
