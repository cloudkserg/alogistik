<?php
/**
 * CarService
 *
 * @version 1.0.0
 * @copyright Copyright 2011 by Kirya <cloudkserg11@gmail.com>
 * @author Kirya <cloudkserg11@gmail.com>
 */
class CarService extends CmsModel
{

    /**
     * tableName
     *
     * @return string
     */
    public function tableName()
    {
        return 'car_services';
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
                )
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
            array('title, length, width, height, begin_price', 'VText'),
            array('text,min_order', 'VText', 'max' => VText::MAX),
            array('sort, car_id', 'numerical')
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
            'car' => array(self::BELONGS_TO, 'Car', 'car_id'),
            'params' => array(self::HAS_MANY, 'CarServiceParam', 'car_service_id', 'scopes' => array('sort')),

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
                'text'         => 'Текст',
                'length'         => 'Длина',
                'width'         => 'Ширина',
                'height'         => 'Высота',
                'begin_price'         => 'Начальная цена',
                'car_id'         => 'Машина',
                'min_order' => 'Минимальный заказ'
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
                'bg' => array(
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
                'alt' => array(
                    'mode' => 'adaptive_crop',
                    'resize' => array(
                        'width' => '600',
                        'height' => '376',
                    ),
                    'crop' => array(
                        'width' => '600',
                        'height' => '376',
                    ),
                ),
            ),
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
