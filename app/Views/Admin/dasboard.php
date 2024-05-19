<?= $this->extend('admin/template/template'); ?>

<?= $this->section('content'); ?>

<?= $this->include('admin/template/category'); ?>

        <div class="col-10">
        <?php if(session()->getFlashdata('pesan')): ?>
            <div class="alert alert-primary" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php endif; ?>
            <h1 class="mb-3">Selamat Datang Admin</h1>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="card text-bg-secondary mb-3" style="max-width: 21rem;">
                        <div class="card-header"></div>
                        <div class="card-body">
                            <h5 class="card-title">Daftar Produk</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <div class="d-grid gap-2 col-6 mx-auto">
                                <a href="/admin/products" class="btn btn-danger btn-lg">Go</a>
                            </div>
                        </div>
                    </div>              
                </div>
                <div class="col">
                    <div class="card text-bg-primary mb-3" style="max-width: 21rem;">
                        <div class="card-header"></div>
                        <div class="card-body">
                            <h5 class="card-title">Service</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <div class="d-grid gap-2 col-6 mx-auto">
                                <a href="/admin/service" class="btn btn-danger btn-lg">Go</a>
                            </div>
                        </div>
                    </div>              
                </div>
                <div class="col">
                    <div class="card text-bg-success mb-3" style="max-width: 21rem;">
                        <div class="card-header"></div>
                        <div class="card-body">
                            <h5 class="card-title">Laporan Penjualan</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <div class="d-grid gap-2 col-6 mx-auto">
                                <a href="" class="btn btn-danger btn-lg">Go</a>
                            </div>
                        </div>
                    </div>              
                </div>
                <div class="col">
                    <div class="card text-bg-warning mb-3" style="max-width: 21rem;">
                        <div class="card-header"></div>
                        <div class="card-body">
                            <h5 class="card-title">Register Admin</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <div class="d-grid gap-2 col-6 mx-auto">
                                <a href="/admin/registrasi" class="btn btn-danger btn-lg">Go</a>
                            </div>
                        </div>
                    </div>              
                </div>
                <div class="col">
                    <div class="card text-bg-primary mb-3" style="max-width: 20rem;">
                        <div class="card-header">Register Admin</div>
                        <div class="card-body">
                            <h5 class="card-title">Primary card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p><a href="" class="card-title btn btn-danger my-auto">Go</a>
                        </div>
                    </div>              
                </div>
            </div>
        </div>
    </div>

<?= $this->endSection(); ?>