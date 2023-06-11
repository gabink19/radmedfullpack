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

/* account/account_edit.html.twig */
class __TwigTemplate_0ce7c3b3889058e21f4300fb14322e37affc68ad25ba5fea2a2a9380d5e6b2d8 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'description' => [$this, 'block_description'],
            'keywords' => [$this, 'block_keywords'],
            'selected_navigation_link' => [$this, 'block_selected_navigation_link'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "account/partial/layout_logged_in.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("account/partial/layout_logged_in.html.twig", "account/account_edit.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_edit_page_name", "Account Details"), "html", null, true);
    }

    // line 4
    public function block_description($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_edit_meta_description", "Account details"), "html", null, true);
    }

    // line 5
    public function block_keywords($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_edit_meta_keywords", "details, account, short, url, user"), "html", null, true);
    }

    // line 6
    public function block_selected_navigation_link($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "settings";
    }

    // line 8
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 9
        echo "    <div class=\"main-content layer base-slide\">
        <ol class=\"breadcrumb bc-3\">
            <li>
                <a href=\"";
        // line 12
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountWebRoot", [], "method", false, false, false, 12), "html", null, true);
        echo "\"><i class=\"entypo-home\"></i>";
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("home", "Home"), "html", null, true);
        echo "</a>
            </li>
            <li class=\"active\">
                <strong>";
        // line 15
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_details", "Account Details"), "html", null, true);
        echo "</strong>
            </li>
        </ol>

        <div class=\"row\">
            <div class=\"col-sm-3 responsive-column\">

                <div class=\"tile-stats tile-red\">
                    <div class=\"icon\"><i class=\"entypo-drive\"></i></div>
                    ";
        // line 24
        if ((($context["totalFreeSpace"] ?? null) != null)) {
            // line 25
            echo "                        <div data-delay=\"0\" data-duration=\"1500\" data-decimals=\"2\" data-postfix=\"&nbsp;";
            echo twig_escape_filter($this->env, ($context["totalFreeSpaceExt"] ?? null), "html", null, true);
            echo "\" data-end=\"";
            echo twig_escape_filter($this->env, ($context["totalFreeSpaceSize"] ?? null), "html", null, true);
            echo "\" data-start=\"0\" class=\"num\">-</div>
                    ";
        } else {
            // line 27
            echo "                        <div class=\"num\">";
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("unlimited", "Unlimited"), "html", null, true);
            echo "</div>
                    ";
        }
        // line 29
        echo "                    <h3>";
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("available_storage", "Available Storage"), "html", null, true);
        echo "</h3>
                </div>

            </div>

            <div class=\"col-sm-3 responsive-column\">

                <div class=\"tile-stats tile-green\">
                    <div class=\"icon\"><i class=\"entypo-upload\"></i></div>
                    <div data-delay=\"0\" data-duration=\"1500\" data-decimals=\"2\" data-postfix=\"&nbsp;";
        // line 38
        echo twig_escape_filter($this->env, ($context["totalActiveFileSizeExt"] ?? null), "html", null, true);
        echo "\" data-end=\"";
        echo twig_escape_filter($this->env, ($context["totalActiveFileSizeSize"] ?? null), "html", null, true);
        echo "\" data-start=\"0\" class=\"num\">-</div>
                    <h3>";
        // line 39
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("used_storage", "Used Storage"), "html", null, true);
        echo "</h3>
                </div>

            </div>

            <div class=\"col-sm-3 responsive-column\">

                <div class=\"tile-stats tile-aqua\">
                    <div class=\"icon\"><i class=\"entypo-doc-text-inv\"></i></div>
                    <div data-delay=\"0\" data-duration=\"1500\" data-end=\"";
        // line 48
        echo twig_escape_filter($this->env, ($context["totalActiveFiles"] ?? null), "html", null, true);
        echo "\" data-start=\"0\" class=\"num\">-</div>
                    <h3>";
        // line 49
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("active_files", "Active Files"), "html", null, true);
        echo "</h3>
                </div>

            </div>

            <div class=\"col-sm-3 responsive-column\">

                <div class=\"tile-stats tile-blue\">
                    <div class=\"icon\"><i class=\"entypo-down\"></i></div>
                    <div data-delay=\"0\" data-duration=\"1500\" data-end=\"";
        // line 58
        echo twig_escape_filter($this->env, ($context["totalDownloads"] ?? null), "html", null, true);
        echo "\" data-start=\"0\" class=\"num\">-</div>
                    <h3>";
        // line 59
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("total_downloads", "Total Downloads"), "html", null, true);
        echo "</h3>
                </div>

            </div>
        </div>
        <br/>

        <form class=\"form-horizontal form-groups-bordered\" role=\"form\" action=\"";
        // line 66
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountWebRoot", [], "method", false, false, false, 66), "html", null, true);
        echo "/edit\" method=\"POST\" enctype=\"multipart/form-data\">
            <div class=\"row\">
                <div class=\"col-md-12\">

                    <div data-collapsed=\"0\" class=\"panel panel-primary\">

                        <div class=\"panel-heading\">
                            <div class=\"panel-title\">
                                ";
        // line 74
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("keep_your_account_details_up_to_date_below", "Keep your account details up to date below."), "html", null, true);
        echo "
                            </div>
                        </div>

                        <div class=\"panel-body\">
                            <div class=\"form-group\">
                                <label class=\"col-sm-3 control-label\" for=\"title\">";
        // line 80
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("title", "Title"), "html", null, true);
        echo "</label>
                                <div class=\"col-sm-5\">
                                    <select id=\"title\" name=\"title\" class=\"form-control\" autofocus=\"autofocus\" tabindex=\"1\" data-content=\"";
        // line 82
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("your_title", "Your title"), "html", null, true);
        echo "\" data-placement=\"right\" data-trigger=\"hover focus\" data-container=\"body\" data-toggle=\"popover\">
                                        <option value=\"Mr\" ";
        // line 83
        echo (((($context["title"] ?? null) == "Mr")) ? ("SELECTED") : (""));
        echo ">";
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("title_mr", "Mr"), "html", null, true);
        echo "</option>
                                        <option value=\"Ms\" ";
        // line 84
        echo (((($context["title"] ?? null) == "Ms")) ? ("SELECTED") : (""));
        echo ">";
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("title_ms", "Ms"), "html", null, true);
        echo "</option>
                                        <option value=\"Mrs\" ";
        // line 85
        echo (((($context["title"] ?? null) == "Mrs")) ? ("SELECTED") : (""));
        echo ">";
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("title_mrs", "Mrs"), "html", null, true);
        echo "</option>
                                        <option value=\"Miss\" ";
        // line 86
        echo (((($context["title"] ?? null) == "Miss")) ? ("SELECTED") : (""));
        echo ">";
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("title_miss", "Miss"), "html", null, true);
        echo "</option>
                                        <option value=\"Dr\" ";
        // line 87
        echo (((($context["title"] ?? null) == "Dr")) ? ("SELECTED") : (""));
        echo ">";
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("title_dr", "Dr"), "html", null, true);
        echo "</option>
                                        <option value=\"Pro\" ";
        // line 88
        echo (((($context["title"] ?? null) == "Pro")) ? ("SELECTED") : (""));
        echo ">";
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("title_pro", "Pro"), "html", null, true);
        echo "</option>
                                    </select>
                                </div>
                            </div>

                            <div class=\"form-group\">
                                <label class=\"col-sm-3 control-label\" for=\"firstname\">";
        // line 94
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("firstname", "Firstname"), "html", null, true);
        echo "</label>
                                <div class=\"col-sm-5\">
                                    <input id=\"firstname\" name=\"firstname\" type=\"text\" tabindex=\"2\" value=\"";
        // line 96
        echo twig_escape_filter($this->env, ($context["firstname"] ?? null), "html", null, true);
        echo "\" class=\"form-control\" data-content=\"";
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("your_firstname", "Your firstname"), "html", null, true);
        echo "\" data-placement=\"right\" data-trigger=\"hover focus\" data-container=\"body\" data-toggle=\"popover\">
                                </div>
                            </div>

                            <div class=\"form-group\">
                                <label class=\"col-sm-3 control-label\" for=\"lastname\">";
        // line 101
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("lastname", "Lastname"), "html", null, true);
        echo "</label>
                                <div class=\"col-sm-5\">
                                    <input id=\"lastname\" name=\"lastname\" type=\"text\" tabindex=\"3\" value=\"";
        // line 103
        echo twig_escape_filter($this->env, ($context["lastname"] ?? null), "html", null, true);
        echo "\" class=\"form-control\" data-content=\"";
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("your_lastname", "Your lastname"), "html", null, true);
        echo "\" data-placement=\"right\" data-trigger=\"hover focus\" data-container=\"body\" data-toggle=\"popover\">
                                </div>
                            </div>

                            <div class=\"form-group\">
                                <label class=\"col-sm-3 control-label\" for=\"emailAddress\">";
        // line 108
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("email_address", "Email Address"), "html", null, true);
        echo "</label>
                                <div class=\"col-sm-5\">
                                    <input id=\"emailAddress\" name=\"emailAddress\" type=\"text\" tabindex=\"4\" value=\"";
        // line 110
        echo twig_escape_filter($this->env, ($context["emailAddress"] ?? null), "html", null, true);
        echo "\" class=\"form-control\" data-content=\"";
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("your_new_email_address", "Your new email address"), "html", null, true);
        echo "\" data-placement=\"right\" data-trigger=\"hover focus\" data-container=\"body\" data-toggle=\"popover\">
                                </div>
                            </div>

                            ";
        // line 114
        if ((($context["SITE_CONFIG_LANGUAGE_USER_SELECT_LANGUAGE"] ?? null) == "yes")) {
            // line 115
            echo "                                <div class=\"form-group\">
                                    <label class=\"col-sm-3 control-label\" for=\"languageId\">";
            // line 116
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("language", "Language"), "html", null, true);
            echo "</label>
                                    <div class=\"col-sm-5\">
                                        <select id=\"languageId\" name=\"languageId\" class=\"form-control\" tabindex=\"7\" data-content=\"";
            // line 118
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("settings_tip_site_language", "The language to use on the site."), "html", null, true);
            echo "\" data-placement=\"right\" data-trigger=\"hover focus\" data-container=\"body\" data-toggle=\"popover\">
                                            ";
            // line 119
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["activeLanguages"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["activeLanguage"]) {
                // line 120
                echo "                                                <option value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["activeLanguage"], "id", [], "any", false, false, false, 120), "html", null, true);
                echo "\"";
                if ((($context["languageId"] ?? null) == twig_get_attribute($this->env, $this->source, $context["activeLanguage"], "id", [], "any", false, false, false, 120))) {
                    echo " SELECTED";
                }
                echo ">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["activeLanguage"], "languageName", [], "any", false, false, false, 120), "html", null, true);
                echo "</option>
                                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['activeLanguage'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 122
            echo "                                        </select>
                                    </div>
                                </div>
                            ";
        }
        // line 126
        echo "                        </div>
                    </div>


                    <div data-collapsed=\"0\" class=\"panel panel-primary\">
                        <div class=\"panel-heading\">
                            <div class=\"panel-title\">
                                ";
        // line 133
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("privacy", "Privacy")), "html", null, true);
        echo ".
                            </div>
                        </div>

                        <div class=\"panel-body\">
                            ";
        // line 138
        if ((($context["SITE_CONFIG_FORCE_FILES_PRIVATE"] ?? null) == "no")) {
            // line 139
            echo "                                <div class=\"form-group\">
                                    <label class=\"col-sm-3 control-label\" for=\"isPublic\">";
            // line 140
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("default_folder_privacy", "Default Folder Privacy")), "html", null, true);
            echo "</label>
                                    <div class=\"col-sm-5\">
                                        <select id=\"isPublic\" name=\"isPublic\" class=\"form-control\" autofocus=\"autofocus\" tabindex=\"8\" data-content=\"";
            // line 142
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("settings_tip_private_files_text", "Whether to keep all files private or allow sharing. If this is set as public, you can still set folders as private."), "html", null, true);
            echo "\" data-placement=\"right\" data-trigger=\"hover focus\" data-container=\"body\" data-toggle=\"popover\">  
                                            <option value=\"1\" ";
            // line 143
            if ((($context["isPublic"] ?? null) == 1)) {
                echo "selected=\"selected\"";
            }
            echo ">";
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("privacy_public_limited_access", "Public - Access if users know the folder url."), "html", null, true);
            echo "</option>
                                            <option value=\"0\" ";
            // line 144
            if ((($context["isPublic"] ?? null) == 0)) {
                echo "selected=\"selected\"";
            }
            echo ">";
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("privacy_private_no_access", "Private - No access outside of your account, unless you generate a unique access url."), "html", null, true);
            echo "</option>
                                        </select>
                                    </div>
                                </div>
                            ";
        }
        // line 149
        echo "                        </div>

                    </div>


                </div>
            </div>


            <br/>

            <div class=\"row\">
                <div class=\"col-md-12\">
                    <div data-collapsed=\"0\" class=\"panel panel-primary\">
                        <div class=\"panel-heading\">
                            <div class=\"panel-title\">
                                ";
        // line 165
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_settings_change_password", "Change password."), "html", null, true);
        echo "
                            </div>
                        </div>

                        <div class=\"panel-body\">
                            <div class=\"form-group\">
                                <label class=\"col-sm-3 control-label\" for=\"password\">";
        // line 171
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("change_password", "Change Password"), "html", null, true);
        echo "</label>
                                <div class=\"col-sm-5\">
                                    <input id=\"password\" name=\"password\" type=\"password\" tabindex=\"5\" value=\"\" class=\"form-control\" data-content=\"";
        // line 173
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("a_new_account_password_leave_blank_to_keep", "Optional. A new account password, leave this blank to keep your existing."), "html", null, true);
        echo "\" data-placement=\"right\" data-trigger=\"hover focus\" data-container=\"body\" data-toggle=\"popover\">
                                </div>
                            </div>

                            <div class=\"form-group\">
                                <label class=\"col-sm-3 control-label\" for=\"passwordConfirm\">";
        // line 178
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("confirm_password_edit", "Confirm Password"), "html", null, true);
        echo "</label>
                                <div class=\"col-sm-5\">
                                    <input id=\"passwordConfirm\" name=\"passwordConfirm\" type=\"password\" tabindex=\"6\" value=\"\" class=\"form-control\" data-content=\"";
        // line 180
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("a_new_account_password_confirm_leave_blank_to_keep", "Optional. Confirm the password entered above, leave this blank to keep your existing."), "html", null, true);
        echo "\" data-placement=\"right\" data-trigger=\"hover focus\" data-container=\"body\" data-toggle=\"popover\">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br/>
            <div class=\"row\">
                <div class=\"col-md-12\">

                    <div data-collapsed=\"0\" class=\"panel panel-primary\">

                        <div class=\"panel-heading\">
                            <div class=\"panel-title\">
                                ";
        // line 196
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_settings_avatar", "Account avatar."), "html", null, true);
        echo "
                            </div>
                        </div>

                        <div class=\"panel-body\">

                            <div class=\"form-group\">
                                <label for=\"avatar\" class=\"col-sm-3 control-label\">";
        // line 203
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_settings_avatar_file", "Select File (jpg, png or gif)"), "html", null, true);
        echo "</label>
                                <div class=\"col-sm-5\">
                                    <input type=\"file\" class=\"form-control\" id=\"avatar\" name=\"avatar\" placeholder=\"";
        // line 205
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_settings_avatar_file", "Select File (jpg, png or gif)"), "html", null, true);
        echo "\">
                                    ";
        // line 206
        if ((($context["hasAvatar"] ?? null) == true)) {
            // line 207
            echo "                                        <br/>
                                        <img class=\"img-square settings-avatar\" src=\"";
            // line 208
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["Auth"] ?? null), "user", [], "any", false, false, false, 208), "getAvatarUrl", [], "method", false, false, false, 208), "html", null, true);
            echo "\">
                                        <div class=\"checkbox\" style=\"float: left;\">
                                            <label>
                                                <input type=\"checkbox\" id=\"removeAvatar\" name=\"removeAvatar\" value=\"1\"/>";
            // line 211
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_settings_avatar_remove", "Remove avatar"), "html", null, true);
            echo "
                                            </label>
                                        </div>
                                    ";
        }
        // line 215
        echo "                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br/>
            <div class=\"row\">
                <div class=\"col-md-12\">

                    <div data-collapsed=\"0\" class=\"panel panel-primary\">

                        <div class=\"panel-heading\">
                            <div class=\"panel-title\">
                                ";
        // line 230
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_settings_watermark", "Optional image preview watermark. After upload, enable watermarking using each folder settings."), "html", null, true);
        echo "
                            </div>
                        </div>

                        <div class=\"panel-body\">

                            <div class=\"form-group\">
                                <label for=\"watermark\" class=\"col-sm-3 control-label\">";
        // line 237
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_settings_watermark_file", "Select File (transparent png)"), "html", null, true);
        echo "</label>
                                <div class=\"col-sm-5\">
                                    <input type=\"file\" class=\"form-control\" id=\"watermark\" name=\"watermark\" placeholder=\"";
        // line 239
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_settings_watermark_file", "Select File (transparent png)"), "html", null, true);
        echo "\">
                                    ";
        // line 240
        if ((($context["hasWatermark"] ?? null) == true)) {
            // line 241
            echo "                                        <br/>
                                        <div class=\"checkbox\" style=\"float: left;\">
                                            <label>
                                                <input type=\"checkbox\" id=\"removeWatermark\" name=\"removeWatermark\" value=\"1\"/>";
            // line 244
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_settings_watermark_remove", "Remove watermark"), "html", null, true);
            echo "
                                            </label>
                                        </div>
                                        <div class=\"clear\"></div>
                                        <br/>
                                        <img src=\"";
            // line 249
            echo twig_escape_filter($this->env, ($context["watermarkCacheUrl"] ?? null), "html", null, true);
            echo "\">
                                    ";
        }
        // line 251
        echo "                                </div>
                            </div>
                            <div class=\"form-group\">
                                <label class=\"col-sm-3 control-label\" for=\"watermarkPosition\">";
        // line 254
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_settings_watermark_position", "Watermark Position"), "html", null, true);
        echo "</label>
                                <div class=\"col-sm-5\">
                                    <select name=\"watermarkPosition\" id=\"watermarkPosition\" class=\"form-control\">
                                        ";
        // line 257
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["watermarkPositionOptions"] ?? null));
        foreach ($context['_seq'] as $context["k"] => $context["watermarkPositionOption"]) {
            // line 258
            echo "                                            <option value=\"";
            echo twig_escape_filter($this->env, $context["k"], "html", null, true);
            echo "\"";
            if ((($context["watermarkPosition"] ?? null) == $context["k"])) {
                echo " SELECTED";
            }
            echo ">";
            echo twig_escape_filter($this->env, $context["watermarkPositionOption"], "html", null, true);
            echo "</option>
                                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['k'], $context['watermarkPositionOption'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 260
        echo "                                    </select>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <label class=\"col-sm-3 control-label\" for=\"watermarkPadding\">";
        // line 264
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_settings_watermark_padding", "Watermark Padding"), "html", null, true);
        echo "</label>
                                <div class=\"col-sm-5\">
                                    <div class=\"input-spinner\"> <button type=\"button\" class=\"btn btn-default\">-</button> <input id=\"watermarkPadding\" name=\"watermarkPadding\" type=\"text\" class=\"form-control size-1\" value=\"";
        // line 266
        (((isset($context["watermarkPadding"]) || array_key_exists("watermarkPadding", $context))) ? (print (twig_escape_filter($this->env, ($context["watermarkPadding"] ?? null), "html", null, true))) : (print ("10")));
        echo "\" data-min=\"0\" data-max=\"50\"> <button type=\"button\" class=\"btn btn-default\">+</button> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br/>
            <div class=\"row\">
                <div class=\"col-md-12\">

                    <div data-collapsed=\"0\" class=\"panel panel-primary\">

                        <div class=\"panel-body\">

                            <div class=\"form-group\">
                                <div class=\"col-sm-offset-3 col-sm-5\">
                                    <input type=\"hidden\" value=\"1\" name=\"submitme\"/>
                                    <input type=\"hidden\" name=\"privateFileStatistics\" value=\"1\"/>
                                    <button class=\"btn btn-info\" type=\"submit\">";
        // line 286
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("update_account", "update account")), "html", null, true);
        echo " <i class=\"entypo-check\"></i></button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
