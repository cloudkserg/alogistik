<?php

/*
 * Description of PageType
 *
 * @author art3mk4
 * 
 */
class PageType extends ConstDirectoryModel
{
    const PRICE = 0;


    /**
     * getTitles
     *
     * @return array
     */
    public function getTitles()
    {
        return array(
            self::PRICE => 'Прайс'
        );
    }

}
