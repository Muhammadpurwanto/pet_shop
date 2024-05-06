<?= $this->extend('layout/template_pasive'); ?>

<?= $this->section('content'); ?>
    <div class="container mt-3">
    <h1>Tambah Alamat</h1>
    <?php if(isset($validation)){ ?>
        <div class="alert alert-danger" role="alert">
            <?= \Config\Services::validation()->listErrors(); ?>       
        </div>
    <?php } ?>
        <form action="/alamat/add" method="post">
            <?= csrf_field(); ?>
            <div class="row my-3">
                <label for="provinsi" class="col-sm-1 col-form-label">provinsi</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="provinsi" name="provinsi" autofocus value="<?= isset($input_data['provinsi']) ? $input_data['provinsi'] : ''; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="kabupaten" class="col-sm-1 col-form-label">Kabupaten</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="kabupaten" name="kabupaten" value="<?= isset($input_data['kecamatan']) ? $input_data['kecamatan'] : ''; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="kecamatan" class="col-sm-1 col-form-label">Kecamatan</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="kecamatan" name="kecamatan" value="<?= isset($input_data['kecamatan']) ? $input_data['kecamatan'] : ''; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="desa" class="col-sm-1 col-form-label">Desa</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="desa" name="desa" value="<?= isset($input_data['desa']) ? $input_data['desa'] : ''; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="detail" class="col-sm-1 col-form-label">Detail</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="detail" name="detail" value="<?= isset($input_data['detail']) ? $input_data['detail'] : ''; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="kode_pos" class="col-sm-1 col-form-label">kode_pos</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="kode_pos" name="kode_pos" value="<?= isset($input_data['kode_pos']) ? $input_data['kode_pos'] : ''; ?>">
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>
<?= $this->endSection(); ?>