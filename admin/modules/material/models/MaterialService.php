<?php
/**
 * MaterialService
 *
 * @version 1.0.0
 * @copyright Copyright 2011 by Kirya <cloudkserg11@gmail.com>
 * @author Kirya <cloudkserg11@gmail.com>
 */
class MaterialService extends CmsModel
{

    /**
     * tableName
     *
     * @return string
     */
    public function tableName()
    {
        return 'material_services';
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

            array('material_id, begin_price', 'numerical'),
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
            'materialFractions' => array(self::HAS_MANY, 'MaterialFraction', 'material_service_id'),
            'material' => array(self::BELONGS_TO, 'Material', 'material_id'),

            'images' => ImageRelationDescription::create($this->abbrModel),
            'pubImages' => ImageRelationDescription::createPublished($this->abbrModel),
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
                'material_id'         => 'Материал',
                'begin_price' => 'Начальная цена',
                'text' => 'Текст'
            )
        );
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
                'min'  => array(
                    'mode' => 'adaptive_crop',
                    'resize' => array(
                        'width' => '130',
                        'height' => '100',
                    ),
                    'crop' => array(
                        'width' => '130',
                        'height' => '100',
                    ),
                ),
                'full' => array(
                    'mode' => 'adaptive_crop',
                    'resize' => array(
                        'width' => '500',
                        'height' => '300',
                    ),
                    'crop' => array(
                        'width' => '500',
                        'height' => '300',
                    ),
                ),
                'view' => array(
                    'mode' => 'adaptive_crop',
                    'resize' => array(
                        'width' => '165',
                        'height' => '125',
                    ),
                    'crop' => array(
                        'width' => '165',
                        'height' => '125',
                    ),
                ),
                'gallery' => array(
                    'mode' => 'adaptive_crop',
                    'resize' => array(
                        'width' => 140
                    )
                )
            ),
        );
    }





}
