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

/* account/forgot_password_confirm.html.twig */
class __TwigTemplate_64d3672213b2ed77ccee5488bef21143e8c4b14b6e31ebfaa93bf1561d6fa461 extends \Twig\Template
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
        $this->parent = $this->loadTemplate("account/partial/layout_non_login.html.twig", "account/forgot_password_confirm.html.twig", 1);
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
                </div>
            </div>
            <div class=\"login-form\">
                <div class=\"login-content\">
                    <div class=\"login-main-box\">
                        <div class=\"alert alert-success\">
                            <i class=\"entypo-check\"></i> ";
        // line 22
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("forgot_password_sent_intro_text", "An email has been sent with further instructions on how to reset your password. Please check your email inbox.", ["EMAIL_ADDRESS" => ($context["emailAddress"] ?? null)]), "html", null, true);
        echo "
                        </div>

                        <div class=\"login-bottom-links\">
                            <a href=\"";
        // line 26
        echo twig_escape_filter($this->env, ($context["CORE_SITE_PATH"] ?? null), "html", null, true);
        echo "/account/login\" class=\"link\"><i class=\"entypo-lock\"></i> ";
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("login_form", "login form")), "html", null, true);
        echo "</a>
                        </div>
                    </div>
                </div>
                ";
        // line 30
        $this->loadTemplate("account/forgot_password_confirm.html.twig", "account/forgot_password_confirm.html.twig", 30, "9953789")->display($context);
        // line 31
        echo "            </div>
        </div>
        <!-- Bottom Scripts -->
        <script src=\"";
        // line 34
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 34), "html", null, true);
        echo "/gsap/main-gsap.js\"></script>
        <script src=\"";
        // line 35
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 35), "html", null, true);
        echo "/bootstrap.js\"></script>
        <script src=\"";
        // line 36
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 36), "html", null, true);
        echo "/joinable.js\"></script>
        <script src=\"";
        // line 37
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 37), "html", null, true);
        echo "/resizeable.js\"></script>
        <script src=\"";
        // line 38
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 38), "html", null, true);
        echo "/evolution-api.js\"></script>
        <script src=\"";
        // line 39
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 39), "html", null, true);
        echo "/jquery.validate.min.js\"></script>
        <script src=\"";
        // line 40
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 40), "html", null, true);
        echo "/evolution-login.js\"></script>
    </body>
";
    }

    public function getTemplateName()
    {
        return "account/forgot_password_confirm.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  154 => 40,  150 => 39,  146 => 38,  142 => 37,  138 => 36,  134 => 35,  130 => 34,  125 => 31,  123 => 30,  114 => 26,  107 => 22,  92 => 14,  88 => 13,  82 => 9,  78 => 8,  71 => 6,  64 => 5,  57 => 4,  50 => 3,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "account/forgot_password_confirm.html.twig", "/var/www/html/medicalimage/themes/evolution/views/account/forgot_password_confirm.html.twig");
    }
}


/* account/forgot_password_confirm.html.twig */
class __TwigTemplate_64d3672213b2ed77ccee5488bef21143e8c4b14b6e31ebfaa93bf1561d6fa461___9953789 extends \Twig\Template
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
        // line 30
        return "account/partial/non_login_footer_links.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("account/partial/non_login_footer_links.html.twig", "account/forgot_password_confirm.html.twig", 30);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    public function getTemplateName()
    {
        return "account/forgot_password_confirm.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  201 => 30,  154 => 40,  150 => 39,  146 => 38,  142 => 37,  138 => 36,  134 => 35,  130 => 34,  125 => 31,  123 => 30,  114 => 26,  107 => 22,  92 => 14,  88 => 13,  82 => 9,  78 => 8,  71 => 6,  64 => 5,  57 => 4,  50 => 3,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "account/forgot_password_confirm.html.twig", "/var/www/html/medicalimage/themes/evolution/views/account/forgot_password_confirm.html.twig");
    }
}
