<?php
/**
 * CarServiceParam
 *
 * @version 1.0.0
 * @copyright Copyright 2011 by Kirya <cloudkserg11@gmail.com>
 * @author Kirya <cloudkserg11@gmail.com>
 */
class CarServiceParam extends CmsModel
{

    /**
     * tableName
     *
     * @return string
     */
    public function tableName()
    {
        return 'car_service_params';
    }


    /**
     * applySearch
     *
     * @param mixed $filter
     * @return void
     */
    public function applySearch($filter)
    {
        $criteria = new CDbCriteria();

        if (isset($filter->car_service_id)) {
            $this->forCarService($filter->car_service_id);
        }
    
    
        return $this;
    }

    /**
     * rules
     *
     * @return void
     */
    public function rules()
    {
        return array(
            array('title', 'required'),
            array('title, value', 'VText'),
            array('sort, car_service_id', 'numerical')
        );
    }

    /**
     * relations
     *
     * @return void
     */
    public function relations()
    {
        return array(
            'carService' => array(self::BELONGS_TO, 'CarService', 'car_service_id')
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
                'title'        => 'Название',
                'value' => 'Значение',
                'car_service_id'         => 'Сервис машины'
            )
        );
    }


    /**
     * forCarService
     *
     * @param int $service_id
     * @return CarFraction
     */
    public function forCarService($service_id)
    {
        $this->getDbCriteria()->compare('car_service_id', $service_id);
        return $this;
    }


    /**
     * published
     *
     * @return void
     */
    public function published()
    {
        return $this;
    }


}
