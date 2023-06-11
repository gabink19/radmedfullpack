<?php 
date_default_timezone_set("Asia/Jakarta");
$url = 'https://ajax.luno.com/ajax/1/display_ticker';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
$result = curl_exec($ch);
curl_close($ch);
$result = json_decode($result,true);
if (isset($result['btc_price'])) {
	$btc_price = str_replace('BTC/IDR ', '', $result['btc_price']);
	$btc_price = str_replace(',', '', $btc_price);
	$skrg = date("H:i");
	$balance = fopen("/var/www/html/visit.id/bit/balance.txt", "r") or die("Unable to open file!");
	$balances = fgets($balance);
	fclose($balance);


	$urls = 'https://api.mybitx.com/api/1/ticker?pair=XBTIDR';
	$chs = curl_init($urls);
	curl_setopt($chs, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($chs, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($chs, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	$results = curl_exec($chs);
	curl_close($chs);
	$results = json_decode($results,true);
	if (isset($results['last_trade'])) {
		$btc_price_sell = (int)$results['last_trade'];
	}else{
		$btc_price_sell = $btc_price;
	}


	$simpan = $skrg."||".$btc_price."||".floor($btc_price_sell*(float)$balances)."||".$balances."\r\n";
	if (file_exists("/var/www/html/visit.id/bit/data/".date('Ymd').".txt")) {
		$file = "/var/www/html/visit.id/bit/data/".date('Ymd').".txt";
		$current = $simpan;
		file_put_contents($file, $current, FILE_APPEND);
	}else{
		$myfile = fopen("/var/www/html/visit.id/bit/data/".date('Ymd').".txt", "w") or die("Unable to open file!");
		fwrite($myfile, $simpan);
		fclose($myfile);
	}
	$myfile = fopen("/var/www/html/visit.id/bit/data/updated.txt", "w") or die("Unable to open file!");
	fwrite($myfile, $simpan);
	fclose($myfile);
}