<?php

/**
 * LoginController
 *
 * @version 1.0.0
 * @copyright Copyright 2011 by Kirya <cloudkserg11@gmail.com>
 * @author Kirya <cloudkserg11@gmail.com>
 */
class LoginController extends Controller
{

    /**
     * behaviors
     *
     * @return void
     */
    public function behaviors()
    {
        return array(
            'loginBeh' => array(
                'class' => 'LoginControllerBehavior',
                'nameModel' => 'User',
                'nameIdentityClass' => 'AdminUserIdentity'
            )
        );

    }


    /**
     * actionIndex
     *
     * @param string $error_login
     * @param string $error_password
     * @param string $login
     * @return void
     */
    public function actionIndex()
    {
        $this->loginBeh->renderForm('admin.views.login.index');
    }

    /**
     *	Действие для аутентификации (работает для AJAX)
     */
    public function actionLogin()
    {
        $this->loginBeh->login('index', 'site/index');
    }

    /**
     * Logout current user and go to main page
     */
    public function actionLogout()
    {
        $this->loginBeh->logout('index');
    }
}
