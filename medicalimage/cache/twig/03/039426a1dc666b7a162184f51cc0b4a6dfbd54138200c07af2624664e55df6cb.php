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

/* admin/login.html.twig */
class __TwigTemplate_a4e17c6229c5edf734d9f31191fd504cfc7e5289e383af93948a95011033357f extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "admin/partial/layout_non_login.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("admin/partial/layout_non_login.html.twig", "admin/login.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("admin_login", "admin login")), "html", null, true);
    }

    // line 5
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 6
        echo "    <body class=\"login\">
    <div>
        <div class=\"login_wrapper\">
            <div class=\"animate form login_form\">
                <section class=\"login_content\">
                    <form method=\"POST\" action=\"";
        // line 11
        echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/login\">
                        <h1>";
        // line 12
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("admin_login", "admin login")), "html", null, true);
        echo "</h1>

                        ";
        // line 14
        echo ($context["msg_page_notifications"] ?? null);
        echo "

                        <div>
                            <input name=\"username\" type=\"text\" class=\"form-control\" placeholder=\"";
        // line 17
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("username", "username")), "html", null, true);
        echo "\" required=\"\" autofocus=\"\" value=\"";
        echo twig_escape_filter($this->env, ($context["username"] ?? null), "html", null, true);
        echo "\"/>
                        </div>
                        <div>
                            <input name=\"password\" type=\"password\" class=\"form-control\" placeholder=\"";
        // line 20
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("password", "password")), "html", null, true);
        echo "\" required=\"\" value=\"";
        echo twig_escape_filter($this->env, ($context["password"] ?? null), "html", null, true);
        echo "\"/>
                        </div>
                        ";
        // line 22
        if ((($context["SITE_CONFIG_CAPTCHA_LOGIN_SCREEN_ADMIN"] ?? null) == "yes")) {
            // line 23
            echo "                            <div style=\"padding-left: 21px; padding-bottom: 16px; overflow: hidden;\">
                                ";
            // line 24
            echo twig_get_attribute($this->env, $this->source, ($context["CoreHelper"] ?? null), "outputCaptcha", [], "method", false, false, false, 24);
            echo "
                            </div>
                        ";
        }
        // line 27
        echo "
                        <div>
                            <button type=\"submit\" value=\"";
        // line 29
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("login", "login"), "html", null, true);
        echo "\" class=\"btn btn-default submit\">";
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("login", "login")), "html", null, true);
        echo "</button>
                            <a href=\"";
        // line 30
        echo twig_escape_filter($this->env, ($context["WEB_ROOT"] ?? null), "html", null, true);
        echo "/account/forgot_password\">";
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("forgot_password", "forgot password")), "html", null, true);
        echo "?</a>
                        </div>

                        <div class=\"clearfix\"></div>

                        <div class=\"separator\">
                            <p class=\"change_link\">";
        // line 36
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("admin_login_all_logins_records", "All logins are recorded. Your IP address: [[[IP_ADDRESS]]].", ["IP_ADDRESS" => ($context["userIpAddress"] ?? null)]), "html", null, true);
        echo "</p>
                            <div class=\"clearfix\"></div>
                            <div>
                                <p>&copy; ";
        // line 39
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "Y"), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, ($context["SITE_CONFIG_SITE_NAME"] ?? null), "html", null, true);
        echo ". ";
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("admin_login_all_rights_reserved", "All Rights Reserved"), "html", null, true);
        echo ".</p>
                            </div>
                        </div>

                        <input id=\"submitme\" name=\"submitme\" value=\"1\" type=\"hidden\"/>
                        <input id=\"version\" name=\"version\" value=\"";
        // line 44
        echo twig_escape_filter($this->env, ($context["scriptVersion"] ?? null), "html", null, true);
        echo "\" type=\"hidden\"/>
                    </form>
                </section>
            </div>
        </div>
    </div>
</body>
";
    }

    public function getTemplateName()
    {
        return "admin/login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  145 => 44,  133 => 39,  127 => 36,  116 => 30,  110 => 29,  106 => 27,  100 => 24,  97 => 23,  95 => 22,  88 => 20,  80 => 17,  74 => 14,  69 => 12,  65 => 11,  58 => 6,  54 => 5,  47 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "admin/login.html.twig", "/var/www/html/medicalimage/app/views/admin/login.html.twig");
    }
}
