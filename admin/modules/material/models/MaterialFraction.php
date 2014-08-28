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
     * behaviors
     *
     * @return void
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            array(
                'imageBeh' => array(
                    'class' => 'ImageBehavior',
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

            array('price, material_service_id,sort, main', 'numerical'),
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
            'materialService' => array(self::BELONGS_TO, 'MaterialService', 'material_service_id'),

            'images' => ImageRelationDescription::create($this->abbrModel),
            'pubImages' => ImageRelationDescription::createPublished($this->abbrModel)
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
                'main' => 'Главный',
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

    /**
     * published
     *
     * @return void
     */
    public function published()
    {
        return $this;
    }

    /**
     * main
     *
     * @return void
     */
    public function main()
    {
        $this->getDbCriteria()->compare('main', 1);
        return $this;
    }

    /**
     * Функция для получения опций картинок
     *
     * Формат:
     * @return array  (
     * model_field - поле которое идентифицируют данные картинки
     * model_field =>  array(options)
     * )
     *
     */
    public function getImageOptions()
    {
        return array(
            'thumbs' => array(
                'bg' => array(
                    'mode' => 'adaptive_crop',
                    'resize' => array(
                        'width' => '320',
                        'height' => '180',
                    ),
                    'crop' => array(
                        'width' => '320',
                        'height' => '180',
                    ),
			'blur' => array()
                ),
                'alt' => array(
                    'mode' => 'adaptive_crop',
                    'resize' => array(
                        'width' => '460',
                        'height' => '346',
                    ),
                    'crop' => array(
                        'width' => '460',
                        'height' => '346',
                    ),
                ),
            ),
        );
    }

}
