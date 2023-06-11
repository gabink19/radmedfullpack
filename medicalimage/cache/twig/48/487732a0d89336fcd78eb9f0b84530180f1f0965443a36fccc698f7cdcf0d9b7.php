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

/* admin/user_add.html.twig */
class __TwigTemplate_023cb3dfd28934a94467f2ff003a00cbf4d43cce2d2d3d522c4216b19fbe86b5 extends \Twig\Template
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
        $this->parent = $this->loadTemplate("admin/partial/layout_logged_in.html.twig", "admin/user_add.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Add New User";
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
        echo "user_add";
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
        // line 28
        echo twig_escape_filter($this->env, ($context["defaultExpiryDate"] ?? null), "html", null, true);
        echo "');
            }
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
        // line 42
        echo ($context["msg_page_notifications"] ?? null);
        echo "

            <div class=\"row\">
                <div class=\"col-md-12 col-sm-12 col-xs-12\">
                    <form action=\"user_add\" method=\"POST\" class=\"form-horizontal form-label-left\">
                        <div class=\"x_panel\">
                            <div class=\"x_title\">
                                <h2>Login Details</h2>
                                <div class=\"clearfix\"></div>
                            </div>
                            <div class=\"x_content\">
                                <p>Enter the details that the user will use to access the site.</p>
                                <br/>

                                <div class=\"form-group\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"username\">Username:
                                    </label>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                        <input id=\"username\" name=\"username\" class=\"form-control\" required=\"required\" type=\"text\" value=\"";
        // line 60
        echo twig_escape_filter($this->env, ($context["username"] ?? null), "html", null, true);
        echo "\"/>
                                    </div>
                                </div>

                                <div class=\"form-group\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"password\">Password:
                                    </label>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                        <input id=\"password\" name=\"password\" class=\"form-control\" required=\"required\" type=\"password\" value=\"";
        // line 68
        echo twig_escape_filter($this->env, ($context["password"] ?? null), "html", null, true);
        echo "\"/>
                                    </div>
                                </div>

                                <div class=\"form-group\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"confirm_password\">Confirm Password:
                                    </label>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                        <input id=\"confirm_password\" name=\"confirm_password\" class=\"form-control\" required=\"required\" type=\"password\" value=\"";
        // line 76
        echo twig_escape_filter($this->env, ($context["confirm_password"] ?? null), "html", null, true);
        echo "\"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=\"x_panel\">
                            <div class=\"x_title\">
                                <h2>Account Details</h2>
                                <div class=\"clearfix\"></div>
                            </div>
                            <div class=\"x_content\">
                                <p>Information about the account.</p>
                                <br/>

                                <div class=\"form-group\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"account_status\">Account Status:
                                    </label>
                                    <div class=\"col-md-4 col-sm-4 col-xs-12\">
                                        <select name=\"account_status\" id=\"account_status\" class=\"form-control\">
                                            ";
        // line 96
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["accountStatusDetails"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["accountStatusDetail"]) {
            // line 97
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
        // line 99
        echo "                                        </select>
                                    </div>
                                </div>

                                <div class=\"form-group\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"account_type\">Account Type:
                                    </label>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                        <select name=\"account_type\" id=\"account_type\" class=\"form-control\" onChange=\"checkExpiryDate();\">
                                            ";
        // line 108
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["accountTypeDetails"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["accountTypeDetail"]) {
            // line 109
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
        // line 111
        echo "                                        </select>
                                    </div>
                                </div>

                                <div class=\"form-group paid_account_expiry\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"expiry_date\">Paid Expiry Date:
                                    </label>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                        <input id=\"expiry_date\" name=\"expiry_date\" type=\"text\" class=\"form-control\" value=\"";
        // line 119
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
        // line 129
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
        // line 141
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
        // line 164
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["titleItems"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["titleItem"]) {
            // line 165
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
        // line 167
        echo "                                        </select>
                                    </div>
                                </div>

                                <div class=\"form-group\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"first_name\">First Name:
                                    </label>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                        <input id=\"first_name\" name=\"first_name\" type=\"text\" class=\"form-control\" value=\"";
        // line 175
        echo twig_escape_filter($this->env, ($context["first_name"] ?? null), "html", null, true);
        echo "\"/>
                                    </div>
                                </div>

                                <div class=\"form-group\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"last_name\">Last Name:
                                    </label>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                        <input id=\"last_name\" name=\"last_name\" type=\"text\" class=\"form-control\" value=\"";
        // line 183
        echo twig_escape_filter($this->env, ($context["last_name"] ?? null), "html", null, true);
        echo "\"/>
                                    </div>
                                </div>

                                <div class=\"form-group\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"email_address\">Email Address:
                                    </label>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                        <input id=\"email_address\" name=\"email_address\" type=\"text\" class=\"form-control\" value=\"";
        // line 191
        echo twig_escape_filter($this->env, ($context["email_address"] ?? null), "html", null, true);
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
                                <p>If an account avatar is supported on the site theme, set it here.</p>
                                <br/>

                                <div class=\"form-group\">
                                    <label for=\"avatar\" class=\"control-label col-md-3 col-sm-3 col-xs-12\">Select File (jpg, png or gif)</label>
                                    <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                        <input type=\"file\" class=\"form-control\" id=\"avatar\" name=\"avatar\" placeholder=\"Select File (jpg, png or gif)\">
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
        // line 230
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["serverDetails"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["serverDetail"]) {
            // line 231
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
        // line 233
        echo "                                        </select>
                                        <span class=\"text-muted\">Useful for testing new servers for a specific user. Leave as 'none' to use the global settings.</span>
                                    </div>
                                </div>

                                <div class=\"ln_solid\"></div>
                                <div class=\"form-group\">
                                    <div class=\"col-md-6 col-sm-6 col-xs-12 col-md-offset-3\">
                                        <button type=\"button\" class=\"btn btn-default\" onClick=\"window.location = 'user_manage';\">Cancel</button>
                                        <button type=\"submit\" class=\"btn btn-primary\">Add User</button>
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

    public function getTemplateName()
    {
        return "admin/user_add.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  396 => 233,  383 => 231,  379 => 230,  337 => 191,  326 => 183,  315 => 175,  305 => 167,  292 => 165,  288 => 164,  262 => 141,  247 => 129,  234 => 119,  224 => 111,  211 => 109,  207 => 108,  196 => 99,  183 => 97,  179 => 96,  156 => 76,  145 => 68,  134 => 60,  113 => 42,  96 => 28,  74 => 8,  70 => 7,  63 => 5,  56 => 4,  49 => 3,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "admin/user_add.html.twig", "/var/www/html/medicalimage/app/views/admin/user_add.html.twig");
    }
}
