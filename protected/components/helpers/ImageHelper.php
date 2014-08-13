<?php
/**
 * ImageHelper
 *
 * @version 1.0.0
 * @copyright Copyright 2011 by Kirya <cloudkserg11@gmail.com>
 * @author Kirya <cloudkserg11@gmail.com>
 */
class ImageHelper
{

    /**
     * firstImage
     *
     * @param mixed $item
     * @param mixed $scheme
     * @return void
     */
    public static function firstImage($item, $scheme = null)
    {
        if (!isset($item->images[0])) {
            return '';
        }

        return GetUrl::getImageUrl($item->images[0], $scheme);
    }

}
