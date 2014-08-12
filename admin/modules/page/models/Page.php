<?php
/**
 * Page
 *
 * @version 1.0.0
 * @copyright Copyright 2011 by Kirya <cloudkserg11@gmail.com>
 * @author Kirya <cloudkserg11@gmail.com>
 */
class Page extends CmsModel
{

    /**
     * tableName
     *
     * @return string
     */
    public function tableName()
    {
        return 'pages';
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
                'fileBeh' => array(
                    'class' => 'FileBehavior',
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
        $dbCriteria = $this->getDbCriteria();

        if (isset($filter->text)) {
            $this->forTextField(array('title', 'text'), $filter->text);
        }
        if (isset($filter->page_type_id)) {
            $dbCriteria->compare('page_type_id', $filter->page_type_id);
        }
        $this->getDbCriteria()->mergeWith($dbCriteria);
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
            array('published, type', 'numerical'),
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
            'files' => FileRelationDescription::create($this->abbrModel),
            'pubFiles' => FileRelationDescription::createPublished($this->abbrModel),

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
                'type' => 'Тип страницы'
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


    /**
     * forType
     *
     * @param int $type
     * @return Page
     */
    public function forType($type)
    {
        $this->getDbCriteria()->compare('type', $type);
        return $this;
    }



}
