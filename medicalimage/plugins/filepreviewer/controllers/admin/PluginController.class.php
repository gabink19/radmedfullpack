<?php

namespace Plugins\Filepreviewer\Controllers\Admin;

use App\Core\Database;
use App\Controllers\Admin\PluginController AS CorePluginController;
use App\Helpers\AdminHelper;
use App\Models\Plugin;

class PluginController extends CorePluginController
{

    public function pluginSettings() {
        // admin restrictions
        $this->restrictAdminAccess();

        // pickup request
        $db = Database::getDatabase();
        $request = $this->getRequest();

        // load plugin details
        $folderName = 'filepreviewer';
        $plugin = Plugin::loadOneByClause('folder_name = :folder_name', array(
                    'folder_name' => $folderName,
        ));

        if (!$plugin) {
            return $this->redirect(ADMIN_WEB_ROOT . '/plugin_manage?error=' . urlencode('There was a problem loading the plugin details.'));
        }

        // prepare variables
        $plugin_enabled = (int) $plugin->plugin_enabled;
        $non_show_viewer = 1;
        $free_show_viewer = 1;
        $paid_show_viewer = 1;
        $enable_preview_image = 1;
        $preview_image_show_thumb = 1;
        $auto_rotate = 1;
        $enable_preview_document = 1;
        $preview_document_pdf_thumbs = 1;
        $preview_document_ext = 'doc,docx,xls,xlsx,ppt,pptx,pdf,pages,ai,psd,tiff,dxf,svg,eps,ps,ttf,otf,xps';
        $enable_preview_video = 1;
        $preview_video_ext = 'mp4,flv,ogg';
        $enable_preview_audio = 1;
        $preview_audio_ext = 'mp3';

        // load existing settings
        if (strlen($plugin->plugin_settings)) {
            $plugin_settings = json_decode($plugin->plugin_settings, true);
            if ($plugin_settings) {
                $enable_preview_image = (int) $plugin_settings['enable_preview_image'];
                $preview_image_show_thumb = (int) $plugin_settings['preview_image_show_thumb'];
                $auto_rotate = (int) $plugin_settings['auto_rotate'];
                $enable_preview_document = (int) $plugin_settings['enable_preview_document'];
                $preview_document_pdf_thumbs = (int) $plugin_settings['preview_document_pdf_thumbs'];
                $preview_document_ext = $plugin_settings['preview_document_ext'];
                $enable_preview_video = (int) $plugin_settings['enable_preview_video'];
                $preview_video_ext = $plugin_settings['preview_video_ext'];
                $enable_preview_audio = (int) $plugin_settings['enable_preview_audio'];
                $preview_audio_ext = $plugin_settings['preview_audio_ext'];
            }
        }

        // handle page submissions
        if (isset($_REQUEST['submitted'])) {
            // get variables
            $plugin_enabled = (int) $_REQUEST['plugin_enabled'];
            $plugin_enabled = $plugin_enabled != 1 ? 0 : 1;
            $non_show_viewer = 1;
            $free_show_viewer = 1;
            $paid_show_viewer = 1;
            $enable_preview_image = (int) $_REQUEST['enable_preview_image'];
            $preview_image_show_thumb = (int) $_REQUEST['preview_image_show_thumb'];
            $auto_rotate = (int) $_REQUEST['auto_rotate'];
            $enable_preview_document = (int) $_REQUEST['enable_preview_document'];
            $preview_document_pdf_thumbs = (int) $_REQUEST['preview_document_pdf_thumbs'];
            $preview_document_ext = trim(strtolower($_REQUEST['preview_document_ext']));
            $enable_preview_video = (int) $_REQUEST['enable_preview_video'];
            $preview_video_ext = trim(strtolower($_REQUEST['preview_video_ext']));
            $enable_preview_audio = (int) $_REQUEST['enable_preview_audio'];
            $preview_audio_ext = trim(strtolower($_REQUEST['preview_audio_ext']));

            // validate submission
            if (_CONFIG_DEMO_MODE == true) {
                AdminHelper::setError(AdminHelper::t('no_changes_in_demo_mode', 'No change permitted in demo mode.'));
            }

            // update the settings
            if (AdminHelper::isErrors() == false) {
                // compile new settings
                $settingsArr = array();
                $settingsArr['non_show_viewer'] = (int) $non_show_viewer;
                $settingsArr['free_show_viewer'] = (int) $free_show_viewer;
                $settingsArr['paid_show_viewer'] = (int) $paid_show_viewer;
                $settingsArr['enable_preview_image'] = (int) $enable_preview_image;
                $settingsArr['preview_image_show_thumb'] = (int) $preview_image_show_thumb;
                $settingsArr['auto_rotate'] = (int) $auto_rotate;
                $settingsArr['supported_image_types'] = 'jpg,jpeg,png,gif,wbmp';
                $settingsArr['enable_preview_document'] = (int) $enable_preview_document;
                $settingsArr['preview_document_pdf_thumbs'] = (int) $preview_document_pdf_thumbs;
                $settingsArr['preview_document_ext'] = $preview_document_ext;
                $settingsArr['enable_preview_video'] = (int) $enable_preview_video;
                $settingsArr['preview_video_ext'] = $preview_video_ext;
                $settingsArr['enable_preview_audio'] = (int) $enable_preview_audio;
                $settingsArr['preview_audio_ext'] = $preview_audio_ext;
                $settingsArr['caching'] = 1;
                $settingsArr['image_quality'] = 90;

                // update the plugin settings
                $plugin->plugin_enabled = $plugin_enabled;
                $plugin->plugin_settings = json_encode($settingsArr);
                $plugin->save();
                
                // set onscreen alert
                AdminHelper::setSuccess('Plugin settings updated.');
            }
        }

        // load template
        return $this->render('admin/plugin_settings.html', array_merge(array(
                    'pluginName' => $plugin->plugin_name,
                    'yesNoOptions' => array(0 => 'No', 1 => 'Yes'),
                    'plugin_enabled' => $plugin_enabled,
                    'non_show_viewer' => $non_show_viewer,
                    'free_show_viewer' => $free_show_viewer,
                    'paid_show_viewer' => $paid_show_viewer,
                    'enable_preview_image' => $enable_preview_image,
                    'preview_image_show_thumb' => $preview_image_show_thumb,
                    'auto_rotate' => $auto_rotate,
                    'enable_preview_document' => $enable_preview_document,
                    'preview_document_pdf_thumbs' => $preview_document_pdf_thumbs,
                    'preview_document_ext' => $preview_document_ext,
                    'enable_preview_video' => $enable_preview_video,
                    'preview_video_ext' => $preview_video_ext,
                    'enable_preview_audio' => $enable_preview_audio,
                    'preview_audio_ext' => $preview_audio_ext,
                                ), $this->getHeaderParams()), PLUGIN_DIRECTORY_ROOT . $folderName . '/views');
    }

}
