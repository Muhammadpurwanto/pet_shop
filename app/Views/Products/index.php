<?= $this->extend('layout/template_active'); ?>

<?= $this->section('content'); ?>
    <div class="row mt-3">
        
        
        <?php use App\Controllers\Categories;?>
        <?= Categories::index(); ?>
        
        <div class="col-10">
            <?php if(session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= session()->getFlashdata('error'); ?>
                    </div>
            <?php endif; ?>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php foreach($products as $product): ?>
                <div class="col">
                    <div class="card h-100">
                        <img src="/img/<?= $product['image']; ?>" class="card-img-top" alt="..." height="280">
                        <div class="card-body">
                            <h5 class="card-title"><?= $product['name']; ?></h5>
                            <p class="card-text"><?= $product['description']; ?></p>
                            <p class="card-text">Stok  :<?= $product['quantity']; ?></p>
                            <p class="card-text">Harga :<?= $product['price']; ?></p>
                            <a href="/products/detail/<?= $product['id']; ?>" class="btn btn-outline-success">Detail</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
              
            </div>

        </div>
    </div>

<?= $this->endSection(); ?>