<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('partials/header') ?>
</head>

<body>
    <main class="main">
        <?php $this->load->view('partials/sidenav') ?>

        <div class="content">

            <div class="container my-4">
                <div style="color:#477a7d">
                    <h4>Riwayat Penawaran</h4>
                </div>
                <hr>
                <table id="penawaran" class="table table-striped table-bordered table-hover small">
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
                            <th>Action</th>
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
                                <td>
                                    <?php if ($m->status_lelang == "open") : ?>
                                        <a href="<?= site_url('page/delete_penawaran/' . $m->id_penawaran) ?>" onclick="deleteConfirm(this)"><button type="button" class="btn btn-danger" title="Hapus"><i class=" fa-solid fa-trash"></i></button></a>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php $this->load->view('partials/footer'); ?>
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
        var table = $('#penawaran').DataTable({
            buttons: ['copy', 'excel', 'pdf', 'print'],
            dom: "<'row '<'col-md-4'l> <'col-md-4'B> <'col-md-4'f>>" +
                "<'row '<'col-md-12'tr>>" +
                "<'row '<'col-md-5'i> <'col-md-7'p>>",
            lengthChange: true
        });

        table.buttons().container()
            .appendTo('#penawaran_wrapper .col-md-6:eq(0)');
    });
</script>
</script>

<!-- Sweatalert JS -->
<script>
    function deleteConfirm(event) {
        Swal.fire({
            title: 'Delete Confirmation!',
            text: 'Yakin hapus data ini?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Ya Hapus',
            confirmButtonColor: 'red'
        }).then(dialog => {
            if (dialog.isConfirmed) {
                window.location.assign(event.dataset.deleteUrl);
            }
        });
    }
</script>