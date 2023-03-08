<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view('backend/_partials/header') ?>
</head>

<body>
    <main class="main">
        <?php $this->load->view('backend/_partials/sidenav') ?>
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Tambah Barang</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" enctype="multipart/form-data" action="<?= base_url('backend/gambar/add_gambar/'. $barang->id_barang) ?>">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Barang</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" value="<?= $barang->nama_barang; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Gambar</label>
                    <div class="input-group">
                      <input class="" type="file" name="gambar" required="">
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button class="btn btn-primary">Tambah Gambar</button>
                    <a href="<?= base_url('backend/barang') ?>" class="btn btn-secondary">Kembali</a>
                </div>
              </form>
            </div>
            <!-- /.card -->
      </div><!-- /.container-fluid -->

        <div class="content">
            <h4>Data Gambar</h4>
            <!-- Start kodingan disini -->
    <table id="users" class="table">
        <thead>
            <tr>
                <th>Nama Gambar</th>
                <th>Gambar</th>
                <th>Action</th> 
            </tr>          
    </thead>
    <tbody>
        <?php foreach ($gambar as $p) 
        if ($p->id_barang === $barang->id_barang) { ?>
            <tr>
                <th><?= $p -> nama_gambar ?></th>
                <td><img src="<?= empty($p->gambar) ? base_url('assets/images/no_image.png') : base_url('upload/barang/' . $p->gambar) ?>" width="100px"></td>
                <td>
                                    <!-- hapus-->
                                <a href="#" data-delete-url="<?= site_url('backend/gambar/hapus_gambar/' . $p->id_gambar) ?>" onclick="deleteConfirm(this)">
                                <button type="button" class="btn btn-danger" title="Hapus">
                                <i class=" fa-solid fa-trash"></i>
                                </button>
                                </a>
                </td>
            </tr>
            <?php } ?>
    </tbody>
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
<script>
    $(document).ready(function(){
        var table = $('#users').DataTable({
            dom: 'Bfrtip',
            buttons : [
                'copy','csv', 'excel', 'pdf', 'print'
            ]
        });
    })
    
</script>
<!-- Datable -->

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