<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('partials/header'); ?>
</head>

<body>
    <?php $this->load->view('partials/sidenav') ?>

    <div class="container col-5 m-4 mx-auto justify-content-center">
        <div class="card p-5">
            <div style="color:#477a7d">
                <h5 class="text-center">Change Password</h1>
                    <hr>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="email"><strong>Email</strong></label>
                        <input type="text" class="form-control" value="<?= $masyarakat->email ?>" name="email" readonly>
                    </div>
                    <div class="form-group">
                        <label for="current"><strong>Current Password</strong></label>
                        <input type="password" class="form-control" id="current" name="current" required maxlength="100">
                    </div>
                    <div class="form-group">
                        <label for="password"><strong>Password Baru</strong></label>
                        <input type="password" class="form-control" id="password" name="password" required maxlength="100">
                    </div>
                    <div class="float-right">
                        <button type="submit" id="save" value="save" class="btn btn-warning"><i class="fa-regular fa-floppy-disk"></i> Update</button>
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
            icon: 'info',
            title: '<?= $this->session->flashdata('message') ?>'
        })
    </script>
<?php endif ?>