<?php

namespace App\Controllers\admin;

use App\Controllers\admin\AdminBaseController;
use App\Core\Database;
use App\Models\BackgroundTask;
use App\Models\BannedIp;
use App\Models\DownloadPage;
use App\Models\Language;
use App\Models\LanguageContent;
use App\Models\UserLevel;
use App\Models\UserLevelPricing;
use App\Helpers\AdminHelper;
use App\Helpers\AuthHelper;
use App\Helpers\BannedIpHelper;
use App\Helpers\CacheHelper;
use App\Helpers\CoreHelper;
use App\Helpers\LogHelper;
use App\Helpers\PluginHelper;
use App\Helpers\ThemeHelper;
use App\Helpers\TranslateHelper;
use App\Helpers\ValidationHelper;
use App\Services\Backup;
use App\Services\GoogleTranslate;

class SiteConfigurationController extends AdminBaseController
{

    public function settingManage() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();

        // handle page submission
        if ($request->request->has('submitted')) {
            if (_CONFIG_DEMO_MODE == true) {
                AdminHelper::setError(AdminHelper::t("no_changes_in_demo_mode"));
            }
            else {
                if ($request->request->has('config_item')) {
                    $configItems = $request->request->get('config_item');
                    if (COUNT($configItems)) {
                        // update config items
                        foreach ($configItems AS $configKey => $configValue) {
                            if (is_array($configValue)) {
                                $configValue = implode('|', $configValue);
                            }
                            $db->query('UPDATE site_config '
                                    . 'SET config_value = :config_value '
                                    . 'WHERE config_key = :config_key', array(
                                'config_value' => $configValue,
                                'config_key' => $configKey,
                                    )
                            );
                        }

                        AdminHelper::setSuccess("Configuration updated.");
                    }
                }
            }
        }

        // defaults
        $filterByGroup = null;
        if ($request->query->has('filterByGroup')) {
            $filterByGroup = trim($request->query->get('filterByGroup'));
        }

        // load config groups for edit settings
        $sQL = "SELECT config_group "
                . "FROM site_config "
                . "WHERE config_group != 'System' ";
        if ($filterByGroup != null) {
            $sQL .= "AND config_group = " . $db->quote($filterByGroup) . " ";
        }
        $sQL .= "GROUP BY config_group "
                . "ORDER BY config_group";
        $groupDetails = $db->getRows($sQL);

        // for the drop-down select
        $groupListing = $db->getRows("SELECT config_group "
                . "FROM site_config "
                . "WHERE config_group != 'System' "
                . "GROUP BY config_group "
                . "ORDER BY config_group");

        // load editable config items for the current group
        $configItemElements = array();
        foreach ($groupDetails AS $groupDetail) {
            // load config items
            $configItems = $db->getRows("SELECT * "
                    . "FROM site_config "
                    . "WHERE config_group = :config_group "
                    . "ORDER BY display_order ASC, "
                    . "config_description ASC", array(
                'config_group' => $groupDetail['config_group'],
                    )
            );

            if (count($configItems)) {
                $configItemElements[$groupDetail{'config_group'}] = array();
                foreach ($configItems AS $config) {
                    // prep key for title text
                    $titleText = 'SITE_CONFIG_' . strtoupper($config['config_key']);

                    $colSize = 6;
                    switch ($config['config_type']) {
                        case 'integer':
                            $elementHtml = '<input name="config_item[' . AdminHelper::makeSafe($config['config_key']) . ']" type="text" value="' . AdminHelper::makeSafe($config['config_value']) . '" class="form-control" title="' . $titleText . '"/>';
                            $colSize = 3;
                            break;
                        case 'select':
                        case 'multiselect':
                            $selectItems = array();
                            $availableValues = $config['availableValues'];
                            if (substr($availableValues, 0, 6) == 'SELECT') {
                                $items = $db->getRows($availableValues);
                                if ($items) {
                                    foreach ($items AS $item) {
                                        $selectItems[] = $item['itemValue'];
                                    }
                                }
                            }
                            else {
                                $selectItems = json_decode($availableValues, true);
                                if (COUNT($selectItems) == 0) {
                                    $selectItems = array('Error: Failed loading options');
                                }
                            }

                            $selectedValues = explode("|", $config['config_value']);

                            $elementHtml = '<select name="config_item[' . AdminHelper::makeSafe($config['config_key']) . ']';
                            if ($config['config_type'] == 'multiselect') {
                                $elementHtml .= '[]';
                            }
                            $elementHtml .= '" class="form-control"';
                            if ($config['config_type'] == 'multiselect') {
                                $elementHtml .= ' MULTIPLE';
                            }
                            $elementHtml .= ' title="' . $titleText . '">';
                            foreach ($selectItems AS $selectItem) {
                                $elementHtml .= '<option value="' . AdminHelper::makeSafe($selectItem) . '"';
                                if (in_array($selectItem, $selectedValues)) {
                                    $elementHtml .= ' SELECTED';
                                }
                                $elementHtml .= '>' . AdminHelper::makeSafe($selectItem) . '</option>';
                            }
                            $elementHtml .= '</select>';
                            $colSize = 3;
                            break;
                        case 'string':
                            $type = 'text';
                            if ((strpos($config['config_key'], 'secret') !== false) || (strpos($config['config_key'], 'password') !== false)) {
                                $type = 'password';
                            }
                            $elementHtml = '<input name="config_item[' . AdminHelper::makeSafe($config['config_key']) . ']" type="' . $type . '" value="' . AdminHelper::makeSafe($config['config_value']) . '" class="form-control" title="' . $titleText . '"/>';
                            break;
                        case 'textarea':
                        default:
                            $elementHtml = '<textarea name="config_item[' . AdminHelper::makeSafe($config['config_key']) . ']" class="form-control" title="' . $titleText . '" style="min-height: 80px;">' . AdminHelper::makeSafe($config['config_value']) . '</textarea>';
                            break;
                    }

                    $description = $config['config_description'];
                    $description = str_replace('[[[WEB_ROOT]]]', WEB_ROOT, $description);

                    $configItemElements[$groupDetail{'config_group'}][] = array(
                        'label' => $config['label'],
                        'elementHtml' => $elementHtml,
                        'colSize' => $colSize,
                        'description' => $description,
                    );
                }
            }
        }

