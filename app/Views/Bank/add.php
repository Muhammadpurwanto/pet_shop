<?= $this->extend('layout/template_active'); ?>

<?= $this->section('content'); ?>
    <div class="container mt-3">
    <h1>Tambah Akun Bank</h1>
    <?php if(isset($validation)){ ?>
        <div class="alert alert-danger" role="alert">
            <?= \Config\Services::validation()->listErrors(); ?>       
        </div>
    <?php } ?>
    <ol class="list-group list-group-numbered">
        <form action="/bank/add/BRI" method="post">
            <?= csrf_field(); ?>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                    <div class="fw-bold">BRI</div>
                    Bank Rakyat Indonesia
                    </div>
                    <button type="submit" class="btn btn-success">Add</button>
                </li>
            
        </form>
        <form action="/bank/add/BNI" method="post">
            <?= csrf_field(); ?>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                    <div class="fw-bold">BNI</div>
                    Bank Negara Indonesia
                    </div>
                    <button type="submit" class="btn btn-success">Add</button>
                </li>
        </form>
        <form action="/bank/add/PER" method="post">
            <?= csrf_field(); ?>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">Permata</div>
                        Bank Permata
                    </div>
                    <button type="submit" class="btn btn-success">Add</button>
                </li>
        </form>
        <form action="/bank/add/PET" method="post">
            <?= csrf_field(); ?>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">PetShop</div>
                        PetShop
                    </div>
                    <button type="submit" class="btn btn-success">Add</button>
                </li>
            
        </form>
    </ol>
    </div>
    <br><br><br><br>
<?= $this->endSection(); ?>