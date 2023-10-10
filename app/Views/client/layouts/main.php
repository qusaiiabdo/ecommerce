
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Shop Homepage - Start Bootstrap Template</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link rel="stylesheet" type="text/css" href="/css/styles.css">
        <!-- <style>
       
       body {
       background-image: url('/images/shopwise.jpg');
       background-size: cover; /* Adjust the background size */
       background-repeat: no-repeat;
       background-attachment: fixed; /* Optional: Keep the background fixed while scrolling */
       background-color: #f8f9fa; /* Fallback background color */
   }

   @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');

</style> -->
    </head>
    <body>

   

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="#!">ShopwisE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="/clientdashboard">Home</a></li>
                
                <li class="nav-item"><a class="nav-link" href="/clientdashboard/about">About</a></li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/clientdashboard">All Products</a></li>
                            <li><hr class="dropdown-divider" /></li>
                            <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                            <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                        </ul>
                </li>
            </ul>
            <form class="d-flex">
            <div class="container px-2 px-sm-5">
                
<div class="d-flex">
<div class="dropdown">
    <a class="btn btn-outline-success me-2 dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi-person me-1"></i>
        <?php if (session()->get('isloggedIn')): ?>
            <?= session()->get('username') ?>
        <?php endif; ?>
    </a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
        <?php if (session()->get('isloggedIn')): ?>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="<?= site_url('client/auth/logout') ?>">Logout</a></li>
        <?php else: ?>
            <li><a class="dropdown-item" href="<?= route_to('auth.login')?>">Login</a></li>
        <?php endif; ?>
    </ul>
</div>



            
            
            

    
    <?php if(session()->get('isloggedIn')):?>
    <a class="btn btn-outline-dark" type="submit" href="/clientdashboard/cartItems">
        <i class="bi-cart-fill me-1"></i>
        Cart
        <span class="badge bg-dark text-white ms-1 rounded-pill"><?= session()->get('totQuantity') ?? 0?></span>
    </a>
    <?php endif?>
</div>

            </form>
        </div>
        </div>
    </div>
</nav>


        <?=$this->renderSection('content')?>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
