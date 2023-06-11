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

/* account/ajax/uploader.html.twig */
class __TwigTemplate_8a37e5c9e07d9eed5e95b23d67d51cfd56ff58158596364ee0be63d86700d7b1 extends \Twig\Template
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
        echo "<div class=\"preLoadImages hidden\">
    <img src=\"";
        // line 2
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountImagePath", [], "method", false, false, false, 2), "html", null, true);
        echo "/delete_small.png\" height=\"1\" width=\"1\"/>
    <img src=\"";
        // line 3
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountImagePath", [], "method", false, false, false, 3), "html", null, true);
        echo "/add_small.gif\" height=\"1\" width=\"1\"/>
    <img src=\"";
        // line 4
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountImagePath", [], "method", false, false, false, 4), "html", null, true);
        echo "/red_error_small.png\" height=\"1\" width=\"1\"/>
    <img src=\"";
        // line 5
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountImagePath", [], "method", false, false, false, 5), "html", null, true);
        echo "/green_tick_small.png\" height=\"1\" width=\"1\"/>
    <img src=\"";
        // line 6
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountImagePath", [], "method", false, false, false, 6), "html", null, true);
        echo "/processing_small.gif\" height=\"1\" width=\"1\"/>
</div>

<div>
    <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">×</button>
    <ul class=\"nav nav-tabs bordered\">
        <li class=\"active\"><a href=\"#fileUpload\" data-toggle=\"tab\">";
        // line 12
        echo twig_escape_filter($this->env, twig_upper_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("file_upload", "file upload")), "html", null, true);
        echo "</a></li>
        ";
        // line 13
        if ((($context["userAllowedToRemoteUpload"] ?? null) == true)) {
            // line 14
            echo "        <li><a href=\"#urlUpload\" data-toggle=\"tab\">";
            echo twig_escape_filter($this->env, twig_upper_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("remote_url_upload", "remote url upload")), "html", null, true);
            echo "</a></li>
        ";
        }
        // line 16
        echo "    </ul>

    <!-- FILE UPLOAD -->
    <div class=\"tab-content\">
        <div id=\"fileUpload\" class=\"tab-pane active\">
            <div class=\"fileUploadMain\">
                <div ";
        // line 22
        if ((($context["userAllowedToUpload"] ?? null) == false)) {
            echo "onClick=\"alert('";
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("index_uploading_disabled", "Error: Uploading has been disabled."), "html", null, true);
            echo "'); return false;\"";
        }
        echo ">
                    <!-- uploader -->
                    <div id=\"uploaderContainer\" class=\"uploader-container\">
                        <div id=\"uploader\">
                            <form action=\"";
        // line 26
        echo twig_escape_filter($this->env, ($context["uploadAction"] ?? null), "html", null, true);
        echo "\" method=\"POST\" enctype=\"multipart/form-data\">
                                <div class=\"fileupload-buttonbar hiddenAlt\">
                                    <label class=\"fileinput-button\">
                                        <span>";
        // line 29
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("add_files", "Add files..."), "html", null, true);
        echo "</span>
                                        ";
        // line 30
        if ((($context["userAllowedToUpload"] ?? null) == true)) {
            // line 31
            echo "                                            <input id=\"add_files_btn\" type=\"file\" name=\"files[]\" multiple/>
                                        ";
        }
        // line 33
        echo "                                    </label>
                                    <button id=\"start_upload_btn\" type=\"submit\" class=\"start\">";
        // line 34
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("start_upload", "Start upload"), "html", null, true);
        echo "</button>
                                    <button id=\"cancel_upload_btn\" type=\"reset\" class=\"cancel\">";
        // line 35
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("cancel_upload", "Cancel upload"), "html", null, true);
        echo "</button>
                                </div>
                                <div class=\"fileupload-content\">
                                    <label for=\"add_files_btn\" id=\"initialUploadSectionLabel\">
                                        <div id=\"initialUploadSection\" class=\"initialUploadSection\"";
        // line 39
        if ((($context["currentBrowserIsIE"] ?? null) == false)) {
            echo " onClick=\"\$('#add_files_btn').click();
                                                    return false;\"";
        }
        // line 40
        echo ">
                                            <div class=\"initialUploadText\">
                                                <div class=\"uploadElement\">
                                                    <div class=\"internal\">
                                                        <img src=\"";
        // line 44
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountImagePath", [], "method", false, false, false, 44), "html", null, true);
        echo "/modal_icons/upload-computer-icon.png\" class=\"upload-icon-image\"/>
                                                        <div class=\"clear\"><!-- --></div>
                                                        ";
        // line 46
        if ((($context["currentBrowserIsIE"] ?? null) == true)) {
            // line 47
            echo "                                                            ";
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("click_here_to_browse_your_files", "Click here to browse your files..."), "html", null, true);
            echo "
                                                        ";
        } else {
            // line 49
            echo "                                                            ";
            echo $this->extensions['App\Services\TTwigExtension']->tHandler("drag_and_drop_files_here_or_click_to_browse", "Drag & drop files here or click to browse...");
            echo "
                                                        ";
        }
        // line 51
        echo "                                                    </div>
                                                </div>
                                            </div>
                                            <div class=\"uploadFooter\">
                                                <div class=\"baseText\">
                                                    <a class=\"showAdditionalOptionsLink\">";
        // line 56
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("options", "options")), "html", null, true);
        echo "</a>&nbsp;&nbsp;|&nbsp;&nbsp;";
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("max_file_size", "Max file size"), "html", null, true);
        echo ": ";
        echo twig_escape_filter($this->env, (((($context["maxUploadSize"] ?? null) > 0)) ? (($context["maxUploadSizeBoth"] ?? null)) : ($this->extensions['App\Services\TTwigExtension']->tHandler("any", "Any"))), "html", null, true);
        echo ".";
        if ((twig_length_filter($this->env, ($context["acceptedFileTypesStr"] ?? null)) > 0)) {
            echo " <span title=\"";
            echo twig_escape_filter($this->env, ($context["acceptedFileTypesStr"] ?? null), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("allowed_file_types", "Allowed file types"), "html", null, true);
            echo " : ";
            echo twig_escape_filter($this->env, ($context["acceptedFileTypesStr"] ?? null), "html", null, true);
            echo "</span>";
        }
        // line 57
        echo "                                                </div>
                                            </div>
                                            <div class=\"clear\"><!-- --></div>
                                        </div>
                                    </label>
                                    <div id=\"fileListingWrapper\" class=\"fileListingWrapper hidden\">
                                        <div class=\"fileSection\">
                                            <div id=\"files\" class=\"files\"></div>
                                            <div id=\"addFileRow\" class=\"addFileRow\">
                                                <div class=\"template-upload template-upload-img\">
                                                    <a href=\"#\"";
        // line 67
        if ((($context["currentBrowserIsIE"] ?? null) == false)) {
            echo " onClick=\"\$('#add_files_btn').click(); return false;\"";
        }
        echo ">
                                                        <i class=\"glyphicon glyphicon-plus\"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class=\"clear\"></div>
                                        </div>

                                        <div id=\"processQueueSection\" class=\"fileSectionFooterText\">
                                            <div class=\"upload-button\">
                                                <button onClick=\"\$('#start_upload_btn').click(); return false;\" class=\"btn btn-green btn-lg\" type=\"button\">";
        // line 77
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("set_upload_queue", "Upload Queue"), "html", null, true);
        echo " <i class=\"entypo-upload\"></i></button>
                                            </div>
                                            <div class=\"baseText\">
                                                <a class=\"showAdditionalOptionsLink\">";
        // line 80
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("options", "options")), "html", null, true);
        echo "</a>&nbsp;&nbsp;|&nbsp;&nbsp;";
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("max_file_size", "Max file size"), "html", null, true);
        echo ": ";
        echo twig_escape_filter($this->env, (((($context["maxUploadSize"] ?? null) > 0)) ? (($context["maxUploadSizeBoth"] ?? null)) : ($this->extensions['App\Services\TTwigExtension']->tHandler("any", "Any"))), "html", null, true);
        echo ".";
        if ((twig_length_filter($this->env, ($context["acceptedFileTypesStr"] ?? null)) > 0)) {
            echo " <span title=\"";
            echo twig_escape_filter($this->env, ($context["acceptedFileTypesStr"] ?? null), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("allowed_file_types", "Allowed file types"), "html", null, true);
            echo " : ";
            echo twig_escape_filter($this->env, ($context["acceptedFileTypesStr"] ?? null), "html", null, true);
            echo "</span>";
        }
        // line 81
        echo "                                            </div>
                                            <div class=\"clear\"><!-- --></div>
                                        </div>

                                        <div id=\"processingQueueSection\" class=\"fileSectionFooterText hidden\">
                                            <div class=\"globalProgressWrapper\">
                                                <div id=\"progress\" class=\"progress progress-striped active\">
                                                    <div style=\"width: 0%\" aria-valuemax=\"100\" aria-valuemin=\"0\" aria-valuenow=\"0\" role=\"progressbar\" class=\"progress-bar progress-bar-info\">
                                                        <span class=\"sr-only\"></span>
                                                    </div>
                                                </div>
                                                <div id=\"fileupload-progresstext\" class=\"fileupload-progresstext\">
                                                    <div id=\"fileupload-progresstextRight\" class=\"file-upload-progress-right\"><!-- --></div>
                                                    <div id=\"fileupload-progresstextLeft\" class=\"file-upload-progress-left\"><!-- --></div>
                                                </div>
                                            </div>
                                            <div class=\"clear\"><!-- --></div>
                                            <div class=\"upload-button\">
                                                <button id=\"hide_modal_btn\" data-dismiss=\"modal\" class=\"btn btn-default btn-lg\" type=\"button\">";
        // line 99
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("set_hide", "Hide"), "html", null, true);
        echo " <i class=\"entypo-arrows-ccw\"></i></button>
                                            </div>
                                            <div class=\"clear\"><!-- --></div>
                                        </div>

                                        <div id=\"completedSection\" class=\"fileSectionFooterText row hidden\">
                                            <div class=\"col-md-12\">
                                                <div class=\"baseText\">
                                                    ";
        // line 107
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("file_upload_completed", "Image uploads completed."), "html", null, true);
        echo " ";
        echo $this->extensions['App\Services\TTwigExtension']->tHandler("index_upload_more_files", "<a href=\"[[[WEB_ROOT]]]\">Click here</a> to upload more files.", ["WEB_ROOT" => "#\" onclick=\"resetUploader(); return false;"]);
        echo "
                                                </div>
                                            </div>
