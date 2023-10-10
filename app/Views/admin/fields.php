
<?php

use App\Models\CategoryModel;

/**
 * @var CategoryModel[] $subCategories
 */
?>



    <div class="modal-body">

    <?php foreach ($subCategoryFields ?? [] as $assignModel) : ?>

        <?php $options = $assignModel->field()->options(); ?>
        <?php $fieldId=$assignModel->field()->id;?>
    
            <label class="custom_label" for="field_<?=$fieldId?>"></label>
            
            <select class="custom-select" name="field[<?=$fieldId?>]" id="field_<?=$fieldId?>" >
                <option value="qusai"><?= $assignModel->field()->label ?></option>
                <?php foreach ($options as $option) : ?>
                    <option value="<?= $option['id'] ?>"><?= $option['label'] ?></option>
                <?php endforeach; ?>
            </select>
 
    <?php endforeach; ?>

</div>
