<?php

/**
 * Управляющий класс для Кеша
 *
 */
class CacheController extends Controller
{

    /**
     * @return array action filters
     */
    public function filters() 
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() 
    {
        return array(
            array('allow',
                'actions' => array('clear'),
                'roles' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }


    /**
     * Действие для удаления
     */
    public function actionClear() 
    {
        Yii::app()->cache->flush();

        if(isset($_SERVER['HTTP_REFERER']))
            $this->redirect($_SERVER['HTTP_REFERER']);
        $this->redirect('/');
    }

}
