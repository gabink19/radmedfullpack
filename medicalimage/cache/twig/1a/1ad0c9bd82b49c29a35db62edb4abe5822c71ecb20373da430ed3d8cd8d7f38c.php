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

/* account/partial/non_login_footer_links.html.twig */
class __TwigTemplate_f571189ebe13aa628a0a60f52ceff1ba8886913c6d8af42f32fcd3ea65fa08c3 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<div class=\"footer-login-links\">
    <a href=\"";
        // line 2
        echo twig_escape_filter($this->env, ($context["CORE_SITE_PATH"] ?? null), "html", null, true);
        echo "/terms\">";
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("terms_and_conditions", "terms & conditions")), "html", null, true);
        echo "</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"";
        echo twig_escape_filter($this->env, ($context["CORE_SITE_PATH"] ?? null), "html", null, true);
        echo "/privacy\">";
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("privacy", "privacy")), "html", null, true);
        echo "</a>&nbsp;&nbsp;|&nbsp;&nbsp;Powered by <a href=\"http://www.disana.id\" target=\"_blank\">Disana</a><br/>
    ";
        // line 3
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("copyright", "copyright")), "html", null, true);
        echo " &copy; ";
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "Y"), "html", null, true);
        echo " - <a href=\"http://radmed.co.id\" target=\"_blank\">";
        echo twig_escape_filter($this->env, ($context["SITE_CONFIG_SITE_NAME"] ?? null), "html", null, true);
        echo "</a>
</div>";
    }

    public function getTemplateName()
    {
        return "account/partial/non_login_footer_links.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  50 => 3,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "account/partial/non_login_footer_links.html.twig", "/var/www/html/medicalimage/themes/evolution/views/account/partial/non_login_footer_links.html.twig");
    }
}
