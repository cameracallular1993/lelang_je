<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('backend/_partials/header'); ?>
	<title>Login</title>
    <style type="text/css">
body {
    background: #d9bd9c;
    font-family: 'Roboto', sans-serif;
}

.login-box {
    margin-top: 75px;
    height: auto;
    background: #cab08b;
    text-align: center;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
}



.login-title {
    margin-top: 15px;
    text-align: center;
    font-size: 30px;
    letter-spacing: 2px;
    margin-top: 15px;
    font-weight: bold;
    color: #ECF0F5;
}

.login-form {
    margin-top: 25px;
    text-align: left;
}

input[type=text] {
    background-color: #ECF0F5;
    border: none;
    border-bottom: 2px solid #90604c;
    border-top: 0px;
    border-radius: 0px;
    font-weight: bold;
    outline: 0;
    margin-bottom: 20px;
    padding-left: 0px;
    color: #90604c;
}

input[type=nik] {
    background-color: #ECF0F5;
    border: none;
    border-bottom: 2px solid #90604c;
    border-top: 0px;
    border-radius: 0px;
    font-weight: bold;
    outline: 0;
    padding-left: 0px;
    margin-bottom: 20px;
    color: #90604c;
}

.form-group {
    margin-bottom: 40px;
    outline: 0px;
}

.form-control:focus {
    border-color: inherit;
    -webkit-box-shadow: none;
    box-shadow: none;
    border-bottom: #1a1a1a;
    outline: 0;
    background-color: #FFFAFA;
    color: #1a1a1a;
}

input:focus {
    outline: none;
    box-shadow: 0 0 0;
}

label {
    margin-bottom: 0px;
}

.form-control-label {
    font-size: 10px;
    color: #90604c;
    font-weight: bold;
    letter-spacing: 1px;
}

.btn-outline-primary {
    border-color: #90604c;
    color: #90604c;
    border-radius: 0px;
    font-weight: bold;
    letter-spacing: 1px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
}

.btn-outline-primary:hover {
    background-color: #90604c;
    right: 0px;
}

.login-btm {
    float: left;
}

.login-button {
    padding-right: 0px;
    text-align: right;
    margin-bottom: 25px;
}

.login-text {
    text-align: left;
    padding-left: 0px;
    color: #90604c;
}

.loginbttm {
    padding: 0px;
}
</style>
</head>
<body> 
<form method="post" class="form">
<div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 login-box">
                <img src="<?= base_url('assets/images/logo1.png') ?>" style="margin-left : -5px;" width="145 %">
                <div class="col-lg-12 login-title">
                    Register
                </div>
                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">
                        <form>
                        <div class="card-body">
                <form action="" method="POST" autocomplete="off">
                    <div class="form-group">
                        <label for="nik"><strong>NIK</strong></label>
                        <input type="text" class="form-control" name="nik" required maxlength="20" />
                    </div>
                    <div class="form-group">
                        <label for="nama"><strong>Nama</strong></label>
                        <input type="text" class="form-control" name="nama" required maxlength="100" />
                    </div>
                    <div class="form-group">
                        <label for="jk"><strong>Jenis Kelamin</strong></label>
                        <select name="jk" id="jk" class="form-control" required>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="no_hp"><strong>No Kontak</strong></label>
                        <input type="text" class="form-control" name="no_hp" required maxlength="50" />
                    </div>
                    <div class="form-group">
                        <label for="alamat"><strong>Alamat</strong></label>
                        <textarea class="form-control" name="alamat" required maxlength="250"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="email"><strong>Email</strong></label>
                        <input type="email" class="form-control" name="email" required maxlength="100" />
                    </div>
                    <div class="form-group">
                        <label for="password"><strong>Password</strong></label>
                        <input type="password" class="form-control" id=" password" name="password" required maxlength="100">
                    </div>
                    <div class="float-right">
                        <button type="submit" id="save" value="save" class="btn btn-warning"><i class="fa-regular fa-floppy-disk"></i> Lanjutkan</button>
                    </div>

                            <div class="col-lg-12 loginbttm">
                                <div class="col-lg-6 login-btm login-text">
                                    <!-- Error Message -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2"></div>
            </div>
        </div> 
</body>
</html>

 