<?php
/**
 * ServiceHelper
 *
 * @version 1.0.0
 * @copyright Copyright 2011 by Kirya <cloudkserg11@gmail.com>
 * @author Kirya <cloudkserg11@gmail.com>
 */
class ServiceHelper
{

    /**
     * generatePopupData
     *
     * @param mixed $service
     * @return void
     */
    public static function generatePopupData($service) {
        $jsonData = '{';
        
        $jsonData .= '"desc":"'.$service->text.'",';
        $jsonData .= '"unit":"'.MaterialUnit::model()->getTitle($service->unit).'",';
        $jsonData .= '"fractions":[';
        
        $arrHelper = new ArrayHelper($service->fractions);
        
        foreach ($service->fractions as $key => $fraction) {
            $jsonData .= '{"fraction":"'.$fraction->title.'", "price":"'.$fraction->price.'", "img": "' . PImageHelper::firstImage($fraction, 'alt') . '"}';
            
            if (!$arrHelper->isLastKey($key)) {
                $jsonData .= ',';
            }
            
        }
        
        $jsonData .= ']}';
        
        return trim(preg_replace('/\s\s+/', ' ', $jsonData));
    }


}
