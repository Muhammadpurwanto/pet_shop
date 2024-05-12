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

        <form action="/transaksi/transaksi" method="post">
            <div class="row">
                <div class="col-8">
                <h3 class="my-3">Keranjang</h3>
                    <table class="table text-center">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Product</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Pilih</th>
                            </tr>
                        </thead>
                        <?php $i = 0; ?>
                        <?php if(isset($products)): ?>
                            <?php foreach($products as $product): ?>
                            <tbody>
                                <tr>
                                <th scope="row"><?= ++$i; ?></th>
                                <td><?= isset($product->name) ? $product->name : ''; ?></td>
                                <td><img src="/img/<?= $product->image; ?>" width="50" alt=""></td>
                                <td><?= isset($product->price) ? $product->price : ''; ?></td>
                                <td>
                                    <input class="btn" style="border: none;" type="text" name="jumlah[]" id="" value="<?= isset($product->jumlah) ? $product->jumlah : ''; ?>">
                                </td>
                                <td>
                                <input class="form-check-input me-1" type="checkbox" value="<?= isset($product->id) ? $product->id : ''; ?>" name="keranjang[]">
                                </td>
                                </tr>
                            </tbody>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </table>
                    <div class="text-center">
                        <button class="btn btn-primary" type="submit">checkout</button>
                    </div>
                
                </div>
                <div class="col-3">
                    <div class="card m-5" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Saldo</h5>
                            <h6 class="card-subtitle mb-2 text-danger">Rp. <?= isset($products[0]->saldo) ? $products[0]->saldo : ''; ?></h6>
                            <a class="btn btn-outline-success mt-3" href="/petPay/TopUp" class="card-link">TopUp</a>
                        </div>
                    </div>

                    <h5 class="ms-5">Pilih Alamat</h5>
                    <select class="form-select ms-5" name="alamat" style="width: 18rem;" aria-label="Size 3 select example">
                        <?php foreach($alamats as $alamat): ?>
                            <option value="<?= $alamat['id']; ?>">
                                <p><?= $alamat['kode_pos']; ?>/<?= $alamat['provinsi']; ?>/<?= $alamat['kabupaten']; ?>/<?= $alamat['kecamatan']; ?></p>
                            </option>
                        <?php endforeach; ?>
                    </select>  
                                
                    <h5 class="ms-5 mt-3">Pilih Jasa Kirim</h5>
                    <select class="form-select ms-5" name="kurir" id="kurir" style="width: 18rem;" aria-label="Size 3 select example">
                        <?php foreach($kurirs as $kurir): ?>
                            <option value="<?= $kurir['id']; ?>">
                                <p><?= $kurir['name']; ?> (<?= $kurir['price']; ?>)</p>
                            </option>
                        <?php endforeach; ?>
                    </select>                 
                </div>
            </div>
        </form>
    </div>
    <br><br><br><br><br>
    <br><br><br><br><br>
<?= $this->endSection(); ?>