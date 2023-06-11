<?php 
date_default_timezone_set("Asia/Bangkok");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
ini_set('max_execution_time', '300');

while (true) {
	print_r("--- Start Job ---".PHP_EOL);
	print_r('From: ' . date('Y-m-d H:i:s').PHP_EOL);
	try {
		$dir = "/var/radmed_file/";
		$temp = "/var/radmed_temp/";
		$backup = "/var/radmed_backup/";
		$folder_file = scandir($dir);
		$unik = uniqid();
		$foldercount = 0;
		print_r('Files Count: ' . ceil(count($folder_file)-2) . PHP_EOL);
		if (count($folder_file)>2) {
			$api_key = query("SELECT key_public, key_secret FROM apiv2_api_key where user_id='1' LIMIT 1");
			$baseurl = 'https://image.radmed.co.id';
			$authorize = $baseurl.'/api/v2/authorize?key1='.$api_key[0]['key_public'].'&key2='.$api_key[0]['key_secret'].''; 

			$create_folder = "https://image.radmed.co.id/api/v2/folder/create";
			$Upload_file = "https://image.radmed.co.id/api/v2/file/upload";

			print_r('Hit API: ' . $authorize.PHP_EOL);
			$get_access = curl($authorize,[]);
			if ($get_access['_status']=='success') {
				$access_tokenX 	= $get_access['data']['access_token'];
				$account_idX	= $get_access['data']['account_id'];

				print_r('Create Temp Folder : ' . $temp.$unik.PHP_EOL);
				mkdir($temp.$unik);
				foreach ($folder_file as $v) {
					if ($v=='.') {}else if ($v=='..') {
					}else{
						$chek_name = explode('_', $v);
						if (count($chek_name)==5) {
							$new_folder_name = $temp.$unik."/".$v;
							rename($dir.$v, $new_folder_name);
							$foldercount++;
						}else{
							query("INSERT INTO log_mirth_file (`tanggal`,`namafile`,`status`,`note`) VALUES ('".date('Y-m-d H:i:s')."','".$v."','Gagal','Nama File tidak sesuai ketentuan.')");
							$new_folder_name = $backup.$v;
							rename($dir.$v, $new_folder_name);
							print_r('Not Valid filename : ' . $v.PHP_EOL);
						}
					}
				}
				print_r('Count valid files : ' . $foldercount.PHP_EOL);
				#upload via api 
				if ($foldercount>0) {
					$folder_temp = scandir($temp.$unik."/");
					$dir = $temp.$unik."/";
					foreach ($folder_temp as $v) {
						if ($v=='.') {}else if ($v=='..') {
						}else{
							$realname = $v;
							$v = str_replace(":", "--", $v);
							$v = str_replace("+", "--", $v);
							rename($temp.$unik."/".$realname, $temp.$unik."/".$v);
							$file_explode = explode('_', $v);
							$noRM = $file_explode[0];
							$date = $file_explode[1].' '.$file_explode[2];
							$fixing_tgl = str_replace("-", "", $file_explode[1]);
							$tglFile = date('d-m-Y',strtotime(substr($fixing_tgl,0,8)));
							$ext_cut = explode('.', $file_explode[3]);
							$noFoto = str_replace('.'.end($ext_cut), '', $file_explode[3]);

							$cek_folder_RM = query("SELECT * FROM file_folder where userId='".$account_idX."' and folderName='".$noRM."' and parentId is null and status='active' LIMIT 1");
							if (!empty($cek_folder_RM)) {
								print_r('Folder RM check : exists -> use existing folder'.PHP_EOL);
								$id_parent_noRM = $cek_folder_RM[0]['id'];
							}else{
								print_r('Folder RM check : does not exist -> create folder by API'.PHP_EOL);
								$curl_noRM = curl($create_folder."?access_token=".$access_tokenX."&account_id=".$account_idX."&folder_name=".$noRM."&is_public=1"."&access_password=".md5("TestPassword"));
								$id_parent_noRM = $curl_noRM['data']['id'];
							}

							$cek_folder_tgl = query("SELECT * FROM file_folder where userId='".$account_idX."' and folderName='".$tglFile."'  and parentId='".$id_parent_noRM."' and status='active'  LIMIT 1");
							if (!empty($cek_folder_tgl)) {
								print_r('Folder Tanggal check : exists -> use existing folder'.PHP_EOL);
								$id_parent_tanggal = $cek_folder_tgl[0]['id'];
							}else{
								print_r('Folder Tanggal check : does not exist -> create folder by API'.PHP_EOL);
								$curl_tanggal = curl($create_folder."?access_token=".$access_tokenX."&account_id=".$account_idX."&folder_name=".$tglFile."&is_public=1"."&parent_id=".$id_parent_noRM);
								$id_parent_tanggal = $curl_tanggal['data']['id'];
							}

							$cek_folder_foto = query("SELECT * FROM file_folder where userId='".$account_idX."' and folderName='".$noFoto."' and parentId='".$id_parent_tanggal."' and status='active'  LIMIT 1");
							if (!empty($cek_folder_foto)) {
								print_r('Folder Foto check : exists -> use existing folder'.PHP_EOL);
								$id_parent_foto = $cek_folder_foto[0]['id'];
							}else{
								print_r('Folder Foto check : does not exist -> create folder by API'.PHP_EOL);
								$curl_foto = curl($create_folder."?access_token=".$access_tokenX."&account_id=".$account_idX."&folder_name=".$noFoto."&is_public=1"."&parent_id=".$id_parent_tanggal);
								$id_parent_foto = $curl_foto['data']['id'];
							}

							$nama_file_asli = $v;
							$file_name = str_replace(" ", "_", $v);
							$cek_file = query("SELECT * FROM file where folderId='".$id_parent_foto."' and status='active' and originalFilename='".$file_name."'  LIMIT 1");
							if (!empty($cek_file)) {
								print_r('File Name check : filename is exist --> '.$v.PHP_EOL);
								query("INSERT INTO log_mirth_file (`tanggal`,`namafile`,`status`,`note`) VALUES ('".date('Y-m-d H:i:s')."','".$v."','Gagal','File Sudah ADA')");
								rmdir($temp.$unik);
							}
							rename($temp.$unik."/".$nama_file_asli, $temp.$unik."/".$file_name);
							print_r('File Name check : filename is not exist --> upload file by API'.PHP_EOL);
							$url_upload = $Upload_file."?access_token=".$access_tokenX."&account_id=".$account_idX."&upload_file=".$temp.$unik."/".$file_name."&folder_id=".$id_parent_foto;
							$array_send = ['access_token'=>$access_tokenX,'account_id'=>$account_idX,'folder_id'=>$id_parent_foto,'path'=>$temp.$unik."/".$file_name];
							$upload = curl($url_upload,$array_send);
							if ($upload['_status']=='success') {
								print_r('Upload check : success to upload'.PHP_EOL);
								query("INSERT INTO log_mirth_file (`tanggal`,`namafile`,`status`) VALUES ('".date('Y-m-d H:i:s')."','".$nama_file_asli."','Berhasil')");
								unlink($temp.$unik."/".$file_name);
							}else{
								print_r('Upload check : failed to upload'.PHP_EOL);
								query("INSERT INTO log_mirth_file (`tanggal`,`namafile`,`status`,`note`) VALUES ('".date('Y-m-d H:i:s')."','".$nama_file_asli."','Gagal','Gagal Upload : ".json_encode($upload)."')");
								rename($temp.$unik."/".$file_name, $backup."/".$nama_file_asli);
							}
						}
					}
					print_r('Delete Temp Folder : ' . $temp.$unik.PHP_EOL);
					rmdir($temp.$unik);
				}
			}
		}
	} catch (Exception $e) {
		query("INSERT INTO error_log (`date`,`message`,`file`,`line`,`error_type`) VALUES ('".date('Y-m-d H:i:s')."','".$e->getMessage()."','mirth_uploader.php','','error try catch')");
		print_r("-- Getting Error --".PHP_EOL);
		print_r($e->getMessage());
		print_r("-- End Of Error --".PHP_EOL);
	}
	print_r('To: ' . date('Y-m-d H:i:s').PHP_EOL);
	print_r("-- Finish Job --".PHP_EOL);
	print_r("--- Sleep for 3 second ---".PHP_EOL.PHP_EOL.PHP_EOL);
	sleep(3);// sleep 3 detik
}

function curl($url,$array_send=[])
{
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	$result = curl_exec($ch);

	if (curl_errno($ch)) {
    $error_msg = curl_error($ch);
	}
	curl_close($ch);

	if (isset($error_msg)) {
	    echo "<pre>";print_r($error_msg); echo "</pre>";
	}

	return json_decode($result,1);
}

function query($sql)
{
	$link = new mysqli('127.0.0.1', 'root', 'Disana4misbah@k', 'medicalimage');
	$link->set_charset('utf8mb4'); // always set the charset
	$result = $link->query($sql);
	$output = [];
	if (!isset($result->num_rows)) {
		# code...
	}else{
		if ($result->num_rows > 0) {
		  // output data of each row
		  while($row = $result->fetch_assoc()) {
		  		$output[] =$row;
		  }
		}
	}
	return $output;
}
