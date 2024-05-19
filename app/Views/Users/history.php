<?= $this->extend('layout/template_active'); ?>

<?= $this->section('content'); ?>

    <div class="container">
    <?php if(session()->getFlashdata('pesan')): ?>
            <div class="alert alert-primary" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php endif; ?>
            <h3 class="my-3">History Product</h3>
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
                    <?php for($i=0; $i<count($transaksi1); $i++): ?>
                        <tr>
                            <th scope="row"><?= $transaksi1[$i]['id']; ?></th>
                            <td><?= $transaksi1[$i]['created_at']; ?></td>
                            <td>
                                <?php foreach($detail_transaksi[$i] as $row): ?>
                                    <?= isset($row['id_product']) ? $row['id_product'] : '' ?><br>
                                <?php endforeach; ?>
                            </td>
                            <td><?= $kurir1[$i]['name']; ?></td>
                            <td>
                                <?php foreach($detail_transaksi[$i] as $row): ?>
                                    <?= $row['quantity']; ?><br>
                                <?php endforeach; ?>
                            </td>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
            <h3 class="my-3">History Service</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No.Resi</th>
                        <th scope="col">Jenis Jasa</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Time</th>
                        <th scope="col">Kurir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=0; $i<count($transaksi2); $i++): ?>
                        <tr>
                            <th scope="row"><?= $transaksi2[$i]['id']; ?></th>
                            <td><?= $service[$i]['name']; ?></td>
                            <td><?= $transaksi2[$i]['created_at']; ?></td>
                            <td><?= $transaksi2[$i]['tanggal']; ?>/<?= $transaksi2[$i]['jam']; ?></td>
                            <td><?= $kurir2[$i]['name']; ?></td>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>

    </div>
    <br><br><br><br><br>
    <br><br><br><br><br>
<?= $this->endSection(); ?>