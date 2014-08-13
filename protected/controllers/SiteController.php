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

        $carPage = PageHelper::findForType(PageType::CAR_PRICE);
        $materialPage = PageHelper::findForType(PageType::MATERIAL_PRICE);

        $carServices = CarService::model()->sort()->findAll();
        $materialServices = MaterialService::model()->sort()->findAll();
        $services = Service::model()->sort()->findAll();

        $this->render(
            'index',
            array(
                'carPage' => $carPage,
                'materialPage' => $materialPage,

                'carServices' => $carServices,
                'materialServices' => $materialServices,
                'services' => $services
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
