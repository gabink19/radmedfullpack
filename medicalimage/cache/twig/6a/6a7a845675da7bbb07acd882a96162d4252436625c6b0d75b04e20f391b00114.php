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

/* admin/plugin_manage.html.twig */
class __TwigTemplate_5187af5886545683183e0573ad4c9532121c0e07768eccaf83020a33b850ee59 extends \Twig\Template
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
        $this->parent = $this->loadTemplate("admin/partial/layout_logged_in.html.twig", "admin/plugin_manage.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Manage Plugins";
    }

    // line 4
    public function block_selected_page($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "plugins";
    }

    // line 5
    public function block_selected_sub_page($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "plugin_manage";
    }

    // line 7
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 8
        echo "<script>
    oTable = null;
    gPluginId = null;
    \$(document).ready(function () {
        // datatable
        oTable = \$('#fileTable').dataTable({
            \"sPaginationType\": \"full_numbers\",
            \"bServerSide\": true,
            \"bProcessing\": true,
            \"sAjaxSource\": 'ajax/plugin_manage',
            \"iDisplayLength\": 100,
            \"aoColumns\": [
                {bSortable: false, sWidth: '3%', sName: 'file_icon', sClass: \"center adminResponsiveHide\"},
                {bSortable: false, sName: 'plugin_title'},
                {bSortable: false, sName: 'directory_name', sWidth: '14%', sClass: \"adminResponsiveHide\"},
                {bSortable: false, sName: 'installed', sWidth: '10%', sClass: \"center adminResponsiveHide\"},
                {bSortable: false, sName: 'version', sWidth: '10%', sClass: \"center adminResponsiveHide\"},
                {bSortable: false, sName: 'up_to_date', sWidth: '10%', sClass: \"center adminResponsiveHide\"},
                {bSortable: false, sWidth: '20%', sClass: \"center\", sClass: \"center\"}
            ],
            \"fnServerData\": function (sSource, aoData, fnCallback, oSettings) {
                aoData.push({\"name\": \"filterText\", \"value\": \$('#filterText').val()});
                \$.ajax({
                    \"dataType\": 'json',
                    \"type\": \"GET\",
                    \"url\": sSource,
                    \"data\": aoData,
                    \"success\": fnCallback
                });
            },
            \"oLanguage\": {
                \"sEmptyTable\": \"You have no plugins configured within your site. Go to <a href='";
        // line 39
        echo twig_escape_filter($this->env, ($context["currentProductUrl"] ?? null), "html", null, true);
        echo "' target='_blank'>";
        echo twig_escape_filter($this->env, ($context["currentProductName"] ?? null), "html", null, true);
        echo "</a> to see a list of available plugins.\"
            },
            \"fnDrawCallback\": function (oSettings) {
                postDatatableRender();
                checkForUpdates();
            },
            dom: \"lBfrtip\",
            buttons: [
                {
                    extend: \"copy\",
                    className: \"btn-sm\"
                },
                {
                    extend: \"csv\",
                    className: \"btn-sm\"
                },
                {
                    extend: \"excel\",
                    className: \"btn-sm\"
                },
                {
                    extend: \"pdfHtml5\",
                    className: \"btn-sm\"
                },
                {
                    extend: \"print\",
                    className: \"btn-sm\"
                }
            ]
        });
        
        // update custom filter
        \$('.dataTables_filter').html(\$('#customFilter').html());
    });

    function reloadTable()
    {
        oTable.fnDraw(false);
    }

    function confirmInstallPlugin(plugin_id)
    {
        gPluginId = plugin_id;
        showBasicModal('<p>Are you sure you want to install this plugin?</p>', 'Confirm Install', '<button type=\"button\" class=\"btn btn-primary\" onClick=\"installPlugin(); return false;\">Install</button>');
    }

    function confirmUninstallPlugin(plugin_id)
    {
        gPluginId = plugin_id;
        showBasicModal('<p>Are you sure you want to uninstall this plugin? All data associated with the plugin will be deleted and unrecoverable.</p>', 'Confirm Uninstall', '<button type=\"button\" class=\"btn btn-primary\" onClick=\"uninstallPlugin(); return false;\">Uninstall</button>');
    }

    function confirmDeletePlugin(plugin_id)
    {
        gPluginId = plugin_id;
        showBasicModal('<p>Are you sure you want to delete this plugin? All data associated with the plugin will be deleted and unrecoverable.</p>', 'Confirm Uninstall', '<button type=\"button\" class=\"btn btn-primary\" onClick=\"deletePlugin(); return false;\">Delete</button>');
    }

    function installPlugin()
    {
        \$.ajax({
            type: \"POST\",
            url: \"ajax/plugin_manage_install\",
            data: {plugin_id: gPluginId},
            dataType: 'json',
            success: function (json) {
                if (json.error == true)
                {
                    showError(json.msg, 'messageContainer');
                } else
                {
                    //showSuccess(json.msg, 'messageContainer');
                    //reloadTable();
                    window.location = 'plugin_manage?id=' + encodeURIComponent(json.id) + '&plugin=' + encodeURIComponent(json.plugin) + '&sm=' + encodeURIComponent(json.msg);
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                showError(XMLHttpRequest.responseText, 'messageContainer');
            }
        });
    }

    function uninstallPlugin()
    {
        \$.ajax({
            type: \"POST\",
            url: \"ajax/plugin_manage_uninstall\",
            data: {plugin_id: gPluginId},
            dataType: 'json',
            success: function (json) {
                if (json.error == true)
                {
                    showError(json.msg, 'messageContainer');
                } else
                {
                    //showSuccess(json.msg, 'messageContainer');
                    //reloadTable();
                    window.location = 'plugin_manage?sm=' + encodeURIComponent(json.msg);
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                showError(XMLHttpRequest.responseText, 'messageContainer');
            }
        });
    }

    function deletePlugin()
    {
        \$.ajax({
            type: \"POST\",
            url: \"ajax/plugin_manage_delete\",
            data: {plugin_id: gPluginId},
            dataType: 'json',
            success: function (json) {
                if (json.error == true)
                {
                    showError(json.msg, 'messageContainer');
                }
                else
                {
                    window.location = 'plugin_manage?d=' + encodeURIComponent(json.msg);
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                showError(XMLHttpRequest.responseText, 'messageContainer');
            }
        });
    }
    
    function checkForUpdates()
    {
        \$.ajax({
            url: \"ajax/check_for_upgrade\",
            dataType: \"json\"
        }).done(function(response) {
            totalOutOfDate = 0;
            for(i in response)
            {
                // found some plugins which aren't up to date
                var itemIdentifier = i;
                if(\$('.identifier_'+itemIdentifier).length > 0)
                {
                    \$('.identifier_'+itemIdentifier).replaceWith('<a href=\"#\" onClick=\"showUpdateNotice(\\''+response[i]['latest_version']+'\\'); return false;\"><i class=\"fa fa-warning text-danger\" data-toggle=\"tooltip\" data-placement=\"top\" data-original-title=\"Update Available\"></i></a>');  
                    totalOutOfDate++;
                }
            }
            
            // assume the rest are up to date
            \$('.update_checker').replaceWith('<i class=\"fa fa-check text-success\" data-toggle=\"tooltip\" data-placement=\"top\" data-original-title=\"Plugin is the Latest Version\"></i>');  
            setupTooltips();
            
            // show the onscreen notice
            if(totalOutOfDate > 0)
            {
                showInfo('You have '+totalOutOfDate+' plugin(s) which have updates available. Please see below for more information.');
            }
        }).error(function(response) {
            // assume the rest are up to date
            \$('.update_checker').replaceWith('<i class=\"fa fa-check text-success\" data-toggle=\"tooltip\" data-placement=\"top\" data-original-title=\"Plugin is the Latest Version\"></i>');  
            setupTooltips();
        });
    }
    
    function showUpdateNotice(newVersion)
    {
        showBasicModal('<p>This plugin has been updated to v'+newVersion+'. Click the button below to login to your account and download the latest release.</p>', 'Plugin Update Available - v'+newVersion, '<a href=\"https://yetishare.com\" target=\"_blank\" class=\"btn btn-primary\">Download Update</a>');
    }
</script>

<!-- page content -->
<div class=\"right_col\" role=\"main\">
    <div class=\"\">
        <div class=\"page-title\">
            <div class=\"title_left\">
                <h3>";
        // line 213
        $this->displayBlock("title", $context, $blocks);
        echo "</h3>
            </div>
        </div>
        <div class=\"clearfix\"></div>

        ";
        // line 218
        echo ($context["msg_page_notifications"] ?? null);
        echo "

        <div class=\"row\">
            <div class=\"col-md-12 col-sm-12 col-xs-12\">
                <div class=\"x_panel\">
                    <div class=\"x_title\">
                        <h2>Plugins</h2>
                        <div class=\"clearfix\"></div>
                    </div>
                    <div class=\"x_content\">
                        <table id=\"fileTable\" class=\"table table-striped table-only-border dtLoading bulk_action\">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th class=\"align-left\">";
        // line 232
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("plugin", "plugin")), "html", null, true);
        echo "</th>
                                    <th class=\"align-left\">";
        // line 233
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("directory_name", "directory name")), "html", null, true);
        echo "</th>
                                    <th class=\"align-left\">";
        // line 234
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("installed", "installed?")), "html", null, true);
        echo "</th>
                                    <th class=\"align-left\">";
        // line 235
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("version", "version")), "html", null, true);
        echo "</th>
                                    <th class=\"align-left\">";
        // line 236
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("up_to_date", "up to date")), "html", null, true);
        echo "</th>
                                    <th class=\"align-left\">";
        // line 237
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("action", "action")), "html", null, true);
        echo "</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan=\"20\">";
        // line 242
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("admin_loading_data", "Loading data..."), "html", null, true);
        echo "</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class=\"x_panel\">
                    <a href=\"plugin_manage_add\" type=\"button\" class=\"btn btn-primary\">Add Plugin</a>
                    <a href=\"";
        // line 251
        echo twig_escape_filter($this->env, ($context["currentProductUrl"] ?? null), "html", null, true);
        echo "/plugins.html\" target=\"_blank\" type=\"button\" class=\"btn btn-default\">Get Plugins</a>
                </div>

            </div>
        </div>
    </div>
</div>

<div class=\"customFilter\" id=\"customFilter\" style=\"display: none;\">
    <label>
        Filter Results:
        <input name=\"filterText\" id=\"filterText\" type=\"text\" onKeyUp=\"reloadTable();
                return false;\" class=\"form-control\"/>
    </label>
</div>
";
    }

    public function getTemplateName()
    {
        return "admin/plugin_manage.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  351 => 251,  339 => 242,  331 => 237,  327 => 236,  323 => 235,  319 => 234,  315 => 233,  311 => 232,  294 => 218,  286 => 213,  107 => 39,  74 => 8,  70 => 7,  63 => 5,  56 => 4,  49 => 3,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "admin/plugin_manage.html.twig", "/var/www/html/medicalimage/app/views/admin/plugin_manage.html.twig");
    }
}
