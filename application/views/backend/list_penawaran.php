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
                    <h4>Data Penawaran</h4>
                </div>
                <hr>
                <div class=" card-body border mt-2">
                    <table id="masyarakat" class="table table-striped table-bordered small table-hover">
                        <thead>
                            <tr>
                                <th>Tgl Penawaran</th>
                                <th>Nama Barang</th>
                                <th>Nama Penawar</th>
                                <th>No Hp</th>
                                <th>Email</th>
                                <th>Status Penawar</th>
                                <th>Harga Awal</th>
                                <th>Harga Penawaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($penawaran as $m) : ?>
                                <tr>
                                    <td><?= $m->tgl_penawaran ?></td>
                                    <td><?= $m->nama_barang ?></td>
                                    <td><?= $m->nama_penawar ?></td>
                                    <td><?= $m->no_hp ?></td>
                                    <td><?= $m->email_penawar ?></td>
                                    <td><?= $m->status_penawar == 1 ? "Aktif" : "Blocked" ?></td>
                                    <td>IDR <?= number_format($m->harga_awal, 2) ?></td>
                                    <td>IDR <?= number_format($m->harga_penawaran, 2) ?></td>
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
        var table = $('#masyarakat').DataTable({
            buttons: ['copy', 'excel', 'pdf', 'print'],
            dom: "<'row '<'col-md-4'l> <'col-md-4'B> <'col-md-4'f>>" +
                "<'row '<'col-md-12'tr>>" +
                "<'row '<'col-md-5'i> <'col-md-7'p>>",
            lengthChange: true
        });

        table.buttons().container()
            .appendTo('#masyarakat_wrapper .col-md-6:eq(0)');
    });
</script>