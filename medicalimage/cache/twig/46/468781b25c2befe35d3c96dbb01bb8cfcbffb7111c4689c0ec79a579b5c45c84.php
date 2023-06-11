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

/* admin/database_browser.html.twig */
class __TwigTemplate_e7be6b0c76b32814c2905e9f0bcc97208cf3d2a67f1f440cfc9f5db3bdf19259 extends \Twig\Template
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
            'head_js' => [$this, 'block_head_js'],
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
        $this->parent = $this->loadTemplate("admin/partial/layout_logged_in.html.twig", "admin/database_browser.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Database Browser";
    }

    // line 4
    public function block_selected_page($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "configuration";
    }

    // line 5
    public function block_selected_sub_page($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "database_browser";
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
                    <h3>Database Browser</h3><div class=\"clearfix\"></div>
                </div>
            </div>
            <div class=\"clearfix\"></div>

            ";
        // line 17
        echo ($context["msg_page_notifications"] ?? null);
        echo "

            <div class=\"row\">
                <div class=\"col-md-12 col-sm-12 col-xs-12\">
                    ";
        // line 21
        if ((twig_length_filter($this->env, ($context["databaseBrowserContent"] ?? null)) > 0)) {
            // line 22
            echo "                        <div class=\"x_panel\">
                            <div class=\"x_content\" style=\"overflow-x: auto; overflow-y: hidden;\">
                                <div>
                                    ";
            // line 25
            echo ($context["databaseBrowserContent"] ?? null);
            echo "
                                </div>
                            </div>
                        </div>
                    ";
        }
        // line 30
        echo "                </div>
            </div>

        </div>
    </div>
";
    }

    // line 37
    public function block_head_js($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 38
        echo "    <script src=\"";
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/js/adminer.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "admin/database_browser.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  121 => 38,  117 => 37,  108 => 30,  100 => 25,  95 => 22,  93 => 21,  86 => 17,  75 => 8,  71 => 7,  64 => 5,  57 => 4,  50 => 3,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "admin/database_browser.html.twig", "/var/www/html/medicalimage/app/views/admin/database_browser.html.twig");
    }
}
