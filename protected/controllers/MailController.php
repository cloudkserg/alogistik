<?php
/**
 * MailController
 *
 * @version 1.0.0
 * @copyright Copyright 2011 by Kirya <cloudkserg11@gmail.com>
 * @author Kirya <cloudkserg11@gmail.com>
 */
class MailController extends Controller
{


    /**
     * actionSend
     *
     * @return void
     */
    public function actionSend()
    {
        $mailFilter = new MailFilter();
        $mailFilter->attributes = $_POST;
        if (!$mailFilter->validate()) {
            throw new CHttpException('404', 'Неверные параметры');
        }

        $mailComponent = new PMailComponent('mail');
        $mailComponent->send(array('filter' => $mailFilter));
        
        $component = new SmsComponent();
        $message = $this->renderFile(Yii::getPathOfAlias('protected.views.sms') . '/send.php', array('filter' => $mailFilter), true);
        $component->send($message);
        if ($component->isError()) {
            var_dump($component->getError());
        } else {
            $this->redirect('/site/index');
        
        }

    }

    public function actionCall()
    {
        $mailFilter = new CallFilter();
        $mailFilter->attributes = $_POST;
        if (!$mailFilter->validate()) {
            throw new CHttpException('404', 'Неверные параметры');
        }

        $mailComponent = new PMailComponent('call');
        $mailComponent->send(array('filter' => $mailFilter));


        $this->redirect('/site/index');
    
    
    }


}
