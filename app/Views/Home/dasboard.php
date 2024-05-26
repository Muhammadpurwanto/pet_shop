<?= $this->extend('layout/template_active'); ?>

<?= $this->section('content'); ?>

    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../img/walpaper1.jpg" class="d-block w-100" alt="...">
        
            </div>
            <div class="carousel-item active">
                <img src="../img/walpaper2.jpg" class="d-block w-100" alt="...">
                
            </div>
            <div class="carousel-item active">
                <img src="../img/walpaper3.jpg" class="d-block w-100" alt="...">
                
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
    <div class="container mt-5">
       
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <a href="/products/index" class="btn active">
                    <div class="card-body">
                        <h5 class="card-title">Product</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">Klik Here!!</h6>
                        <p class="card-text">Kami Menyediakan kebutuhan dan perlengkapan hewan peliharaan berkualitas tinggi dan lain-lain.</p>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="/service/index" class="btn active">
                    <div class="card-body">
                        <h5 class="card-title">Service</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">Klik Here!!</h6>
                        <p class="card-text">Kami menawarkan layanan grooming profesional, fasilitas pengasuhan yang nyaman dan lain-lain.</p>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="/about/index" class="btn active">
                    <div class="card-body">
                        <h5 class="card-title">About Me</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">Klik Here!!</h6>
                        <p class="card-text">Selamat datang di PetShop kami, rumah nyaman bagi teman-teman hewan peliharaan Anda.</p>
                    </div>
                    
                </a>
            </div>
        </div>
    </div>

<?= $this->endSection(); ?>


    
