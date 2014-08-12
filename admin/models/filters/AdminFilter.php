<?php

/**
 * Description of AdminFilter
 * 
 * @author art3mk4 <art3mk4@gmail.com>
 */
class AdminFilter extends CmsFilter
{

    //Ид
    public $id;
    
    //Текст
    public $text;
    
    //VDate
    public $dateStart;
    
    //VDate
    public $dateEnd;
    
    /**
     *
     * @var type 
     */
    public $district_id;
    
    /**
     *
     * @var type 
     */
    public $page_type_id;
    
    /**
     *
     * @var type 
     */
    public $project_type_id;

    /**
     *
     * @var type 
     */
    public $place_type_id;
    
    /**
     *
     * @var type 
     */
    public $menu_category_id;

    /**
    * @return array validation rules for model attributes.
    */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id, page_type_id, district_id, project_type_id, place_type_id, menu_category_id', 'numerical'),
            array('text', 'VText'),
            array('dateStart, dateEnd', 'VDate'),
        );
    }

    /**
     * Получаем список опций для соотвествующего поля
     * @param type $nameField
     * @return type 
     */
    public function getListOptions($nameField) 
    {
        $listData = array();
        switch ($nameField) {
            case 'page_type_id':
                $items = PageType::model()->last(50)->getItems();
                $listData = CHtml::listData($items, 'id', 'title');
                break;
            case 'district_id':
                $listData = District::model()->getData();
                break;
            case 'project_type_id':
                $listData = ProjectType::model()->getData();
                break;
            case 'place_type_id':
                $listData = PlaceType::model()->getData();
                break;
            case 'menu_category_id':
                $listData = MenuCategory::model()->getData();
                break;
            default:
                break;
        }
        return $listData;
    }

    /**
     * attributeLabels
     * @return type
     */
    public function attributeLabels()
    {
        return array(
            'id'               => 'Ид',
            'text'             => 'Текст',
            'dateStart'        => 'Дата старта',
            'dateEnd'          => 'Дата конца',
            'page_type_id'     => 'Тип страницы',
            'project_type_id'  => 'Тип проекта',
            'place_type_id'    => 'Тип площадки',
            'district_id'      => 'Район',
            'menu_category_id' => 'Категория меню'
        );
    }
}
