<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('backend/partials/header') ?>
</head>

<body>
    <main class="main">
        <?php $this->load->view('backend/partials/sidenav') ?>

        <div class="content">
            <div class="container my-4 col-8">
                <div class="container">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <h5>Tambah Gambar Barang</h5>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="tipe_kamar"><strong>Nama Barang</strong></label>
                                    <input type="text" value="<?= $barang->nama_barang ?>" class="form-control" name="nama_barang" readonly required maxlength="200" />

                                </div>
                                <?php if ($barang->status <> "Sold") : ?>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><strong>Gambar</strong></span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="gambar" name="gambar" required>
                                            <label class="custom-file-label" for="gambar">Choose file</label>
                                        </div>
                                    </div>
                                <?php endif ?>

                                <div class="float-right">
                                    <a href="<?= site_url('backend/barang'); ?>" class="btn btn-secondary">
                                        <i href="#" class="fa-solid fa-backward"></i> Kembali
                                    </a>
                                    <?php if ($barang->status <> "Sold") : ?>
                                        <button type="submit" id="save" value="save" class="btn btn-success"><i class="fa-regular fa-floppy-disk"></i> Upload</button>
                                    <?php endif ?>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class=" card-body border mt-2">
                        <table id="example" class="table table-striped table-bordered small">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Gambar</th>
                                    <th>Gambar</th>
                                    <?php if ($barang->status <> "Sold") : ?>
                                        <th>Action</th>
                                    <?php endif ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($gambar as $b) : ?>
                                    <tr>
                                        <th><?= $no++ ?></th>
                                        <td><?= $b->nama_gambar ?></td>
                                        <td><img src="<?= empty($b->gambar) ? base_url('assets/images/no_image.png')  : base_url('upload/barang/' . $b->gambar) ?>" width="100px"></td>
                                        <?php if ($barang->status <> "Sold") : ?>
                                            <td>
                                                <!-- Delete -->
                                                <a href="#" data-delete-url="<?= site_url('backend/barang/deleteImage/' . $b->id_gambar) ?>" onclick="deleteConfirm(this)"><button type="button" class="btn btn-danger" title="Hapus"><i class=" fa-solid fa-trash"></i></button></a>
                                            </td>
                                        <?php endif ?>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php $this->load->view('backend/partials/footer') ?>
        </div>
    </main>
</body>

</html>


<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>


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

<!-- Datatable -->
<script>
    $(document).ready(function() {
        var table = $('#example').DataTable({
            buttons: [],
            dom: "<'row '<'col-md-4'l> <'col-md-4'B> <'col-md-4'f>>" +
                "<'row '<'col-md-12'tr>>" +
                "<'row '<'col-md-5'i> <'col-md-7'p>>",
            lengthChange: true
        });

        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');
    });
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