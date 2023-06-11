<?php

namespace App\Controllers;

use App\Models\File;
use App\Models\User;
use App\Helpers\AuthHelper;
use App\Helpers\BannedIpHelper;
use App\Helpers\CoreHelper;
use App\Helpers\PluginHelper;
use App\Helpers\UserHelper;
use App\Helpers\ThemeHelper;
use App\Helpers\TranslateHelper;
use App\Services\Password;

class AccountSecurityController extends AccountController
{

    public function login() {
        // call plugin hooks, for redirect types
        if(is_object($rs = PluginHelper::callHook('preLogin'))) {
            return $rs;
        }
        
        // get params for later
        $Auth = $this->getAuth();

        // if user already logged in revert to account home
        if ($Auth->loggedIn()) {
            return $this->redirect(CoreHelper::getCoreSitePath());
        }

        // demo values
        $username = $password = '';
        if (CoreHelper::inDemoMode() === true) {
            $username = 'admin';
            $password = 'Password@Demo';
        }

        // load template
        return $this->render('account/login.html', array(
                    'username' => $username,
                    'password' => $password,
                    'Auth' => AuthHelper::getAuth(),
                    'HookLoginLoginBoxHtml' => PluginHelper::outputHook('loginLoginBox'),
        ));
    }

    public function logout() {
        // get params for later
        $Auth = $this->getAuth();

        // logout the user
        $Auth->logout();

        // redirect to the login page
        return $this->redirect(CoreHelper::getCoreSitePath());
    }

    public function ajaxLogin() {
        // get params for later
        $Auth = $this->getAuth();

        // setup result array
        $rs = array();

        // do login
        $request = $this->getRequest();
        $loginUsername = $request->request->get('username');
        $loginPassword = $request->request->get('password');
        $loginStatus = 'invalid';
        $rs['error'] = '';

        // clear any expired IPs
        BannedIpHelper::clearExpiredBannedIps();

        // check user isn't banned from logging in
        $bannedIp = BannedIpHelper::getBannedIPData(CoreHelper::getUsersIPAddress());
        if ($bannedIp) {
            if ($bannedIp->banType === 'Login') {
                $rs['error'] = TranslateHelper::t("login_ip_banned", "You have been temporarily blocked from logging in due to too many failed login attempts. Please try again [[[EXPIRY_TIME]]].", array('EXPIRY_TIME' => ($bannedIp->banExpiry != null ? CoreHelper::formatDate($bannedIp->banExpiry) : TranslateHelper::t('later', 'later'))));
            }
        }

        // initial validation
        if (strlen($rs['error']) == 0) {
            if (!strlen($loginUsername)) {
                // log failure
                AuthHelper::logFailedLoginAttempt(CoreHelper::getUsersIPAddress(), $loginUsername);

                $rs['error'] = TranslateHelper::t("please_enter_your_username", "Please enter your username");
            }
            elseif (!strlen($loginPassword)) {
                // log failure
                AuthHelper::logFailedLoginAttempt(CoreHelper::getUsersIPAddress(), $loginUsername);

                $rs['error'] = TranslateHelper::t("please_enter_your_password", "Please enter your password");
            }
        }

        // check for openssl, required for login
        if (strlen($rs['error']) == 0) {
            if (!extension_loaded('openssl')) {
                $rs['error'] = TranslateHelper::t("openssl_not_found", "OpenSSL functions not found within PHP, please ask support to install and try again.");
            }
        }

        // check captcha
        if ((strlen($rs['error']) == 0) && (SITE_CONFIG_CAPTCHA_LOGIN_SCREEN_NORMAL == 'yes')) {
            $resp = CoreHelper::captchaCheck();
            if ($resp == false) {
                $rs['error'] = TranslateHelper::t("invalid_captcha", "Captcha confirmation text is invalid.");
            }
        }

        $redirectUrl = '';
        if (strlen($rs['error']) == 0) {
            $loginResult = $Auth->login($loginUsername, $loginPassword, true);
            if ($loginResult) {
                // if we know the file
                if ($request->request->has('loginShortUrl')) {
                    // download file
                    $file = File::loadOneByShortUrl($request->request->get('loginShortUrl'));
                    if ($file) {
                        $redirectUrl = $file->getFullShortUrl();
                    }
                }
                else {
                    // successful login
                    $redirectUrl = CoreHelper::getCoreSitePath() . '/index';
                }

                $loginStatus = 'success';
            }
            else {
                // login failed
                $rs['error'] = TranslateHelper::t("username_and_password_is_invalid", "Your username and password are invalid");
            }
        }

        $rs['login_status'] = $loginStatus;

        // login success
        if ($rs['login_status'] == 'success') {
            // Set the redirect url after successful login
            $rs['redirect_url'] = $redirectUrl;
        }

        return $this->renderJson($rs);
    }

    public function forgotPassword() {
        // get params for later
        $Auth = $this->getAuth();

        // if user already logged in revert to account home
        if ($Auth->loggedIn()) {
            return $this->redirect(CoreHelper::getCoreSitePath());
        }

        // load template
        return $this->render('account/forgot_password.html');
    }

