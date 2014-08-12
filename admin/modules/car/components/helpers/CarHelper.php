<?php
/**
 * CarHelper
 *
 * @version 1.0.0
 * @copyright Copyright 2011 by Kirya <cloudkserg11@gmail.com>
 * @author Kirya <cloudkserg11@gmail.com>
 */
class CarHelper
{

    /**
     * printItems
     *
     * @param array $items
     * @return void
     */
    public static function printItems(array $items)
    {
        $titles = CHtml::listData($items, 'id', 'title');
        return implode(', ', $titles);
    }

}
