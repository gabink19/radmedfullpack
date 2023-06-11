<?php
namespace App\Controllers;

header('Access-Control-Allow-Origin: *');
use App\Core\BaseController;
use App\Core\Database;
use App\Core\Model;
use App\Models\UserMobile;
use App\Models\User;
use App\Models\File;
use App\Models\FileFolder;
use App\Models\FileBookmark;
use App\Helpers\FileFolderHelper;
use App\Helpers\LogHelper;
use App\Helpers\FileHelper;
use App\Services\Api\V2\ApiV2;

class ApiMobileController extends BaseController
{

    public function register() {
        // pickup request
        $request = file_get_contents('php://input');
        $request = json_decode($request);
        if (isset($request->rekam_medis) && $request->rekam_medis!="") {
        }else{
        	$check =  UserMobile::count();
        	$total_user = ceil($check+1);
        	if ($total_user<10) {
        		$request->rekam_medis = "RM-0000".$total_user;
        	}else
        	if ($total_user<100) {
        		$request->rekam_medis = "RM-000".$total_user;
        	}else
        	if ($total_user<1000) {
        		$request->rekam_medis = "RM-00".$total_user;
        	}else
        	if ($total_user<10000) {
        		$request->rekam_medis = "RM-0".$total_user;
        	}else{
        		$request->rekam_medis = "RM-".$total_user;
        	}
        }
        $required_item = ['email','password','rekam_medis','nohp','status','user_level'];
        foreach ($required_item as $value) {
            if (!isset($request->$value)) {
                $response['data'] = [];
                $response['response_code'] = 400;
                $response['status'] = 'failed.';
                $response['message'] = 'Validation Error.';
                return $this->renderJson($response);
            }
            if (isset($request->$value) && $request->$value=='') {
                $response['data'] = [];
                $response['response_code'] = 400;
                $response['status'] = 'failed.';
                $response['message'] = 'Validation Error.';
                return $this->renderJson($response);
            }
        }
        $db = Database::getDatabase();
        // cek email
        
        $cek_email = UserMobile::loadOne('email', $request->email);
        if ($cek_email) {
            $response['data'] = [];
            $response['response_code'] = 400;
            $response['status'] = 'failed.';
            $response['message'] = 'Email has registered.';
            return $this->renderJson($response);
        }

        $response = [];
        $usermobile = UserMobile::create();
        $usermobile->email = $request->email ;
        $usermobile->password = self::encrypt($request->password) ;
        $usermobile->rekam_medis = $request->rekam_medis ;
        $usermobile->nohp = $request->nohp ;
        $usermobile->status = $request->status ;
        $usermobile->date = date('Y-m-d H:i:s') ;
        $usermobile->updated_at = date('Y-m-d H:i:s') ;
        $usermobile->user_level = $request->user_level ;
        if ($usermobile->save()) {
            $response['data'] = $usermobile;
            $response['response_code'] = 200;
            $response['status'] = 'success.';
            $response['message'] = 'Create User Mobile Success.';

            $token = $this->get_token();

            // simulate posting the file using curl
            $url = _CONFIG_SITE_PROTOCOL . "://" ._CONFIG_SITE_HOST_URL . '/api/v2/account/create';
            $data_create = [];
            $data_create['access_token'] = $token;
            $data_create['username'] = $usermobile->email;
            $data_create['password'] = $request->password;
            $data_create['email'] = $request->email;
            $data_create['status'] = 'active';
            $data_create['firstname'] = $usermobile->email;
            $data_create['lastname'] = $usermobile->email;
            $data_create['package_id'] = 1;
            LogHelper::info('Curl request to: ' . $url);
            LogHelper::info('Curl params: ' . json_encode($data_create, true));

            $curl = $this->curl($url,$data_create);
            if ($curl['_status']!='success') {
                $usermobile->delete();
                $response['data'] = [];
                $response['response_code'] = 500;
                $response['status'] = 'failed.';
                $response['message'] = 'Create User Mobile Failed.';
            }else{
                $usermobile->connect_user_id = $curl['data']['id'];
                $usermobile->save();

                $this->updateFolderOwned($usermobile->rekam_medis,$curl['data']['id']);
            }
        }else{
            $response['data'] = [];
            $response['response_code'] = 500;
            $response['status'] = 'failed.';
            $response['message'] = 'Create User Mobile Failed.';
        }

        return $this->renderJson($response);
    }

    public function getProfile() {
        // pickup request
        $request = file_get_contents('php://input');
        $request = json_decode($request);
        $required_item = ['id'];
        foreach ($required_item as $value) {
            if (!isset($request->$value)) {
                $response['data'] = [];
                $response['response_code'] = 400;
                $response['status'] = 'failed.';
                $response['message'] = 'Validation Error.';
                return $this->renderJson($response);
            }
            if (isset($request->$value) && $request->$value=='') {
                $response['data'] = [];
                $response['response_code'] = 400;
                $response['status'] = 'failed.';
                $response['message'] = 'Validation Error.';
                return $this->renderJson($response);
            }
        }
        $userMobile = UserMobile::loadOne('id', $request->id);
        if ($userMobile) {
            $response['data'] = $userMobile;
            $response['response_code'] = 200;
            $response['status'] = 'success.';
            $response['message'] = 'Get Profile Mobile Success.';
            return $this->renderJson($response);
        }else{
            $response['data'] = [];
            $response['response_code'] = 500;
            $response['status'] = 'failed.';
            $response['message'] = 'Get Profile Mobile Failed.';
            return $this->renderJson($response);
        }
    }

    public function login() {
        // pickup request
        $request = file_get_contents('php://input');
        $request = json_decode($request);
        $required_item = ['email','password'];
        foreach ($required_item as $value) {
            if (!isset($request->$value)) {
                $response['data'] = [];
                $response['response_code'] = 400;
                $response['status'] = 'failed.';
                $response['message'] = 'Validation Error.';
                return $this->renderJson($response);
            }
            if (isset($request->$value) && $request->$value=='') {
                $response['data'] = [];
                $response['response_code'] = 400;
                $response['status'] = 'failed.';
                $response['message'] = 'Validation Error.';
                return $this->renderJson($response);
            }
        }
        $userMobile = UserMobile::loadOne('email', $request->email);
        if ($userMobile) {
            if ($request->password === self::decrypt($userMobile->password)) {
                $response['data'] = $userMobile;
                $response['response_code'] = 200;
                $response['status'] = 'success.';
                $response['message'] = 'Login Success.';
                return $this->renderJson($response);
            }else{
                $response['data'] = [];
                $response['response_code'] = 400;
                $response['status'] = 'failed.';
                $response['message'] = 'Password invalid.';
                return $this->renderJson($response);
            }
        }else{
            $response['data'] = [];
            $response['response_code'] = 400;
            $response['status'] = 'failed.';
            $response['message'] = 'Email not registered.';
            return $this->renderJson($response);
        }
    }

