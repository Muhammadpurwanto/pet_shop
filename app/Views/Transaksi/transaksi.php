<?= $this->extend('layout/template_active'); ?>

<?= $this->section('content'); ?>

    <div class="container">
        <form action="/transaksi/bayar" method="post">
            <div class="row">
                <div class="col-8">
                <h3 class="my-3">Transaksi</h3>
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <?php $j = 0; ?>
                        <?php if(isset($keranjang)): ?>
                            <?php for($i=0; $i<count($keranjang); $i++): ?>
                                <tbody>
                                    <tr>
                                        <th scope="row"><?= ++$j; ?></th>
                                            <input type="hidden" name="keranjang[]" value="<?= $keranjang[$i]['id']; ?>" id="">
                                        <td>
                                            <input type="text" name="name" value="<?= isset($product[$i]['name']) ? $product[$i]['name'] : ''; ?>" style="border:none; width: 10rem;" disabled>
                                            <input type="hidden" name="product_id[]" value="<?= isset($product[$i]['id']) ? $product[$i]['id'] : ''; ?>" style="border:none; width: 10rem;">
                                        </td>
                                        <td>
                                            <input type="text" name="price" value="<?= isset($product[$i]['price']) ? $product[$i]['price'] : ''; ?>" style="border:none; width:10rem" disabled>
                                        </td>
                                        <td>
                                            <input type="text" name="jumlah" value="<?= isset($keranjang[$i]['jumlah']) ? $keranjang[$i]['jumlah'] : ''; ?>" style="border:none; width: 10rem;" disabled>
                                        </td>
                                        <td>
                                            <input type="hidden" name="total[]" value="<?= $total[$i]; ?>" id="">
                                            <input type="text" name="total[]" value="<?= isset($total[$i]) ? $total[$i] : ''; ?>" style="border:none; width: 10rem" disabled>
                                        </td>
                                    </tr>
                                </tbody>
                            <?php endfor; ?>
                        <?php endif; ?>
                    </table>
                    <div class="text-center">
                        <button class="btn btn-primary" type="submit">Bayar</button>
                    </div>
                
                </div>
                <div class="col-3">
                <h5 class="mt-5 ms-5">Alamat</h5>
                    <select class="form-select ms-5" name="alamat" style="width: 18rem;" aria-label="Size 3 select example" disabled>
                            <option value="<?= $alamat['id']; ?>" selected>
                                <p><?= $alamat['kode_pos']; ?>/<?= $alamat['provinsi']; ?>/<?= $alamat['kabupaten']; ?>/<?= $alamat['kecamatan']; ?></p>
                                <input type="hidden" name="alamat" value="<?= $alamat['id']; ?>">
                            </option>
                    </select>  
                                
                    <h5 class="ms-5 mt-3">Jasa Kirim</h5>
                    <select class="form-select ms-5" name="kurir" id="kurir" style="width: 18rem;" aria-label="Size 3 select example" disabled>
                            <option value="<?= $kurir['id']; ?>" selected>
                                <p><?= $kurir['name']; ?> (<?= $kurir['price']; ?>)</p>
                                <input type="hidden" name="kurir" value="<?= $kurir['id']; ?>">
                            </option>
                    </select> 
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
                            <input type="text" name="sisaSaldo" value="<?= isset($sisaSaldo) ? $sisaSaldo : ''; ?>" style="border:none; width: 10rem">
                            <hr>
                            
                        </div>
                    </div>                   
                </div>
            </div>
        </form>
    </div>
    <br><br><br><br><br>
    <br><br><br><br><br>
<?= $this->endSection(); ?>