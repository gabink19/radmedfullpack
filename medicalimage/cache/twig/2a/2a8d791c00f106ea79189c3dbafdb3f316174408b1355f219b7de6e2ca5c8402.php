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

/* account/login.html.twig */
class __TwigTemplate_ef89dce10f6c680c500c8a662bc0cf4efabdae118375895c6e415778937e1765 extends \Twig\Template
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
        $this->parent = $this->loadTemplate("account/partial/layout_non_login.html.twig", "account/login.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("login_page_name", "Login"), "html", null, true);
    }

    // line 4
    public function block_description($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("login_meta_description", "Login to your account"), "html", null, true);
    }

    // line 5
    public function block_keywords($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("login_meta_keywords", "login, register, image, picture, pic, img, hosting, sharing, upload, storage, site, website"), "html", null, true);
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
        echo "    <body class=\"page-body login-page login-form-fall\">
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
        echo "\" />
                    </a>

                    <!-- progress bar indicator -->
                    <div class=\"login-progressbar-indicator\">
                        <h3>1%</h3>
                        <span>";
        // line 20
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("login_logging_in", "logging in..."), "html", null, true);
        echo "</span>
                    </div>
                </div>
            </div>
            <div class=\"login-progressbar\">
                <div></div>
            </div>
            <div class=\"login-form\">
                <div class=\"login-content\">
                    <div class=\"login-main-box\">
                        
                        <div class=\"form-login-error\"";
        // line 31
        if ((isset($context["msg_page_errors"]) || array_key_exists("msg_page_errors", $context))) {
            echo " style=\"display: block;\"";
        }
        echo ">
                            <h3>";
        // line 32
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("error", "Error"), "html", null, true);
        echo "</h3>
                            <p id=\"error-message-container\">";
        // line 33
        if ((isset($context["msg_page_errors"]) || array_key_exists("msg_page_errors", $context))) {
            echo twig_escape_filter($this->env, twig_join_filter(($context["msg_page_errors"] ?? null)), "html", null, true);
        }
        echo "</p>
                        </div>

                        <p class=\"description\">";
        // line 36
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("login_intro_text", "Please enter your username and password below to login."), "html", null, true);
        echo "</p>
                        <form method=\"post\" role=\"form\" id=\"form_login\" action=\"login\" autocomplete=\"off\">
                            <!-- fix for chrome auto complete not working -->
                            <input style=\"display:none\"><input type=\"password\" style=\"display:none\">

                            <div class=\"form-group\">
                                <div class=\"input-group\">
                                    <div class=\"input-group-addon\">
                                        <i class=\"entypo-user\"></i>
                                    </div>
                                    <input type=\"text\" class=\"form-control\" name=\"username\" id=\"username\" placeholder=\"";
        // line 46
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("username", "username")), "html", null, true);
        echo "\" autocomplete=\"off\" value=\"";
        echo twig_escape_filter($this->env, ($context["username"] ?? null), "html", null, true);
        echo "\"/>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <div class=\"input-group\">
                                    <div class=\"input-group-addon\">
                                        <i class=\"entypo-key\"></i>
                                    </div>
                                    <input type=\"password\" class=\"form-control\" name=\"password\" id=\"password\" placeholder=\"";
        // line 54
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("password", "password")), "html", null, true);
        echo "\" autocomplete=\"off\"  value=\"";
        echo twig_escape_filter($this->env, ($context["password"] ?? null), "html", null, true);
        echo "\"/>
                                </div>
                            </div>

                            ";
        // line 58
        if ((($context["SITE_CONFIG_CAPTCHA_LOGIN_SCREEN_NORMAL"] ?? null) == "yes")) {
            // line 59
            echo "                            <div class=\"form-group\">
                                <div class=\"input-group\" style=\"display: block; padding: 18px;\">
                                    ";
            // line 61
            echo twig_get_attribute($this->env, $this->source, ($context["CoreHelper"] ?? null), "outputCaptcha", [], "method", false, false, false, 61);
            echo "
                                </div>
                            </div>
                            ";
        }
        // line 65
        echo "
                            <div class=\"form-group\">
                                <button type=\"submit\" class=\"btn btn-primary btn-block btn-login\">
                                    <i class=\"entypo-login\"></i>
                                    ";
        // line 69
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("login", "login")), "html", null, true);
        echo "
                                </button>
                            </div>

                            <div class=\"login-bottom-links\">
                                ";
        // line 74
        if ((($context["SITE_CONFIG_ENABLE_USER_REGISTRATION"] ?? null) == "yes")) {
            echo "<i class=\"entypo-user\"></i> <a href=\"";
            echo twig_escape_filter($this->env, ($context["CORE_SITE_PATH"] ?? null), "html", null, true);
            echo "/register\" class=\"link\">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("register", "register")), "html", null, true);
            echo "</a>&nbsp;&nbsp;&nbsp;";
        }
        echo "<a href=\"";
        echo twig_escape_filter($this->env, ($context["CORE_SITE_PATH"] ?? null), "html", null, true);
        echo "/account/forgot_password\" class=\"link\"><i class=\"entypo-info\"></i> ";
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("forgot_password", "forgot password")), "html", null, true);
        echo "?</a>
                            </div>

                            ";
        // line 77
        echo ($context["HookLoginLoginBoxHtml"] ?? null);
        echo "
                            <input type=\"hidden\" value=\"1\" name=\"submitme\"/>
                        </form>
                    </div>
                </div>

                ";
        // line 83
        $this->loadTemplate("account/login.html.twig", "account/login.html.twig", 83, "1041121676")->display($context);
        // line 84
        echo "            </div>
        </div>
        <!-- Bottom Scripts -->
        <script src=\"";
        // line 87
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 87), "html", null, true);
        echo "/gsap/main-gsap.js\"></script>
        <script src=\"";
        // line 88
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 88), "html", null, true);
        echo "/bootstrap.js\"></script>
        <script src=\"";
        // line 89
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 89), "html", null, true);
        echo "/joinable.js\"></script>
        <script src=\"";
        // line 90
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 90), "html", null, true);
        echo "/resizeable.js\"></script>
        <script src=\"";
        // line 91
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 91), "html", null, true);
        echo "/evolution-api.js\"></script>
        <script src=\"";
        // line 92
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 92), "html", null, true);
        echo "/jquery.validate.min.js\"></script>
        <script src=\"";
        // line 93
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 93), "html", null, true);
        echo "/evolution-login.js\"></script>
        <script src=\"";
        // line 94
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 94), "html", null, true);
        echo "/custom.js\"></script>
    </body>
