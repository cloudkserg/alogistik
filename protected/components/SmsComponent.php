<?php
include_once(__DIR__ . '/smspilot.class.php');
class SmsComponent
{

    /**
     * pilot
     *
     * @var SMSPilot
     **/
    private $pilot;


    private $to;

    private $from;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $apikey = Yii::app()->params['sms_apikey'];
        $this->pilot = new SMSPilot($apikey);
        $this->from = Yii::app()->params['sms_from'];
        $this->to = Yii::app()->params['sms_to'];
    
    }


    /**
     * send
     *
     * @param mixed $message
     * @return void
     */
    public function send($message)
    {
        $this->pilot->send($this->to, $message, $this->from);   
        var_dump($this->pilot->success, $this->pilot->status, $this->pilot->error);
    }

    public function isError()
    {
        return !$this->pilot->success;
    }

    public function getError()
    {
        return $this->pilot->error;
    }


}


