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
            array('service_id', 'numerical'),
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




}
