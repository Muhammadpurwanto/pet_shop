<?= $this->extend('layout/template_active'); ?>

<?= $this->section('content'); ?>

    <div class="container">
        <div class="row">
            <div class="col-8">
            <h3 class="my-3">Keranjang</h3>
            <form action="/transaksi/product" method="post">
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
                                <input class="btn" style="border: none;" type="text" name="jumlah" id="" value="<?= isset($product->jumlah) ? $product->jumlah : ''; ?>">
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
            </form>
            </div>
            <div class="col-3">
                <div class="card m-5" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Saldo</h5>
                        <h6 class="card-subtitle mb-2 text-danger">Rp. <?= isset($products[0]->saldo) ? $products[0]->saldo : ''; ?></h6>
                        <a class="btn btn-outline-success mt-3" href="/petPay/TopUp" class="card-link">TopUp</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <br><br><br><br><br>
    <br><br><br><br><br>
<?= $this->endSection(); ?>