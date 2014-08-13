<?php
/**
 * ServiceItemFilter
 *
 * @version 1.0.0
 * @copyright Copyright 2011 by Kirya <cloudkserg11@gmail.com>
 * @author Kirya <cloudkserg11@gmail.com>
 */
class ServiceItemFilter extends AFilter
{

    /**
     * service_id
     *
     * @var int
     */
    public $service_id;


    /**
     * rules
     *
     * @return array
     */
    public function rules()
    {
        return array(
            array('service_id', 'numerical')
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
            'service_id' => 'Сервис'
        );
    }




}
