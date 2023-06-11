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

/* account/ajax/restore_from_trash.html.twig */
class __TwigTemplate_ba8a5e597e1c179a15ca425905f9229d7e0be36af3b88703212535c27a796de5 extends \Twig\Template
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
        echo "<form action=\"";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountWebRoot", [], "method", false, false, false, 1), "html", null, true);
        echo "/ajax/restore_from_trash_process\" autocomplete=\"off\">
    <div class=\"modal-header\">
        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
        <h4 class=\"modal-title\">";
        // line 4
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("restore_items", "Restore Items"), "html", null, true);
        echo " (";
        echo twig_escape_filter($this->env, ($context["totalItems"] ?? null), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("items", "items"), "html", null, true);
        echo ")</h4>
    </div>

    <div class=\"modal-body\">
            <div class=\"row\">
                <div class=\"col-md-12\">
                    <div class=\"form-group\">
                        <label for=\"folder\" class=\"control-label\">";
        // line 11
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("restore_to_folder", "restore to folder")), "html", null, true);
        echo "</label>
                        <select class=\"form-control\" name=\"restoreFolderId\" id=\"restoreFolderId\">
                            <option value=\"\">/</option>
                            ";
        // line 14
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["folderListing"] ?? null));
        foreach ($context['_seq'] as $context["k"] => $context["folderListingItem"]) {
            // line 15
            echo "                                <option value=\"";
            echo twig_escape_filter($this->env, $context["k"], "html", null, true);
            echo "\">
                                    ";
            // line 16
            echo twig_escape_filter($this->env, $context["folderListingItem"], "html", null, true);
            echo "
                                </option>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['k'], $context['folderListingItem'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 19
        echo "                        </select>
                    </div>
                    <p>";
        // line 21
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("restore_note_file_contents_included", "Note that restoring a folder will also restore any files within it."), "html", null, true);
        echo "</p>
                </div>
            </div>
    </div>
    <div class=\"modal-footer\">
        <input type=\"hidden\" name=\"submitme\" id=\"submitme\" value=\"1\"/>
        ";
        // line 27
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["checkedFileIds"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["checkedFileId"]) {
            // line 28
            echo "        <input type=\"hidden\" value=\"";
            echo twig_escape_filter($this->env, (($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = $context["checkedFileId"]) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4["id"] ?? null) : null), "html", null, true);
            echo "\" name=\"fileIds[]\"/>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['checkedFileId'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 30
        echo "        
        ";
        // line 31
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["checkedFolderIds"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["checkedFolderId"]) {
            // line 32
            echo "        <input type=\"hidden\" value=\"";
            echo twig_escape_filter($this->env, (($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 = $context["checkedFolderId"]) && is_array($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144) || $__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 instanceof ArrayAccess ? ($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144["id"] ?? null) : null), "html", null, true);
            echo "\" name=\"folderIds[]\"/>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['checkedFolderId'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 34
        echo "
        <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">";
        // line 35
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("cancel", "cancel"), "html", null, true);
        echo "</button>
        <button type=\"button\" class=\"btn btn-info\" onClick=\"processAjaxForm(this, function () {
                    refreshFileListing();
                    \$('.modal').modal('hide');
                });
                return false;\">";
        // line 40
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("restore", "restore")), "html", null, true);
        echo " <i class=\"entypo-check\"></i></button>
    </div>
</form>";
    }

    public function getTemplateName()
    {
        return "account/ajax/restore_from_trash.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  135 => 40,  127 => 35,  124 => 34,  115 => 32,  111 => 31,  108 => 30,  99 => 28,  95 => 27,  86 => 21,  82 => 19,  73 => 16,  68 => 15,  64 => 14,  58 => 11,  44 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "account/ajax/restore_from_trash.html.twig", "/var/www/html/medicalimage/themes/evolution/views/account/ajax/restore_from_trash.html.twig");
    }
}
