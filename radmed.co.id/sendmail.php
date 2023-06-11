<?php
date_default_timezone_set("Asia/Jakarta");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Include librari phpmailer
include('cron_mailer/PhpMailer/Exception.php');
include('cron_mailer/PhpMailer/PHPMailer.php');
include('cron_mailer/PhpMailer/SMTP.php');

$servername = "localhost";
$username = "u1114618_medicalimage";
$password = "disana4misbah";
$dbname = "u1114618_medicalimage";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM `mail_cron` WHERE status in ('baru','gagal') and host is not null";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $sql = "UPDATE mail_cron SET status='proses' WHERE id=".$row["id"];

    if ($conn->query($sql) === TRUE) {
      // echo "Record updated successfully";
    } else {
      // echo "Error updating record: " . $conn->error;
    }

    $email_pengirim = $row["from_email"]; // Isikan dengan email pengirim
    $nama_pengirim = $row["from_name"]; // Isikan dengan nama pengirim
    $email_penerima = $row["to_email"]; // Ambil email penerima dari inputan form
    $subjek = $row["subject"]; // Ambil subjek dari inputan form
    $pesan = $row["body"]; // Ambil pesan dari inputan form
    $host = $row["host"]; // Ambil pesan dari inputan form
    $username = $row["username"]; // Ambil pesan dari inputan form
    $password = $row["password"]; // Ambil pesan dari inputan form
    $port = $row["port"]; // Ambil pesan dari inputan form
    $error = "";
    // $attachment = $_FILES['attachment']['name']; // Ambil nama file yang di upload
    try {
      $mail = new PHPMailer;
      $mail->isSMTP();
      $mail->Host = $host;
      $mail->Username = $username; // Email Pengirim
      $mail->Password = $password; // Isikan dengan Password email pengirim
      $mail->Port = $port;
      $mail->SMTPAuth = true;
      $mail->SMTPSecure = 'ssl';
      $mail->SMTPDebug = 4; // Aktifkan untuk melakukan debugging
      $mail->setFrom($email_pengirim, $nama_pengirim);
      $mail->addAddress($email_penerima, '');
      $mail->isHTML(true); // Aktifkan jika isi emailnya berupa html
      $mail->Subject = $subjek;
      $mail->MsgHTML($pesan);
      $send = $mail->send();

    } catch (phpmailerException $e) {
      $error = $e->errorMessage(); //Pretty error messages from PHPMailer
      $myfile = fopen("cron_mailer/log.txt", "w") or die("Unable to open file!");
      $txt = json_encode($error);
      fwrite($myfile, $txt);
      fclose($myfile);
    } catch (Exception $e) {
      $error = $e->getMessage(); //Boring error messages from anything else!
      $myfile = fopen("cron_mailer/log.txt", "w") or die("Unable to open file!");
      $txt = json_encode($error);
      fwrite($myfile, $txt);
      fclose($myfile);
    }
    if($send){ // Jika Email berhasil dikirim
        $sql = "UPDATE mail_cron SET status='terkirim',tanggal_terkirim='".date('Y-m-d H:i:s')."' WHERE id=".$row["id"];

        if ($conn->query($sql) === TRUE) {
          // echo "Record updated successfully";
        } else {
          // echo "Error updating record: " . $conn->error;
        }

    }else{ // Jika Email gagal dikirim
        $sql = "UPDATE mail_cron SET status='gagal',log='".json_encode($mail->ErrorInfo)."' WHERE id=".$row["id"];
        echo "<pre>";print_r($mail->ErrorInfo); echo "</pre>";
        if ($conn->query($sql) === TRUE) {
          // echo "Record updated successfully";
        } else {
          // echo "Error updating record: " . $conn->error;
        }
    }

  }
} else {
  echo "0 results";
  die();
}

