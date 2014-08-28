<?php
/**
 * CallFilter
 *
 * @version 1.0.0
 * @copyright Copyright 2011 by Kirya <cloudkserg11@gmail.com>
 * @author Kirya <cloudkserg11@gmail.com>
 */
class CallFilter extends AFilter
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
     * rules
     *
     * @return array
    **/
    public function rules()
    {
        return array(
            array('fio,phone', 'required'),
            array('fio,phone', 'VText')
        );
    }



}
