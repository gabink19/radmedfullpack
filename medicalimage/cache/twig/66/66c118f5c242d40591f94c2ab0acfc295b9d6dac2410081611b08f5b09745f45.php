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

/* account/partial/_preview_image.html.twig */
class __TwigTemplate_7a7b49ed395a162b7e9f68a2397e2e5116bd9283814610ef195ec96cb926d667 extends \Twig\Template
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
        echo "<div class=\"image-fullscreen-link\">
    <a href=\"#\" onClick=\"showFullScreen('";
        // line 2
        echo twig_escape_filter($this->env, ($context["imageLink"] ?? null), "html", null, true);
        echo "', ";
        echo twig_escape_filter($this->env, ($context["fullScreenWidth"] ?? null), "html", null, true);
        echo ", ";
        echo twig_escape_filter($this->env, ($context["fullScreenHeight"] ?? null), "html", null, true);
        echo "); return false;\"><i class=\"entypo-resize-full\"></i></a>
</div>
<img src=\"";
        // line 4
        echo twig_escape_filter($this->env, ($context["imageLink"] ?? null), "html", null, true);
        echo "\" class=\"image-preview background-loader\" onLoad=\"\$('.content-preview-wrapper').removeClass('loader');\"/>

<!-- pre cache next and previous images -->
<div class=\"pre-image-cache-wrapper\">
    ";
        // line 8
        if ((twig_length_filter($this->env, ($context["imageNextLink"] ?? null)) > 0)) {
            // line 9
            echo "        <img src=\"";
            echo twig_escape_filter($this->env, ($context["imageNextLink"] ?? null), "html", null, true);
            echo "\"/>
    ";
        }
        // line 11
        echo "    
    ";
        // line 12
        if ((twig_length_filter($this->env, ($context["imagePrevLink"] ?? null)) > 0)) {
            // line 13
            echo "        <img src=\"";
            echo twig_escape_filter($this->env, ($context["imagePrevLink"] ?? null), "html", null, true);
            echo "\"/>
    ";
        }
        // line 15
        echo "</div>";
    }

    public function getTemplateName()
    {
        return "account/partial/_preview_image.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  75 => 15,  69 => 13,  67 => 12,  64 => 11,  58 => 9,  56 => 8,  49 => 4,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "account/partial/_preview_image.html.twig", "/var/www/html/medicalimage/themes/evolution/views/account/partial/_preview_image.html.twig");
    }
}
