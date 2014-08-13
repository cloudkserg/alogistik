<?php
/**
 * MaterialFraction
 *
 * @version 1.0.0
 * @copyright Copyright 2011 by Kirya <cloudkserg11@gmail.com>
 * @author Kirya <cloudkserg11@gmail.com>
 */
class MaterialFraction extends CmsModel
{

    /**
     * tableName
     *
     * @return string
     */
    public function tableName()
    {
        return 'material_fractions';
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

        if (isset($filter->material_service_id)) {
            $this->forMaterialService($filter->material_service_id);
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
            array('title', 'VText'),

            array('price, material_service_id,sort', 'numerical'),
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
            'materialService' => array(self::BELONGS_TO, 'MaterialService', 'material_service_id')
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
                'material_service_id'         => 'Сервис материала',
                'price' => 'Цена'
            )
        );
    }



    /**
     * forMaterialService
     *
     * @param int $service_id
     * @return MaterialFraction
     */
    public function forMaterialService($service_id)
    {
        $this->getDbCriteria()->compare('material_service_id', $service_id);
        return $this;
    }



}
