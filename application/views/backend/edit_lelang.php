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
        <h5 class="text-center">Edit data Lelang</h5>
    <div class="row">
        <div class="col-md-12">
        <div mb-2>
        <!-- Menampilkan flashh data (pesan saat data berhasil disimpan)-->
        <?php if ($this->session->flashdata('message')) :
        echo $this->session->flashdata('message');
    endif; ?>
    </div>
        <div class="ibox-body">
            <form class="form-horizontal" method="post">
            <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Barang</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="nama_barang" value="<?= $lelang->nama_barang ?>">
                    </div>
                </div>
            <form class="form-horizontal" method="post">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tanggal Mulai</label>
                <div class="col-sm-10">
                    <input class="form-control" type="date" name="tgl_mulai" value="<?= $lelang->tgl_mulai ?>" >
                </div>
            </div> 
            <div class="form-group row"> 
            <label class="col-sm-2 col-form-label">Tanggal Akhir</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="date" name="tgl_akhir" value="<?= $lelang->tgl_akhir ?>">
                    </div>
                </div> 
                <div class="form-group row">
                    <div class="col-sm-10 ml-sm-auto">
                    <button type="submit" name="upadate" class="button button-primary" value="upadate">Update</button>
                    </div>
                </div>
        </form>
    </div>
</div>
</div>
</div>

            <!-- End -->
            <?php $this->load->view('backend/_partials/footer') ?> 
    </main>
</body>
</html>
<!-- Datable -->