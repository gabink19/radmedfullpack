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

/* admin/file_manage_action_queue.html.twig */
class __TwigTemplate_06e5c4bcb6018cda5c12542d7598cd1b0dc0b310f5939b20137af8347af8e723 extends \Twig\Template
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
        $this->parent = $this->loadTemplate("admin/partial/layout_logged_in.html.twig", "admin/file_manage_action_queue.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Manage File Action Queue";
    }

    // line 4
    public function block_selected_page($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "files";
    }

    // line 5
    public function block_selected_sub_page($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "file_manage_queue";
    }

    // line 7
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 8
        echo "    <script>
        oTable = null;
        checkboxIds = {};
        gTableLoaded = false;
        \$(document).ready(function () {
            // datatable
            oTable = \$('#fileActionTable').dataTable({
                \"sPaginationType\": \"full_numbers\",
                \"bServerSide\": true,
                \"bProcessing\": true,
                \"sAjaxSource\": 'ajax/file_manage_action_queue',
                \"iDisplayLength\": 25,
                \"aaSorting\": [[1, \"desc\"]],
                \"aoColumns\": [
                    {bSortable: false, sWidth: '3%', sName: 'file_icon', sClass: \"center adminResponsiveHide\"},
                    {sName: 'date_added', sWidth: '15%', sClass: \"center adminResponsiveHide\"},
                    {sName: 'server', sWidth: '14%', sClass: \"center adminResponsiveHide\"},
                    {sName: 'file_path'},
                    {sName: 'file_action', sWidth: '10%', sClass: \"center adminResponsiveHide\"},
                    {sName: 'status', sWidth: '17%', sClass: \"center\"},
                    {bSortable: false, sWidth: '90px', sClass: \"center\"}
                ],
                \"fnServerData\": function (sSource, aoData, fnCallback) {
                    setTableLoading();
                    aoData.push({\"name\": \"filterText\", \"value\": \$('#filterText').val()});
                    aoData.push({\"name\": \"filterByServer\", \"value\": \$('#filterByServer').val()});
                    aoData.push({\"name\": \"filterByStatus\", \"value\": \$('#filterByStatus').val()});
                    \$.ajax({
                        \"dataType\": 'json',
                        \"type\": \"GET\",
                        \"url\": sSource,
                        \"data\": aoData,
                        \"success\": fnCallback
                    });
                    gTableLoaded = true;
                },
                \"fnDrawCallback\": function (oSettings) {
                    postDatatableRender();
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

            // refresh every 10 seconds
            window.setInterval(function () {
                if (gTableLoaded == false)
                {
                    return true;
                }
                gTableLoaded = false;
                reloadTable();
            }, 20000);
        });

        function reloadTable()
        {
            oTable.fnDraw(false);
        }

        function cancelItem(itemId)
        {
            if (confirm('Are you sure you want to cancel this item? This will not restore the file, it will simply stop it processing in this queue.'))
            {
                window.location = \"file_manage_action_queue?cancel=\" + itemId;
            }

            return false;
        }

        function restoreItem(itemId)
        {
            if (confirm('Are you sure you want to restore this file? It\\'ll be returned into the script as it existed previously.'))
            {
                window.location = \"file_manage_action_queue?restore=\" + itemId;
            }
        }
    </script>

    <!-- page content -->
    <div class=\"right_col\" role=\"main\">
        <div class=\"\">
            <div class=\"page-title\">
                <div class=\"title_left\">
                    <h3>";
        // line 115
        $this->displayBlock("title", $context, $blocks);
        echo "</h3>
                </div>
            </div>
            <div class=\"clearfix\"></div>

            ";
        // line 120
        echo ($context["msg_page_notifications"] ?? null);
        echo "
            <div class=\"row\">
                <div class=\"col-md-12 col-sm-12 col-xs-12\">
                    <div class=\"x_panel\">
                        <div class=\"x_title\">
                            <h2>List Of File Actions (";
        // line 125
        echo twig_escape_filter($this->env, ($context["totalPendingFileActions"] ?? null), "html", null, true);
        echo " Pending)</h2>
                            <div class=\"clearfix\"></div>
                        </div>
                        <div class=\"x_content\">
                            <p>Below is listed any actions on core files. So queued deletes, moves etc. This page will automatically update every 20 seconds.</p>
                            <p><strong>Note:</strong> If the below queue isn't processing, please ensure you've setup all the cron tasks, including any crons on external file servers. Full details can be seen via our <a href=\"https://support.mfscripts.com/public/kb_view/26/\" target=\"_blank\">knowledge base</a>.</p>
                            <table id=\"fileActionTable\" class=\"table table-striped table-only-border dtLoading bulk_action\">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>";
        // line 135
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("date_added", "Date Added"), "html", null, true);
        echo "</th>
                                        <th>";
        // line 136
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("server", "Server"), "html", null, true);
        echo "</th>
                                        <th>";
        // line 137
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("file_path", "File Path"), "html", null, true);
        echo "</th>
                                        <th>";
        // line 138
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("file_action", "File Action"), "html", null, true);
        echo "</th>
                                        <th>";
        // line 139
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("status", "Status"), "html", null, true);
        echo "</th>
                                        <th>";
        // line 140
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("actions", "Actions"), "html", null, true);
        echo "</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan=\"20\">";
        // line 145
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("admin_loading_data", "Loading data..."), "html", null, true);
        echo "</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class=\"customFilter\" id=\"customFilter\" style=\"display: none;\">
        <label>
            Filter By Filename:
            <input name=\"filterText\" id=\"filterText\" type=\"text\" value=\"";
        // line 159
        echo twig_escape_filter($this->env, ($context["filterText"] ?? null), "html", null, true);
        echo "\" onKeyUp=\"reloadTable();
                return false;\" style=\"width: 160px;\" class=\"form-control\"/>
        </label>
        <label class=\"adminResponsiveHide\" style=\"padding-left: 6px;\">
            By Server:
            <select name=\"filterByServer\" id=\"filterByServer\" onChange=\"reloadTable();
                return false;\" style=\"width: 120px;\" class=\"form-control\">
                <option value=\"\">- all -</option>
                ";
        // line 167
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["serverDetails"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["serverDetail"]) {
            // line 168
            echo "                    <option value=\"";
            echo twig_escape_filter($this->env, (($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = $context["serverDetail"]) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4["id"] ?? null) : null), "html", null, true);
            echo "\"";
            echo (((($context["filterByServer"] ?? null) == (($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 = $context["serverDetail"]) && is_array($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144) || $__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 instanceof ArrayAccess ? ($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144["id"] ?? null) : null))) ? (" SELECTED") : (""));
            echo ">";
            echo twig_escape_filter($this->env, (($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b = $context["serverDetail"]) && is_array($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b) || $__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b instanceof ArrayAccess ? ($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b["serverLabel"] ?? null) : null), "html", null, true);
            echo "</option>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['serverDetail'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 170
        echo "            </select>
        </label>
        <label class=\"adminResponsiveHide\" style=\"padding-left: 6px;\">
            By Status:
            <select name=\"filterByStatus\" id=\"filterByStatus\" onChange=\"reloadTable();
                return false;\" style=\"width: 120px;\" class=\"form-control\">
                <option value=\"\">- all -</option>
                ";
        // line 177
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["statusDetails"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["statusDetail"]) {
            // line 178
            echo "                    <option value=\"";
            echo twig_escape_filter($this->env, $context["statusDetail"], "html", null, true);
            echo "\"";
            echo (((($context["filterByStatus"] ?? null) == $context["statusDetail"])) ? (" SELECTED") : (""));
            echo ">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $context["statusDetail"]), "html", null, true);
            echo "</option>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['statusDetail'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 180
        echo "            </select>
        </label>
    </div>
";
    }

    public function getTemplateName()
    {
        return "admin/file_manage_action_queue.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  311 => 180,  298 => 178,  294 => 177,  285 => 170,  272 => 168,  268 => 167,  257 => 159,  240 => 145,  232 => 140,  228 => 139,  224 => 138,  220 => 137,  216 => 136,  212 => 135,  199 => 125,  191 => 120,  183 => 115,  74 => 8,  70 => 7,  63 => 5,  56 => 4,  49 => 3,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "admin/file_manage_action_queue.html.twig", "/var/www/html/medicalimage/app/views/admin/file_manage_action_queue.html.twig");
    }
}
