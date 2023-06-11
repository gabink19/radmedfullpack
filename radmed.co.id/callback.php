<?php
  $url = "https://accounts.spotify.com/api/token";
  $secret_key = base64_encode("aac2f7922c84452c85a027c86328c9ed:12c84a4edb624ec096011074234a2ca9");
  $authorization = "Authorization: Basic ".$secret_key;
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded', $authorization));
  $result = curl_exec($ch);
  curl_close($ch);
  $data = json_decode($result);
  $myfile = fopen("access_token.php", "w") or die("Unable to open file!");
  fwrite($myfile, $data['access_token']."|||".date('Y-m-d H:i:s'));
  fclose($myfile);
?>