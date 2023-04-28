<?php
//error_reporting(0);
date_default_timezone_set("Asia/Jakarta");
require_once "config/connection.php";

class Data extends Connection{
    //Construct
    public function __construct(){
          $this->conn = $this->get_connection();
    }

    // Provinsi
    function get_provinsi(){
      $query = "SELECT * FROM provinsi";
      $run   = $this->conn->query($query);
      $row   = $run->num_rows;

      if($row>0){
          while($datas= $run->fetch_object())
  	      {
  	         $data[]=$datas;
  	      }

          return $data;
      }else{
        return 'Kosong';
      }
    }


    //Kota
    function get_kota($prov){
      $id    = $this->real_escape($prov);

      $query = "SELECT * FROM kota WHERE id_prv='$id'";
      $run   = $this->conn->query($query);
      $row   = $run->num_rows;

      if($row>0){
          while($datas= $run->fetch_object())
  	      {
  	         $data[]=$datas;
  	      }

          return $data;
      }else{
        return 'Kosong';
      }
    }


    function get_kec($kab){
      $id    = $this->real_escape($kab);

      $query = "SELECT * FROM kecamatan WHERE id_kot='$id'";
      $run   = $this->conn->query($query);
      $row   = $run->num_rows;

      if($row>0){
          while($datas= $run->fetch_object())
  	      {
  	         $data[]=$datas;
  	      }

          return $data;
      }else{
        return 'Kosong';
      }
    }


    function get_desa($kab){
      $id    = $this->real_escape($kab);

      $query = "SELECT * FROM desa WHERE id_kec='$id'";
      $run   = $this->conn->query($query);
      $row   = $run->num_rows;

      if($row>0){
          while($datas= $run->fetch_object())
  	      {
  	         $data[]=$datas;
  	      }

          return $data;
      }else{
        return 'Kosong';
      }
    }

    function nik(){
        $num        = '';
        $sql       = "SELECT MAX(SUBSTR(nik,11,4)) AS nik FROM warga";
        $run       = $this->conn->query($sql);
        $data      = $run->fetch_array();
        $row       = $run->fetch_row();
        $num       = $data["nik"];
        $number    = $num;//(int)substr($num, 10, 4);
                     $number++;
        if($row > 0){
          return 'kode telah digunakan';
        }else{
          $val = sprintf("%04s", $number);
        }

        return $val;
    }

    function save_data(){
      $f_name = $this->real_escape($_POST['fname']);
      $l_name  = $this->real_escape($_POST['lname']);
      $address  = $this->real_escape($_POST['address']);
      $jk         = $this->real_escape($_POST['jk']);

      $provinsi    = $this->real_escape($_POST['hprovinsi']);
      $kota         = $this->real_escape($_POST['hkota']);
      $kec           = $this->real_escape($_POST['hkec']);
      $hdesa          = $this->real_escape($_POST['hdesa']);
      $desa            = $this->real_escape($_POST['desa']);

      $no_urut          = $this->nik();
      $nik               = $provinsi.$kota.$kec.$hdesa.$no_urut; //10100200030001
      $tgl                = date('Y-m-d H:i:s');
      $final               = array();

      if(!empty($f_name) && !empty($l_name) && !empty($address) &&
      !empty($provinsi) && !empty($kota) && !empty($kec) && !empty($hdesa) && !empty($desa) && ($desa!=0)
      ){

          $qsave = "INSERT INTO warga (nik,nama_awal,nama_akhir,jk,alamat,id_des,create_time,Update_time)
                    VALUES ('$nik','$f_name','$l_name','$jk','$address','$desa', '$tgl','0000-00-00 00:00:00')";
          $run = $this->conn->query($qsave);
          if ($run) {
            // code...
            $sdata = "SELECT nik, nama_awal, nama_akhir FROM warga WHERE nik='$nik'";
            $exe   = $this->conn->query($sdata);
            if($exe){
                while ($row = $exe->fetch_array()) {
                   array_push($final, array(
                     'nik'  => $row['nik'],
                     'nama' => $row['nama_awal'].' '.$row['nama_akhir']
                   ));
                }
                $res = array(
                   'status'=>201,
                   'data'  =>$final
                );

            }else{
              $res = array(
                 'status'=>500,
                 'data'  =>'select filed'

              );
            }

          }else {
            $res = array(
               'status'=>500,
               'data'  =>'null'
            );

           return $res;
          }

      }else{
        $res = array(
           'status'=>400,
           'data'  =>'null'
        );
      }

      $array = json_encode($res);
      return $array;
    }

}
