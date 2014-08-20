<?php
/**
 * ServiceItem
 *
 * @version 1.0.0
 * @copyright Copyright 2011 by Kirya <cloudkserg11@gmail.com>
 * @author Kirya <cloudkserg11@gmail.com>
 */
class ServiceItem extends CmsModel
{

    /**
     * tableName
     *
     * @return string
     */
    public function tableName()
    {
        return 'service_items';
    }

    /**
     * behaviors
     *
     * @return void
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            array(
                'manyManyBeh' => array(
                    'class' => 'ManyManyBehavior',
                ),
            )
        );
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

        if (isset($filter->service_id)) {
            $this->forService($filter->service_id);
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
            array('title', 'VText', 'max' => 1024),
            array('text', 'VText', 'max' => 150000),
            array('sort, service_id', 'numerical'),
            array('cars', 'VRelation'),
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
            'cars' => array(self::MANY_MANY, 'Car', array('service_item_id', 'car_id')),
            'service' => array(self::BELONGS_TO, 'Service', 'service_id')
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
                'text'         => 'Текст',
                'service_id' => 'Сервис',
                'cars' => 'Машины'
            )
        );
    }


    /**
     * forService
     *
     * @param int $service_id
     * @return ServiceItem
     */
    public function forService($service_id)
    {
        $this->getDbCriteria()->compare('service_id', $service_id);
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
