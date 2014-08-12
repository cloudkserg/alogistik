<?php

/**
 * Description of PageModule
 *
 * @author art3mk4 <Art3mk4@gmail.com>
 */
class PageModule extends CWebModule
{

    /**
     * init
     * 
     * @return void
     */
    public function init()
    {
        $this->setImport(
            array(
                'page.models.*'
            )
        );
    }
}
