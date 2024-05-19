<?= $this->extend('admin/template/template'); ?>

<?= $this->section('content'); ?>
    <div class="container mt-3">
        <h1 class="mb-3">Form Update Produk</h1>
        <?php if(isset($validation)){ ?>
            <div class="alert alert-danger" role="alert">
                <?= \Config\Services::validation()->listErrors(); ?>       
            </div>
        <?php } ?>
        <form action="/admin/updateService/<?= $service['id']; ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="row mb-3">
                <label for="name" class="col-sm-1 col-form-label">Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="name" name="name" value="<?= isset($service['name']) ? $service['name'] : ''; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="description" class="col-sm-1 col-form-label">Description</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="description" name="description" value="<?= isset($service['description']) ? $service['description'] : ''; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="price" class="col-sm-1 col-form-label">Price</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="price" name="price" value="<?= isset($service['price']) ? $service['price'] : ''; ?>">
                </div>
            </div>
            <input type="hidden" name="old_image" value="<?= isset($service['image']) ? $service['image'] : ''; ?>">
            
            <div class="row mb-3">
                <label for="image" class="col-sm-1 col-form-label">Image</label>
                <div class="col-sm-8">
                    <input type="file" class="form-control" id="image" name="image">
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Update</button>
        </form>
    </div>
    <br><br><br><br>
<?= $this->endSection(); ?>