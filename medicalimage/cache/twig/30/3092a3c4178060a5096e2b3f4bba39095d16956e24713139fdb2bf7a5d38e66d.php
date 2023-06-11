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

/* admin/log_file_viewer.html.twig */
class __TwigTemplate_b9cea3a7345a6d84eb4b3dd765d7c9b05caed9cdd08b1f5e8f1a1d31f690652d extends \Twig\Template
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
        $this->parent = $this->loadTemplate("admin/partial/layout_logged_in.html.twig", "admin/log_file_viewer.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "View Log Files";
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
        echo "translation_manage";
    }

    // line 7
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 8
        echo "<script>
    \$(document).ready(function () {
        var psconsole = \$('#logViewer');
        if (typeof (psconsole[0]) != \"undefined\")
        {
            psconsole.scrollTop(
                    psconsole[0].scrollHeight - psconsole.height()
                    );
        }
    });
</script>

<!-- page content -->
<div class=\"right_col\" role=\"main\">
    <div class=\"\">
        <div class=\"page-title\">
            <div class=\"title_left\">
                <h3>";
        // line 25
        $this->displayBlock("title", $context, $blocks);
        echo "</h3>
            </div>
        </div>
        <div class=\"clearfix\"></div>

        ";
        // line 30
        echo ($context["msg_page_notifications"] ?? null);
        echo "

        <div class=\"row\">
            <div class=\"col-md-12 col-sm-12 col-xs-12\">
                <div class=\"x_panel\">
                    <div class=\"x_title\">
                        <h2>Logs";
        // line 36
        if ((twig_length_filter($this->env, ($context["lType"] ?? null)) > 0)) {
            echo " (";
            echo twig_escape_filter($this->env, ($context["lType"] ?? null), "html", null, true);
            if ((twig_length_filter($this->env, ($context["lFile"] ?? null)) > 0)) {
                echo "/";
                echo twig_escape_filter($this->env, ($context["lFile"] ?? null), "html", null, true);
            }
            echo ")";
        }
        echo "</h2>
                        <div class=\"clearfix\"></div>
                    </div>
                    <div class=\"x_content\">
                        ";
        // line 40
        echo ($context["logMsg"] ?? null);
        echo "
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "admin/log_file_viewer.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  125 => 40,  110 => 36,  101 => 30,  93 => 25,  74 => 8,  70 => 7,  63 => 5,  56 => 4,  49 => 3,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "admin/log_file_viewer.html.twig", "/var/www/html/medicalimage/app/views/admin/log_file_viewer.html.twig");
    }
}
