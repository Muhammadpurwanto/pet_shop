<?= $this->extend('layout/template_pasive'); ?>

<?= $this->section('content'); ?>
  <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../img/walpaper1.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h1 class="mb-5">WELCOME TO OUR WEBSITE</h1>
                    <div class="d-grid gap-2 col-4 mx-auto mb-5">
                        <a href="/admin/login" class="btn btn-primary btn-lg opacity-50">Login</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item active">
                <img src="../img/walpaper2.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h1 class="mb-5">WELCOME TO OUR WEBSITE</h1>
                    <div class="d-grid gap-2 col-4 mx-auto mb-5">
                        <a href="/admin/login" class="btn btn-primary btn-lg opacity-50">Login</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item active">
                <img src="../img/walpaper3.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h1 class="mb-5">WELCOME TO OUR WEBSITE</h1>
                    <div class="d-grid gap-2 col-4 mx-auto mb-5">
                        <a href="/admin/login" class="btn btn-primary btn-lg opacity-50">Login</a>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
<?= $this->endSection(); ?>