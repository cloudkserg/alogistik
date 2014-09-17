<?php
/**
 * MaterialUnit
 *
 * @version 1.0.0
 * @copyright Copyright 2011 by Kirya <cloudkserg11@gmail.com>
 * @author Kirya <cloudkserg11@gmail.com>
 */
class MaterialUnit extends ConstDirectoryModel
{

    const TON = 0;
    const METER = 1;

    /**
     * getTitles
     *
     * @return array
     */
    public function getTitles()
    {
        return array(
            self::TON => 'тонн',
            self::METER => 'м³'
        );
    }


}
