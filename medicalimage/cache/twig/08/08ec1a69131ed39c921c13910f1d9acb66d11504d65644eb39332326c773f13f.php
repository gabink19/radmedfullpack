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

/* register.html.twig */
class __TwigTemplate_0fa9f56f2206a59cac9b1aa1b007b466c514be5dfb728f97e1f8fea1cbc4c679 extends \Twig\Template
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
            'html_element_class' => [$this, 'block_html_element_class'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "account/partial/layout_non_login.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("account/partial/layout_non_login.html.twig", "register.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("register_page_name", "Register"), "html", null, true);
    }

    // line 4
    public function block_description($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("register_meta_description", "Register for an account"), "html", null, true);
    }

    // line 5
    public function block_keywords($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("register_meta_keywords", "register, account, short, url, user"), "html", null, true);
    }

    // line 6
    public function block_html_element_class($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "login-page-wrapper";
    }

    // line 8
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 9
        echo "    <body class=\"page-body login-page login-form-fall register-page\">
        <div class=\"login-container\">
            <div class=\"login-header login-caret\">
                <div class=\"login-content\">
                    <a href=\"";
        // line 13
        echo twig_escape_filter($this->env, ($context["CORE_SITE_PATH"] ?? null), "html", null, true);
        echo "/\" class=\"logo\">
                        <img src=\"";
        // line 14
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getMainLogoUrl", [], "method", false, false, false, 14), "html", null, true);
        echo "\" alt=\"";
        echo twig_escape_filter($this->env, ($context["SITE_CONFIG_SITE_NAME"] ?? null), "html", null, true);
        echo "\" alt=\"";
        echo twig_escape_filter($this->env, ($context["SITE_CONFIG_SITE_NAME"] ?? null), "html", null, true);
        echo "\"/>
                    </a>
                </div>
            </div>
            <div class=\"login-progressbar\">
                <div></div>
            </div>
            <div class=\"login-form\">
                <div class=\"login-content\">
                    <div class=\"login-main-box\">
                        
                        ";
        // line 25
        if ((isset($context["msg_page_errors"]) || array_key_exists("msg_page_errors", $context))) {
            // line 26
            echo "                            <div class=\"form-login-error\" style=\"display: block;\">
                                <h3>";
            // line 27
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("error", "Error"), "html", null, true);
            echo "</h3>
                                <p id=\"error-message-container\">";
            // line 28
            echo twig_escape_filter($this->env, twig_join_filter(($context["msg_page_errors"] ?? null)), "html", null, true);
            echo "</p>
                            </div>
                        ";
        }
        // line 31
        echo "
                        <p class=\"description\">";
        // line 32
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("register_text", "Please enter your information to register for an account. Your new account password will be sent to your email address."), "html", null, true);
        echo "</p>
                        <form method=\"post\" role=\"form\" action=\"register\" autocomplete=\"off\">
                            <!-- fix for chrome auto complete not working -->
                            <input style=\"display:none\"><input type=\"password\" style=\"display:none\">

                            <div class=\"form-group\">
                                <div class=\"input-group\"> <span class=\"input-group-addon\"><i class=\"fa fa-chevron-right\"></i></span>
                                    <select class=\"form-control\" autofocus=\"autofocus\" tabindex=\"1\" id=\"title\" name=\"title\">
                                        <option disabled selected>";
        // line 40
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("title", "title"), "html", null, true);
        echo "</option>
                                        <option value=\"Mr\" ";
        // line 41
        echo (((($context["title"] ?? null) == "Mr")) ? ("SELECTED") : (""));
        echo ">";
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("title_mr", "Mr"), "html", null, true);
        echo "</option>
                                        <option value=\"Ms\" ";
        // line 42
        echo (((($context["title"] ?? null) == "Ms")) ? ("SELECTED") : (""));
        echo ">";
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("title_ms", "Ms"), "html", null, true);
        echo "</option>
                                        <option value=\"Mrs\" ";
        // line 43
        echo (((($context["title"] ?? null) == "Mrs")) ? ("SELECTED") : (""));
        echo ">";
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("title_mrs", "Mrs"), "html", null, true);
        echo "</option>
                                        <option value=\"Miss\" ";
        // line 44
        echo (((($context["title"] ?? null) == "Miss")) ? ("SELECTED") : (""));
        echo ">";
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("title_miss", "Miss"), "html", null, true);
        echo "</option>
                                        <option value=\"Dr\" ";
        // line 45
        echo (((($context["title"] ?? null) == "Dr")) ? ("SELECTED") : (""));
        echo ">";
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("title_dr", "Dr"), "html", null, true);
        echo "</option>
                                        <option value=\"Pro\" ";
        // line 46
        echo (((($context["title"] ?? null) == "Pro")) ? ("SELECTED") : (""));
        echo ">";
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("title_pro", "Pro"), "html", null, true);
        echo "</option>
                                    </select>
                                </div>
                            </div>

                            <div class=\"form-group\">
                                <div class=\"input-group\"><span class=\"input-group-addon\"><i class=\"fa fa-chevron-right\"></i></span>
                                    <input type=\"text\" class=\"form-control\" placeholder=\"";
        // line 53
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("firstname", "firstname"), "html", null, true);
        echo "\" tabindex=\"1\" value=\"";
        echo twig_escape_filter($this->env, ($context["firstname"] ?? null), "html", null, true);
        echo "\" id=\"firstname\" name=\"firstname\"/>
                                </div>
                            </div>

                            <div class=\"form-group\">
                                <div class=\"input-group\"><span class=\"input-group-addon\"><i class=\"fa fa-chevron-right\"></i></span>
                                    <input type=\"text\" class=\"form-control\" placeholder=\"";
        // line 59
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("lastname", "lastname"), "html", null, true);
        echo "\" tabindex=\"2\" value=\"";
        echo twig_escape_filter($this->env, ($context["lastname"] ?? null), "html", null, true);
        echo "\" id=\"lastname\" name=\"lastname\"/>
                                </div>
                            </div>

                            <div class=\"form-group\">
                                <div class=\"input-group\"><span class=\"input-group-addon\"><i class=\"fa fa-chevron-right\"></i></span>
                                    <input type=\"text\" class=\"form-control\" placeholder=\"";
        // line 65
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("email_address", "email address"), "html", null, true);
        echo "\" tabindex=\"3\" value=\"";
        echo twig_escape_filter($this->env, ($context["emailAddress"] ?? null), "html", null, true);
        echo "\" id=\"emailAddress\" name=\"emailAddress\"/>
                                </div>
                            </div>

                            <div class=\"form-group\">
                                <div class=\"input-group\"><span class=\"input-group-addon\"><i class=\"fa fa-chevron-right\"></i></span>
                                    <input type=\"text\" class=\"form-control\" placeholder=\"";
        // line 71
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("email_address_confirm", "Email Confirm"), "html", null, true);
        echo "\" tabindex=\"4\" value=\"";
        echo twig_escape_filter($this->env, ($context["emailAddressConfirm"] ?? null), "html", null, true);
        echo "\" id=\"emailAddressConfirm\" name=\"emailAddressConfirm\"/>
                                </div>
                            </div>

                            <div class=\"form-group\">
                                <div class=\"input-group\"><span class=\"input-group-addon\"><i class=\"fa fa-chevron-right\"></i></span>
                                    <input type=\"text\" class=\"form-control\" placeholder=\"";
        // line 77
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("username", "username"), "html", null, true);
        echo "\" tabindex=\"5\" value=\"";
        echo twig_escape_filter($this->env, ($context["username"] ?? null), "html", null, true);
        echo "\" id=\"username\" name=\"username\"/>
                                </div>
                            </div>

                            ";
        // line 81
        if ((($context["SITE_CONFIG_REGISTER_FORM_SHOW_CAPTCHA"] ?? null) == "yes")) {
            // line 82
            echo "                                <div class=\"form-group\">
                                    <div class=\"input-group\" style=\"display: block; padding: 18px;\">
                                        ";
            // line 84
            echo twig_get_attribute($this->env, $this->source, ($context["CoreHelper"] ?? null), "outputCaptcha", [], "method", false, false, false, 84);
            echo "
                                    </div>
                                </div>
                            ";
        }
        // line 88
        echo "
                            <div class=\"form-group\">
                                <button type=\"submit\" class=\"btn btn-info btn-block btn-login\">
                                    <i class=\"entypo-right-open-mini\"></i>
                                    ";
        // line 92
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("register", "register")), "html", null, true);
        echo "
                                </button>
                            </div>
                            <div class=\"form-group\">&nbsp;</div>
                            <input type=\"hidden\" value=\"1\" name=\"submitme\"/>
                        </form>
                        <div class=\"login-bottom-links\">
                            <a href=\"";
        // line 99
        echo twig_escape_filter($this->env, ($context["CORE_SITE_PATH"] ?? null), "html", null, true);
        echo "/account/login\" class=\"link\"><i class=\"entypo-lock\"></i> ";
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("back_to_login_form", "back to login form")), "html", null, true);
        echo "</a>
                        </div>
                    </div>
                </div>
                ";
        // line 103
        $this->loadTemplate("register.html.twig", "register.html.twig", 103, "231985634")->display($context);
        // line 104
        echo "            </div>
        </div>
        <!-- Bottom Scripts -->
        <script src=\"";
        // line 107
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 107), "html", null, true);
        echo "/gsap/main-gsap.js\"></script>
        <script src=\"";
        // line 108
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 108), "html", null, true);
        echo "/bootstrap.js\"></script>
        <script src=\"";
        // line 109
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 109), "html", null, true);
        echo "/joinable.js\"></script>
        <script src=\"";
        // line 110
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 110), "html", null, true);
        echo "/resizeable.js\"></script>
        <script src=\"";
        // line 111
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 111), "html", null, true);
        echo "/evolution-api.js\"></script>
        <script src=\"";
        // line 112
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 112), "html", null, true);
        echo "/jquery.validate.min.js\"></script>
        <script src=\"";
        // line 113
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 113), "html", null, true);
        echo "/evolution-login.js\"></script>
        <script src=\"";
        // line 114
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 114), "html", null, true);
        echo "/custom.js\"></script>
    </body>
