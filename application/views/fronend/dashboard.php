<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('partials/header') ?>
<?php $this->load->view('partials/sidenav') ?>
<div class="slide-one-item antik-slider owl-carousel">

<div class="site-blocks-cover overlay" style="background-image: url(http://localhost/lelang_je/assets/images/utama2.jpg
);" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center justify-content-center text-center">
            <div class="col-md-10">
              <h1 class="mb-2">Melelang Berbagai Jenis Barang Antik</h1>
            </div>
          </div>
        </div>
      </div>  

      <div class="site-blocks-cover overlay" style="background-image: url(http://localhost/lelang_je/assets/images/utama7.jpg
);" data-aos="fade" data-stellar-background-ratio="0.5">        <div class="container">
          <div class="row align-items-center justify-content-center text-center">
            <div class="col-md-10">
              <h1 class="mb-2">Lelang Barang Antik</h1>
            </div>
          </div>
        </div>
      </div>  

    </div>


    <div class="site-section site-section-sm pb-0">
      <div class="container">
        <div class="row">
        <form method="post" class="form-search col-md-12" style="margin-top: -100px;" action="<?= site_url('page/cari') ?>">
                <div class="input-group">
                    <input type="text"  class="form-control" placeholder="Cari di Lelang Antik" aria-label="Cari di Lelang Antik" id="cari" name="cari" aria-describedby="button-addon2">
                    <div class="">
                        <!-- <i class="fa-solid fa-magnifying-glass"></i> -->
                        <input type="submit" class="btn btn-primary" id="search" value="Cari">
                    </div>
                </div>
            </form>
        </div>  

        <div class="row">
          <div class="col-md-12">
            <div class="view-options bg-white py-3 px-3 d-md-flex align-items-center">
              <div class="mr-auto">
                <a href="index.html" class="icon-view view-module active"><span class="icon-view_module"></span></a>
                <a href="view-list.html" class="icon-view view-list"><span class="icon-view_list"></span></a>
                
              </div>
              </div>
            </div>
          </div>
        </div>
       
      </div>
    </div>

    <div class="site-section site-section-sm bg-light">
      <div class="container">
      
        <div class="row mb-1">
          <?php foreach ($dashboard as $d) { ?>
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="property-entry h-100">
              <a href="<?= base_url('page/dbarang/'. $d->id_lelang) ?>" class="property-thumbnail">
                <img src="<?= base_url ('upload/barang/'. $d->gambar) ?>" alt="Image" class="img-fluid" style="width:100%" >
              </a>
              <div class="card-body">
                            <h6 class="list-group-item bg-warning"><?= $d->Keterangan ?></h6>
                            <h1 class="card-title text-center"><?= $d->nama_barang ?></h1>
                        
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">IDR <?= number_format($d->harga_awal, 2) ?></li>
                            <li class="list-group-item"><?= $d->total_penawaran ?> penawaran</li>
                        </ul>
              </div>
            </div>
          </div>
          
          <?php } ?>
        </div>
      </div>
          </div>  
      </div>
    </div>

      </div>
    </div>
          <div class="col-md-6 col-lg-4 mb-5 mb-lg-5">
          </div>
        </div>
    </div>
    </div>
        <?php $this->load->view('partials/footer') ?>
</html>