<?php
/**
 * PFileHelper
 *
 * @version 1.0.0
 * @copyright Copyright 2011 by Kirya <cloudkserg11@gmail.com>
 * @author Kirya <cloudkserg11@gmail.com>
 */
class PFileHelper
{

    /**
     * firstFile
     *
     * @param mixed $item
     * @return void
     */
    public static function firstFile($item)
    {
        if (!isset($item->files[0])) {
            return '';
        }

        return GetUrl::getFileUrl($item->files[0]);
    }

}
