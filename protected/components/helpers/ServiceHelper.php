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
    public static function generateMaterialPopupData($service) {
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



	/**
     * generatePopupData
     *
     * @param mixed $service
     * @return void
     */
    public static function generateTechnicPopupData($service) {
        $jsonData = '{';
        
        if (!empty($service->text)) {
        	$jsonData .= '"desc":"'.$service->text.'",';
        }
        if (!empty($service->min_order)) {
        	$jsonData .= '"min_order":"'.$service->min_order.'",';
        }
        
        $jsonData .= '"params":[';
        $jsonData .= '[';
        $jsonData .= '{"name":"Длина", "value": "'.$service->length.'", "ico": "length"},';
        $jsonData .= '{"name":"Ширина", "value": "'.$service->width.'", "ico": "width"},';
        $jsonData .= '{"name":"Высота", "value": "'.$service->height.'", "ico": "height"}';
        $jsonData .= ']';
        
        if (count($service->params) > 0) {
	        $jsonData .= ',[';
        }
        
        $arrHelper = new ArrayHelper($service->params); 
        
        foreach ($service->params as $key => $param) {
        	$jsonData .= '{"name": "'.$param->title.'", "value": "'.$param->value.'"}';
        	
        	if (!$arrHelper->isLastKey($key)) {
        		$jsonData .= ',';
        	}
        	
        	if ($arrHelper->isLastKey($key)) {
        		$jsonData .= ']';
        	}
        }
                                    
        $jsonData .= ']}';
        
        return trim(preg_replace('/\s\s+/', ' ', $jsonData));
    }

}
