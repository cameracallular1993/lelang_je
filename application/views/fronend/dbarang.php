<!DOCTYPE html>
    <html lang="en">

    <head>
        <?php $this->load->view('partials/header') ?>
    </head>

    <body>
        <main class="main">
            <?php $this->load->view('partials/sidenav') ?>

            <div class="content">
                <div class="container my-4 col-8">
                    <div style="color:#477a7d">
                        <h5><?= $lelang->nama_barang ?></h5>
                    </div>
                    <hr>
                    <div class="container row">
                        <div class="col-5">
                            <div id="carouselExampleIndicators" class="carousel slide card" style="height: 350px; width: 300px;" data-ride="carousel">
                                <div class="carousel-inner">
                                    <?php foreach ($gambar as $b) : ?>
                                        <div class="carousel-item <?= $b->utama == 1 ? 'active' : '' ?>">
                                            <img class="d-block" src="<?= base_url('upload/barang/' . $b->gambar); ?>" width="300px">
                                        </div>
                                    <?php endforeach ?>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-7 p-2">
                            <div class="bg-secondary p-2">
                                <h4 class="text-white">Harga spesial : IDR <?= number_format($lelang->harga_awal, 2) ?></h4>
                            </div>
                            <div class="overflow-auto p-2" style="height: 300px;">
                                <h4>Deskripsi:</h4>
                                <p><?= $lelang->deskripsi ?></p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="bg-secondary px-4 py-2 text-white">
                        <h5>Penawaran tertinggi : IDR <?= number_format($lelang->harga_tertinggi, 2) ?> /<small><?= $lelang->total_penawaran ?> penawaran</small></h5>
                    </div>
                    <?php if ($activeUser) : ?>
                        <div class="p-4">
                            <form method="post">
                                <div class="form-group">
                                    <label for="harga_penawaran"><strong>Harga Penawaran</strong></label>
                                    <input type="number" min=1 max=1000000000 maxlength="10" class="form-control" name="harga_penawaran" required />
                                    <br>
                                    <button type="submit" id="save" value="save" class="btn btn-primary"> Kirim Penawaran</button>
                                </div>
                            </form>
                        </div>
                        <h6>Penawaran Sebelumnya</h6>
                        <hr>
                        <div class="p-4 overflow-auto" style="height: 300px;">
                            <?php foreach ($penawaran as $m) : ?>
                                <div>
                                    <small>
                                        <p><?= $m->nama_penawar ?>, <?= $m->tgl_penawaran ?>
                                            <br>Harga penawaran : <strong>IDR <?= number_format($m->harga_penawaran, 2) ?></strong></br>
                                            <hr>
                                        </p>
                                    </small>
                                </div>
                            <?php endforeach ?>
                        </div>
                    <?php endif ?>
                    <?php $this->load->view('partials/footer') ?>
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
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'info',
                title: '<?= $this->session->flashdata('message') ?>'
            })
        </script>
    <?php endif ?>

    <!-- Datatable -->
    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({
                buttons: [],
                dom: "<'row '<'col-md-4'l> <'col-md-4'B> <'col-md-4'f>>" +
                    "<'row '<'col-md-12'tr>>" +
                    "<'row '<'col-md-5'i> <'col-md-7'p>>",
                lengthChange: true
            });

            table.buttons().container()
                .appendTo('#example_wrapper .col-md-6:eq(0)');
        });
    </script>