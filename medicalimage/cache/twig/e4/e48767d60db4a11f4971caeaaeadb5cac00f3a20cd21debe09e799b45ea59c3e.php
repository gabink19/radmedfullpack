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

/* admin/sharing_manage.html.twig */
class __TwigTemplate_e8b0d596a8a46a1679987e932783fb60fa86df0a633eaaeeca19e8053319bb72 extends \Twig\Template
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
        $this->parent = $this->loadTemplate("admin/partial/layout_logged_in.html.twig", "admin/sharing_manage.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Manage Sharing";
    }

    // line 4
    public function block_selected_page($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "sharing";
    }

    // line 5
    public function block_selected_sub_page($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "sharing_manage";
    }

    // line 7
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 8
        echo "<script>
    oTable = null;
    gDeleteSharingId = null;
    \$(document).ready(function () {
        // datatable
        oTable = \$('#sharingTable').dataTable({
            \"sPaginationType\": \"full_numbers\",
            \"bServerSide\": true,
            \"bProcessing\": true,
            \"sAjaxSource\": 'ajax/sharing_manage',
            \"iDisplayLength\": 25,
            \"aaSorting\": [[1, \"desc\"]],
            \"aoColumns\": [
                {bSortable: false, sWidth: '3%', sName: 'file_icon', sClass: \"center adminResponsiveHide\"},
                {sName: 'shared_date', sWidth: '12%'},
                {sName: 'by_user', sWidth: '15%', sClass: \"center adminResponsiveHide\"},
                {sName: 'to_user', sWidth: '15%', sClass: \"center\"},
                {sName: 'shared_items', sClass: \"center adminResponsiveHide\"},
                {sName: 'access_level', sClass: \"center adminResponsiveHide\"},
                {sName: 'is_global', sClass: \"center adminResponsiveHide\"},
                {sName: 'last_accessed', sWidth: '10%', sClass: \"center adminResponsiveHide\"},
                {bSortable: false, sWidth: '10%', sClass: \"center\"}
            ],
            \"fnServerData\": function (sSource, aoData, fnCallback) {
                aoData.push({\"name\": \"filterText\", \"value\": \$('#filterText').val()});
                \$.ajax({
                    \"dataType\": 'json',
                    \"type\": \"GET\",
                    \"url\": sSource,
                    \"data\": aoData,
                    \"success\": fnCallback
                });
            },
            \"fnDrawCallback\": function (oSettings) {
                postDatatableRender();
            },
            \"oLanguage\": {
                \"sEmptyTable\": \"There are no items in the current filters.\"
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
        ";
        // line 74
        if ((($context["addServerTrigger"] ?? null) == true)) {
            // line 75
            echo "            addShareForm();
        ";
        }
        // line 77
        echo "    });

    function confirmRemoveSharingLink(sharingId)
    {
        \$('#pleaseWait').hide();
        \$('#confirmText').show();
        \$('#confirmDelete').modal(\"show\");
        gDeleteSharingId = sharingId;
    }

    function removeSharingLink()
    {
        \$('#confirmText').hide();
        \$('#pleaseWait').show();
        \$.ajax({
            type: \"POST\",
            url: \"ajax/sharing_manage_remove\",
            data: {sharingId: gDeleteSharingId},
            dataType: 'json',
            success: function (json) {
                if (json.error == true)
                {
                    \$('#pleaseWait').hide();
                    \$('#confirmText').show();
                    showError(json.msg);
                } else
                {
                    showSuccess(json.msg);
                    reloadTable();
                    \$(\"#confirmDelete\").modal(\"hide\");
                }

            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                \$('#pleaseWait').hide();
                \$('#confirmText').show();
                showError(XMLHttpRequest.responseText);
            }
        });
    }

    function loadAddServerForm()
    {
        \$('#addSharingForm').html('Loading...');
        \$.ajax({
            type: \"POST\",
            url: \"ajax/sharing_manage_add_form\",
            data: {},
            dataType: 'json',
            success: function (json) {
                if (json.error == true)
                {
                    \$('#addSharingForm').html(json.msg);
                } else
                {
                    \$('#addSharingForm').html(json.html);
                    updateFolderSelect();
                }

            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                \$('#addSharingForm').html(XMLHttpRequest.responseText);
            }
        });
    }

    function processAddSharing()
    {
        // get data
        \$.ajax({
            type: \"POST\",
            url: \"ajax/sharing_manage_add_process\",
            data: {
                created_by_user_id: \$('#created_by_user_id').val(),
                folder_id: \$('#folder_id').val(),
                shared_with_user_id: \$('#shared_with_user_id').val(),
                share_permission_level: \$('#share_permission_level').val()
            },
            dataType: 'json',
            success: function (json) {
                if (json.error == true)
                {
                    showError(json.msg, 'popupMessageContainer');
                } else
                {
                    showSuccess(json.msg);
                    reloadTable();
                    \$(\"#addServerForm\").modal(\"hide\");
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                showError(XMLHttpRequest.responseText, 'popupMessageContainer');
            }
        });

    }

    function updateFolderSelect()
    {
        // update dropdown while loading
        \$('#folder_id').html('<option value=\"\">Loading...</option>');

        // get data
        \$.ajax({
            type: \"POST\",
            url: \"ajax/sharing_manage_add_get_folder_listing\",
            data: {
                created_by_user_id: \$('#created_by_user_id').val()
            },
            dataType: 'json',
            success: function (json) {
                \$('#folder_id').html(json.html);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                showError(XMLHttpRequest.responseText, 'popupMessageContainer');
            }
        });

    }

    function addShareForm()
    {
        loadAddServerForm();
        \$('#addServerForm').modal(\"show\");
    }

    function reloadTable()
    {
        oTable.fnDraw(false);
    }
</script>

<!-- page content -->
<div class=\"right_col\" role=\"main\">
    <div class=\"\">
        <div class=\"page-title\">
            <div class=\"title_left\">
                <h3>";
        // line 214
        $this->displayBlock("title", $context, $blocks);
        echo "</h3>
            </div>
        </div>
        <div class=\"clearfix\"></div>

        ";
        // line 219
        echo ($context["msg_page_notifications"] ?? null);
        echo "

        <div class=\"row\">
            <div class=\"col-md-12 col-sm-12 col-xs-12\">
                <div class=\"x_panel\">
                    <div class=\"x_title\">
                        <h2>Manage Shared Items</h2>
                        <div class=\"clearfix\"></div>
                    </div>
                    <div class=\"x_content\">
                        <table id=\"sharingTable\" class=\"table table-striped table-only-border dtLoading bulk_action\">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>";
        // line 233
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("shared_date", "date shared")), "html", null, true);
        echo "</th>
                                    <th>";
        // line 234
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("by_user", "by user")), "html", null, true);
        echo "</th>
                                    <th>";
        // line 235
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("to_user", "to user")), "html", null, true);
        echo "</th>
                                    <th>";
        // line 236
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("shared_items", "shared items")), "html", null, true);
        echo " *</th>
                                    <th>";
        // line 237
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("access_level", "access level")), "html", null, true);
        echo "</th>
                                    <th>";
        // line 238
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("is_global_share", "is global share")), "html", null, true);
        echo "</th>
                                    <th>";
        // line 239
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("last_accessed", "last accessed")), "html", null, true);
        echo "</th>
                                    <th>";
        // line 240
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("action", "action")), "html", null, true);
        echo "</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan=\"20\">";
        // line 245
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("admin_loading_data", "Loading data..."), "html", null, true);
        echo "</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class=\"clear\"><br/></div>
                        <p>* Shared item counts include all folders but only files at the root level.</p>
                    </div>
                </div>

                <div class=\"x_panel\">
                    <div class=\"btn-group pull-left\">
                        <a href=\"#\" type=\"button\" class=\"btn btn-primary\" onClick=\"addShareForm(); return false;\">Create Share</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class=\"customFilter\" id=\"customFilter\" style=\"display: none;\">
    <label>
        Filter Results:
        <input name=\"filterText\" id=\"filterText\" type=\"text\" class=\"form-control\" onKeyUp=\"reloadTable(); return false;\" style=\"width: 160px;\"/>
    </label>
