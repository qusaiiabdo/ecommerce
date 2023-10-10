<html>

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="/css/custom.css">
    <!-- <link rel="stylesheet" type="text/css" href="/css/styles.css"> -->
    <style>
        .rounded {
            border-radius: var(--bs-border-radius) !important;
        }

    </style>

</head>

<body>

    <!-- Edit Modal HTML -->
    <div id="modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">

            </div>
        </div>
    </div>



    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-20">
            <a class="navbar-brand" href="#!">Shopwise</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/clientdashboard/about">About</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#!">All Products</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                            <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
    <div class="container">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Manage<b> Products</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <button data-modal='<?= route_to('create') ?>' class="btn btn-success" data-toggle="modal"><i class="material-icons"></i> <span>Add Product</span></button>

                        </div>
                    </div>
                </div>

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>

                            <th>Product</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Subcategory</th>
                            <th>Details</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        use App\Models\ProductValueModel;

                        foreach ($products as $product) { ?>

                            <tr>

                                <td><?= $product['title'] ?></td>
                                <td><?= $product['description'] ?></td>
                                <td><?= $product['category_label'] ?></td>
                                <td><?= $product['subcategory_label'] ?></td>

                                <td>
                                    <ul>
                                        <?php foreach ($product['details'] as $field => $option) : ?>
                                            <li>
                                                
                                                <strong><?= $field ?>:</strong> <?= $option ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </td>



                                <td><img src="<?= base_url('writable/uploads/' . $product['image']) ?>" alt="<?= $product['title'] ?>" style="max-width: 150px;"></td>
                                <td><?= $product['price'] . '$' ?></td>


                                <td>
                                    <a data-modal='<?= route_to('edit', $product['id']) ?>' data-id="<?= $product['id'] ?>" class="edit" data-toggle="modal" data-target="#myModal"><i class="material-icons" data-toggle="tooltip" title="Edit"></i></a>
                                    <a data-modal='<?= route_to('delete', $product['id']) ?>' data-delete_id="<?= $product['id'] ?>" class="delete"><i class="material-icons" data-toggle="tooltip" title="Delete"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>






    <script>
        function fetchSubcategories() {

            $('#custom-fields').html('');
            // alert('rrtr')
            const categorySelect = document.getElementById('category_id');
            const subcategorySelect = document.getElementById('subcategory_id');
            const selectedCategoryId = categorySelect.value;
            console.log(selectedCategoryId);

            $.ajax({

                url: 'productcontroller/fetchSubcategories',
                method: 'POST',
                data: {
                    category_id: selectedCategoryId
                },
                dataType: 'json',

                success: function(data) {
                    subcategorySelect.innerHTML = '';
                    //console.log(data);
                    const defaultOption = document.createElement('option');
                    defaultOption.textContent = "Select";
                    subcategorySelect.appendChild(defaultOption);

                    data.forEach(subcategory => {

                        // console.log(subcategory);

                        const option = document.createElement('option');
                        option.value = subcategory.id;
                        option.textContent = subcategory.label;
                        subcategorySelect.appendChild(option);
                    })
                }
            })
        }


        function fetchFields() {
            const subcategorySelect = document.getElementById('subcategory_id');

            $.ajax({

                url: 'productcontroller/fetchFields',
                method: 'POST',
                data: {
                    subcategory_id: subcategorySelect.value
                },

                success: function(response) {
                    $('#custom-fields').html(response);
                }

            })


        }

        $("[data-modal]").on('click', function() {
            const url = $(this).data('modal');
            const modal = $("#modal");
            modal.find('.modal-content').load(url)
            modal.modal().show()
        })

        // $(document).ready(function() {
        //     $('.edit').on('click', function() {
        //         var productId = $(this).data('id');
        //         console.log(productId);

        //         $.ajax({
        //             url: 'productcontroller/edit/' + productId,
        //             method: 'GET',
        //             dataType: 'json',

        //             success: function(data) {
        //                 console.log(response);
             
        //                 $('#custom-fields').html(response);

        //             }


        //         })
        //     });
        // });

    </script>





</body>

</html>