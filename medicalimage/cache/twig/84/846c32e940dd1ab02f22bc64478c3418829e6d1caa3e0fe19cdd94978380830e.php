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

/* admin/plugin_settings.html.twig */
class __TwigTemplate_30f311ff099cf023e25834a38c35e4f4d02e4dfde5117ae9031b2268ce3390b1 extends \Twig\Template
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
            'head_css' => [$this, 'block_head_css'],
            'body' => [$this, 'block_body'],
            'head_js' => [$this, 'block_head_js'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "@core/admin/partial/layout_logged_in.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("@core/admin/partial/layout_logged_in.html.twig", "admin/plugin_settings.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo twig_escape_filter($this->env, ($context["pluginName"] ?? null), "html", null, true);
        echo " Settings";
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
    public function block_head_css($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 8
        echo "    <link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/jstree/themes/default/style.css\" />
";
    }

    // line 11
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 12
        echo "<div class=\"right_col\" role=\"main\">
    <div class=\"\">
        <div class=\"page-title\">
            <div class=\"title_left\">
                <h3>Import Files</h3>
            </div>
        </div>
        <div class=\"clearfix\"></div>
            ";
        // line 20
        echo ($context["msg_page_notifications"] ?? null);
        echo "
            <div class=\"row\">
                <div class=\"col-md-12 col-sm-12 col-xs-12\">
                    <div class=\"x_panel\">
                        <div class=\"x_title\">
                            <h2>Bulk Import</h2>
                            <div class=\"clearfix\"></div>
                        </div>
                        <div class=\"x_content\">
                        ";
        // line 29
        if ((($context["startImport"] ?? null) == false)) {
            // line 30
            echo "                        <form method=\"POST\" action=\"";
            echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/plugin/fileimport/settings\" class=\"form-horizontal form-label-left\" onSubmit=\"return confirmSubmission();\">
                            <div class=\"\" role=\"tabpanel\" data-example-id=\"togglable-tabs\">
                                <ul id=\"myTab\" class=\"nav nav-tabs bar_tabs\" role=\"tablist\">
                                    <li role=\"presentation\" class=\"active\"><a href=\"#tab_content1\" id=\"home-tab\" role=\"tab\" data-toggle=\"tab\" aria-expanded=\"true\">Import Tool</a>
                                    </li>
                                    <li role=\"presentation\" class=\"\"><a href=\"#tab_content2\" role=\"tab\" id=\"profile-tab\" data-toggle=\"tab\" aria-expanded=\"false\">Manual Import</a>
                                    </li>
                                </ul>
                                <div id=\"myTabContent\" class=\"tab-content\">
                                    <div role=\"tabpanel\" class=\"tab-pane fade active in\" id=\"tab_content1\" aria-labelledby=\"home-tab\">
                                        <p>Use the form below to bulk import files into the current server. If you require files to be imported onto an external file server, please load the admin area directly on that server and open this page.</p>
                                        <p>Upload the files into a sub-folder on your server and select it below.</p>
                                        <div class=\"form-group\">
                                            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"import_path\">Select Path to Import <span class=\"required\">*</span>
                                            </label>
                                            <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                                <input type=\"text\" id=\"import_path\" name=\"import_path\" required=\"required\" class=\"form-control col-md-7 col-xs-12\" placeholder=\"select below...\" value=\"";
            // line 46
            echo twig_escape_filter($this->env, ($context["import_path"] ?? null), "html", null, true);
            echo "\" style=\"margin-bottom: 6px;\"/>
                                                <div id=\"import_folder_listing\"></div>
                                                <p class=\"text-muted\" style=\"margin-top: 6px;\">Path to script installation: ";
            // line 48
            echo twig_escape_filter($this->env, ($context["DOC_ROOT"] ?? null), "html", null, true);
            echo "</p>
                                            </div>
                                        </div>
                                        <div class=\"form-group\">
                                            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"import_account\">Import into Account <span class=\"required\">*</span>
                                            </label>
                                            <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                                <input type=\"text\" id=\"import_account\" name=\"import_account\" required=\"required\" class=\"form-control col-md-7 col-xs-12 txt-auto\" placeholder=\"account username...\" value=\"";
            // line 55
            echo twig_escape_filter($this->env, ($context["import_account"] ?? null), "html", null, true);
            echo "\" autocomplete=\"off\"/>
                                                <p class=\"text-muted\">The account username to import the files into. Start typing to find the account.</p>
                                            </div>
                                        </div>
                                        <div class=\"form-group\">
                                            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"import_folder\">Import into Account Folder <span class=\"required\">*</span>
                                            </label>
                                            <div class=\"col-md-6 col-sm-6 col-xs-12\">
                                                <span id=\"import_folder_wrapper\">
                                                    <select id=\"import_folder\" name=\"import_folder\" class=\"form-control col-md-7 col-xs-12\" disabled=\"disabled\">
                                                        <option value=\"\">- select account above first -</option>
                                                    </select>
                                                </span>
                                                <p class=\"text-muted\">Updated with the folder list of the above users account. Files will be placed directly in this folder. <a href=\"#\" onClick=\"reloadUserFolderListing(); return false;\">(reload)</a></p>
                                            </div>
                                        </div>

                                        <div class=\"ln_solid\"></div>
                                        <div class=\"form-group\">
                                            <div class=\"col-md-6 col-sm-6 col-xs-12 col-md-offset-3\">
                                                <button type=\"submit\" class=\"btn btn-primary\">Import Files</button>
                                            </div>
                                        </div>

                                    </div>
                                    <div role=\"tabpanel\" class=\"tab-pane fade\" id=\"tab_content2\" aria-labelledby=\"profile-tab\">
                                        <p>The import script enables you to migrate your existing 'offline' files into the script. It can be run on your main server aswell as file servers.</p>
                                        <p>First download the <a href=\"";
            // line 82
            echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/plugin/fileimport/download_import_script\">import.php script</a>. This can also be found in:</p>
                                        <code>
                                            ";
            // line 84
            echo twig_escape_filter($this->env, ($context["DOC_ROOT"] ?? null), "html", null, true);
            echo "/plugins/fileimport/offline/import.php.txt (rename to import.php)
                                        </code>
                                        <br/><br/>
                                        <p>Populate the constants in [[[SQUARE_BRACKET]]] at the top of import.php. i.e. FILE_IMPORT_ACCOUNT_NAME, FILE_IMPORT_PATH, FILE_IMPORT_ACCOUNT_START_FOLDER</p>
                                        <p>Save and upload the file, either to the YetiShare root of your main site or the YetiShare root of a file server. The YetiShare root path is the same location as this file: _config.inc.php</p>
                                        <p>Using FTP or WinSCP, upload or move all the files you want to import to a folder on that server. This should be outside of the YetiShare installation (FILE_IMPORT_PATH in import.php).</p>
                                        <p>Execute the script on the command line (via SSH) using PHP. Like this:</p>
                                        <code>
                                            php ";
            // line 92
            echo twig_escape_filter($this->env, ($context["DOC_ROOT"] ?? null), "html", null, true);
            echo "/import.php
                                        </code>
                                        <br/><br/>
                                        <p>The import will complete with progress onscreen. Files will not be moved, they'll be copied into YetiShare so you will need to delete them from the temporary folder after the import.</p>
                                        <p>Once the import is complete, ensure you remove the import.php script from your YetiShare root.</p>
                                    </div>
                                </div>
                            </div>

                            <input type=\"hidden\" name=\"submitted\" value=\"1\"/>
                        </form>
                        ";
        } else {
            // line 104
            echo "                            <p>Importing files from ";
            echo twig_escape_filter($this->env, ($context["import_path"] ?? null), "html", null, true);
            echo ", please check below for progress. Note that this process can take some time.</p>
                            <iframe src=\"";
            // line 105
            echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/plugin/fileimport/process_file_import?";
            echo twig_escape_filter($this->env, ($context["urlParams"] ?? null), "html", null, true);
            echo "\" style=\"border: 0px; width: 100%; height: 360px;\"></iframe>
                        ";
        }
        // line 107
        echo "                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
";
    }

    // line 115
    public function block_head_js($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 116
        echo "<script src=\"";
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/jstree/jstree.min.js\"></script>
<script>
    var firstLoad = true;
    \$(function () {
        \$('#import_folder_listing').jstree({
            'core': {
                'data': {
                    'url': '";
        // line 123
        echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/plugin/fileimport/ajax/folder_listing',
                    'data': function (node) {
                        return {'id': node.id};
                    }
                },
                'check_callback': function (o, n, p, i, m) {
                    if (m && m.dnd && m.pos !== 'i') {
                        return false;
                    }
                    return true;
                },
                'force_text': true,
                'themes': {
                    'responsive': false,
                    'variant': 'small',
                    'stripes': true
                }
            },
            'sort': function (a, b) {
                return this.get_type(a) === this.get_type(b) ? (this.get_text(a) > this.get_text(b) ? 1 : -1) : (this.get_type(a) >= this.get_type(b) ? 1 : -1);
            },
            'types': {
                'default': {'icon': 'folder'}
            },
            'plugins': ['state', 'sort', 'types']
        }).on(\"select_node.jstree\", function (e, data) {
            \$('#import_path').val('";
        // line 149
        echo twig_escape_filter($this->env, ($context["basePath"] ?? null), "html", null, true);
        echo "'+data.node.id);
        });
        
        \$('#import_account').typeahead({
            source: function( request, response ) {
                \$.ajax({
                    url : '";
        // line 155
        echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/ajax/file_manage_auto_complete',
                    dataType: \"json\",
                    data: {
                       filterByUser: \$(\"#import_account\").val()
                    },
                     success: function( data ) {
                        response( data );
                    }
                });
            },
            minLength: 3,
            delay: 1,
            afterSelect: function() { 
                reloadUserFolderListing();
            }
        });
        
        ";
        // line 172
        if ((($context["submitted"] ?? null) == true)) {
            // line 173
            echo "            reloadUserFolderListing();
        ";
        }
        // line 175
        echo "    });
    
    function reloadUserFolderListing()
    {
        setElementLoading('#import_folder_wrapper');
        \$('#import_folder_wrapper').load('";
        // line 180
        echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/ajax/get_user_folder_for_select', {'import_account': \$(\"#import_account\").val()}, function() {
            // reload selected item
            if(firstLoad == true)
            {
                ";
        // line 184
        if ((twig_length_filter($this->env, ($context["import_folder"] ?? null)) > 0)) {
            // line 185
            echo "                    \$('#import_folder').val(";
            echo twig_escape_filter($this->env, ($context["import_folder"] ?? null), "html", null, true);
            echo ");
                ";
        }
        // line 187
        echo "                firstLoad = false;
            }
        });
    }
    
    function confirmSubmission()
    {
        return confirm(\"Are you sure you want to import these files? Please confirm the details below. Once submitted, this may take some time to complete.\\n\\nImport Files: \"+\$('#import_path').val()+\"\\nInto Account: \"+\$('#import_account').val()+\"\\nInto User Folder: \"+\$('#import_folder option:selected').text());
    }
</script>
";
    }

    public function getTemplateName()
    {
        return "admin/plugin_settings.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  331 => 187,  325 => 185,  323 => 184,  316 => 180,  309 => 175,  305 => 173,  303 => 172,  283 => 155,  274 => 149,  245 => 123,  234 => 116,  230 => 115,  220 => 107,  213 => 105,  208 => 104,  193 => 92,  182 => 84,  177 => 82,  147 => 55,  137 => 48,  132 => 46,  112 => 30,  110 => 29,  98 => 20,  88 => 12,  84 => 11,  77 => 8,  73 => 7,  66 => 5,  59 => 4,  51 => 3,  40 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "admin/plugin_settings.html.twig", "/var/www/html/medicalimage/plugins/fileimport/views/admin/plugin_settings.html.twig");
    }
}
