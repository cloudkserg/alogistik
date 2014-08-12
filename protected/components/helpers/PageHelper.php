<?php
class PageHelper
{

    /**
     * findForType
     *
     * @param mixed $type
     * @return void
     */
    public static function findForType($type)
    {
        $page = Page::model()->forType($type)->find();
        if (!isset($page)) {
            $page = new Page;
        }

        return $page;
    }

}
