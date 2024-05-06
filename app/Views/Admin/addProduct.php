<?= $this->extend('admin/template/template'); ?>

<?= $this->section('content'); ?>
    <div class="container mt-3">
        <h1 class="mb-3">Form Tambah Produk</h1>
        <?php if(isset($validation)){ ?>
            <div class="alert alert-danger" role="alert">
                <?= \Config\Services::validation()->listErrors(); ?>       
            </div>
        <?php } ?>
        <form action="/admin/addProduct" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="row mb-3">
                <label for="id" class="col-sm-1 col-form-label">Id</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="id" name="id" autofocus value="<?= isset($input_data['id']) ? $input_data['id'] : ''; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="name" class="col-sm-1 col-form-label">Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="name" name="name" value="<?= isset($input_data['name']) ? $input_data['name'] : ''; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="description" class="col-sm-1 col-form-label">Description</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="description" name="description" value="<?= isset($input_data['description']) ? $input_data['description'] : ''; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="quantity" class="col-sm-1 col-form-label">Quantity</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="quantity" name="quantity" value="<?= isset($input_data['quantity']) ? $input_data['quantity'] : ''; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="price" class="col-sm-1 col-form-label">Price</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="price" name="price" value="<?= isset($input_data['price']) ? $input_data['price'] : ''; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="category" class="col-sm-1 col-form-label">Category</label>
                <div class="col-sm-8">
                    <?php foreach($categories as $category): ?>
                        <input type="radio" class="btn-check" name="category" id="<?= $category['id']; ?>" value="<?= $category['id']; ?>">
                        <label class="btn" for="<?= $category['id']; ?>"><?= $category['name']; ?></label>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="row mb-3">
                <label for="image" class="col-sm-1 col-form-label">Image</label>
           
                <div class="col-sm-8">
                    <input type="file" class="form-control" id="image" name="image" value="<?= isset($input_data['image']) ? $input_data['image'] : ''; ?>">
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Tambah</button>
        </form>
    </div>
    <br><br>
<?= $this->endSection(); ?>