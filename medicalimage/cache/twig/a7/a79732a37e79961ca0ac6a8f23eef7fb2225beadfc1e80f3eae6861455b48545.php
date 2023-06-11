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

/* admin/partial/layout_non_login.html.twig */
class __TwigTemplate_13cfcd2979d3223eba6c4c578ccfefa9dc42844bc85f62f12fad3c41e4b3909e extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
  <head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">

    <title>";
        // line 10
        $this->displayBlock("title", $context, $blocks);
        echo " - ";
        echo twig_escape_filter($this->env, ($context["SITE_CONFIG_SITE_NAME"] ?? null), "html", null, true);
        echo "</title>

    <!-- Bootstrap -->
    <link href=\"";
        // line 13
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/bootstrap/dist/css/bootstrap.min.css\" rel=\"stylesheet\">
    <!-- Font Awesome -->
    <link href=\"";
        // line 15
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/font-awesome/css/font-awesome.min.css\" rel=\"stylesheet\">
    <!-- NProgress -->
    <link href=\"";
        // line 17
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/nprogress/nprogress.css\" rel=\"stylesheet\">
    <!-- Animate.css -->
    <link href=\"";
        // line 19
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/animate.css/animate.min.css\" rel=\"stylesheet\">

    <!-- Custom Theme Style -->
    <link href=\"";
        // line 22
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/css/custom.css\" rel=\"stylesheet\">
  </head>
";
        // line 24
        $this->displayBlock('body', $context, $blocks);
        // line 25
        echo "</html>";
    }

    // line 24
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    public function getTemplateName()
    {
        return "admin/partial/layout_non_login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  89 => 24,  85 => 25,  83 => 24,  78 => 22,  72 => 19,  67 => 17,  62 => 15,  57 => 13,  49 => 10,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "admin/partial/layout_non_login.html.twig", "/var/www/html/medicalimage/app/views/admin/partial/layout_non_login.html.twig");
    }
}
