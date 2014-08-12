<?php
/**
 * NewsController
 *
 * @version 1.0.0
 * @copyright Copyright 2011 by Kirya <cloudkserg11@gmail.com>
 * @author Kirya <cloudkserg11@gmail.com>
 */
class NewsController extends Controller
{

        
        
    /**
     * accessRules
     *
     * @return array
     */
    public function accessRules()
    {
        return array(
            array(
                'allow', 
                'actions' => array('index', 'edit', 'add', 'delete', 'saveSort'),
                'users' => array('@')
            ),
            array('deny', 'users' => array('*')),
        );
    
    }

    /**
     * behaviors
     *
     * @return array
     */
    public function behaviors()
    {
        return array(
            'adminBeh' => array(
                'class' => 'AdminControllerBehavior',
                'nameModel' => 'News'
            )
        );
    
    }



}
