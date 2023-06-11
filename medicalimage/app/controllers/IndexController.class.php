<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Core\Database;
use App\Models\File;
use App\Models\FileFolder;
use App\Models\User;
use App\Helpers\AuthHelper;
use App\Helpers\CoreHelper;
use App\Helpers\InternalNotificationHelper;
use App\Helpers\NotificationHelper;
use App\Helpers\PluginHelper;
use App\Helpers\ThemeHelper;
use App\Helpers\TranslateHelper;
use App\Helpers\UserHelper;
use App\Helpers\ValidationHelper;

class IndexController extends BaseController
{
    public function index() {
        // can be overridden at theme level
    }
    
    public function register() {
        // make sure user registration is enabled
        if (SITE_CONFIG_ENABLE_USER_REGISTRATION === 'no') {
            $this->redirect(ThemeHelper::getLoadedInstance()->getAccountWebRoot());
        }

        // get params for later
        $Auth = $this->getAuth();

        // if user already logged in revert to account home
        if ($Auth->loggedIn()) {
            return $this->redirect(CoreHelper::getCoreSitePath());
        }

        // pickup request for later
        $request = $this->getRequest();

        // register user
        $title = '';
        $firstname = '';
        $lastname = '';
        $emailAddress = '';
        $emailAddressConfirm = '';
        $username = '';
        if ($request->request->has('submitme')) {
            // validation
            $title = trim($request->request->get('title'));
            $firstname = trim($request->request->get('firstname'));
            $lastname = trim($request->request->get('lastname'));
            $emailAddress = trim(strtolower($request->request->get('emailAddress')));
            $emailAddressConfirm = trim(strtolower($request->request->get('emailAddressConfirm')));
            $username = trim(strtolower($request->request->get('username')));

            if (!strlen($title)) {
                NotificationHelper::setError(TranslateHelper::t("please_enter_your_title", "Please enter your title"));
            }
            elseif (!strlen($firstname)) {
                NotificationHelper::setError(TranslateHelper::t("please_enter_your_firstname", "Please enter your firstname"));
            }
            elseif (!strlen($lastname)) {
                NotificationHelper::setError(TranslateHelper::t("please_enter_your_lastname", "Please enter your lastname"));
            }
            elseif (!strlen($emailAddress)) {
                NotificationHelper::setError(TranslateHelper::t("please_enter_your_email_address", "Please enter your email address"));
            }
            elseif ($emailAddress != $emailAddressConfirm) {
                NotificationHelper::setError(TranslateHelper::t("your_email_address_confirmation_does_not_match", "Your email address confirmation does not match"));
            }
            elseif (!ValidationHelper::validEmail($emailAddress)) {
                NotificationHelper::setError(TranslateHelper::t("your_email_address_is_invalid", "Your email address is invalid"));
            }
            elseif (!strlen($username)) {
                NotificationHelper::setError(TranslateHelper::t("please_enter_your_preferred_username", "Please enter your preferred username"));
            }
            elseif ((strlen($username) < SITE_CONFIG_USERNAME_MIN_LENGTH) || (strlen($username) > SITE_CONFIG_USERNAME_MAX_LENGTH)) {
                NotificationHelper::setError(TranslateHelper::t("username_must_be_between_min_and_max_characters", "Your username must be between [[[MIN]]] and [[[MAX]]] characters", array(
                    'MIN' => SITE_CONFIG_USERNAME_MIN_LENGTH,
                    'MAX' => SITE_CONFIG_USERNAME_MAX_LENGTH,
                )));
            }
            elseif (!ValidationHelper::validUsername($username)) {
                NotificationHelper::setError(TranslateHelper::t("your_username_is_invalid", "Your username can only contact alpha numeric and underscores."));
            }
            else {
                $checkEmail = User::loadOneByClause('email = :email', array('email' => $emailAddress));
                if ($checkEmail) {
                    // username exists
                    NotificationHelper::setError(TranslateHelper::t("email_address_already_exists", "Email address already exists on another account"));
                }
                else {
                    $checkUser = User::loadOneByClause('username = :username', array('username' => $username));
                    if ($checkUser) {
                        // username exists
                        NotificationHelper::setError(TranslateHelper::t("username_already_exists", "Username already exists on another account"));
                    }
                }
            }

            // make sure the username is not reserved
            if (!NotificationHelper::isErrors()) {
                if (strlen(SITE_CONFIG_RESERVED_USERNAMES)) {
                    $reservedUsernames = explode("|", SITE_CONFIG_RESERVED_USERNAMES);
                    if (in_array($username, $reservedUsernames)) {
                        // username is reserved
                        NotificationHelper::setError(TranslateHelper::t("username_is_reserved", "Username is reserved and can not be used, please choose another"));
                    }
                }
            }

            // make sure the email domain isn't banned
            if (!NotificationHelper::isErrors()) {
                if (strlen(SITE_CONFIG_SECURITY_BLOCK_REGISTER_EMAIL_DOMAIN)) {
                    $blockedEmailDomains = explode(",", SITE_CONFIG_SECURITY_BLOCK_REGISTER_EMAIL_DOMAIN);
                    $emailDomain = strtolower(end(explode('@', $emailAddress)));
                    if (in_array($emailDomain, $blockedEmailDomains)) {
                        // email domain is not allowed
                        NotificationHelper::setError(TranslateHelper::t("email_address_not_allowed", "Registration from email addresses on [[[EMAIL_DOMAIN]]] have been blocked on this site.", array('EMAIL_DOMAIN' => $emailDomain)));
                    }
                }
            }

            // check captcha
            if ((!NotificationHelper::isErrors()) && (SITE_CONFIG_REGISTER_FORM_SHOW_CAPTCHA == 'yes')) {
                $rs = CoreHelper::captchaCheck();
                if (!$rs) {
                    NotificationHelper::setError(TranslateHelper::t("invalid_captcha", "Captcha confirmation text is invalid."));
                }
            }

            // create the account
            if (!NotificationHelper::isErrors()) {
                $newPassword = UserHelper::generatePassword();
                $newUser = UserHelper::create($username, $newPassword, $emailAddress, $title, $firstname, $lastname);
                if ($newUser) {
                    $subject = TranslateHelper::t('register_user_email_subject', 'Account details for [[[SITE_NAME]]]', array('SITE_NAME' => SITE_CONFIG_SITE_NAME));

                    $replacements = array(
                        'FIRST_NAME' => $firstname,
                        'SITE_NAME' => SITE_CONFIG_SITE_NAME,
                        'WEB_ROOT' => ThemeHelper::getLoadedInstance()->getAccountWebRoot(),
                        'USERNAME' => $username,
                        'PASSWORD' => $newPassword
                    );
                    $defaultContent = "Dear [[[FIRST_NAME]]],<br/><br/>";
                    $defaultContent .= "Your account on [[[SITE_NAME]]] has been created. Use the details below to login to your new account:<br/><br/>";
                    $defaultContent .= "<strong>Url:</strong> <a href='[[[WEB_ROOT]]]'>[[[WEB_ROOT]]]</a><br/>";
                    $defaultContent .= "<strong>Username:</strong> [[[USERNAME]]]<br/>";
                    $defaultContent .= "<strong>Password:</strong> [[[PASSWORD]]]<br/><br/>";
                    $defaultContent .= "Feel free to contact us if you need any support with your account.<br/><br/>";
                    $defaultContent .= "Regards,<br/>";
                    $defaultContent .= "[[[SITE_NAME]]] Admin";
                    $htmlMsg = TranslateHelper::t('register_user_email_content', $defaultContent, $replacements);

                    $emailsend = CoreHelper::sendHtmlEmail($emailAddress, $subject, $htmlMsg, SITE_CONFIG_DEFAULT_EMAIL_ADDRESS_FROM, strip_tags(str_replace("<br/>", "\n", $htmlMsg)));

                    // create account welcome notification
                    $content = TranslateHelper::t('register_account_notification_text', 'Thanks for registering and welcome to your account! Start uploading files straight away by clicking the \'Upload\' button below. Feel free to contact us if you need any help.');
                    $link = WEB_ROOT . '/index';
                    InternalNotificationHelper::add($newUser->id, $content, 'entypo-thumbs-up', $link);

                    // confirmation page
                    return $this->redirect(WEB_ROOT . '/register_complete');
                }
                else {
                    NotificationHelper::setError(TranslateHelper::t("problem_creating_your_account_try_again_later", "There was a problem creating your account, please try again later"));
                }
            }
        }
        // load template
        return $this->render('register.html', array(
                    'title' => $title,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'emailAddress' => $emailAddress,
                    'emailAddressConfirm' => $emailAddressConfirm,
                    'username' => $username,
                    'Auth' => AuthHelper::getAuth(),
        ));
    }
    
