<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* account/ajax/share_file_folder.html.twig */
class __TwigTemplate_907b5e57421896e2ec2b99e54b0a004b7a0bad0a5aa6125d7701f463647beb92 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        ob_start(function () { return ''; });
        // line 2
        echo "    <!-- just add href= for your links, like this: -->
    <a onclick=\"return checkSocialLink(this);\" href=\"https://www.facebook.com/sharer/sharer.php?u=";
        // line 3
        echo twig_escape_filter($this->env, ($context["shareLink"] ?? null), "html", null, true);
        echo "\" data-placement=\"bottom\" data-toggle=\"tooltip\" data-original-title=\"";
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("share_on", "Share On"), "html", null, true);
        echo " Facebook\" target=\"_blank\" class=\"btn btn-social-icon btn-facebook\"><i class=\"fa fa-facebook\"></i></a>
    <a onclick=\"return checkSocialLink(this);\" href=\"https://twitter.com/share?url=";
        // line 4
        echo twig_escape_filter($this->env, ($context["shareLink"] ?? null), "html", null, true);
        echo "\" data-placement=\"bottom\" data-toggle=\"tooltip\" data-original-title=\"";
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("share_on", "Share On"), "html", null, true);
        echo " Twitter\" target=\"_blank\" class=\"btn btn-social-icon btn-twitter\"><i class=\"fa fa-twitter\"></i></a>\t\t\t\t\t\t\t
    <a onclick=\"return checkSocialLink(this);\" href=\"https://www.linkedin.com/cws/share?url=";
        // line 5
        echo twig_escape_filter($this->env, ($context["shareLink"] ?? null), "html", null, true);
        echo "\" data-placement=\"bottom\" data-toggle=\"tooltip\" data-original-title=\"";
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("share_on", "Share On"), "html", null, true);
        echo " Linkedin\" target=\"_blank\" class=\"btn btn-social-icon btn-linkedin\"><i class=\"fa fa-linkedin\"></i></a>

    <a onclick=\"return checkSocialLink(this);\" href=\"http://reddit.com/submit?url=";
        // line 7
        echo twig_escape_filter($this->env, ($context["shareLink"] ?? null), "html", null, true);
        echo "&title=";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["fileFolder"] ?? null), "folderName", [], "any", false, false, false, 7), "html", null, true);
        echo "\" data-placement=\"bottom\" data-toggle=\"tooltip\" data-original-title=\"";
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("share_on", "Share On"), "html", null, true);
        echo " Reddit\" target=\"_blank\" class=\"btn btn-social-icon btn-reddit\"><i class=\"fa fa-reddit-alien\"></i></a>
    <a onclick=\"return checkSocialLink(this);\" href=\"http://www.stumbleupon.com/submit?url=";
        // line 8
        echo twig_escape_filter($this->env, ($context["shareLink"] ?? null), "html", null, true);
        echo "&title=";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["fileFolder"] ?? null), "folderName", [], "any", false, false, false, 8), "html", null, true);
        echo "\" data-placement=\"bottom\" data-toggle=\"tooltip\" data-original-title=\"";
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("share_on", "Share On"), "html", null, true);
        echo " StumbleUpon\" target=\"_blank\" class=\"btn btn-social-icon btn-stumbleupon\"><i class=\"fa fa-stumbleupon\"></i></a>
    <a onclick=\"return checkSocialLink(this);\" href=\"http://digg.com/submit?url=";
        // line 9
        echo twig_escape_filter($this->env, ($context["shareLink"] ?? null), "html", null, true);
        echo "&title=";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["fileFolder"] ?? null), "folderName", [], "any", false, false, false, 9), "html", null, true);
        echo "\" data-placement=\"bottom\" data-toggle=\"tooltip\" data-original-title=\"";
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("share_on", "Share On"), "html", null, true);
        echo " Digg\" target=\"_blank\" class=\"btn btn-social-icon btn-digg\"><i class=\"fa fa-digg\"></i></a>
    <a onclick=\"return checkSocialLink(this);\" href=\"https://www.tumblr.com/widgets/share/tool?canonicalUrl=";
        // line 10
        echo twig_escape_filter($this->env, ($context["shareLink"] ?? null), "html", null, true);
        echo "&title=";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["fileFolder"] ?? null), "folderName", [], "any", false, false, false, 10), "html", null, true);
        echo "&caption=";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["fileFolder"] ?? null), "folderName", [], "any", false, false, false, 10), "html", null, true);
        echo "\" data-placement=\"bottom\" data-toggle=\"tooltip\" data-original-title=\"";
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("share_on", "Share On"), "html", null, true);
        echo " Tumblr\" target=\"_blank\" class=\"btn btn-social-icon btn-tumblr\"><i class=\"fa fa-tumblr\"></i></a>
    ";
        $context["share_urls_template"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 12
        echo "
<script>loadExistingInternalShareTable(";
        // line 13
        echo twig_escape_filter($this->env, json_encode(($context["fileIds"] ?? null)), "html", null, true);
        echo ", ";
        echo twig_escape_filter($this->env, json_encode(($context["folderIds"] ?? null)), "html", null, true);
        echo ");</script>

<div class=\"modal-header\">
    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
    <h4 class=\"modal-title\">
        ";
        // line 18
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("share", "share")), "html", null, true);
        echo " 
        ";
        // line 19
        if ((($context["fileFolderCount"] ?? null) > 0)) {
            echo twig_escape_filter($this->env, ($context["fileFolderCount"] ?? null), "html", null, true);
            echo " 
            ";
            // line 20
            if ((($context["fileFolderCount"] ?? null) == 1)) {
                // line 21
                echo "                ";
                echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("folder", "folder")), "html", null, true);
                echo "
            ";
            } else {
                // line 23
                echo "                ";
                echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("folders", "folders")), "html", null, true);
                echo "
            ";
            }
            // line 25
            echo "        ";
        }
        // line 26
        echo "        ";
        if (((($context["fileFolderCount"] ?? null) > 0) && (($context["fileCount"] ?? null) > 0))) {
            echo " &amp; ";
        }
        // line 27
        echo "        ";
        if ((($context["fileCount"] ?? null) > 0)) {
            echo twig_escape_filter($this->env, ($context["fileCount"] ?? null), "html", null, true);
            echo " 
            ";
            // line 28
            if ((($context["fileCount"] ?? null) == 1)) {
                // line 29
                echo "                ";
                echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("file", "file")), "html", null, true);
                echo "
            ";
            } else {
                // line 31
                echo "                ";
                echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("files", "files")), "html", null, true);
                echo "
            ";
            }
            // line 33
            echo "        ";
        }
        // line 34
        echo "    </h4>
