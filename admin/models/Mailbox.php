<?php
/**
 * Mailbox
 *
 * @version 1.0.0
 * @copyright Copyright 2011 by Kirya <cloudkserg11@gmail.com>
 * @author Kirya <cloudkserg11@gmail.com>
 */
class Mailbox extends CmsModel
{

    /**
     * tableName
     *
     * @return void
     */
    public function tableName()
    {
        return 'mailboxes';
    }


    /**
     * rules
     *
     * @return array
     */
    public function rules()
    {
        return array(
            array('title', 'required'),
            array('mail, title', 'VText')    
        );
    }


    /**
     * attributeLabels
     *
     * @return array
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'id',
            'title' => 'Название',
            'mail' => 'Почтовый ящик'
        );
    }


}
