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

/* admin/ajax/dashboard_chart_file_status_chart.html.twig */
class __TwigTemplate_1e5d62674fe603ed063395494a7b58770f53020bb303ff080253e7167ac3955c extends \Twig\Template
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
        echo "<script type=\"text/javascript\">
    \$(function () {
        var options1a = {
            legend: false,
            responsive: false
        };

        new Chart(document.getElementById(\"canvas1\"), {
            type: 'doughnut',
            tooltipFillColor: \"rgba(51, 51, 51, 0.55)\",
            data: {
                labels: [
                    \"";
        // line 13
        echo twig_join_filter(($context["labels"] ?? null), "\", \"");
        echo "\"
                ],
                datasets: [{
                        data: [";
        // line 16
        echo twig_join_filter(($context["data"] ?? null), ", ");
        echo "],
                        backgroundColor: [
                            \"";
        // line 18
        echo twig_join_filter(($context["colors"] ?? null), "\", \"");
        echo "\"
                        ],
                        hoverBackgroundColor: [
                            \"#CFD4D8\",
                            \"#B370CF\",
                            \"#E95E4F\",
                            \"#36CAAB\",
                            \"#49A9EA\"
                        ]
                    }]
            },
            options: options1a
        });
  
        \$('#wrapper_file_status_chart .background-loading').removeClass('background-loading');
        
        updatePieChartTable1a();
    });
    
    function updatePieChartTable1a()
    {
        tableHtml = '';
        ";
        // line 40
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["labels"] ?? null));
        foreach ($context['_seq'] as $context["k"] => $context["label"]) {
            // line 41
            echo "        tableHtml += '<tr><td><p><i class=\"fa fa-square blue\" style=\"color: ";
            echo twig_escape_filter($this->env, (($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = ($context["colors"] ?? null)) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4[$context["k"]] ?? null) : null), "html", null, true);
            echo "\"></i> ";
            echo twig_escape_filter($this->env, $context["label"], "html", null, true);
            echo "</p></td><td class=\"pull-right\">";
            echo twig_escape_filter($this->env, (($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 = ($context["data"] ?? null)) && is_array($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144) || $__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 instanceof ArrayAccess ? ($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144[$context["k"]] ?? null) : null), "html", null, true);
            echo "</td></tr>';
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['k'], $context['label'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 43
        echo "
        \$('.wrapper_file_status_chart .tile_info').html(tableHtml);
    }
</script>";
    }

    public function getTemplateName()
    {
        return "admin/ajax/dashboard_chart_file_status_chart.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  104 => 43,  91 => 41,  87 => 40,  62 => 18,  57 => 16,  51 => 13,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "admin/ajax/dashboard_chart_file_status_chart.html.twig", "/var/www/html/medicalimage/app/views/admin/ajax/dashboard_chart_file_status_chart.html.twig");
    }
}
