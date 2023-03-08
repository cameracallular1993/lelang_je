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
        <h5 class="text-center">Tambah data Lelang</h5>
        <form action="new" method="post">
    <div class="row">
        <div class="col-md-12">
        <div mb-2>
        <!-- Menampilkan flashh data (pesan saat data berhasil disimpan)-->
        <?php if ($this->session->flashdata('message')) :
        echo $this->session->flashdata('message');
        endif; ?>
        </div>
        <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="id_barang">Nama Barang</label>
                        <div class="col-sm-10">
                            <select name="id_barang" id="id_barang" class="form-control" requered >
                            <option value="Pilih Data"></option>
                            <?php foreach ($lelang as $row) { ?>
                                <option value="<?= $row->id_barang; ?>">
                                    <?= $row->nama_barang; ?> (IDR <?= $row->harga_awal; ?>)
                            </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tanggal Mulai</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="date" name="tgl_mulai" >
                    </div>
                </div> 
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tanggal Akhir</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="date" name="tgl_akhir" >
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

            <!-- End -->
            <?php $this->load->view('backend/_partials/footer') ?> 
    </main>
</body>
</html>
<!-- Datable -->