\t\t\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t\t\t\t<div class=\"col-md-12 upload-complete-btns\">
                                                <button class=\"btn btn-info\" type=\"button\" onClick=\"viewFileLinksPopup();
                                                                                                        return false;\">";
        // line 113
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("view_all_links", "View All Links"), "html", null, true);
        echo " <i class=\"entypo-link\"></i></button>
                                                <button data-dismiss=\"modal\" class=\"btn btn-default\" type=\"button\">";
        // line 114
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("set_close", "Close"), "html", null, true);
        echo " <i class=\"entypo-check\"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <script id=\"template-upload\" type=\"text/x-jquery-tmpl\">
                            ";
        // line 122
        echo "{%";
        echo " for (var i=0, file; file=o.files[i]; i++) { ";
        echo "%}";
        echo "
                            <div class=\"template-upload-img template-upload";
        // line 123
        echo "{%";
        echo " if (file.error) { ";
        echo "%}";
        echo " errorText";
        echo "{%";
        echo " } ";
        echo "%}";
        echo "\" id=\"fileUploadRow";
        echo "{%";
        echo "=i";
        echo "%}";
        echo "\" title=\"";
        echo "{%";
        echo "=file.name";
        echo "%}";
        echo "\">
                            ";
        // line 124
        echo "{%";
        echo " if (file.error) { ";
        echo "%}";
        echo "
                            <div class=\"error cancel\" title=\"";
        // line 125
        echo "{%";
        echo "=file.name";
        echo "%}";
        echo "\">
