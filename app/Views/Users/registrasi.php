<?= $this->extend('layout/template_pasive'); ?>

<?= $this->section('content'); ?>
    <div class="container mt-3">
    <h1>Register User</h1>
    <?php if(isset($validation)){ ?>
        <div class="alert alert-danger" role="alert">
            <?= \Config\Services::validation()->listErrors(); ?>       
        </div>
    <?php } ?>
        <form action="/users/registrasi" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="row my-3">
                <label for="email" class="col-sm-1 col-form-label">Email</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" id="email" placeholder="example@gmail.com" name="email" autofocus value="<?= isset($input_data['email']) ? $input_data['email'] : ''; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="password" class="col-sm-1 col-form-label">Password</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" id="password" name="password">
                </div>
            </div>
            <div class="row mb-3">
                <label for="name" class="col-sm-1 col-form-label">Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="name" name="name" value="<?= isset($input_data['name']) ? $input_data['name'] : ''; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="image" class="col-sm-1 col-form-label">Image</label>
                <div class="col-sm-8">
                    <input type="file" class="form-control" id="image" name="image" value="<?= isset($input_data['image']) ? $input_data['image'] : ''; ?>">
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Register</button>
        </form>
    </div>
<?= $this->endSection(); ?>