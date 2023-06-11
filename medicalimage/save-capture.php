<?php
if (isset($_GET['file'])) {
	$filepath = 'dwv-jqmobile/uploads/'.$_GET['file'];
	header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filepath));
    flush(); // Flush system output buffer
    readfile($filepath);
    die();
}
if (isset($_GET['pecah'])) {
}
$image = $_POST["image"];
$image = explode(";", $image)[1];
$image = explode(",", $image)[1];
$image = str_replace(" ", "+", $image);

$image = base64_decode($image);
$time = strtotime(date('YmdHis'));
file_put_contents("dwv-jqmobile/uploads/capture_".$time.".png", $image);


// header("Location : https://image.radmed.co.id/ajax/url_upload_handler?csaKey1=a0db9ce7773b2eddd61463ac97df28e419c72ae861e3ef42e3a106fbd41dbde9&csaKey2=014a0833482fba8536400de562b7845d3b412d8b7933c75333a5ea438c1fd5ec&rowId=0&url=https://image.radmed.co.id/dwv-jqmobile/uploads/capture_".$time.".png&folderId=".$_GET["folderId"]);
// echo "https://image.radmed.co.id/ajax/url_upload_handler?csaKey1=a0db9ce7773b2eddd61463ac97df28e419c72ae861e3ef42e3a106fbd41dbde9&csaKey2=014a0833482fba8536400de562b7845d3b412d8b7933c75333a5ea438c1fd5ec&rowId=0&url=https://image.radmed.co.id/dwv-jqmobile/uploads/capture_".$time.".png&folderId=".$_GET["folderId"];
// die();
#persiapkan curl
$ch = curl_init(); 
$url = "https://image.radmed.co.id/ajax/url_upload_handler?csaKey1=a0db9ce7773b2eddd61463ac97df28e419c72ae861e3ef42e3a106fbd41dbde9&csaKey2=014a0833482fba8536400de562b7845d3b412d8b7933c75333a5ea438c1fd5ec&rowId=0&url=https://image.radmed.co.id/dwv-jqmobile/uploads/capture_".$time.".png&folderId=".$_GET["folderId"]."&gbr_up=1&userId=".$_GET["userId"];
// set url 
curl_setopt($ch, CURLOPT_URL, $url);

// return the transfer as a string 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

// $output contains the output string 
$output = curl_exec($ch); 

// tutup curl 
curl_close($ch);      

// menampilkan hasil curl
echo $output;die();

$str =explode('<div class=\"fileUrls hidden\">',$output);
$str = str_replace('<\/div><\/td>"}});</script>','',$str[1]);
echo str_replace('\/','/',$str);
die();