    public function updateProfile() {
        // pickup request
        $request = file_get_contents('php://input');
        $request = json_decode($request);
        $required_item = ['id','rekam_medis','nohp','status','jenis_kelamin','nama','tgl_lahir','user_level'];
        foreach ($required_item as $value) {
            if (!isset($request->$value)) {
                $response['data'] = [];
                $response['response_code'] = 400;
                $response['status'] = 'failed.';
                $response['message'] = 'Validation Error.';
                return $this->renderJson($response);
            }
            if (isset($request->$value) && $request->$value=='') {
                $response['data'] = [];
                $response['response_code'] = 400;
                $response['status'] = 'failed.';
                $response['message'] = 'Validation Error.';
                return $this->renderJson($response);
            }
        }
        $user_mobile = UserMobile::loadOneById($request->id);
        if ($user_mobile) {
            $user_mobile->rekam_medis = $request->rekam_medis;
            $user_mobile->nohp = $request->nohp;
            $user_mobile->status = $request->status;
            $user_mobile->jenis_kelamin = $request->jenis_kelamin;
            $user_mobile->nama = $request->nama;
            $user_mobile->tgl_lahir = $request->tgl_lahir;
            $user_mobile->user_level = $request->user_level;
            $user_mobile->updated_at = date('Y-m-d H:i:s') ;
            if ($user_mobile->save()) {
                $response['data'] = $user_mobile;
                $response['response_code'] = 200;
                $response['status'] = 'success.';
                $response['message'] = 'Update Profile Success.';
                $token = $this->get_token();
                if ($user_mobile->connect_user_id!='') {
                    // simulate posting the file using curl
                    $url = _CONFIG_SITE_PROTOCOL . "://" ._CONFIG_SITE_HOST_URL . '/api/v2/account/edit';
                    $data_edit = [];
                    $data_edit['access_token'] = $token;
                    $data_edit['account_id'] = $user_mobile->connect_user_id;
                    $data_edit['status'] = 'active';
                    $expl = explode(' ', $user_mobile->nama);
                    if (isset($expl[1])) {
                        $last = end($expl);
                        $data_edit['firstname'] = str_replace(' '.$last, '', implode(' ', $expl)) ;
                        $data_edit['lastname'] = $last;
                    }
                    else{
                        $data_edit['firstname'] = $user_mobile->nama;
                        $data_edit['lastname'] = $user_mobile->nama;
                    }
                    $data_edit['package_id'] = 1;
                    LogHelper::info('Curl request to: ' . $url);
                    LogHelper::info('Curl params: ' . json_encode($data_edit, true));

                    $curl = $this->curl($url,$data_edit);
                    if ($curl['_status']!='success') {
                        $response['data'] = [];
                        $response['response_code'] = 500;
                        $response['status'] = 'failed.';
                        $response['message'] = 'Update Profile Mobile Failed.';
                    }
                }
                

                return $this->renderJson($response);
            }else{
                $response['data'] = [];
                $response['response_code'] = 500;
                $response['status'] = 'failed.';
                $response['message'] = 'Update Profile Failed.';
                return $this->renderJson($response);
            }
        }else{
            $response['data'] = [];
            $response['response_code'] = 400;
            $response['status'] = 'failed.';
            $response['message'] = 'ID not found.';
            return $this->renderJson($response);
        }
    }

    public function updatePassword() {
        // pickup request
        $request = file_get_contents('php://input');
        $request = json_decode($request);
        $required_item = ['email','password'];
        foreach ($required_item as $value) {
            if (!isset($request->$value)) {
                $response['data'] = [];
                $response['response_code'] = 400;
                $response['status'] = 'failed.';
                $response['message'] = 'Validation Error.';
                return $this->renderJson($response);
            }
            if (isset($request->$value) && $request->$value=='') {
                $response['data'] = [];
                $response['response_code'] = 400;
                $response['status'] = 'failed.';
                $response['message'] = 'Validation Error.';
                return $this->renderJson($response);
            }
        }
        $cek_email = UserMobile::loadOne('email', $request->email);
        if ($cek_email) {
            $user_mobile = UserMobile::loadOneById($cek_email->id);
            $user_mobile->password = self::encrypt($request->password);
            $user_mobile->updated_at = date('Y-m-d H:i:s') ;
            if ($user_mobile->save()) {
                $response['response_code'] = 200;
                $response['status'] = 'success.';
                $response['message'] = 'Update Password Success.';
                if ($user_mobile->connect_user_id!='') {
                    $token = $this->get_token();
                    // simulate posting the file using curl
                    $url = _CONFIG_SITE_PROTOCOL . "://" ._CONFIG_SITE_HOST_URL . '/api/v2/account/edit';
                    $data_edit = [];
                    $data_edit['access_token'] = $token;
                    $data_edit['account_id'] = $user_mobile->connect_user_id;
                    $data_edit['status'] = 'active';
                    $data_edit['password'] = $request->password;
                    $data_edit['package_id'] = 1;
                    LogHelper::info('Curl request to: ' . $url);
                    LogHelper::info('Curl params: ' . json_encode($data_edit, true));

                    $curl = $this->curl($url,$data_edit);
                    if ($curl['_status']!='success') {
                        $response['data'] = [];
                        $response['response_code'] = 500;
                        $response['status'] = 'failed.';
                        $response['message'] = 'Update Password Failed.';
                        $response['curl'] = $curl;
                    }
                }
                return $this->renderJson($response);
            }else{
                $response['response_code'] = 500;
                $response['status'] = 'failed.';
                $response['message'] = 'Update Password Failed.';
                return $this->renderJson($response);
            }
        }else{
            $response['response_code'] = 400;
            $response['status'] = 'failed.';
            $response['message'] = 'Email not registered.';
            return $this->renderJson($response);
        }
    }


