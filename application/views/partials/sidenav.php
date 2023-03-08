<nav class="navbar navbar-expand-lg bg-black bg-info p-2">

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="col-2 text-center">
            <a href="<?= site_url() ?>"><h4 class="text-white">EUROANTIQUE</h4></a>

        </div>
        <div class="col-9 justify-content-end">
            <ul class="navbar-nav justify-content-end">
                <div class="btn-group justify-content-end">

                    <a class="btn btn-secondary btn-sm" role="button" href="<?= site_url() ?>">
                        <i class="fa-solid fa-house"></i>
                        <small>Home</small>
                    </a>
                    <?php if ($activeUser) : ?>
                        <a class="btn btn-secondary btn-sm" role="button" href="<?= site_url('page/penawaran') ?>">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                            <small>Riwayat</small>
                        </a>
                        <a class="btn btn-secondary btn-sm" role="button" href="<?= site_url('page/lelang') ?>">
                            <i class="fa-solid fa-trophy"></i>
                            <small>Lelang</small>
                        </a>
                        <a class="btn btn-secondary btn-sm" role="button" href="<?= site_url('page/edit') ?>">
                            <i class="fa-solid fa-user"></i>
                            <small>Hi, <?= $activeUser->nama; ?></small>
                        </a>
                        <a class="btn btn-secondary btn-sm" title="Change Password" role="button" href="<?= site_url('page/change') ?>">
                            <i class="fa-solid fa-lock"></i>
                        </a>
                        <a class="btn btn-secondary btn-sm" title="Logout" role="button" href="<?= site_url('page/logout') ?>">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </a>
                    <?php endif ?>
                    <?php if (!$activeUser) : ?>
                        <a class="btn btn-dark" role="button" href="<?= site_url('page/login') ?>">
                            <small><strong>Sign In</strong></small>
                        </a>
                        <a class="btn btn-dark" role="button" href="<?= site_url('backend/auth/login') ?>">
                            <small><strong>Sign In Admin</strong></small>
                        </a>
                        <a class="btn btn-warning" role="button" href="<?= site_url('page/register') ?>">
                            <small><strong>Register</strong></small>
                        </a>
                    <?php endif ?>
                </div>
            </ul>
        </div>
    </div>
</nav>