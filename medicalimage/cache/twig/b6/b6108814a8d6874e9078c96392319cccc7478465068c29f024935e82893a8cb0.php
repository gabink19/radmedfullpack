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

/* admin/index.html.twig */
class __TwigTemplate_e514b2a13c010d3adb0024facd83fdb0dd4d4f0349e2422ee69ec9cc233b0b74 extends \Twig\Template
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
        $this->parent = $this->loadTemplate("admin/partial/layout_logged_in.html.twig", "admin/index.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Dashboard";
    }

    // line 4
    public function block_selected_page($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "dashboard";
    }

    // line 5
    public function block_selected_sub_page($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "dashboard";
    }

    // line 7
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 8
        echo "<script>
// check for script upgrades
    \$(document).ready(function () {
        \$.ajax({
            url: \"";
        // line 12
        echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/ajax/check_for_upgrade\",
            dataType: \"json\"
        }).done(function (response) {
            if (typeof(response['core']) != \"undefined\")
            {
                showInfo(\"There is an update available to \"+response['core']['latest_version']+\" of your core script. <a href='system_update'>Click here</a> to start the upgrade process.\");
            }
        });

        loadCharts();
    });

    function loadCharts()
    {
        \$('#wrapper_14_day_chart').load('";
        // line 26
        echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/ajax/dashboard_chart_14_day_chart');
        \$('#wrapper_file_status_chart').load('";
        // line 27
        echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/ajax/dashboard_chart_file_status_chart');
        \$('#wrapper_12_month_chart').load('";
        // line 28
        echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/ajax/dashboard_chart_12_months_chart');
        \$('#wrapper_file_type_chart').load('";
        // line 29
        echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/ajax/dashboard_chart_file_type_chart');
        \$('#wrapper_14_day_users').load('";
        // line 30
        echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/ajax/dashboard_chart_14_day_users');
        \$('#wrapper_user_status_chart').load('";
        // line 31
        echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/ajax/dashboard_chart_user_status_chart');
    }
</script>

<!-- page content -->
<div class=\"right_col\" role=\"main\">
    <!-- top tiles -->
    <div class=\"row tile_count\">
        <div class=\"col-md-";
        // line 39
        echo twig_escape_filter($this->env, ($context["topBoxSize"] ?? null), "html", null, true);
        echo " col-sm-4 col-xs-6 tile_stats_count\">
            <a href=\"file_manage\">
                <span class=\"count_top\"><i class=\"fa fa-file-o\"></i> Active Files</span>
                <div class=\"count green\">";
        // line 42
        echo twig_escape_filter($this->env, ($context["totalActiveFiles"] ?? null), "html", null, true);
        echo "</div>
            </a>
        </div>
        <div class=\"col-md-";
        // line 45
        echo twig_escape_filter($this->env, ($context["topBoxSize"] ?? null), "html", null, true);
        echo " col-sm-4 col-xs-6 tile_stats_count\">
            <a href=\"";
        // line 46
        if ((twig_get_attribute($this->env, $this->source, ($context["Auth"] ?? null), "hasAccessLevel", [0 => 20], "method", false, false, false, 46) == true)) {
            echo "server_manage";
        } else {
            echo "#";
        }
        echo "\">
                <span class=\"count_top\"><i class=\"fa fa-clock-o\"></i> Total Space Used</span>
                <div class=\"count green\">";
        // line 48
        echo twig_escape_filter($this->env, ($context["totalHDSpaceFormatted"] ?? null), "html", null, true);
        echo "</div>
            </a>
        </div>
        <div class=\"col-md-";
        // line 51
        echo twig_escape_filter($this->env, ($context["topBoxSize"] ?? null), "html", null, true);
        echo " col-sm-4 col-xs-6 tile_stats_count\">
            <a href=\"file_manage\">
                <span class=\"count_top\"><i class=\"fa fa-download\"></i> Total Downloads</span>
                <div class=\"count green\">";
        // line 54
        echo twig_escape_filter($this->env, ($context["totalDownloads"] ?? null), "html", null, true);
        echo "</div>
            </a>
        </div>
        ";
        // line 57
        if ((twig_get_attribute($this->env, $this->source, ($context["Auth"] ?? null), "hasAccessLevel", [0 => 20], "method", false, false, false, 57) == true)) {
            echo "        
            <div class=\"col-md-";
            // line 58
            echo twig_escape_filter($this->env, ($context["topBoxSize"] ?? null), "html", null, true);
            echo " col-sm-4 col-xs-6 tile_stats_count\">
                <a href=\"user_manage?filterByAccountStatus=active\">
                    <span class=\"count_top\"><i class=\"fa fa-user\"></i> Total Registered<span class=\"paid-account-option\">/Paid Users</span></span>
                    <div class=\"count green\">";
            // line 61
            echo twig_escape_filter($this->env, ($context["totalRegisteredUsers"] ?? null), "html", null, true);
            echo "<font class=\"paid-account-option\">/";
            echo twig_escape_filter($this->env, ($context["totalPaidUsers"] ?? null), "html", null, true);
            echo "</font></div>
                </a>
            </div>
        ";
        }
        // line 65
        echo "        
        <div class=\"col-md-";
        // line 66
        echo twig_escape_filter($this->env, ($context["topBoxSize"] ?? null), "html", null, true);
        echo " col-sm-4 col-xs-6 tile_stats_count file-pending-reports\">
            <a href=\"file_report_manage?filterByReportStatus=pending\">
                <span class=\"count_top\"><i class=\"fa fa-support\"></i> Pending Reports</span>
                <div class=\"count green\">";
        // line 69
        echo twig_escape_filter($this->env, ($context["totalReports"] ?? null), "html", null, true);
        echo "</div>
            </a>
        </div>
        
        ";
        // line 73
        if ((twig_get_attribute($this->env, $this->source, ($context["Auth"] ?? null), "hasAccessLevel", [0 => 20], "method", false, false, false, 73) == true)) {
            echo " 
        ";
            // line 74
            if ((twig_length_filter($this->env, ($context["payments30Days"] ?? null)) == 0)) {
                // line 75
                echo "        <div class=\"col-md-";
                echo twig_escape_filter($this->env, ($context["topBoxSize"] ?? null), "html", null, true);
                echo " col-sm-4 col-xs-6 tile_stats_count paid-account-option\">
            <a href=\"payment_manage\">
                <span class=\"count_top\"><i class=\"fa fa-credit-card\"></i> 30 Day Payments</span>
                <div class=\"count green\">";
                // line 78
                echo twig_escape_filter($this->env, ($context["SITE_CONFIG_COST_CURRENCY_SYMBOL"] ?? null), "html", null, true);
                echo " 0</div>
 
            </a>
        </div>
        ";
            } else {
                // line 83
                echo "            ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["payments30Days"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["payments30Day"]) {
                    // line 84
                    echo "            <div class=\"col-md-";
                    echo twig_escape_filter($this->env, ($context["topBoxSize"] ?? null), "html", null, true);
                    echo " col-sm-4 col-xs-6 tile_stats_count\">
                <a href=\"payment_manage\" class=\"paid-account-option\">
                    <span class=\"count_top\"><i class=\"fa fa-credit-card\"></i> 30 Day Payments</span>
                    <div class=\"count green\">";
                    // line 87
                    echo twig_escape_filter($this->env, twig_number_format_filter($this->env, (($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = $context["payments30Day"]) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4["total"] ?? null) : null), 0, ".", ""), "html", null, true);
                    echo " ";
                    echo twig_escape_filter($this->env, (($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 = $context["payments30Day"]) && is_array($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144) || $__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 instanceof ArrayAccess ? ($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144["currency_code"] ?? null) : null), "html", null, true);
                    echo "</div>
                </a>
            </div>
            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['payments30Day'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 91
                echo "        ";
            }
            // line 92
            echo "        ";
        }
        // line 93
        echo "        <div class=\"clear\"></div>
    </div>
    <!-- /top tiles -->

    <div class=\"row\">
        <div class=\"col-md-8 col-sm-8 col-xs-12\">
            <div class=\"x_panel tile fixed_height_320\">
                <div class=\"x_title\">
                    <h2>New Files <small>Last 14 Days</small></h2>
                    <div class=\"clearfix\"></div>
                </div>

                <div class=\"x_content\">
                    <div id=\"placeholder33\" style=\"height: 234px; display: none\" class=\"demo-placeholder\"></div>
                    <div style=\"width: 100%;\">
                        <div id=\"canvas_dahs\" class=\"demo-placeholder\" style=\"width: 100%; height:244px;\"></div>
                    </div>
                    <span id=\"wrapper_14_day_chart\"></span>
                </div>
            </div>
        </div>
        
        
        <div class=\"col-md-4 col-sm-4 col-xs-12\">
            <div class=\"x_panel tile fixed_height_320 wrapper_file_status_chart\">
                <div class=\"x_title\">
                    <h2>File Status</h2>
                    <div class=\"clearfix\"></div>
                </div>
                <div class=\"x_content\">
                    <table class=\"\" style=\"width:100%\">
                        <tr>
                            <th style=\"width:37%;\">
                                &nbsp;
                            </th>
                            <th>
                                <div class=\"col-lg-7 col-md-7 col-sm-7 col-xs-7\">
                                    <p class=\"\">Status</p>
                                </div>
                                <div class=\"col-lg-5 col-md-5 col-sm-5 col-xs-5 text-right\">
                                    <p class=\"\">Total Files</p>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <canvas id=\"canvas1\" height=\"140\" width=\"140\" style=\"margin: 15px 10px 10px 0\"></canvas>
                                <span id=\"wrapper_file_status_chart\"></div>
                            </td>
                            <td>
                                <table class=\"tile_info\">
                                    <tr>
                                        <td></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class=\"clearfix\"></div>
            </div>
        </div>
    </div>

    <br/>
    
    <div class=\"row\">
        <div class=\"col-md-8 col-sm-8 col-xs-12\">
            <div class=\"x_panel tile fixed_height_320\">
                <div class=\"x_title\">
                    <h2>New Files <small>Last 12 Months</small></h2>
                    <div class=\"clearfix\"></div>
                </div>

                <div class=\"x_content\">
                    <div id=\"placeholder33\" style=\"height: 234px; display: none\" class=\"demo-placeholder\"></div>
                    <div style=\"width: 100%;\">
                        <div id=\"canvas_dahs2\" class=\"demo-placeholder\" style=\"width: 100%; height:244px;\"></div>
                    </div>
                    <span id=\"wrapper_12_month_chart\"></span>
                </div>
            </div>
        </div>
        
        <div class=\"col-md-4 col-sm-4 col-xs-12\">
            <div class=\"x_panel tile fixed_height_320 wrapper_file_type_chart\">
                <div class=\"x_title\">
                    <h2>File Type</h2>
                    <div class=\"clearfix\"></div>
                </div>
                <div class=\"x_content\">
                    <table class=\"\" style=\"width:100%\">
                        <tr>
                            <th style=\"width:37%;\">
                                &nbsp;
                            </th>
                            <th>
                                <div class=\"col-lg-7 col-md-7 col-sm-7 col-xs-7\">
                                    <p class=\"\">Type</p>
                                </div>
                                <div class=\"col-lg-5 col-md-5 col-sm-5 col-xs-5 text-right\">
                                    <p class=\"\">Total Files</p>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <canvas id=\"canvas2\" height=\"140\" width=\"140\" style=\"margin: 15px 10px 10px 0\"></canvas>
                                <span id=\"wrapper_file_type_chart\"></div>
                            </td>
                            <td>
                                <table class=\"tile_info\">
                                    <tr>
                                        <td></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class=\"clearfix\"></div>
            </div>
        </div>
    </div>
 
    ";
        // line 218
        if ((($context["currentProduct"] ?? null) != "cloudable")) {
            // line 219
            echo "    <br />
    
    <div class=\"row\">
        <div class=\"col-md-8 col-sm-8 col-xs-12\">
            <div class=\"x_panel tile fixed_height_320\">
                <div class=\"x_title\">
                    <h2>New Users <small>Last 14 Days</small></h2>
                    <div class=\"clearfix\"></div>
                </div>

                <div class=\"x_content\">
                    <div id=\"placeholder33\" style=\"height: 234px; display: none\" class=\"demo-placeholder\"></div>
                    <div style=\"width: 100%;\">
                        <div id=\"canvas_dahs3\" class=\"demo-placeholder\" style=\"width: 100%; height:244px;\"></div>
                    </div>
                    <span id=\"wrapper_14_day_users\"></span>
                </div>
            </div>
        </div>
        
        <div class=\"col-md-4 col-sm-4 col-xs-12\">
            <div class=\"x_panel tile fixed_height_320 wrapper_user_status_chart\">
                <div class=\"x_title\">
                    <h2>User Status</h2>
                    <div class=\"clearfix\"></div>
                </div>
                <div class=\"x_content\">
                    <table class=\"\" style=\"width:100%\">
                        <tr>
                            <th style=\"width:37%;\">
                                &nbsp;
                            </th>
                            <th>
                                <div class=\"col-lg-7 col-md-7 col-sm-7 col-xs-7\">
                                    <p class=\"\">Status</p>
                                </div>
                                <div class=\"col-lg-5 col-md-5 col-sm-5 col-xs-5 text-right\">
                                    <p class=\"\">Total Users<p>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <canvas id=\"canvas3\" height=\"140\" width=\"140\" style=\"margin: 15px 10px 10px 0\"></canvas>
                                <span id=\"wrapper_user_status_chart\"></div>
                            </td>
                            <td>
                                <table class=\"tile_info\">
                                    <tr>
                                        <td></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class=\"clearfix\"></div>
            </div>
        </div>
    </div>
    ";
        }
        // line 280
        echo "</div>
<!-- /page content -->

<!-- FastClick -->
<script src=\"";
        // line 284
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/fastclick/lib/fastclick.js\"></script>
<!-- NProgress -->
<script src=\"";
        // line 286
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/nprogress/nprogress.js\"></script>
<!-- Chart.js -->
<script src=\"";
        // line 288
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/Chart.js/dist/Chart.min.js\"></script>
<!-- gauge.js -->
<script src=\"";
        // line 290
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/gauge.js/dist/gauge.min.js\"></script>
<!-- bootstrap-progressbar -->
<script src=\"";
        // line 292
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js\"></script>
<!-- iCheck -->
<script src=\"";
        // line 294
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/iCheck/icheck.min.js\"></script>
<!-- Skycons -->
<script src=\"";
        // line 296
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/skycons/skycons.js\"></script>
<!-- Flot -->
<script src=\"";
        // line 298
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/Flot/jquery.flot.js\"></script>
<script src=\"";
        // line 299
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/Flot/jquery.flot.pie.js\"></script>
<script src=\"";
        // line 300
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/Flot/jquery.flot.time.js\"></script>
<script src=\"";
        // line 301
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/Flot/jquery.flot.stack.js\"></script>
<script src=\"";
        // line 302
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/Flot/jquery.flot.resize.js\"></script>
<!-- Flot plugins -->
<script src=\"";
        // line 304
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/flot.orderbars/js/jquery.flot.orderBars.js\"></script>
<script src=\"";
        // line 305
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/flot-spline/js/jquery.flot.spline.min.js\"></script>
<script src=\"";
        // line 306
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/flot.curvedlines/curvedLines.js\"></script>
<!-- DateJS -->
<script src=\"";
        // line 308
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/DateJS/build/date.js\"></script>
<!-- JQVMap -->
<script src=\"";
        // line 310
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/jqvmap/dist/jquery.vmap.js\"></script>
<script src=\"";
        // line 311
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/jqvmap/dist/maps/jquery.vmap.world.js\"></script>
<script src=\"";
        // line 312
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js\"></script>
<!-- bootstrap-daterangepicker -->
<script src=\"";
        // line 314
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/moment/min/moment.min.js\"></script>
<script src=\"";
        // line 315
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/bootstrap-daterangepicker/daterangepicker.js\"></script>
";
    }

    public function getTemplateName()
    {
        return "admin/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  546 => 315,  542 => 314,  537 => 312,  533 => 311,  529 => 310,  524 => 308,  519 => 306,  515 => 305,  511 => 304,  506 => 302,  502 => 301,  498 => 300,  494 => 299,  490 => 298,  485 => 296,  480 => 294,  475 => 292,  470 => 290,  465 => 288,  460 => 286,  455 => 284,  449 => 280,  386 => 219,  384 => 218,  257 => 93,  254 => 92,  251 => 91,  239 => 87,  232 => 84,  227 => 83,  219 => 78,  212 => 75,  210 => 74,  206 => 73,  199 => 69,  193 => 66,  190 => 65,  181 => 61,  175 => 58,  171 => 57,  165 => 54,  159 => 51,  153 => 48,  144 => 46,  140 => 45,  134 => 42,  128 => 39,  117 => 31,  113 => 30,  109 => 29,  105 => 28,  101 => 27,  97 => 26,  80 => 12,  74 => 8,  70 => 7,  63 => 5,  56 => 4,  49 => 3,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "admin/index.html.twig", "/var/www/html/medicalimage/app/views/admin/index.html.twig");
    }
}
