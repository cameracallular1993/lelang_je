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
                    <h4>Kelola Barang</h4>
                    <hr />
                </div>
                <a href="<?= site_url('backend/barang/new') ?>" class="btn btn-success justify-content-end mt-2" style="width: 60px;" title="Add New"><i class="fa-solid fa-folder-plus"></i></a>
                <div class=" card-body border mt-2">
                    <table id="example" class="table table-striped table-bordered small">
                        <thead>
                            <tr>
                        <th>No</th> 
                        <th>Nama Barang</th>   
                        <th>Harga Awal</th>
                        <th>Status</th> 
                        <th>Gambar</th> 
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($barang as $b) : ?>
                        <tr> 
                            <td><?= $no++ ?></td>
                            <td><?= $b->nama_barang ?></td>
                            <td>IDR <?= number_format ($b->harga_awal, 2) ?></td>
                            <td><?= $b->status ?></td> 
                            <td>
                                <img src="<?= empty($b->gambar) ? base_url('assets/images/no_image.png') : base_url('upload/barang/' . $b->gambar) ?>" width="100px">
                            </td> 
 
                            <td>
                                <?php if ($b->status == "New") : ?>
                                    <!-- edit-->
                                <a href="<?= site_url('backend/barang/edit/' . $b->id_barang) ?>">
                                <button type="button" class="btn btn-warning" title="Edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                </a>
                               
                                    <!-- hapus-->
                                <a href="#" data-delete-url="<?= site_url('backend/barang/delete/' . $b->id_barang) ?>" onclick="deleteConfirm(this)">
                                <button type="button" class="btn btn-danger" title="Hapus">
                                <i class=" fa-solid fa-trash"></i>
                                </button>
                                </a>
                            <?php endif ?>
                             <!-- tambah gambar -->
                             <a href="<?= site_url('backend/gambar/index/' . $b->id_barang) ?>">
                                <button type="button" class="btn btn-primary" title="Tambah">
                                <i class="fa-solid fa-images"></i>
                                </button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <!-- End -->
 
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
            timer: 2000,
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