<?php
/**
 * Controller
 *
 * @version 1.0.0
 * @copyright Copyright 2011 by Kirya <cloudkserg11@gmail.com>
 * @author Kirya <cloudkserg11@gmail.com>
 */
class Controller extends AController
{
    /**
     * layout
     *
     * @var string
     * @access public
     */
    public $layout='//layouts/main';

    //Фильтр
    public $filter;


    /**
     * filters
     *
     * @return array
     */
    public function filters()
    {
        return array('accessControl');
    }

}