    public function lupaPassword() {
        // pickup request
        $request = file_get_contents('php://input');
        $request = json_decode($request);
        $required_item = ['email'];
        foreach ($required_item as $value) {
            if (!isset($request->$value)) {
                $response['data'] = [];
                $response['response_code'] = 400;
                $response['status'] = 'failed.';
                $response['message'] = 'Validation Error.';
                return $this->renderJson($response);
            }
            if (isset($request->$value) && $request->$value=='') {
                $response['data'] = [];
                $response['response_code'] = 400;
                $response['status'] = 'failed.';
                $response['message'] = 'Validation Error.';
                return $this->renderJson($response);
            }
        }
        $cek_email = UserMobile::loadOne('email', $request->email);
        if ($cek_email) {
            // $newpass = self::generateRandomString();
        	$newpass = self::decrypt($cek_email->password) ;
            $htmlMsg = '<p><img src="https://image.radmed.co.id/themes/evolution/assets/images/logo/logo.png" alt="" /></p>
                        <h4>Halo [[NAMA]],</h4>
                        <p>Berikut Password anda untuk melakukan login di radmed.co.id.</p>
                        <p>Pass : [[PASS]]</p>
                        <div>RADIOLOGY DEPARTEMENT, BRAWIJAYA HOSPITAL SAHARJO Jl. Dr. Saharjo No.199, RW.1, Tebet Bar., Kec. Tebet, Kota Jakarta Selatan, DKI Jakarta 12870 021- 3973-7890 0821-2221-1389 (Whats App Text Only)<br /><br />Tolong jangan balas email ini. Ini dibuat secara otomatis oleh sistem&nbsp;<span class="il">RadMED</span>&nbsp;sehingga alamat pengirim tidak dipantau untuk email. Silakan kirimkan permintaan melalui kami&nbsp;<a href="http://radmed.web.id/" target="_blank" rel="noopener" data-saferedirecturl="https://www.google.com/url?q=http://radmed.web.id&amp;source=gmail&amp;ust=1619508855780000&amp;usg=AFQjCNEHtdgdEDE6qobbJkHlNNHcLfjOIA">website</a>&nbsp;jika Anda memiliki pertanyaan.<br /><br />Pesan dikirim dari <a href="http://radmed.co.id/" target="_blank" rel="noopener" data-saferedirecturl="https://www.google.com/url?q=http://radmed.web.id&amp;source=gmail&amp;ust=1619508855780000&amp;usg=AFQjCNEHtdgdEDE6qobbJkHlNNHcLfjOIA"><span class="il">RadMED</span></a>&nbsp;on 12/03/2021 07:11:20</div>';
            $htmlMsg = str_replace('[[NAMA]]',$cek_email->nama , $htmlMsg);
            $htmlMsg = str_replace('[[PASS]]', $newpass , $htmlMsg);
            $user_mobile = UserMobile::loadOneById($cek_email->id);
            $user_mobile->password = self::encrypt($newpass);
            $user_mobile->save();
            $message = self::sendMail($request->email, "Lupa Password - Radmed", $htmlMsg);
            if ($message=='Message has been sent') {
                $response['response_code'] = 200;
                $response['status'] = 'success.';
                $response['message'] = $message;
                return $this->renderJson($response);
            }else{
                $response['response_code'] = 500;
                $response['status'] = 'failed.';
                $response['message'] = $message;
                return $this->renderJson($response);
            }
        }else{
            $response['response_code'] = 400;
            $response['status'] = 'failed.';
            $response['message'] = 'Email not registered.';
            return $this->renderJson($response);
        }
    }

    public function fileFolder() {
        // pickup request
        $request = file_get_contents('php://input');
        $request = json_decode($request);
        $db = Database::getDatabase();
        $required_item = ['rekam_medis'];
        $parentIdFolder_data = '';
        foreach ($required_item as $value) {
            if (!isset($request->$value)) {
                $response['data'] = [];
                $response['response_code'] = 400;
                $response['status'] = 'failed.';
                $response['message'] = 'Validation Error.';
                return $this->renderJson($response);
            }
            if (isset($request->$value) && $request->$value=='') {
                $response['data'] = [];
                $response['response_code'] = 400;
                $response['status'] = 'failed.';
                $response['message'] = 'Validation Error.';
                return $this->renderJson($response);
            }
        }
        $folderFile = [];
        $file_array = [];
        $cek_rekam_medis = FileFolder::loadOne1('folderName', $request->rekam_medis);
        if (isset($request->folder_id) && $request->folder_id != '') {
            $cek_rekam_medis = FileFolder::loadOne1('id', $request->folder_id);
        }
        if ($cek_rekam_medis) {
            $parentIdFolder = $cek_rekam_medis->id;
            $parentIdFolder_data = $parentIdFolder;
            $array_key = ['id', 'parentId', 'folderName', 'totalSize', 'isPublic', 'date_added', 'date_updated', 'status', 'urlHash' ];
            $i = 0;
            if (isset($request->folder_id) && $request->folder_id != '') {
                $cek_folder = FileFolder::loadOne1('id', $parentIdFolder);
                if ($cek_folder && $cek_folder->status=='active') {
                    foreach ($cek_folder as $kunci => $nilai) {
                        if (in_array($kunci, $array_key)) {
                            $folderFile[$i][$kunci] = $nilai;
                        }
                    }
                    if ($cek_folder->isPublic == 0) {
                        $cek_folder->isPublic = 1;
                        $cek_folder->save();
                    }
                    if ($cek_folder->urlHash == null || $cek_folder->urlHash == '') {
                        $cek_folder->urlHash = FileFolderHelper::generateRandomFolderHash();
                        $cek_folder->save();
                    }
                    $folderFile[$i]['url_folder'] = $cek_folder->getFolderUrl();
                    $folderFile[$i]['total_downloads'] = $cek_folder->getTotalViews();
                    $folderFile[$i]['child_folder_count'] = $cek_folder->totalChildFolderCount();
                    $folderFile[$i]['file_count'] = $cek_folder->totalFileCount();
                    $parentIdFolder = $cek_folder->id;
                    $i++;
                }else{
                    // break;
                }
            }
            for ($i=$i; $i < 100 ; $i++) { 
                $cek_folder = FileFolder::loadOne1('parentId', $parentIdFolder);
                if ($cek_folder && $cek_folder->status=='active') {
                    foreach ($cek_folder as $kunci => $nilai) {
                        if (in_array($kunci, $array_key)) {
                            $folderFile[$i][$kunci] = $nilai;
                        }
                    }
                    if ($cek_folder->isPublic == 0) {
                        $cek_folder->isPublic = 1;
                        $cek_folder->save();
                    }
                    if ($cek_folder->urlHash == null || $cek_folder->urlHash == '') {
                        $cek_folder->urlHash = FileFolderHelper::generateRandomFolderHash();
                        $cek_folder->save();
                    }
                    $folderFile[$i]['url_folder'] = $cek_folder->getFolderUrl();
                    $folderFile[$i]['total_downloads'] = $cek_folder->getTotalViews();
                    $folderFile[$i]['child_folder_count'] = $cek_folder->totalChildFolderCount();
                    $folderFile[$i]['file_count'] = $cek_folder->totalFileCount();
                    $folderFile[$i]['urlhash'] = $cek_folder->totalFileCount();
                    $parentIdFolder = $cek_folder->id;
                }else{
                    // break;
                }
            }
            $array_key = ['id', 'originalFilename', 'shortUrl', 'fileType', 'extension', 'fileSize', 'status', 'folderId', 'keywords'];
            foreach ($folderFile as $key => $value) {
                $file = File::loadMore('folderId', $value['id']);
                if ($file) {
                    $no = 0;
                    foreach ($file as $key1 => $value1) {
                        if ($value1->status=='active') {
                            foreach ($value1 as $kunci => $nilai) {
                                if (in_array($kunci, $array_key)) {
                                    $file_array[$no][$kunci] = $nilai;
                                }
                            }
                            $file_array[$no]['url_file'] = $value1->getShortUrlPath();
                        }
                        $no++;
                    }
                }
            }
            $response['data']['folder'] = $folderFile;
            $response['data']['file'] = $file_array;
            $response['response_code'] = 200;
            $response['status'] = 'success.';
            $response['message'] = 'View Folder File Success.';
            $response['parentIdFolder'] = $parentIdFolder_data;
            return $this->renderJson($response);
        }else{
            $response['data'] = [];
            $response['response_code'] = 404;
            $response['status'] = 'failed.';
            $response['message'] = 'Folder Not Found.';
            $response['parentIdFolder'] = $parentIdFolder_data;
            return $this->renderJson($response);
        }
    }



