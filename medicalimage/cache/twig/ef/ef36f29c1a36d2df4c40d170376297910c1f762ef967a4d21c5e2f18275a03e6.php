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

/* account/forgot_password.html.twig */
class __TwigTemplate_5994843bdd4a28993e11f33b375a24f52d65e21f245ff4141dda109e51a70454 extends \Twig\Template
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
        $this->parent = $this->loadTemplate("account/partial/layout_non_login.html.twig", "account/forgot_password.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("forgot_password_page_name", "Forgot Password"), "html", null, true);
    }

    // line 4
    public function block_description($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("forgot_password_meta_description", "Forgot account password"), "html", null, true);
    }

    // line 5
    public function block_keywords($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("forgot_password_meta_keywords", "forgot, password, account, image, picture, pic, img, hosting, sharing, upload, storage, site, website"), "html", null, true);
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
        echo "\" alt=\"";
        echo twig_escape_filter($this->env, ($context["SITE_CONFIG_SITE_NAME"] ?? null), "html", null, true);
        echo "\"/>
                    </a>
                    <!-- progress bar indicator -->
                    <div class=\"login-progressbar-indicator\">
                        <h3>1%</h3>
                        <span>";
        // line 19
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("forgot_password_requesting_reset", "requesting reset..."), "html", null, true);
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
                        <div class=\"form-login-error\">
                            <h3>";
        // line 30
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("error", "Error"), "html", null, true);
        echo "</h3>
                            <p id=\"error-message-container\"></p>
                        </div>
                        <p class=\"description\">";
        // line 33
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("forgot_password_intro_text", "Enter your email address below to receive further instructions on how to reset your account password."), "html", null, true);
        echo "</p>
                        <form method=\"post\" role=\"form\" id=\"form_forgot_password\" action=\"forgot_password\" autocomplete=\"off\">
                            <!-- fix for chrome auto complete not working -->
                            <input style=\"display:none\"><input type=\"password\" style=\"display:none\">
                            <div class=\"form-group\">
                                <div class=\"input-group\">
                                    <div class=\"input-group-addon\">
                                        <i class=\"entypo-mail\"></i>
                                    </div>
                                    <input type=\"text\" class=\"form-control\" name=\"emailAddress\" id=\"emailAddress\" placeholder=";
        // line 42
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("email_address", "email address"), "html", null, true);
        echo "\" autocomplete=\"off\" />
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <button type=\"submit\" class=\"btn btn-info btn-block btn-login\">
                                    <i class=\"entypo-right-open-mini\"></i>
                                    ";
        // line 48
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("request_reset", "request reset")), "html", null, true);
        echo "
                                </button>
                            </div>
                            <div class=\"form-group\">&nbsp;</div>
                            <input type=\"hidden\" value=\"1\" name=\"submitme\"/>
                        </form>
                        <div class=\"login-bottom-links\">
                            <a href=\"";
        // line 55
        echo twig_escape_filter($this->env, ($context["CORE_SITE_PATH"] ?? null), "html", null, true);
        echo "/account/login\" class=\"link\"><i class=\"entypo-lock\"></i> ";
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("login_form", "login form")), "html", null, true);
        echo "</a>
                        </div>
                    </div>
                </div>
                ";
        // line 59
        $this->loadTemplate("account/forgot_password.html.twig", "account/forgot_password.html.twig", 59, "1961818009")->display($context);
        // line 60
        echo "            </div>
        </div>
        <!-- Bottom Scripts -->
        <script src=\"";
        // line 63
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 63), "html", null, true);
        echo "/gsap/main-gsap.js\"></script>
        <script src=\"";
        // line 64
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 64), "html", null, true);
        echo "/bootstrap.js\"></script>
        <script src=\"";
        // line 65
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 65), "html", null, true);
        echo "/joinable.js\"></script>
        <script src=\"";
        // line 66
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 66), "html", null, true);
        echo "/resizeable.js\"></script>
        <script src=\"";
        // line 67
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 67), "html", null, true);
        echo "/evolution-api.js\"></script>
        <script src=\"";
        // line 68
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 68), "html", null, true);
        echo "/jquery.validate.min.js\"></script>
        <script src=\"";
        // line 69
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 69), "html", null, true);
        echo "/evolution-login.js\"></script>
        <script src=\"";
        // line 70
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 70), "html", null, true);
        echo "/custom.js\"></script>
    </body>
";
    }

    public function getTemplateName()
    {
        return "account/forgot_password.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  199 => 70,  195 => 69,  191 => 68,  187 => 67,  183 => 66,  179 => 65,  175 => 64,  171 => 63,  166 => 60,  164 => 59,  155 => 55,  145 => 48,  136 => 42,  124 => 33,  118 => 30,  104 => 19,  92 => 14,  88 => 13,  82 => 9,  78 => 8,  71 => 6,  64 => 5,  57 => 4,  50 => 3,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "account/forgot_password.html.twig", "/var/www/html/medicalimage/themes/evolution/views/account/forgot_password.html.twig");
    }
}


/* account/forgot_password.html.twig */
class __TwigTemplate_5994843bdd4a28993e11f33b375a24f52d65e21f245ff4141dda109e51a70454___1961818009 extends \Twig\Template
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
        // line 59
        return "account/partial/non_login_footer_links.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("account/partial/non_login_footer_links.html.twig", "account/forgot_password.html.twig", 59);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    public function getTemplateName()
    {
        return "account/forgot_password.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  246 => 59,  199 => 70,  195 => 69,  191 => 68,  187 => 67,  183 => 66,  179 => 65,  175 => 64,  171 => 63,  166 => 60,  164 => 59,  155 => 55,  145 => 48,  136 => 42,  124 => 33,  118 => 30,  104 => 19,  92 => 14,  88 => 13,  82 => 9,  78 => 8,  71 => 6,  64 => 5,  57 => 4,  50 => 3,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "account/forgot_password.html.twig", "/var/www/html/medicalimage/themes/evolution/views/account/forgot_password.html.twig");
    }
}
