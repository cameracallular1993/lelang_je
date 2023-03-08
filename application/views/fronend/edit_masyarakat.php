<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('partials/header'); ?>
</head>

<body>
    <?php $this->load->view('partials/sidenav') ?>

    <div class="container col-5 m-4 mx-auto justify-content-center">
        <div class="card p-5 ">
            <div style="color:#477a7d">
                <h5 class="text-center">Data User</h1>
                    <hr>
            </div>
            <div class="card-body">
                <form action="" method="POST" autocomplete="off">
                    <div class="form-group">
                        <label for="email"><strong>Email</strong></label>
                        <input type="email" readonly value="<?= $masyarakat->email ?>" class="form-control" name="email" required maxlength="100" />
                    </div>
                    <div class="form-group">
                        <label for="nik"><strong>NIK</strong></label>
                        <input type="text" value="<?= $masyarakat->nik ?>" class="form-control" name="nik" required maxlength="20" />
                    </div>
                    <div class="form-group">
                        <label for="nama"><strong>Nama</strong></label>
                        <input type="text" value="<?= $masyarakat->nama ?>" class="form-control" name="nama" required maxlength="100" />
                    </div>
                    <div class="form-group">
                        <label for="jk"><strong>Jenis Kelamin</strong></label>
                        <select name="jk" id="jk" class="form-control" required>
                            <option value="Laki-laki" <?= ($masyarakat->jk == "Laki-laki") ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="Perempuan" <?= ($masyarakat->jk == "Perempuan") ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="no_hp"><strong>No Kontak</strong></label>
                        <input type="text" value="<?= $masyarakat->no_hp ?>" class="form-control" name="no_hp" required maxlength="50" />
                    </div>
                    <div class="form-group">
                        <label for="alamat"><strong>Alamat</strong></label>
                        <textarea class="form-control" name="alamat" required maxlength="250"><?= $masyarakat->alamat ?></textarea>
                    </div>
                    <div class="float-right">
                        <button type="submit" id="save" value="save" class="btn btn-warning"><i class="fa-regular fa-floppy-disk"></i> Update Data</button>
                    </div>
                </form>
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