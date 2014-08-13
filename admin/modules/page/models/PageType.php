<?php

/*
 * Description of PageType
 *
 * @author art3mk4
 * 
 */
class PageType extends ConstDirectoryModel
{
    const CAR_PRICE = 0;
    const MATERIAL_PRICE = 1;


    /**
     * getTitles
     *
     * @return array
     */
    public function getTitles()
    {
        return array(
            self::CAR_PRICE => 'Прайс по машинам',
            self::MATERIAL_PRICE => 'Прайс по материалам'
        );
    }

}
