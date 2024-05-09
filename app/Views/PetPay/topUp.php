<?= $this->extend('layout/template_active'); ?>

<?= $this->section('content'); ?>

    <div class="container">
    <?php if(session()->getFlashdata('pesan')): ?>
            <div class="alert alert-primary" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php endif; ?>
            <h3 class="my-3">TopUp Saldo</h3>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Bank</th>
                    <th scope="col">Name</th>
                    <th scope="col">Saldo</th>
                    <th scope="col">No.Rekening</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">PetPay</th>
                    <td><?= $user['name']; ?></td>
                    <td><?= $akun['saldo']; ?></td>
                    <td><?= $akun['no_rek']; ?></td>
                    </tr>
                </tbody>
            </table>
            <form action="/petPay/topUp" method="post">
            <div class="mb-3 col-6">
                <label for="saldo" class="form-label">Nominal </label>
                <input type="text" class="form-control" id="saldo" name="saldo" >
            </div>
            <button class="btn btn-outline-success" type="submit">TopUp</button>
            </form>

    </div>
    <br><br><br><br><br>
    <br><br><br><br><br>
<?= $this->endSection(); ?>