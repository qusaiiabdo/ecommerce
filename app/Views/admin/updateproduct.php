    <!-- Add Modal HTML -->


    <form id="update" method="post" action="productcontroller/update/<?= $product['id'] ?>" enctype="multipart/form-data">
        <div class="modal-header">
            <h4 class="modal-title">Update Product</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>Product</label>
                <input value="<?= $product['title'] ?>" type="text" name="title" id="title" class="form-control" required>
            </div>

            <label for="category_id" class="custom-label">Category:</label>
            <select name="category_id" id="category_id" class="custom-select" onchange="fetchSubcategories()" required>
                <option>Select a category...</option>
                <?php foreach ($categories as $category) : ?>
                    <?php if ($product['category_label'] == $category['label']) : ?>
                        <option value="<?= $category['id'] ?>" selected><?= $category['label'] ?></option>
                    <?php else : ?>
                        <option value="<?= $category['id'] ?>"><?= $category['label'] ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
            <br>
            <br>

            <label for="subcategory_id" class="custom-label">Subcategory:</label>
            <select name="subcategory_id" id="subcategory_id" class="custom-select" onchange="fetchFields()" required>
                <option value="">Select Subcategory:</option>

                <?php foreach ($product['subcategories'] as $subcategory) : ?>

                    <?php if ($product['subcategory_label'] == $subcategory['label']) : ?>
                        <option value="<?= $subcategory['id'] ?>" selected><?= $subcategory['label'] ?></option>
                    <?php else : ?>
                        <option value="<?= $subcategory['id'] ?>"><?= $subcategory['label'] ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>

            </select>


            <div id="custom-fields">


                <div class="modal-body">
                    <label for="">Details:</label>
                    <br>

                    <?php foreach ($subCategoryFields ?? [] as $assignModel) : ?>

                        <?php $options = $assignModel->field()->options(); ?>
                        <?php $fieldId = $assignModel->field()->id; ?>

                        <label class="custom_label" for="field_<?= $fieldId ?>"><?= $assignModel->field()->label ?>:</label>

                        <select class="custom-select" name="field[<?= $fieldId ?>]" id="field_<?= $fieldId ?>">
                            <?php foreach ($product['details'] as $fieldlabel => $optionlabel) : ?>
                                <?php if ($assignModel->field()->label == $fieldlabel) : ?>


                                    <?php foreach ($options as $option) : ?>
                                        <option value="<?= $option['id'] ?>" <?php if ($option['label'] == $optionlabel) echo 'selected' ?>><?= $option['label'] ?></option>
                                    <?php endforeach; ?>


                                <?php endif; ?>
                            <?php endforeach ?>

                        </select>

                    <?php endforeach; ?>

                </div>
            </div>





            <div class="form-group">
                <label>Price</label>
                <input type="number" name="price" id="price" class="form-control" value="<?= $product['price'] ?>" required>
            </div>

            <div class="form-group">
                <label>Image</label>
                <br>
                <img src="<?= base_url('writable/uploads/' . $product['image']) ?>" alt="Existing Image" width="200">
                <br>
                <br>
                <input type="file" name="image" class="form-control-file image-upload" accept="image/*">
            </div>


            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" required><?= $product['description'] ?></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" class="btn btn-info" value="Save">
        </div>
    </form>

    </div>