<div class="converter">
    <select class="converter__material_chooser">
        <?php foreach ($materials as $material) : ?>
            <option data-data='{"text": "<?=$material->title?>", "destiny": "<?=$materal->density?>"}' value="<?=$material->id?>"></option>
        <?php endforeach; ?>
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
</div><!-- /end .converter -->