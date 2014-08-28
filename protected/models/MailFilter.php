<?php
/**
 * MailFilter
 *
 * @version 1.0.0
 * @copyright Copyright 2011 by Kirya <cloudkserg11@gmail.com>
 * @author Kirya <cloudkserg11@gmail.com>
 */
class MailFilter extends AFilter
{

    /**
     * fio
     *
     * @var string
     */
    public $fio;

    /**
     * phone
     *
     * @var string
     */
    public $phone;

    /**
     * address
     *
     * @var string
     */
    public $address;

    /**
     * rules
     *
     * @return array
    **/
    public function rules()
    {
        return array(
            array('fio,phone,address', 'VText'),
            array('fio,phone,address', 'required')
        );
    }



}
