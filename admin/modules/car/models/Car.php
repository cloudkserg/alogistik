<?php
/**
 * Car
 *
 * @version 1.0.0
 * @copyright Copyright 2011 by Kirya <cloudkserg11@gmail.com>
 * @author Kirya <cloudkserg11@gmail.com>
 */
class Car extends CmsModel
{

    /**
     * tableName
     *
     * @return string
     */
    public function tableName()
    {
        return 'cars';
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
            array('sort', 'numerical')
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
                'title'        => 'Название'
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
