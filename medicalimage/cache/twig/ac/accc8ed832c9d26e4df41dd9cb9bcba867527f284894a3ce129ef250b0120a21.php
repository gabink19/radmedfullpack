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

/* admin/account_package_manage.html.twig */
class __TwigTemplate_4547aab614a84825ee635ba2f05ad5801d3a3bd27a502fc9f746090889c07c4e extends \Twig\Template
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
        $this->parent = $this->loadTemplate("admin/partial/layout_logged_in.html.twig", "admin/account_package_manage.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Account Packages";
    }

    // line 4
    public function block_selected_page($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "account_level";
    }

    // line 5
    public function block_selected_sub_page($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "account_level";
    }

    // line 7
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 8
        echo "<script>
    oTable = null;
    gFileServerId = null;
    gEditUserLevelId = null;
    gTestFileServerId = null;
    gDeleteFileServerId = null;
    \$(document).ready(function () {
        // datatable
        oTable = \$('#packagesTable').dataTable({
            \"sPaginationType\": \"full_numbers\",
            \"bServerSide\": true,
            \"bProcessing\": true,
            \"sAjaxSource\": 'ajax/account_package_manage',
            \"iDisplayLength\": 25,
            \"aaSorting\": [[1, \"asc\"]],
            \"aoColumns\": [
                {bSortable: false, sWidth: '3%', sName: 'file_icon', sClass: \"center adminResponsiveHide\"},
                {bSortable: false},
                {bSortable: false, sWidth: '13%', sClass: \"center adminResponsiveHide\"},
                {bSortable: false, sWidth: '13%', sClass: \"center adminResponsiveHide\"},
                {bSortable: false, sWidth: '13%', sClass: \"center adminResponsiveHide\"},
                {bSortable: false, sWidth: '13%', sClass: \"center adminResponsiveHide\"},
                {bSortable: false, sWidth: '12%', sClass: \"center adminResponsiveHide\"},
                {bSortable: false, sWidth: '20%', sClass: \"center\"}
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
                \"sEmptyTable\": \"There are no packages in the current filters.\"
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
    });

    function editPackageForm(userLevelId)
    {
        gEditUserLevelId = userLevelId;
        showBasicModal('Loading...', 'Edit Package', '<button type=\"button\" class=\"btn btn-primary\" onClick=\"processAddUserPackage(); return false;\">Update Package</button>');
        loadEditUserPackageForm();
    }
    
    function loadEditUserPackageForm()
    {
        \$.ajax({
            type: \"POST\",
            url: \"ajax/account_package_manage_add_form\",
            data: {gEditUserLevelId: gEditUserLevelId},
            dataType: 'json',
            success: function (json) {
                if (json.error == true)
                {
                    setBasicModalContent(json.msg);
                } else
                {
                    setBasicModalContent(json.html);
                }

            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                setBasicModalContent(XMLHttpRequest.responseText);
            }
        });
    }

    function addPackageForm()
    {
        gEditUserLevelId = null;
        showBasicModal('Loading...', 'Add Package', '<button type=\"button\" class=\"btn btn-primary\" onClick=\"processAddUserPackage(); return false;\">Add Package</button>');
        loadAddPackageForm();
    }
    
    function loadAddPackageForm()
    {
        \$.ajax({
            type: \"POST\",
            url: \"ajax/account_package_manage_add_form\",
            data: {},
            dataType: 'json',
            success: function (json) {
                if (json.error == true)
                {
                    setBasicModalContent(json.msg);
                } else
                {
                    setBasicModalContent(json.html);
                }

            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                setBasicModalContent(XMLHttpRequest.responseText);
            }
        });
    }

    function processAddUserPackage()
    {
        // get data
        if (gEditUserLevelId !== null)
        {
            formData = \$('#editUserPackageForm').serialize();
        }
        else
        {
            formData = \$('#addUserPackageForm').serialize();
        }
        formData += \"&existing_user_level_id=\" + encodeURIComponent(gEditUserLevelId);

        \$.ajax({
            type: \"POST\",
            url: \"ajax/account_package_manage_add_process\",
            data: formData,
            dataType: 'json',
            success: function (json) {
                if (json.error == true)
                {
                    showError(json.msg, 'popupMessageContainer');
                } else
                {
                    showSuccess(json.msg);
                    reloadTable();
                    hideModal();
                }

            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                showError(XMLHttpRequest.responseText, 'popupMessageContainer');
            }
        });

    }
    
    function toggleElements(ele)
    {
        var eleId = \$(ele).prop('id');
        if(\$(ele).val() == 1) {
            \$('.'+eleId+' input').prop(\"disabled\", false);
        }
        else {
            \$('.'+eleId+' input').prop(\"disabled\", true);
        }
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
        // line 194
        $this->displayBlock("title", $context, $blocks);
        echo "</h3>
            </div>
        </div>
        <div class=\"clearfix\"></div>

        ";
        // line 199
        echo ($context["msg_page_notifications"] ?? null);
        echo "
        
        <div class=\"row\">
            <div class=\"col-md-12 col-sm-12 col-xs-12\">
                <div class=\"x_panel\">
                    <div class=\"x_title\">
                        <h2>Existing Packages</h2>
                        <div class=\"clearfix\"></div>
                    </div>
                    <div class=\"x_content\">
                        <table id=\"packagesTable\" class=\"table table-striped table-only-border dtLoading bulk_action\">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th class=\"align-left\">";
        // line 213
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("package_label", "package label")), "html", null, true);
        echo "</th>
                                    <th class=\"align-left\">";
        // line 214
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("users", "users")), "html", null, true);
        echo "</th>
                                    <th class=\"align-left\">";
        // line 215
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("allow_upload", "allow upload")), "html", null, true);
        echo "</th>
                                    <th class=\"align-left\">";
        // line 216
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("max_upload_size", "max upload size")), "html", null, true);
        echo "</th>
                                    <th class=\"align-left\">";
        // line 217
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("storage", "storage")), "html", null, true);
        echo "</th>
                                    <th class=\"align-left\">";
        // line 218
        echo twig_escape_filter($this->env, (((($context["currentProductType"] ?? null) == "cloudable")) ? (twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("inactive_files_days", "inactive files days"))) : (twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("on_upgrade_page", "upgrade page")))), "html", null, true);
        echo "</th>
                                    <th class=\"align-left\">";
        // line 219
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("action", "action")), "html", null, true);
        echo "</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan=\"20\">";
        // line 224
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("admin_loading_data", "Loading data..."), "html", null, true);
        echo "</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class=\"clearfix\"></div>
                        <br/><p>Note: Only packages which have a \"Package Type\" of \"Paid\" have the option to set pricing.</p>
                    </div>
                </div>
                
                <div class=\"x_panel\">
                    <div class=\"btn-group\">
                        <a href=\"#\" type=\"button\" class=\"btn btn-primary\" onClick=\"addPackageForm(); return false;\">New Account Package</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class=\"customFilter\" id=\"customFilter\" style=\"display: none;\">
    <label>
        Filter:
        <input name=\"filterText\" id=\"filterText\" type=\"text\" value=\"\" onKeyUp=\"reloadTable(); return false;\" style=\"width: 180px;\" class=\"form-control input-sm\"/>
    </label>
</div>
";
    }

    public function getTemplateName()
    {
        return "admin/account_package_manage.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  319 => 224,  311 => 219,  307 => 218,  303 => 217,  299 => 216,  295 => 215,  291 => 214,  287 => 213,  270 => 199,  262 => 194,  74 => 8,  70 => 7,  63 => 5,  56 => 4,  49 => 3,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "admin/account_package_manage.html.twig", "/var/www/html/medicalimage/app/views/admin/account_package_manage.html.twig");
    }
}
