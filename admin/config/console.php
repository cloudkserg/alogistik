<?php
//Массив настроек
return CMap::mergeArray(
    //наследуемя от main.php
    require_once(__DIR__.'/main.php'),
    array(
        'import' => array(
            'admin.modules.project.models.*',
            'admin.modules.page.models.*',
            'admin.modules.structure.models.*',

        ),
        'commandMap' =>  array(
            'migrate' => array(
                'migrationPath' => 'admin.migrations'
            )
        ),
        'components' => array(
            'runtimePath' => dirname(__DIR__) . '/runtime',

            'log' => array(
                'class' => 'CLogRouter',
                'routes' => array(
                    array(
                        'class' => 'CFileLogRoute',
                        'levels' => 'error, warning',
                        'logFile' => 'console.log'
                    ),
                ),
            ),
        )
    )
);
