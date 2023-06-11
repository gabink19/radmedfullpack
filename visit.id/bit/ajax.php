<?php 
date_default_timezone_set("Asia/Jakarta");
header('Content-Type: application/json');
if (isset($_GET['update'])) {
  $array = [];
  $limit = $_POST['limit'];
  $data = $_POST['data'];
  $current = fopen("/var/www/html/visit.id/bit/data/updated.txt", "r") or die("Unable to open file!");
  while ($line = fgets($current)) {
    $pecah = explode("||", $line);
    $array['oxi']['date'][]=$pecah[0];
    $array['oxi']['bpm'][]=(int)$pecah[2];
  }
  echo json_encode($array);die();
}
$array = [];
$limit = $_POST['limit'];
$data = $_POST['data'];
$current = fopen("/var/www/html/visit.id/bit/data/".date('Ymd').".txt", "r") or die("Unable to open file!");
// $currents = fgets($current);
// fclose($current);
// $oxi = explode(PHP_EOL, $currents);
while ($line = fgets($current)) {
  $pecah = explode("||", $line);
  $array['oxi']['date'][]=$pecah[0];
  $array['oxi']['bpm'][]=(int)$pecah[2];
}
echo json_encode($array);