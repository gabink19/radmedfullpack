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

/* admin/translation_manage_text.html.twig */
class __TwigTemplate_ae62d8a2311e9789f37c89526fdef8ecdce4b2107a2d5f287aefb3be4a543284 extends \Twig\Template
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
        $this->parent = $this->loadTemplate("admin/partial/layout_logged_in.html.twig", "admin/translation_manage_text.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Manage Translations For '";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["languageDetail"] ?? null), "languageName", [], "any", false, false, false, 3), "html", null, true);
        echo "'";
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
    gTranslationId = null;
    \$(document).ready(function () {
        // datatable
        oTable = \$('#fileTable').dataTable({
            \"sPaginationType\": \"full_numbers\",
            \"bServerSide\": true,
            \"bProcessing\": true,
            \"sAjaxSource\": 'ajax/translation_manage_text?languageId=";
        // line 17
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["languageDetail"] ?? null), "id", [], "any", false, false, false, 17), "html", null, true);
        echo "',
            \"iDisplayLength\": 50,
            \"aaSorting\": [[1, \"asc\"]],
            \"aoColumns\": [
                {bSortable: false, sWidth: '3%', sName: 'file_icon', sClass: \"center adminResponsiveHide\"},
                {sName: 'language_key', sWidth: '17%', sClass: \"adminResponsiveHide\"},
                {sName: 'english_content', sWidth: '25%', sClass: \"adminResponsiveHide\"},
                {sName: 'translated_content'},
                {bSortable: false, sWidth: '3%', sName: 'file_icon', sClass: \"center adminResponsiveHide\"},
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
                \"sEmptyTable\": \"There is no language text in the current filters.\"
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

    function setLoader()
    {
        \$('#translationForm').html('Loading, please wait...');
    }

    function editTranslationForm(translationId)
    {
        gTranslationId = translationId;
        showBasicModal('Loading...', 'Translate Text', '<button type=\"button\" class=\"btn btn-primary\" onClick=\"updateTranslationValue(); return false;\">Update Text</button>');
        loadEditTranslationForm();
    }
    
    function loadEditTranslationForm()
    {
        \$.ajax({
            type: \"POST\",
            url: \"ajax/translation_manage_text_edit_form\",
            data: {gTranslationId: gTranslationId, languageId: ";
        // line 90
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["languageDetail"] ?? null), "id", [], "any", false, false, false, 90), "html", null, true);
        echo "},
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
    
    function updateTranslationValue()
    {
        // get data
        translation_item_id = \$('#translation_item_id').val();
        translated_content = \$('#translated_content').val();

        \$.ajax({
            type: \"POST\",
            url: \"ajax/translation_manage_text_edit_process\",
            data: {translation_item_id: translation_item_id, translated_content: translated_content, languageId: ";
        // line 117
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["languageDetail"] ?? null), "id", [], "any", false, false, false, 117), "html", null, true);
        echo "},
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

    function startAutoTranslation()
    {
        showBasicModal('Loading...', 'Auto Translation');
        setBasicModalContent('Loading, please wait...');
        setBasicModalContent('<iframe src=\"";
        // line 141
        echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/ajax/translation_manage_text_auto_convert/";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["languageDetail"] ?? null), "id", [], "any", false, false, false, 141), "html", null, true);
        echo "\" style=\"background: url(\\'";
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/images/spinner.gif\\') no-repeat center center;\" height=\"100%\" width=\"100%\" frameborder=\"0\" scrolling=\"auto\">Loading...</iframe>');
    }

    function reloadTable()
    {
        oTable.fnDraw(false);
    }

    function deleteTranslation(textId)
    {
        if (confirm(\"Are you sure you want to delete this translation text? It will be removed from ALL languages you have, not just this one. It'll be repopulated with the default translation text when it's requested by the script, or after a translation re-scan.\"))
        {
            window.location = \"";
        // line 153
        echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/translation_manage_text?languageId=";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["languageDetail"] ?? null), "id", [], "any", false, false, false, 153), "html", null, true);
        echo "&d=\" + textId;
        }

        return false;
    }

    function processAutoTranslate()
    {
        ";
        // line 161
        if ((twig_length_filter($this->env, ($context["SITE_CONFIG_GOOGLE_TRANSLATE_API_KEY"] ?? null)) == 0)) {
            // line 162
            echo "            alert('This process requires a valid Google Translation API key within the site settings. Please add this and try again. Note: There may be a fee from Google for using the auto translation.');
            return false;
        ";
        }
        // line 165
        echo "
        var enText = \$('#enTranslationText').val();
        var toLangCode = \$('#enTranslationCode').val();
        \$.ajax({
            type: \"POST\",
            url: \"ajax/translation_manage_text_auto_process\",
            data: {enText: enText, toLangCode: toLangCode},
            dataType: 'json',
            success: function (json) {
                if (json.error == true)
                {
                    showError(json.msg, 'popupMessageContainer');
                } else
                {
                    showSuccess(json.msg);
                    \$('#translated_content').val(json.translation);
                }

            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                showError(XMLHttpRequest.responseText, 'popupMessageContainer');
            }
        });
    }

    function confirmAutomaticTranslate()
    {
        ";
        // line 192
        if ((twig_length_filter($this->env, ($context["SITE_CONFIG_GOOGLE_TRANSLATE_API_KEY"] ?? null)) == 0)) {
            // line 193
            echo "            alert('This process requires a valid Google Translation API key within the site settings. Please add this and try again. Note: There may be a fee from Google for using the auto translation.');
            return false;
        ";
        }
        // line 196
        echo "
        if (confirm(\"Are you sure you want to automatically translate the above 'en' text into '";
        // line 197
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["languageDetail"] ?? null), "language_code", [], "any", false, false, false, 197), "html", null, true);
        echo "'? This will be done via the Google Translation API and may take some time to complete.\\n\\nIMPORTANT: This process will OVERWRITE any translations which are not locked ('";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["languageDetail"] ?? null), "language_code", [], "any", false, false, false, 197), "html", null, true);
        echo "'). If you're unsure, cancel and 'export' a copy of the language so you have a backup.\\n\\nIf this process timesout, you can re-run it to pickup where it failed. Each new translation is marked as 'locked' so it'll only be translated once.\"))
        {
            startAutoTranslation();
        }

        return false;
    }

    function toggleLock(contentId)
    {
        \$.ajax({
            type: \"POST\",
            url: \"ajax/translation_manage_text_set_is_locked\",
            data: {contentId: contentId},
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
        // line 236
        $this->displayBlock("title", $context, $blocks);
        echo "</h3>
            </div>
        </div>
        <div class=\"clearfix\"></div>

        ";
        // line 241
        echo ($context["msg_page_notifications"] ?? null);
        echo "

        <div class=\"row\">
            <div class=\"col-md-12 col-sm-12 col-xs-12\">
                <div class=\"x_panel\">
                    <div class=\"x_title\">
                        <h2>Translations</h2>
                        <div class=\"clearfix\"></div>
                    </div>
                    <div class=\"x_content\">
                        <table id=\"fileTable\" class=\"table table-striped table-only-border dtLoading bulk_action\">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th class=\"align-left\">";
        // line 255
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("language_key", "Language Key"), "html", null, true);
        echo "</th>
                                    <th class=\"align-left\">";
        // line 256
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("english_content", "English Content"), "html", null, true);
        echo "</th>
                                    <th class=\"align-left\">";
        // line 257
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("translated_content", "Translated Content"), "html", null, true);
        echo "</th>
                                    <th></th>
                                    <th class=\"align-left\">";
        // line 259
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("actions", "Actions"), "html", null, true);
        echo "</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan=\"20\">";
        // line 264
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("admin_loading_data", "Loading data..."), "html", null, true);
        echo "</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class=\"x_panel\">
                    <a href=\"translation_manage\" type=\"button\" class=\"btn btn-primary\">< Back to Languages</a>
                    <a href=\"#\" type=\"button\" class=\"btn btn-default\" onClick=\"confirmAutomaticTranslate(); return false;\">Automatic Translate (via Google Translate)</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class=\"customFilter\" id=\"customFilter\" style=\"display: none;\">
    <label>
        Filter Results:
        <input name=\"filterText\" id=\"filterText\" type=\"text\" onKeyUp=\"reloadTable();
                return false;\" style=\"width: 160px;\"/>
    </label>
</div>
";
    }

    public function getTemplateName()
    {
        return "admin/translation_manage_text.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  388 => 264,  380 => 259,  375 => 257,  371 => 256,  367 => 255,  350 => 241,  342 => 236,  298 => 197,  295 => 196,  290 => 193,  288 => 192,  259 => 165,  254 => 162,  252 => 161,  239 => 153,  220 => 141,  193 => 117,  163 => 90,  87 => 17,  76 => 8,  72 => 7,  65 => 5,  58 => 4,  49 => 3,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "admin/translation_manage_text.html.twig", "/var/www/html/medicalimage/app/views/admin/translation_manage_text.html.twig");
    }
}
