<?php

/**
 * Класс для главной страницы и обработчика ошибок
 */
class SiteController extends Controller
{

    /**
     *
     * @var type 
     */
    public $layout = 'main';

    /**
     * Действие для вывода главной страницы
     */
    public function actionIndex()
    {
        $sliders = Slider::model()->published()->sort()->findAll();

        $this->render(
            'index',
            array(
                'sliders' => $sliders
            )
        );
    }

    /**
     * Действие при ошибках
     */
    public function actionError()
    {
        $error =  Yii::app()->errorHandler->error;
        if (!isset($error)) {
            $error = array('message' => '');
        }

        if (Yii::app()->request->isAjaxRequest) {
            Yii::app()->ajax->sendRespond(false, $error['message']);
        } else {
            $this->render(
                'error',
                array(
                    'error' => $error,
                )
            );
        }
    }
}