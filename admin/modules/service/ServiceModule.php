<?php
/**
 * ServiceModule
 *
 * @version 1.0.0
 * @copyright Copyright 2011 by Kirya <cloudkserg11@gmail.com>
 * @author Kirya <cloudkserg11@gmail.com>
 */
class ServiceModule extends AModule
{

    /**
     * init
     *
     * @return void
     */
    public function init()
    {
        $this->setImport(array(
            'service.models.filter.*'
        ));

        parent::init();
    }

}
