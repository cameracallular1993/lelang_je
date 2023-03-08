<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('backend/_partials/header') ?>
</head>

<body>
    <main class="main">
        <?php $this->load->view('backend/_partials/sidenav') ?>

        <div class="content">

            <div class="container my-4">
                <div style="color:#477a7d">
                    <h4>Unconfirmed Pemenang Lelang</h4>
                </div>
                <hr>
                <table id="pemenang" class="table table-striped table-bordered table-hover small">
                    <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Email</th>
                            <th>No Hp</th>
                            <th>Barang Lelang</th>
                            <th>Harga Awal</th>
                            <th>Penawaran</th>
                            <?php if ($activeUser->level == "Petugas") : ?>
                                <th>Action</th>
                            <?php endif ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pemenang as $p) : ?>
                            <tr>
                                <th><?= $p->nik ?></th>
                                <td><?= $p->pemenang ?></td>
                                <td><?= $p->jk ?></td>
                                <td><?= $p->email ?></td>
                                <td><?= $p->no_hp ?></td>
                                <td><?= $p->nama_barang ?></td>
                                <td>IDR <?= number_format($p->harga_awal, 2) ?></td>
                                <td>IDR <?= number_format($p->harga_akhir, 2) ?></td>
                                <?php if ($activeUser->level == "Petugas") : ?>
                                    <td>
                                        <a href="#" data-confirm-url="<?= site_url('backend/lelang/confirm/' . $p->id_lelang) ?>" onclick="dataConfirm(this)"><button type="button" class="btn btn-success" title="Confirm"><i class="fa-solid fa-circle-check"></i></button></a>
                                    </td>
                                <?php endif ?>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <br />
            <div class="container my-4">
                <div style="color:#477a7d">
                    <h4>Lelang Berlangsung</h4>
                </div>
                <hr>
                <table id="berlangsung" class="table table-striped table-bordered table-hover small">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Nama Barang</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Harga Awal</th>
                            <th>Total Penawaran</th>
                            <th>Penawaran Tertinggi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($berlangsung as $b) : ?>
                            <tr>
                                <td><img src="<?= empty($b->gambar) ? base_url('assets/images/no_image.png')  : base_url('upload/barang/' . $b->gambar) ?>" width="100px"></td>
                                <td><?= $b->nama_barang ?></td>
                                <td><?= $b->tgl_mulai ?></td>
                                <td><?= $b->tgl_akhir ?></td>
                                <td>IDR <?= number_format($b->harga_awal, 2) ?></td>
                                <td><?= $b->total_penawaran ?></td>
                                <td>IDR <?= number_format($b->harga_tertinggi, 2) ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <br>
            <br />
            <?php $this->load->view('backend/_partials/footer') ?>
        </div>
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
            icon: 'success',
            title: '<?= $this->session->flashdata('message') ?>'
        })
    </script>
<?php endif ?>

<!-- Datatable -->
<script>
    $(document).ready(function() {
        var table = $('#berlangsung').DataTable({
            buttons: ['copy', 'excel', 'pdf', 'print'],
            dom: "<'row '<'col-md-4'l> <'col-md-4'B> <'col-md-4'f>>" +
                "<'row '<'col-md-12'tr>>" +
                "<'row '<'col-md-5'i> <'col-md-7'p>>",
            lengthChange: true
        });

        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');

        var table2 = $('#pemenang').DataTable({
            buttons: ['copy', 'excel', 'pdf', 'print'],
            dom: "<'row '<'col-md-4'l> <'col-md-4'B> <'col-md-4'f>>" +
                "<'row '<'col-md-12'tr>>" +
                "<'row '<'col-md-5'i> <'col-md-7'p>>",
            lengthChange: true
        });

        table2.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');

    });
</script>

<!-- Sweatalert JS -->
<script>
    function dataConfirm(event) {
        Swal.fire({
            title: 'Confirmation!',
            text: 'Pemenang sudah dikonfirmasi?',
            icon: 'info',
            showCancelButton: true,
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Ya',
            confirmButtonColor: 'greed'
        }).then(dialog => {
            if (dialog.isConfirmed) {
                window.location.assign(event.dataset.confirmUrl);
            }
        });
    }
</script>