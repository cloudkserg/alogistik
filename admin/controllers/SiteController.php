<?php

/**
 * SiteController
 *
 * @version 1.0.0
 * @copyright Copyright 2011 by Kirya <cloudkserg11@gmail.com>
 * @author Kirya <cloudkserg11@gmail.com>
 */
class SiteController extends Controller
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
                'actions'=>array('error'),
                'users'=>array('*'),
            ),
            array('allow',
                'actions'=>array('index'),
                'roles' => array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }



    /**
     * Действие по умолчанию для модели
     */
    public function actionIndex()
    {
        $this->redirect(array("/project/district/index"));
    }


    /**
     * Действие при ошибках
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                Yii::app()->ajax->sendRespond(false, $error['message']);
            else
                $this->render('error', array( 'error' => $error));
        }
    }

}
