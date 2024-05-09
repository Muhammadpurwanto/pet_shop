<?= $this->extend('layout/template_active'); ?>

<?= $this->section('content'); ?>

    <div class="container">
    <?php if(session()->getFlashdata('pesan')): ?>
            <div class="alert alert-primary" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php endif; ?>
        <?php if(isset($akun) && $akun == null){ ?>
            <h3 class="my-3">Daftar PetPay</h3>
        <form action="/petPay/add" method="post">
            <ul class="list-group list-group-flush col-sm-8">
                <li class="list-group-item">Name : <?= $user['name']; ?></li>
                <li class="list-group-item">Email : <?= $user['email']; ?></li>
                <li class="list-group-item">Bank : PetPay</li>
                <li class="list-group-item">No.rek : 
                    <input type="text" name="rek">
                </li>
                <li class="list-group-item"></li>
            </ul>            
                <button class="btn btn-primary mt-3" type="submit">Daftar</button>
            </form>
        <?php }else{; ?>
            <h3 class="my-3">TopUp Saldo</h3>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Bank</th>
                    <th scope="col">Name</th>
                    <th scope="col">Saldo</th>
                    <th scope="col">No.Rekening</th>
                    <th scope="col">TopUp</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">PetPay</th>
                    <td><?= $user['name']; ?></td>
                    <td><?= $akun['saldo']; ?></td>
                    <td><?= $akun['no_rek']; ?></td>
                    <td><a class="btn btn-outline-success" href="/petPay/topUp">TopUp</a></td>
                    </tr>
                </tbody>
            </table>
        <?php } ?>

    </div>
    <br><br><br><br><br>
    <br><br><br><br><br>
<?= $this->endSection(); ?>