";
    }

    public function getTemplateName()
    {
        return "account/account_edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  609 => 286,  586 => 266,  581 => 264,  575 => 260,  560 => 258,  556 => 257,  550 => 254,  545 => 251,  540 => 249,  532 => 244,  527 => 241,  525 => 240,  521 => 239,  516 => 237,  506 => 230,  489 => 215,  482 => 211,  476 => 208,  473 => 207,  471 => 206,  467 => 205,  462 => 203,  452 => 196,  433 => 180,  428 => 178,  420 => 173,  415 => 171,  406 => 165,  388 => 149,  376 => 144,  368 => 143,  364 => 142,  359 => 140,  356 => 139,  354 => 138,  346 => 133,  337 => 126,  331 => 122,  316 => 120,  312 => 119,  308 => 118,  303 => 116,  300 => 115,  298 => 114,  289 => 110,  284 => 108,  274 => 103,  269 => 101,  259 => 96,  254 => 94,  243 => 88,  237 => 87,  231 => 86,  225 => 85,  219 => 84,  213 => 83,  209 => 82,  204 => 80,  195 => 74,  184 => 66,  174 => 59,  170 => 58,  158 => 49,  154 => 48,  142 => 39,  136 => 38,  123 => 29,  117 => 27,  109 => 25,  107 => 24,  95 => 15,  87 => 12,  82 => 9,  78 => 8,  71 => 6,  64 => 5,  57 => 4,  50 => 3,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "account/account_edit.html.twig", "/var/www/html/medicalimage/themes/evolution/views/account/account_edit.html.twig");
    }
}
