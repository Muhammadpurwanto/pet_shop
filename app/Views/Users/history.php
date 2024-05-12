<?= $this->extend('layout/template_active'); ?>

<?= $this->section('content'); ?>

    <div class="container">
    <?php if(session()->getFlashdata('pesan')): ?>
            <div class="alert alert-primary" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php endif; ?>
            <h3 class="my-3">History</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No.Resi</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Id Product</th>
                        <th scope="col">Kurir</th>
                        <th scope="col">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=0; $i<count($transaksi); $i++): ?>
                        <tr>
                            <th scope="row"><?= $transaksi[$i]['id']; ?></th>
                            <td><?= $transaksi[$i]['created_at']; ?></td>
                            <td>
                                <?php foreach($detail_transaksi[$i] as $row): ?>
                                    <?= isset($row['id_product']) ? $row['id_product'] : '' ?><br>
                                <?php endforeach; ?>
                            </td>
                            <td><?= $kurir['name']; ?></td>
                            <td>
                                <?php foreach($detail_transaksi[$i] as $row): ?>
                                    <?= $row['quantity']; ?><br>
                                <?php endforeach; ?>
                            </td>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>

    </div>
    <br><br><br><br><br>
    <br><br><br><br><br>
<?= $this->endSection(); ?>