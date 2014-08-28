<?php
/**
 * MailComponent{
 *
 * @package
 * @version
 * @copyright 2011 Ixtlan
 * @author Kirya <cloudkserg11@gmail.com>
 * @license http://www.php.net/license/ PHP
 */
class MailComponent extends CComponent
{

    //Тип почты
    private $_type = "";

    //компонент мейлер
    private $_mailer;

    /* *
     * __construct
     *
     * @access public
     * @return void
     */
    public function __construct( $type = "")
    {
        $this->_type = $type;
        $this->_mailer = Yii::createComponent('vendor.yii.mailer.EMailer');
    }

    /**
     * init
     *
     * @return void
     */
    public function init() 
    {
        return parent::init();

    }

    /* public send() {{{ */
    /**
     * send
     * Функция для посылки почты
     *
     * @access public
     * @return void
     */
    public function send($params, $sendAdmin = true, $inputMails = array() ) 
    {

        $mails = $this->collectMails($inputMails, $sendAdmin);

        //Берем текст письма
        if ( isset(Yii::app()->controller->module)) {
            $path = Yii::getPathOfAlias(Yii::app()->controller->module->id);
        } else {
            $path = Yii::getPathOfAlias('application');
        }

        $path .= "/views/mail/{$this->_type}";
        $msg = $this->renderInternal($path."/message.php", $params);
        $title = $this->renderInternal($path."/title.php", $params);
        $title = mb_substr($title, 0, 100);


        //Если ящиков для приемки нету не посылаем никуда
        if (count($mails) == 0) {
            throw new Exception(Yii::t('cms', 'Неверные параметры', null, 'cmsMessages'));
        }

        //Создаем письмо
        //$this->_mailer->Host = "";
        //$this->_mailer->isSmtp();

        //От кого
        $this->_mailer->From = Yii::app()->params['mails']['siteEmail'];
        $this->_mailer->FromName = Yii::app()->name;

        //Ящики для отправки
        foreach ($mails as $mail) {
            $this->_mailer->AddAddress($mail);
        }

        //Тема текст титл
        $this->_mailer->CharSet = 'UTF-8';
        $this->_mailer->ContentType = 'text/html';
        $this->_mailer->Subject = $title;
        $this->_mailer->Body = $msg;

        //Отправляем
        if (!$this->_mailer->Send()) {
            $firstAddress = array_shift($mails);
            Yii::log("Не отправилось письмо {$title} по адресу {$firstAddress}", "error");
        }

        return true;

    }
    // }}}


    /**
     * collectMails
     *
     * @param mixed $inputMails
     * @param mixed $sendAdmin
     * @return void
     */
    private function collectMails($inputMails, $sendAdmin)
    {
        //Ящики можно прислать и в виде одного
        $mails = $inputMails;
        if (!is_array($inputMails)) {
            $mails = array($inputMails);
        }
        
        //Если необходимо берем ящики админа
        if (YII_DEBUG) {
            return $this->getAdminMails();
        }

        if ($sendAdmin) {
            $mails = $mails + $this->getAdminMails();
        }

        return $mails;
    }



    /**
     * getAdminMails
     *
     * @return void
     */
    private function getAdminMails()
    {
        //Добавляем ящик админа

        //Берем ящики для этой формы
        $mailboxes = Mailbox::model()->findAll();
        foreach($mailboxes as $mailbox)
            $mails[] = $mailbox->mail;

        return $mails;
    }


    /**
     * Функция для прикрепляния файла  к письму
     */
    public function attachFile($file, $name) 
    {
        if (!file_exists($file)) {
            throw new CHttpException('404', Yii::t('cms', 'Файл не добавлен к письму.', null, 'cmsMessages'));
        }
        if (empty($name)) {
            $name = basename($file);
        }
        $this->_mailer->AddAttachment($file, $name);
    }


    /**
     * renderInternal
     * special function from framework
     *
     * @param mixed $_viewFile_
     * @param mixed $_data_
     * @param mixed $_return_
     * @return void
     */
    public function renderInternal($_viewFile_,$_data_=null)
    {
        // we use special variable names here to avoid conflict when extracting data
        if(is_array($_data_))
            extract($_data_,EXTR_PREFIX_SAME,'data');
        else
            $data=$_data_;

        ob_start();
        ob_implicit_flush(false);
        require($_viewFile_);
        return ob_get_clean();
    }



}
