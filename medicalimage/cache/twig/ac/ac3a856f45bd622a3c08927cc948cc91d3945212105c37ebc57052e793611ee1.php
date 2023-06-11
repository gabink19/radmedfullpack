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

/* admin/plugin_settings.html.twig */
class __TwigTemplate_4370ff2a48bf818a8cbc6f55a1ab829a12a04cf088cb5d98d788c37f481703fb extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'selected_page' => [$this, 'block_selected_page'],
            'selected_sub_page' => [$this, 'block_selected_sub_page'],
            'body' => [$this, 'block_body'],
            'head_js' => [$this, 'block_head_js'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "@core/admin/partial/layout_logged_in.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("@core/admin/partial/layout_logged_in.html.twig", "admin/plugin_settings.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo twig_escape_filter($this->env, ($context["pluginName"] ?? null), "html", null, true);
        echo " Settings";
    }

    // line 4
    public function block_selected_page($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "plugins";
    }

    // line 5
    public function block_selected_sub_page($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "plugin_manage";
    }

    // line 7
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 8
        echo "    <div class=\"row clearfix\">
        <div class=\"col_12\">
            <div class=\"clearfix\">
                <div class=\"page-title\">
                    <div class=\"title_left\">
                        <h3>";
        // line 13
        echo twig_escape_filter($this->env, ($context["pluginName"] ?? null), "html", null, true);
        echo " Settings</h3>
                    </div>
                </div>
                <div class=\"clear\"></div>
                <div class=\"widget_inside\">
                    ";
        // line 18
        echo ($context["msg_page_notifications"] ?? null);
        echo "
                    <form method=\"POST\" action=\"";
        // line 19
        echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/plugin/sociallogin/settings\" name=\"pluginForm\" id=\"pluginForm\" autocomplete=\"off\" enctype=\"multipart/form-data\" class=\"form-horizontal\">
                        <div class=\"x_panel\">
                            <div class=\"x_title\">
                                <h2>Plugin State</h2>
                                <div class=\"clear\"></div>
                            </div>
                            <div class=\"x_content\">
                                <p>Whether this plugin is enabled.</p>
                                <div class=\"form-group\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Plugin Enabled:</label>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                        <select name=\"plugin_enabled\" id=\"plugin_enabled\" class=\"form-control\">
                                            ";
        // line 31
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["yesNoOptions"] ?? null));
        foreach ($context['_seq'] as $context["k"] => $context["yesNoOption"]) {
            // line 32
            echo "                                                <option value=\"";
            echo twig_escape_filter($this->env, $context["k"], "html", null, true);
            echo "\"";
            if ((($context["plugin_enabled"] ?? null) == $context["k"])) {
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
        echo "                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=\"x_panel\">
                            <div class=\"x_title\">
                                <h2>Facebook</h2>
                                <div class=\"clear\"></div>
                            </div>
                            <div class=\"x_content\">
                                <p>Whether to allow Facebook logins and your API details.</p>
                                <div class=\"form-group\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Enable Facebook:</label>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                        <select name=\"facebook_enabled\" class=\"form-control socialToggle\">
                                            ";
        // line 51
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["yesNoOptions"] ?? null));
        foreach ($context['_seq'] as $context["k"] => $context["yesNoOption"]) {
            // line 52
            echo "                                                <option value=\"";
            echo twig_escape_filter($this->env, $context["k"], "html", null, true);
            echo "\"";
            if ((($context["facebook_enabled"] ?? null) == $context["k"])) {
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
        // line 54
        echo "                                        </select>
                                    </div>
                                </div>

                                <div class=\"form-group socialToggleWrapper\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">App ID:</label>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                        <input type=\"text\" name=\"facebook_application_id\" class=\"form-control\" value=\"";
        // line 61
        echo twig_escape_filter($this->env, ($context["facebook_application_id"] ?? null), "html", null, true);
        echo "\"/>
                                    </div>
                                </div>

                                <div class=\"form-group alt-highlight socialToggleWrapper\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">App Secret:</label>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                        <input type=\"text\" name=\"facebook_application_secret\" class=\"form-control\" value=\"";
        // line 68
        echo twig_escape_filter($this->env, ($context["facebook_application_secret"] ?? null), "html", null, true);
        echo "\"/>
                                    </div>
                                </div>

                                <div class=\"form-group alt-highlight socialToggleWrapper\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">App Configuration:</label>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12 formTextBlock\">
                                        <ol>
                                            <li>Go to <a href=\"https://developers.facebook.com/apps\" target=\"_blank\">https://developers.facebook.com/apps</a> and create a new application.</li>
                                            <li>Select \"For Everything Else\" in the popup.</li>
                                            <li>Fill out any required fields such as the application name and description. Click \"Create App ID\".</li>
                                            <li>On the new application details page, go to the \"Add a Product\" section, find \"Facebook login\" and click \"Set Up\".</li>
                                            <li>On the following screen select \"www\" web.</li>
                                            <li>Set 'Site Url' as:<br/>
                                                <code>";
        // line 82
        echo twig_escape_filter($this->env, ($context["WEB_ROOT"] ?? null), "html", null, true);
        echo "</code></li>
                                            <li>Click \"Continue\"/\"Next\" until you get to \"Step 5\".</li>
                                            <li>Click \"Settings\" on the left for \"Facebook login\". Set the \"Valid OAuth Redirect URIs\" as below:<br/>
                                                <code>";
        // line 85
        echo twig_escape_filter($this->env, ($context["PLUGIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/sociallogin/login/Facebook</code></li>
                                            <li>Click \"Settings\" > \"Basic\" on the left (under \"Dashboard\". Set the \"App Domains\" to:<br/>
                                                <code>";
        // line 87
        echo twig_escape_filter($this->env, ($context["_CONFIG_SITE_HOST_URL"] ?? null), "html", null, true);
        echo "</code></li>
                                            <li>Set 'Contact Email' as your website email address.</li>
                                            <li>Set 'Privacy Policy URL' to:<br/>
                                                <code>";
        // line 90
        echo twig_escape_filter($this->env, ($context["WEB_ROOT"] ?? null), "html", null, true);
        echo "/privacy</code></li>
                                            <li>Set 'Terms of Service URL' to:<br/>
                                                <code>";
        // line 92
        echo twig_escape_filter($this->env, ($context["WEB_ROOT"] ?? null), "html", null, true);
        echo "/terms</code></li>
                                            <li>Once you have finished, save then copy and paste the created application credentials into the fields above.</li>
                                            <li>Click on 'Status & Review' and set 'Do you want to make this app and all its live features available to the general public?' to 'YES'.</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class=\"x_panel\">
                            <div class=\"x_title\">
                                <h2>Twitter</h2>
                                <div class=\"clear\"></div>
                            </div>
                            <div class=\"x_content\">
                                <p>Whether to allow Twitter logins and your API details.</p>
                                <div class=\"form-group\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Enable Twitter:</label>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                        <select name=\"twitter_enabled\" class=\"form-control socialToggle\">
                                            ";
        // line 112
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["yesNoOptions"] ?? null));
        foreach ($context['_seq'] as $context["k"] => $context["yesNoOption"]) {
            // line 113
            echo "                                                <option value=\"";
            echo twig_escape_filter($this->env, $context["k"], "html", null, true);
            echo "\"";
            if ((($context["twitter_enabled"] ?? null) == $context["k"])) {
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
        // line 115
        echo "                                        </select>
                                    </div>
                                </div>

                                <div class=\"form-group socialToggleWrapper\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Consumer ID:</label>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                        <input type=\"text\" name=\"twitter_application_key\" class=\"form-control\" value=\"";
        // line 122
        echo twig_escape_filter($this->env, ($context["twitter_application_key"] ?? null), "html", null, true);
        echo "\"/>
                                    </div>
                                </div>

                                <div class=\"form-group alt-highlight socialToggleWrapper\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Consumer Secret:</label>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                        <input type=\"text\" name=\"twitter_application_secret\" class=\"form-control\" value=\"";
        // line 129
        echo twig_escape_filter($this->env, ($context["twitter_application_secret"] ?? null), "html", null, true);
        echo "\"/>
                                    </div>
                                </div>

                                <div class=\"form-group alt-highlight socialToggleWrapper\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">App Configuration:</label>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12 formTextBlock\">
                                        <ol>
                                            <li>Go to <a href=\"https://dev.twitter.com/apps\" target=\"_blank\">https://dev.twitter.com/apps</a> and create a new application.</li>
                                            <li>If you don't have a developers account, you may need to apply for this before you can create any apps.</li>
                                            <li>Fill out any required fields such as the application name and description.</li>
                                            <li>Set the 'Website URL' as:<br/>
                                                <code>";
        // line 141
        echo twig_escape_filter($this->env, ($context["WEB_ROOT"] ?? null), "html", null, true);
        echo "</code></li>
                                            <li>Set the 'Callback URL' as:<br/>
                                                <code>";
        // line 143
        echo twig_escape_filter($this->env, ($context["PLUGIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/sociallogin/login/Twitter</code></li>
                                            <li>Set the 'Terms of Service URL' as:<br/>
                                                <code>";
        // line 145
        echo twig_escape_filter($this->env, ($context["WEB_ROOT"] ?? null), "html", null, true);
        echo "/terms</code></li>
                                            <li>Set the 'Privacy Policy URL' as:<br/>
                                                <code>";
        // line 147
        echo twig_escape_filter($this->env, ($context["WEB_ROOT"] ?? null), "html", null, true);
        echo "/privacy</code></li>
                                            <li>Click the 'Create' button.</li>
                                            <li>Once created, open the \"Permissions\" tab. Edit the the permissions and set \"Access permission\" to read only.</li>
                                            <li>On the same permissions screen, ensure you check \"Request email address from users\" in \"Additional permissions\". Click \"Save\".</li>
                                            <li>Open the 'Keys and tokens' tab of the application and copy &amp; paste the application credentials above.</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                                            
                        <div class=\"x_panel\">
                            <div class=\"x_title\">
                                <h2>Google</h2>
                                <div class=\"clear\"></div>
                            </div>
                            <div class=\"x_content\">
                                <p>Whether to allow Google logins and your API details.</p>
                                <div class=\"form-group\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Enable Google:</label>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                        <select name=\"google_enabled\" class=\"form-control socialToggle\">
                                            ";
        // line 169
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["yesNoOptions"] ?? null));
        foreach ($context['_seq'] as $context["k"] => $context["yesNoOption"]) {
            // line 170
            echo "                                                <option value=\"";
            echo twig_escape_filter($this->env, $context["k"], "html", null, true);
            echo "\"";
            if ((($context["google_enabled"] ?? null) == $context["k"])) {
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
        // line 172
        echo "                                        </select>
                                    </div>
                                </div>

                                <div class=\"form-group socialToggleWrapper\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Client ID:</label>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                        <input type=\"text\" name=\"google_application_id\" class=\"form-control\" value=\"";
        // line 179
        echo twig_escape_filter($this->env, ($context["google_application_id"] ?? null), "html", null, true);
        echo "\"/>
                                    </div>
                                </div>

                                <div class=\"form-group alt-highlight socialToggleWrapper\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Client Secret:</label>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                        <input type=\"text\" name=\"google_application_secret\" class=\"form-control\" value=\"";
        // line 186
        echo twig_escape_filter($this->env, ($context["google_application_secret"] ?? null), "html", null, true);
        echo "\"/>
                                    </div>
                                </div>

                                <div class=\"form-group alt-highlight socialToggleWrapper\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">App Configuration:</label>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12 formTextBlock\">
                                        <ol>
                                            <li>Go to <a href=\"https://code.google.com/apis/console/\" target=\"_blank\">https://code.google.com/apis/console/</a> and create a new project.</li>
                                            <li>Fill out any required fields such as the project name.</li>
                                            <li>Once created, view the project page.</li>
                                            <li>Go to the \"OAuth consent screen\" page linked on the left and select \"External\". Click \"Create\".</li>
                                            <li>Set the application name and a logo.</li>
                                            <li>Set the following in \"Authorised domains\":<br/>
                                                <code>";
        // line 200
        echo twig_escape_filter($this->env, ($context["_CONFIG_SITE_HOST_URL"] ?? null), "html", null, true);
        echo "</code></li>
                                            <li>Set the following in \"Application Homepage link\":<br/>
                                                <code>";
        // line 202
        echo twig_escape_filter($this->env, ($context["WEB_ROOT"] ?? null), "html", null, true);
        echo "</code></li>
                                            <li>Set the following in \"Application Privacy Policy link\":<br/>
                                                <code>";
        // line 204
        echo twig_escape_filter($this->env, ($context["WEB_ROOT"] ?? null), "html", null, true);
        echo "/privacy</code></li>
                                            <li>Set the following in \"Application Terms of Service link\":<br/>
                                                <code>";
        // line 206
        echo twig_escape_filter($this->env, ($context["WEB_ROOT"] ?? null), "html", null, true);
        echo "/terms</code></li>
                                            <li>On the left menu select \"Domain verification\" and \"Add domain\". Enter the domain and click \"Add domain\":
                                                <code>";
        // line 208
        echo twig_escape_filter($this->env, ($context["_CONFIG_SITE_HOST_URL"] ?? null), "html", null, true);
        echo "</code></li>
                                            <li>Once verified, go back to the \"Domain verification\" page and ensure it's listed.</li>
                                            <li>In the project click on \"Credentials\" on the left menu, then \"Create Credentials\" near the top-middle of the page. Select \"OAuth client ID\".</li>
                                            <li>Set the \"Application type\" as \"Web application\". Add \"Authorised redirect URIs\" as below and click \"Create\":
                                                <code>";
        // line 212
        echo twig_escape_filter($this->env, ($context["PLUGIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/sociallogin/login/Google</code></li>
                                            <li>Copy the client ID and Secret in the fields above.</li>
                                            <li>You will need to submit your application for approval so it's not limited to 100 logins.</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=\"x_panel social_login_foursquare\">
                            <div class=\"x_title\">
                                <h2>Foursquare</h2>
                                <div class=\"clear\"></div>
                            </div>
                            <div class=\"x_content\">
                                <p>Whether to allow Foursquare logins and your API details.</p>
                                <div class=\"form-group\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Enable Foursquare:</label>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                        <select name=\"foursquare_enabled\" class=\"form-control socialToggle\">
                                            ";
        // line 232
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["yesNoOptions"] ?? null));
        foreach ($context['_seq'] as $context["k"] => $context["yesNoOption"]) {
            // line 233
            echo "                                                <option value=\"";
            echo twig_escape_filter($this->env, $context["k"], "html", null, true);
            echo "\"";
            if ((($context["foursquare_enabled"] ?? null) == $context["k"])) {
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
        // line 235
        echo "                                        </select>
                                    </div>
                                </div>

                                <div class=\"form-group socialToggleWrapper\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Client ID:</label>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                        <input type=\"text\" name=\"foursquare_application_id\" class=\"form-control\" value=\"";
        // line 242
        echo twig_escape_filter($this->env, ($context["foursquare_application_id"] ?? null), "html", null, true);
        echo "\"/>
                                    </div>
                                </div>

                                <div class=\"form-group alt-highlight socialToggleWrapper\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Client Secret:</label>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                        <input type=\"text\" name=\"foursquare_application_secret\" class=\"form-control\" value=\"";
        // line 249
        echo twig_escape_filter($this->env, ($context["foursquare_application_secret"] ?? null), "html", null, true);
        echo "\"/>
                                    </div>
                                </div>

                                <div class=\"form-group alt-highlight socialToggleWrapper\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">App Configuration:</label>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12 formTextBlock\">
                                        <ol>
                                            <li>Go to <a href=\"https://foursquare.com/developers/register\" target=\"_blank\">https://foursquare.com/developers/register</a> and create a new application.</li>
                                            <li>Fill out any required fields such as the application name and description.</li>
                                            <li>Set 'Application URL' as:<br/>
                                                <code>";
        // line 260
        echo twig_escape_filter($this->env, ($context["WEB_ROOT"] ?? null), "html", null, true);
        echo "</code></li>
                                            <li>Set 'Privacy Policy URL' as:<br/>
                                                <code>";
        // line 262
        echo twig_escape_filter($this->env, ($context["WEB_ROOT"] ?? null), "html", null, true);
        echo "/privacy</code></li>
                                            <li>Set 'Redirect URL' as:<br/>
                                                <code>";
        // line 264
        echo twig_escape_filter($this->env, ($context["PLUGIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/sociallogin/login/Foursquare</code></li>
                                            <li>Save changes. Once you have finished, copy and paste the created application credentials above.</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>

                       <div class=\"x_panel social_login_linkedin\">
                            <div class=\"x_title\">
                                <h2>LinkedIn</h2>
                                <div class=\"clear\"></div>
                            </div>
                            <div class=\"x_content\">
                                <p>Whether to allow LinkedIn logins and your API details.</p>
                                <div class=\"form-group\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Enable LinkedIn:</label>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                        <select name=\"linkedin_enabled\" class=\"form-control socialToggle\">
                                            ";
        // line 283
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["yesNoOptions"] ?? null));
        foreach ($context['_seq'] as $context["k"] => $context["yesNoOption"]) {
            // line 284
            echo "                                                <option value=\"";
            echo twig_escape_filter($this->env, $context["k"], "html", null, true);
            echo "\"";
            if ((($context["linkedin_enabled"] ?? null) == $context["k"])) {
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
        // line 286
        echo "                                        </select>
                                    </div>
                                </div>

                                <div class=\"form-group socialToggleWrapper\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Client ID:</label>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                        <input type=\"text\" name=\"linkedin_application_key\" class=\"form-control\" value=\"";
        // line 293
        echo twig_escape_filter($this->env, ($context["linkedin_application_key"] ?? null), "html", null, true);
        echo "\"/>
                                    </div>
                                </div>

                                <div class=\"form-group alt-highlight socialToggleWrapper\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Client Secret:</label>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                        <input type=\"text\" name=\"linkedin_application_secret\" class=\"form-control\" value=\"";
        // line 300
        echo twig_escape_filter($this->env, ($context["linkedin_application_secret"] ?? null), "html", null, true);
        echo "\"/>
                                    </div>
                                </div>

                                <div class=\"form-group alt-highlight socialToggleWrapper\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">App Configuration:</label>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12 formTextBlock\">
                                        <ol>
                                            <li>Go to <a href=\"https://www.linkedin.com/developers/\" target=\"_blank\">https://www.linkedin.com/developers/</a> and create a new application.</li>
                                            <li>Set 'Privacy Policy URL' to:<br/>
                                                <code>";
        // line 310
        echo twig_escape_filter($this->env, ($context["WEB_ROOT"] ?? null), "html", null, true);
        echo "/privacy</code></li>
                                            <li>Fill out any required fields such as the application name and description.</li>
                                            <li>On the app settings, put the following url in the 'Widgets' > 'Domains' field:<br/>
                                                <code>";
        // line 313
        echo twig_escape_filter($this->env, ($context["WEB_ROOT"] ?? null), "html", null, true);
        echo "</code></li>
                                            <li>On the Auth tab, ensure the following url is set in any OAuth redirect urls:<br/>
                                                <code>";
        // line 315
        echo twig_escape_filter($this->env, ($context["PLUGIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/sociallogin/login/LinkedIn</code></li>
                                            <li>On the Products tab, select \"Sign In with LinkedIn\" and click \"Add Product\".</li>
                                            <li>Once you have finished, copy and paste the Client ID & Client Secret into the above fields.</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                                            
                        <div class=\"x_panel\">
                            <div class=\"x_content\">
                                <div class=\"clearfix\">
                                    <div class=\"col-md-6 col-sm-6 col-xs-12 col-md-offset-3\">
                                        <input type=\"submit\" value=\"Update Settings\" class=\"btn btn-primary\"/>
                                        <input type=\"reset\" value=\"Cancel\" class=\"btn btn-default\" onclick=\"window.location = '";
        // line 329
        echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/plugin_manage';\"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input name=\"submitted\" type=\"hidden\" value=\"1\"/>
                    </form>
                </div>
            </div>   
        </div>
    </div>
";
    }

    // line 343
    public function block_head_js($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 344
        echo "    <script>
        \$(document).ready(function () {
            \$(\".socialToggle\").each(function () {
                toggleSocial(this);
            });

            \$(\".socialToggle\").change(function () {
                toggleSocial(this);
            });
        });

        function toggleSocial(ele)
        {
            if (\$(ele).val() == 1)
            {
                \$(ele).parents('.x_content').find('.socialToggleWrapper').show();
            } else
            {
                \$(ele).parents('.x_content').find('.socialToggleWrapper').hide();
            }
        }
    </script>
";
    }

    public function getTemplateName()
    {
        return "admin/plugin_settings.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  630 => 344,  626 => 343,  609 => 329,  592 => 315,  587 => 313,  581 => 310,  568 => 300,  558 => 293,  549 => 286,  534 => 284,  530 => 283,  508 => 264,  503 => 262,  498 => 260,  484 => 249,  474 => 242,  465 => 235,  450 => 233,  446 => 232,  423 => 212,  416 => 208,  411 => 206,  406 => 204,  401 => 202,  396 => 200,  379 => 186,  369 => 179,  360 => 172,  345 => 170,  341 => 169,  316 => 147,  311 => 145,  306 => 143,  301 => 141,  286 => 129,  276 => 122,  267 => 115,  252 => 113,  248 => 112,  225 => 92,  220 => 90,  214 => 87,  209 => 85,  203 => 82,  186 => 68,  176 => 61,  167 => 54,  152 => 52,  148 => 51,  129 => 34,  114 => 32,  110 => 31,  95 => 19,  91 => 18,  83 => 13,  76 => 8,  72 => 7,  65 => 5,  58 => 4,  50 => 3,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "admin/plugin_settings.html.twig", "/var/www/html/medicalimage/plugins/sociallogin/views/admin/plugin_settings.html.twig");
    }
}