    public function registerComplete() {
        // make sure user registration is enabled
        if (SITE_CONFIG_ENABLE_USER_REGISTRATION === 'no') {
            $this->redirect(ThemeHelper::getLoadedInstance()->getAccountWebRoot());
        }

        // get params for later
        $Auth = $this->getAuth();

        // if user already logged in revert to account home
        if ($Auth->loggedIn()) {
            return $this->redirect(CoreHelper::getCoreSitePath());
        }

        // load template
        return $this->render('register_complete.html');
    }
    
    public function terms() {
        // load template
        return $this->render('terms.html');
    }
    
    public function privacy() {
        // load template
        return $this->render('privacy.html');
    }
    
    public function error() {
        // pickup request for later
        $request = $this->getRequest();
        
        // make safe the error message
        if($request->query->has('e')) {
            $errorMsg = $request->query->get('e');
            $errorMsg = urldecode($errorMsg);
            $errorMsg = strip_tags($errorMsg);
            $errorMsg = str_replace(array('"', '\'', ';'), '', $errorMsg);
        }
        else {
            $errorMsg = TranslateHelper::t("general_site_error", "There has been an error, please try again later.");
        }

        // load template
        return $this->render('error.html', array(
            'error_msg' => $errorMsg,
        ));
    }

    public function setLanguage() {
        // get database connection
        $db = Database::getDatabase();

        // pick up any requests to change the site language
        if (isset($_REQUEST['_t'])) {
            // make sure the one passed is an active language
            $isValidLanguage = $db->getRow("SELECT languageName, flag "
                    . "FROM language "
                    . "WHERE isActive = 1 AND languageName = '" . $db->escape(trim($_REQUEST['_t'])) . "' "
                    . "LIMIT 1");
            if ($isValidLanguage) {
                $_SESSION['_t'] = trim($_REQUEST['_t']);
            }
            else {
                $_SESSION['_t'] = SITE_CONFIG_SITE_LANGUAGE;
            }
            PluginHelper::reloadSessionPluginConfig();
        }
        elseif (!isset($_SESSION['_t'])) {
            $_SESSION['_t'] = SITE_CONFIG_SITE_LANGUAGE;
        }

        // redirect to index page
        return $this->redirect(WEB_ROOT);
    }

