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

/* admin/ajax/translation_manage_add_form.html.twig */
class __TwigTemplate_3ac9aebf4d6fbb2d02fa7a9acd9982bf9c0567a6a0ef534a2bb85a13d44b4098 extends \Twig\Template
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
        echo "<p>Use the form below to add a new language. Once it's created, you can edit any of the text items into your preferred language.</p>
<form id=\"addTranslationForm\" class=\"form-horizontal form-label-left input_mask\">
    <div class=\"form-group\">
        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Language Name:</label>
        <div class=\"col-md-9 col-sm-9 col-xs-12\">
            <input name=\"translation_name\" id=\"translation_name\" type=\"text\" value=\"";
        // line 6
        echo twig_escape_filter($this->env, ($context["translation_name"] ?? null), "html", null, true);
        echo "\" class=\"form-control\"/>
        </div>
    </div>
    <div class=\"form-group\">
        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Text Direction:</label>
        <div class=\"col-md-9 col-sm-9 col-xs-12\">
            <select name=\"direction\" id=\"direction\" class=\"form-control\">
                <option value=\"LTR\"";
        // line 13
        echo (((($context["direction"] ?? null) == "LTR")) ? (" SELECTED") : (""));
        echo ">Left To Right (LTR)</option>
                <option value=\"RTL\"";
        // line 14
        echo (((($context["direction"] ?? null) == "RTL")) ? (" SELECTED") : (""));
        echo ">Right To Left (RTL)</option>
            </select>
            <span class=\"text-muted\">
                Note: This is entirely dependant on the theme used, this setting just provides the theme with a request to show text in this direction. If the theme doesn't support this setting, it will be ignored.
            </span>
        </div>
    </div>
    <div class=\"form-group\">
        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Language Flag:</label>
        <div class=\"col-md-5 col-sm-5 col-xs-12\">
            <select name=\"translation_flag\" id=\"translation_flag\" class=\"form-control\">
                ";
        // line 25
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["flags"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["flag"]) {
            // line 26
            echo "                    <option data-content=\"<img src='";
            echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/images/icons/flags/";
            echo twig_escape_filter($this->env, $context["flag"], "html", null, true);
            echo "'/>&nbsp;&nbsp;";
            echo twig_escape_filter($this->env, $context["flag"], "html", null, true);
            echo "\" value=\"";
            echo twig_escape_filter($this->env, $context["flag"], "html", null, true);
            echo "\"";
            echo (((($context["translation_flag"] ?? null) == $context["flag"])) ? (" SELECTED") : (""));
            echo ">";
            echo twig_escape_filter($this->env, $context["flag"], "html", null, true);
            echo "</option>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['flag'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 28
        echo "            </select>
        </div>
    </div>
    <div class=\"form-group\">
        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">Language Code:</label>
        <div class=\"col-md-5 col-sm-5 col-xs-12\">
            <select name=\"language_code\" id=\"language_code\" class=\"form-control\">
                <option value=\"\">- select -</option>
                ";
        // line 36
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["languageCodes"] ?? null));
        foreach ($context['_seq'] as $context["k"] => $context["languageCode"]) {
            // line 37
            echo "                    <option value=\"";
            echo twig_escape_filter($this->env, $context["k"], "html", null, true);
            echo "\"";
            echo (((($context["language_code"] ?? null) == $context["k"])) ? (" SELECTED") : (""));
            echo ">";
            echo twig_escape_filter($this->env, twig_upper_filter($this->env, $context["k"]), "html", null, true);
            echo " (";
            echo twig_escape_filter($this->env, $context["languageCode"], "html", null, true);
            echo ")</option>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['k'], $context['languageCode'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 39
        echo "
            </select>
        </div>
    </div>
    <input name=\"translation_flag_hidden\" id=\"translation_flag_hidden\" type=\"hidden\" value=\"";
        // line 43
        echo twig_escape_filter($this->env, ($context["translation_flag"] ?? null), "html", null, true);
        echo ".png\"/>
</form>";
    }

    public function getTemplateName()
    {
        return "admin/ajax/translation_manage_add_form.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  130 => 43,  124 => 39,  109 => 37,  105 => 36,  95 => 28,  76 => 26,  72 => 25,  58 => 14,  54 => 13,  44 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "admin/ajax/translation_manage_add_form.html.twig", "/var/www/html/medicalimage/app/views/admin/ajax/translation_manage_add_form.html.twig");
    }
}
