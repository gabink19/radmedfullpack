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

/* admin/ajax/dashboard_chart_12_months_chart.html.twig */
class __TwigTemplate_aefe384911c2732ec141655d37dffdbf6d60c8075a2a109984290aea2398e396 extends \Twig\Template
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
        echo "<script>
    \$(function () {
        var data1b = [
";
        // line 4
        echo twig_join_filter(($context["data"] ?? null), ", ");
        echo "
        ];
        \$(\"#canvas_dahs2\").length && \$.plot(\$(\"#canvas_dahs2\"), [
            data1b
        ], {
            series: {
                lines: {
                    show: false,
                    fill: false,
                    steps: false
                },
                bars: {show: true, barWidth: 0.9, align: 'center'},
                points: {
                    radius: 0,
                    show: true
                },
                shadowSize: 2
            },
            grid: {
                verticalLines: true,
                hoverable: true,
                clickable: true,
                tickColor: \"#d5d5d5\",
                borderWidth: 1,
                color: '#fff'
            },
            colors: [\"rgba(38, 185, 154, 0.38)\", \"rgba(3, 88, 106, 0.38)\"],
            xaxis: {
                tickColor: \"rgba(51, 51, 51, 0.06)\",
                mode: \"time\",
                tickSize: [1, \"day\"],
                axisLabel: \"Date\",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Verdana, Arial',
                axisLabelPadding: 10,
                ticks: [";
        // line 40
        echo twig_join_filter(($context["label"] ?? null), ", ");
        echo "]
            },
            yaxis: {
                ticks: 8,
                tickColor: \"rgba(51, 51, 51, 0.06)\",
            },
            tooltip: true
        });

        function gd(year, month, day) {
            return new Date(year, month - 1, day).getTime();
        }

        \$('#wrapper_12_months_chart .background-loading').removeClass('background-loading');
    });
</script>";
    }

    public function getTemplateName()
    {
        return "admin/ajax/dashboard_chart_12_months_chart.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  81 => 40,  42 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "admin/ajax/dashboard_chart_12_months_chart.html.twig", "/var/www/html/medicalimage/app/views/admin/ajax/dashboard_chart_12_months_chart.html.twig");
    }
}
