<?php
/**
 * CarServiceParamFilter
 *
 * @version 1.0.0
 * @copyright Copyright 2011 by Kirya <cloudkserg11@gmail.com>
 * @author Kirya <cloudkserg11@gmail.com>
 */
class CarServiceParamFilter extends AFilter
{

    /**
     * car_service_id
     *
     * @var int
     */
    public $car_service_id;


    /**
     * rules
     *
     * @return array
     */
    public function rules()
    {
        return array(
            array('car_service_id', 'numerical')
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
            'car_service_id' => 'Сервис'
        );
    }




}
