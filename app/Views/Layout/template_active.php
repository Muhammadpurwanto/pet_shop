<?php use App\Controllers\Keranjang;
$keranjang = new Keranjang();

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://unpkg.com/feather-icons"></script>
  </head>
  <body>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
        <a class="navbar-brand" href="/">
          <i data-feather="home"></i>
          <span class="navbar-brand ms-3 h1">Hallo <?= $user['name']; ?></span>          
        </a>

        
        <?php if(!isset($akun)){ ?>
          <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="navbar-brand position-relative me-5" href="/keranjang">
              <i data-feather="shopping-cart"></i> 
              <span class="position-absolute top-0 start-100 translate-small badge rounded-pill bg-danger">
                <?= $keranjang->countKeranjang(); ?>
                <span class="visually-hidden">unread messages</span>
              </span>
            </a>
            <a href="/users/akun" class="me-3" type="button">
              <img src="/img/<?= $user['image']; ?>" class="rounded-circle" alt="..." width="30"> 
              </a> 
              
          </div>
          <?php }else{ ?>
            <a href="/users/logout" class="btn btn-danger justify-content-end me-3" type="button">Logout</a>
          <?php } ?>
        </div>
    </nav>

    <?= $this->renderSection('content'); ?>
        
    <nav class="navbar bg-body-secondary mt-3">
        <div class="container-fluid ms-5">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">
                <i data-feather="facebook"></i> petShop
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i data-feather="instagram"></i> petShop662
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i data-feather="mail"></i> petShop@gmail.com
              </a>
            </li>
          </ul> 
        </div>
        
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script>
      feather.replace();
    </script>
  </body>
</html>