Error:
                            ";
        // line 127
        echo "{%";
        echo "=file.error";
        echo "%}";
        echo "
                            </div>
                            ";
        // line 129
        echo "{%";
        echo " } else { ";
        echo "%}";
        echo "
                            <div class=\"previewOverlay\" title=\"";
        // line 130
        echo "{%";
        echo "=file.name";
        echo "%}";
        echo "\">
                            <div class=\"progressText hidden\"></div>
                            <div class=\"progress hidden\">
                            <div class=\"progress-bar\" role=\"progressbar\" aria-valuenow=\"0\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: 0%;\">
                            </div>
                            </div>
                            </div>
                            <div class=\"previewWrapper\" title=\"";
        // line 137
        echo "{%";
        echo "=file.name";
        echo "%}";
        echo "\">
                            <div class=\"cancel\">
                            <a href=\"#\" onClick=\"return false;\">
                            <img src=\"";
        // line 140
        echo twig_escape_filter($this->env, ($context["SITE_THEME_PATH"] ?? null), "html", null, true);
        echo "/assets/images/delete_small.png\" height=\"10\" width=\"10\" alt=\"delete\"/>
                            </a>
                            </div>
                            <div class=\"preview\" title=\"";
        // line 143
        echo "{%";
        echo "=file.name";
        echo "%}";
        echo "&nbsp;&nbsp;";
        echo "{%";
        echo "=o.formatFileSize(file.size)";
        echo "%}";
        echo "\"><span class=\"fade\"></span></div>
