<?php
/**
 * Service
 *
 * @version 1.0.0
 * @copyright Copyright 2011 by Kirya <cloudkserg11@gmail.com>
 * @author Kirya <cloudkserg11@gmail.com>
 */
class Service extends CmsModel
{

    /**
     * tableName
     *
     * @return string
     */
    public function tableName()
    {
        return 'services';
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
            array('title', 'VText'),
            array('text', 'VText', 'max' => VText::MAX),
            array('sort', 'numerical')
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
            'serviceItems' => array(self::HAS_MANY, 'ServiceItem', 'service_id', 'scopes' => array('sort'))
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
                'text' => 'Текст'
            )
        );
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
