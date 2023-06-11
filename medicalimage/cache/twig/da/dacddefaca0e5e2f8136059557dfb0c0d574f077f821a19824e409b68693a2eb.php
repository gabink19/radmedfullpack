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

/* admin/theme_manage_add.html.twig */
class __TwigTemplate_5a235858bc0e2cc3e0a08f378a21293dc34948bc4e212e3b76ac935e07684992 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'selected_page' => [$this, 'block_selected_page'],
            'selected_sub_page' => [$this, 'block_selected_sub_page'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "admin/partial/layout_logged_in.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("admin/partial/layout_logged_in.html.twig", "admin/theme_manage_add.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Add Theme";
    }

    // line 4
    public function block_selected_page($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "themes";
    }

    // line 5
    public function block_selected_sub_page($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "theme_manage_add";
    }

    // line 7
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 8
        echo "    <div class=\"right_col\" role=\"main\">
        <div class=\"\">
            <div class=\"page-title\">
                <div class=\"title_left\">
                    <h3>Add Theme</h3>
                </div>
            </div>
            <div class=\"clearfix\"></div>

            ";
        // line 17
        echo ($context["msg_page_notifications"] ?? null);
        echo "

            <div class=\"row\">
                <div class=\"col-md-12 col-sm-12 col-xs-12\">
                    <form action=\"theme_manage_add\" method=\"POST\" name=\"themeForm\" id=\"themeForm\" enctype=\"multipart/form-data\" class=\"form-horizontal form-label-left\">
                        <div class=\"x_panel\">
                            <div class=\"x_title\">
                                <h2>Upload Theme Package</h2>
                                <div class=\"clearfix\"></div>
                            </div>
                            <div class=\"x_content\">
                                <p>Upload the theme package using the form below. The theme package is supplied by <a href=\"";
        // line 28
        echo twig_escape_filter($this->env, ($context["currentProductUrl"] ?? null), "html", null, true);
        echo "\" target=\"_blank\">";
        echo twig_escape_filter($this->env, ($context["currentProductName"] ?? null), "html", null, true);
        echo "</a> in zip format.</p>
                                <div class=\"clearfix col_12\">
                                    <div class=\"col_8 last\">
                                        <div class=\"form\">
                                            <div class=\"clearfix alt-highlight\">
                                                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"theme_zip\">Theme Zip File:</label>
                                                <div class=\"col-md-4 col-sm-4 col-xs-12\">
                                                    <input name=\"theme_zip\" type=\"file\" id=\"theme_zip\" class=\"form-control\"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class=\"ln_solid\"></div>
                                <div class=\"form-group\">
                                    <div class=\"col-md-6 col-sm-6 col-xs-12 col-md-offset-3\">
                                        <button type=\"button\" class=\"btn btn-default\" onClick=\"window.location = 'theme_manage';\">Cancel</button>
                                        <button type=\"submit\" class=\"btn btn-primary\">Upload Theme Package</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input name=\"submitted\" type=\"hidden\" value=\"1\"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "admin/theme_manage_add.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  99 => 28,  85 => 17,  74 => 8,  70 => 7,  63 => 5,  56 => 4,  49 => 3,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "admin/theme_manage_add.html.twig", "/var/www/html/medicalimage/app/views/admin/theme_manage_add.html.twig");
    }
}