    public function jsTranslations() {
        // create missing translations for javascript
        TranslateHelper::t('selected_file', 'selected file');

        // output js translations
        header('Content-Type: application/javascript');
        echo TranslateHelper::generateJSLanguageCode();
        exit;
    }

    public function folderPasswordProcess() {
        // pickup request for later
        $request = $this->getRequest();

        // validation
        $folderId = (int) $request->request->get('folderId');
        $folderPassword = trim($request->request->get('folderPassword'));

        // load folder
        $fileFolder = FileFolder::loadOneById($folderId);
        if (!$fileFolder) {
            NotificationHelper::setError(TranslateHelper::t("problem_loading_folder", "There was a problem loading the folder, please try again later."));
        }
        // check password
        if (!NotificationHelper::isErrors()) {
            if (isset($_SESSION['mobile']) && $_SESSION['mobile']==true) {
                if (!isset($_SESSION['folderPassword'])) {
                    $_SESSION['folderPassword'] = array();
                }
                $_SESSION['folderPassword'][$fileFolder->id] = $fileFolder->accessPassword;
            }else{
                if (md5($folderPassword) == $fileFolder->accessPassword) {
                    // successful
                    if (!isset($_SESSION['folderPassword'])) {
                        $_SESSION['folderPassword'] = array();
                    }
                    $_SESSION['folderPassword'][$fileFolder->id] = $fileFolder->accessPassword;
                }
                else {
                    NotificationHelper::setError(TranslateHelper::t("folder_password_is_invalid", "The folder password is invalid"));
                }
            }
        }

        // prepare result
        $returnJson = array();
        $returnJson['success'] = false;
        $returnJson['msg'] = TranslateHelper::t("problem_updating_folder", "There was a problem accessing the folder, please try again later.");
        if (NotificationHelper::isErrors()) {
            // error
            $returnJson['success'] = false;
            $returnJson['msg'] = implode('<br/>', NotificationHelper::getErrors());
        }
        else {
            // success
            $returnJson['success'] = true;
            $returnJson['msg'] = implode('<br/>', NotificationHelper::getSuccess());
        }

        // output response
        return $this->renderJson($returnJson);
    }
    
    public function downForMaintenance() {
        // ignore maintenance mode to avoid continuous loops
        define('IGNORE_MAINTENANCE_MODE', true);

        // load template
        return $this->render('down_for_maintenance.html');
    }
}
