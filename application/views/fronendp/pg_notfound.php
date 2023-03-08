<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('partials/header') ?>
</head>

<body>
    <main class="main">
        <?php $this->load->view('partials/sidenav') ?>

        <div class="content">
            <div class="container col-12 row mx-1 py-3 justify-content-center">
                <img src="<?= base_url('assets/images/nodata-found.png'); ?>" height="250px">
            </div>
            <?php $this->load->view('partials/footer') ?>
        </div>
    </main>
</body>

</html>