";
    }

    public function getTemplateName()
    {
        return "account/login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  257 => 94,  253 => 93,  249 => 92,  245 => 91,  241 => 90,  237 => 89,  233 => 88,  229 => 87,  224 => 84,  222 => 83,  213 => 77,  197 => 74,  189 => 69,  183 => 65,  176 => 61,  172 => 59,  170 => 58,  161 => 54,  148 => 46,  135 => 36,  127 => 33,  123 => 32,  117 => 31,  103 => 20,  92 => 14,  88 => 13,  82 => 9,  78 => 8,  71 => 6,  64 => 5,  57 => 4,  50 => 3,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "account/login.html.twig", "/var/www/html/medicalimage/themes/evolution/views/account/login.html.twig");
    }
}


/* account/login.html.twig */
class __TwigTemplate_ef89dce10f6c680c500c8a662bc0cf4efabdae118375895c6e415778937e1765___1041121676 extends \Twig\Template
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
        // line 83
        return "account/partial/non_login_footer_links.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("account/partial/non_login_footer_links.html.twig", "account/login.html.twig", 83);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    public function getTemplateName()
    {
        return "account/login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  304 => 83,  257 => 94,  253 => 93,  249 => 92,  245 => 91,  241 => 90,  237 => 89,  233 => 88,  229 => 87,  224 => 84,  222 => 83,  213 => 77,  197 => 74,  189 => 69,  183 => 65,  176 => 61,  172 => 59,  170 => 58,  161 => 54,  148 => 46,  135 => 36,  127 => 33,  123 => 32,  117 => 31,  103 => 20,  92 => 14,  88 => 13,  82 => 9,  78 => 8,  71 => 6,  64 => 5,  57 => 4,  50 => 3,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "account/login.html.twig", "/var/www/html/medicalimage/themes/evolution/views/account/login.html.twig");
    }
}
