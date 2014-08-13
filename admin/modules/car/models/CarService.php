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
            array('title, length, width, height', 'VText'),
            array('text', 'VText', 'max' => VText::MAX),
            array('sort, car_id, begin_price', 'numerical')
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
            'params' => array(self::HAS_MANY, 'CarServiceParam', 'car_service_id'),

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
                        'width' => '165',
                        'height' => '125',
                    ),
                    'crop' => array(
                        'width' => '165',
                        'height' => '125',
                    ),
                ),
            ),
        );
    }




}
