<?= $this->extend('client/layouts/main') ?>
<?= $this->section('content') ?>
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
                    Signup
                </div>

                <div class="card-body">

                        <form action="/client/Auth/signup" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= set_value('username') ?>">
                            <?php if (isset($validation) && $validation->getError('username')) : ?>
                                <div class="text-danger"><?= $validation->getError('username') ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?=set_value('email')?>">
                            <?php if(isset($validation) && $validation->getError('email')) :?>
                                <div class="form-text text-danger"><?=$validation->getError('email')?></div>
                                <?php endif;?>
                            
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <?php if (isset($validation) && $validation->getError('password')) : ?>
                                <div class="form-text text-danger"><?= $validation->getError('password') ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirm" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirm" id="password_confirm" class="form-control">
                            <?php if(isset($validation) && $validation->getError('password_confirm')):?>
                                <div class="form-text text-danger"><?=$validation->getError('password_confirm')?></div>
                                <?php endif;?>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <button type="submit" class="btn btn-dark btn-block">Login</button>
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