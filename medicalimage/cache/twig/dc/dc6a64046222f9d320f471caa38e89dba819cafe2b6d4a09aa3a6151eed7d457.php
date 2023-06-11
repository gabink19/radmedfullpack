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

/* register_complete.html.twig */
class __TwigTemplate_62266b38062144875eb3e05a93ebbfcd5059dac7af7be154171a4a70b99ce692 extends \Twig\Template
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
        $this->parent = $this->loadTemplate("account/partial/layout_non_login.html.twig", "register_complete.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("register_complete_page_name", "Registration Completed"), "html", null, true);
    }

    // line 4
    public function block_description($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("register_complete_meta_description", "Your registration has been completed."), "html", null, true);
    }

    // line 5
    public function block_keywords($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("register_complete_meta_keywords", "registration, completed, file, hosting, site"), "html", null, true);
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
        echo "\" class=\"logo\">
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
                        <div class=\"alert alert-success\">
                            <i class=\"entypo-check\"></i> ";
        // line 25
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_successfully_registered", "Account created"), "html", null, true);
        echo "
                        </div>

                        <p class=\"description\">";
        // line 28
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("register_complete_main_text", "We've sent an email to your registered email address with your access password.Please check your spam filters to ensure emails from this site get through. "), "html", null, true);
        echo "</p>
                        <p class=\"description\">";
        // line 29
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("register_complete_email_from", "Emails from this site are sent from "), "html", null, true);
        echo "
                            <a href=\"mailto:";
        // line 30
        echo twig_escape_filter($this->env, ($context["SITE_CONFIG_DEFAULT_EMAIL_ADDRESS_FROM"] ?? null), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, ($context["SITE_CONFIG_DEFAULT_EMAIL_ADDRESS_FROM"] ?? null), "html", null, true);
        echo "</a></p>

                        <div class=\"login-bottom-links\">
                            <a href=\"";
        // line 33
        echo twig_escape_filter($this->env, ($context["CORE_SITE_PATH"] ?? null), "html", null, true);
        echo "/account/login\" class=\"link\"><i class=\"entypo-lock\"></i> ";
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("back_to_login_form", "back to login form")), "html", null, true);
        echo "</a>
                        </div>
                    </div>
                </div>
                ";
        // line 37
        $this->loadTemplate("register_complete.html.twig", "register_complete.html.twig", 37, "2108031916")->display($context);
        // line 38
        echo "            </div>
        </div>
        <!-- Bottom Scripts -->
        <script src=\"";
        // line 41
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 41), "html", null, true);
        echo "/gsap/main-gsap.js\"></script>
        <script src=\"";
        // line 42
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 42), "html", null, true);
        echo "/bootstrap.js\"></script>
        <script src=\"";
        // line 43
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 43), "html", null, true);
        echo "/joinable.js\"></script>
        <script src=\"";
        // line 44
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 44), "html", null, true);
        echo "/resizeable.js\"></script>
        <script src=\"";
        // line 45
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 45), "html", null, true);
        echo "/evolution-api.js\"></script>
        <script src=\"";
        // line 46
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 46), "html", null, true);
        echo "/jquery.validate.min.js\"></script>
        <script src=\"";
        // line 47
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 47), "html", null, true);
        echo "/evolution-login.js\"></script>
        <script src=\"";
        // line 48
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 48), "html", null, true);
        echo "/custom.js\"></script>
    </body>
";
    }

    public function getTemplateName()
    {
        return "register_complete.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  176 => 48,  172 => 47,  168 => 46,  164 => 45,  160 => 44,  156 => 43,  152 => 42,  148 => 41,  143 => 38,  141 => 37,  132 => 33,  124 => 30,  120 => 29,  116 => 28,  110 => 25,  92 => 14,  88 => 13,  82 => 9,  78 => 8,  71 => 6,  64 => 5,  57 => 4,  50 => 3,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "register_complete.html.twig", "/var/www/html/medicalimage/themes/evolution/views/register_complete.html.twig");
    }
}


/* register_complete.html.twig */
class __TwigTemplate_62266b38062144875eb3e05a93ebbfcd5059dac7af7be154171a4a70b99ce692___2108031916 extends \Twig\Template
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
        // line 37
        return "account/partial/non_login_footer_links.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("account/partial/non_login_footer_links.html.twig", "register_complete.html.twig", 37);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    public function getTemplateName()
    {
        return "register_complete.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  223 => 37,  176 => 48,  172 => 47,  168 => 46,  164 => 45,  160 => 44,  156 => 43,  152 => 42,  148 => 41,  143 => 38,  141 => 37,  132 => 33,  124 => 30,  120 => 29,  116 => 28,  110 => 25,  92 => 14,  88 => 13,  82 => 9,  78 => 8,  71 => 6,  64 => 5,  57 => 4,  50 => 3,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "register_complete.html.twig", "/var/www/html/medicalimage/themes/evolution/views/register_complete.html.twig");
    }
}
