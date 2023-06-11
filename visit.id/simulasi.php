<?php 
include dirname(__FILE__).'/db/Db.class.php';
ini_set('max_execution_time', '300'); 

date_default_timezone_set('Asia/Jakarta');
$db = new Db(); 
$day = date('Y-m-d');
$chek_db = "DROP TABLE IF EXISTS tbl_data_".date('dmY', strtotime("-1 day", strtotime($day)));
$db->query($chek_db);
$chek_db = "DROP TABLE IF EXISTS tbl_data_".date('dmY');
$db->query($chek_db);
$crt_db ="CREATE TABLE `tbl_data_".date('dmY')."` (
				 `id_data` int(11) NOT NULL AUTO_INCREMENT,
				 `id_device` int(11) NOT NULL COMMENT 'dari id table device',
				 `id_ruang` int(11) NOT NULL COMMENT 'dari id table ruang',
				 `value` blob NOT NULL,
				 `datetime` datetime NOT NULL,
				 `id_sensor` int(11) DEFAULT NULL,
				 PRIMARY KEY (`id_data`) USING BTREE
				) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC";
$db->query($crt_db);
$datefrom2 = date('Y-m-d 00:00:00');
$dateto2 = date('Y-m-d 23:59:59');
$insertDate = $datefrom2;
$jmlh = 0 ;
while($datefrom2 <= $dateto2){
	if ($insertDate==date('Y-m-d').' 23:59:59') {
		break;
	}
  $insertDate = date('Y-m-d H:i:s', strtotime("+1 second", strtotime($insertDate)));
  $sql = "INSERT INTO tbl_data_".date('dmY')." ( id_device, id_ruang, value, `datetime`, id_sensor) VALUES ('1','1', '".rand(70,160).",".rand(0,9).";".rand(60,100).",".rand(0,9)."', '".$insertDate."','1')";

  if ($db->query($sql) === TRUE) {
      // echo "New record created successfully";
  } else {
      // echo "Error: " . $sql . "<br>" . $db->error;
  }
	$jmlh ++;
}
echo "<pre>";print_r('Jumlah device 1:'.$jmlh); echo "</pre>";

$datefrom2 = date('Y-m-d 00:00:00');
$dateto2 = date('Y-m-d 23:59:59');
$insertDate = $datefrom2;
$jmlh = 0 ;

while($datefrom2 <= $dateto2){
	if ($insertDate==date('Y-m-d').' 23:59:59') {
		break;
	}
  $insertDate = date('Y-m-d H:i:s', strtotime("+1 second", strtotime($insertDate)));
  // $sql = "INSERT INTO tbl_data_01022021 ( id_device, id_ruang, value, `datetime`, id_sensor) VALUES ('1','1', '".rand(70,160).",".rand(0,9).";".rand(60,100).",".rand(0,9)."', '".$insertDate."','1')";
  $sql = "INSERT INTO tbl_data_".date('dmY')." ( id_device, id_ruang, value, `datetime`, id_sensor) VALUES ('2','1', '".rand(50,100)."', '".$insertDate."','2')";

  if ($db->query($sql) === TRUE) {
      // echo "New record created successfully";
  } else {
      // echo "Error: " . $sql . "<br>" . $db->error;
  }
  $jmlh++;
}

echo "<pre>";print_r('Jumlah device 2:'.$jmlh); echo "</pre>";


$datefrom2 = date('Y-m-d 00:00:00');
$dateto2 = date('Y-m-d 23:59:59');
$insertDate = $datefrom2;
$jmlh = 0 ;
while($datefrom2 <= $dateto2){
	if ($insertDate==date('Y-m-d').' 23:59:59') {
		break;
	}
  $insertDate = date('Y-m-d H:i:s', strtotime("+1 second", strtotime($insertDate)));
  // $sql = "INSERT INTO tbl_data_01022021 ( id_device, id_ruang, value, `datetime`, id_sensor) VALUES ('1','1', '".rand(70,160).",".rand(0,9).";".rand(60,100).",".rand(0,9)."', '".$insertDate."','1')";
  $sql = "INSERT INTO tbl_data_".date('dmY')." ( id_device, id_ruang, value, `datetime`, id_sensor) VALUES ('3','1', '".rand(20,100).",".rand(0,9)."', '".$insertDate."','3')";

  if ($db->query($sql) === TRUE) {
      // echo "New record created successfully";
  } else {
      // echo "Error: " . $sql . "<br>" . $db->error;
  }
  $jmlh++;
}

echo "<pre>";print_r('Jumlah device 3:'.$jmlh); echo "</pre>";