</div>

<div class=\"modal-body\">
    <div class=\"row\">

        <div class=\"col-md-3\">
            <div class=\"modal-icon-left\"><img src=\"";
        // line 41
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountImagePath", [], "method", false, false, false, 41), "html", null, true);
        echo "/modal_icons/share.png\"/></div>
        </div>

        <div class=\"col-md-9\">
            <!-- Nav tabs -->
            <ul class=\"nav nav-tabs\" role=\"tablist\">
                <li role=\"presentation\" class=\"active\"><a href=\"#publicshare\" aria-controls=\"publicshare\" role=\"tab\" data-toggle=\"tab\"><i class=\"entypo-share\"></i> ";
        // line 47
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("externally_share", "Externally Share"), "html", null, true);
        echo "</a></li>
                <li role=\"presentation\"><a href=\"#usershare\" aria-controls=\"usershare\" role=\"tab\" data-toggle=\"tab\"><i class=\"entypo-user-add\"></i> ";
        // line 48
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("internal_user", "Internal User"), "html", null, true);
        echo "</a></li>
                <li role=\"presentation\"><a href=\"#viaemail\" aria-controls=\"viaemail\" role=\"tab\" data-toggle=\"tab\"><i class=\"entypo-mail\"></i> ";
        // line 49
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("share_send_via_email", "Send via Email"), "html", null, true);
        echo "</a></li>
                <li role=\"presentation\"><a href=\"#printQR\" aria-controls=\"details\" role=\"tab\" data-toggle=\"tab\"><i class=\"fa fa-print\"></i><span> Print QR</span></a></li>
            </ul>

            <div class=\"tab-content\">
                <div role=\"tabpanel\" class=\"tab-pane\" id=\"usershare\">
                    <div class=\"row\">
                        <div class=\"col-md-12\" style=\"margin-bottom: 20px;\">
                            <p>";
        // line 57
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("edit_folder_internal_share_intro", "You can internally share this folder with other users on the site. Simply enter their email address and permission level below. They'll see the new folder listed, along with any sub-folders, within their file manager."), "html", null, true);
        echo "</p>
                            <p>";
        // line 58
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("edit_folder_internal_share_intro_2", "You can share with more than 1 user at a time by comma separating each email address."), "html", null, true);
        echo "</p>
                        </div>
                    </div>
                    <div class=\"row\">
                        <form action=\"";
        // line 62
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountWebRoot", [], "method", false, false, false, 62), "html", null, true);
        echo "/ajax/email_folder_url\" autocomplete=\"off\">
                            <div class=\"col-md-12\">
                                <div class=\"form-group\" style=\"margin-bottom: 7px;\">
                                    <label for=\"registeredEmailAddress\" class=\"control-label\">";
        // line 65
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("edit_folder_internal_share_email", "Registered Email Address:"), "html", null, true);
        echo "</label>
                                    <div class=\"input-group\">
                                        <input type=\"text\" class=\"form-control\" name=\"registeredEmailAddress\" id=\"registeredEmailAddress\" placeholder=\"";
        // line 67
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("recipient_email_address", "recipient email address")), "html", null, true);
        echo "\"/>
                                        <span class=\"input-group-btn\">
                                            <button id=\"shareFolderInternallyBtn\" type=\"button\" class=\"btn btn-info\" onClick=\"shareFolderInternally(";
        // line 69
        echo twig_escape_filter($this->env, json_encode(($context["fileIds"] ?? null)), "html", null, true);
        echo ", ";
        echo twig_escape_filter($this->env, json_encode(($context["folderIds"] ?? null)), "html", null, true);
        echo "); return false;\">";
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("grant_access", "grant access")), "html", null, true);
        echo " <i class=\"entypo-lock\"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class=\"col-md-12\">
                                <div class=\"form-group\">
                                    <div class=\"row\">
                                        <div class=\"col-md-12\" style=\"margin: 6px;\">
                                            <div class=\"radio radio-replace color-blue\" style=\"display: inline-block;\"> <input type=\"radio\" id=\"permission_radio_view\" name=\"permission_radio\" value=\"view\" checked=\"\"><label> ";
        // line 78
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("view_only", "View Only"), "html", null, true);
        echo "</label> </div>
                                            <div class=\"radio radio-replace color-blue\" style=\"display: inline-block; margin-left: 20px;\"> <input type=\"radio\" id=\"permission_radio_upload_download\" name=\"permission_radio\" value=\"upload_download\"> <label> ";
        // line 79
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("upload_download_and_view", "Upload, Download & View"), "html", null, true);
        echo "</label></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class=\"row\">
                        <div id=\"existingInternalShareTable\" class=\"col-md-12\" style=\"margin-top: 20px;\"></div>
                    </div>
                </div>

                <div class=\"tab-pane file-details-sharing-code\" id=\"printQR\" style=\"text-align: center;\">
                    <h4 style=\"text-align: center;\"><strong>QR Code</strong></h4><br>
                    <a class=\"btn btn-default\" onClick=\"generateFolderSharingUrlGibran(";
        // line 94
        echo twig_escape_filter($this->env, json_encode(($context["fileIds"] ?? null)), "html", null, true);
        echo ", ";
        echo twig_escape_filter($this->env, json_encode(($context["folderIds"] ?? null)), "html", null, true);
        echo "); return false;\">Generate URL <i class=\"glyphicon glyphicon-refresh\"></i></a>
                    <a class=\"btn btn-default\" id=\"buttonprint\" disabled target=\"_blank\">Print QR Code</a>
                    <img width=\"200\" height=\"200\" class=\"img-rounded\" alt=\"";
        // line 96
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "qrcode", [], "any", false, false, false, 96), "html", null, true);
        echo "\" src=\"";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "qrcode", [], "any", false, false, false, 96), "html", null, true);
        echo "\" id=\"imgQR\" style=\"display:none\"/></a>                                
                    <script>
                        function generateFolderSharingUrlGibran(fileIds, folderIds)
                        {
                                \$.ajax({
                                    dataType: \"json\",
                                    method: \"post\",
                                    url: \"//image.radmed.co.id/account/ajax/generate_folder_sharing_url\",
                                    data: {fileIds: fileIds, folderIds: folderIds},
                                    success: function (data) {
                                        if (data.error == true)
                                        {
                                            showErrorNotification('Error', data.msg);
                                        }
                                        else
                                        {
                                            \$('#imgQR').attr('src','/plugins/phpqrcode/qrcode/'+data.file);
                                            \$('#imgQR').show();
                                            \$('#buttonprint').attr('href','//image.radmed.co.id/plugins/phpqrcode/printQR.php?id='+data.file);
                                            \$('#buttonprint').attr('disabled', false);
                                            \$('#sharingUrlInput').html(data.msg);
                                            \$('#shareEmailSharingUrl').html(data.msg);
                                            \$('#nonPublicSharingUrls').fadeIn();
                                            \$('#nonPublicSharingUrls').html(\$('.social-wrapper-template').html().replace(/SHARE_LINK/g, data.msg));
                                            \$('#nonPublicSharingUrls').removeClass('disabled');
                                            createdUrl = true;
                                        }
                                    }
                                });
                        }
                    </script>
                </div>
                <div role=\"tabpanel\" class=\"tab-pane active\" id=\"publicshare\">
                    <div class=\"row\">
                        <div class=\"col-md-12\" style=\"margin-bottom: 20px;\">
                            <p>
                                ";
        // line 132
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("share_items_intro_text_non_account", "Use the form below to generate a unique sharing url for the selected items. This will provide access to view and download the files without needing an account. Note that sharing a folder will also grant access to any sub-folders/files."), "html", null, true);
        echo "
                            </p>
                        </div>
                    </div>

                    <div class=\"row\">
                        <div class=\"col-md-12\">
                            <div class=\"form-group\">
                                <label for=\"folderName\" class=\"control-label\">";
        // line 140
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("edit_folder_sharing_url", "Sharing Url:"), "html", null, true);
        echo "</label>
                                <div class=\"input-group\">
                                    <pre style=\"margin: 0px; cursor: pointer; white-space: normal;\"><section id=\"sharingUrlInput\" onClick=\"selectAllText(this); return false;\">";
        // line 142
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("click_refresh_button_to_generate", "Click 'refresh' button to generate..."), "html", null, true);
        echo "</section></pre>
                                    <span class=\"input-group-btn\" style=\"vertical-align: top;\">
                                        <button type=\"button\" class=\"btn btn-primary\" onClick=\"generateFolderSharingUrl(";
        // line 144
        echo twig_escape_filter($this->env, json_encode(($context["fileIds"] ?? null)), "html", null, true);
        echo ", ";
        echo twig_escape_filter($this->env, json_encode(($context["folderIds"] ?? null)), "html", null, true);
        echo "); return false;\" title=\"";
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("click_to_generate_sharing_url", "Click to generate the sharing url..."), "html", null, true);
        echo "\" style=\"padding: 7px 12px;\"><i class=\"glyphicon glyphicon-refresh\"></i></button>
                                    </span>
                                </div>

                                <div id=\"nonPublicSharingUrls\" class=\"social-wrapper disabled\">
                                    ";
        // line 149
        echo twig_escape_filter($this->env, ($context["share_urls_template"] ?? null), "html", null, true);
        echo "
                                </div>

                                <div class=\"social-wrapper-template\" style=\"display: none;\">
                                    ";
        // line 153
        echo twig_escape_filter($this->env, ($context["share_urls_template"] ?? null), "html", null, true);
        echo "
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class=\"row\">
                        <div class=\"col-md-12\" style=\"margin-top: 14px;\">
                            <p>";
        // line 161
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("sharing_you_can_also_set_a_folder_as_public_text", "You can also set individual folders as 'public' so they can be accessed without the need to generate sharing urls. See the 'edit folder' popup to enable this."), "html", null, true);
        echo "</p>
                        </div>
                    </div>
                </div>
                <div role=\"tabpanel\" class=\"tab-pane\" id=\"viaemail\">\t\t\t\t\t
                    <div class=\"row\">
                        <form action=\"";
        // line 167
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountWebRoot", [], "method", false, false, false, 167), "html", null, true);
        echo "/ajax/email_folder_url\" autocomplete=\"off\">
                            <div class=\"col-md-12\">
                                <div class=\"form-group\" style=\"margin-bottom: 7px;\">
                                    <!--<label for=\"shareSubject\" class=\"control-label\">";
        // line 170
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("edit_share_subject", "Subject Email :"), "html", null, true);
        echo "</label>
                                    <div class=\"input-group\" style=\"width: 80%;\">
                                        <input type=\"text\" class=\"form-control\" name=\"shareSubject\" id=\"shareSubject\" placeholder=\"";
        // line 172
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("share_subject", "Subject Email")), "html", null, true);
        echo "\"/>
                                    </div>--!>
                                    <label for=\"shareResult\" class=\"control-label\">";
        // line 174
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("edit_share_resultw", "Examination Result :"), "html", null, true);
        echo "</label>
                                    <div class=\"input-group\" style=\"width: 80%;\">
                                        <input type=\"text\" class=\"form-control\" name=\"shareResult\" id=\"shareResult\" placeholder=\"";
        // line 176
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("share_result", "what result is ?")), "html", null, true);
        echo "\"/>
                                    </div>
                                    <label for=\"shareName\" class=\"control-label\">";
        // line 178
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("edit_recipient_name", "Reciepent Name:"), "html", null, true);
        echo "</label>
                                    <div class=\"input-group\" style=\"width: 80%;\">
                                        <input type=\"text\" class=\"form-control\" name=\"shareName\" id=\"shareName\" placeholder=\"";
        // line 180
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("recipient_name", "recipient name")), "html", null, true);
        echo "\"/>
                                    </div>
                                    <label for=\"shareCheckUpDate\" class=\"control-label\">Date Check Up:</label>
                                    <div class=\"input-group\" style=\"width: 80%;\">
                                        <input type=\"date\" class=\"form-control\" name=\"shareCheckUpDate\" id=\"shareCheckUpDate\" placeholder=\"";
        // line 184
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("date_label_share", "")), "html", null, true);
        echo "\"/>
                                    </div>
                                    <label for=\"shareEmailAddress\" class=\"control-label\">";
        // line 186
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("edit_folder_send_via_email", "Send via Email:"), "html", null, true);
        echo "</label>
                                    <div class=\"input-group\">
                                        <input type=\"text\" class=\"form-control\" name=\"shareEmailAddress\" id=\"shareEmailAddress\" placeholder=\"";
        // line 188
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("input_date_share", "recipient email address")), "html", null, true);
        echo "\"/>
                                        <span class=\"input-group-btn\">
                                            <button type=\"button\" class=\"btn btn-info\" onClick=\"processAjaxForm(this, function () {
                                                                                                    \$('#shareEmailAddress').val('');
                                                                                                    \$('#shareExtraMessage').val('');
                                                                                                });
                                                                                                return false;\">";
        // line 194
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("send_email", "send email")), "html", null, true);
        echo " <i class=\"entypo-mail\"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class=\"col-md-12\">
                                <div class=\"form-group\">
                                    <!--<textarea id=\"shareExtraMessage\" name=\"shareExtraMessage\" class=\"form-control\" placeholder=\"";
        // line 201
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("extra_message", "extra message (optional)")), "html", null, true);
        echo "\"></textarea>--!>
                                    <input type=\"hidden\" name=\"submitme\" id=\"submitme\" value=\"1\"/>
                                    ";
        // line 203
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["fileIds"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["fileId"]) {
            // line 204
            echo "                                        <input type=\"hidden\" value=\"";
            echo twig_escape_filter($this->env, $context["fileId"], "html", null, true);
            echo "\" name=\"fileIds[]\"/>
                                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['fileId'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 206
        echo "                                    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["folderIds"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["folderId"]) {
            // line 207
            echo "                                        <input type=\"hidden\" value=\"";
            echo twig_escape_filter($this->env, $context["folderId"], "html", null, true);
            echo "\" name=\"folderIds[]\"/>
                                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['folderId'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 209
        echo "                                </div>
                            </div>
                        </form>
                    </div>

                    <div class=\"row\">
                        <div class=\"col-md-12\" style=\"margin-top: 14px;\">
                            <p>";
        // line 216
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("sharing_you_can_also_set_a_folder_as_public_text", "You can also set individual folders as 'public' so they can be accessed without the need to generate sharing urls. See the 'edit folder' popup to enable this."), "html", null, true);
        echo "</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<div class=\"modal-footer\">
    <button type=\"button\" class=\"btn btn-info\" data-dismiss=\"modal\">";
        // line 228
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("close", "close"), "html", null, true);
        echo "</button>
</div>";
    }

    public function getTemplateName()
    {
        return "account/ajax/share_file_folder.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  496 => 228,  481 => 216,  472 => 209,  463 => 207,  458 => 206,  449 => 204,  445 => 203,  440 => 201,  430 => 194,  421 => 188,  416 => 186,  411 => 184,  404 => 180,  399 => 178,  394 => 176,  389 => 174,  384 => 172,  379 => 170,  373 => 167,  364 => 161,  353 => 153,  346 => 149,  334 => 144,  329 => 142,  324 => 140,  313 => 132,  272 => 96,  265 => 94,  247 => 79,  243 => 78,  227 => 69,  222 => 67,  217 => 65,  211 => 62,  204 => 58,  200 => 57,  189 => 49,  185 => 48,  181 => 47,  172 => 41,  163 => 34,  160 => 33,  154 => 31,  148 => 29,  146 => 28,  140 => 27,  135 => 26,  132 => 25,  126 => 23,  120 => 21,  118 => 20,  113 => 19,  109 => 18,  99 => 13,  96 => 12,  85 => 10,  77 => 9,  69 => 8,  61 => 7,  54 => 5,  48 => 4,  42 => 3,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "account/ajax/share_file_folder.html.twig", "/var/www/html/medicalimage/themes/evolution/views/account/ajax/share_file_folder.html.twig");
    }
}
