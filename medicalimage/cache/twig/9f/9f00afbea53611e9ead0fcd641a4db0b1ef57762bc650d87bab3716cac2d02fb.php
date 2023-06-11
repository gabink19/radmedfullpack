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

/* account/ajax/add_edit_folder.html.twig */
class __TwigTemplate_dac00a95ea7018eabd8684aab711da7e43ce5e76defa8c2b4973a2fcf31302aa extends \Twig\Template
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
        echo "<form action=\"";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountWebRoot", [], "method", false, false, false, 1), "html", null, true);
        echo "/ajax/add_edit_folder_process\" autocomplete=\"off\">
    <div class=\"modal-header\">
        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
        <h4 class=\"modal-title\">";
        // line 4
        echo twig_escape_filter($this->env, (((($context["editFolderId"] ?? null) == null)) ? ($this->extensions['App\Services\TTwigExtension']->tHandler("add_folder", "add folder")) : (((($this->extensions['App\Services\TTwigExtension']->tHandler("edit_existing_folder", "Edit Existing Folder") . " (") . ($context["folderName"] ?? null)) . ")"))), "html", null, true);
        echo "</h4>
    </div>

    <div class=\"modal-body\">
        <div class=\"row\">

            <div class=\"col-md-3\">
                <div class=\"modal-icon-left\"><img src=\"";
        // line 11
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountImagePath", [], "method", false, false, false, 11), "html", null, true);
        echo "/modal_icons/folder_yellow_";
        echo (((($context["editFolderId"] ?? null) == null)) ? ("plus") : ("edit"));
        echo ".png\"/></div>
            </div>

            <div class=\"col-md-9\">\t\t\t\t
                <div class=\"row\">
                    <div class=\"col-md-12\">
                        <div class=\"form-group\">
                            <label for=\"folderName\" class=\"control-label\">";
        // line 18
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("edit_folder_name", "Folder Name:"), "html", null, true);
        echo "</label>
                            <input type=\"text\" class=\"form-control\" name=\"folderName\" id=\"folderName\" value=\"";
        // line 19
        echo twig_escape_filter($this->env, ($context["folderName"] ?? null), "html", null, true);
        echo "\"/>
                        </div>
                    </div>
                </div>

                <div class=\"row\">
                    <div class=\"col-md-6\">
                        <div class=\"form-group\">
                            <label for=\"parentId\" class=\"control-label\">";
        // line 27
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("edit_folder_parent_folder", "Parent Folder:"), "html", null, true);
        echo "</label>
                            <select class=\"form-control\" name=\"parentId\" id=\"parentId\">
                                <option value=\"-1\">";
        // line 29
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("_none_", "- none -"), "html", null, true);
        echo "</option>
                                ";
        // line 30
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["folderListing"] ?? null));
        foreach ($context['_seq'] as $context["k"] => $context["folderListingItem"]) {
            // line 31
            echo "                                    ";
            if (((($context["editFolderId"] ?? null) != null) && (twig_slice($this->env, $context["folderListingItem"], 0, twig_length_filter($this->env, ($context["currentFolderStr"] ?? null))) == ($context["currentFolderStr"] ?? null)))) {
                // line 32
                echo "                                    ";
            } else {
                // line 33
                echo "                                        <option value=\"";
                echo twig_escape_filter($this->env, $context["k"], "html", null, true);
                echo "\"";
                if ((($context["parentId"] ?? null) == $context["k"])) {
                    echo " SELECTED";
                }
                echo ">
                                            ";
                // line 34
                echo twig_escape_filter($this->env, $context["folderListingItem"], "html", null, true);
                echo "
                                        </option>
                                    ";
            }
            // line 37
            echo "                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['k'], $context['folderListingItem'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 38
        echo "                            </select>
                        </div>
                    </div>

                    <div class=\"col-md-6\">
                        <div class=\"form-group\">
                            <label for=\"isPublic\" class=\"control-label\">";
        // line 44
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("edit_folder_privacy", "Folder Privacy:"), "html", null, true);
        echo "</label>            
                            <select class=\"form-control\" name=\"isPublic\" id=\"isPublic\"";
        // line 45
        if ((($context["editFolderId"] ?? null) != null)) {
            echo " onchange=\"togglePublicAccessUrl(); return false;\"";
        }
        echo ">
                                ";
        // line 46
        if ((($context["userIsPublic"] ?? null) != 0)) {
            // line 47
            echo "                                    <option value=\"1\" ";
            echo (((($context["isPublic"] ?? null) == 1)) ? ("SELECTED") : (""));
            echo ">";
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("privacy_public_limited_access", "Public - Access if users know the folder url."), "html", null, true);
            echo "</option>
                                ";
        }
        // line 49
        echo "                                <option value=\"0\" ";
        echo (((($context["isPublic"] ?? null) == 0)) ? ("SELECTED") : (""));
        echo ">";
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("privacy_private_no_access", "Private - No access outside of your account, unless you generate a unique access url."), "html", null, true);
        echo "</option>
                            </select>
                        </div>
                    </div>
                            
                    ";
        // line 54
        if ((($context["userIsPublic"] ?? null) == 0)) {
            // line 55
            echo "                        <div class=\"col-md-12\">
                            <div class=\"form-group\">
                                <p>
                                    ";
            // line 58
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("edit_folder_privacy_notice_note", "Note: You can not update this folder privacy settings as your account settings are set to make all files private, or the parent folder is set to private."), "html", null, true);
            echo "
                                </p>
                            </div>
                        </div>
                    ";
        }
        // line 63
        echo "                </div>
                
                ";
        // line 65
        if ((twig_length_filter($this->env, ($context["folderUrl"] ?? null)) > 0)) {
            // line 66
            echo "                <div class=\"row public-access-url\"";
            if ((($context["isPublic"] ?? null) != 1)) {
                echo " style=\"display: none;\"";
            }
            echo ">
                    <div class=\"col-md-12\">
                        <div class=\"form-group\">
                            <label for=\"folderName\" class=\"control-label\">";
            // line 69
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("edit_folder_public_access_url", "Public Access Url:"), "html", null, true);
            echo "</label>
                            <div class=\"input-group\">
                                <pre style=\"margin: 0px; cursor: pointer; white-space: normal;\"><section onClick=\"selectAllText(this); return false;\" id=\"folderUrlSection\">";
            // line 71
            echo twig_escape_filter($this->env, ($context["folderUrl"] ?? null), "html", null, true);
            echo "</section></pre>
                                <span class=\"input-group-btn\" style=\"vertical-align: top;\">
                                    <button id=\"copyToClipboardBtn\" type=\"button\" class=\"btn btn-primary\" data-clipboard-action=\"copy\" data-clipboard-target=\"#folderUrlSection\" style=\"padding: 7px 12px;\" data-placement=\"bottom\" data-toggle=\"tooltip\" data-original-title=\"Copy Url to Clipboard\" onClick=\"copyToClipboard('#copyToClipboardBtn'); return false;\"><i class=\"entypo-clipboard\"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                ";
        }
        // line 80
        echo "
                <div class=\"row\">
                    <div class=\"col-md-4\">
                        <div class=\"form-group\">
                            <label for=\"accessPassword\" class=\"control-label\">";
        // line 84
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("edit_folder_optional_password", "Optional Password:"), "html", null, true);
        echo "</label>
                            <div class=\"row\">
                                <div class=\"col-md-3 inline-checkbox\">
                                    <input type=\"checkbox\" name=\"enablePassword\" id=\"enablePassword\" value=\"1\" ";
        // line 87
        echo (((twig_length_filter($this->env, ($context["accessPassword"] ?? null)) > 0)) ? ("CHECKED") : (""));
        echo " onClick=\"toggleFolderPasswordField();\">
                                </div>
                                <div class=\"col-md-9\">
                                    <input type=\"password\" class=\"form-control\" name=\"password\" id=\"password\" autocomplete=\"off\"";
        // line 90
        echo (((twig_length_filter($this->env, ($context["accessPassword"] ?? null)) > 0)) ? (" value=\"**********\"") : (""));
        echo " ";
        echo (((twig_length_filter($this->env, ($context["accessPassword"] ?? null)) > 0)) ? ("") : ("READONLY"));
        echo "/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=\"col-md-4\">
                        <div class=\"form-group\">
                            <label for=\"watermarkPreviews\" class=\"control-label\">";
        // line 97
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("edit_folder_watermark_image_previews", "Watermark Image Previews:"), "html", null, true);
        echo " *</label>            
                            <select class=\"form-control\" name=\"watermarkPreviews\" id=\"watermarkPreviews\">
                                <option value=\"1\" ";
        // line 99
        echo (((($context["watermarkPreviews"] ?? null) == 1)) ? ("SELECTED") : (""));
        echo ">";
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("option_yes", "Yes"), "html", null, true);
        echo "</option>
                                <option value=\"0\" ";
        // line 100
        echo (((($context["watermarkPreviews"] ?? null) == 0)) ? ("SELECTED") : (""));
        echo ">";
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("option_no", "No"), "html", null, true);
        echo "</option>
                            </select>
                        </div>
                    </div>
                    <div class=\"col-md-4\">
                        <div class=\"form-group\">
                            <label for=\"showDownloadLinks\" class=\"control-label\">";
        // line 106
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("edit_folder_allow_download_links", "Allow Downloading When Shared:"), "html", null, true);
        echo "</label>            
                            <select class=\"form-control\" name=\"showDownloadLinks\" id=\"showDownloadLinks\">
                                <option value=\"1\" ";
        // line 108
        echo (((($context["showDownloadLinks"] ?? null) == 1)) ? ("SELECTED") : (""));
        echo ">";
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("option_yes", "Yes"), "html", null, true);
        echo "</option>
                                <option value=\"0\" ";
        // line 109
        echo (((($context["showDownloadLinks"] ?? null) == 0)) ? ("SELECTED") : (""));
        echo ">";
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("option_no", "No"), "html", null, true);
        echo "</option>
                            </select>
                        </div>
                    </div>
                    <div class=\"col-md-4\"></div>
                </div>

                <div class=\"row\">
                    <div class=\"col-md-12\">
                        <div class=\"form-group\">
                            <p style=\"color: #aaa;\">
                                ";
        // line 120
        echo $this->extensions['App\Services\TTwigExtension']->tHandler("edit_folder_watermark_notice_extra_v2", "* You can set or update your watermark via your <a href=\"[[[ACCOUNT_WEB_ROOT]]]/edit\">account settings</a> page. The original images will not be watermarked.", ["ACCOUNT_WEB_ROOT" => twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountWebRoot", [], "method", false, false, false, 120)]);
        echo "
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class=\"modal-footer\">
        <input type=\"hidden\" name=\"submitme\" id=\"submitme\" value=\"1\"/>
        ";
        // line 131
        if ((($context["editFolderId"] ?? null) != null)) {
            // line 132
            echo "            <input type=\"hidden\" value=\"";
            echo twig_escape_filter($this->env, ($context["editFolderId"] ?? null), "html", null, true);
            echo "\" name=\"editFolderId\"/>
        ";
        }
        // line 134
        echo "
        <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">";
        // line 135
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("cancel", "cancel")), "html", null, true);
        echo "</button>
        <button type=\"button\" class=\"btn btn-info\" data-submit-btn=\"true\" onClick=\"processAjaxForm(this, function (data) {
                ";
        // line 137
        if ((($context["editFolderId"] ?? null) == null)) {
            echo "setUploaderFolderList(data['folder_listing_html']);loadImages(currentPageType, data['folder_id']);";
        }
        echo " refreshFolderListing(false);\$('.modal').modal('hide'); updateStatsViaAjax(); }); return false;\">";
        echo twig_escape_filter($this->env, (((($context["editFolderId"] ?? null) == null)) ? (twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("add_folder", "add folder"))) : (twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("update_folder", "update folder")))), "html", null, true);
        echo " <i class=\"entypo-check\"></i></button>
    </div>
</form>";
    }

    public function getTemplateName()
    {
        return "account/ajax/add_edit_folder.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  316 => 137,  311 => 135,  308 => 134,  302 => 132,  300 => 131,  286 => 120,  270 => 109,  264 => 108,  259 => 106,  248 => 100,  242 => 99,  237 => 97,  225 => 90,  219 => 87,  213 => 84,  207 => 80,  195 => 71,  190 => 69,  181 => 66,  179 => 65,  175 => 63,  167 => 58,  162 => 55,  160 => 54,  149 => 49,  141 => 47,  139 => 46,  133 => 45,  129 => 44,  121 => 38,  115 => 37,  109 => 34,  100 => 33,  97 => 32,  94 => 31,  90 => 30,  86 => 29,  81 => 27,  70 => 19,  66 => 18,  54 => 11,  44 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "account/ajax/add_edit_folder.html.twig", "/var/www/html/medicalimage/themes/evolution/views/account/ajax/add_edit_folder.html.twig");
    }
}
