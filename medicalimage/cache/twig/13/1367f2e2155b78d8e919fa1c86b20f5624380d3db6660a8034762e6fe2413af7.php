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

/* admin/banned_ip_manage.html.twig */
class __TwigTemplate_55c0effb7c28957198461cd479d13bc7788e403a7e4c7a47107cce7631ecb46b extends \Twig\Template
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
        $this->parent = $this->loadTemplate("admin/partial/layout_logged_in.html.twig", "admin/banned_ip_manage.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Manage Banned IP Addresses";
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
        echo "configuration";
    }

    // line 7
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 8
        echo "<script>
    oTable = null;
    gBannedIpId = null;
    \$(document).ready(function(){
        // datatable
        oTable = \$('#fileTable').dataTable({
            \"sPaginationType\": \"full_numbers\",
            \"bServerSide\": true,
            \"bProcessing\": true,
            \"sAjaxSource\": 'ajax/banned_ip_manage',
            \"iDisplayLength\": 25,
            \"aaSorting\": [[ 1, \"asc\" ]],
            \"aoColumns\" : [   
                { bSortable: false, sWidth: '3%', sName: 'file_icon', sClass: \"center adminResponsiveHide\" },
                { sName: 'ip_address', sWidth: '12%' },
                { sName: 'date_banned', sWidth: '12%', sClass: \"adminResponsiveHide\" },
                { sName: 'ban_type', sWidth: '10%', sClass: \"adminResponsiveHide\" },
                { sName: 'ban_expiry', sWidth: '15%', sClass: \"adminResponsiveHide\" },
                { sName: 'ban_notes' , sClass: \"adminResponsiveHide\"},
                { bSortable: false, sWidth: '10%', sClass: \"center\" }
            ],
            \"fnServerData\": function ( sSource, aoData, fnCallback ) {
                aoData.push( { \"name\": \"filterText\", \"value\": \$('#filterText').val() } );
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
                \"sEmptyTable\": \"There are no banned IP addresses in the current filters.\"
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
    
    function addIPForm()
    {
        showBasicModal('Loading...', 'Add IP Address', '<button type=\"button\" class=\"btn btn-primary\" onClick=\"processBanIPAddress(); return false;\">Ban IP Address</button>');
        loadAddIPForm();
    }

    function loadAddIPForm()
    {
        \$.ajax({
            type: \"POST\",
            url: \"ajax/banned_ip_manage_add_form\",
            data: { },
            dataType: 'json',
            success: function(json) {
                if(json.error == true)
                {
                    setBasicModalContent(json.msg);
                }
                else
                {
                    setBasicModalContent(json.html);
                    
                    // date picker
                    \$('#ban_expiry_date').daterangepicker({
                        singleDatePicker: true,
                        calender_style: \"picker_1\",
                        autoUpdateInput: false,
                        locale: {
                            format: 'DD/MM/YYYY'
                        }
                    }, function(chosen_date) {
                        \$('#ban_expiry_date').val(chosen_date.format('DD/MM/YYYY'));
                    });
                }
                
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                setBasicModalContent(XMLHttpRequest.responseText);
            }
        });
    }
    
    function processBanIPAddress()
    {
        // get data
        ip_address = \$('#ip_address').val();
        ban_type = \$('#ban_type').val();
        ban_expiry_date = \$('#ban_expiry_date').val();
        ban_expiry_hour = \$('#ban_expiry_hour').val();
        ban_expiry_minute = \$('#ban_expiry_minute').val();
        ban_notes = \$('#ban_notes').val();
        
        \$.ajax({
            type: \"POST\",
            url: \"ajax/banned_ip_manage_add_process\",
            data: { ip_address: ip_address, ban_type: ban_type, ban_expiry_date: ban_expiry_date, ban_expiry_hour: ban_expiry_hour, ban_expiry_minute: ban_expiry_minute, ban_notes: ban_notes },
            dataType: 'json',
            success: function(json) {
                if(json.error == true)
                {
                    showError(json.msg, 'popupMessageContainer');
                }
                else
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
    
    function reloadTable()
    {
        oTable.fnDraw(false);
    }
    
    function deleteBannedIp(bannedIpId)
    {
        showBasicModal('<p>Are you sure you want to remove the banned IP address?</p>', 'Confirm Removal', '<button type=\"button\" class=\"btn btn-primary\" onClick=\"removeBannedIp(); return false;\">Remove</button>');
        gBannedIpId = bannedIpId;
    }
    
    function removeBannedIp()
    {
        \$.ajax({
            type: \"POST\",
            url: \"ajax/banned_ip_manage_remove\",
            data: { bannedIpId: gBannedIpId },
            dataType: 'json',
            success: function(json) {
                if(json.error == true)
                {
                    showError(json.msg);
                }
                else
                {
                    showSuccess(json.msg);
                    reloadTable();
                    hideModal();
                }
                
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                showError(XMLHttpRequest.responseText);
            }
        });
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
                        <h2>Banned IP Addresses</h2>
                        <div class=\"clearfix\"></div>
                    </div>
                    <div class=\"x_content\">
                        <table id='fileTable' class='table table-striped table-only-border dtLoading bulk_action'>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th class=\"align-left\">";
        // line 213
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("ip_address", "IP Address"), "html", null, true);
        echo "</th>
                                    <th class=\"align-left\">";
        // line 214
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("date_banned", "Date Banned"), "html", null, true);
        echo "</th>
                                    <th class=\"align-left\">";
        // line 215
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("ban_type", "Ban Type"), "html", null, true);
        echo "</th>
                                    <th class=\"align-left\">";
        // line 216
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("ban_expiry", "Ban Expiry"), "html", null, true);
        echo "</th>
                                    <th class=\"align-left\">";
        // line 217
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("ban_notes", "Ban Notes"), "html", null, true);
        echo "</th>
                                    <th class=\"align-left\">";
        // line 218
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("actions", "Actions"), "html", null, true);
        echo "</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class=\"x_panel\">
                    <div class=\"pull-left\">
                        <a href=\"#\" type=\"button\" class=\"btn btn-primary\" onClick=\"addIPForm(); return false;\">Ban IP Address</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class=\"customFilter\" id=\"customFilter\" style=\"display: none;\">
    <label>
        Filter Results:
        <input name=\"filterText\" id=\"filterText\" type=\"text\" onKeyUp=\"reloadTable(); return false;\" style=\"width: 160px;\"/>
    </label>
</div>
";
    }

    public function getTemplateName()
    {
        return "admin/banned_ip_manage.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  307 => 218,  303 => 217,  299 => 216,  295 => 215,  291 => 214,  287 => 213,  270 => 199,  262 => 194,  74 => 8,  70 => 7,  63 => 5,  56 => 4,  49 => 3,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "admin/banned_ip_manage.html.twig", "/var/www/html/medicalimage/app/views/admin/banned_ip_manage.html.twig");
    }
}
