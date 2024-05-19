<?= $this->extend('admin/template/template'); ?>

<?= $this->section('content'); ?>
<?= $this->include('admin/template/category'); ?>

        <div class="col-10">
            <?php if(session()->getFlashdata('pesan')): ?>
                <div class="alert alert-primary" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <h1 class="mb-3">Daftar Produk</h1>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        </tr>
                    </thead>
                    <?php $i = 1; ?>
                    <?php foreach($users as $user): ?>
                    <tbody>
                        <tr>
                        <th scope="row"><?= $i++; ?></th>
                        <td><img src="/img/<?= $user['image']; ?>" alt="" width="80"></td>
                        <td><?= $user['name']; ?></td>
                        <td><?= $user['email']; ?></td>
                        </tr>
                    </tbody>
                    <?php endforeach; ?>
                </table>              
            </div>

        </div>
    </div>
    <br><br><br><br>

<?= $this->endSection(); ?>