    public function ajaxForgotPassword() {
        // get request
        $request = $this->getRequest();

        // setup result array
        $rs = array();
        $rs['error'] = '';
        $rs['forgot_password_status'] = 'success';

        // clear any expired IPs
        BannedIpHelper::clearExpiredBannedIps();

        // do login
        $emailAddress = trim($request->request->get('emailAddress'));

        // initial validation
        if (strlen($rs['error']) === 0) {
            if (!strlen($emailAddress)) {
                // log failure
                $rs['error'] = TranslateHelper::t("please_enter_your_email_address", "Please enter the account email address");
                $rs['forgot_password_status'] = 'invalid';
            }
        }

        if (strlen($rs['error']) === 0) {
            $checkEmail = User::loadOne('email', $emailAddress);
            if (!$checkEmail) {
                // username exists
                $rs['error'] = TranslateHelper::t("account_not_found", "Account with that email address not found");
                $rs['forgot_password_status'] = 'invalid';
            }
        }

        // reset password
        if (strlen($rs['error']) === 0) {
            $userAccount = User::loadOne('email', $emailAddress);
            if ($userAccount) {
                // create password reset hash
                $resetHash = UserHelper::createPasswordResetHash($userAccount->id);

                $subject = TranslateHelper::t('forgot_password_email_subject', 'Password reset instructions for account on [[[SITE_NAME]]]', array('SITE_NAME' => SITE_CONFIG_SITE_NAME));

                $replacements = array(
                    'FIRST_NAME' => $userAccount->firstname,
                    'SITE_NAME' => SITE_CONFIG_SITE_NAME,
                    'WEB_ROOT' => ThemeHelper::getLoadedInstance()->getAccountWebRoot(),
                    'USERNAME' => $username,
                    'ACCOUNT_ID' => $userAccount->id,
                    'RESET_HASH' => $resetHash
                );
                $defaultContent = "Dear [[[FIRST_NAME]]],<br/><br/>";
                $defaultContent .= "We've received a request to reset your password on [[[SITE_NAME]]] for account [[[USERNAME]]]. Follow the url below to set a new account password:<br/><br/>";
                $defaultContent .= "<a href='[[[WEB_ROOT]]]/forgot_password_reset?u=[[[ACCOUNT_ID]]]&h=[[[RESET_HASH]]]'>[[[WEB_ROOT]]]/forgot_password_reset?u=[[[ACCOUNT_ID]]]&h=[[[RESET_HASH]]]</a><br/><br/>";
                $defaultContent .= "If you didn't request a password reset, just ignore this email and your existing password will continue to work.<br/><br/>";
                $defaultContent .= "Regards,<br/>";
                $defaultContent .= "[[[SITE_NAME]]] Admin";
                $htmlMsg = TranslateHelper::t('forgot_password_email_content_v5', $defaultContent, $replacements);

                CoreHelper::sendHtmlEmail($emailAddress, $subject, $htmlMsg, SITE_CONFIG_DEFAULT_EMAIL_ADDRESS_FROM, strip_tags(str_replace("<br/>", "\n", $htmlMsg)));
                $rs['redirect_url'] = ThemeHelper::getLoadedInstance()->getAccountWebRoot() . "/forgot_password_confirm";
            }
        }

        return $this->renderJson($rs);
    }

    public function forgotPasswordConfirm() {
        // load template
        return $this->render('account/forgot_password_confirm.html');
    }

    public function forgotPasswordReset() {
        // get params for later
        $Auth = $this->getAuth();

        // if user already logged in revert to account home
        if ($Auth->loggedIn()) {
            return $this->redirect(CoreHelper::getCoreSitePath());
        }

        // get request
        $request = $this->getRequest();

        // check for pending hash
        $userId = (int) $request->query->get('u');
        $passwordHash = $request->query->get('h');
        $user = UserHelper::loadUserByPasswordResetHash($passwordHash);
        if (!$user) {
            return $this->redirect(ThemeHelper::getLoadedInstance()->getAccountWebRoot());
        }

        // check user id passed is valid
        if ($user->id != $userId) {
            return $this->redirect(ThemeHelper::getLoadedInstance()->getAccountWebRoot());
        }

        // load template
        return $this->render('account/forgot_password_reset.html', array(
                    'userId' => $userId,
                    'passwordHash' => $passwordHash,
        ));
    }

    public function ajaxForgotPasswordReset() {
        // get request
        $request = $this->getRequest();

        // setup result array
        $rs = array();
        $rs['error'] = '';
        $rs['forgot_password_status'] = 'success';

        // validation
        $userId = (int) $request->request->get('u');
        $passwordHash = $request->request->get('h');
        $user = UserHelper::loadUserByPasswordResetHash($passwordHash);
        if (!$user) {
            $rs['error'] = TranslateHelper::t("account_details_not_found", "Account with them details not found");
            $rs['forgot_password_status'] = 'invalid';

            // render
            return $this->renderJson($rs);
        }

        // make sure it matches our userId
        if ((int) $user->id !== $userId) {
            $rs['error'] = TranslateHelper::t("account_details_not_found", "Account with them details not found");
            $rs['forgot_password_status'] = 'invalid';

            // render
            return $this->renderJson($rs);
        }

        // validate the submitted password
        $password = $request->request->get('password');
        $confirmPassword = $request->request->get('confirmPassword');
        if (!strlen($password)) {
            $rs['error'] = TranslateHelper::t("please_enter_your_password", "Please enter your new password");
            $rs['forgot_password_status'] = 'invalid';
        }
        elseif ($password != $confirmPassword) {
            $rs['error'] = TranslateHelper::t("password_confirmation_does_not_match", "Your password confirmation does not match");
            $rs['forgot_password_status'] = 'invalid';
        }
        else {
            $passValid = UserHelper::validatePassword($password);
            if (is_array($passValid)) {
                $rs['error'] = implode('<br/>', $passValid);
                $rs['forgot_password_status'] = 'invalid';
            }
        }

        // create the account
        if (strlen($rs['error']) === 0) {
            // load user and update password
            $user = User::loadOneById($userId);
            $user->passwordResetHash = '';
            $user->password = Password::createHash($password);
            $user->save();

            // success
            $rs['redirect_url'] = ThemeHelper::getLoadedInstance()->getAccountWebRoot() . "/login?s=1";
        }

        // render
        return $this->renderJson($rs);
    }
}
