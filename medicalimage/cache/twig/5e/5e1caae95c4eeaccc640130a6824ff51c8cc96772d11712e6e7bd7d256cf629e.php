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

/* admin/ajax/translation_manage_text_edit_form.html.twig */
class __TwigTemplate_cfebc9d4cc7774dbdbefd0b1371ddffb5bde478bf2a30a7c325af4ae7643a20c extends \Twig\Template
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
        echo "<p style=\"padding-bottom: 4px;\">Use the form below to update the translation.</p>
<span id=\"popupMessageContainer\"></span>
<form id=\"updateConfigurationForm\" class=\"form-horizontal form-label-left input_mask\">
    <table class=\"table table-data-list\">
        <tr>
            <td>Key:</td>
            <td>";
        // line 7
        echo twig_escape_filter($this->env, (($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = ($context["translation"] ?? null)) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4["languageKey"] ?? null) : null), "html", null, true);
        echo "</td>
        </tr>
        <tr>
            <td>Original English Text:</td>
            <td>";
        // line 11
        echo twig_escape_filter($this->env, (($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 = ($context["translation"] ?? null)) && is_array($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144) || $__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 instanceof ArrayAccess ? ($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144["defaultContent"] ?? null) : null), "html", null, true);
        echo "</td>
        <input id=\"enTranslationText\" type=\"text\" value=\"";
        // line 12
        echo twig_escape_filter($this->env, (($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b = ($context["translation"] ?? null)) && is_array($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b) || $__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b instanceof ArrayAccess ? ($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b["defaultContent"] ?? null) : null), "html", null, true);
        echo "\" style=\"display: none;\"/>
        <input id=\"enTranslationCode\" type=\"text\" value=\"";
        // line 13
        echo twig_escape_filter($this->env, (($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 = ($context["translation"] ?? null)) && is_array($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002) || $__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 instanceof ArrayAccess ? ($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002["language_code"] ?? null) : null), "html", null, true);
        echo "\" style=\"display: none;\"/>
        </tr>
    </table>

    <div class=\"form-group\">
        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Translated Text: <a href=\"#\" onClick=\"processAutoTranslate();
                return false;\" style=\"text-decoration: underline;\">(auto)</a></label>
        <div class=\"col-md-9 col-sm-9 col-xs-12\">
            <textarea name=\"translated_content\" id=\"translated_content\" class=\"form-control\" style=\"height: 80px;\">";
        // line 21
        echo twig_escape_filter($this->env, (($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 = ($context["translation"] ?? null)) && is_array($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4) || $__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4 instanceof ArrayAccess ? ($__internal_d7fc55f1a54b629533d60b43063289db62e68921ee7a5f8de562bd9d4a2b7ad4["content"] ?? null) : null), "html", null, true);
        echo "</textarea>
        </div>
    </div>
    <input id=\"translation_item_id\" name=\"translation_item_id\" value=\"";
        // line 24
        echo twig_escape_filter($this->env, ($context["gTranslationId"] ?? null), "html", null, true);
        echo "\" type=\"hidden\"/>
</form>";
    }

    public function getTemplateName()
    {
        return "admin/ajax/translation_manage_text_edit_form.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  77 => 24,  71 => 21,  60 => 13,  56 => 12,  52 => 11,  45 => 7,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "admin/ajax/translation_manage_text_edit_form.html.twig", "/var/www/html/medicalimage/app/views/admin/ajax/translation_manage_text_edit_form.html.twig");
    }
}
