<?= $this->extend('layout/template_active'); ?>

<?= $this->section('content'); ?>

<div class="row mt-3"> 
    <div class="col-10">
        <div class="container mt-3">
        <?php if(session()->getFlashdata('pesan')): ?>
            <div class="alert alert-danger" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php endif; ?>
        <h1>Ganti Password</h1>   
        <?php if(isset($validation)){ ?>
            <div class="alert alert-danger" role="alert">
                <?= \Config\Services::validation()->listErrors(); ?>       
            </div>
        <?php } ?>
            <form action="/users/password" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row my-3">
                    <label for="old_password" class="col-sm-1 col-form-label">Old Password</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="old_password" name="old_password" autofocus >
                    </div>
                </div>
                
                <div class="row mb-3">
                    <label for="new_password" class="col-sm-1 col-form-label">New Password</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="new_password" name="new_password">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="konfirmasi_password" class="col-sm-1 col-form-label">Konfirmasi Password</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password">
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Update</button>
            </form>
        </div>
    </div>
</div>
    <br><br><br><br><br>
<?= $this->endSection(); ?>