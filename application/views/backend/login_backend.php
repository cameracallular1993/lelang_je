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

input[type=password] {
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
    border-bottom: 2px solid #90604c;
    outline: 0;
    background-color: #90604c;
    color: #90604c;
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
                    Silahkan Login
                </div>
                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">
                        <form>
                            <div class="form-group">
                                <label class="form-control-label">USERNAME</label>
                                <input type="text" name="username" class="<?= form_error('username') ? 'invalid' : '' ?>" 
								placeholder="Masukkan Username" value="<?= set_value('username') ?>" required>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">PASSWORD</label>
								<input type="password" name="password" class="<?= form_error('password') ? 'invalid' : '' ?>" 
								placeholder="Masukkan Password" value="<?= set_value('password') ?>" required>              
                            </div>

                            <div class="col-lg-12 loginbttm">
                                <div class="col-lg-6 login-btm login-text">
                                    <!-- Error Message -->
                                </div>
                                <div class="form-group text-danger">
                        <?= $this->session->flashdata('error') ?>
                    </div>
                    <button type="submit" class="btn btn-dark" style="width: 100%;" value="Login"><small>Lanjutkan</small> <i class="fa-solid fa-right-to-bracket"></i></button>
                </form>
            </div>
                </div>
                <div class="col-lg-3 col-md-2"></div>
            </div>
        </div> 
</body>
</html>

 