    public static function encrypt($string)
    {
        $encrypt_method = "AES-256-CBC";

        // Generate iv manually & concat it in the encrypted message
        $iv_len     = openssl_cipher_iv_length($encrypt_method);
        $iv         = openssl_random_pseudo_bytes($iv_len);
        $output     = openssl_encrypt($string, $encrypt_method, _SECRET_KEY, 0, $iv);
        $iv_encoded = base64_encode($iv);

        // Concat encrpyted payload and iv length encoded
        $output_fin = $output.".".$iv_encoded;

        return $output_fin;
    }

    public static function decrypt($string)
    {
        $encrypt_method = "AES-256-CBC";
        
        // Explode & Decode payload
        $payload_arr = explode(".", $string);
        
        // Check if not in the right format then return error 
        if(count($payload_arr) != 2)
            return "009";

        $payload    = $payload_arr[0];
        $iv_encoded = $payload_arr[1];

        // Decode IV length & Start Decrypting
        $iv         = base64_decode($iv_encoded);
        $output     = openssl_decrypt($payload, $encrypt_method, _SECRET_KEY, 0, $iv);


        return $output;
    }
    public static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function sendMail($email,$subject,$body)
    {
        require DOC_ROOT.'/plugins/PHPMailer/PHPMailer.php';
        require DOC_ROOT.'/plugins/PHPMailer/SMTP.php';
        try {
            $start = microtime(true);
            $mail = new \PHPMailer(); // create a new object
            $mail->IsSMTP(); // enable SMTP
            // $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
            $mail->SMTPAuth = true; // authentication enabled
            $mail->SMTPSecure = \PHPMailer::ENCRYPTION_STARTTLS; // secure transfer enabled REQUIRED for Gmail
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 587; // or 587
            $mail->Username = 'scheduller1905@gmail.com';                 // SMTP username
            $mail->Password = 'sealover';                           // SMTP password

            //Recipients
            $mail->setFrom('scheduller1905@gmail.com', 'RadMed - NoReply');
            $mail->addReplyTo('scheduller1905@gmail.com', 'RadMed - NoReply');
            $mail->addAddress($email);

            //Content
            $mail->isHTML(true);// Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $body;

            if ($mail->send()) {
                $messages = 'Message has been sent';
            }else{
                // $messages = 'Email Not Send';
                $messages = 'Email Not Send.'. $mail->ErrorInfo;
            }                                 
        } 
        catch (Exception $e) 
        {
            $messages = 'Config is not valid, Not Send Mail';
        }
        return $messages;
    }

