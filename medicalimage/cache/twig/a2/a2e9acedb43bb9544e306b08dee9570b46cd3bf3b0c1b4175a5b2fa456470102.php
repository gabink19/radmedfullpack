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

/* admin/user_manage.html.twig */
class __TwigTemplate_c3a139772c26fd0b12e910bee8afe09443b01c9d2274ab16a0a004e5cc62ab7b extends \Twig\Template
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
        $this->parent = $this->loadTemplate("admin/partial/layout_logged_in.html.twig", "admin/user_manage.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Manage Users";
    }

    // line 4
    public function block_selected_page($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "users";
    }

    // line 5
    public function block_selected_sub_page($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "user_manage";
    }

    // line 7
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 8
        echo "    <script>
        oTable = null;
        gUserId = null;
        oldStart = 0;
        \$(document).ready(function () {
            // datatable
            oTable = \$('#userTable').dataTable({
                \"sPaginationType\": \"full_numbers\",
                \"bServerSide\": true,
                \"bProcessing\": true,
                \"sAjaxSource\": 'ajax/user_manage',
                \"iDisplayLength\": 25,
                \"aaSorting\": [[1, \"asc\"]],
                \"aoColumns\": [
                    {bSortable: false, sWidth: '3%', sName: 'file_icon', sClass: \"center adminResponsiveHide\"},
                    {sName: 'username'},
                    {sName: 'email_address', sClass: \"adminResponsiveHide\"},
                    {sName: 'account_type', sWidth: '10%', sClass: \"center adminResponsiveHide\"},
                    {sName: 'last_login', sWidth: '15%', sClass: \"center adminResponsiveHide\"},
                    {sName: 'space_used', sWidth: '9%', sClass: \"center adminResponsiveHide\"},
                    {sName: 'total_files', sWidth: '8%', sClass: \"center adminResponsiveHide\"},
                    {sName: 'status', sWidth: '10%', sClass: \"center adminResponsiveHide\"},
                    {bSortable: false, sWidth: '16%', sClass: \"center dataTableFix responsiveTableColumn\"}
                ],
                \"fnServerData\": function (sSource, aoData, fnCallback, oSettings) {
                    setTableLoading();
                    if (oSettings._iDisplayStart != oldStart) {
                        var targetOffset = \$('.dataTables_wrapper').offset().top - 10;
                        \$('html, body').animate({scrollTop: targetOffset}, 300);
                        oldStart = oSettings._iDisplayStart;
                    }
                    aoData.push({\"name\": \"filterText\", \"value\": \$('#filterText').val()});
                    aoData.push({\"name\": \"filterByAccountType\", \"value\": \$('#filterByAccountType').val()});
                    aoData.push({\"name\": \"filterByAccountStatus\", \"value\": \$('#filterByAccountStatus').val()});
                    aoData.push({\"name\": \"filterByAccountId\", \"value\": \$('#filterByAccountId').val()});
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
                    \"sEmptyTable\": \"There are no files in the current filters.\"
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

        function confirmRemoveUser(userId)
        {
            showBasicModal('<p>Are you sure you want to permanently remove this user? All files and data relating to the user will be removed. This can not be undone.</p>', 'Remove User', '<button type=\"button\" class=\"btn btn-primary\" data-dismiss=\"modal\" onClick=\"removeUser(' + userId + '); return false;\">Remove</button>');
            return false;
        }

        function removeUser(userId)
        {
            setCurrentUserId(userId);
            bulkDeleteConfirm();
        }

        function confirmApproveUser(userId)
        {
            showBasicModal('<p>Are you sure you want to approve this user account? The user will be notified via email after approval.</p>', 'Approve User', '<button type=\"button\" class=\"btn btn-primary\" data-dismiss=\"modal\" onClick=\"approveUser(' + userId + '); return false;\">Approve</button>');
            return false;
        }

        function approveUser(userId)
        {
            // get server list for deleting all files
            \$.ajax({
                type: \"POST\",
                url: \"ajax/user_approve\",
                data: {userId: userId},
                dataType: 'json',
                success: function (json) {
                    if (json.error == true)
                    {
                        showError(json.msg);
                    } else
                    {
                        showSuccess(json.msg);
                        reloadTable();
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    showError('Failed connecting to server, please try again later.');
                }
            });
        }

        function confirmDeclineUser(userId)
        {
            showBasicModal('<p>Are you sure you want to decline this user account? The account will be removed and the user notified of the non-approval via email.</p>', 'Decline User', '<button type=\"button\" class=\"btn btn-primary\" data-dismiss=\"modal\" onClick=\"declineUser(' + userId + '); return false;\">Decline</button>');
            return false;
        }

        function declineUser(userId)
        {
            // get server list for deleting all files
            \$.ajax({
                type: \"POST\",
                url: \"ajax/user_decline\",
                data: {userId: userId},
                dataType: 'json',
                success: function (json) {
                    if (json.error == true)
                    {
                        showError(json.msg);
                    } else
                    {
                        showSuccess(json.msg);
                        reloadTable();
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    showError('Failed connecting to server, please try again later.');
                }
            });
        }

        var bulkError = '';
        var bulkSuccess = '';
        var totalDone = 0;
        var currentUserId = 0;
        function addBulkError(x)
        {
            bulkError += x;
        }
        function getBulkError(x)
        {
            return bulkError;
        }
        function addBulkSuccess(x)
        {
            bulkSuccess += x;
        }
        function getBulkSuccess(x)
        {
            return bulkSuccess;
        }
        function clearBulkResponses()
        {
            bulkError = '';
            bulkSuccess = '';
        }
        function setCurrentUserId(userId)
        {
            currentUserId = userId;
        }
        function getCurrentUserId(userId)
        {
            return currentUserId;
        }
        function bulkDeleteConfirm(userId)
        {
            // get server list for deleting all files
            \$.ajax({
                type: \"POST\",
                url: \"ajax/file_manage_bulk_delete\",
                data: {userId: getCurrentUserId()},
                dataType: 'json',
                success: function (json) {
                    if (json.error == true)
                    {
                        showError(json.msg);
                    } else
                    {
                        addBulkSuccess(json.msg);
                        finishBulkProcess();
                    }

                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    showError('Failed connecting to server to get the list of servers, please try again later.');
                }
            });
        }

        function finishBulkProcess()
        {
            // delete actual user
            \$.ajax({
                type: \"POST\",
                url: \"ajax/user_remove\",
                data: {userId: getCurrentUserId()},
                dataType: 'json',
                success: function (json) {
                    // compile result
                    if (json.error == true)
                    {
                        showError(json.msg);
                    } else
                    {
                        showSuccess(json.msg);
                    }
                    tidyBulkProcess();
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    showError('Failed deleting user, please try again later.');
                    tidyBulkProcess();
                }
            });
        }

        function tidyBulkProcess()
        {
            reloadTable();
            clearBulkResponses();

            // scroll to the top of the page
            \$(\"html, body\").animate({scrollTop: 0}, \"slow\");
            \$('#selectAllCB').prop('checked', false);
        }

        function confirmImpersonateUser(userId)
        {
            if (confirm(\"Are you sure you want to login as this user account? You'll have access to their account as they would see it.\\n\\nWhen you logout of the impersonated user, you'll be reverted to this admin user account again.\"))
            {
                window.location = \"user_manage?impersonate=\" + userId;
                return true;
            }

            return false;
        }
    </script>

    <!-- page content -->
    <div class=\"right_col\" role=\"main\">
        <div class=\"\">
            <div class=\"page-title\">
                <div class=\"title_left\">
                    <h3>";
        // line 274
        $this->displayBlock("title", $context, $blocks);
        echo "</h3>
                </div>
            </div>
            <div class=\"clearfix\"></div>

            ";
        // line 279
        echo ($context["msg_page_notifications"] ?? null);
        echo "

            <div class=\"row\">
                <div class=\"col-md-12 col-sm-12 col-xs-12\">
                    <div class=\"x_panel\">
                        <div class=\"x_title\">
                            <h2>User List</h2>
                            <div class=\"clearfix\"></div>
                        </div>
                        <div class=\"x_content\">
                            <table id=\"userTable\" class=\"table table-striped table-only-border dtLoading bulk_action\">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th class=\"align-left\">";
        // line 293
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("username", "Username"), "html", null, true);
        echo "</th>
                                        <th>";
        // line 294
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("email_address", "Email Address"), "html", null, true);
        echo "</th>
                                        <th>";
        // line 295
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("type", "Type"), "html", null, true);
        echo "</th>
                                        <th class=\"align-left\">";
        // line 296
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("last_login", "Last Login"), "html", null, true);
        echo "</th>
                                        <th class=\"align-left\">";
        // line 297
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("space_used", "HD Used"), "html", null, true);
        echo "</th>
                                        <th>";
        // line 298
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("files", "Files"), "html", null, true);
        echo "</th>
                                        <th>";
        // line 299
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("status", "Status"), "html", null, true);
        echo "</th>
                                        <th class=\"align-left\">";
        // line 300
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("actions", "Actions"), "html", null, true);
        echo "</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan=\"20\">";
        // line 305
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("admin_loading_data", "Loading data..."), "html", null, true);
        echo "</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class=\"x_panel\">
                        <div class=\"btn-group\">
                            <div class=\"dropup\">
                                <a href=\"user_add\" class=\"btn btn-default dropdown-toggle\" type=\"button\">
                                    Add User
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class=\"customFilter\" id=\"customFilter\" style=\"display: none;\">
        <label>
            Filter Results:
            <input name=\"filterText\" id=\"filterText\" type=\"text\" class=\"form-control\" value=\"";
        // line 330
        echo twig_escape_filter($this->env, ($context["filterText"] ?? null), "html", null, true);
        echo "\" onKeyUp=\"reloadTable();
                return false;\" style=\"width: 160px;\"/>
        </label>
        <label class=\"adminResponsiveHide\" style=\"padding-left: 6px;\">
            By Type:
            <select name=\"filterByAccountType\" id=\"filterByAccountType\" onChange=\"reloadTable();
                return false;\" style=\"width: 160px;\" class=\"form-control\">
                <option value=\"\">- all -</option>
                ";
        // line 338
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["accountTypeDetails"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["accountTypeDetail"]) {
            // line 339
            echo "                    <option value=\"";
            echo twig_escape_filter($this->env, (($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = $context["accountTypeDetail"]) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4["id"] ?? null) : null), "html", null, true);
            echo "\"";
            echo (((($context["filterByAccountType"] ?? null) == (($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 = $context["accountTypeDetail"]) && is_array($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144) || $__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 instanceof ArrayAccess ? ($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144["id"] ?? null) : null))) ? (" SELECTED") : (""));
            echo ">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, (($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b = $context["accountTypeDetail"]) && is_array($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b) || $__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b instanceof ArrayAccess ? ($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b["label"] ?? null) : null)), "html", null, true);
            echo "</option>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['accountTypeDetail'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 341
        echo "            </select>
        </label>
        <label class=\"adminResponsiveHide\" style=\"padding-left: 6px;\">
            By Status:
            <select name=\"filterByAccountStatus\" id=\"filterByAccountStatus\" onChange=\"reloadTable();
                return false;\" style=\"width: 120px;\" class=\"form-control\">
                <option value=\"\">- all -</option>
                ";
        // line 348
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["accountStatusDetails"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["accountStatusDetail"]) {
            // line 349
            echo "                    <option value=\"";
            echo twig_escape_filter($this->env, $context["accountStatusDetail"], "html", null, true);
            echo "\"";
            echo (((($context["filterByAccountStatus"] ?? null) == $context["accountStatusDetail"])) ? (" SELECTED") : (""));
            echo ">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $context["accountStatusDetail"]), "html", null, true);
            echo "</option>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['accountStatusDetail'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 351
        echo "            </select>
        </label>
        <input type=\"hidden\" value=\"";
        // line 353
        echo twig_escape_filter($this->env, ($context["filterByAccountId"] ?? null), "html", null, true);
        echo "\" name=\"filterByAccountId\" id=\"filterByAccountId\"/>
    </div>
";
    }

    public function getTemplateName()
    {
        return "admin/user_manage.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  489 => 353,  485 => 351,  472 => 349,  468 => 348,  459 => 341,  446 => 339,  442 => 338,  431 => 330,  403 => 305,  395 => 300,  391 => 299,  387 => 298,  383 => 297,  379 => 296,  375 => 295,  371 => 294,  367 => 293,  350 => 279,  342 => 274,  74 => 8,  70 => 7,  63 => 5,  56 => 4,  49 => 3,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "admin/user_manage.html.twig", "/var/www/html/medicalimage/app/views/admin/user_manage.html.twig");
    }
}
