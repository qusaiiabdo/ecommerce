    <!-- Add Modal HTML -->


                <form id="add" method="post" action="productcontroller/store" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Product</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Product</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>

                        <label for="category_id" class="custom-label">Category:</label>
                        <select name="category_id" id="category_id" class="custom-select" onchange="fetchSubcategories()" required>
                            <option value="select">Select a category...</option>
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?= $category['id'] ?>"><?= $category['label'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <br>
                        <br>

                        <label for="subcategory_id" class="custom-label">Subcategory:</label>
                        <select name="subcategory_id" id="subcategory_id" class="custom-select" onchange="fetchFields()" required>
                            <option value="">Select Subcategory:</option>
                         

                        </select>
                        <div id="custom-fields"></div>


                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" name="price" id="price" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control-file image-upload" accept="image/*" required>
                        </div>


                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-info" value="Save">
                    </div>
                </form>
