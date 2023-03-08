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
                    <h4>Data Masyarakat</h4>
                </div>
                <hr>
                <div class=" card-body border mt-2">
                    <table id="masyarakat" class="table table-striped table-bordered small table-hover">
                        <thead>
                            <tr>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Email</th>
                                <th>No Hp</th>
                                <th>Alamat</th>
                                <th>Tgl Register</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($masyarakat as $m) : ?>
                                <tr>
                                    <td><?= $m->nik ?></td>
                                    <td><?= $m->nama ?></td>
                                    <td><?= $m->jk ?></td>
                                    <td><?= $m->email ?></td>
                                    <td><?= $m->no_hp ?></td>
                                    <td><?= $m->alamat ?></td>
                                    <td><?= $m->tgl_join ?></td>
                                    <td><?= $m->status == 1 ? "Aktif" : "Blocked" ?></td>
                                    <td>
                                        <?php if ($activeUser->level == "Admin" && $m->status == 1) : ?>
                                            <a href="#" data-confirm-url="<?= site_url('backend/masyarakat/block/' . $m->id_masyarakat) ?>" onclick="dataConfirm(this)"><button type="button" class="btn btn-danger" title="Block"><i class=" fa-solid fa-user-xmark"></i></button></a>
                                        <?php endif ?>
                                    </td>
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

<!-- Sweatalert JS -->
<script>
    function dataConfirm(event) {
        Swal.fire({
            title: 'Update Confirmation!',
            text: 'Yakin blok data masyarakat ini?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Ya',
            confirmButtonColor: 'red'
        }).then(dialog => {
            if (dialog.isConfirmed) {
                window.location.assign(event.dataset.confirmUrl);
            }
        });
    }
</script>