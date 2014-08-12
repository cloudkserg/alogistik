<?php
/**
 * PageController
 *
 * @version 1.0.0
 * @copyright Copyright 2011 by Kirya <cloudkserg11@gmail.com>
 * @author Kirya <cloudkserg11@gmail.com>
 */
class PageController extends Controller
{

    /**
     * actionView
     *
     * @param mixed $id
     * @return void
     */
    public function actionView($id = null, $alias = null)
    {
        if (!empty($alias)) {
            $pageType = PageType::model()->getIdByAlias($alias);
            $item = Page::model()->published()->findByAttributes(array('page_type_id' => $pageType));
        } else {
            if (!is_numeric($id)) {
                throw new CHttpException('404', "Страница не существует");
            }

            $item = Page::model()->findByPk($id);
        }

        if (!isset($item)) {
            throw new CHttpException('404', "Страница не существует");
        }

        $this->render(
            'view', 
            array(
                'item' => $item
            )
        );
    
    }


}
