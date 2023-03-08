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
            <h5 class="text-center">Tambah data User</h5>
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
                        <label class="col-sm-2 col-form-label">NIP</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="nip" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="nama" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="username" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="email" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">No Kontak</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="no_kontak" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="password" name="password" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Level</label>
                        <div class="col-sm-10">
                            <select name="level" class="form-control">
                                <option value="#">Pilih Level</option>
                                <?php
                                    $level=array("Admin","Petugas");
                                    foreach($level as $level){
                                ?>
                                <option value="<?php echo $level ?>"><?php echo $level ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">status</label>
                        <div class="col-sm-10">
                            <select name="status" class="form-control">
                                <option value="#">Pilih status</option>
                                <?php
                                    $status=array("1","0");
                                    foreach($status as $status){
                                ?>
                                <option value="<?php echo $status ?>"><?php echo $status ?></option>
                            <?php } ?>
                            </select>
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
<!-- Datable -->