\t\t\t\t\t\t\t<div class=\"filename\" title=\"";
        // line 144
        echo "{%";
        echo "=file.name";
        echo "%}";
        echo "&nbsp;&nbsp;";
        echo "{%";
        echo "=o.formatFileSize(file.size)";
        echo "%}";
        echo "\">";
        echo "{%";
        echo "=file.name";
        echo "%}";
        echo "</div>
                            </div>
                            <div class=\"start hidden\"><button>start</button></div>
                            <div class=\"cancel hidden\"><button>cancel</button></div>
                            ";
        // line 148
        echo "{%";
        echo " } ";
        echo "%}";
        echo "
                            </div>
                            ";
        // line 150
        echo "{%";
        echo " } ";
        echo "%}";
        echo "
                        </script>

                        <script id=\"template-download\" type=\"text/x-jquery-tmpl\"><!-- --></script>

                    </div>
                    <!-- end uploader -->

                </div>

                <div class=\"clear\"><!-- --></div>
            </div>
        </div>

        <!-- URL UPLOAD -->
        ";
        // line 165
        if ((($context["userAllowedToRemoteUpload"] ?? null) == true)) {
            // line 166
            echo "        <div class=\"tab-pane\" id=\"urlUpload\" ";
            if ((($context["userAllowedToUpload"] ?? null) == false)) {
                echo "onClick=\"alert('";
                echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("index_uploading_disabled", "Error: Uploading has been disabled."), "html", null, true);
                echo "'); return false;\"";
            }
            echo ">
            <div class=\"urlUploadMain\">
                <div>
                    <!-- url uploader -->
                    <div>
                        <div id=\"urlFileUploader\">
                            <div class=\"urlFileUploaderWrapper\">
                                <form action=\"#\" method=\"POST\" enctype=\"multipart/form-data\">
                                    <div class=\"initialUploadText\">
                                        <div>
                                            ";
            // line 176
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("file_upload_remote_url_intro", "Download files directly from other sites into your account. Note: If the files are on another file download site or password protected, this may not work."), "html", null, true);
            echo "<br/><br/>
                                        </div>
                                        <div class=\"inputElement\">
                                            <textarea name=\"urlList\" id=\"urlList\" class=\"urlList form-control\" placeholder=\"http://example-site.com/file.jpg\"></textarea>
                                            <div class=\"clear\"><!-- --></div>
                                        </div>
                                    </div>
                                    <div class=\"urlUploadFooter\">
                                        <div class=\"upload-button\">
                                            <button id=\"transferFilesButton\" onClick=\"urlUploadFiles();
                                                return false;\" class=\"btn btn-green btn-lg\" type=\"button\">";
            // line 186
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("set_transfer_files", "Transfer Images"), "html", null, true);
            echo " <i class=\"entypo-upload\"></i></button>
                                        </div>
                                        <div class=\"baseText\">
                                            <a class=\"showAdditionalOptionsLink\">";
            // line 189
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("options", "options")), "html", null, true);
            echo "</a>&nbsp;&nbsp;|&nbsp;&nbsp;";
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("enter_up_to_x_file_urls", "Enter up to [[[MAX_REMOTE_URL_FILES]]] file urls. Separate each url on it's own line.", ["MAX_REMOTE_URL_FILES" => ($context["maxPermittedUrls"] ?? null)]), "html", null, true);
            echo "
                                        </div>
                                    </div>
                                    <div class=\"clear\"><!-- --></div>
                                </form>
                            </div>
                        </div>

                        <div id=\"urlFileListingWrapper\" class=\"urlFileListingWrapper hidden\">
                            <div class=\"fileSection\">
                                <table id=\"urls\" class=\"files table table-striped\">
                                    <tbody>
                                    </tbody>
                                </table>
                                <div class=\"clear\"><!-- --></div>
                                <div class=\"upload-button processing-button\">
                                    <button onClick=\"\$('#start_upload_btn').click(); return false;\" class=\"btn btn-default disabled btn-lg\" type=\"button\">";
            // line 205
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("set_upload_processing", "Processing..."), "html", null, true);
            echo " <i class=\"entypo-arrows-ccw\"></i></button>
                                </div>
                            </div>
                            <div class=\"clear\"><!-- --></div>

                            <div class=\"fileSectionFooterText row hidden\">
                                <div class=\"col-md-12\">
                                    <div class=\"baseText\">
                                        ";
            // line 213
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("file_upload_completed", "Image uploads completed."), "html", null, true);
            echo " ";
            echo $this->extensions['App\Services\TTwigExtension']->tHandler("index_upload_more_files", "<a href=\"[[[WEB_ROOT]]]\">Click here</a> to upload more files.", ["WEB_ROOT" => "#\" onclick=\"resetUploader(); return false;"]);
            echo "
                                    </div>
                                </div>
                                <div class=\"col-md-12 upload-complete-btns\">
                                    <button class=\"btn btn-info\" type=\"button\" onClick=\"viewFileLinksPopup(); return false;\">";
            // line 217
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("view_all_links", "View All Links"), "html", null, true);
            echo " <i class=\"entypo-link\"></i></button>
                                    <button data-dismiss=\"modal\" class=\"btn btn-default\" type=\"button\">";
            // line 218
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("set_close", "Close"), "html", null, true);
            echo " <i class=\"entypo-check\"></i></button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- end url uploader -->

                </div>

                <div class=\"clear\"><!-- --></div>
            </div>
        </div>
        ";
        }
        // line 232
        echo "    </div>

