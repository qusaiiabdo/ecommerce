<!-- Extend the main layout -->
<?= $this->extend('client/layouts/main') ?>

<!-- Define the content section -->
<?= $this->section('content') ?>
<style>

.quantity-info {
    font-size: 16px;
    color: #333;
    margin: 0; /* Remove any default margin */
}

p {
            font-size: 24px; /* Adjust the font size as needed */
            color: #333; /* Text color */
            text-align: center; /* Center the text horizontally */
            margin-top: 20px; /* Add some space at the top */
        }

.card {
   
    border-radius: 20px;
    border: none;
    box-shadow: 1px 5px 10px 1px rgba(0,0,0,0.2);
}

/* Style the label "Quantity:" */
.quantity-label {
    font-weight: bold;
    margin-right: 5px; /* Add some spacing between the label and value */
}

/* Style the quantity value */
.quantity-value {
    color: red; /* Change the color of the quantity value */
    font-size: 18px; /* Adjust the font size of the quantity value */
}

</style>

    <div class="container py-5 text-center ">
    <h2>
    Your Cart
    <span class="bi bi-cart-fill me-1"></span>
</h2>

        <?php if (isset($cartItems)) : ?>

            <section class="py-5 bg-light rounded card ">
            <div class="container px-4 px-lg-5 mt-5">
                <h2 class="fw-bolder mb-4">Cart details</h2>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                
                    <?php foreach($cartItems as $item) {?>
                        <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <img class="card-img-top" src="<?= base_url('writable/uploads/' . $item['cartItem']['image']) ?>" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder"><?= $item['cartItem']['title'] ?></h5>
                                <!-- Product price-->
                                <?= $item['cartItem']['price'] . '$' ?>

                                <p class="quantity-info">
    <span class="quantity-label">Quantity:</span>
    <span class="quantity-value"><?= $item['quantity'] ?></span>
</p>

                                
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="/clientdashboard/options/<?= $item['cartItem']['id'] ?>">View options</a></div>
                            <br>
                            <div class="text-center"><a href="/clientdashboard/removeFromCart/<?= $item['cartItem']['id'] ?>" class="btn btn-danger">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>

                <?php } ?>

                        </div>
                        <div class="text-center">
    <a href="/clientdashboard/checkout" class="btn btn-outline-success mt-auto ">Proceed to Checkout ✓</a>
</div>
  </div>

        <?php else : ?>
            <section class="py-5 bg-light rounded card ">
            <p>Your cart is empty.  &#x1F622;</p>
                </div>
            </div>
        </section>

          
        <?php endif; ?>
    </div>
    
<?= $this->endSection() ?>
