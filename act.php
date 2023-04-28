<?php
include 'function/data.php';
$data = new Data();

if(!empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['address']) && !empty($_POST['jk']) && !empty($_POST['desa'])
 && !empty($_POST['hprovinsi']) && !empty($_POST['hkota']) && !empty($_POST['hkec'])  && !empty($_POST['hdesa'])){
  $save = $data->save_data();

  $code = json_decode($save);
  if($code->status ==201){

    echo json_encode($code);

  }else if($code->status ==500){
    echo json_encode($code);
  }else{
    echo json_encode($code);
  }

}else{
  return 'Empty';
}

?>
