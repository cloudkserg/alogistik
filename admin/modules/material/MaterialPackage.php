<?php
/**
 * MaterialPackage
 *
 * @version 1.0.0
 * @copyright Copyright 2011 by Kirya <cloudkserg11@gmail.com>
 * @author Kirya <cloudkserg11@gmail.com>
 */
class MaterialPackage extends Package
{
    /**
     * getConsoleConfig
     *
     * @return array
     */
    public function getConsoleConfig()
    {
        return $this->getConfig();
    }

}
