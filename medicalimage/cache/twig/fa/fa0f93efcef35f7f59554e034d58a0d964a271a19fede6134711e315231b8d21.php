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

/* account/partial/_preview_document.html.twig */
class __TwigTemplate_6ec7e986f637518cc959bd1f948377c4316202fbe4500aa00ed5621263b3321a extends \Twig\Template
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
        if ((twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "fileSize", [], "any", false, false, false, 1) >= 52428800)) {
            // line 2
            echo "    <div class=\"alert alert-warning\" role=\"alert\">";
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("document_can_not_be_previewed", "Document can not be previewed as it is too big. Please download the file to view it."), "html", null, true);
            echo "</div>
\t";
            // line 3
            $this->loadTemplate("account/partial/_preview_download.html.twig", "account/partial/_preview_document.html.twig", 3)->display($context);
        } else {
            // line 5
            echo "    <iframe src=\"https://docs.google.com/gview?url=";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "generateDirectDownloadUrlForMedia", [], "method", false, false, false, 5), "html", null, true);
            echo "&embedded=true\" height=\"700\" width=\"100%\" frameborder=\"0\" style=\"border: 0px solid #ddd;\" class=\"background-loader\"></iframe>
";
        }
    }

    public function getTemplateName()
    {
        return "account/partial/_preview_document.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  47 => 5,  44 => 3,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "account/partial/_preview_document.html.twig", "/var/www/html/medicalimage/themes/evolution/views/account/partial/_preview_document.html.twig");
    }
}
