<?= $this->extend('client/layouts/main') ?>
<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="/css/new.css">

<style>
    
       
       body {
       background-image: url('/images/shopwise.jpg');
       background-size: cover; /* Adjust the background size */
       background-repeat: no-repeat;
       background-attachment: fixed; /* Optional: Keep the background fixed while scrolling */
       background-color: #f8f9fa; /* Fallback background color */
   }

   @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');

</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Login
                </div>

                <div class="card-body">
                    <?php if (session()->get('success')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->get('success') ?>
                        </div>
                    <?php endif; ?>
                    <form action="/client/auth/login" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= set_value('username') ?>">
                            <?php if (isset($validation) && $validation->getError('username')) : ?>
                                <div class="form-text text-danger"><?= $validation->getError('username') ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <?php if (isset($validation) && $validation->getError('password')) : ?>
                                <div class="form-text text-danger"><?= $validation->getError('password') ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <button type="submit" class=" btn btn-color px-5 mb-5 w-100">Login</button>
                            </div>
                            <div class="col-12 col-sm-8 text-right">
                                <a href="/auth/signup">Don't have an account yet?</a>
                            </div>
                        </div>
                    </form>
                    <?php if (isset($error)) : ?>
                        <div class="alert alert-danger mt-4">
                            <?= $error ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