        // load template
        return $this->render('admin/setting_manage.html', array_merge(array(
                    'Auth' => AuthHelper::getAuth(),
                    'groupListing' => $groupListing,
                    'groupDetails' => $groupDetails,
                    'filterByGroup' => $filterByGroup,
                    'configItemElements' => $configItemElements,
                                ), $this->getHeaderParams()));
    }

    public function bannedIpManage() {
        // admin restrictions
        $this->restrictAdminAccess();

        // clear any expired IPs
        BannedIpHelper::clearExpiredBannedIps();

        // load template
        return $this->render('admin/banned_ip_manage.html', array_merge(array(
                    'Auth' => AuthHelper::getAuth(),
                                ), $this->getHeaderParams()));
    }

    public function ajaxBannerIpManage() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();

        $iDisplayLength = (int) $request->query->get('iDisplayLength');
        $iDisplayStart = (int) $request->query->get('iDisplayStart');
        $sSortDir_0 = ($request->query->has('sSortDir_0') && $request->query->get('sSortDir_0') === 'asc') ? 'asc' : 'desc';
        $filterText = $request->query->has('filterText') ? $request->query->get('filterText') : null;

        // get sorting columns
        $iSortCol_0 = (int) $request->query->get('iSortCol_0');
        $sColumns = trim($request->query->get('sColumns'));
        $arrCols = explode(",", $sColumns);
        $sortColumnName = $arrCols[$iSortCol_0];
        $sort = 'ipAddress';
        switch ($sortColumnName) {
            case 'ip_address':
                $sort = 'ipAddress';
                break;
            case 'date_banned':
                $sort = 'dateBanned';
                break;
            case 'ban_type':
                $sort = 'banType';
                break;
            case 'ban_expiry':
                $sort = 'banExpiry';
                break;
            case 'ban_notes':
                $sort = 'banNotes';
                break;
        }

        $sqlClause = "WHERE 1=1 ";
        if ($filterText) {
            $filterText = $db->escape($filterText);
            $sqlClause .= "AND (ipAddress LIKE '%" . $filterText . "%' OR ";
            $sqlClause .= "banType LIKE '%" . $filterText . "%' OR ";
            $sqlClause .= "banNotes LIKE '%" . $filterText . "%')";
        }

        $totalRS = $db->getValue("SELECT COUNT(id) AS total "
                . "FROM banned_ip " . $sqlClause);
        $limitedRS = $db->getRows("SELECT * "
                . "FROM banned_ip " . $sqlClause . " "
                . "ORDER BY " . $sort . " " . $db->escape($sSortDir_0) . " "
                . "LIMIT " . $iDisplayStart . ", " . $iDisplayLength);

        $data = array();
        if (COUNT($limitedRS) > 0) {
            foreach ($limitedRS AS $row) {
                $lRow = array();
                $icon = CORE_ASSETS_ADMIN_WEB_ROOT . '/images/icons/system/16x16/block.png';
                $lRow[] = '<img src="' . $icon . '" width="16" height="16" title="banned ip" alt="banned ip"/>';
                $lRow[] = AdminHelper::makeSafe($row['ipAddress']);
                $lRow[] = AdminHelper::makeSafe(CoreHelper::formatDate($row['dateBanned'], SITE_CONFIG_DATE_FORMAT));
                $lRow[] = AdminHelper::makeSafe($row['banType']);
                $lRow[] = (strlen($row['banExpiry']) ? (CoreHelper::formatDate($row['banExpiry'])) : '-');
                $banNotes = $row['banNotes'];
                $lRow[] = AdminHelper::makeSafe($banNotes);

                $links = array();
                $links[] = '<a class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="remove ban" href="#" onClick="deleteBannedIp(' . (int) $row['id'] . '); return false;"><span class="fa fa-trash text-danger" aria-hidden="true"></span></a>';
                $linkStr = '<div class="btn-group">' . implode(" ", $links) . '</div>';
                $lRow[] = $linkStr;

                $data[] = $lRow;
            }
        }

        $resultArr = array();
        $resultArr["sEcho"] = intval($_GET['sEcho']);
        $resultArr["iTotalRecords"] = (int) $totalRS;
        $resultArr["iTotalDisplayRecords"] = $resultArr["iTotalRecords"];
        $resultArr["aaData"] = $data;

        // output response
        return $this->renderJson($resultArr);
    }

    public function ajaxBannedIpManageAddForm() {
        // admin restrictions
        $this->restrictAdminAccess();

        // prep minutes
        $minutes = array();
        for ($i = 0; $i < 60; $i++) {
            $minutes[] = str_pad($i, 2, '0', STR_PAD_LEFT);
        }

        // prep hours
        $hours = array();
        for ($i = 0; $i < 24; $i++) {
            $hours[] = str_pad($i, 2, '0', STR_PAD_LEFT);
        }

        // prepare result
        $result = array();
        $result['error'] = false;
        $result['msg'] = '';
        $result['html'] = $this->getRenderedTemplate('admin/ajax/banned_ip_manage_add_form.html', array(
            'hours' => $hours,
            'minutes' => $minutes,
        ));

        // output response
        return $this->renderJson($result);
    }

    public function ajaxBannedIpManageAddProcess() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $request = $this->getRequest();
        $ipAddress = trim($request->request->get('ip_address'));
        $banType = $request->request->get('ban_type');
        $banNotes = trim($request->request->get('ban_notes'));
        $banExpiryDate = trim($request->request->get('ban_expiry_date'));
        $banExpiryHour = trim($request->request->get('ban_expiry_hour'));
        $banExpiryMinute = trim($request->request->get('ban_expiry_minute'));

        // prepare result
        $result = array();
        $result['error'] = false;
        $result['msg'] = '';

        if (strlen($ipAddress) == 0) {
            $result['error'] = true;
            $result['msg'] = AdminHelper::t("enter_the_ip_address", "Please enter the IP address.");
        }
        elseif (!ValidationHelper::validIPAddress($ipAddress)) {
            $result['error'] = true;
            $result['msg'] = AdminHelper::t("ip_address_invalid_try_again", "The format of the IP you've entered is invalid, please try again.");
        }
        elseif (_CONFIG_DEMO_MODE == true) {
            $result['error'] = true;
            $result['msg'] = AdminHelper::t("no_changes_in_demo_mode");
        }

        // check expiry date if set
        $banExpiry = null;
        if ($result['error'] == false) {
            if (strlen($banExpiryDate)) {
                $compiledDate = $banExpiryDate . ' ' . $banExpiryHour . ':' . $banExpiryMinute . ':00';
                $d = \DateTime::createFromFormat('d/m/Y H:i:s', $compiledDate);
                if ((!$d) || ($d->format('d/m/Y H:i:s') != $compiledDate)) {
                    $result['error'] = true;
                    $result['msg'] = AdminHelper::t("banned_ip_expiry_date_invalid", "The expiry date is invalid.");
                }

                if ($result['error'] == false) {
                    // check it's not before today
                    if ($d->format('Y-m-d H:i:s') <= date('Y-m-d H:i:s')) {
                        $result['error'] = true;
                        $result['msg'] = AdminHelper::t("banned_ip_expiry_date_is_in_the_past", "The expiry date is in the past.");
                    }
                }

                if ($result['error'] == false) {
                    $banExpiry = $d->format('Y-m-d H:i:s');
                }
            }
        }

        if ($result['error'] == false) {
            $bannedIp = BannedIp::loadOneByClause('ipAddress = :ipAddress', array(
                        'ipAddress' => $ipAddress,
            ));
            if ($bannedIp) {
                $result['error'] = true;
                $result['msg'] = AdminHelper::t("ip_address_already_blocked", "The IP address you've entered is already blocked.");
            }
        }

        if ($result['error'] == false) {
            // add the banned IP
            $bannedIp = BannedIp::create();
            $bannedIp->ipAddress = $ipAddress;
            $bannedIp->banType = $banType;
            $bannedIp->banNotes = $banNotes;
            $bannedIp->dateBanned = CoreHelper::sqlDateTime();
            $bannedIp->banExpiry = $banExpiry;
            if (!$bannedIp->save()) {
                $result['error'] = true;
                $result['msg'] = AdminHelper::t("error_problem_record", "There was a problem banning the IP address, please try again.");
            }
            else {
                $result['error'] = false;
                $result['msg'] = 'IP address ' . $ipAddress . ' has been banned.';
            }
        }

        // output response
        return $this->renderJson($result);
    }

    public function ajaxBannedIpManageRemove() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $request = $this->getRequest();
        $bannedIpId = (int) $request->request->get('bannedIpId');

        // prepare result
        $result = array();
        $result['error'] = false;
        $result['msg'] = '';

        if (_CONFIG_DEMO_MODE == true) {
            $result['error'] = true;
            $result['msg'] = AdminHelper::t("no_changes_in_demo_mode");
        }
        else {
            // load banned ip
            $bannedIp = BannedIp::loadOneById($bannedIpId);

            // delete the entry
            if ($bannedIp) {
                $bannedIp->delete();
            }

            $result['error'] = false;
            $result['msg'] = 'IP address removed from banned list.';
        }

        // output response
        return $this->renderJson($result);
    }

    public function translationManage() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $request = $this->getRequest();

        // action rebuild request
        if ($request->query->has('rebuild')) {
            $rs = TranslateHelper::rebuildTranslationsFromCode();
            if ($rs) {
                AdminHelper::setSuccess('Scan complete. Total found: ' . $rs['foundTotal'] . '. Total added: ' . $rs['addedTotal']);
            }
        }

        // load template
        return $this->render('admin/translation_manage.html', array_merge(array(
                    'Auth' => AuthHelper::getAuth(),
                                ), $this->getHeaderParams()));
    }

    public function ajaxTranslationManage() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();

        // load site default language
        $defaultLanguageRow = $db->getRow("SELECT * "
                . "FROM site_config "
                . "WHERE config_key = 'site_language' "
                . "LIMIT 1");
        $defaultLanguage = '';
        if ($defaultLanguageRow) {
            $defaultLanguage = $defaultLanguageRow['config_value'];
        }

        $iDisplayLength = (int) $request->query->get('iDisplayLength');
        $iDisplayStart = (int) $request->query->get('iDisplayStart');
        $sSortDir_0 = ($request->query->has('sSortDir_0') && $request->query->get('sSortDir_0') === 'asc') ? 'asc' : 'desc';
        $filterText = $request->query->has('filterText') ? $request->query->get('filterText') : null;

        // get sorting columns
        $iSortCol_0 = (int) $request->query->get('iSortCol_0');
        $sColumns = trim($request->query->get('sColumns'));
        $arrCols = explode(",", $sColumns);
        $sortColumnName = $arrCols[$iSortCol_0];
        $sort = 'languageName';
        switch ($sortColumnName) {
            case 'language':
                $sort = 'languageName';
                break;
        }

        $sqlClause = "WHERE 1=1 ";
        if ($filterText) {
            $filterText = $db->escape($filterText);
            $sqlClause .= "AND (languageName LIKE '%" . $filterText . "%')";
        }

        $totalRS = $db->getValue("SELECT COUNT(id) AS total "
                . "FROM language " . $sqlClause);
        $limitedRS = $db->getRows("SELECT * "
                . "FROM language " . $sqlClause . " "
                . "ORDER BY " . $sort . " " . $db->escape($sSortDir_0) . " "
                . "LIMIT " . $iDisplayStart . ", " . $iDisplayLength);


        $data = array();
        if (COUNT($limitedRS) > 0) {
            foreach ($limitedRS AS $row) {
                $lRow = array();
                $icon = CORE_ASSETS_ADMIN_WEB_ROOT . '/images/icons/flags/' . $row['flag'] . '.png';
                $lRow[] = '<img src="' . $icon . '" width="16" height="11" title="' . AdminHelper::makeSafe($row['languageName']) . '" alt="' . AdminHelper::makeSafe($row['languageName']) . '"/>';
                $lRow[] = AdminHelper::makeSafe($row['languageName']);

                $image = 'delete';
                $title = 'Click to set as the site default language.';
                $style = ' style="cursor:pointer;" onClick="setDefault(\'' . AdminHelper::makeSafe($row['languageName']) . '\'); return false;"';
                if ($defaultLanguage == $row['languageName']) {
                    $image = 'accept';
                    $title = 'Is the site default language.';
                    $style = '';
                }
                $lRow[] = '<img src="' . CORE_ASSETS_ADMIN_WEB_ROOT . '/images/icons/system/16x16/' . $image . '.png" width="16" height="16" title="' . $title . '" alt="' . $title . '" ' . $style . '/>';

                $image = 'delete';
                $title = 'Click to set the language available on the site in the language selector.';
                $style = ' style="cursor:pointer;" onClick="setAvailableState(' . AdminHelper::makeSafe($row['id']) . ', 1); return false;"';
                if (($defaultLanguage == $row['languageName'])) {
                    $image = 'accept';
                    $title = 'Available.';
                    $style = '';
                }
                elseif ($row['isActive'] == 1) {
                    $image = 'accept';
                    $title = 'Click to make this language unavailable from the site.';
                    $style = ' style="cursor:pointer;" onClick="setAvailableState(' . AdminHelper::makeSafe($row['id']) . ', 0); return false;"';
                }
                $lRow[] = '<img src="' . CORE_ASSETS_ADMIN_WEB_ROOT . '/images/icons/system/16x16/' . $image . '.png" width="16" height="16" title="' . $title . '" alt="' . $title . '" ' . $style . '/>';

                // text direction
                $lRow[] = AdminHelper::makeSafe($row['direction']);

                $links = array();
                $links[] = '<a href="translation_manage_text?languageId=' . (int) $row['id'] . '">manage translations</a>';
                if ($row['isLocked'] != 1) {
                    $links[] = '<a href="#" onClick="editLanguageForm(' . (int) $row['id'] . '); return false;">edit</a>';
                    $links[] = '<a href="#" onClick="deleteLanguage(' . (int) $row['id'] . '); return false;">delete</a>';
                }
                $lRow[] = implode(" | ", $links);

                $data[] = $lRow;
            }
        }

        $resultArr = array();
        $resultArr["sEcho"] = intval($_GET['sEcho']);
        $resultArr["iTotalRecords"] = (int) $totalRS;
        $resultArr["iTotalDisplayRecords"] = $resultArr["iTotalRecords"];
        $resultArr["aaData"] = $data;

        // output response
        return $this->renderJson($resultArr);
    }

    public function translationManageText() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();

        // redirect if we don't know the languageId
        if (!$request->query->has('languageId')) {
            return $this->redirect('translation_manage');
        }

        // try to load the language
        $languageDetail = Language::loadOneById((int) $_REQUEST['languageId']);
        if (!$languageDetail) {
            return $this->redirect('translation_manage');
        }

        // delete text item
        if (isset($_REQUEST['d'])) {
            $textItemId = (int) $_REQUEST['d'];
            $db->query('DELETE FROM language_content '
                    . 'WHERE languageKeyId = ' . $textItemId);
            $db->query('DELETE FROM language_key '
                    . 'WHERE id = ' . $textItemId . ' '
                    . 'LIMIT 1');
            AdminHelper::setSuccess('Translation removed.');
        }

        // error/success messages
        if (isset($_REQUEST['sa'])) {
            AdminHelper::setSuccess('Translations successully imported.');
        }

        // action rebuild request
        if ($request->query->has('rebuild')) {
            $rs = TranslateHelper::rebuildTranslationsFromCode();
            if ($rs) {
                AdminHelper::setSuccess('Scan complete. Total found: ' . $rs['foundTotal'] . '. Total added: ' . $rs['addedTotal']);
            }
        }

        // load template
        return $this->render('admin/translation_manage_text.html', array_merge(array(
                    'languageDetail' => $languageDetail,
                                ), $this->getHeaderParams()));
    }

    public function ajaxTranslationManageText() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();
        $languageId = (int) $request->query->get('languageId');

        // try to load the language
        $languageDetail = Language::loadOneById((int) $_REQUEST['languageId']);
        if (!$languageDetail) {
            return $this->render404();
        }

        // make sure we have all content records populated
        $getMissingRows = $db->getRows("SELECT id, languageKey, defaultContent "
                . "FROM language_key "
                . "WHERE id NOT IN (SELECT languageKeyId FROM language_content WHERE languageId = " . (int) $languageDetail->id . ")");
        if (COUNT($getMissingRows)) {
            foreach ($getMissingRows AS $getMissingRow) {
                $languageContent = LanguageContent::create();
                $languageContent->languageKeyId = $getMissingRow['id'];
                $languageContent->languageId = (int) $languageDetail->id;
                $languageContent->content = $getMissingRow['defaultContent'];
                $languageContent->save();
            }
        }

        $iDisplayLength = (int) $request->query->get('iDisplayLength');
        $iDisplayStart = (int) $request->query->get('iDisplayStart');
        $sSortDir_0 = ($request->query->has('sSortDir_0') && $request->query->get('sSortDir_0') === 'asc') ? 'asc' : 'desc';
        $filterText = $request->query->has('filterText') ? $request->query->get('filterText') : null;

        // get sorting columns
        $iSortCol_0 = (int) $request->query->get('iSortCol_0');
        $sColumns = trim($request->query->get('sColumns'));
        $arrCols = explode(",", $sColumns);
        $sortColumnName = $arrCols[$iSortCol_0];
        $sort = 'config_group';
        switch ($sortColumnName) {
            case 'language_key':
                $sort = 'language_key.languageKey';
                break;
            case 'english_content':
                $sort = 'language_key.defaultContent';
                break;
            case 'translated_content':
                $sort = 'language_content.content';
                break;
        }

        $sqlClause = "WHERE language_content.languageId = " . (int) $languageDetail->id;
        if ($filterText) {
            $filterText = $db->escape($filterText);
            $sqlClause .= " AND (language_content.content LIKE '%" . $filterText . "%' OR ";
            $sqlClause .= "language_key.languageKey LIKE '%" . $filterText . "%' OR ";
            $sqlClause .= "language_key.defaultContent LIKE '%" . $filterText . "%')";
        }

        $totalRS = $db->getValue("SELECT COUNT(language_content.id) AS total "
                . "FROM language_content "
                . "LEFT JOIN language_key ON language_content.languageKeyId = language_key.id " . $sqlClause);
        $limitedRS = $db->getRows("SELECT language_content.id, language_content.content, "
                . "language_key.languageKey, language_key.id AS languageKeyId, "
                . "language_key.defaultContent, language_content.is_locked "
                . "FROM language_content LEFT JOIN language_key ON language_content.languageKeyId = language_key.id " . $sqlClause . " "
                . "ORDER BY " . $sort . " " . $db->escape($sSortDir_0) . " "
                . "LIMIT " . $iDisplayStart . ", " . $iDisplayLength);

        $data = array();
        if (COUNT($limitedRS) > 0) {
            foreach ($limitedRS AS $row) {
                $lRow = array();
                $icon = CORE_ASSETS_ADMIN_WEB_ROOT . '/images/icons/flags/' . $languageDetail->flag . '.png';
                $lRow[] = '<img src="' . $icon . '" width="16" height="11" title="configuration" alt="configuration"/>';
                $lRow[] = AdminHelper::makeSafe($row['languageKey']);

                $defaultContent = $row['defaultContent'];
                if (strlen($defaultContent) > 200) {
                    $defaultContent = substr($defaultContent, 0, 200) . ' ...';
                }
                $lRow[] = nl2br(AdminHelper::makeSafe($defaultContent));

                $content = $row['content'];
                if (strlen($content) > 200) {
                    $content = substr($content, 0, 200) . ' ...';
                }
                $lRow[] = nl2br(AdminHelper::makeSafe($content));

                $image = 'unlock';
                $title = 'Translation is not locked. It will be updated if you run the auto-translate via tool. You can still manually edit the content.';
                $style = ' style="cursor:pointer;" onClick="toggleLock(\'' . AdminHelper::makeSafe($row['id']) . '\'); return false;"';
                if ((int) $row['is_locked'] === 1) {
                    $image = 'lock';
                    $title = 'Translation is locked. It will not be updated on an automatic translation import. You can still manually edit the content.';
                    $style = ' style="cursor:pointer;" onClick="toggleLock(\'' . AdminHelper::makeSafe($row['id']) . '\'); return false;"';
                }
                $lRow[] = '<img src="' . CORE_ASSETS_ADMIN_WEB_ROOT . '/images/icons/system/16x16/' . $image . '.png" width="16" height="16" title="' . $title . '" alt="' . $title . '" ' . $style . '/>';

                $links = array();
                $links[] = '<a class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="edit" href="#" onClick="editTranslationForm(' . (int) $row['id'] . '); return false;"><span class="fa fa-pencil" aria-hidden="true"></span></a>';
                $links[] = '<a class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="remove" href="#" onClick="deleteTranslation(' . (int) $row['languageKeyId'] . '); return false;"><span class="fa fa-trash text-danger" aria-hidden="true"></a>';
                $lRow[] = '<div class="btn-group">' . implode(" ", $links) . '</div>';

                $data[] = $lRow;
            }
        }

        $resultArr = array();
        $resultArr["sEcho"] = intval($_GET['sEcho']);
        $resultArr["iTotalRecords"] = (int) $totalRS;
        $resultArr["iTotalDisplayRecords"] = $resultArr["iTotalRecords"];
        $resultArr["aaData"] = $data;

        // output response
        return $this->renderJson($resultArr);
    }

    public function ajaxTranslationManageTextSetIsLocked() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();
        $contentId = (int) $request->request->get('contentId');

        if (_CONFIG_DEMO_MODE == true) {
            $result['error'] = true;
            $result['msg'] = AdminHelper::t("no_changes_in_demo_mode");
        }
        else {
            $languageContent = LanguageContent::loadOneById($contentId);
            $currentState = (int) $languageContent->is_locked;
            $newState = 1;
            if ($currentState == 1) {
                $newState = 0;
            }

            // update state
            $languageContent->is_locked = $newState;
            $languageContent->save();

            $result['error'] = false;
            $result['msg'] = 'Content locked state updated.';
        }

        // output response
        return $this->renderJson($result);
    }

    public function ajaxTranslationManageRemove() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();
        $languageId = (int) $request->request->get('languageId');

        // prepare result
        $result = array();
        $result['error'] = false;
        $result['msg'] = '';

        if (_CONFIG_DEMO_MODE == true) {
            $result['error'] = true;
            $result['msg'] = AdminHelper::t("no_changes_in_demo_mode");
        }
        else {
            $db->query('DELETE FROM language_content '
                    . 'WHERE languageId = :languageId', array(
                'languageId' => $languageId,
                    )
            );
            $db->query('DELETE FROM language '
                    . 'WHERE id = :languageId', array(
                'languageId' => $languageId,
                    )
            );
            if ($db->affectedRows() == 1) {
                $result['error'] = false;
                $result['msg'] = 'Language successfully removed.';
            }
            else {
                $result['error'] = true;
                $result['msg'] = 'Could not remove the language, please try again later.';
            }
        }
        // output response
        return $this->renderJson($result);
    }

    public function ajaxTranslationManageAddForm() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();
        $languageId = (int) $request->request->get('languageId');

        // defaults
        $translation_name = '';
        $translation_flag = '';
        $direction = 'LTR';
        $language_code = '';

        // is this an edit?
        if ($languageId) {
            $language = Language::loadOneById($languageId);
            if ($language) {
                $translation_name = $language->languageName;
                $translation_flag = $language->flag;
                $direction = $language->direction;
                $language_code = $language->language_code;
            }
        }

        // load all flag icons
        $flags = AdminHelper::getDirectoryList(CORE_ASSETS_ADMIN_DIRECTORY_ROOT . '/images/icons/flags/', 'png');
        sort($flags);

        // load all language codes
        $languageCodes = GoogleTranslate::getAvailableLanguages();

        // prepare result
        $result = array();
        $result['error'] = false;
        $result['msg'] = '';
        $result['html'] = $this->getRenderedTemplate('admin/ajax/translation_manage_add_form.html', array(
            'translation_name' => $translation_name,
            'translation_flag' => $translation_flag,
            'direction' => $direction,
            'language_code' => $language_code,
            'languageCodes' => $languageCodes,
            'flags' => $flags,
        ));

        // output response
        return $this->renderJson($result);
    }

    public function ajaxTranslationManageAddProcess() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();
        $translation_name = trim($request->request->get('translation_name'));
        $translation_flag = trim($request->request->get('translation_flag'));
        $language_code = trim($request->request->get('language_code'));
        $translation_flag = str_replace(array(".png", ".jpg", ".gif"), "", $translation_flag);
        if ($request->request->has('languageId')) {
            $languageId = (int) $request->request->get('languageId');
        }
        $direction = trim($request->request->get('direction'));

        // prepare result
        $result = array();
        $result['error'] = false;
        $result['msg'] = '';

        if (strlen($ipAddress) == 0) {
            $result['error'] = true;
            $result['msg'] = AdminHelper::t("enter_the_ip_address", "Please enter the IP address.");
        }
        elseif (!ValidationHelper::validIPAddress($ipAddress)) {
            $result['error'] = true;
            $result['msg'] = AdminHelper::t("ip_address_invalid_try_again", "The format of the IP you've entered is invalid, please try again.");
        }
        elseif (_CONFIG_DEMO_MODE == true) {
            $result['error'] = true;
            $result['msg'] = AdminHelper::t("no_changes_in_demo_mode");
        }

        if (strlen($translation_name) == 0) {
            $result['error'] = true;
            $result['msg'] = AdminHelper::t("enter_the_language_name", "Please enter the language name.");
        }
        elseif (strlen($language_code) == 0) {
            $result['error'] = true;
            $result['msg'] = AdminHelper::t("select_the_language_code", "Please select the language code.");
        }
        elseif (_CONFIG_DEMO_MODE == true) {
            $result['error'] = true;
            $result['msg'] = AdminHelper::t("no_changes_in_demo_mode");
        }
        else {
            if ($languageId) {
                $row = $db->getRow('SELECT id '
                        . 'FROM language '
                        . 'WHERE languageName = :languageName '
                        . 'AND id != :id', array(
                    'languageName' => $translation_name,
                    'id' => $languageId,
                ));
            }
            else {
                $row = $db->getRow('SELECT id '
                        . 'FROM language '
                        . 'WHERE languageName = :languageName', array(
                    'languageName' => $translation_name,
                ));
            }
            if (is_array($row)) {
                $result['error'] = true;
                $result['msg'] = AdminHelper::t("language_already_exists", "A language with that name already exists in the database.");
            }
            else {
                if ($languageId) {
                    // update edit language
                    $language = Language::loadOneById($languageId);
                    $language->languageName = $translation_name;
                    $language->flag = $translation_flag;
                    $language->direction = $direction;
                    $language->language_code = $language_code;
                    $language->save();

                    $result['error'] = false;
                    $result['msg'] = 'Language \'' . $translation_name . '\' has been updated.';
                }
                else {
                    // add the new language
                    $language = Language::create();
                    $language->languageName = $translation_name;
                    $language->isLocked = 0;
                    $language->flag = $translation_flag;
                    $language->direction = $direction;
                    $language->language_code = $language_code;
                    if (!$language->save()) {
                        $result['error'] = true;
                        $result['msg'] = AdminHelper::t("error_problem_language_record", "There was a problem adding the language, please try again.");
                    }
                    else {
                        // make sure we have all content records populated
                        $getMissingRows = $db->getRows("SELECT id, languageKey, defaultContent "
                                . "FROM language_key "
                                . "WHERE id NOT IN (SELECT languageKeyId FROM language_content WHERE languageId = " . (int) $rs . ")");
                        if (COUNT($getMissingRows)) {
                            foreach ($getMissingRows AS $getMissingRow) {
                                $languageContent = LanguageContent::create();
                                $languageContent->languageKeyId = $getMissingRow['id'];
                                $languageContent->languageId = (int) $rs;
                                $languageContent->content = $getMissingRow['defaultContent'];
                                $languageContent->save();
                            }
                        }

                        $result['error'] = false;
                        $result['msg'] = 'Language \'' . $translation_name . '\' has been added.';
                    }
                }
            }
        }

        // output response
        return $this->renderJson($result);
    }

    public function ajaxTranslationManageSetAvailableState() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();
        $languageId = (int) $request->request->get('languageId');
        $state = (int) $request->request->get('state');

        if (_CONFIG_DEMO_MODE == true) {
            $result['error'] = true;
            $result['msg'] = AdminHelper::t("no_changes_in_demo_mode");
        }
        else {
            // update language
            $language = Language::loadOneById($languageId);
            $language->isActive = $state;
            $language->save();

            // response
            $result['error'] = false;
            $result['msg'] = 'Language set as ' . ($state == 1 ? 'active' : 'disabled') . '.';
        }

        // output response
        return $this->renderJson($result);
    }

    public function ajaxTranslationManageSetDefaultLanguage() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();
        $defaultLanguage = $request->request->get('defaultLanguage');

        if (_CONFIG_DEMO_MODE == true) {
            $result['error'] = true;
            $result['msg'] = AdminHelper::t("no_changes_in_demo_mode");
        }
        else {
            // update global config
            $db->query('UPDATE site_config '
                    . 'SET config_value = :defaultLanguage '
                    . 'WHERE config_key = \'site_language\' '
                    . 'LIMIT 1', array(
                'defaultLanguage' => $defaultLanguage,
                    )
            );

            // update language
            $language = Language::loadOneByClause('languageName = :languageName', array(
                        'languageName' => $defaultLanguage,
            ));
            $language->isActive = 1;
            $language->save();

            // response
            $result['error'] = false;
            $result['msg'] = '\'' . $defaultLanguage . '\' set as the default language.';
        }

        // output response
        return $this->renderJson($result);
    }

    public function ajaxTranslationManageTextEditForm() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();
        $gTranslationId = (int) $request->request->get('gTranslationId');

        // load existing translation
        $translation = $db->getRow("SELECT language_content.id, language_content.content, "
                . "language_key.languageKey, language_key.defaultContent, language.language_code "
                . "FROM language_content "
                . "LEFT JOIN language_key ON language_content.languageKeyId = language_key.id "
                . "LEFT JOIN language ON language_content.languageId = language.id "
                . "WHERE language_content.id = " . (int) $gTranslationId);
        if (!$translation) {
            $result['error'] = false;
            $result['msg'] = 'There was a problem loading the translation for editing, please try again later.';

            // output response
            return $this->renderJson($result);
        }

        // prepare result
        $result = array();
        $result['error'] = false;
        $result['msg'] = '';
        $result['html'] = $this->getRenderedTemplate('admin/ajax/translation_manage_text_edit_form.html', array(
            'gTranslationId' => $gTranslationId,
            'translation' => $translation,
        ));

        // output response
        return $this->renderJson($result);
    }

    public function ajaxTranslationManageTextEditProcess() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();
        $translated_content = trim($request->request->get('translated_content'));
        $translation_item_id = (int) $request->request->get('translation_item_id');

        // prepare result
        $result = array();
        $result['error'] = false;
        $result['msg'] = '';

        if (_CONFIG_DEMO_MODE == true) {
            $result['error'] = true;
            $result['msg'] = AdminHelper::t("no_changes_in_demo_mode");
        }
        else {
            // update translation and also make sure it's locked so language imports don't overwrite it
            $languageContent = LanguageContent::loadOneById($translation_item_id);
            $languageContent->content = $translated_content;
            $languageContent->save();

            // response
            $result['error'] = false;
            $result['msg'] = 'Translation updated.';
        }

        // output response
        return $this->renderJson($result);
    }

    public function ajaxTranslationManageTextAutoProcess() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();
        $enText = trim($request->request->get('enText'));
        $toLangCode = trim($request->request->get('toLangCode'));

        // prepare result
        $result = array();
        $result['error'] = false;
        $result['msg'] = '';

        if (_CONFIG_DEMO_MODE == true) {
            $result['error'] = true;
            $result['msg'] = AdminHelper::t("no_changes_in_demo_mode");
        }
        else {
            $googleTranslate = new GoogleTranslate($toLangCode);
            $translation = $googleTranslate->translate($enText);
            if ($translation != false) {
                $result['error'] = false;
                $result['msg'] = 'Text successfully translated.';
                $result['translation'] = $translation;
            }
            else {
                $result['error'] = true;
                $result['msg'] = $googleTranslate->getError();
            }
        }

        // output response
        return $this->renderJson($result);
    }
    
    /**
     * Download all files as zip - generates the zip file.
     * 
     * Note: This function doesn't use the normal $response / twig template method
     * that other functions use. At some stage this will be rewritten to use Twig.
     * 
     * @param integer $folderId
     */
    public function ajaxTranslationManageTextAutoConvert($languageId) {
        // admin restrictions
        $this->restrictAdminAccess();

        // get params for later
        $db = Database::getDatabase();
        $Auth = $this->getAuth();

        // allow some time to run
        set_time_limit(60 * 60 * 4);

        // output styles - @TODO - replace with Twig
        echo "<style>
        body {
            font-family: helvetica neue,Helvetica,noto sans,sans-serif,Arial,sans-serif;
            font-size: 12px;
            line-height: 1.42857143;
            color: #949494;
            background-color: #fff;
            margin: 0px;
        }
        a {
            text-decoration: none;
        }
        .btn {
            display: inline-block;
            margin-bottom: 0;
            font-weight: 400;
            text-align: center;
            vertical-align: middle;
            cursor: pointer;
            background-image: none;
            border: 1px solid transparent;
            white-space: nowrap;
            padding: 6px 12px;
            font-size: 12px;
            line-height: 1.42857143;
            border-radius: 3px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            -o-user-select: none;
            user-select: none;
        }
        .btn-info {
            color: #fff;
            background-color: #21a9e1;
            border-color: #21a9e1;
        }
        </style>";

        // output progress
        echo '<p>Getting English content in preparation for automatic translation...</p>';

        $languageItem = $db->getRow("SELECT languageName, language_code "
                . "FROM language "
                . "WHERE id = :id "
                . "LIMIT 1", array(
                    'id' => $languageId,
                ));
        $languageData = $db->getRows("SELECT language_content.id, language_content.is_locked, "
                . "language_content.content, language_key.languageKey, "
                . "language_key.id AS languageKeyId, language_key.defaultContent "
                . "FROM language_content "
                . "LEFT JOIN language_key ON language_content.languageKeyId = language_key.id "
                . "LEFT JOIN language ON language_content.languageId = language.id "
                . "WHERE language.id = :id "
                . "AND language_content.is_locked = 0 "
                . "ORDER BY languageKey", array(
                    'id' => $languageId,
                ));
        if (!$languageData)
        {
            echo '<p>Could not load language content.</p>';
        }
        else
        {
            // start output buffering
            CoreHelper::flushOutput();

            // 1KB of initial data, required by Webkit browsers
            echo "<span style='display: none;'>" . str_repeat("0", 1024) . "</span>";
            echo '<p>- Found '.COUNT($languageData).' items (which aren\'t locked). '
                    . 'Translating to \''.$languageItem['language_code'].'\' '
                    . '('.$languageItem['languageName'].')...</p>';

            // output results
            CoreHelper::flushOutput();

            // do the translation, ensuring no more than 100 per second
            $googleTranslate = new GoogleTranslate($languageItem['language_code']);
            $tracker = 1;
            foreach($languageData AS $languageDataItem)
            {
                $translation = $googleTranslate->translate($languageDataItem['defaultContent']);
                if ($translation !== false)
                {
                    // update item within the database, also set as locked so this 
                    // process can be run from where it finished if it fails
                    $db->query('UPDATE language_content '
                            . 'SET content = :content, is_locked = 1 '
                            . 'WHERE id = :id AND '
                            . 'is_locked = 0 '
                            . 'LIMIT 1', array(
                                'content' => $translation,
                                'id' => $languageDataItem['id'],
                            ));

                    // onscreen progress
                    if($tracker % 50 == 0)
                    {
                        // output results
                        echo '<p>- Completed '.$tracker.' translations...</p>';
                        CoreHelper::flushOutput();
                    }
                    $tracker++;
                }
                else
                {
                    die('<font style="color: red;">'.$googleTranslate->getError().'</font>');
                }
            }

            // output results
            CoreHelper::flushOutput();

            echo '<p style="color: green; font-weight:bold;">- Auto translation '
            . 'of '.COUNT($languageData).' items to \''.$languageItem['language_code'].'\' '
                    . '('.$languageItem['languageName'].') complete.</p>';
        }

        echo '<br/><br/>';
        ZipFile::scrollIframe();
        exit;
    }

    public function translationManageExport() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();

        // get languages
        $languages = Language::loadAll('languageName');

        // handle page submissions
        if ($request->request->has('submitted')) {
            // pickup vars
            $languageId = (int) $request->request->get('languageId');

            // load language
            $language = Language::loadOneById($languageId);
            if (!$language) {
                AdminHelper::setError(AdminHelper::t("translation_export_failed_to_load_language", "Failed to load language, please try again."));
            }

            // export data
            if (AdminHelper::isErrors() == false) {
                // resulting csv data
                $formattedCSVData = array();

                // header
                $lArr = array();
                $lArr[] = "Language Key (do not change)";
                $lArr[] = "Is Admin Area (do not change)";
                $lArr[] = "Default Content (do not change)";
                $lArr[] = "Translation";
                $formattedCSVData[] = "\"" . implode("\",\"", $lArr) . "\"";

                // get all url data
                $translationData = $db->getRows("SELECT language_key.languageKey, "
                        . "language_key.defaultContent, language_key.isAdminArea, "
                        . "language_content.content "
                        . "FROM language_key "
                        . "LEFT JOIN language_content ON language_key.id = language_content.languageKeyId "
                        . "WHERE language_content.languageId = :languageId "
                        . "ORDER BY language_key.isAdminArea ASC, language_key.languageKey ASC", array(
                    'languageId' => $languageId,
                ));
                foreach ($translationData AS $row) {
                    // @TODO - change this to core PHP csv handling
                    $lArr = array();
                    $lArr[] = str_replace("\"", "\\\"", str_replace("\\", "\\\\", $row['languageKey']));
                    $lArr[] = (int) $row['isAdminArea'];
                    $lArr[] = str_replace("\"", "\\\"", str_replace("\\", "\\\\", $row['defaultContent']));
                    $lArr[] = str_replace("\"", "\\\"", str_replace("\\", "\\\\", $row['content']));

                    $formattedCSVData[] = "\"" . implode("\",\"", $lArr) . "\"";
                }
                $outname = trim($language->languageName) . ".csv";

                return $this->renderDownloadFile(implode("\n", $formattedCSVData), $outname);
            }
        }

        // load template
        return $this->render('admin/translation_manage_export.html', array_merge(array(
                    'languages' => $languages,
                                ), $this->getHeaderParams()));
    }

    public function translationManageImport() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();

        // get languages
        $languages = Language::loadAll('languageName');

        // handle page submissions
        if ($request->request->has('submitted')) {
            // pickup vars
            $languageId = (int) $request->request->get('languageId');
            $file = $request->files->get('translation_csv');

            // validate submission
            if (_CONFIG_DEMO_MODE == true) {
                AdminHelper::setError(AdminHelper::t("no_changes_in_demo_mode"));
            }
            elseif (strlen($file->getClientOriginalName()) == 0) {
                AdminHelper::setError(AdminHelper::t("no_file_selected", "No file selected, please try again."));
            }
            elseif (strpos(strtolower($file->getClientOriginalName()), '.csv') === false) {
                AdminHelper::setError(AdminHelper::t("not_a_csv_file", "The uploaded file does not appear to be a csv file."));
            }

            // load language
            if (AdminHelper::isErrors() == false) {
                $language = Language::loadOneById($languageId);
                if (!$language) {
                    AdminHelper::setError(AdminHelper::t("translation_export_failed_to_load_language", "Failed to load language, please try again."));
                }
            }

            // validate data
            if (AdminHelper::isErrors() == false) {
                $row = 1;
                if (($handle = fopen($file->getRealPath(), "r")) !== FALSE) {
                    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                        $cols = count($data);
                        if (($cols != 4) && (AdminHelper::isErrors() == false)) {
                            AdminHelper::setError(AdminHelper::t("translation_import_csv_incorrect_columns_please_check", "Line [[[LINE]]] should have [[[COLUMNS]]] columns. Please check there's not a double quote in the text content causing the error. Any double quotes in text should be escaped with a backslash. i.e. \\\"", array('LINE' => $row, 'COLUMNS' => '4')));
                        }
                        $row++;
                    }
                    fclose($handle);
                }
            }

            // import
            if (AdminHelper::isErrors() == false) {
                // preload content into array for key lookup
                $languageKeyArr = array();
                $languageKeys = $db->getRows('SELECT id, languageKey '
                        . 'FROM language_key');
                foreach ($languageKeys AS $languageKey) {
                    $languageKeyArr[$languageKey{'languageKey'}] = $languageKey['id'];
                }

                $row = 1;
                if (($handle = fopen($file->getRealPath(), "r")) !== FALSE) {
                    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                        // lookup language key id for the update
                        $languageKeyId = (int) $languageKeyArr[$data{0}];
                        if ($languageKeyId > 0) {
                            $newContent = $data[3];

                            // update new content
                            $db->query('UPDATE language_content '
                                    . 'SET content=' . $db->quote($newContent) . ', is_locked = 1 '
                                    . 'WHERE languageKeyId=' . $languageKeyId . ' '
                                    . 'AND languageId=' . $languageId . ' '
                                    . 'AND is_locked = 0 '
                                    . 'LIMIT 1');
                        }

                        $row++;
                    }
                    fclose($handle);

                    // redirect to manage translations
                    return $this->redirect('translation_manage_text?languageId=' . $languageId . '&sa=1');
                }
            }
        }

        // load template
        return $this->render('admin/translation_manage_import.html', array_merge(array(
                    'languages' => $languages,
                                ), $this->getHeaderParams()));
    }

    public function logFileViewer() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();
        $lFile = $request->query->has('lFile') ? $request->query->get('lFile') : '';
        $lType = $request->query->has('lType') ? $request->query->get('lType') : '';

        // make safe
        $lFile = str_replace(array('..', './', '../'), '', $lFile);
        $lType = str_replace(array('..', './', '../'), '', $lType);
        $lFile = strip_tags($lFile);
        $lType = strip_tags($lType);

        // limit the output
        define('LOG_FILE_LIMIT_OUTPUT_LINES', 1000);

        // prep the log message for output
        $logMsg = '';
        if (_CONFIG_DEMO_MODE == true) {
            AdminHelper::setError("Viewing the log files is not permitted in demo mode.");
        }
        else {
            // get list of log file types
            $logFileTypes = array();
            if ($handle = opendir(LOCAL_SITE_CONFIG_BASE_LOG_PATH)) {
                // loop contents
                while (false !== ($entry = readdir($handle))) {
                    if ((substr($entry, 0, 1) != '.') && (is_dir(LOCAL_SITE_CONFIG_BASE_LOG_PATH . $entry))) {
                        $logFileTypes[] = $entry;
                    }
                }
                closedir($handle);
                asort($logFileTypes);
            }

            if (COUNT($logFileTypes) == 0) {
                $logMsg .= 'Could not find any log files in the log folder - ' . LOCAL_SITE_CONFIG_BASE_LOG_PATH;
            }
            else {
                // show log file contents
                if (strlen($lFile) && strlen($lType)) {
                    // log file path
                    $logPath = LOCAL_SITE_CONFIG_BASE_LOG_PATH . $lType . '/' . $lFile;

                    // double check the file exists
                    if (file_exists($logPath)) {
                        // get file contents, limit by top LOG_FILE_LIMIT_OUTPUT_LINES lines
                        $logLines = LogHelper::readLogFile($logPath, LOG_FILE_LIMIT_OUTPUT_LINES);
                        $logMsg .= 'Log file contents below, only the most recent ' . LOG_FILE_LIMIT_OUTPUT_LINES . ' lines are shown.<br/><br/>';
                        $logMsg .= '<textarea id="logViewer" class="logViewer form-control" style="height: 340px; font-family: monospace; font-size: 12px;" READONLY>';
                        if (COUNT($logLines)) {
                            foreach ($logLines AS $logLine) {
                                $logMsg .= AdminHelper::makeSafe($logLine);
                            }
                        }
                        $logMsg .= '</textarea>';
                        $logMsg .= '<br/>';
                        $logMsg .= '<br/>';
                        $logMsg .= '<a href="log_file_viewer?lType=' . AdminHelper::makeSafe($lType) . '">< back</a>';
                    }
                    else {
                        AdminHelper::setError('Error: Could not find log file - ' . AdminHelper::makeSafe($logPath));
                        $logMsg .= AdminHelper::compileErrorHtml();
                        $logMsg .= '<br/>';
                        $logMsg .= '<br/>';
                        $logMsg .= '<a href="log_file_viewer?lType=' . AdminHelper::makeSafe($lType) . '">< back</a>';
                    }
                }

                // if we need to filter by type
                elseif (isset($_REQUEST['lType'])) {
                    // get the log filter
                    $lType = $_REQUEST['lType'];

                    // try to load the list of log files for this type
                    $logFiles = array();
                    if ($handle = opendir(LOCAL_SITE_CONFIG_BASE_LOG_PATH . $lType . '/')) {
                        // loop contents
                        while (false !== ($entry = readdir($handle))) {
                            if (substr($entry, 0, 1) != '.') {
                                $logFiles[] = $entry;
                            }
                        }
                        closedir($handle);
                        arsort($logFiles);
                    }

                    if (COUNT($logFiles) == 0) {
                        $logMsg .= 'Error: Could not find any log files for that type - ' . LOCAL_SITE_CONFIG_BASE_LOG_PATH . $lType . '/<br/>';
                        $logMsg .= '<br/>';
                        $logMsg .= '<a href="log_file_viewer">< back</a>';
                    }
                    else {
                        // list the available logs
                        $logMsg .= 'Log files within the ' . $lType . ' folder listed below, the most recent at the top. Please select one to view it\'s contents.<br/>';
                        $logMsg .= '<br/>';
                        $logMsg .= '<ul class="adminList">';
                        $i = 0;
                        foreach ($logFiles AS $logFile) {
                            // only show the top 30
                            if ($i > 30) {
                                continue;
                            }
                            $logMsg .= '<li><a href="log_file_viewer?lType=' . AdminHelper::makeSafe($lType) . '&lFile=' . AdminHelper::makeSafe($logFile) . '">' . AdminHelper::makeSafe($logFile) . '</a></li>';
                            $i++;
                        }
                        $logMsg .= '</ul>';
                        $logMsg .= '<br/>';
                        $logMsg .= '<br/>';
                        $logMsg .= '<br/>';
                        $logMsg .= 'Log Storage Path: ' . LOCAL_SITE_CONFIG_BASE_LOG_PATH . '<br/>';
                        $logMsg .= '<br/>';
                        $logMsg .= '<br/>';
                        $logMsg .= '<a href="log_file_viewer">< back</a>';
                    }
                }
                else {
                    // if type not selected, so first load
                    $logMsg .= 'Please select the type of log to view below.<br/>';
                    $logMsg .= '<br/>';
                    $logMsg .= '<ul class="adminList">';
                    foreach ($logFileTypes AS $logFileType) {
                        $logMsg .= '<li><a href="log_file_viewer?lType=' . AdminHelper::makeSafe($logFileType) . '">' . AdminHelper::makeSafe(UCWords(str_replace(array('-', '_'), ' ', $logFileType))) . '</a></li>';
                    }
                    $logMsg .= '</ul>';
                    $logMsg .= '<br/>';
                    $logMsg .= '<br/>';
                    $logMsg .= 'Log Storage Path: ' . LOCAL_SITE_CONFIG_BASE_LOG_PATH;
                }
            }
        }

        // load template
        return $this->render('admin/log_file_viewer.html', array_merge(array(
                    'logMsg' => $logMsg,
                    'lType' => $lType,
                    'lFile' => $lFile,
                                ), $this->getHeaderParams()));
    }

    public function backgroundTaskManage() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $request = $this->getRequest();

        // load template
        return $this->render('admin/background_task_manage.html', array_merge(array(), $this->getHeaderParams()));
    }

    public function ajaxBackgroundTaskManage() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();

        $iDisplayLength = (int) $request->query->get('iDisplayLength');
        $iDisplayStart = (int) $request->query->get('iDisplayStart');
        $sSortDir_0 = ($request->query->has('sSortDir_0') && $request->query->get('sSortDir_0') === 'asc') ? 'asc' : 'desc';
        $filterText = $request->query->has('filterText') ? $request->query->get('filterText') : null;
        $filterByStatus = strlen($request->query->get('filterByStatus')) ? $request->query->get('filterByStatus') : false;
        $filterByServer = strlen($request->query->get('filterByServer')) ? (int) $request->query->get('filterByServer') : false;

        // get sorting columns
        $iSortCol_0 = (int) $request->query->get('iSortCol_0');
        $sColumns = trim($request->query->get('sColumns'));
        $arrCols = explode(",", $sColumns);
        $sortColumnName = $arrCols[$iSortCol_0];
        $sort = 'task';

        $sqlClause = "WHERE 1=1 ";

        $totalRS = $db->getValue("SELECT COUNT(background_task.id) AS total "
                . "FROM background_task " . $sqlClause);
        $limitedRS = $db->getRows("SELECT * FROM "
                . "background_task " . $sqlClause . " "
                . "ORDER BY " . $sort . " " . $db->escape($sSortDir_0) . " "
                . "LIMIT " . $iDisplayStart . ", " . $iDisplayLength);


        $data = array();
        if (COUNT($limitedRS) > 0) {
            foreach ($limitedRS AS $row) {
                $lRow = array();
                $icon = CORE_ASSETS_ADMIN_WEB_ROOT . '/images/icons/system/16x16/';
                switch ($row['status']) {
                    case 'running':
                        $icon .= 'clock.png';
                        break;
                    case 'not_run':
                        $icon .= 'warning.png';
                        break;
                    default:
                        $icon .= 'accept.png';
                        break;
                }

                $typeIcon = '<span style="vertical-align: middle;"><img src="' . $icon . '" width="16" height="16" title="' . $row['status'] . '" alt="' . $row['status'] . '" style="margin-right: 5px;"/></span>';
                $lRow[] = $typeIcon;
                $lRow[] = '<a href="background_task_manage_log?task_id=' . $row['id'] . '">' . AdminHelper::makeSafe($row['task']) . '</a>';
                $lRow[] = CoreHelper::formatDate($row['last_update'], SITE_CONFIG_DATE_TIME_FORMAT);
                $statusRow = '<span class="statusText' . str_replace(" ", "", AdminHelper::makeSafe(UCWords($row['status']))) . '"';
                $statusRow .= '>' . UCWords(str_replace('_', ' ', $row['status'])) . '</span>';
                if ((strlen($row['action_date'])) && ($row['status'] == 'pending')) {
                    $statusRow .= '<br/><span style="color: #999999;">(' . CoreHelper::formatDate($row['action_date']) . ')</span>';
                }
                $lRow[] = $statusRow;

                $links = array();
                $links[] = '<a class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="view history" href="background_task_manage_log?task_id=' . $row['id'] . '"><span class="fa fa-file-text-o" aria-hidden="true"></span></a>';
                $lRow[] = '<div class="btn-group">' . implode("", $links) . '</div>';

                $data[] = $lRow;
            }
        }

        $resultArr = array();
        $resultArr["sEcho"] = intval($_GET['sEcho']);
        $resultArr["iTotalRecords"] = (int) $totalRS;
        $resultArr["iTotalDisplayRecords"] = $resultArr["iTotalRecords"];
        $resultArr["aaData"] = $data;

        // output response
        return $this->renderJson($resultArr);
    }

    public function backgroundTaskManageLog() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $request = $this->getRequest();
        $taskId = null;
        if ($request->query->has('task_id')) {
            $taskId = (int) $request->query->get('task_id');
        }

        if (!$taskId) {
            return $this->redirect('background_task_manage');
        }

        // load task
        $backgroundTask = BackgroundTask::loadOneById($taskId);
        if (!$backgroundTask) {
            return $this->redirect('background_task_manage');
        }

        // load template
        return $this->render('admin/background_task_manage_log.html', array_merge(array(
                    'taskId' => $taskId,
                    'backgroundTask' => $backgroundTask,
                                ), $this->getHeaderParams()));
    }

    public function ajaxBackgroundTaskManageLog() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();

        $iDisplayLength = (int) $request->query->get('iDisplayLength');
        $iDisplayStart = (int) $request->query->get('iDisplayStart');
        $sSortDir_0 = ($request->query->has('sSortDir_0') && $request->query->get('sSortDir_0') === 'asc') ? 'asc' : 'desc';
        $filterText = $request->query->has('filterText') ? $request->query->get('filterText') : null;
        $filterByStatus = strlen($request->query->get('filterByStatus')) ? $request->query->get('filterByStatus') : false;
        $filterByServer = strlen($request->query->get('filterByServer')) ? (int) $request->query->get('filterByServer') : false;

        // get sorting columns
        $iSortCol_0 = (int) $request->query->get('iSortCol_0');
        $sColumns = trim($request->query->get('sColumns'));
        $arrCols = explode(",", $sColumns);
        $sortColumnName = $arrCols[$iSortCol_0];
        $sort = 'start_time';

        $taskId = null;
        if ($request->query->has('task_id')) {
            $taskId = (int) $request->query->get('task_id');
        }

        if (!$taskId) {
            return $this->render404();
        }

        // load task
        $backgroundTask = BackgroundTask::loadOneById($taskId);
        if (!$backgroundTask) {
            return $this->render404();
        }

        $sqlClause = "WHERE background_task_log.task_id = " . (int) $backgroundTask->id;

        $totalRS = $db->getValue("SELECT COUNT(background_task_log.id) AS total "
                . "FROM background_task_log " . $sqlClause);
        $limitedRS = $db->getRows("SELECT id, start_time, end_time, status, server_name "
                . "FROM background_task_log " . $sqlClause . " "
                . "ORDER BY " . $sort . " " . $db->escape($sSortDir_0) . " "
                . "LIMIT " . $iDisplayStart . ", " . $iDisplayLength);

        $data = array();
        if (COUNT($limitedRS) > 0) {
            foreach ($limitedRS AS $row) {
                $lRow = array();
                $icon = CORE_ASSETS_ADMIN_WEB_ROOT . '/images/icons/system/16x16/';
                switch ($row['status']) {
                    case 'started':
                        $icon .= 'page_process.png';
                        break;
                    default:
                        $icon .= 'accept_page.png';
                        break;
                }

                $typeIcon = '<span style="vertical-align: middle;"><img src="' . $icon . '" width="16" height="16" title="' . $row['status'] . '" alt="' . $row['status'] . '" style="margin-right: 5px;"/></span>';
                $lRow[] = $typeIcon;
                $lRow[] = AdminHelper::makeSafe($row['server_name']);
                $lRow[] = CoreHelper::formatDate($row['start_time'], SITE_CONFIG_DATE_TIME_FORMAT);
                $lRow[] = CoreHelper::formatDate($row['end_time'], SITE_CONFIG_DATE_TIME_FORMAT);

                $statusRow = '<span class="statusText' . str_replace(" ", "", AdminHelper::makeSafe(UCWords($row['status']))) . '"';
                $statusRow .= '>' . UCWords($row['status']) . '</span>';
                if ((strlen($row['action_date'])) && ($row['status'] == 'pending')) {
                    $statusRow .= '<br/><span style="color: #999999;">(' . CoreHelper::formatDate($row['action_date']) . ')</span>';
                }
                $lRow[] = $statusRow;

                $data[] = $lRow;
            }
        }

        $resultArr = array();
        $resultArr["sEcho"] = intval($_GET['sEcho']);
        $resultArr["iTotalRecords"] = (int) $totalRS;
        $resultArr["iTotalDisplayRecords"] = $resultArr["iTotalRecords"];
        $resultArr["aaData"] = $data;

        // output response
        return $this->renderJson($resultArr);
    }

    public function serverInfo() {
        // admin restrictions
        $this->restrictAdminAccess();

        // get php info
        $pinfo = '- Not available';
        if (_CONFIG_DEMO_MODE == true) {
            AdminHelper::setError("Viewing the server information is not permitted in demo mode.");
        }
        else {
            ob_start();
            phpinfo();
            $pinfo = ob_get_contents();
            ob_end_clean();

            // the name attribute "module_Zend Optimizer" of an anker-tag is not xhtml valide, so replace it with "module_Zend_Optimizer"
            $pinfo = str_replace("module_Zend Optimizer", "module_Zend_Optimizer", preg_replace('%^.*<body>(.*)</body>.*$%ms', '$1', $pinfo));
        }

        // load template
        return $this->render('admin/server_info.html', array_merge(array(
                    'pinfo' => $pinfo,
                                ), $this->getHeaderParams()));
    }

    public function supportInfo() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();

        // get php info
        $phparr = '- Not available';
        $dt = new \DateTime();
        if (_CONFIG_DEMO_MODE == true) {
            AdminHelper::setError("Viewing the support information is not permitted in demo mode.");
        }
        else {
            $phparr = AdminHelper::phpinfoArray();
        }

        // load template
        return $this->render('admin/support_info.html', array_merge(array(
                    'phparr' => $phparr,
                    'dt' => $dt,
                    'loadedExtensions' => get_loaded_extensions(),
                    'operatingSystem' => php_uname(),
                    'server' => $_SERVER,
                    'mysqlServerVersion' => $db->getValue("SELECT version();"),
                    'mysqlServerTime' => $db->getValue('SELECT NOW();'),
                    'phpVersion' => phpversion(),
                    'phpLoadedIniFile' => php_ini_loaded_file(),
                    'phpCurrentTime' => date('Y-m-d H:i:s'),
                    'openSSLDetails' => print_r($phparr['openssl'], true),
                                ), $this->getHeaderParams()));
    }

    public function supportInfoDownload() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();

        if (_CONFIG_DEMO_MODE == true) {
            return $this->render404();
        }

        $plugins = $db->getRows("SELECT * "
                . "FROM plugin "
                . "ORDER BY plugin_name ASC");
        $servers = $db->getRows("SELECT * "
                . "FROM file_server "
                . "ORDER BY id DESC");
        $phparr = AdminHelper::phpinfoArray();
        $dt = new \DateTime();
        $mysqlTime = $db->getValue('SELECT NOW();');

        // get all the info from the server
        $content = "Server Information for " . _CONFIG_SITE_HOST_URL . ".\n\n";
        $content .= "Operating System: " . php_uname() . "\n";
        $content .= "Current Server Time: " . $dt->format('d-m-Y H:i:s') . "\n";
        $content .= "Web Server: " . $_SERVER['SERVER_SIGNATURE'] ? $_SERVER['SERVER_SIGNATURE'] : $_SERVER['SERVER_SOFTWARE'] . "\n";
        $content .= "Script Domain Name: " . _CONFIG_SITE_HOST_URL . "\n";
        $content .= "Server Hostname: " . $_SERVER['SERVER_SIGNATURE'] ? $_SERVER['SERVER_SIGNATURE'] : $_SERVER['SERVER_SOFTWARE'] . "\n";
        $content .= "Server IP Address: " . $_SERVER['SERVER_ADDR'] . "\n";
        $content .= "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "\n\n";

        // MySQL Information
        $content .= "MySQLi Information.\n\n";
        $content .= "MySQL Client Version: " . $phparr['mysqli']['Client API library version'] . "\n";
        $content .= "MySQL Server Version: " . $db->getValue("SELECT version();") . "\n";
        $content .= "MySQL Server Time: " . $db->getValue('SELECT NOW();') . "\n";
        $content .= "PDO Installed: " . $phparr['PDO']['PDO drivers'] . "\n";
        $content .= "PDO Version: " . $phparr['pdo_mysql']['Client API version'] . "\n\n";

        // PHP information
        $content .= "PHP Information.\n\n";
        $content .= "PHP Version: " . phpversion() . "\n";
        $content .= "Current PHP Time: " . date('Y-m-d H:i:s') . "\n";
        $content .= "php.ini Location: " . php_ini_loaded_file() . "\n";
        $content .= "Max Execution Time: " . $phparr['Core']['max_execution_time'] . "\n";
        $content .= "Max Input Time: " . $phparr['Core']['max_input_time'] . "\n";
        $content .= "Memory Limit: " . $phparr['Core']['memory_limit'] . "\n";
        $content .= "Post Max Size: " . $phparr['Core']['post_max_size'] . "\n";
        $content .= "Upload Max Filesize: " . $phparr['Core']['upload_max_filesize'] . "\n";
        $content .= "cURL Enabled: " . ucfirst($phparr['curl']['cURL support']) . "\n";
        $content .= "cURL Version: " . $phparr['curl']['cURL Information'] . "\n";
        $content .= "Default Timezone: " . $phparr['date']['Default timezone'] . "\n";
        $content .= "GD Enabled: " . ucfirst($phparr['gd']['GD Support']) . "\n";
        $content .= "GD Version: " . $phparr['gd']['GD Version'] . "\n";
        $content .= "OpenSSL Details: " . print_r($phparr['openssl'], true) . "\n";
        $content .= "Default Timezone: " . $phparr['date']['Default timezone'] . "\n";
        $content .= "Loaded Extensions: " . implode(get_loaded_extensions(), ', ') . "\n\n";

        // script Information
        $content .= "Script Information\n\n";
        $content .= "Script Version: v" . CoreHelper::getScriptInstalledVersion() . "\n";
        $content .= "Site Protocol: " . _CONFIG_SITE_PROTOCOL . "\n\n";
        $content .= "Plugins Installed (" . count($plugins) . ").\n\n";

        if ($plugins) {
            foreach ($plugins AS $plugin) {
                $content .= $plugin['plugin_name'] . "\n";
            }
        }
        else {
            $content .= "No plugins installed.\n\n";
        }

        // file Servers
        if ($servers) {
            $content .= "\n\n";
            $content .= "File Servers (" . count($servers) . ").";
            $content .= "\n\n";

            foreach ($servers AS $server) {
                $content .= 'Server Label: ' . $server['serverLabel'] . "\n";
                $content .= 'Server Type: ' . $server['serverType'] . "\n";
                if ($server['statusId'] == 1) {
                    $content .= "Server Status: Disabled.\n";
                }
                elseif ($server['statusId'] == 2) {
                    $content .= "Server Status: Active.\n";
                }
                elseif ($server['statusId'] == 3) {
                    $content .= "Server Status: Read Only.\n";
                }
                $content .= "Space Used: " . AdminHelper::formatSize($server['totalSpaceUsed']) . "\n";
                $totalFiles = $db->getValue("SELECT COUNT(id) "
                        . "FROM file "
                        . "WHERE serverId = " . $server['id'] . " "
                        . "AND status = 'active'");
                $content .= "Total Files: " . $totalFiles . "\n";
                $content .= "Storage Path: " . $server['storagePath'] . "\n";
                $content .= "\r";
            }
        }

        return $this->renderDownloadFile($content, _CONFIG_SITE_HOST_URL . '.txt');
    }

    public function databaseBrowser() {
        if (_CONFIG_DEMO_MODE == true) {
            AdminHelper::setError("Viewing the database is not permitted in demo mode.");
            $databaseBrowserContent = '';
        }
        else {
            // overwrite request for Adminer
            $_GET['db'] = _CONFIG_DB_NAME;
            $_GET['username'] = _CONFIG_DB_USER;

            // get Adminer content
            ob_start();
            require(CORE_FRAMEWORK_SERVICES_ROOT . '/Adminer.class.php');
            $databaseBrowserContent = ob_get_clean();
        }

        // load template
        return $this->render('admin/database_browser.html', array_merge(array(
                    'databaseBrowserContent' => $databaseBrowserContent,
                                ), $this->getHeaderParams()));
    }

    public function accountPackageManage() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();

        // update to sync id & level_id
        $db->query('UPDATE user_level '
                . 'SET level_id = id');

        // load template
        return $this->render('admin/account_package_manage.html', array_merge(array(), $this->getHeaderParams()));
    }

    public function ajaxAccountPackageManage() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();

        $iDisplayLength = (int) $request->query->get('iDisplayLength');
        $iDisplayStart = (int) $request->query->get('iDisplayStart');
        $sSortDir_0 = ($request->query->has('sSortDir_0') && $request->query->get('sSortDir_0') === 'asc') ? 'asc' : 'desc';
        $filterText = $request->query->has('filterText') ? $request->query->get('filterText') : null;

        // get sorting columns
        $iSortCol_0 = (int) $request->query->get('iSortCol_0');
        $sColumns = trim($request->query->get('sColumns'));
        $arrCols = explode(",", $sColumns);
        $sortColumnName = $arrCols[$iSortCol_0];
        $sort = 'user_level.level_id';

        $sqlClause = "WHERE 1=1 ";
        if ($filterText) {
            $filterText = $db->escape($filterText);
            $sqlClause .= "AND (user_level.label LIKE '%" . $filterText . "%')";
        }

        $sQL = "SELECT user_level.*, (SELECT COUNT(users.id) FROM users "
                . "WHERE users.level_id=user_level.id) AS totalUsers, "
                . "user_level.id AS package_id FROM user_level ";
        $sQL .= $sqlClause . " ";
        $totalRS = $db->getRows($sQL);

        $sQL .= "ORDER BY " . $sort . " " . $db->escape($sSortDir_0) . " "
                . "LIMIT " . $iDisplayStart . ", " . $iDisplayLength;
        $limitedRS = $db->getRows($sQL);

        $data = array();
        if (COUNT($limitedRS) > 0) {
            foreach ($limitedRS AS $row) {
                $lRow = array();
                $icon = CORE_ASSETS_ADMIN_WEB_ROOT . '/images/icons/system/16x16/tag_blue.png';

                $lRow[] = '<span style="vertical-align: middle;"><img src="' . $icon . '" width="16" height="16" title="User Package" alt="User Package" style="margin-right: 5px;"/></span>';
                $lRow[] = AdminHelper::makeSafe(UCWords($row['label']));
                $lRow[] = '<a href="' . ADMIN_WEB_ROOT . '/user_manage?filterByAccountType=' . (int) $row['package_id'] . '">' . AdminHelper::makeSafe($row['totalUsers']) . '</a>';
                $lRow[] = AdminHelper::makeSafe($row['can_upload'] == 1 ? 'Yes' : 'No');
                $lRow[] = AdminHelper::makeSafe($row['max_upload_size'] == 0 ? 'Unlimited' : AdminHelper::formatSize($row['max_upload_size'], 2));
                $lRow[] = AdminHelper::makeSafe($row['max_storage_bytes'] == 0 ? 'Unlimited' : AdminHelper::formatSize($row['max_storage_bytes'], 2));
                if (ThemeHelper::getCurrentProductType() == 'cloudable') {
                    $lRow[] = AdminHelper::makeSafe($row['days_to_keep_inactive_files'] == 0 ? 'Unlimited' : $row['days_to_keep_inactive_files']);
                }
                else {
                    $lRow[] = AdminHelper::makeSafe($row['on_upgrade_page'] == 1 ? 'Yes' : '-');
                }

                $links = array();
                $links[] = '<a class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="settings" href="#" onClick="editPackageForm(' . (int) $row['id'] . '); return false;"><span class="fa fa-pencil" aria-hidden="true"></span></a>';
                if ($row['level_type'] == 'paid') {
                    $links[] = '<a class="btn btn-default btn-sm nav_account_packages" data-toggle="tooltip" data-placement="top" data-original-title="pricing options" href="account_package_pricing_manage?level_id=' . (int) $row['level_id'] . '"><span class="fa fa-money" aria-hidden="true"></span></a>';
                }
                $linkStr = '<div class="btn-group">' . implode(" ", $links) . '</div>';
                $lRow[] = $linkStr;

                $data[] = $lRow;
            }
        }

        $resultArr = array();
        $resultArr["sEcho"] = intval($_GET['sEcho']);
        $resultArr["iTotalRecords"] = (int) $totalRS;
        $resultArr["iTotalDisplayRecords"] = $resultArr["iTotalRecords"];
        $resultArr["aaData"] = $data;

        // output response
        return $this->renderJson($resultArr);
    }

    public function ajaxAccountPackageManageAddForm() {
        // admin restrictions
        $this->restrictAdminAccess();

        // prepare variables
        $request = $this->getRequest();
        $label = '';
        $can_upload = 0;
        $wait_between_downloads = '';
        $download_speed = '';
        $max_storage_bytes = '';
        $show_site_adverts = '';
        $show_upgrade_screen = '';
        $days_to_keep_inactive_files = '';
        $concurrent_uploads = '';
        $concurrent_downloads = '';
        $downloads_per_24_hours = '';
        $max_download_filesize_allowed = '';
        $can_remote_download = 0;
        $max_remote_download_urls = '';
        $max_upload_size = '';
        $level_type = 'paid';
        $on_upgrade_page = 0;
        $max_uploads_per_day = 0;
        $accepted_file_types = '';
        $blocked_file_types = '';
        $days_to_keep_trashed_files = 0;

        // is this an edit?
        $gEditUserLevelId = null;
        $formType = 'add the';
        $formName = 'addUserPackageForm';
        if ($request->request->has('gEditUserLevelId')) {
            $gEditUserLevelId = (int) $request->request->get('gEditUserLevelId');
            $packageDetails = UserLevel::loadOneById($gEditUserLevelId);
            if ($packageDetails) {
                $label = $packageDetails->label;
                $can_upload = $packageDetails->can_upload;
                $wait_between_downloads = $packageDetails->wait_between_downloads;
                $download_speed = $packageDetails->download_speed;
                $max_storage_bytes = $packageDetails->max_storage_bytes;
                $show_site_adverts = $packageDetails->show_site_adverts;
                $show_upgrade_screen = $packageDetails->show_upgrade_screen;
                $days_to_keep_inactive_files = $packageDetails->days_to_keep_inactive_files;
                $concurrent_uploads = $packageDetails->concurrent_uploads;
                $concurrent_downloads = $packageDetails->concurrent_downloads;
                $downloads_per_24_hours = $packageDetails->downloads_per_24_hours;
                $max_download_filesize_allowed = $packageDetails->max_download_filesize_allowed;
                $can_remote_download = (int) $packageDetails->can_remote_download;
                $max_remote_download_urls = $packageDetails->max_remote_download_urls;
                $max_upload_size = $packageDetails->max_upload_size;
                $level_type = $packageDetails->level_type;
                $on_upgrade_page = $packageDetails->on_upgrade_page;
                $max_uploads_per_day = (int) $packageDetails->max_uploads_per_day;
                $accepted_file_types = trim($packageDetails->accepted_file_types);
                $blocked_file_types = trim($packageDetails->blocked_file_types);
                $days_to_keep_trashed_files = (int) $packageDetails->days_to_keep_trashed_files;

                $formType = 'update the';
                $formName = 'editUserPackageForm';
            }
        }

        $availableAccountTypes = array('free' => 'Free', 'paid' => 'Paid', 'moderator' => 'Moderator', 'admin' => 'Admin', 'nonuser' => 'Non User (do not use - system use only)');
        if (ThemeHelper::getCurrentProductType() == 'cloudable') {
            $availableAccountTypes = array('free' => 'User', 'admin' => 'Admin', 'nonuser' => 'Non User (do not use - system use only)');
        }

        // prepare result
        $result = array();
        $result['error'] = false;
        $result['msg'] = '';
        $result['html'] = $this->getRenderedTemplate('admin/ajax/account_package_manage_add_form.html', array(
            'gEditUserLevelId' => $gEditUserLevelId,
            'formType' => $formType,
            'formName' => $formName,
            'label' => $label,
            'can_upload' => $can_upload,
            'wait_between_downloads' => $wait_between_downloads,
            'download_speed' => $download_speed,
            'max_storage_bytes' => $max_storage_bytes,
            'show_site_adverts' => $show_site_adverts,
            'show_upgrade_screen' => $show_upgrade_screen,
            'days_to_keep_inactive_files' => $days_to_keep_inactive_files,
            'concurrent_uploads' => $concurrent_uploads,
            'concurrent_downloads' => $concurrent_downloads,
            'downloads_per_24_hours' => $downloads_per_24_hours,
            'max_download_filesize_allowed' => $max_download_filesize_allowed,
            'can_remote_download' => $can_remote_download,
            'max_remote_download_urls' => $max_remote_download_urls,
            'max_upload_size' => $max_upload_size,
            'level_type' => $level_type,
            'on_upgrade_page' => $on_upgrade_page,
            'max_uploads_per_day' => $max_uploads_per_day,
            'accepted_file_types' => $accepted_file_types,
            'blocked_file_types' => $blocked_file_types,
            'days_to_keep_trashed_files' => $days_to_keep_trashed_files,
            'yesNoOptions' => array(0 => 'No', 1 => 'Yes'),
            'availableAccountTypes' => $availableAccountTypes,
        ));

        // output response
        return $this->renderJson($result);
    }

    public function ajaxAccountPackageManageAddProcess() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();
        $existing_user_level_id = $request->request->get('existing_user_level_id');
        if ($existing_user_level_id == 'null') {
            $existing_user_level_id = null;
        }
        $label = trim($request->request->get('label'));
        $can_upload = (int) trim($request->request->get('can_upload'));
        $download_speed = trim($request->request->get('download_speed'));
        $max_storage_bytes = trim($request->request->get('max_storage_bytes'));
        $show_site_adverts = (int) trim($request->request->get('show_site_adverts'));
        $show_upgrade_screen = trim($request->request->get('show_upgrade_screen'));
        $days_to_keep_inactive_files = (int) trim($request->request->get('days_to_keep_inactive_files'));
        $concurrent_uploads = (int) trim($request->request->get('concurrent_uploads'));
        $concurrent_downloads = (int) trim($request->request->get('concurrent_downloads'));
        $downloads_per_24_hours = (int) trim($request->request->get('downloads_per_24_hours'));
        $max_download_filesize_allowed = trim($request->request->get('max_download_filesize_allowed'));
        $can_remote_download = (int) $request->request->get('can_remote_download');
        $max_remote_download_urls = (int) trim($request->request->get('max_remote_download_urls'));
        $max_upload_size = trim($request->request->get('max_upload_size'));
        $level_type = trim($request->request->get('level_type'));
        $on_upgrade_page = (int) $request->request->get('on_upgrade_page');
        $wait_between_downloads = (int) $request->request->get('wait_between_downloads');
        $max_uploads_per_day = (int) $request->request->get('max_uploads_per_day');
        $accepted_file_types = trim($request->request->get('accepted_file_types'));
        $blocked_file_types = trim($request->request->get('blocked_file_types'));
        $days_to_keep_trashed_files = (int) $request->request->get('days_to_keep_trashed_files');

        // prepare result
        $result = array();
        $result['error'] = false;
        $result['msg'] = '';

        // validate submission
        if (strlen($label) == 0) {
            $result['error'] = true;
            $result['msg'] = AdminHelper::t("account_level_label_invalid", "Please specify the label.");
        }
        elseif (_CONFIG_DEMO_MODE == true) {
            $result['error'] = true;
            $result['msg'] = AdminHelper::t("no_changes_in_demo_mode");
        }

        if (strlen($result['msg']) == 0) {
            $sQL = 'SELECT id '
                    . 'FROM user_level '
                    . 'WHERE label = ' . $db->quote($label) . ' ';
            if ((int)$existing_user_level_id > 0) {
                $sQL .= 'AND id != ' . (int)$existing_user_level_id;
            }

            $row = $db->getRow($sQL);
            if (is_array($row)) {
                $result['error'] = true;
                $result['msg'] = AdminHelper::t("account_level_label_already_in_use", "That label has already been used, please choose another.");
            }
            else {
                if (strlen($existing_user_level_id) > 0) {
                    // update the existing record
                    $userLevel = UserLevel::loadOneById($existing_user_level_id);
                    $userLevel->label = $label;
                    $userLevel->can_upload = $can_upload;
                    $userLevel->wait_between_downloads = $wait_between_downloads;
                    $userLevel->download_speed = $download_speed;
                    $userLevel->max_storage_bytes = $max_storage_bytes;
                    $userLevel->show_site_adverts = $show_site_adverts;
                    $userLevel->show_upgrade_screen = $show_upgrade_screen;
                    $userLevel->days_to_keep_inactive_files = $days_to_keep_inactive_files;
                    $userLevel->concurrent_uploads = $concurrent_uploads;
                    $userLevel->concurrent_downloads = $concurrent_downloads;
                    $userLevel->downloads_per_24_hours = $downloads_per_24_hours;
                    $userLevel->max_download_filesize_allowed = $max_download_filesize_allowed;
                    $userLevel->can_remote_download = $can_remote_download;
                    $userLevel->max_remote_download_urls = $max_remote_download_urls;
                    $userLevel->max_upload_size = $max_upload_size;
                    $userLevel->level_type = $level_type;
                    $userLevel->on_upgrade_page = $on_upgrade_page;
                    $userLevel->max_uploads_per_day = $max_uploads_per_day;
                    $userLevel->accepted_file_types = $accepted_file_types;
                    $userLevel->blocked_file_types = $blocked_file_types;
                    $userLevel->days_to_keep_trashed_files = $days_to_keep_trashed_files;
                    $userLevel->save();

                    $result['error'] = false;
                    $result['msg'] = 'User package \'' . $label . '\' updated.';

                    // do plugin settings
                    PluginHelper::updatePluginPackageSettings($_REQUEST, $userLevel->id);
                }
                else {
                    // get new level id
                    $level_id = (int) $db->getValue('SELECT level_id '
                            . 'FROM user_level '
                            . 'WHERE level_id < 10 '
                            . 'ORDER BY level_id DESC '
                            . 'LIMIT 1') + 1;

                    // add the file server
                    $userLevel = UserLevel::create();
                    $userLevel->level_id = $level_id;
                    $userLevel->label = $label;
                    $userLevel->can_upload = $can_upload;
                    $userLevel->wait_between_downloads = $wait_between_downloads;
                    $userLevel->download_speed = $download_speed;
                    $userLevel->max_storage_bytes = $max_storage_bytes;
                    $userLevel->show_site_adverts = $show_site_adverts;
                    $userLevel->show_upgrade_screen = $show_upgrade_screen;
                    $userLevel->days_to_keep_inactive_files = $days_to_keep_inactive_files;
                    $userLevel->concurrent_uploads = $concurrent_uploads;
                    $userLevel->concurrent_downloads = $concurrent_downloads;
                    $userLevel->downloads_per_24_hours = $downloads_per_24_hours;
                    $userLevel->max_download_filesize_allowed = $max_download_filesize_allowed;
                    $userLevel->can_remote_download = $can_remote_download;
                    $userLevel->max_remote_download_urls = $max_remote_download_urls;
                    $userLevel->max_upload_size = $max_upload_size;
                    $userLevel->level_type = $level_type;
                    $userLevel->on_upgrade_page = $on_upgrade_page;
                    $userLevel->max_uploads_per_day = $max_uploads_per_day;
                    $userLevel->accepted_file_types = $accepted_file_types;
                    $userLevel->blocked_file_types = $blocked_file_types;
                    $userLevel->days_to_keep_trashed_files = $days_to_keep_trashed_files;
                    $userLevel->save();

                    // update to sync id & level_id
                    $db->query('UPDATE user_level '
                            . 'SET level_id = id');

                    $result['error'] = false;
                    $result['msg'] = 'User package \'' . $label . '\' added.';

                    // do plugin settings
                    PluginHelper::updatePluginPackageSettings($_REQUEST, $userLevel->id);
                }
            }
        }

        // output response
        return $this->renderJson($result);
    }

    public function accountPackagePricingManage() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();

        // handle deletes
        if ($request->query->has('del')) {
            if (_CONFIG_DEMO_MODE == true) {
                AdminHelper::setError(TranslateHelper::t("no_changes_in_demo_mode"));
            }
            else {
                // delete the pricing object
                $userLevelPricing = UserLevelPricing::loadOneById($request->query->get('del'));
                if ($userLevelPricing) {
                    $userLevelPricing->delete();
                }

                AdminHelper::setSuccess('The package pricing item has been removed.');
            }
        }

        $appendTitle = '';
        if ($request->query->has('level_id')) {
            $userLevel = UserLevel::loadOneById($request->query->get('level_id'));
            if ($userLevel) {
                $appendTitle = ' for "' . ucwords($userLevel->label) . '"';
            }
        }

        // load template
        return $this->render('admin/account_package_pricing_manage.html', array_merge(array(
                    'appendTitle' => $appendTitle,
                    'levelId' => $request->query->has('level_id') ? $request->query->get('level_id') : '',
                                ), $this->getHeaderParams()));
    }

    public function ajaxAccountPackagePricingManage() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();

        $iDisplayLength = (int) $request->query->get('iDisplayLength');
        $iDisplayStart = (int) $request->query->get('iDisplayStart');
        $sSortDir_0 = ($request->query->has('sSortDir_0') && $request->query->get('sSortDir_0') === 'asc') ? 'asc' : 'desc';
        $filterText = $request->query->has('filterText') ? $request->query->get('filterText') : null;
        $filterLevelId = $request->query->has('level_id') ? $request->query->get('level_id') : null;

        // get sorting columns
        $iSortCol_0 = (int) $request->query->get('iSortCol_0');
        $sColumns = trim($request->query->get('sColumns'));
        $arrCols = explode(",", $sColumns);
        $sortColumnName = $arrCols[$iSortCol_0];
        $sort = 'user_level_pricing.user_level_id, user_level_pricing.price';

        $sqlClause = "WHERE 1=1 ";
        if ($filterText) {
            $filterText = $db->escape($filterText);
            $sqlClause .= "AND (user_level_pricing.pricing_label LIKE '%" . $filterText . "%')";
        }

        if ($filterLevelId) {
            $sqlClause .= "AND user_level_id = " . (int) $filterLevelId;
        }

        $sQL = "SELECT user_level_pricing.*, user_level.label AS user_level_label "
                . "FROM user_level_pricing "
                . "LEFT JOIN user_level ON user_level_pricing.user_level_id = user_level.level_id ";
        $sQL .= $sqlClause . " ";
        $totalRS = $db->getRows($sQL);

        $sQL .= "ORDER BY " . $sort . " " . $db->escape($sSortDir_0) . " ";
        $sQL .= "LIMIT " . $iDisplayStart . ", " . $iDisplayLength;
        $limitedRS = $db->getRows($sQL);

        $data = array();
        if (COUNT($limitedRS) > 0) {
            foreach ($limitedRS AS $row) {
                $lRow = array();
                $icon = CORE_ASSETS_ADMIN_WEB_ROOT . '/images/icons/system/16x16/tag_blue.png';

                $lRow[] = '<span style="vertical-align: middle;"><img src="' . $icon . '" width="16" height="16" title="Package Pricing" alt="Package Pricing" style="margin-right: 5px;"/></span>';
                $lRow[] = AdminHelper::makeSafe($row['pricing_label']);
                $lRow[] = AdminHelper::makeSafe(UCWords($row['user_level_label']));

                $packageTypeStr = '';
                if ($row['package_pricing_type'] == 'bandwidth') {
                    $packageTypeStr .= 'Download Allowance: ' . CoreHelper::formatSize($row['download_allowance']);
                }
                else {
                    $packageTypeStr .= 'Premium Access: ' . $row['period'];
                }
                $lRow[] = AdminHelper::makeSafe($packageTypeStr);
                $lRow[] = SITE_CONFIG_COST_CURRENCY_SYMBOL . AdminHelper::makeSafe(number_format($row['price'], 2)) . ' ' . SITE_CONFIG_COST_CURRENCY_CODE;

                $links = array();
                $links[] = '<a class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="edit" href="#" onClick="editPackagePricingForm(' . (int) $row['id'] . '); return false;"><span class="fa fa-pencil" aria-hidden="true"></span></a>';
                $links[] = '<a class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="remove" href="account_package_pricing_manage?del=' . (int) $row['id'] . '" onClick="return confirm(\'Please confirm you want to remove this package pricing item?\');"><span class="fa fa-trash text-danger" aria-hidden="true"></span></a>';
                $linkStr = '<div class="btn-group">' . implode(" ", $links) . '</div>';
                $lRow[] = $linkStr;

                $data[] = $lRow;
            }
        }

        $resultArr = array();
        $resultArr["sEcho"] = intval($_GET['sEcho']);
        $resultArr["iTotalRecords"] = (int) $totalRS;
        $resultArr["iTotalDisplayRecords"] = $resultArr["iTotalRecords"];
        $resultArr["aaData"] = $data;

        // output response
        return $this->renderJson($resultArr);
    }

    public function ajaxAccountPackagePricingManageAddForm() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();

        // prepare variables
        $pricing_label = '';
        $package_pricing_type = 'period';
        $period = '1M';
        $download_allowance = '';
        $user_level_id = 2;
        $price = '';
        $price_gbp = '';
        $price_eur = '';

        // check if this is an edit?
        $fileServerId = null;
        $formType = 'add the';
        if ($request->request->has('gEditPricingId')) {
            $gEditPricingId = (int) $request->request->get('gEditPricingId');
            if ($gEditPricingId) {
                $userLevelPricing = UserLevelPricing::loadOneById($gEditPricingId);
                if ($userLevelPricing) {
                    $pricing_label = $userLevelPricing->pricing_label;
                    $package_pricing_type = $userLevelPricing->package_pricing_type;
                    $period = $userLevelPricing->period;
                    $download_allowance = $userLevelPricing->download_allowance;
                    $user_level_id = $userLevelPricing->user_level_id;
                    $price = $userLevelPricing->price;

                    $formType = 'update the';
                }
            }
        }

        // dropdown options
        $pricingPackageTypeOptions = array('period' => 'By Period - Upgrade the account for a fixed length.', 'bandwidth' => 'By Bandwidth - Upgrade the account until a download filesize limit is reached.');
        $periodOptions = array('1D' => '1 Day', '2D' => '2 Days', '3D' => '3 Days', '7D' => '7 Days', '10D' => '10 Days', '14D' => '14 Days', '21D' => '21 Days', '28D' => '28 Days', '1M' => '1 Month', '2M' => '2 Months', '3M' => '3 Months', '4M' => '4 Months', '5M' => '5 Months', '6M' => '6 Months', '9M' => '9 Months', '1Y' => '1 Year', '2Y' => '2 Years');
        $userLevelOptions = $db->getRows('SELECT level_id, label '
                . 'FROM user_level '
                . 'WHERE level_type = \'paid\' '
                . 'ORDER BY level_id ASC');

        // prepare result
        $result = array();
        $result['error'] = false;
        $result['msg'] = '';
        $result['html'] = $this->getRenderedTemplate('admin/ajax/account_package_pricing_manage_add_form.html', array(
            'gEditPricingId' => $gEditPricingId,
            'formType' => $formType,
            'pricing_label' => $pricing_label,
            'package_pricing_type' => $package_pricing_type,
            'period' => $period,
            'download_allowance' => $download_allowance,
            'user_level_id' => $user_level_id,
            'price' => $price,
            'price_gbp' => $price_gbp,
            'price_eur' => $price_eur,
            'pricingPackageTypeOptions' => $pricingPackageTypeOptions,
            'periodOptions' => $periodOptions,
            'userLevelOptions' => $userLevelOptions,
        ));

        // output response
        return $this->renderJson($result);
    }

    public function ajaxAccountPackagePricingManageAddProcess() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();
        $existing_pricing_id = (int) $request->request->get('existing_pricing_id');
        $pricing_label = trim($request->request->get('pricing_label'));
        $package_pricing_type = trim($request->request->get('package_pricing_type'));
        $period = trim($request->request->get('period'));
        $download_allowance = trim($request->request->get('download_allowance'));
        $user_level_id = (int) $request->request->get('user_level_id');
        $price = trim($request->request->get('price'));
        $price_gbp = trim($request->request->get('price_gbp'));
        $price_eur = trim($request->request->get('price_eur'));

        // prepare result
        $result = array();
        $result['error'] = false;
        $result['msg'] = '';

        // validate submission
        if (strlen($pricing_label) == 0) {
            $result['error'] = true;
            $result['msg'] = AdminHelper::t("account_level_label_invalid", "Please specify the label.");
        }
        elseif (_CONFIG_DEMO_MODE == true) {
            $result['error'] = true;
            $result['msg'] = AdminHelper::t("no_changes_in_demo_mode");
        }

        if ($result['error'] == false) {
            if ($package_pricing_type == 'bandwidth') {
                if (strlen($download_allowance) == 0) {
                    $result['error'] = true;
                    $result['msg'] = AdminHelper::t("download_allowance_invalid", "Please specify the download allowance.");
                }
            }
        }

        if (strlen($result['msg']) == 0) {
            $row = $db->getRow('SELECT id '
                    . 'FROM user_level_pricing '
                    . 'WHERE pricing_label = :pricing_label '
                    . 'AND user_level_id != :user_level_id '
                    . 'AND id != :id', array(
                'pricing_label' => $pricing_label,
                'user_level_id' => $user_level_id,
                'id' => $existing_pricing_id,
            ));
            if (is_array($row)) {
                $result['error'] = true;
                $result['msg'] = AdminHelper::t("account_level_label_already_in_use", "That label has already been used, please choose another.");
            }
            else {
                if ($existing_pricing_id > 0) {
                    // update the existing record
                    $userLevelPricing = UserLevelPricing::loadOneById($existing_pricing_id);
                    $userLevelPricing->pricing_label = $pricing_label;
                    $userLevelPricing->package_pricing_type = $package_pricing_type;
                    $userLevelPricing->period = $period;
                    $userLevelPricing->download_allowance = $download_allowance;
                    $userLevelPricing->user_level_id = $user_level_id;
                    $userLevelPricing->price = $price;
                    $userLevelPricing->save();

                    $result['error'] = false;
                    $result['msg'] = 'Package pricing \'' . $pricing_label . '\' updated.';
                }
                else {
                    // add the new record
                    $userLevelPricing = UserLevelPricing::create();
                    $userLevelPricing->pricing_label = $pricing_label;
                    $userLevelPricing->package_pricing_type = $package_pricing_type;
                    $userLevelPricing->period = $period;
                    $userLevelPricing->download_allowance = $download_allowance;
                    $userLevelPricing->user_level_id = $user_level_id;
                    $userLevelPricing->price = $price;
                    $userLevelPricing->save();

                    $result['error'] = false;
                    $result['msg'] = 'Package pricing \'' . $pricing_label . '\' has been added.';
                }
            }
        }

        // output response
        return $this->renderJson($result);
    }

    public function backupManage() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();

        // setup the backup object for later
        $backup = new Backup();
        $backupPath = $backup->getBackupPath();

        // handle submissions
        if ($request->query->has('cd')) {
            // validate submission
            if (_CONFIG_DEMO_MODE == true) {
                AdminHelper::setError(AdminHelper::t("no_changes_in_demo_mode"));
            }
            else {
                $rs = $backup->backupDatabase();
                if (!$rs) {
                    AdminHelper::setError("Failed to create database backup, please try again later.");
                }
                else {
                    return $this->redirect(ADMIN_WEB_ROOT . '/backup_manage?cds=1');
                }
            }
        }
        elseif ($request->query->has('cds')) {
            AdminHelper::setSuccess("Database backup created.");
        }
        elseif ($request->query->has('cc')) {
            // validate submission
            if (_CONFIG_DEMO_MODE == true) {
                AdminHelper::setError(AdminHelper::t("no_changes_in_demo_mode"));
            }
            // check for zip module
            elseif(!extension_loaded('zip')) {
                AdminHelper::setError("Could not find ZIP module within PHP, please enable and try again.");
            }
            else {
                $rs = $backup->backupCode();
                if (!$rs) {
                    AdminHelper::setError("Failed to create code backup, please try again later.");
                }
                else {
                    return $this->redirect(ADMIN_WEB_ROOT . '/backup_manage?ccs=1');
                }
            }
        }
        elseif ($request->query->has('ccs')) {
            AdminHelper::setSuccess("Code backup created.");
        }
        elseif ($request->query->has('delete_path')) {
            // validate submission
            if (_CONFIG_DEMO_MODE == true) {
                AdminHelper::setError(AdminHelper::t("no_changes_in_demo_mode"));
            }
            else {
                // get params
                $path = $request->query->get('delete_path');
                $path = str_replace(array('..'), '', $path);
                $fullBackupPath = $backupPath . '/' . $path;

                // some security
                $fullBackupPath = realpath($fullBackupPath);
                if ($backupPath != substr($fullBackupPath, 0, strlen($backupPath))) {
                    exit;
                }

                $rs = @unlink($fullBackupPath);
                if (!$rs) {
                    AdminHelper::setError("Failed to delete backup file, please try again later.");
                }
                else {
                    return $this->redirect(ADMIN_WEB_ROOT . '/backup_manage?cdelete_path=1');
                }
            }
        }
        elseif ($request->query->has('cdelete_path')) {
            AdminHelper::setSuccess("Backup file removed.");
        }

        // get list of backups
        $backupFiles = array();
        $files = glob($backupPath.'/*');
        usort($files, function($a, $b) {
            return filemtime($a) < filemtime($b);
        });

        foreach($files AS $filePath) {
            if ((substr($entry, 0, 1) != '.') && (is_file($filePath))) {
                $created = CoreHelper::formatDate(filemtime($filePath), 'Y-m-d H:i:s');
                $filesize = CoreHelper::formatSize(filesize($filePath));
                $backupFiles[] = array('filename' => basename($filePath), 'created' => $created, 'filesize' => $filesize);
            }
        }

        // load template
        return $this->render('admin/backup_manage.html', array_merge(array(
                    'backupFiles' => $backupFiles,
                    'backupPath' => $backupPath,
                                ), $this->getHeaderParams()));
    }

    public function backupDownload() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();

        if (_CONFIG_DEMO_MODE == true) {
            die(AdminHelper::t("no_changes_in_demo_mode"));
        }

        // setup the backup object for later
        $backup = new Backup();
        $backupPath = $backup->getBackupPath();

        // get params
        $path = str_replace(array('..'), '', $request->query->get('path'));
        $fullBackupPath = $backupPath . '/' . $path;

        // some security
        $fullBackupPath = realpath($fullBackupPath);
        if ($backupPath != substr($fullBackupPath, 0, strlen($backupPath))) {
            exit;
        }

        return $this->renderDownloadFileFromPath($fullBackupPath, $path);
    }

    public function systemUpdate() {
        // admin restrictions
        $this->restrictAdminAccess();

        // load template
        return $this->render('admin/system_update.html', array_merge(array(
                    'scriptInstalledVersion' => CoreHelper::getScriptInstalledVersion(),
                    'currentProductUrl' => ThemeHelper::getCurrentProductUrl(),
                    'currentProductName' => ThemeHelper::getCurrentProductName(),
                                ), $this->getHeaderParams()));
    }

    public function purgeApplicationCache($doPurge = false) {
        // admin restrictions
        $this->restrictAdminAccess();
        
        // handle purge requests
        if($doPurge !== false) {
            CacheHelper::removeCoreApplicationCache();
            AdminHelper::setSuccess("Application cache purged.");
        }

        // load template
        return $this->render('admin/purge_application_cache.html', $this->getHeaderParams());
    }

    public function downloadPageManage() {
        // admin restrictions
        $this->restrictAdminAccess();

        // load template
        return $this->render('admin/download_page_manage.html', array_merge(array(
                                ), $this->getHeaderParams()));
    }

    public function ajaxDownloadPageManage() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();

        $iDisplayLength = (int) $request->query->get('iDisplayLength');
        $iDisplayStart = (int) $request->query->get('iDisplayStart');

        // preload user levels
        $userLevels = $db->getRows('SELECT id, label '
                . 'FROM user_level');
        $userLevelsArr = array();
        $userLevelsArr[0] = 'Guest';
        foreach ($userLevels AS $userLevel) {
            $userLevelsArr[$userLevel{'id'}] = $userLevel['label'];
        }

        // get pages
        $limitedRS = $db->getRows("SELECT * "
                . "FROM download_page "
                . "ORDER BY user_level_id ASC, page_order ASC "
                . "LIMIT " . $iDisplayStart . ", " . $iDisplayLength);
        $totalRS = $limitedRS;

        $data = array();
        if (COUNT($limitedRS) > 0) {
            foreach ($limitedRS AS $row) {
                $lRow = array();
                $icon = CORE_ASSETS_ADMIN_WEB_ROOT . '/images/icons/system/16x16/download.png';
                $lRow[] = '<img src="' . $icon . '" width="16" height="16" alt="download page"/>';
                $lRow[] = AdminHelper::makeSafe(UCWords($userLevelsArr[$row{'user_level_id'}]) . ' (Page ' . ((int) $row['page_order']) . ')');
                $lRow[] = AdminHelper::makeSafe($row['download_page']);

                $links = array();
                $links[] = '<a href="#" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="edit" onClick="editDownloadPageForm(' . (int) $row['id'] . '); return false;"><span class="fa fa-pencil" aria-hidden="true"></span></a>';
                $links[] = '<a href="#" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" data-original-title="remove" onClick="deletePageType(' . (int) $row['id'] . '); return false;"><span class="fa fa-trash text-danger" aria-hidden="true"></span></a>';
                $linkStr = '<div class="btn-group">' . implode(" ", $links) . '</div>';
                $lRow[] = $linkStr;

                $data[] = $lRow;
            }
        }

        $resultArr = array();
        $resultArr["sEcho"] = intval($_GET['sEcho']);
        $resultArr["iTotalRecords"] = (int) $totalRS;
        $resultArr["iTotalDisplayRecords"] = $resultArr["iTotalRecords"];
        $resultArr["aaData"] = $data;

        // output response
        return $this->renderJson($resultArr);
    }

    public function ajaxDownloadPageManageAddForm() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();

        $pageId = null;
        if ($request->request->has('pageId')) {
            $pageId = (int) $request->request->get('pageId');
        }

        // preload user levels
        $userLevels = $db->getRows('SELECT id, label '
                . 'FROM user_level '
                . 'WHERE level_type != \'admin\' '
                . 'ORDER BY id');
        $userLevelsArr = array();
        $userLevelsArr[0] = 'Guest';
        foreach ($userLevels AS $userLevel) {
            $userLevelsArr[$userLevel{'id'}] = $userLevel['label'];
        }

        // get all download pages
        $downloadPages = array();
        $downloadPages = AdminHelper::getDirectoryList(SITE_TEMPLATES_PATH . '/download_page', 'twig');
        foreach ($downloadPages AS $downloadPage) {
            if($downloadPage === 'captcha.html.twig') {
                continue;
            }
            $downloadPages[] = $downloadPage;
        }
        sort($downloadPages);

        // defaults
        $download_page = '';
        $user_level_id = 0;
        $page_order = 1;
        $additional_javascript_code = '';
        $additional_settings = '';
        $optional_timer = 0;

        // is this an edit?
        if ($pageId !== null) {
            $language = $db->getRow("SELECT * "
                    . "FROM download_page "
                    . "WHERE id = " . (int) $pageId);
            if ($language) {
                $download_page = $language['download_page'];
                $user_level_id = (int) $language['user_level_id'];
                $page_order = (int) $language['page_order'];
                $additional_javascript_code = $language['additional_javascript_code'];
                $additional_settings = $language['additional_settings'];
                if (strlen($additional_settings)) {
                    $additional_settings_arr = json_decode($additional_settings, true);
                    if (isset($additional_settings_arr['download_wait'])) {
                        $optional_timer = (int) $additional_settings_arr['download_wait'];
                    }
                }
            }
        }

        // prepare result
        $result = array();
        $result['error'] = false;
        $result['msg'] = '';
        $result['html'] = $this->getRenderedTemplate('admin/ajax/download_page_manage_add_form.html', array(
            'pageId' => $pageId,
            'userLevelsArr' => $userLevelsArr,
            'downloadPages' => $downloadPages,
            'download_page' => $download_page,
            'user_level_id' => $user_level_id,
            'page_order' => $page_order,
            'additional_javascript_code' => $additional_javascript_code,
            'additional_settings' => $additional_settings,
            'optional_timer' => $optional_timer,
        ));

        // output response
        return $this->renderJson($result);
    }

    public function ajaxDownloadPageManageAddProcess() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();
        $download_page = trim($request->request->get('download_page'));
        $user_level_id = (int) ($request->request->get('user_level_id'));
        $page_order = (int) ($request->request->get('page_order'));
        $optional_timer = (int) ($request->request->get('optional_timer'));
        $additional_javascript_code = trim($request->request->get('additional_javascript_code'));
        $additional_settings = '';
        if ($optional_timer > 0) {
            $additional_settings = json_encode(array('download_wait' => $optional_timer));
        }

        if ($request->request->has('pageId')) {
            $pageId = (int) $request->request->get('pageId');
        }

        // check highest order value
        $highestOrder = $db->getValue('SELECT page_order '
                . 'FROM download_page '
                . 'WHERE user_level_id = ' . (int) $user_level_id . ' '
                . 'ORDER BY page_order DESC '
                . 'LIMIT 1');
        if ($highestOrder) {
            if (($page_order) > (int) $highestOrder) {
                $page_order = (int) $highestOrder;
            }
        }

        // prepare result
        $result = array();
        $result['error'] = false;
        $result['msg'] = '';

        if (_CONFIG_DEMO_MODE == true) {
            $result['error'] = true;
            $result['msg'] = AdminHelper::t("no_changes_in_demo_mode");
        }
        elseif ($page_order <= 0) {
            $result['error'] = true;
            $result['msg'] = AdminHelper::t("download_page_page_order_can_not_be_zero_or_less", "Page order can not be zero or less.");
        }
        else {
            if ($pageId) {
                // get page position which is to be removed
                $pageData = $db->getRow('SELECT page_order, user_level_id '
                        . 'FROM download_page '
                        . 'WHERE id = :id', array(
                    'id' => $pageId,
                ));

                // fix page ordering
                if ($page_order < (int) $pageData['page_order']) {
                    $db->query('UPDATE download_page '
                            . 'SET page_order = page_order+1 '
                            . 'WHERE user_level_id = ' . (int) $user_level_id . ' '
                            . 'AND page_order >= ' . (int) $page_order . ' '
                            . 'AND page_order < ' . (int) $pageData['page_order']);
                }
                if ($page_order > (int) $pageData['page_order']) {
                    $db->query('UPDATE download_page '
                            . 'SET page_order = page_order-1 '
                            . 'WHERE user_level_id = ' . (int) $user_level_id . ' '
                            . 'AND page_order > ' . (int) $pageData['page_order'] . ' '
                            . 'AND page_order <= ' . (int) $page_order);
                }

                // update
                $rs = $db->query('UPDATE download_page '
                        . 'SET download_page = :download_page, '
                        . 'user_level_id = :user_level_id, '
                        . 'page_order = :page_order, '
                        . 'additional_javascript_code = :additional_javascript_code, '
                        . 'additional_settings = :additional_settings '
                        . 'WHERE id = :id', array(
                    'download_page' => $download_page,
                    'user_level_id' => $user_level_id,
                    'page_order' => $page_order,
                    'additional_javascript_code' => $additional_javascript_code,
                    'additional_settings' => $additional_settings,
                    'id' => $pageId,
                        )
                );
                if (!$rs) {
                    $result['error'] = true;
                    $result['msg'] = AdminHelper::t("error_problem_download_page_record_update", "There was a problem updating the download page, please try again.");
                }
                else {
                    $result['error'] = false;
                    $result['msg'] = 'Download page has been updated.';
                }
            }
            else {
                // fix page ordering
                $db->query('UPDATE download_page '
                        . 'SET page_order = page_order+1 '
                        . 'WHERE user_level_id = ' . (int) $user_level_id . ' '
                        . 'AND page_order >= ' . (int) $page_order);

                // add the new language
                $downloadPage = DownloadPage::create();
                $downloadPage->download_page = $download_page;
                $downloadPage->user_level_id = $user_level_id;
                $downloadPage->page_order = $page_order;
                $downloadPage->additional_javascript_code = $additional_javascript_code;
                $downloadPage->additional_settings = $additional_settings;
                $downloadPage->save();

                $result['error'] = false;
                $result['msg'] = 'Download page has been added for user type.';
            }
        }

        // output response
        return $this->renderJson($result);
    }

    public function ajaxDownloadPageManageRemove() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $request = $this->getRequest();
        $db = Database::getDatabase();
        $pageId = (int) $request->request->get('pageId');

        if (_CONFIG_DEMO_MODE == true) {
            $result['error'] = true;
            $result['msg'] = AdminHelper::t("no_changes_in_demo_mode");
        }
        else {
            // get page position which is to be removed
            $pageData = $db->getRow('SELECT page_order, user_level_id '
                    . 'FROM download_page '
                    . 'WHERE id = ' . (int) $pageId);

            // remove page
            $db->query('DELETE FROM download_page '
                    . 'WHERE id = :pageId', array(
                'pageId' => $pageId,
                    )
            );
            if ($db->affectedRows() == 1) {
                // fix page ordering
                $db->query('UPDATE download_page '
                        . 'SET page_order = page_order-1 '
                        . 'WHERE user_level_id = ' . (int) $pageData['user_level_id'] . ' '
                        . 'AND page_order > ' . (int) $pageData['page_order']);

                $result['error'] = false;
                $result['msg'] = 'Page successfully removed from download process for that user type.';
            }
            else {
                $result['error'] = true;
                $result['msg'] = 'Could not remove the page from the user type, please try again later.';
            }
        }

        // output response
        return $this->renderJson($result);
    }

    public function testTools() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();

        // get all available tools based on functions within the
        // TestToolsController class
        $classNames = get_class_methods('App\Controllers\admin\TestToolsController');

        // we're only interested in test* methods
        $classNames = preg_grep('/^test/', $classNames);

        // change to kvp with url and name
        $urls = array();
        foreach ($classNames AS $className) {
            $url = AdminHelper::convertCamelcaseToUnderscoreLower($className);
            $url = ADMIN_WEB_ROOT . '/test_tools/' . substr($url, 5);
            $label = AdminHelper::convertCamelcaseToHuman($className);
            $label = substr($label, 5);
            $urls[$url] = $label;
        }

        // load template
        return $this->render('admin/test_tools.html', array_merge(array(
                    'urls' => $urls,
                                ), $this->getHeaderParams()));
    }

}
