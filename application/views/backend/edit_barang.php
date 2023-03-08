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
        <h5 class="text-center">Edit data Barang</h5>
    <div class="row">
        <div class="col-md-12">
            <div mb-2>
            <!-- Menampilkan flashh data (pesan saat data berhasil disimpan)-->
            <?php if ($this->session->flashdata('message')) :
            echo $this->session->flashdata('message');
            endif; ?>
            </div>
            <div class="ibox-body">
                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Barang</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="nama_barang" value="<?= $barang->nama_barang ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="3" name="deskripsi" ><?= $barang->deskripsi ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Harga Awal</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="harga_awal" value="<?= $barang->harga_awal ?>">
                    </div>
                </div> 
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Gambar</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="file" name="gambar"  >
                    </div>
                </div> 
                <div class="form-group row"> 
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <select name="status" class="form-control" value="<?= $barang->status ?>">
                            <option value="#">Pilih Status</option>
                            <?php
                                $status=array("New","Process","Sold");
                                foreach($status as $status){
                            ?>
                            <option value="<?php echo $status ?>" <?=($barang->status==$status)?'selected':''?>><?php echo $status ?></option>
                            <?php } ?>
                        </select> 
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
</div>
            <!-- End -->
            <?php $this->load->view('backend/_partials/footer') ?> 
    </main>
</body>
</html>
<!-- Datable -->