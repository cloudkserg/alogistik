<?php

/**
 * User
 *
 * @uses DefaultModel
 * @package model
 * @version
 * @copyright 2011 Ixtlan
 * @author Kirya <cloudkserg11@gmail.com>
 * @license http://www.php.net/license/ PHP
 */
class User extends CmsModel
{

    /**
     * @var string свойство для хранения повторно введенного пароля
     * для проверка
     */
    public $repeatPassword;

    /**
     * tableName
     *
     * @return void
     */
    public function tableName()
    {
        return 'users';
    }
    
    /**
     * behaviors
     *
     * @return void
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            array(
                'passwordBeh' => array(
                    'class' => 'PasswordBehavior'
                )
            )
        );
    }

    /**
     * rules
     *
     * @return void
     */
    public function rules()
    {
        return array(
            //Обязательные
            array('login', 'required'),
            //Пароль
            array('password', 'length', 'max'=>'512' ),
            array('repeatPassword', 'compare','compareAttribute' => 'password'),
            array('password,repeatPassword', 'required', 'on' => 'insert'),
            
            //Email
            array('login', 'email'),
            array('login', 'unique'),

            //Числа
            array('published, admin', 'numerical', 'integerOnly'=>true),
            //Текст
            array('fullname, desc, phone',   'VText'),
        );
    }

    /**
     * attributeLabels
     *
     * @return void
     */
    public function attributeLabels()
    {
        return array_merge(
            parent::attributeLabels(), 
            array(
                'login' => 'Логин',
                'fullname' => 'Имя',
                'desc' => 'Описание',
                'password' => 'Пароль',
                'repeatPassword' => 'Повторение пароля',
                'admin' => 'Администратор'
            )
        );
    }

}
