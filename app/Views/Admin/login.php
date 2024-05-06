<?= $this->extend('layout/template_pasive'); ?>

<?= $this->section('content'); ?>


    <div class="container mt-3">        
        <?php if(session()->getFlashdata('pesan')): ?>
            <div class="alert alert-primary" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php endif; ?>
        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger" role="alert">
                <?= session()->getFlashdata('error'); ?>
            </div>
        <?php endif; ?>

        <h1 class="mb-3">Login Admin</h1>
        <form action="/admin/login" method="post">
            <div class="mb-3 col-8">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
            </div>
            <div class="mb-3 col-8">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" >
            </div>
            <button class="btn btn-primary" type="submit">Login</button>
        </form>
    </div>
<?= $this->endSection(); ?>