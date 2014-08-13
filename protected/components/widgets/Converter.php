<?php
/**
 * Converter
 *
 * @version 1.0.0
 * @copyright Copyright 2011 by Kirya <cloudkserg11@gmail.com>
 * @author Kirya <cloudkserg11@gmail.com>
 */
class Converter extends CWidget
{

    /**
     * run
     *
     * @return void
     */
    public function run()
    {
        $materials = Material::model()->sort()->findAll();

        $this->render('converter/index', array('materials' => $materials));
    
    }


}
