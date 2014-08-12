<?php
return array(
    'sourceLanguage'=>'ru',
    'charset' => 'utf-8',
    'name' => 'investomsk',

    // preloading 'log' component
    'preload'=>array('log'),

    'packages' => array(
        'vendor.xtlan.cms',
        'vendor.xtlan.file',
        'vendor.xtlan.image',
        'vendor.xtlan.menu',

        'admin.modules.car',
        'admin.modules.material',
        'admin.modules.page',
        'admin.modules.service'
    ),

    // autoloading model and component classes
    'import' => array(
            //Модели
            'admin.models.*',

            'protected.models.*',
            'protected.components.*',
            'protected.components.helpers.*',
            'protected.components.widgets.*',
    ),
    // application components
    'components'=>array(

        'cache' => array(
            'class'=>'CApcCache'
        ),

        // uncomment the following to enable URLs in path-format
        'urlManager'=>array(
            'urlFormat'=>'path',
            'showScriptName'=>false,
            'rules'=>array(
                '/page/id/<id:\d+>' => 'page/view',
                '/page/alias/<alias:\w+>' => 'page/view',
                '/search/text/<text:.*>' => 'search/index',
                
                //Правила для работы с путями Index
                '/<_c>/<id:\d+>' => '<_c>/view',
                '/<_c>/page/<page:\d+>' => '<_c>/index',

                //Общие правила
                '/'=>'site/index',
                '/<_controller:\w+>'  => '<_controller>/index',
                '/<_c>'=>'<_c>',
                '/<_c>/<_a>'=>'<_c>/<_a>',
                '/<_c>/<_a>/<_p>'=>'<_c>/<_a>/<_p>',


            )

        ),

        //ajax
        'ajax' => array(
            'class' => 'Ajax'
        ),

        //ошибка
        'errorHandler'=>array(
            // use 'site/error' action to display errors
            'errorAction'=>'/site/error',
        ),

        //Лог
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning',
                ),
            ),
        ),
    ),

);