    /**
     * endpoint action
     */
    public function uploadMobile() {

        // validation
        $uploadedFile = $_FILES['upload_file'];
        LogHelper::info('Uploadfiles: ' . json_encode($_GET));
        if (!is_array($uploadedFile)) {
            $response['data'] = [];
            $response['response_code'] = 500;
            $response['status'] = 'failed.';
            $response['message'] = "Did not receive uploaded file.";
            return $this->renderJson($response);
        }

        // check filesize
        if ($uploadedFile['size'] == 0) {
            $response['data'] = [];
            $response['response_code'] = 500;
            $response['status'] = 'failed.';
            $response['message'] = 'Filesize received was zero.'.json_encode($uploadedFile);
            return $this->renderJson($response);
        }

        // check for curl
        if (!function_exists('curl_init')) {
            $response['data'] = [];
            $response['response_code'] = 500;
            $response['status'] = 'failed.';
            $response['message'] = 'PHP Curl module does not exist on your server/web '
                    . 'hosting. It will need to be enable to use this upload feature.';
        }
        
        // load users username for the upload api
        $db = Database::getDatabase();
        if (isset($_GET['rekam_medis']) && $_GET['rekam_medis']!='') {
            $account_id = $db->getValue('SELECT connect_user_id '
                    . 'FROM user_mobile '
                    . 'WHERE rekam_medis = :rekam_medis '
                    . 'LIMIT 1', array(
                        'rekam_medis' => $_GET['rekam_medis'],
                        )
                    );

            $_GET['account_id'] = $account_id ;
        }
        else{
            $response['data'] = [];
            $response['response_code'] = 500;
            $response['status'] = 'failed.';
            $response['message'] = "Parameter Rekam Medis tidak ditemukan.";
            return $this->renderJson($response);
        }
        $username = $db->getValue('SELECT username '
                . 'FROM users '
                . 'WHERE id = :id '
                . 'LIMIT 1', array(
                    'id' => (int) $_GET['account_id'],
                    )
                );
        if (isset($_GET['rekam_medis']) && $_GET['rekam_medis']!='') {
            $folder_id = $db->getValue('SELECT id '
                    . 'FROM file_folder '
                    . 'WHERE folderName = :folderName AND status = "active"'
                    . 'LIMIT 1', array(
                        'folderName' => $_GET['rekam_medis'],
                        )
                    );

            if (!$folder_id) {
                $token = $this->get_token($_GET['account_id']);

                // simulate posting the file using curl
                $url = _CONFIG_SITE_PROTOCOL . "://" ._CONFIG_SITE_HOST_URL . '/api/v2/folder/create';
                $folder_create = [];
                $folder_create['access_token'] = $token;
                $folder_create['account_id'] = $_GET['account_id'];
                $folder_create['folder_name'] = $_GET['rekam_medis'];
                $folder_create['is_public'] = 2;
                LogHelper::info('Curl request to: ' . $url);
                LogHelper::info('Curl params: ' . json_encode($folder_create, true));

                $curl = $this->curl($url,$folder_create);
                if ($curl['_status']!='success') {
                    $response['data'] = [];
                    $response['response_code'] = 500;
                    $response['status'] = 'failed.';
                    $response['message'] = 'Folder tidak dapat dibuat.(1)';

                    LogHelper::error($response['message']);

                    return $this->renderJson($response);
                }else{
                    $check_folder_upload = $db->getValue('SELECT id '
                    . 'FROM file_folder '
                    . 'WHERE folderName = :folderName AND parentId = :parentId AND status = "active"'
                    . 'LIMIT 1', array(
                        'folderName' => "My Uploaded Files",
                        'parentId' => $curl['data']['id'],
                        )
                    );

                    if (!$check_folder_upload) {
                        $token = $this->get_token($_GET['account_id']);

                        // simulate posting the file using curl
                        $url = _CONFIG_SITE_PROTOCOL . "://" ._CONFIG_SITE_HOST_URL . '/api/v2/folder/create';
                        $folder_create = [];
                        $folder_create['access_token'] = $token;
                        $folder_create['account_id'] = $_GET['account_id'];
                        $folder_create['parent_id'] = $curl['data']['id'];
                        $folder_create['folder_name'] = "My Uploaded Files";
                        $folder_create['is_public'] = 2;
                        LogHelper::info('Curl request to: ' . $url);
                        LogHelper::info('Curl params: ' . json_encode($folder_create, true));

                        $curl = $this->curl($url,$folder_create);
                        if ($curl['_status']!='success') {
                            $response['data'] = [];
                            $response['response_code'] = 500;
                            $response['status'] = 'failed.';
                            $response['message'] = 'Folder tidak dapat dibuat.(2)';

                            LogHelper::error($response['message']);

                            return $this->renderJson($response);
                        }else{
                            $_GET['folder_id'] = $curl['data']['id'] ;
                        }
                    }else{
                        $_GET['folder_id'] = $check_folder_upload ;
                    }
                }
            }else{
                $check_folder_upload = $db->getValue('SELECT id '
                . 'FROM file_folder '
                . 'WHERE folderName = :folderName AND parentId = :parentId AND status = "active"'
                . 'LIMIT 1', array(
                    'folderName' => "My Uploaded Files",
                    'parentId' => $folder_id,
                    )
                );

                if (!$check_folder_upload) {
                    $token = $this->get_token($_GET['account_id']);
                    if (isset($curl['data']['id'])) {
                    	$parent_id = $curl['data']['id'];
                    }else{
                    	$parent_id = $folder_id;
                    }
                        // simulate posting the file using curl
                    $url = _CONFIG_SITE_PROTOCOL . "://" ._CONFIG_SITE_HOST_URL . '/api/v2/folder/create';
                    $folder_create = [];
                    $folder_create['access_token'] = $token;
                    $folder_create['account_id'] = $_GET['account_id'];
                    $folder_create['parent_id'] = $parent_id;
                    $folder_create['folder_name'] = "My Uploaded Files";
                    $folder_create['is_public'] = 2;
                    LogHelper::info('Curl request to: ' . $url);
                    LogHelper::info('Curl params: ' . json_encode($folder_create, true));

                    $curl = $this->curl($url,$folder_create);
                    if ($curl['_status']!='success') {
                        $response['data'] = [];
                        $response['response_code'] = 500;
                        $response['status'] = 'failed.';
                        $response['message'] = 'Folder tidak dapat dibuat.(3)';

                        LogHelper::error($response['message']);

                        return $this->renderJson($response);
                    }else{
                        $_GET['folder_id'] = $curl['data']['id'] ;
                    }
                }else{
                    $_GET['folder_id'] = $check_folder_upload ;
                }
            }
        }

        // load api key
        $apiKey = $db->getValue("SELECT apikey "
                . "FROM users "
                . "WHERE id = :id "
                . "LIMIT 1", array(
                    'id' => (int) $_GET['account_id'],
                ));
        if (!$apiKey) {
            // no api key so add it
            $apiKey = MD5(microtime() . (int) $_GET['account_id'] . microtime());
            $db->query('UPDATE users '
                    . 'SET apikey = :apikey '
                    . 'WHERE id = :id '
                    . 'AND username = :username '
                    . 'LIMIT 1', array(
                        'apikey' => $apiKey,
                        'id' => (int) $_GET['account_id'],
                        'username' => $username,
                    ));
        }

        // prepare the params
        $post = array();
        $post['folderId'] = (int) $_GET['folder_id'] == 0 ? -1 : (int) $_GET['folder_id'];
        $post['api_key'] = $apiKey;
        $post['username'] = $username;
        $post['action'] = 'upload';
        if (isset($uploadedFile['tmp_name'])) {
            $post['files'] = curl_file_create($uploadedFile['tmp_name'], null, $uploadedFile['name']);
        }else{
            $post['files'] = curl_file_create($_GET['upload_file'], null, basename($_GET['upload_file']));
        }

        // simulate posting the file using curl
        $url = FileHelper::getUploadUrl() . '/api_upload_handler';
        LogHelper::info('Curl request to: ' . $url);
        LogHelper::info('Curl params: ' . print_r($post, true));

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        //curl_setopt($ch, CURLOPT_HEADER, 1);
        //$headers = array(
        //    'Transfer-Encoding: chunked',
        //);
        //curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        //curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, 'curlProgress');
        curl_setopt($ch, CURLOPT_NOPROGRESS, true);
        //curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        $msg = curl_exec($ch);
        $error = '';

        if (curl_errno($ch)) {
            $error = 'Error uploading file to ' . $url . ': ' . curl_error($ch);
        }
        else {
            // try to read the json response
            if (strlen($msg) == 0) {
                $error = 'Error uploading file. No response received from: ' . $url;
            }
            else {
                $responseArr = json_decode($msg, true);
                if (is_array($responseArr)) {
                    // got data as array
                    if (isset($responseArr[0]['error'])) {
                        $error = 'Error on: ' . $url . '. ' . $responseArr[0]['error'];
                    }
                }
                else {
                    $error = 'Failed reading response from: ' . $url . '. Response: ' . $msg;
                }
            }
        }

        // close curl
        curl_close($ch);

        // error
        if (strlen($error)) {
            // log
            LogHelper::error($error);

            $response['data'] = [];
            $response['response_code'] = 500;
            $response['status'] = 'failed.';
            $response['message'] = $error;
            return $this->renderJson($response);
        }

        $response['data'] = $responseArr;
        $response['response_code'] = 200;
        $response['status'] = 'success.';
        $response['message'] = 'File uploaded';
        return $this->renderJson($response);
    }