</div>

<div id=\"additionalOptionsWrapper\" class=\"additional-options-wrapper\" style=\"display: none;\">
    <div class=\"row\">
\t\t<div class=\"col-md-2\"></div>
        <div class=\"col-md-4\">
            <div class=\"panel minimal\">
                <div class=\"panel-heading\">
                    <div class=\"panel-title\">
                        ";
        // line 243
        echo twig_escape_filter($this->env, twig_upper_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("send_via_email", "send via email:")), "html", null, true);
        echo "
                    </div>
                </div>
                <div class=\"panel-body\">
                    <p>
                        ";
        // line 248
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("enter_an_email_address_below_to_send_the_list_of_files", "Enter an email address below to send the list of files via email once they're uploaded."), "html", null, true);
        echo "
                    </p>
                    <div class=\"form-group\">
                        <label class=\"control-label\" for=\"send_via_email\">";
        // line 251
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("email_address", "Email Address"), "html", null, true);
        echo ":</label>
                        <input id=\"send_via_email\" name=\"send_via_email\" type=\"text\" class=\"form-control\"/>
                    </div>
                </div>
            </div>
        </div>

        <div class=\"col-md-4\">
            <div class=\"panel minimal\">
                <div class=\"panel-heading\">
                    <div class=\"panel-title\">
                        ";
        // line 262
        echo twig_escape_filter($this->env, twig_upper_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("store_in_folder", "store in folder:")), "html", null, true);
        echo "
                    </div>
                </div>
                <div class=\"panel-body\">
                    <p>
                        ";
        // line 267
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("select_folder_below_to_store_intro_text_files", "Select an folder below to store these files in. All current uploads will be available within these folders."), "html", null, true);
        echo "
                    </p>
                    <div class=\"form-group\">
                        <label class=\"control-label\" for=\"upload_folder_id\">";
        // line 270
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("folder_name", "Folder Name"), "html", null, true);
        echo ":</label>
                        <select id=\"upload_folder_id\" name=\"upload_folder_id\" class=\"form-control\" ";
        // line 271
        echo (((twig_get_attribute($this->env, $this->source, ($context["Auth"] ?? null), "loggedIn", [], "method", false, false, false, 271) == false)) ? ("DISABLED=\"DISABLED\"") : (""));
        echo ">
                            <option value=\"\">";
        // line 272
        echo twig_escape_filter($this->env, (((twig_get_attribute($this->env, $this->source, ($context["Auth"] ?? null), "loggedIn", [], "method", false, false, false, 272) == false)) ? ($this->extensions['App\Services\TTwigExtension']->tHandler("index_login_to_enable", "- login to enable -")) : ($this->extensions['App\Services\TTwigExtension']->tHandler("index_default", "- default -"))), "html", null, true);
        echo "</option>
                            ";
        // line 273
        if ((twig_length_filter($this->env, ($context["folderArr"] ?? null)) > 0)) {
            // line 274
            echo "                                ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["folderArr"] ?? null));
            foreach ($context['_seq'] as $context["folderId"] => $context["folderLabel"]) {
                // line 275
                echo "                                    <option value=\"";
                echo twig_escape_filter($this->env, $context["folderId"], "html", null, true);
                echo "\"";
                echo ((($context["folderId"] == ($context["fid"] ?? null))) ? (" SELECTED") : (""));
                echo ">";
                echo twig_escape_filter($this->env, $context["folderLabel"], "html", null, true);
                echo "</option>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['folderId'], $context['folderLabel'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 277
            echo "                            ";
        }
        // line 278
        echo "                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class=\"col-md-2\"></div>

        <input id=\"set_password\" name=\"set_password\" type=\"password\" type=\"text\" class=\"form-control\" value=\"\" style=\"display: none;\"/>
    </div>
    <div class=\"row\">
        <div class=\"col-md-12\">
            <div class=\"footer-buttons\">
                <button onClick=\"showAdditionalOptions(true);
                        return false;\" class=\"btn btn-default\" type=\"button\">";
        // line 292
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("set_cancel", "Cancel"), "html", null, true);
        echo "</button>
                <button onClick=\"saveAdditionalOptions();
                        return false;\" class=\"btn btn-info\" type=\"button\">";
        // line 294
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("set_save_and_close", "Save Options"), "html", null, true);
        echo " <i class=\"entypo-check\"></i></button>
            </div>
        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "account/ajax/uploader.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  627 => 294,  622 => 292,  606 => 278,  603 => 277,  590 => 275,  585 => 274,  583 => 273,  579 => 272,  575 => 271,  571 => 270,  565 => 267,  557 => 262,  543 => 251,  537 => 248,  529 => 243,  516 => 232,  499 => 218,  495 => 217,  486 => 213,  475 => 205,  454 => 189,  448 => 186,  435 => 176,  417 => 166,  415 => 165,  395 => 150,  388 => 148,  371 => 144,  361 => 143,  355 => 140,  347 => 137,  335 => 130,  329 => 129,  322 => 127,  315 => 125,  309 => 124,  291 => 123,  285 => 122,  274 => 114,  270 => 113,  259 => 107,  248 => 99,  228 => 81,  212 => 80,  206 => 77,  191 => 67,  179 => 57,  163 => 56,  156 => 51,  150 => 49,  144 => 47,  142 => 46,  137 => 44,  131 => 40,  126 => 39,  119 => 35,  115 => 34,  112 => 33,  108 => 31,  106 => 30,  102 => 29,  96 => 26,  85 => 22,  77 => 16,  71 => 14,  69 => 13,  65 => 12,  56 => 6,  52 => 5,  48 => 4,  44 => 3,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "account/ajax/uploader.html.twig", "/var/www/html/medicalimage/themes/evolution/views/account/ajax/uploader.html.twig");
    }
}
