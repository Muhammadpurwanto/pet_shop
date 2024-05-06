<?= $this->extend('layout/template_active'); ?>

<?= $this->section('content'); ?>

    <div class="container">
    <?php if(session()->getFlashdata('pesan')): ?>
            <div class="alert alert-primary" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php endif; ?>
        <a href="/alamat/add" class="btn btn-primary mt-3">Tambah Alamat</a>

        <?php foreach($alamats as $alamat): ?>
            <div class="card text-center col-sm-6 my-3">
                <div class="card-header">
                    <?= $alamat['kode_pos']; ?>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?= $alamat['provinsi']. '/' . $alamat['kabupaten'].' / '.$alamat['kecamatan'].' / '.$alamat['desa']; ?></h5>
                    <p class="card-text"><?= $alamat['detail']; ?></p>
                </div>
                <div class="card-footer text-body-secondary">
                    <a href="alamat/update/<?= $alamat['id']; ?>" class="btn btn-success">Update</a>
                    <form action="/delete/<?= $alamat['id']; ?>" method="post" class="d-inline">
                    <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')">Delete</button>
                    </form>
                    
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <br><br><br><br><br>
    <br><br><br><br><br>
<?= $this->endSection(); ?>