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

/* admin/ajax/sharing_manage_add_form.html.twig */
class __TwigTemplate_8a2b08708b0d5de58f164f92dbbe8b0536cf24aafc524589858332cb0d523664 extends \Twig\Template
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
        echo "<form id=\"addSharingForm\" class=\"form-horizontal form-label-left input_mask\">
    <div class=\"x_panel\">
        <div class=\"x_title\">
            <h2>Create New Share</h2>
            <div class=\"clearfix\"></div>
        </div>

        <p>Use the form below to share a folder with either another user or globally on the site. If you want to share more than 1 folder, you can use the sharing functionality built into the front-end file manager. This tool only allows for 1 folder at a time at the moment.<br/><br/></p>

        <div class=\"form-group\">
            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
        // line 11
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("select_account_owner", "select account owner")), "html", null, true);
        echo ":</label>
            <div class=\"col-md-8 col-sm-8 col-xs-12\">
                <select name=\"created_by_user_id\" id=\"created_by_user_id\" class=\"form-control\" onchange=\"updateFolderSelect(); return false;\">
                    ";
        // line 14
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["users"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
            // line 15
            echo "                        <option value=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["user"], "id", [], "any", false, false, false, 15), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["user"], "username", [], "any", false, false, false, 15), "html", null, true);
            echo "</option>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['user'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 17
        echo "                </select>
            </div>
        </div>

        <div class=\"form-group\">
            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
        // line 22
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("select_folder", "select folder")), "html", null, true);
        echo ":</label>
            <div class=\"col-md-8 col-sm-8 col-xs-12\" id=\"folderSelect\">
                <select name=\"folder_id\" id=\"folder_id\" class=\"form-control\" required=\"required\"></select>
            </div>
        </div>

        <div class=\"form-group\">
            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
        // line 29
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("shared_with", "share with")), "html", null, true);
        echo ":</label>
            <div class=\"col-md-8 col-sm-8 col-xs-12\">
                <select name=\"shared_with_user_id\" id=\"shared_with_user_id\" class=\"form-control\">
                    <option>- All Users (Everyone will have access to the folder) -</option>
                    ";
        // line 33
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["users"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
            // line 34
            echo "                        <option value=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["user"], "id", [], "any", false, false, false, 34), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["user"], "username", [], "any", false, false, false, 34), "html", null, true);
            echo "</option>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['user'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 36
        echo "                </select>
            </div>
        </div>

        <div class=\"form-group\">
            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
        // line 41
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("access_level", "access level")), "html", null, true);
        echo ":</label>
            <div class=\"col-md-5 col-sm-5 col-xs-12\">
                <select name=\"share_permission_level\" id=\"share_permission_level\" class=\"form-control\">
                    ";
        // line 44
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["accessLevels"] ?? null));
        foreach ($context['_seq'] as $context["k"] => $context["accessLevel"]) {
            // line 45
            echo "                        <option value=\"";
            echo twig_escape_filter($this->env, $context["k"], "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $context["accessLevel"], "html", null, true);
            echo "</option>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['k'], $context['accessLevel'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 47
        echo "                </select>
            </div>
        </div>
    </div>
</form>";
    }

    public function getTemplateName()
    {
        return "admin/ajax/sharing_manage_add_form.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  137 => 47,  126 => 45,  122 => 44,  116 => 41,  109 => 36,  98 => 34,  94 => 33,  87 => 29,  77 => 22,  70 => 17,  59 => 15,  55 => 14,  49 => 11,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "admin/ajax/sharing_manage_add_form.html.twig", "/var/www/html/medicalimage/app/views/admin/ajax/sharing_manage_add_form.html.twig");
    }
}
