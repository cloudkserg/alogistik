<?php
	
	function generateConverterData($materials) {
        $jsonData = '{"data":[';
        
                
        $arrHelper = new ArrayHelper($materials); 
        
        foreach (array_reverse($materials) as $key => $material) {
        	$jsonData .= '{"text": "'.$material->title.'", "value": "'.$material->density.'"}';
        	
        	if (!$arrHelper->isLastKey($key)) {
        		$jsonData .= ',';
        	}
        }
                                    
        $jsonData .= ']}';
        
        return trim(preg_replace('/\s\s+/', ' ', $jsonData));
    }
	
?>

<div class="converter">
    <select class="converter__material_chooser" data-options='<?=generateConverterData($materials)?>'>
    </select>
    <div class="converter__input_container" data-units="tonns">
        <input class="converter__input" type="text" maxlength="5" value="1"/>
        <p class="converter__input_units">тонн</p>
    </div>
    <div class="converter__swap_btn" data-units="meters"></div>
    <div class="converter__result_container">
        <div class="converter__result odometer"></div>
        <p class="converter__result_units">м³</p>
    </div>

    <div class="converter__docket"></div>
    <div class="converter__click_area"></div>
    <div class="converter__info_btn"></div>
    <div class="converter__info">Расчёт конвертера<br/>является приблизительным</div>
</div><!-- /end .converter -->
