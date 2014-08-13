<?php
/**
 * MaterialModule
 *
 * @version 1.0.0
 * @copyright Copyright 2011 by Kirya <cloudkserg11@gmail.com>
 * @author Kirya <cloudkserg11@gmail.com>
 */
class MaterialModule extends AModule
{
    /**
     * init
     *
     * @return void
     */
    public function init()
    {
        $this->setImport(array(
            'material.models.filter.*'
        ));

        parent::init();
    }


}