    public function get_token($user_id=1)
    {
        
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 128; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        $accessToken = $randomString;

        // delete any existing access tokens for this user
        $db = Database::getDatabase();
        $currentUserId = $user_id;

        $sQL = 'DELETE FROM apiv2_access_token WHERE user_id = :user_id';

        $params = array();
        $params['user_id'] = $currentUserId;
        $rs = $db->query($sQL, $params);

        // add new token
        $rs = $db->query('INSERT INTO apiv2_access_token '
                . '(user_id, access_token, date_added) VALUES '
                . '(:user_id, :access_token, NOW())', array(
                    'user_id' => $currentUserId,
                    'access_token' => $accessToken,
                    )
                );
        if (!$rs) {
            throw new \Exception('Failed issuing access token.');
        }

        return $accessToken;
    }

    public function curl($url,$data=[])
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        if (!empty($data)) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_NOPROGRESS, true);

        $msg = curl_exec($ch);
        $error = [];
        if (curl_errno($ch)) {
            $error['error'] = 'Error uploading file to ' . $url . ': ' . curl_error($ch);
        }
        else {
            // try to read the json response
            if (strlen($msg) == 0) {
                $error['error'] = 'Error uploading file. No response received from: ' . $url;
            }
            else {
                $responseArr = json_decode($msg, true);
                if (is_array($responseArr)) {
                    // got data as array
                    if (isset($responseArr[0]['error'])) {
                        $error['error'] = 'Error on: ' . $url . '. ' . $responseArr[0]['error'];
                    }
                }
                else {
                    $error['error'] = 'Failed reading response from: ' . $url . '. Response: ' . $msg;
                }
            }
        }

        // close curl
        curl_close($ch);
        if (!empty($error)) {
            return json_decode($error,1);
        }else{
            return json_decode($msg,1);
        }
    }

    public function updateFolderOwned($rekam_medis,$userId=999)
    {
        $db = Database::getDatabase();
        $folder_id = [];
        $a = $db->getRows('SELECT id FROM file_folder WHERE folderName = "'.$rekam_medis.'"');
        if (!empty($a)) {
            foreach ($a as $key => $value) {
                $folder_id[] = $value['id'];
                $b = $db->getRows('SELECT id FROM file_folder WHERE parentId = '.$value['id']);

                foreach ($b as $key1 => $value1) {
                    $folder_id[] = $value1['id'];
                    $c = $db->getRows('SELECT id FROM file_folder WHERE parentId = '.$value1['id']);

                    foreach ($c as $key2 => $value2) {
                        $folder_id[] = $value2['id'];
                        $d = $db->getRows('SELECT id FROM file_folder WHERE parentId = '.$value1['id']);

                        foreach ($d as $key3 => $value3) {
                            $folder_id[] = $value3['id'];
                        }
                    }
                }
            }
        }else{
        	try {
        		$token = $this->get_token($userId);

                // simulate posting the file using curl
                $url = _CONFIG_SITE_PROTOCOL . "://" ._CONFIG_SITE_HOST_URL . '/api/v2/folder/create';
                $folder_create = [];
                $folder_create['access_token'] = $token;
                $folder_create['account_id'] = $userId;
                $folder_create['folder_name'] = $rekam_medis;
                $folder_create['is_public'] = 2;

                $curl = $this->curl($url,$folder_create);
        	} catch (Exception $e) {
        		
        	}
        }
        $folder_id = implode(',', $folder_id);
        $sQL  = 'UPDATE file_folder SET userId = ';
        $sQL .= (int) $userId;
        $sQL .= ' WHERE id IN ('.$folder_id.')';
        $db->query($sQL);

        $sQL  = 'UPDATE file SET userId = ';
        $sQL .= (int) $userId;
        $sQL .= ' WHERE folderId IN ('.$folder_id.')';
        $db->query($sQL);

        return 'sukses';
    }


    public function addBookmark() {
        // pickup request
        $request = file_get_contents('php://input');
        $request = json_decode($request);
        $required_item = ['user_id','file_id','rekam_medis'];
        foreach ($required_item as $value) {
            if (!isset($request->$value)) {
                $response['data'] = [];
                $response['response_code'] = 400;
                $response['status'] = 'failed.';
                $response['message'] = 'Validation Error.';
                return $this->renderJson($response);
            }
            if (isset($request->$value) && $request->$value=='') {
                $response['data'] = [];
                $response['response_code'] = 400;
                $response['status'] = 'failed.';
                $response['message'] = 'Validation Error.';
                return $this->renderJson($response);
            }
        }
        $db = Database::getDatabase();
        
        #cek rekam_medis
        $rekam_medis = $db->getRows('SELECT id FROM user_mobile WHERE id = "'.$request->user_id.'" AND  rekam_medis = "'.$request->rekam_medis.'"');
        if (empty($rekam_medis)) {
            $response['response_code'] = 400;
            $response['status'] = 'failed.';
            $response['message'] = 'Rekam Medis and User ID Not Matched.';
        	return $this->renderJson($response);
        }

        $folder_id = [];
        $a = $db->getRows('SELECT user_id,file_id,created_at,id FROM file_bookmark WHERE user_id = "'.$request->user_id.'" AND  file_id = "'.$request->file_id.'"');
        if (!empty($a)) {
            $response['data'] = $a;
            $response['response_code'] = 200;
            $response['status'] = 'success.';
            $response['message'] = 'Add Bookmark Success.';
        	return $this->renderJson($response);
        }

        $response = [];
        $bookmark = FileBookmark::create();
        $bookmark->user_id = $request->user_id ;
        $bookmark->file_id = $request->file_id ;
        $bookmark->created_at = date('Y-m-d H:i:s') ;
        if ($bookmark->save()) {
            $response['data'] = $bookmark;
            $response['response_code'] = 200;
            $response['status'] = 'success.';
            $response['message'] = 'Add Bookmark Success.';
        }else{
            $response['data'] = [];
            $response['response_code'] = 500;
            $response['status'] = 'failed.';
            $response['message'] = 'Add Bookmark Failed.';
        }

        return $this->renderJson($response);
    }

    public function removeBookmark() {
        // pickup request
        $request = file_get_contents('php://input');
        $request = json_decode($request);
        $required_item = ['user_id','file_id','rekam_medis'];
        foreach ($required_item as $value) {
            if (!isset($request->$value)) {
                $response['data'] = [];
                $response['response_code'] = 400;
                $response['status'] = 'failed.';
                $response['message'] = 'Validation Error.';
                return $this->renderJson($response);
            }
            if (isset($request->$value) && $request->$value=='') {
                $response['data'] = [];
                $response['response_code'] = 400;
                $response['status'] = 'failed.';
                $response['message'] = 'Validation Error.';
                return $this->renderJson($response);
            }
        }
        $db = Database::getDatabase();

        #cek rekam_medis
        $rekam_medis = $db->getRows('SELECT id FROM user_mobile WHERE id = "'.$request->user_id.'" AND  rekam_medis = "'.$request->rekam_medis.'"');
        if (empty($rekam_medis)) {
            $response['response_code'] = 400;
            $response['status'] = 'failed.';
            $response['message'] = 'Rekam Medis and User ID Not Matched.';
        	return $this->renderJson($response);
        }
        
        $folder_id = [];
        $sQL  = 'DELETE FROM file_bookmark WHERE user_id = "'.$request->user_id.'" AND  file_id = "'.$request->file_id.'"';
        if ($db->query($sQL)) {
            $response['response_code'] = 200;
            $response['status'] = 'success.';
            $response['message'] = 'Remove Bookmark Success.';
        	return $this->renderJson($response);
        }else{
            $response['response_code'] = 500;
            $response['status'] = 'failed.';
            $response['message'] = 'Remove Bookmark Failed.';
        }

        return $this->renderJson($response);
    }

    public function getFileBookmark() {
        // pickup request
        $request = file_get_contents('php://input');
        $request = json_decode($request);
        $required_item = ['user_id','rekam_medis'];
        foreach ($required_item as $value) {
            if (!isset($request->$value)) {
                $response['data'] = [];
                $response['response_code'] = 400;
                $response['status'] = 'failed.';
                $response['message'] = 'Validation Error.';
                return $this->renderJson($response);
            }
            if (isset($request->$value) && $request->$value=='') {
                $response['data'] = [];
                $response['response_code'] = 400;
                $response['status'] = 'failed.';
                $response['message'] = 'Validation Error.';
                return $this->renderJson($response);
            }
        }
        $db = Database::getDatabase();
        #cek rekam_medis
        $rekam_medis = $db->getRows('SELECT id FROM user_mobile WHERE id = "'.$request->user_id.'" AND  rekam_medis = "'.$request->rekam_medis.'"');
        if (empty($rekam_medis)) {
            $response['response_code'] = 400;
            $response['status'] = 'failed.';
            $response['message'] = 'Rekam Medis and User ID Not Matched.';
        	return $this->renderJson($response);
        }

        $fileidbookmark = '';
        $data = [];
        $filebook = $db->getRows('SELECT GROUP_CONCAT(file_id) as id_file FROM file_bookmark WHERE user_id = "'.$request->user_id.'"');
        if (!empty($filebook)) {
        	foreach ($filebook as $key => $value) {
        		$fileidbookmark = $value['id_file'];
        	}
        }

        $filedata = $db->getRows('SELECT id,originalFilename,shortUrl,fileType,extension,fileSize,status,folderId,keywords FROM file WHERE id IN ('.$fileidbookmark.') AND status = "active"');
        if (!empty($filedata)) {
            $no = 0;
        	foreach ($filedata as $key => $value1) {
                foreach ($value1 as $kunci => $nilai) {
                    $data[$no][$kunci] = $nilai;
                }
                $file = File::loadMore('id', $value1['id']);
                foreach ($file as $k => $v) {
                    $data[$no]['url_file'] = $v->getShortUrlPath();
                	$data[$no]['mobile_url_file'] = $v->getShortUrlPath()."&mobile=true";
                }
                $no++;
        	}
        }

        $response['data'] = $data;
        $response['response_code'] = 200;
        $response['status'] = 'success.';
        $response['message'] = 'Get File Bookmark Success.';
        return $this->renderJson($response);
    }

    public function shareFile() {
        // pickup request
        $request = file_get_contents('php://input');
        $request = json_decode($request);
        $required_item = ['user_id','rekam_medis','file_id','email_tujuan'];
        foreach ($required_item as $value) {
            if (!isset($request->$value)) {
                $response['data'] = [];
                $response['response_code'] = 400;
                $response['status'] = 'failed.';
                $response['message'] = 'Validation Error.';
                return $this->renderJson($response);
            }
            if (isset($request->$value) && $request->$value=='') {
                $response['data'] = [];
                $response['response_code'] = 400;
                $response['status'] = 'failed.';
                $response['message'] = 'Validation Error.';
                return $this->renderJson($response);
            }
        }
        $db = Database::getDatabase();
        #cek rekam_medis

        $nama = $value['nama'];
        $email = $value['email'];
        $rekam_medis = $db->getRows('SELECT id,email,nama FROM user_mobile WHERE id = "'.$request->user_id.'" AND  rekam_medis = "'.$request->rekam_medis.'"');
        if (empty($rekam_medis)) {
            $response['response_code'] = 400;
            $response['status'] = 'failed.';
            $response['message'] = 'Rekam Medis and User ID Not Matched.';
            return $this->renderJson($response);
        }else{
            foreach ($rekam_medis as $key => $value) {
                $nama = $value['nama'];
                $email = $value['email'];
            }
        }

        $url_file = '';

        $filedata = $db->getRows('SELECT id FROM file WHERE id = "'.$request->file_id.'" AND status = "active"');
        if (!empty($filedata)) {
            $no = 0;
            foreach ($filedata as $key => $value1) {
                $file = File::loadMore('id', $value1['id']);
                foreach ($file as $k => $v) {
                    $url_file = $v->getShortUrlPath();
                }
                $no++;
            }
        }else{
            $response['response_code'] = 400;
            $response['status'] = 'failed.';
            $response['message'] = 'File ID Not Found.';
            return $this->renderJson($response);
        }

        if ($url_file!='') {
            $htmlMsg = '<p><img src="https://image.radmed.co.id/themes/evolution/assets/images/logo/logo.png" alt="" /></p>
                        <h4>Halo [[NAMA]],</h4>
                        <p>Kami dari radmed.co.id mengabarkan bahwa user kami dengan email : [[EMAIL_USER]] dan nama : [[NAMA_USER]] , telah membagikan file radmed kepada anda.</p>
                        <p>Berikut Link menuju file :</p>
                        <p>LINK : <a href="[[LINK]]" target="_blank"> Klik Disini </a></p>
                        <br>
                        <div style="background:#80808033">RADIOLOGY DEPARTEMENT, BRAWIJAYA HOSPITAL SAHARJO Jl. Dr. Saharjo No.199, RW.1, Tebet Bar., Kec. Tebet, Kota Jakarta Selatan, DKI Jakarta 12870 021- 3973-7890 0821-2221-1389 (Whats App Text Only)<br /><br />Tolong jangan balas email ini. Ini dibuat secara otomatis oleh sistem&nbsp;<span class="il">RadMED</span>&nbsp;sehingga alamat pengirim tidak dipantau untuk email. Silakan kirimkan permintaan melalui kami&nbsp;<a href="https://radmed.co.id/" target="_blank" rel="noopener" data-saferedirecturl="https://www.google.com/url?q=http://radmed.web.id&amp;source=gmail&amp;ust=1619508855780000&amp;usg=AFQjCNEHtdgdEDE6qobbJkHlNNHcLfjOIA">website</a>&nbsp;jika Anda memiliki pertanyaan.<br /><br />Pesan dikirim dari <a href="http://radmed.co.id/" target="_blank" rel="noopener" data-saferedirecturl="https://www.google.com/url?q=https://radmed.web.id&amp;source=gmail&amp;ust=1619508855780000&amp;usg=AFQjCNEHtdgdEDE6qobbJkHlNNHcLfjOIA"><span class="il">RadMED</span></a>&nbsp;on 12/03/2021 07:11:20</div>';
            $htmlMsg = str_replace('[[NAMA]]',$request->email_tujuan , $htmlMsg);
            $htmlMsg = str_replace('[[EMAIL_USER]]', $email , $htmlMsg);
            $htmlMsg = str_replace('[[NAMA_USER]]', $nama , $htmlMsg);
            $htmlMsg = str_replace('[[LINK]]', $url_file , $htmlMsg);

            $message = self::sendMail($request->email_tujuan, "Sharing File - RadMed", $htmlMsg);
            if ($message!='Message has been sent') {
                $response['response_code'] = 500;
                $response['status'] = 'failed.';
                $response['message'] = $message;
                return $this->renderJson($response);
            }
        }

        $response['response_code'] = 200;
        $response['status'] = 'success.';
        $response['message'] = 'Share email Success.';
        return $this->renderJson($response);
    }

    public function folderUpload() {
        // pickup request
        $request = file_get_contents('php://input');
        $request = json_decode($request);
        $db = Database::getDatabase();
        $required_item = ['rekam_medis'];
        $parentIdFolder_data = '';
        foreach ($required_item as $value) {
            if (!isset($request->$value)) {
                $response['data'] = [];
                $response['response_code'] = 400;
                $response['status'] = 'failed.';
                $response['message'] = 'Validation Error.';
                return $this->renderJson($response);
            }
            if (isset($request->$value) && $request->$value=='') {
                $response['data'] = [];
                $response['response_code'] = 400;
                $response['status'] = 'failed.';
                $response['message'] = 'Validation Error.';
                return $this->renderJson($response);
            }
        }
        $idFolderUpload = '';
        $folderName = '';
        $file_array = [];
        $cek_rekam_medis = FileFolder::loadOne1('folderName', $request->rekam_medis);
        if (isset($request->folder_id) && $request->folder_id != '') {
            $cek_rekam_medis = FileFolder::loadOne1('id', $request->folder_id);
        }
        if ($cek_rekam_medis) {
            $parentIdFolder = $cek_rekam_medis->id;
            $cek_folder = FileFolder::loadMore('parentId', $parentIdFolder);
            foreach ($cek_folder as $kunci => $nilai) {
                if ($nilai->folderName=='My Uploaded Files') {
                    $idFolderUpload = $nilai->id;
                    $folderName = $nilai->folderName;
                }
            }
            $array_key = ['id', 'originalFilename', 'shortUrl', 'fileType', 'extension', 'fileSize', 'status', 'folderId', 'keywords'];
            $file = File::loadMore('folderId', $idFolderUpload);
            if ($file) {
                $no = 0;
                foreach ($file as $key1 => $value1) {
                    if ($value1->status=='active') {
                        foreach ($value1 as $kunci => $nilai) {
                            if (in_array($kunci, $array_key)) {
                                $file_array[$no][$kunci] = $nilai;
                            }
                        }
                        $file_array[$no]['url_file'] = $value1->getShortUrlPath();
                    }
                    $no++;
                }
            }
            $response['data']['folderName'] = $folderName;
            $response['data']['file'] = $file_array;
            $response['response_code'] = 200;
            $response['status'] = 'success.';
            $response['message'] = 'View Folder Uploaded Success.';
            return $this->renderJson($response);
        }else{
            $response['data'] = [];
            $response['response_code'] = 404;
            $response['status'] = 'failed.';
            $response['message'] = 'Folder Not Found.';
            return $this->renderJson($response);
        }
    }
}
