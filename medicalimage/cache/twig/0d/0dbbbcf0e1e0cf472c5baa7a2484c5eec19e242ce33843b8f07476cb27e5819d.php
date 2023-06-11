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

/* admin/ajax/sharing_manage_add_get_folder_listing.html.twig */
class __TwigTemplate_33f118b89fa8b5a461be334faa5d39b3e934213b7ef74506f2721290e86c5d38 extends \Twig\Template
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
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["userFolders"] ?? null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["folderId"] => $context["userFolder"]) {
            // line 2
            echo "    <option value=\"";
            echo twig_escape_filter($this->env, $context["folderId"], "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $context["userFolder"], "html", null, true);
            echo "</option>
";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 4
            echo "    <option value=\"\">- No folders found -</option>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['folderId'], $context['userFolder'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "admin/ajax/sharing_manage_add_get_folder_listing.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  52 => 4,  42 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "admin/ajax/sharing_manage_add_get_folder_listing.html.twig", "/var/www/html/medicalimage/app/views/admin/ajax/sharing_manage_add_get_folder_listing.html.twig");
    }
}
