<?php
  //error_reporting(0);
  require_once("config/connection.php");
  $ret = new Connection();
  $url = $ret->base_url();
 ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="<?=$url;?>node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" >
    <style media="screen">
      img .animated-gif{
        width: 20px;
        height: auto;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <!-- NAV -->
      <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">ANP</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="<?=$url?>">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?=$url?>form">Form</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Data Master
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="provinsi">Provinsi</a></li>
                  <li><a class="dropdown-item" href="#">Kota / Kabupaten</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Kecamatan / Kelurahan</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled">Disabled</a>
              </li>
            </ul>
            <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>
      <!-- NAV -->

        <div class="row">
          <div class="mt-3 col-12">
            <?php
              if($_GET['p']=='home' || $_GET['p']==''){
                include "view/home/index.php";
              }else if($_GET['p']=='form'){
                  include "view/form/index.php";

              }else if($_GET['p']=='provinsi'){
                  include "view/provinsi/index.php";
              }
            ?>
          </div>
        </div>

    </div>
    <!-- JS -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script src="<?=$url;?>node_modules/bootstrap/dist/js/bootstrap.bundle.min.js" ></script>
    <script src="<?=$url;?>node_modules/@popperjs/core/dist/umd/popper.min.js"></script>

    <script type="text/javascript">
        $('#kab').prop("disabled", true);
        $('#kec').prop("disabled", true);
        $('#desa').prop("disabled", true);
        let no_prov = '';
        let no_kota = '';
        let no_kec  = '';
        let no_des  = '';

        //Select Provinsi To select Kecamatan
        $('#provinsi').on('change', function() {
            let id = this.value;
            no_prov = $('option:selected', this).attr('noprov');
            $('#hprovinsi').val(no_prov);

            if(id=="null"){
              $('#kab').prop("disabled", true);
              $('#kec').prop("disabled", true);
              $('#desa').prop("disabled", true);
              $('#kab').html("<option>Select Once</option>");
              $('#kec').html("<option>Select Once</option>");
              $('#desa').html("<option>Select Once</option>");
            }else{
                let from = 'provinsi';
                $.ajax({
                  method: "POST",
                  url: "select_kota.php",
                  data: {id:id, from:from},
                  success: function(html)
                  {
                     $('#kab').html(html);
                     $('#kab').prop("disabled", false);
                     $('#kec').html("<option>Select Once</option>");
                     $('#desa').html("<option>Select Once</option>");
                  },
                  error: function (jqXHR, textStatus, errorThrown) {

                      alert('Message: ' + textStatus + ' , HTTP: ' + errorThrown)
                      console.log('Message: ' + textStatus + ' , HTTP: ' + errorThrown );
                  }
                });
          }
        });

        //Select Kabupaten To select Kecamatan
        $('#kab').on('change', function() {
            let id = this.value;
            no_kota = $('option:selected', this).attr('nokota');
            $('#hkota').val(no_kota);
            if(id=="null"){
              $('#kec').prop("disabled", true);
              $('#desa').prop("disabled", true);
              $('#kec').html("<option>Select Once</option>");
              $('#desa').html("<option>Select Once</option>");
            }else{
                let from='kab';

                $.ajax({
                  method: "POST",
                  url: "select_kota.php",
                  data: {id:id, from:from},
                  success: function(html)
                  {
                     $('#kec').html(html);
                     $('#kec').prop("disabled", false);
                     $('#desa').html("<option>Select Once</option>");
                  },
                  error: function (jqXHR, textStatus, errorThrown) {

                      alert('Message: ' + textStatus + ' , HTTP: ' + errorThrown)
                      console.log('Message: ' + textStatus + ' , HTTP: ' + errorThrown );
                  }
                });
          }
        });

        //Select Kecamatan To select Desa
        $('#kec').on('change', function() {
            let id = this.value;
            no_kec = $('option:selected', this).attr('nokec');
            $('#hkec').val(no_kec);

            if(id=="null"){
              $('#desa').prop("disabled", true);
              $('#desa').html("<option>Select Once</option>");
            }else{
                let from='kec';

                $.ajax({
                  method: "POST",
                  url: "select_kota.php",
                  data: {id:id, from:from},
                  success: function(html)
                  {
                     $('#desa').html(html);
                     $('#desa').prop("disabled", false);
                  },
                  error: function (jqXHR, textStatus, errorThrown) {

                      alert('Message: ' + textStatus + ' , HTTP: ' + errorThrown)
                      console.log('Message: ' + textStatus + ' , HTTP: ' + errorThrown );
                  }
                });
          }
        });

        $('#desa').on('change', function(){
          let id = this.value;
          no_des = $('option:selected', this).attr('nodes');
          $('#hdesa').val(no_des);
        })


    </script>

    <script type="text/javascript">
      $(document).on('submit','#datas',function(e){
        e.preventDefault();
        let datas = $(this).serialize();
        console.log(datas);
        $.ajax({
          method: "POST",
          url: "act.php",
          data: $(this).serialize(),
          beforeSend: function () {
              //function here ...
             $('.loader').show();
             $('#simpan').prop('disabled', true);
          },
          success: function(json)
          {
             console.log('DATA ----> '+ json);
             let data = JSON.parse(json);


             $('#rnik').html(data.data[0].nik);
             $('#rnama').html(data.data[0].nama);
             $('.loader').hide();
             $('#simpan').prop('disabled', false);
             $('.card-data').show();
          },
          error: function (jqXHR, textStatus, errorThrown) {
              alert('Message: ' + textStatus + ' , HTTP: ' + errorThrown)
              $('.loader').hide();
              $('#simpan').prop('disabled', false);
          }
        });

      });
    </script>

  </body>
</html>