</div>

<div id=\"addServerForm\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
    <div class=\"modal-dialog modal-lg\">
        <div class=\"modal-content\">
            <div class=\"modal-header\"><button type=\"button\" class=\"close\" data-dismiss=\"modal\"><span aria-hidden=\"true\">×</span></button></div>
            <div class=\"modal-body\" id=\"addSharingForm\"></div>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Cancel</button>
                <button type=\"button\" class=\"btn btn-primary\" onClick=\"processAddSharing(); return false;\">Create Share</button>
            </div>
        </div>
    </div>
</div>

<div id=\"confirmDelete\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
    <div class=\"modal-dialog modal-lg\">
        <div class=\"modal-content\">
            <div class=\"modal-header\"><button type=\"button\" class=\"close\" data-dismiss=\"modal\"><span aria-hidden=\"true\">×</span></button></div>
            <div class=\"modal-body\" id=\"removeSharingLinkForm\">
                <div class=\"x_panel\">
                    <span id=\"confirmText\">
                        <div class=\"x_title\">
                            <h2>Confirm Sharing Link Removal</h2>
                            <div class=\"clearfix\"></div>
                        </div>
                        <div class=\"x_content\">
                            <p>Are you sure you want to remove the sharing link?</p>
                        </div>
                    </span>
                    <span id=\"pleaseWait\">
                        Removing, please wait...
                    </span>
                </div>
            </div>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Cancel</button>
                <button type=\"button\" class=\"btn btn-primary\" onClick=\"removeSharingLink(); return false;\">Confirm</button>
            </div>
        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "admin/sharing_manage.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  348 => 245,  340 => 240,  336 => 239,  332 => 238,  328 => 237,  324 => 236,  320 => 235,  316 => 234,  312 => 233,  295 => 219,  287 => 214,  148 => 77,  144 => 75,  142 => 74,  74 => 8,  70 => 7,  63 => 5,  56 => 4,  49 => 3,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "admin/sharing_manage.html.twig", "/var/www/html/medicalimage/app/views/admin/sharing_manage.html.twig");
    }
}
