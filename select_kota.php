<?php
//include the data
require_once("function/data.php");
$city = new Data();

//condition value of POST
if(isset($_POST['id']) && isset($_POST['from'])){
  echo "<option value='null'>Select Once</option>";

      //for select Kabupaten
      if($_POST['from']=='provinsi'){
          $kota = $city->get_kota($_POST['id']);

          if($kota!='Kosong'){
            foreach ($kota as $kotas) {
              echo "<option value=".$kotas->id_kot." nokota=".$kotas->no_kot.">".$kotas->nama_kot."</option>";
            }
          }else{
            echo "<option>No data</option>";
          }

      //for select kecamatan
      }else if($_POST['from']=='kab'){
          $kecamatan = $city->get_kec($_POST['id']);

          if($kecamatan!='Kosong'){
            foreach ($kecamatan as $kec) {
              echo "<option value=".$kec->id_kec." nokec=".$kec->no_kec.">".$kec->nama_kec."</option>";
            }
          }else{
            echo "<option>No data</option>";
          }


      //for select desa
      }else if($_POST['from']=='kec'){
            $desa = $city->get_desa($_POST['id']);

            if($desa!='Kosong'){
              foreach ($desa as $des) {
                echo "<option value=".$des->id_des." nodes=".$des->no_des.">".$des->nama_des."</option>";
              }
            }else{
              echo "<option>No data</option>";
            }
      }

}else{
  echo "<option>Tidak ada Data Provinsi</option>";
}//end condition post

 ?>
