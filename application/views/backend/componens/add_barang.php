<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view('backend/_partials/header') ?>
</head>
<body>
    <main class="main">
        <?php $this->load->view('backend/_partials/sidenav') ?>

        
    <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success" role="alert">
        <?php echo $this->session->flashdata('success'); ?>
    </div>
    <?php endif; ?>

    <div class="container pt-2 ">
    <div class="card-body">
    <h5 class="text-center">Tambah data Barang</h5>
    <div class="row">
    <div class="col-md-12">
    <div mb-2>
        <!-- Menampilkan flashh data (pesan saat data berhasil disimpan)-->
        <?php if ($this->session->flashdata('message')) :
        echo $this->session->flashdata('message');
        endif; ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nama Barang</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="nama_barang" >
                    </div>
                </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Deskripsi Barang</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="3" name="deskripsi"></textarea>
                    </div>
                </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Harga Awal</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="harga_awal" >
                    </div>
                </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="file" name="gambar" id="gambar">
                    </div>
                </div>
                <div class="form-group row">
                <div class="col-sm-10 ml-sm-auto">
                    <?php
                    if (isset($_GET['edit'])) { ?>
                    <input type="submit" name="update" value="update" class="btn btn-success">
                    <?php }else{ ?>
                    <input type="submit" name="simpan" value="simpan" class="btn btn-primary">
                    <?php } ?>
                </div>
                </div>
        </form>
    </div>
</div>
</div>
</div>
</div>

            <!-- End -->
            <?php $this->load->view('backend/_partials/footer') ?> 
    </main>
</body>
</html>
<!-- Datable -->