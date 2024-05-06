<?= $this->extend('layout/template_pasive'); ?>

<?= $this->section('content'); ?>
    <div class="container mt-3">
    <h1>Update Alamat</h1>
    <?php if(isset($validation)){ ?>
        <div class="alert alert-danger" role="alert">
            <?= \Config\Services::validation()->listErrors(); ?>       
        </div>
    <?php } ?>
        <form action="/alamat/update/<?= $alamat['id']; ?>" method="post">
            <?= csrf_field(); ?>
            <div class="row my-3">
                <label for="provinsi" class="col-sm-1 col-form-label">provinsi</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="provinsi" name="provinsi" autofocus value="<?= $alamat['provinsi']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="kabupaten" class="col-sm-1 col-form-label">Kabupaten</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="kabupaten" name="kabupaten" value="<?= $alamat['kecamatan']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="kecamatan" class="col-sm-1 col-form-label">Kecamatan</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="kecamatan" name="kecamatan" value="<?= $alamat['kecamatan']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="desa" class="col-sm-1 col-form-label">Desa</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="desa" name="desa" value="<?= $alamat['desa']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="detail" class="col-sm-1 col-form-label">Detail</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="detail" name="detail" value="<?= $alamat['detail']; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="kode_pos" class="col-sm-1 col-form-label">kode_pos</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="kode_pos" name="kode_pos" value="<?= $alamat['kode_pos']; ?>">
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>
<?= $this->endSection(); ?>