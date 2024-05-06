<?= $this->extend('admin/template/template'); ?>

<?= $this->section('content'); ?>

<div class="row mt-3"> 
    <div class="col-2">
        <ul class="nav flex-column">
            <li class="nav-item">
                <h3>Category</h3>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/admins/password">Ganti Password</a>
            </li>        
        </ul>
    </div>
    <div class="col-10">
        <div class="container mt-3">
        <h1>Update Profile</h1>   
        <?php if(isset($validation)){ ?>
            <div class="alert alert-danger" role="alert">
                <?= \Config\Services::validation()->listErrors(); ?>       
            </div>
        <?php } ?>
            <form action="/admin/akun" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row my-3">
                    <label for="email" class="col-sm-1 col-form-label">Email</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" id="email" placeholder="example@gmail.com" name="email" autofocus value="<?= isset($admin['email']) ? $admin['email'] : ''; ?>">
                    </div>
                </div>

                <input type="hidden" class="form-control" id="password" name="password" value="<?= isset($admin['password']) ? $admin['password'] : ''; ?>">
                
                <div class="row mb-3">
                    <label for="name" class="col-sm-1 col-form-label">Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="name" name="name" value="<?= isset($admin['name']) ? $admin['name'] : ''; ?>">
                    </div>
                </div>

                <input type="hidden"name="old_image" value="<?= isset($admin['image']) ? $admin['image'] : ''; ?>">

                <div class="row mb-3">
                    <label for="image" class="col-sm-1 col-form-label">Image</label>
                    <div class="col-sm-8">
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Update</button>
            </form>
        </div>
    </div>
</div>
    <br><br><br><br><br>
<?= $this->endSection(); ?>