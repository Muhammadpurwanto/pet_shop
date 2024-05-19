<?= $this->extend('layout/template_active'); ?>

<?= $this->section('content'); ?>

    <div class="container">
    <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger" role="alert">
                <?= session()->getFlashdata('error'); ?>
            </div>
    <?php endif; ?>
    <?php if(session()->getFlashdata('pesan')): ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
    <?php endif; ?>

        <form action="/transaksi/bayarService" method="post">

        <!-- DATA ID TRANSAKSI -->

            <input type="hidden" name="petPay" value="<?= $petPay['id']; ?>">
            <input type="hidden" name="kurir" value="<?= $kurir['id']; ?>">
            <input type="hidden" name="karyawan" value="<?= $karyawan['id']; ?>">
            <input type="hidden" name="service" value="<?= $service['id']; ?>">
            <input type="hidden" name="alamat" value="<?= $alamat['id']; ?>">
            <input type="hidden" name="tanggal" value="<?= $tanggal; ?>">
            <input type="hidden" name="jam" value="<?= $jam; ?>">

            <input type="hidden" name="sisaSaldo" value="<?= $sisaSaldo; ?>">
            <div class="row">
                <div class="col-8">
                
                <h3 class="my-3">Transaksi</h3>
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Jenis Jasa</th>
                                <th scope="col">Harga</th>
                            </tr>
                        </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td><?= isset($service['name']) ? $service['name'] : ''; ?></td>
                                    <td><?= isset($service['price']) ? $service['price'] : ''; ?></td>
                                </tr>
                            </tbody>
                    </table>
                    <div class="text-center">
                        <button class="btn btn-primary" type="submit">checkout</button>
                    </div>
                
                </div>
                <div class="col-3">
                <div class="card m-5" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Saldo :<span class="text-danger"> Rp. <?= isset($petPay['saldo']) ? $petPay['saldo'] : ''; ?></span></h5>
                            <label for="">Total Harga : </label>
                            <input type="text" name="totalHarga" value="<?= isset($totalHarga) ? $totalHarga : ''; ?>" style="border:none; width: 10rem" disabled>
                            <label for="">Biaya Kurir : </label>
                            <input type="text" name="kurir" value="<?= isset($kurir['price']) ? $kurir['price'] : ''; ?>" style="border:none; width: 10rem" disabled>
                            <hr>
                            <label for="">Sisa Saldo: </label>
                            <input type="text" name="sisaSaldo" value="<?= isset($sisaSaldo) ? $sisaSaldo : ''; ?>" style="border:none; width: 10rem" disabled>
                            
                            <hr>
                            
                        </div>
                    </div>  
                    <h5 class="ms-5">Tanggal</h5>
                    <select class="form-select ms-5" name="alamat" style="width: 18rem;" aria-label="Size 3 select example">
                            <option value="<?= $tanggal; ?>">
                                <p><?= $tanggal?></p>
                            </option>
                    </select>  
                    <h5 class="ms-5 mt-3">Jam</h5>
                    <select class="form-select ms-5" name="alamat" style="width: 18rem;" aria-label="Size 3 select example">
                            <option value="<?= $jam; ?>">
                                <p><?= $jam?></p>
                            </option>
                    </select>  
                    <h5 class="ms-5 mt-3">Karyawan</h5>
                    <select class="form-select ms-5" name="alamat" style="width: 18rem;" aria-label="Size 3 select example">
                            <option value="<?= $karyawan['id']; ?>">
                                <p><?= $karyawan['name']?></p>
                            </option>
                    </select>  
                    <h5 class="ms-5 mt-3">Alamat</h5>
                    <select class="form-select ms-5" name="alamat" style="width: 18rem;" aria-label="Size 3 select example">
                            <option value="<?= $alamat['id']; ?>">
                                <p><?= $alamat['kode_pos']; ?>/<?= $alamat['provinsi']; ?>/<?= $alamat['kabupaten']; ?>/<?= $alamat['kecamatan']; ?></p>
                            </option>
                    </select>  
                                
                    <h5 class="ms-5 mt-3">Jasa Kirim</h5>
                    <select class="form-select ms-5" name="kurir" id="kurir" style="width: 18rem;" aria-label="Size 3 select example">
                            <option value="<?= $kurir['id']; ?>">
                                <p><?= $kurir['name']; ?> (<?= $kurir['price']; ?>)</p>
                            </option>
                    </select>                 
                </div>
            </div>
        </form>
    </div>
<?= $this->endSection(); ?>
                      