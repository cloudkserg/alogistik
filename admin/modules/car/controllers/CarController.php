<?php

/**
 * Description of CarController
 *
 * @author art3mk4
 */
class CarController extends Controller
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
                'actions' => array('index', 'edit', 'add', 'delete', 'saveSort'),
                'roles' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * behaviors
     *
     * @return void
     */
    public function behaviors()
    {
        return array(
            'adminBeh' => array(
                'class' => 'AdminControllerBehavior',
                'nameModel' => 'Car'
            )
        );
    }

}
