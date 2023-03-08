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
                <br>
                <div style="color:#477a7d">
                    <h4>Laporan Pemenang Lelang</h4>
                </div>
                <hr>
                <div class=" card-body border mt-2">
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
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($laporan as $p) : ?>
                                <tr>
                                    <td><?= $p->nik ?></td>
                                    <td><?= $p->pemenang ?></td>
                                    <td><?= $p->jk ?></td>
                                    <td><?= $p->email ?></td>
                                    <td><?= $p->no_hp ?></td>
                                    <td><?= $p->nama_barang ?></td>
                                    <td>IDR <?= number_format($p->harga_awal, 2) ?></td>
                                    <td>IDR <?= number_format($p->harga_akhir, 2) ?></td>
                                    <td><?= $p->status ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php $this->load->view('backend/_partials/footer') ?>
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
        var table = $('#pemenang').DataTable({
            buttons: ['copy', 'excel', 'pdf', 'print'],
            dom: "<'row '<'col-md-4'l> <'col-md-4'B> <'col-md-4'f>>" +
                "<'row '<'col-md-12'tr>>" +
                "<'row '<'col-md-5'i> <'col-md-7'p>>",
            lengthChange: true
        });

        table.buttons().container()
            .appendTo('#pemenang_wrapper .col-md-6:eq(0)');
    });
</script>