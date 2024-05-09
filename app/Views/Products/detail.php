<?= $this->extend('layout/template_active'); ?>

<?= $this->section('content'); ?>
        <div class="container">
            <div class="col-6">
                <div class="card mb-3">
                    <img src="/img/<?= $product['image']; ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= $product['name']; ?></h5>
                        <p class="card-text"><?= $product['description']; ?></p>
                        <p class="card-text"><small class="text-body-secondary">Stok : <?= $product['quantity']; ?></small></p>
                        <p class="card-text"><small class="text-body-secondary">Harga : <?= $product['price']; ?></small></p>
                        <div class="text-center">
                            <button class="btn btn-success mx-2">Buy</button>
                            <form action="/keranjang/add/<?= $product['id']; ?>" method="post" class="d-inline">
                                <button class="btn btn-warning mx-2" type="submit">Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
<?= $this->endSection(); ?>