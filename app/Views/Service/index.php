<?= $this->extend('layout/template_active'); ?>

<?= $this->section('content'); ?>

    <div class="container mt-5">
       
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach($services as $service): ?>
            <div class="col">
                    <div class="card border-warning mb-3" style="max-width: 18rem;">
                        <img src="/img/<?= $service['image']; ?>" class="card-img-top" height="300" alt="...">
                    <h5 class="card-title card-header text-center"><?= $service['name']; ?></h5>
                        <div class="card-body text-center">
                            <p class="card-text "><?= $service['description']; ?></p>
                            <h5 class="card-title card-header">Rp. <?= $service['price']; ?></h5>
                            <a href="/transaksi/booking/<?= $service['id']; ?>" class="btn btn-outline-warning mt-3 mx-auto">Booking</a>
                        </div>
                    </div>
            </div>
            <?php endforeach; ?>
           
        </div>
    </div>

    <br><br><br><br><br><br><br><br><br><br>
<?= $this->endSection(); ?>

