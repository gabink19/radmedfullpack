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

/* account/ajax/edit_file.html.twig */
class __TwigTemplate_af0e92c9726b80aae0227815c110399ca5510550d65e35d04075a99281215b4d extends \Twig\Template
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
        echo "/ajax/edit_file_process\" autocomplete=\"off\">
    <div class=\"modal-header\">
        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
        <h4 class=\"modal-title\">";
        // line 4
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("edit_existing_item", "Edit Existing Item"), "html", null, true);
        echo " (";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "originalFilename", [], "any", false, false, false, 4), "html", null, true);
        echo ")</h4>
    </div>

    <div class=\"modal-body\">
        <div class=\"row\">

            <div class=\"col-md-3\">
                <div class=\"modal-icon-left\"><img src=\"";
        // line 11
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountImagePath", [], "method", false, false, false, 11), "html", null, true);
        echo "/modal_icons/document_edit.png\"/></div>
            </div>

            <div class=\"col-md-9\">

                <div class=\"row\">
                    <div class=\"col-md-12\">
                        <div class=\"form-group\">
                            <label for=\"filename\" class=\"control-label\">";
        // line 19
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("filename", "filename")), "html", null, true);
        echo "</label>
                            <div class=\"input-group\">
                                <input type=\"text\" class=\"form-control\" name=\"filename\" id=\"filename\" value=\"";
        // line 21
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "getFilenameExcExtension", [], "method", false, false, false, 21), "html", null, true);
        echo "\"/>
                                <span class=\"input-group-addon\">.";
        // line 22
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "extension", [], "any", false, false, false, 22), "html", null, true);
        echo "</span>
                            </div>
                        </div>
                    </div>
                </div>
                            
                <div class=\"row\">
                    <div class=\"col-md-12\">
                        <div class=\"form-group\">
                            <label for=\"folderName\" class=\"control-label\">";
        // line 31
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("edit_image_sharing_url", "Sharing Url:"), "html", null, true);
        echo "</label>
                            <div class=\"input-group\">
                                <input type=\"text\" class=\"form-control\" value=\"";
        // line 33
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "getFullShortUrl", [], "method", false, false, false, 33), "html", null, true);
        echo "\" readonly/>
                                <span class=\"input-group-btn\">
                                    <button type=\"button\" class=\"btn btn-primary\" onClick=\"window.open('";
        // line 35
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "getFullShortUrl", [], "method", false, false, false, 35), "html", null, true);
        echo "');
                                                                                return false;\"><i class=\"entypo-link\"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class=\"row\">
                    <div class=\"col-md-12\">
                        <div class=\"form-group\">
                            <label for=\"description\" class=\"control-label\">";
        // line 46
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("description", "description")), "html", null, true);
        echo "</label>
                            <textarea rows=\"3\" class=\"form-control\" name=\"description\" id=\"description\">";
        // line 47
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "description", [], "any", false, false, false, 47), "html", null, true);
        echo "</textarea>
                        </div>
                    </div>
                </div>

                <div class=\"row\">
                    <div class=\"col-md-12\">
                        <div class=\"form-group\">
                            <label for=\"keywords\" class=\"control-label\">";
        // line 55
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("keywords", "keywords")), "html", null, true);
        echo "</label>
                            <input type=\"text\" class=\"form-control tagsinput\" name=\"keywords\" id=\"keywords\" value=\"";
        // line 56
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "keywords", [], "any", false, false, false, 56), "html", null, true);
        echo "\"/>
                        </div>
                    </div>
                </div>

                <div class=\"row\">
                    <div class=\"col-md-6\">
                        <div class=\"form-group\">
                            <label for=\"folder\" class=\"control-label\">";
        // line 64
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("file_folder", "file folder")), "html", null, true);
        echo "</label>
                            <select class=\"form-control\" name=\"folder\" id=\"folder\">
                                <option value=\"\">";
        // line 66
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("_default_", "- Default -"), "html", null, true);
        echo "</option>
                                ";
        // line 67
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["folderListing"] ?? null));
        foreach ($context['_seq'] as $context["k"] => $context["folderListingItem"]) {
            // line 68
            echo "                                    <option value=\"";
            echo twig_escape_filter($this->env, $context["k"], "html", null, true);
            echo "\"";
            if ((twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "folderId", [], "any", false, false, false, 68) == $context["k"])) {
                echo " SELECTED";
            }
            echo ">
                                        ";
            // line 69
            echo twig_escape_filter($this->env, $context["folderListingItem"], "html", null, true);
            echo "
                                    </option>
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['k'], $context['folderListingItem'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 72
        echo "                            </select>
                        </div>
                    </div>

                    <div class=\"col-md-6\">
                        <div class=\"form-group\">
                            <label for=\"reset_stats\" class=\"control-label\">";
        // line 78
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("reset_stats", "reset stats")), "html", null, true);
        echo "</label>
                            <select class=\"form-control\" name=\"reset_stats\" id=\"reset_stats\">
                                <option value=\"0\" SELECTED>";
        // line 80
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("no_keep_stats", "No, keep stats"), "html", null, true);
        echo "</option>
                                <option value=\"1\">";
        // line 81
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("yes_remove_stats", "Yes, remove stats"), "html", null, true);
        echo "</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class=\"modal-footer\">
        <input type=\"hidden\" name=\"submitme\" id=\"submitme\" value=\"1\"/>
        <input type=\"hidden\" value=\"";
        // line 92
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "id", [], "any", false, false, false, 92), "html", null, true);
        echo "\" name=\"fileId\"/>
        <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">";
        // line 93
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("cancel", "cancel")), "html", null, true);
        echo "</button>
        <button type=\"button\" class=\"btn btn-info\" data-submit-btn=\"true\" onClick=\"processAjaxForm(this, function () {
                    reloadPreviousAjax();
                    \$('.modal').modal('hide');
                });
                return false;\">";
        // line 98
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("update_item", "update item")), "html", null, true);
        echo " <i class=\"entypo-check\"></i></button>
    </div>
</form>";
    }

    public function getTemplateName()
    {
        return "account/ajax/edit_file.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  216 => 98,  208 => 93,  204 => 92,  190 => 81,  186 => 80,  181 => 78,  173 => 72,  164 => 69,  155 => 68,  151 => 67,  147 => 66,  142 => 64,  131 => 56,  127 => 55,  116 => 47,  112 => 46,  98 => 35,  93 => 33,  88 => 31,  76 => 22,  72 => 21,  67 => 19,  56 => 11,  44 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "account/ajax/edit_file.html.twig", "/var/www/html/medicalimage/themes/evolution/views/account/ajax/edit_file.html.twig");
    }
}
