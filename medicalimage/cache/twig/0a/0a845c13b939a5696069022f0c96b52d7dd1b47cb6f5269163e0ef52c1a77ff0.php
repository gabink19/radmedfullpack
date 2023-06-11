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

/* account/ajax/share_file_folder_internally_existing.html.twig */
class __TwigTemplate_763fdf089368611ffb433271220c0d34cafdb4e3d3b1d0c4c5d6cfc4835d0a0c extends \Twig\Template
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
        if ((twig_length_filter($this->env, ($context["folderShares"] ?? null)) > 0)) {
            // line 2
            echo "    <p>";
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("edit_folder_internal_share_existing_intro", "Existing Shares:"), "html", null, true);
            echo "</p>
    <table class=\"table table-striped table-bordered\">
        <thead>
        <th>";
            // line 5
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("edit_folder_internal_share_email", "Registered Email Address:"), "html", null, true);
            echo "</th>
        <th class=\"center\" style=\"width: 140px;\">";
            // line 6
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("edit_folder_internal_access_level", "Access Level:"), "html", null, true);
            echo "</th>
        <th class=\"center\" style=\"width: 50px;\"></th>
    </thead>
    <tbody>
        ";
            // line 10
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["folderShares"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["folderShare"]) {
                // line 11
                echo "        <tr>
            <td>";
                // line 12
                echo twig_escape_filter($this->env, (($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = $context["folderShare"]) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4["email"] ?? null) : null), "html", null, true);
                echo "</td>
            <td class=\"center\">";
                // line 13
                echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler(("folder_share_permission_" . (($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 = $context["folderShare"]) && is_array($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144) || $__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 instanceof ArrayAccess ? ($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144["share_permission_level"] ?? null) : null)), twig_replace_filter((($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b = $context["folderShare"]) && is_array($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b) || $__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b instanceof ArrayAccess ? ($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b["share_permission_level"] ?? null) : null), ["%this%" => "_", "%that%" => " "]))), "html", null, true);
                echo " </td>
            <td class=\"center\"><a href=\"#\" onClick=\"shareFolderInternallyRemove(";
                // line 14
                echo twig_escape_filter($this->env, (($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 = $context["folderShare"]) && is_array($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002) || $__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 instanceof ArrayAccess ? ($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002["id"] ?? null) : null), "html", null, true);
                echo ", ";
                echo twig_escape_filter($this->env, json_encode(($context["fileIds"] ?? null)), "html", null, true);
                echo ", ";
                echo twig_escape_filter($this->env, json_encode(($context["folderIds"] ?? null)), "html", null, true);
                echo ");\"><span class=\"glyphicon glyphicon-remove text-danger\"></span></a></td>
        </tr>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['folderShare'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 17
            echo "    </tbody>
";
        }
    }

    public function getTemplateName()
    {
        return "account/ajax/share_file_folder_internally_existing.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  85 => 17,  72 => 14,  68 => 13,  64 => 12,  61 => 11,  57 => 10,  50 => 6,  46 => 5,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "account/ajax/share_file_folder_internally_existing.html.twig", "/var/www/html/medicalimage/themes/evolution/views/account/ajax/share_file_folder_internally_existing.html.twig");
    }
}
