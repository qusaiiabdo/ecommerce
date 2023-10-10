<form id="deleteForm" method="post" action="productcontroller/delete/<?= $product['id'] ?>">
    <div class="modal-header">
        <h4 class="modal-title">Delete Product</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    </div>
    <div class="modal-body">
        <p>Are you sure you want to delete this product?</p>
        <p class="text-warning"><small>This action cannot be undone.</small></p>
        <input type="hidden" id="deleteId" name="delete_id" value="<?= $product['id'] ?>">
    </div>
    <div class="modal-footer d-flex justify-content-center">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-danger">Delete</button>
    </div>
</form>