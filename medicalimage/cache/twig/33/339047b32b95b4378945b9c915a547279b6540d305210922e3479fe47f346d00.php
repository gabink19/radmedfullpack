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

/* admin/ajax/account_package_manage_add_form.html.twig */
class __TwigTemplate_815c1d95921fc75586b4ff53c1666e27f21f1bd7b279b759a51b5dcf32c9702c extends \Twig\Template
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
        echo "<p>Use the form below to ";
        echo twig_escape_filter($this->env, ($context["formType"] ?? null), "html", null, true);
        echo " user package details.</p>
<form id=\"";
        // line 2
        echo twig_escape_filter($this->env, ($context["formName"] ?? null), "html", null, true);
        echo "\" class=\"user_package_form form-horizontal form-label-left input_mask\">

    <div class=\"form\">
        <div class=\"form-group\">
            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
        // line 6
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("label", "label")), "html", null, true);
        echo ":</label>
            <div class=\"col-md-9 col-sm-9 col-xs-12\">
                <input name=\"label\" id=\"label\" type=\"text\" value=\"";
        // line 8
        echo twig_escape_filter($this->env, ($context["label"] ?? null), "html", null, true);
        echo "\" class=\"form-control\"/>
            </div>
        </div>
    </div><br/>

    <div class=\"\" role=\"tabpanel\" data-example-id=\"togglable-tabs\">
        <ul id=\"myTab\" class=\"nav nav-tabs bar_tabs\" role=\"tablist\">
            <li role=\"presentation\" class=\"active\"><a href=\"#tab_content1\" id=\"home-tab\" role=\"tab\" data-toggle=\"tab\" aria-expanded=\"true\">Upload Settings</a>
            </li>
            <li role=\"presentation\" class=\"\"><a href=\"#tab_content2\" role=\"tab\" id=\"profile-tab\" data-toggle=\"tab\" aria-expanded=\"false\">Download Settings</a>
            </li>
            <li role=\"presentation\" class=\"\"><a href=\"#tab_content3\" role=\"tab\" id=\"profile-tab\" data-toggle=\"tab\" aria-expanded=\"false\">Site Options</a>
            </li>
        </ul>

        <div id=\"myTabContent\" class=\"tab-content\">
            <div role=\"tabpanel\" class=\"tab-pane fade active in\" id=\"tab_content1\" aria-labelledby=\"home-tab\">
                <div class=\"form-group\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Users Can Upload:</label>
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                        <div class=\"input-group col-md-3 col-sm-5 col-xs-12\">
                            <select name=\"can_upload\" id=\"can_upload\" class=\"form-control\" onChange=\"toggleElements(this);
                                    return false;\">
                                ";
        // line 31
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["yesNoOptions"] ?? null));
        foreach ($context['_seq'] as $context["k"] => $context["yesNoOption"]) {
            // line 32
            echo "                                    <option value=\"";
            echo twig_escape_filter($this->env, $context["k"], "html", null, true);
            echo "\"";
            if ((($context["can_upload"] ?? null) == $context["k"])) {
                echo " SELECTED";
            }
            echo ">";
            echo twig_escape_filter($this->env, $context["yesNoOption"], "html", null, true);
            echo "</option>
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['k'], $context['yesNoOption'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 34
        echo "                            </select>
                        </div>
                        <p>
                            Allow users to upload.
                        </p>
                    </div>
                </div>

                <div class=\"form-group can_upload\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Max Uploads Per Day:</label>
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                        <div class=\"input-group col-md-3 col-sm-5 col-xs-12\">
                            <input name=\"max_uploads_per_day\" id=\"max_uploads_per_day\" type=\"text\" value=\"";
        // line 46
        echo twig_escape_filter($this->env, ($context["max_uploads_per_day"] ?? null), "html", null, true);
        echo "\" class=\"form-control\"/>
                            <span class=\"input-group-addon\">files</span>
                        </div>
                        <p>
                            Spam protect: Max files a user IP address or account can upload per day. Leave blank for unlimited.
                        </p>
                    </div>
                </div>

                <div class=\"form-group can_upload\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Concurrent Uploads:</label>
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                        <div class=\"input-group col-md-3 col-sm-5 col-xs-12\">
                            <input name=\"concurrent_uploads\" id=\"concurrent_uploads\" type=\"text\" value=\"";
        // line 59
        echo twig_escape_filter($this->env, ($context["concurrent_uploads"] ?? null), "html", null, true);
        echo "\" class=\"form-control\"  ";
        echo (((($context["can_upload"] ?? null) == 0)) ? ("DISABLED") : (""));
        echo "/>
                            <span class=\"input-group-addon\">files</span>
                        </div>
                        <p>
                            The maximum amount of files that can be uploaded at the same time for users.
                        </p>
                    </div>
                </div>

                <div class=\"form-group\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Max Upload Size:</label>
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                        <div class=\"input-group col-md-5 col-sm-7 col-xs-12\">
                            <input name=\"max_upload_size\" id=\"max_upload_size\" type=\"text\" value=\"";
        // line 72
        echo twig_escape_filter($this->env, ($context["max_upload_size"] ?? null), "html", null, true);
        echo "\" class=\"form-control\"/>
                            <span class=\"input-group-addon\">bytes</span>
                        </div>
                        <p>
                            The max upload filesize for users (in bytes)
                        </p>
                    </div>
                </div>

                <div class=\"form-group\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Accepted Upload File Types:</label>
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                        <div class=\"input-group col-md-12 col-sm-12 col-xs-12\">
                            <input name=\"accepted_file_types\" id=\"accepted_file_types\" type=\"text\" value=\"";
        // line 85
        echo twig_escape_filter($this->env, ($context["accepted_file_types"] ?? null), "html", null, true);
        echo "\" class=\"form-control\"/>
                        </div>
                        <p>
                            The file extensions which are permitted. Leave blank for all. Separate by semi-colon. i.e. .jpg;.gif;.doc;
                        </p>
                    </div>
                </div>

                <div class=\"form-group\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Blocked Upload File Types:</label>
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                        <div class=\"input-group col-md-12 col-sm-12 col-xs-12\">
                            <input name=\"blocked_file_types\" id=\"blocked_file_types\" type=\"text\" value=\"";
        // line 97
        echo twig_escape_filter($this->env, ($context["blocked_file_types"] ?? null), "html", null, true);
        echo "\" class=\"form-control\"/>
                        </div>
                        <p>
                            The file extensions which are NOT permitted. Leave blank to allow all file types. Separate by semi-colon. i.e. .jpg;.gif;.doc;
                        </p>
                    </div>
                </div>

                <div class=\"form-group\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Enable Url Downloading:</label>
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                        <div class=\"input-group col-md-3 col-sm-5 col-xs-12\">
                            <select name=\"can_remote_download\" id=\"can_remote_download\" class=\"form-control\" onChange=\"toggleElements(this);
                                    return false;\">
                                ";
        // line 111
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["yesNoOptions"] ?? null));
        foreach ($context['_seq'] as $context["k"] => $context["yesNoOption"]) {
            // line 112
            echo "                                    <option value=\"";
            echo twig_escape_filter($this->env, $context["k"], "html", null, true);
            echo "\"";
            if ((($context["can_remote_download"] ?? null) == $context["k"])) {
                echo " SELECTED";
            }
            echo ">";
            echo twig_escape_filter($this->env, $context["yesNoOption"], "html", null, true);
            echo "</option>
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['k'], $context['yesNoOption'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 114
        echo "                            </select>
                        </div>
                        <p>
                            Allow users to use the remote url download feature.
                        </p>
                    </div>
                </div>

                <div class=\"form-group can_remote_download\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Max Remote Urls:</label>
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                        <div class=\"input-group col-md-3 col-sm-5 col-xs-12\">
                            <input name=\"max_remote_download_urls\" id=\"max_remote_download_urls\" type=\"text\" value=\"";
        // line 126
        echo twig_escape_filter($this->env, ($context["max_remote_download_urls"] ?? null), "html", null, true);
        echo "\" class=\"form-control\" ";
        echo (((($context["can_remote_download"] ?? null) == 0)) ? ("DISABLED") : (""));
        echo "/>
                            <span class=\"input-group-addon\">urls</span>
                        </div>
                        <p>
                            The maximum remote urls a user can download at once.
                        </p>
                    </div>
                </div>

                <div class=\"form-group alt-highlight\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Storage Allowance:</label>
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                        <div class=\"input-group col-md-5 col-sm-7 col-xs-12\">
                            <input name=\"max_storage_bytes\" id=\"max_storage_bytes\" type=\"text\" value=\"";
        // line 139
        echo twig_escape_filter($this->env, ($context["max_storage_bytes"] ?? null), "html", null, true);
        echo "\" class=\"form-control\"/>
                            <span class=\"input-group-addon\">bytes</span>
                        </div>
                        <p>
                            Maximum storage permitted for users, in bytes. Use 0 (zero) for no limits.
                        </p>
                    </div>
                </div>
            </div>

            <div role=\"tabpanel\" class=\"tab-pane fade\" id=\"tab_content2\" aria-labelledby=\"profile-tab\">
                <div class=\"form-group wait_between_downloads\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Wait Between Downloads:</label>
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                        <div class=\"input-group col-md-3 col-sm-5 col-xs-12\">
                            <input name=\"wait_between_downloads\" id=\"wait_between_downloads\" type=\"text\" value=\"";
        // line 154
        echo twig_escape_filter($this->env, ($context["wait_between_downloads"] ?? null), "html", null, true);
        echo "\" class=\"form-control\"/>
                            <span class=\"input-group-addon\">seconds</span>
                        </div>
                        <p>
                            How long a user must wait between downloads, in seconds. Set to 0 (zero) to disable. Note: Ensure the \\'downloads_track_current_downloads\\' is also set to \\'yes\\' in site settings to enable this.
                        </p>
                    </div>
                </div>

                <div class=\"form-group download_speed\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Download Speed:</label>
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                        <div class=\"input-group col-md-5 col-sm-7 col-xs-12\">
                            <input name=\"download_speed\" id=\"download_speed\" type=\"text\" value=\"";
        // line 167
        echo twig_escape_filter($this->env, ($context["download_speed"] ?? null), "html", null, true);
        echo "\" class=\"form-control\"/>
                            <span class=\"input-group-addon\">bytes</span>
                        </div>
                        <p>
                            Maximum download speed for users, in bytes per second. i.e. 50000. Use 0 for unlimited.
                        </p>
                    </div>
                </div>

                <div class=\"form-group concurrent_downloads\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Concurrent Downloads:</label>
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                        <div class=\"input-group col-md-3 col-sm-5 col-xs-12\">
                            <input name=\"concurrent_downloads\" id=\"concurrent_downloads\" type=\"text\" value=\"";
        // line 180
        echo twig_escape_filter($this->env, ($context["concurrent_downloads"] ?? null), "html", null, true);
        echo "\" class=\"form-control\"/>
                            <span class=\"input-group-addon\">files</span>
                        </div>
                        <p>
                            The maximum concurrent downloads a user can do at once. Set to 0 (zero) for no limit. Note: Ensure the \\'downloads_track_current_downloads\\' is also set to \\'yes\\' in site settings to enable this.
                        </p>
                    </div>
                </div>

                <div class=\"form-group downloads_per_day\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Downloads Per Day:</label>
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                        <div class=\"input-group col-md-3 col-sm-5 col-xs-12\">
                            <input name=\"downloads_per_24_hours\" id=\"downloads_per_24_hours\" type=\"text\" value=\"";
        // line 193
        echo twig_escape_filter($this->env, ($context["downloads_per_24_hours"] ?? null), "html", null, true);
        echo "\" class=\"form-control\"/>
                            <span class=\"input-group-addon\">files</span>
                        </div>
                        <p>
                            The maximum files a user can download in a 24 hour period. Set to 0 (zero) to disable.
                        </p>
                    </div>
                </div>

                <div class=\"form-group\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Max Download Size:</label>
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                        <div class=\"input-group col-md-5 col-sm-7 col-xs-12\">
                            <input name=\"max_download_filesize_allowed\" id=\"max_download_filesize_allowed\" type=\"text\" value=\"";
        // line 206
        echo twig_escape_filter($this->env, ($context["max_download_filesize_allowed"] ?? null), "html", null, true);
        echo "\" class=\"form-control\"/>
                            <span class=\"input-group-addon\">bytes</span>
                        </div>
                        <p>
                            The maximum filesize a user can download (in bytes). Set to 0 (zero) to ignore.
                        </p>
                    </div>
                </div>
            </div>

            <div role=\"tabpanel\" class=\"tab-pane fade\" id=\"tab_content3\" aria-labelledby=\"profile-tab\">
                <div class=\"form-group nav_account_packages\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Show Adverts:</label>
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                        <div class=\"input-group col-md-3 col-sm-5 col-xs-12\">
                            <select name=\"show_site_adverts\" id=\"show_site_adverts\" class=\"form-control\">
                                ";
        // line 222
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["yesNoOptions"] ?? null));
        foreach ($context['_seq'] as $context["k"] => $context["yesNoOption"]) {
            // line 223
            echo "                                    <option value=\"";
            echo twig_escape_filter($this->env, $context["k"], "html", null, true);
            echo "\"";
            if ((($context["show_site_adverts"] ?? null) == $context["k"])) {
                echo " SELECTED";
            }
            echo ">";
            echo twig_escape_filter($this->env, $context["yesNoOption"], "html", null, true);
            echo "</option>
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['k'], $context['yesNoOption'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 225
        echo "                            </select>
                        </div>
                        <p>
                            Show adverts for users across the site.
                        </p>
                    </div>
                </div>

                <div class=\"form-group\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Show Upgrade Page:</label>
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                        <div class=\"input-group col-md-3 col-sm-5 col-xs-12\">
                            <select name=\"show_upgrade_screen\" id=\"show_upgrade_screen\" class=\"form-control\">
                                ";
        // line 238
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["yesNoOptions"] ?? null));
        foreach ($context['_seq'] as $context["k"] => $context["yesNoOption"]) {
            // line 239
            echo "                                    <option value=\"";
            echo twig_escape_filter($this->env, $context["k"], "html", null, true);
            echo "\"";
            if ((($context["show_upgrade_screen"] ?? null) == $context["k"])) {
                echo " SELECTED";
            }
            echo ">";
            echo twig_escape_filter($this->env, $context["yesNoOption"], "html", null, true);
            echo "</option>
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['k'], $context['yesNoOption'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 241
        echo "                            </select>
                        </div>
                        <p>
                            Show the premium account upgrade page for users.
                        </p>
                    </div>
                </div>

                <div class=\"form-group\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Inactive Files Days:</label>
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                        <div class=\"input-group col-md-3 col-sm-5 col-xs-12\">
                            <input name=\"days_to_keep_inactive_files\" id=\"days_to_keep_inactive_files\" type=\"text\" value=\"";
        // line 253
        echo twig_escape_filter($this->env, ($context["days_to_keep_inactive_files"] ?? null), "html", null, true);
        echo "\" class=\"form-control\"/>
                            <span class=\"input-group-addon\">days</span>
                        </div>
                        <p>
                            The amount of days after non-active files are removed for users. Non-active = time since last download. Use 0 for unlimited.
                        </p>
                    </div>
                </div>

                <div class=\"form-group\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Trash Delete Days:</label>
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                        <div class=\"input-group col-md-3 col-sm-5 col-xs-12\">
                            <input name=\"days_to_keep_trashed_files\" id=\"days_to_keep_trashed_files\" type=\"text\" value=\"";
        // line 266
        echo twig_escape_filter($this->env, ($context["days_to_keep_trashed_files"] ?? null), "html", null, true);
        echo "\" class=\"form-control\"/>
                            <span class=\"input-group-addon\">days</span>
                        </div>
                        <p>
                            File are kept in the users trash for this period, then automatically removed. Use 0 for unlimited.
                        </p>
                    </div>
                </div>

                <div class=\"form-group\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Package Type:</label>
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                        <div class=\"input-group col-md-12 col-sm-12 col-xs-12\">
                            <select name=\"level_type\" id=\"level_type\" class=\"form-control\">
                                ";
        // line 280
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["availableAccountTypes"] ?? null));
        foreach ($context['_seq'] as $context["k"] => $context["availableAccountType"]) {
            // line 281
            echo "                                    <option value=\"";
            echo twig_escape_filter($this->env, $context["k"], "html", null, true);
            echo "\"";
            if ((($context["level_type"] ?? null) == $context["k"])) {
                echo " SELECTED";
            }
            echo ">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $context["availableAccountType"]), "html", null, true);
            echo "</option>
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['k'], $context['availableAccountType'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 283
        echo "                            </select>
                        </div>
                        <p>
                            The type of account. Note that Moderator &amp; Admin have access to the admin area.
                        </p>
                    </div>
                </div>
                <div class=\"form-group nav_account_packages\">
                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">On Upgrade Page:</label>
                    <div class=\"col-md-9 col-sm-9 col-xs-12\">
                        <div class=\"input-group col-md-3 col-sm-5 col-xs-12\">
                            <select name=\"on_upgrade_page\" id=\"on_upgrade_page\" class=\"form-control\">
                                ";
        // line 295
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["yesNoOptions"] ?? null));
        foreach ($context['_seq'] as $context["k"] => $context["yesNoOption"]) {
            // line 296
            echo "                                    <option value=\"";
            echo twig_escape_filter($this->env, $context["k"], "html", null, true);
            echo "\"";
            if ((($context["on_upgrade_page"] ?? null) == $context["k"])) {
                echo " SELECTED";
            }
            echo ">";
            echo twig_escape_filter($this->env, $context["yesNoOption"], "html", null, true);
            echo "</option>
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['k'], $context['yesNoOption'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 298
        echo "                            </select>
                        </div>
                        <p>
                            Whether to show this package on the upgrade page.
                        </p>
                    </div>
                </div>
            </div><br/>

        </div>
    </div>

    ";
        // line 310
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["PluginHelper"] ?? null), "getPluginAdminPackageSettingsFormV2", [0 => ($context["gEditUserLevelId"] ?? null)], "method", false, false, false, 310), "html", null, true);
        echo "

</form>";
    }

    public function getTemplateName()
    {
        return "admin/ajax/account_package_manage_add_form.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  513 => 310,  499 => 298,  484 => 296,  480 => 295,  466 => 283,  451 => 281,  447 => 280,  430 => 266,  414 => 253,  400 => 241,  385 => 239,  381 => 238,  366 => 225,  351 => 223,  347 => 222,  328 => 206,  312 => 193,  296 => 180,  280 => 167,  264 => 154,  246 => 139,  228 => 126,  214 => 114,  199 => 112,  195 => 111,  178 => 97,  163 => 85,  147 => 72,  129 => 59,  113 => 46,  99 => 34,  84 => 32,  80 => 31,  54 => 8,  49 => 6,  42 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "admin/ajax/account_package_manage_add_form.html.twig", "/var/www/html/medicalimage/app/views/admin/ajax/account_package_manage_add_form.html.twig");
    }
}
