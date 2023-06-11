<?php 
header('Content-Type: application/json');
include dirname(__FILE__).'/db/Db.class.php';
// echo getcwd();
// die();
$db = new Db(); 
$array = [];
$limit = $_POST['limit'];
$data = $_POST['data'];
if ($data=='all') {
  $now = date('Y-m-d H:i:s');
  $_POST['now']=date('Y-m-d H:i:s', strtotime("-60 second", strtotime($now)));
}
if ($data=='all' || $data=='oxi') {
  $oxi = $db->query("select datetime,value from tbl_data_".date('dmY')." where id_device=1 and datetime>'".$_POST['now']."' LIMIT ".$limit."");
  foreach ($oxi as $key => $value) {
    $array['oxi']['date'][]=date('H:i:s',strtotime($value['datetime']));
    $nilai = explode(';', $value['value']);
    $array['oxi']['bpm'][]=(float)str_replace(',', '.', $nilai[0]);
    $array['oxi']['spo2'][]=(float)str_replace(',', '.', $nilai[1]);
    $array['oxi']['last_data']=$value['datetime'];
    $array['oxi']['last_bpm']=(float)str_replace(',', '.', $nilai[0]);
    $array['oxi']['last_spo2']=(float)str_replace(',', '.', $nilai[1]);
    if ((int)$nilai[1]>=110) {
      $kondisi="high";
    }else if ((int)$nilai[1]>=60) {
      $kondisi="low";
    }else{
      $kondisi="normal";
    }
    
    $array['oxi']['condition']=$kondisi;
  }
}

if ($data=='all' || $data=='jarak') {
  $sensorjarak = $db->query("select datetime,value from tbl_data_".date('dmY')." where id_device=2 and datetime>'".$_POST['now']."' LIMIT ".$limit."");
  foreach ($sensorjarak as $key => $value) {
    $array['sensorjarak']['date'][]=date('H:i:s',strtotime($value['datetime']));
    $array['sensorjarak']['value'][]=(int)$value['value'];
    $array['sensorjarak']['last_data']=$value['datetime'];
    $array['sensorjarak']['last_jarak']=(int)$value['value'];
  }
}
if ($data=='all' || $data=='udara') {
  $sensorjarak = $db->query("select datetime,value from tbl_data_".date('dmY')." where id_device=3 and datetime>'".$_POST['now']."' LIMIT ".$limit."");
  foreach ($sensorjarak as $key => $value) {
    $array['sensorkelembapan']['date'][]=date('H:i:s',strtotime($value['datetime']));
    $array['sensorkelembapan']['value'][]=(float)str_replace(',', '.', $value['value']);;
    $array['sensorkelembapan']['last_data']=$value['datetime'];
    $array['sensorkelembapan']['last_lembab']=(float)str_replace(',', '.', $value['value']);;
  }
}
echo json_encode($array);