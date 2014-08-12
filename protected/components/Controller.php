<?php
/**
 * Controller
 *
 * @uses CController
 * @package
 * @version
 * @copyright 2011 Ixtlan
 * @author Kirya <cloudkserg11@gmail.com>
 * @license http://www.php.net/license/ PHP
 */
class Controller extends AController
{
    //Лайоут по умолчанию
    public $layout='/layouts/page';

    //Общие действия
    public function actions()
    {
        return array(
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'transparent'=>true,
                'foreColor' => 0x5F696F,
                'testLimit' => 2
            ),
        );
    }
    

}
