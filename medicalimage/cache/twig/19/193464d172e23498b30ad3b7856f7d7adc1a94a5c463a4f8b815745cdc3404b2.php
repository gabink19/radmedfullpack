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

/* account/partial/notifications.html.twig */
class __TwigTemplate_3e9b1f6db6a72cc8968fbaa79de6e31b1f51b34fce7d5bd21b53bcc67e2af36c extends \Twig\Template
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
        if ((isset($context["msg_page_errors"]) || array_key_exists("msg_page_errors", $context))) {
            // line 2
            echo "    <script>
    \$(document).ready(function () {
        showErrorNotification(\"";
            // line 4
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("error", "Error"), "html", null, true);
            echo "\", \"";
            echo twig_escape_filter($this->env, twig_join_filter(($context["msg_page_errors"] ?? null)), "html", null, true);
            echo "\");
    });
    </script>
";
        } elseif (        // line 7
(isset($context["msg_page_successes"]) || array_key_exists("msg_page_successes", $context))) {
            // line 8
            echo "    <script>
    \$(document).ready(function () {
        showSuccessNotification(\"";
            // line 10
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("success", "Success"), "html", null, true);
            echo "\", \"";
            echo twig_escape_filter($this->env, twig_join_filter(($context["msg_page_successes"] ?? null)), "html", null, true);
            echo "\");
    });
    </script>
";
        }
    }

    public function getTemplateName()
    {
        return "account/partial/notifications.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  57 => 10,  53 => 8,  51 => 7,  43 => 4,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "account/partial/notifications.html.twig", "/var/www/html/medicalimage/themes/evolution/views/account/partial/notifications.html.twig");
    }
}
