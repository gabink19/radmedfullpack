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

/* admin/user_edit.html.twig */
class __TwigTemplate_c92df4da4e54d0642b5fd79878596557b9bd618753ad739377e9ef8e18e1b677 extends \Twig\Template
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
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "admin/partial/layout_logged_in.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("admin/partial/layout_logged_in.html.twig", "admin/user_edit.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Edit User";
    }

    // line 4
    public function block_selected_page($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "users";
    }

    // line 5
    public function block_selected_sub_page($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "user_manage";
    }

    // line 7
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 8
        echo "    <script>
        \$(function () {
        \$('#expiry_date').daterangepicker({
        singleDatePicker: true,
                calender_style: \"picker_1\",
                autoUpdateInput: false,
                locale: {
                format: 'DD/MM/YYYY'
                }
        }, function (chosen_date) {
        \$('#expiry_date').val(chosen_date.format('DD/MM/YYYY'));
        });
        });
        function checkExpiryDate()
        {
        userType = \$('#account_type option:selected').val();
        if (userType > 1)
        {
        // default to 1 year
        \$('#expiry_date').val('";
        // line 27
        echo twig_escape_filter($this->env, ($context["defaultExpiryDate"] ?? null), "html", null, true);
        echo "');
        }
        }

        function createRandomKey(eleId)
        {
        var text = \"\";
        var possible = \"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789\";
        for (var i = 0; i < 64; i++)
                text += possible.charAt(Math.floor(Math.random() * possible.length));
        \$('#' + eleId).val(text);
        }
    </script>

    <div class=\"right_col\" role=\"main\">
        <div class=\"\">
            <div class=\"page-title\">
                <div class=\"title_left\">
                    <h3>User Details</h3>
                </div>
            </div>
            <div class=\"clearfix\"></div>

            ";
        // line 50
        echo ($context["msg_page_notifications"] ?? null);
        echo "

            <div class=\"row\">
                <div class=\"col-md-12 col-sm-12 col-xs-12\">
                    <form action=\"";
        // line 54
        echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/user_edit/";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["user"] ?? null), "id", [], "any", false, false, false, 54), "html", null, true);
        echo "\" method=\"POST\" class=\"form-horizontal form-label-left\" enctype=\"multipart/form-data\">
                        <div class=\"x_panel\">
                            <div class=\"x_title\">
                                <h2>Account Details</h2>
                                <div class=\"clearfix\"></div>
                            </div>
                            <div class=\"x_content\">
                                <p>Information about the account.</p>
                                <br/>

                                <div class=\"form-group\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"username\">Username:
                                    </label>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                        <input id=\"username\" name=\"username\" class=\"form-control\" required=\"required\" type=\"text\" value=\"";
        // line 68
        echo twig_escape_filter($this->env, ($context["username"] ?? null), "html", null, true);
        echo "\" READONLY/>
                                    </div>
                                </div>

                                <div class=\"form-group\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"account_status\">Account Status:
                                    </label>
                                    <div class=\"col-md-4 col-sm-4 col-xs-12\">
                                        <select name=\"account_status\" id=\"account_status\" class=\"form-control\">
                                            ";
        // line 77
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["accountStatusDetails"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["accountStatusDetail"]) {
            // line 78
            echo "                                                <option value=\"";
            echo twig_escape_filter($this->env, $context["accountStatusDetail"], "html", null, true);
            echo "\"";
            echo (((($context["account_status"] ?? null) == $context["accountStatusDetail"])) ? (" SELECTED") : (""));
            echo ">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $context["accountStatusDetail"]), "html", null, true);
            echo "</option>
                                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['accountStatusDetail'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 80
        echo "                                        </select>
                                    </div>
                                </div>

                                <div class=\"form-group\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"account_type\">Account Type:
                                    </label>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                        <select name=\"account_type\" id=\"account_type\" class=\"form-control\" onChange=\"checkExpiryDate();\">
                                            ";
        // line 89
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["accountTypeDetails"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["accountTypeDetail"]) {
            // line 90
            echo "                                                <option value=\"";
            echo twig_escape_filter($this->env, (($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = $context["accountTypeDetail"]) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4["id"] ?? null) : null), "html", null, true);
            echo "\"";
            echo (((($context["account_type"] ?? null) == (($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 = $context["accountTypeDetail"]) && is_array($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144) || $__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 instanceof ArrayAccess ? ($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144["id"] ?? null) : null))) ? (" SELECTED") : (""));
            echo ">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, (($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b = $context["accountTypeDetail"]) && is_array($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b) || $__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b instanceof ArrayAccess ? ($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b["label"] ?? null) : null)), "html", null, true);
            echo "</option>
                                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['accountTypeDetail'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 92
        echo "                                        </select>
                                    </div>
                                </div>

                                <div class=\"form-group paid_account_expiry\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"expiry_date\">Paid Expiry Date:
                                    </label>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                        <input id=\"expiry_date\" name=\"expiry_date\" type=\"text\" class=\"form-control\" value=\"";
        // line 100
        echo twig_escape_filter($this->env, ($context["expiry_date"] ?? null), "html", null, true);
        echo "\"/>
                                        <span class=\"text-muted\">(dd/mm/yyyy, maximum 19th January 2038)</span>
                                    </div>
                                </div>

                                <div class=\"form-group\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"storage_limit\">Filesize Storage Limit:
                                    </label>
                                    <div class=\"col-md-5 col-sm-5 col-xs-12\">
                                        <div class=\"input-group\">
                                            <input id=\"storage_limit\" name=\"storage_limit\" placeholder=\"i.e. 1073741824\" type=\"text\" class=\"form-control\" value=\"";
        // line 110
        echo twig_escape_filter($this->env, ($context["storage_limit"] ?? null), "html", null, true);
        echo "\"/>
                                            <span class=\"input-group-addon\">bytes</span>
                                        </div>
                                        <span class=\"text-muted\">Optional in bytes. Overrides account type limits. 1073741824 = 1GB. Use zero for unlimited.</span>
                                    </div>
                                </div>

                                <div class=\"form-group\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"remainingBWDownload\">Download Allowance:
                                    </label>
                                    <div class=\"col-md-5 col-sm-5 col-xs-12\">
                                        <div class=\"input-group\">
                                            <input id=\"remainingBWDownload\" name=\"remainingBWDownload\" placeholder=\"i.e. 1073741824\" type=\"text\" class=\"form-control\" value=\"";
        // line 122
        echo twig_escape_filter($this->env, ($context["remainingBWDownload"] ?? null), "html", null, true);
        echo "\"/>
                                            <span class=\"input-group-addon\">bytes</span>
                                        </div>
                                        <span class=\"text-muted\">Optional in bytes. Generally left blank. Use zero for unlimited.</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=\"x_panel\">
                            <div class=\"x_title\">
                                <h2>User Details</h2>
                                <div class=\"clearfix\"></div>
                            </div>
                            <div class=\"x_content\">
                                <p>Details about the user.</p>
                                <br/>

                                <div class=\"form-group\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"title\">Title:
                                    </label>
                                    <div class=\"col-md-4 col-sm-4 col-xs-12\">
                                        <select name=\"title\" id=\"title\" class=\"form-control\">
                                            ";
        // line 145
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["titleItems"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["titleItem"]) {
            // line 146
            echo "                                                <option value=\"";
            echo twig_escape_filter($this->env, $context["titleItem"], "html", null, true);
            echo "\"";
            echo (((($context["title"] ?? null) == $context["titleItem"])) ? (" SELECTED") : (""));
            echo ">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $context["titleItem"]), "html", null, true);
            echo "</option>
                                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['titleItem'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 148
        echo "                                        </select>
                                    </div>
                                </div>

                                <div class=\"form-group\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"first_name\">First Name:
                                    </label>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                        <input id=\"first_name\" name=\"first_name\" type=\"text\" class=\"form-control\" value=\"";
        // line 156
        echo twig_escape_filter($this->env, ($context["first_name"] ?? null), "html", null, true);
        echo "\"/>
                                    </div>
                                </div>

                                <div class=\"form-group\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"last_name\">Last Name:
                                    </label>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                        <input id=\"last_name\" name=\"last_name\" type=\"text\" class=\"form-control\" value=\"";
        // line 164
        echo twig_escape_filter($this->env, ($context["last_name"] ?? null), "html", null, true);
        echo "\"/>
                                    </div>
                                </div>

                                <div class=\"form-group\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"email_address\">Email Address:
                                    </label>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                        <input id=\"email_address\" name=\"email_address\" type=\"text\" class=\"form-control\" value=\"";
        // line 172
        echo twig_escape_filter($this->env, ($context["email_address"] ?? null), "html", null, true);
        echo "\"/>
                                    </div>
                                </div>                            
                            </div>
                        </div>

                        <div class=\"x_panel\">
                            <div class=\"x_title\">
                                <h2>Reset Password</h2>
                                <div class=\"clearfix\"></div>
                            </div>
                            <div class=\"x_content\">
                                <p>Reset the user password. Leave blank to keep the existing.</p>
                                <br/>

                                <div class=\"form-group\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"password\">Password:
                                    </label>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                        <input id=\"password\" name=\"user_password\" class=\"form-control\" type=\"password\" value=\"";
        // line 191
        echo twig_escape_filter($this->env, ($context["user_password"] ?? null), "html", null, true);
        echo "\"/>
                                    </div>
                                </div>

                                <div class=\"form-group\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"confirm_password\">Confirm Password:
                                    </label>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                        <input id=\"confirm_password\" name=\"confirm_password\" class=\"form-control\" type=\"password\" value=\"";
        // line 199
        echo twig_escape_filter($this->env, ($context["confirm_password"] ?? null), "html", null, true);
        echo "\"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=\"x_panel\">
                            <div class=\"x_title\">
                                <h2>Account Avatar</h2>
                                <div class=\"clearfix\"></div>
                            </div>
                            <div class=\"x_content\">
                                <p>If an account avatar is supported on the site theme, update it here.</p>
                                <br/>

                                <div class=\"form-group\">
                                    <label for=\"avatar\" class=\"control-label col-md-3 col-sm-3 col-xs-12\">Select File (jpg, png or gif)</label>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                        <input type=\"file\" class=\"form-control\" id=\"avatar\" name=\"avatar\" placeholder=\"Select File (jpg, png or gif)\">
                                        ";
        // line 218
        if ((($context["hasAvatar"] ?? null) == true)) {
            // line 219
            echo "                                            <br/>
                                            <img class=\"img-square settings-avatar pull-right\" src=\"";
            // line 220
            echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/ajax/account_view_avatar.ajax?userId=";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["user"] ?? null), "id", [], "any", false, false, false, 220), "html", null, true);
            echo "&width=70&amp;height=70\">
                                            <div class=\"checkbox pull-left\">
                                                <label>
                                                    <input type=\"checkbox\" id=\"removeAvatar\" name=\"removeAvatar\" value=\"1\"/>Remove avatar
                                                </label>
                                            </div>
                                        ";
        }
        // line 227
        echo "                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=\"x_panel\">
                            <div class=\"x_title\">
                                <h2>File Upload API Keys</h2>
                                <div class=\"clearfix\"></div>
                            </div>
                            <div class=\"x_content\">
                                <p>Set or generate API keys.</p>
                                <br/>

                                <div class=\"form-group\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"key1\">Key 1:
                                    </label>
                                    <div class=\"col-md-5 col-sm-5 col-xs-12\">
                                        <div class=\"input-group\">
                                            <input id=\"key1\" name=\"key1\" class=\"form-control\" type=\"text\" value=\"";
        // line 246
        echo twig_escape_filter($this->env, ($context["key1"] ?? null), "html", null, true);
        echo "\"/>
                                            <span class=\"input-group-btn\">
                                                <button class=\"btn btn-secondary\" type=\"button\" onClick=\"createRandomKey('key1'); return false;\">Generate</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class=\"form-group\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"key2\">Key 2:
                                    </label>
                                    <div class=\"col-md-5 col-sm-5 col-xs-12\">
                                        <div class=\"input-group\">
                                            <input id=\"key2\" name=\"key2\" class=\"form-control\" type=\"text\" value=\"";
        // line 259
        echo twig_escape_filter($this->env, ($context["key2"] ?? null), "html", null, true);
        echo "\"/>
                                            <span class=\"input-group-btn\">
                                                <button class=\"btn btn-secondary\" type=\"button\" onClick=\"createRandomKey('key2'); return false;\">Generate</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=\"x_panel\">
                            <div class=\"x_title\">
                                <h2>Other Options</h2>
                                <div class=\"clearfix\"></div>
                            </div>
                            <div class=\"x_content\">
                                <p>Server upload override.</p>
                                <br/>

                                <div class=\"form-group\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"upload_server_override\">Upload Server Override:
                                    </label>
                                    <div class=\"col-md-4 col-sm-4 col-xs-12\">
                                        <select name=\"upload_server_override\" id=\"upload_server_override\" class=\"form-control\">
                                            <option value=\"\">- none - (default)</option>
                                            ";
        // line 284
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["serverDetails"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["serverDetail"]) {
            // line 285
            echo "                                                <option value=\"";
            echo twig_escape_filter($this->env, (($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 = $context["serverDetail"]) && is_array($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002) || $__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 instanceof ArrayAccess ? ($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002["id"] ?? null) : null), "html", null, true);
            echo "\"";
            echo (((($context["upload_server_override"] ?? null) == (($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 = $context["serverDetail"]) && is_array($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4) || $__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 instanceof ArrayAccess ? ($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4["id"] ?? null) : null))) ? (" SELECTED") : (""));
            echo ">";
            echo twig_escape_filter($this->env, (($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666 = $context["serverDetail"]) && is_array($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666) || $__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666 instanceof ArrayAccess ? ($__internal_01476f8db28655ee4ee02ea2d17dd5a92599be76304f08cd8bc0e05aced30666["serverLabel"] ?? null) : null), "html", null, true);
            echo "</option>
                                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['serverDetail'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 287
        echo "                                        </select>
                                        <span class=\"text-muted\">Useful for testing new servers for a specific user. Leave as 'none' to use the global settings.</span>
                                    </div>
                                </div>

                                <div class=\"ln_solid\"></div>
                                <div class=\"form-group\">
                                    <div class=\"col-md-6 col-sm-6 col-xs-12 col-md-offset-3\">
                                        <button type=\"button\" class=\"btn btn-default\" onClick=\"window.location = 'user_manage';\">Cancel</button>
                                        <button type=\"submit\" class=\"btn btn-primary\">Update User</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input name=\"submitted\" type=\"hidden\" value=\"1\"/>
                        <input name=\"id\" type=\"hidden\" value=\"";
        // line 303
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["user"] ?? null), "id", [], "any", false, false, false, 303), "html", null, true);
        echo "\"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "admin/user_edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  489 => 303,  471 => 287,  458 => 285,  454 => 284,  426 => 259,  410 => 246,  389 => 227,  377 => 220,  374 => 219,  372 => 218,  350 => 199,  339 => 191,  317 => 172,  306 => 164,  295 => 156,  285 => 148,  272 => 146,  268 => 145,  242 => 122,  227 => 110,  214 => 100,  204 => 92,  191 => 90,  187 => 89,  176 => 80,  163 => 78,  159 => 77,  147 => 68,  128 => 54,  121 => 50,  95 => 27,  74 => 8,  70 => 7,  63 => 5,  56 => 4,  49 => 3,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "admin/user_edit.html.twig", "/var/www/html/medicalimage/app/views/admin/user_edit.html.twig");
    }
}
