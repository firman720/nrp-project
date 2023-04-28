<?php
 require_once("function/data.php");
 $show = new Data();
 $provinsi = $show->get_provinsi();
 @$post_data = $show->save_data();
 ?>

<div class="row">
    <div class="col-lg-9 mt-3">
      <form id="datas" action="" method="post">
        <h4 class="mb-3">Form Data Warga</h4>
        <div class="row g-3">
            <div class="col-sm-6">
              <label for="firstName" class="form-label">First name</label>
              <input type="text" name="fname" class="form-control" id="firstName" placeholder="" value="" required="">
            </div>

            <div class="col-sm-6">
              <label for="lastName" class="form-label">Last name</label>
              <input type="text" name="lname" class="form-control" id="lastName" placeholder="" value="" required="">
            </div>
        </div>
        <hr class="my-4">
        <h4 class="mb-3">Domisili</h4>
        <div class="row g-3 mt-3">
            <div class="col-sm-9">
              <label for="address" class="form-label">Alamat</label>
              <input type="text" name="address" class="form-control" id="address" placeholder="" value="" required="">
            </div>
            <div class="col-sm-3">
              <label for="jk" class="form-label">Jenis Kelamin</label>
              <select class="form-select" id="jk" name="jk" required>
                <option value="null" >Choose...</option>
                <option value="L" >Laki-laki</option>
                <option value="P" >Perempuan</option>
              </select>
            </div>
        </div>
        <div class="row g-3 mt-3">
            <div class="col-md-6">
              <label for="provinsi" class="form-label">Provinsi</label>
              <input type="hidden" name="hprovinsi" id="hprovinsi" value="" required="">

              <select class="form-select" id="provinsi" name="provinsi" required>
                <option value="null" >Choose...</option>
                <?php
                    foreach ($provinsi as $prov) {
                       echo "<option value=".$prov->id_prv." noprov=".$prov->no_prv." >".$prov->nama_prv."</option>";
                    }
                ?>
              </select>

            </div>

            <div class="col-md-6">
              <label for="kab" class="form-label">Kabupaten/Kota</label>
              <input type="hidden" name="hkota" id="hkota" value="" required="">

              <select class="form-select" id="kab" name="kota" required>
                  <option value="null">Choose...</option>
              </select>

            </div>
        </div>

        <div class="row g-3 mt-3">
            <div class="col-md-6">
              <label for="kec" class="form-label">Kecamatan / Kelurahan</label>
              <input type="hidden" name="hkec" id="hkec" value="" required="">

              <select class="form-select" id="kec" name="kecamatan" required>
                <option value="null">Choose...</option>
              </select>

            </div>

            <div class="col-md-6">
              <label for="desa" class="form-label">Desa</label>
              <input type="hidden" name="hdesa" id="hdesa" value="" required="">

              <select class="form-select" id="desa" name="desa" required>
                <option value="">Choose...</option>
                <option>California</option>
              </select>

            </div>
        </div>

        <hr class="my-4 mt-5">
        <button class="w-100 btn btn-primary btn-lg" type="submit" id="simpan" name="simpan">Simpan Data</button>
      </form>
    </div>
    <div class="loader col-lg-3 mt-3 text-center" style="display:none" >
        <img src="loading.gif" alt="" class="mt-5" style="width:50px; height:auto" />
    </div>

    <div class="card-data col-lg-3 mt-3 " style="display:none">
      <h4 class="mb-3">NIK</h4>
      <div class="col-sm-12 text-bg-dark rounded-3 p-3" >
        <label for="nik" class="form-label">NIK</label>

        <div id="rnik" style="font-size:14px; color:#FFF;"></div>
        <div id="rnama" style="font-size:14px; color:#FFF;"></div>
        <input type="hidden" class="form-control" id="nik" placeholder="" value="" required="">
        <button id="getnik" class="w-100 btn btn-primary btn-sm mt-2" type="submit">Get NIK</button>
      </div>

    </div>
</div>
