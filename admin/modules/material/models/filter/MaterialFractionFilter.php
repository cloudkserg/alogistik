<?php
/**
 * MaterialFractionFilter
 *
 * @version 1.0.0
 * @copyright Copyright 2011 by Kirya <cloudkserg11@gmail.com>
 * @author Kirya <cloudkserg11@gmail.com>
 */
class MaterialFractionFilter extends AFilter
{

    /**
     * material_service_id
     *
     * @var int
     */
    public $material_service_id;


    /**
     * rules
     *
     * @return array
     */
    public function rules()
    {
        return array(
            array('material_service_id', 'numerical')
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
            'material_service_id' => 'Сервис'
        );
    }




}