";
    }

    public function getTemplateName()
    {
        return "register.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  311 => 114,  307 => 113,  303 => 112,  299 => 111,  295 => 110,  291 => 109,  287 => 108,  283 => 107,  278 => 104,  276 => 103,  267 => 99,  257 => 92,  251 => 88,  244 => 84,  240 => 82,  238 => 81,  229 => 77,  218 => 71,  207 => 65,  196 => 59,  185 => 53,  173 => 46,  167 => 45,  161 => 44,  155 => 43,  149 => 42,  143 => 41,  139 => 40,  128 => 32,  125 => 31,  119 => 28,  115 => 27,  112 => 26,  110 => 25,  92 => 14,  88 => 13,  82 => 9,  78 => 8,  71 => 6,  64 => 5,  57 => 4,  50 => 3,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "register.html.twig", "/var/www/html/medicalimage/themes/evolution/views/register.html.twig");
    }
}


/* register.html.twig */
class __TwigTemplate_0fa9f56f2206a59cac9b1aa1b007b466c514be5dfb728f97e1f8fea1cbc4c679___231985634 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 103
        return "account/partial/non_login_footer_links.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("account/partial/non_login_footer_links.html.twig", "register.html.twig", 103);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    public function getTemplateName()
    {
        return "register.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  358 => 103,  311 => 114,  307 => 113,  303 => 112,  299 => 111,  295 => 110,  291 => 109,  287 => 108,  283 => 107,  278 => 104,  276 => 103,  267 => 99,  257 => 92,  251 => 88,  244 => 84,  240 => 82,  238 => 81,  229 => 77,  218 => 71,  207 => 65,  196 => 59,  185 => 53,  173 => 46,  167 => 45,  161 => 44,  155 => 43,  149 => 42,  143 => 41,  139 => 40,  128 => 32,  125 => 31,  119 => 28,  115 => 27,  112 => 26,  110 => 25,  92 => 14,  88 => 13,  82 => 9,  78 => 8,  71 => 6,  64 => 5,  57 => 4,  50 => 3,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "register.html.twig", "/var/www/html/medicalimage/themes/evolution/views/register.html.twig");
    }
}
