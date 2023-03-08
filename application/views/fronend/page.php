<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('partials/header') ?>
</head>

<body>
    <main class="main">
        <?php $this->load->view('partials/sidenav') ?>

        <div class="content">
            <div class="container col-12 row mx-1 py-3 text-center">
                <?php foreach ($lelang as $b) : ?>
                    <div class="col-3 p-4 card " style="width: 15rem;">
                        <div style="height: 23rem;">
                            <img src="<?= empty($b->gambar) ? base_url('assets/images/no_image.png')  : base_url('upload/barang/' . $b->gambar) ?>" class="card-img-top">
                        </div>
                        <div class="card-body">
                            <h6 class="list-group-item bg-warning"><?= $b->Keterangan ?></h6>
                            <h1 class="card-title text-center"><?= $b->nama_barang ?></h1>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">IDR <?= number_format($b->harga_awal, 2) ?></li>
                            <li class="list-group-item"><?= $b->total_penawaran ?> penawaran</li>
                        </ul>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
            <?php $this->load->view('partials/footer') ?>
        </div>
    </main>
</body>

</html>


<?php if ($this->session->flashdata('message')) : ?>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'info',
            title: '<?= $this->session->flashdata('message') ?>'
        })
    </script>
<?php endif ?>