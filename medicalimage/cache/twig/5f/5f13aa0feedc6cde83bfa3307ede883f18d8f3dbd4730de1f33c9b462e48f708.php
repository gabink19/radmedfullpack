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

/* admin/translation_manage.html.twig */
class __TwigTemplate_07abca67da03831da26feea6542d643ef82bae205ba858220e3f39ff3a080652 extends \Twig\Template
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
        $this->parent = $this->loadTemplate("admin/partial/layout_logged_in.html.twig", "admin/translation_manage.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Manage Languages";
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
    oTable = null;
    gLanguageId = null;
    gDefaultLanguage = '';
    gEditLanguageId = null;
    \$(document).ready(function () {
        // datatable
        oTable = \$('#fileTable').dataTable({
            \"sPaginationType\": \"full_numbers\",
            \"bServerSide\": true,
            \"bProcessing\": true,
            \"sAjaxSource\": 'ajax/translation_manage',
            \"iDisplayLength\": 25,
            \"aaSorting\": [[1, \"asc\"]],
            \"aoColumns\": [
                {bSortable: false, sWidth: '3%', sName: 'file_icon', sClass: \"center adminResponsiveHide\"},
                {sName: 'language'},
                {bSortable: false, sWidth: '10%', sClass: \"center adminResponsiveHide\"},
                {bSortable: false, sWidth: '10%', sClass: \"center adminResponsiveHide\"},
                {bSortable: false, sWidth: '10%', sClass: \"center adminResponsiveHide\"},
                {bSortable: false, sWidth: '25%', sClass: \"center dataTableFix responsiveTableColumn\"}
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
            \"fnDrawCallback\": function (oSettings) {
                postDatatableRender();
            },
            \"oLanguage\": {
                \"sEmptyTable\": \"There are no languages in the current filters.\"
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

    function addLanguageForm()
    {
        showBasicModal('Loading...', 'Add Language', '<button type=\"button\" class=\"btn btn-primary\" onClick=\"processAddLanguage(); return false;\">Add Language</button>');
        loadAddLanguageForm();
    }

    function loadAddLanguageForm()
    {
        \$.ajax({
            type: \"POST\",
            url: \"ajax/translation_manage_add_form\",
            data: {},
            dataType: 'json',
            success: function (json) {
                if (json.error == true)
                {
                    setBasicModalContent(json.msg);
                } else
                {
                    setBasicModalContent(json.html);
                    \$('#translation_flag').selectpicker({
                        size: 8,
                        liveSearch: true
                    }).on('changed.bs.select', function (e) {
                        \$('#translation_flag_hidden').val(\$('#translation_flag').val());
                    });
                }

            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                setBasicModalContent(XMLHttpRequest.responseText);
            }
        });
    }

    function processAddLanguage()
    {
        // get data
        translation_name = \$('#translation_name').val();
        translation_flag = \$('#translation_flag_hidden').val();
        direction = \$('#direction').val();
        language_code = \$('#language_code').val();

        \$.ajax({
            type: \"POST\",
            url: \"ajax/translation_manage_add_process\",
            data: {translation_name: translation_name, translation_flag: translation_flag, direction: direction, language_code: language_code},
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

    function editLanguageForm(languageId)
    {
        gEditLanguageId = languageId;
        showBasicModal('Loading...', 'Edit Language', '<button type=\"button\" class=\"btn btn-primary\" onClick=\"processEditLanguage(); return false;\">Update Language</button>');
        loadEditLanguageForm();
    }

    function loadEditLanguageForm()
    {
        \$.ajax({
            type: \"POST\",
            url: \"ajax/translation_manage_add_form\",
            data: {languageId: gEditLanguageId},
            dataType: 'json',
            success: function (json) {
                if (json.error == true)
                {
                    setBasicModalContent(json.msg);
                } else
                {
                    setBasicModalContent(json.html);
                    \$('#translation_flag').selectpicker({
                        size: 8,
                        liveSearch: true
                    }).on('changed.bs.select', function (e) {
                        \$('#translation_flag_hidden').val(\$('#translation_flag').val());
                    });
                }

            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                setBasicModalContent(XMLHttpRequest.responseText);
            }
        });
    }

    function processEditLanguage()
    {
        // get data
        translation_name = \$('#translation_name').val();
        translation_flag = \$('#translation_flag_hidden').val();
        direction = \$('#direction').val();
        language_code = \$('#language_code').val();

        \$.ajax({
            type: \"POST\",
            url: \"ajax/translation_manage_add_process\",
            data: {translation_name: translation_name, translation_flag: translation_flag, languageId: gEditLanguageId, direction: direction, language_code: language_code},
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

    function reloadTable()
    {
        oTable.fnDraw(false);
    }

    function deleteLanguage(languageId)
    {
        gLanguageId = languageId;
        showBasicModal('Are you sure you want to delete this language? Any translations will also be removed.', 'Delete Language', '<button type=\"button\" class=\"btn btn-primary\" onClick=\"removeLanguage(); return false;\">Confirm Delete</button>');
    }

    function removeLanguage()
    {
        \$.ajax({
            type: \"POST\",
            url: \"ajax/translation_manage_remove\",
            data: {languageId: gLanguageId},
            dataType: 'json',
            success: function (json) {
                if (json.error == true)
                {
                    showError(json.msg);
                } else
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

    function setDefault(defaultLanguage)
    {
        gDefaultLanguage = defaultLanguage;
        showBasicModal('Are you sure you want to set this language as the default on the site?', 'Set Default', '<button type=\"button\" class=\"btn btn-primary\" onClick=\"setDefaultLanguage(); return false;\">Confirm Default</button>');
    }

    function setDefaultLanguage()
    {
        \$.ajax({
            type: \"POST\",
            url: \"ajax/translation_manage_set_default_language\",
            data: {defaultLanguage: gDefaultLanguage},
            dataType: 'json',
            success: function (json) {
                if (json.error == true)
                {
                    showError(json.msg);
                } else
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

    function setAvailableState(languageId, state)
    {
        \$.ajax({
            type: \"POST\",
            url: \"ajax/translation_manage_set_available_state\",
            data: {languageId: languageId, state: state},
            dataType: 'json',
            success: function (json) {
                if (json.error == true)
                {
                    showError(json.msg);
                } else
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

    function confirmRescan()
    {
        if (confirm('Are you sure you want to scan the codebase for missing translations? This will examine each file in the script for translations and automatically add the default text into the database. This process can take some time to complete.'))
        {
            window.location = 'translation_manage?rebuild=1';
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
        // line 318
        $this->displayBlock("title", $context, $blocks);
        echo "</h3>
            </div>
        </div>
        <div class=\"clearfix\"></div>

        ";
        // line 323
        echo ($context["msg_page_notifications"] ?? null);
        echo "

        <div class=\"row\">
            <div class=\"col-md-12 col-sm-12 col-xs-12\">
                <div class=\"x_panel\">
                    <div class=\"x_title\">
                        <h2>Available Languages</h2>
                        <div class=\"clearfix\"></div>
                    </div>
                    <div class=\"x_content\">
                        <table id=\"fileTable\" class=\"table table-striped table-only-border dtLoading bulk_action\">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th class=\"align-left\">";
        // line 337
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("language_name", "Language Name")), "html", null, true);
        echo "</th>
                                    <th class=\"align-left\">";
        // line 338
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("default", "Default")), "html", null, true);
        echo "</th>
                                    <th class=\"align-left\">";
        // line 339
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("available", "Available")), "html", null, true);
        echo "</th>
                                    <th class=\"align-left\">";
        // line 340
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("direction", "Direction")), "html", null, true);
        echo "</th>
                                    <th class=\"align-left\">";
        // line 341
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("actions", "Actions")), "html", null, true);
        echo "</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan=\"20\">";
        // line 346
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("admin_loading_data", "Loading data..."), "html", null, true);
        echo "</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class=\"x_panel\">
                    <div class=\"pull-left\">
                        <a href=\"#\" type=\"button\" class=\"btn btn-primary\" onClick=\"addLanguageForm(); return false;\">Add Language</a>
                    </div>
                    <div class=\"pull-right\">
                        <a href=\"#\" type=\"button\" class=\"btn btn-default\" onClick=\"confirmRescan(); return false;\">Scan For Missing Translations</a>
                        <a href=\"translation_manage_export\" type=\"button\" class=\"btn btn-default\">Export Translations</a>
                        <a href=\"translation_manage_import\" type=\"button\" class=\"btn btn-default\">Import Translations</a>
                    </div>
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
        return "admin/translation_manage.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  435 => 346,  427 => 341,  423 => 340,  419 => 339,  415 => 338,  411 => 337,  394 => 323,  386 => 318,  74 => 8,  70 => 7,  63 => 5,  56 => 4,  49 => 3,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "admin/translation_manage.html.twig", "/var/www/html/medicalimage/app/views/admin/translation_manage.html.twig");
    }
}
