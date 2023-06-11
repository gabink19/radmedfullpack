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

/* admin/ajax/server_manage_add_form.html.twig */
class __TwigTemplate_a4761f6c7e3a32fc52536aceea02af7dba73f1655e7658925e6e7a6d6ba39891 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<form id=\"addFileServerForm\" class=\"form-horizontal form-label-left input_mask\">
    <div class=\"x_panel\">
        <div class=\"x_content\">
            <div class=\"\" role=\"tabpanel\" data-example-id=\"togglable-tabs\">
                <ul id=\"myTab\" class=\"nav nav-tabs bar_tabs\" role=\"tablist\">
                    <li role=\"presentation\" class=\"active\"><a href=\"#tab_content1\" id=\"home-tab\" role=\"tab\" data-toggle=\"tab\" aria-expanded=\"true\">Server Details</a>
                    </li>
                    <li role=\"presentation\" class=\"\"><a href=\"#tab_content2\" role=\"tab\" id=\"profile-tab\" data-toggle=\"tab\" aria-expanded=\"false\">CDN Support</a>
                    </li>
                    <li role=\"presentation\" class=\"\"><a href=\"#tab_content3\" role=\"tab\" id=\"profile-tab\" data-toggle=\"tab\" aria-expanded=\"false\">Storage Options</a>
                    </li>
                </ul>
                <div id=\"myTabContent\" class=\"tab-content\">
                    <div role=\"tabpanel\" class=\"tab-pane fade active in\" id=\"tab_content1\" aria-labelledby=\"home-tab\">
                        <div class=\"x_title\">
                            <h2>Server Details:</h2>
                            <div class=\"clearfix\"></div>
                        </div>

                        <p>Use the form below to ";
        // line 20
        echo twig_escape_filter($this->env, ($context["formType"] ?? null), "html", null, true);
        echo " file server details.<br/><br/></p>

                        <div class=\"form-group\">
                            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
        // line 23
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("server_label", "server label")), "html", null, true);
        echo ":</label>
                            <div class=\"col-md-5 col-sm-5 col-xs-12\">
                                <input name=\"server_label\" id=\"server_label\" placeholder=\"i.e. File Server 1\" type=\"text\" class=\"form-control\" value=\"";
        // line 25
        echo twig_escape_filter($this->env, ($context["server_label"] ?? null), "html", null, true);
        echo "\" class=\"xlarge\" ";
        echo ((($context["isDefaultServer"] ?? null)) ? ("DISABLED") : (""));
        echo "/>
                                <p class=\"text-muted\">For your own internal reference only.</p>
                            </div>
                        </div>
                        <div class=\"form-group\">
                            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
        // line 30
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("status", "status")), "html", null, true);
        echo ":</label>
                            <div class=\"col-md-5 col-sm-5 col-xs-12\">
                                <select name=\"status_id\" id=\"status_id\" class=\"form-control\">
                                    ";
        // line 33
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["statusDetails"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["statusDetail"]) {
            // line 34
            echo "                                        <option value=\"";
            echo twig_escape_filter($this->env, (($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = $context["statusDetail"]) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4["id"] ?? null) : null), "html", null, true);
            echo "\"";
            echo (((($context["status_id"] ?? null) == (($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 = $context["statusDetail"]) && is_array($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144) || $__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 instanceof ArrayAccess ? ($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144["id"] ?? null) : null))) ? (" SELECTED") : (""));
            echo ">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, (($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b = $context["statusDetail"]) && is_array($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b) || $__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b instanceof ArrayAccess ? ($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b["label"] ?? null) : null)), "html", null, true);
            echo "</option>
                                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['statusDetail'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 36
        echo "                                </select>
                            </div>
                        </div>

                        <div class=\"form-group\">
                            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
        // line 41
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("server_type", "server type")), "html", null, true);
        echo ":</label>
                            <div class=\"col-md-9 col-sm-9 col-xs-12\">
                                <select name=\"server_type\" id=\"server_type\" class=\"form-control\" onChange=\"showHideFTPElements();
                                        return false;\" ";
        // line 44
        echo ((($context["isDefaultServer"] ?? null)) ? ("DISABLED") : (""));
        echo ">
                                    <optgroup label=\"Storage Options\">
                                        <option value=\"local\"";
        // line 46
        echo (((($context["server_type"] ?? null) == "local")) ? (" SELECTED") : (""));
        echo ">Local (storage located on the same server as your site - if you don't need external storage)</option>
                                        <option value=\"direct\"";
        // line 47
        echo (((($context["server_type"] ?? null) == "direct")) ? (" SELECTED") : (""));
        echo ">Remote Direct (files are upload and download directly with the remote file server - for large filesizes and busy sites)</option>
                                        <option value=\"ftp\"";
        // line 48
        echo (((($context["server_type"] ?? null) == "ftp")) ? (" SELECTED") : (""));
        echo ">FTP (uses FTP via PHP to upload files into storage - for smaller filesizes or personal sites)</option>
                                        ";
        // line 49
        echo ($context["additionalFileServerTypesOptionsHtml"] ?? null);
        echo "
                                    </optgroup>
                                    ";
        // line 51
        echo ($context["flysystemFileServerTypesOptionsHtml"] ?? null);
        echo "
                                </select>
                            </div>
                        </div>

                        <span class=\"localElements\" style=\"display: none;\">
                            <div class=\"form-group\">
                                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
        // line 58
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("file_server_direct_server_path_to_install", "server path to install")), "html", null, true);
        echo ":</label>
                                <div class=\"col-md-9 col-sm-9 col-xs-12\">
                                    <input name=\"script_root_path\" id=\"local_script_root_path\" placeholder=\"/home/admin/public_html\" type=\"text\" value=\"";
        // line 60
        echo twig_escape_filter($this->env, ($context["script_root_path"] ?? null), "html", null, true);
        echo "\" class=\"form-control\" DISABLED/>
                                    <p class=\"text-muted\">The full server path to your install. If you're unsure, leave empty and it'll be auto generated.</p>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
        // line 65
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("file_storage_path", "file storage path")), "html", null, true);
        echo ":</label>
                                <div class=\"col-md-9 col-sm-9 col-xs-12\">
                                    <input name=\"storage_path\" id=\"local_storage_path\" type=\"text\" value=\"";
        // line 67
        echo twig_escape_filter($this->env, ($context["storage_path"] ?? null), "html", null, true);
        echo "\" class=\"form-control\" ";
        echo ((($context["isDefaultServer"] ?? null)) ? ("DISABLED") : (""));
        echo "/>
                                    <p class=\"text-muted\">Which folder to store files in on the server, relating to the script root. Normally files/</p>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
        // line 72
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("improved_download_management", "Improved Downloads")), "html", null, true);
        echo ":</label>
                                <div class=\"col-md-9 col-sm-9 col-xs-12\">
                                    <select name=\"dlAccelerator\" id=\"dlAccelerator1\" class=\"form-control\">
                                        ";
        // line 75
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["dlAcceleratorOptions"] ?? null));
        foreach ($context['_seq'] as $context["k"] => $context["dlAcceleratorOption"]) {
            // line 76
            echo "                                            <option value=\"";
            echo twig_escape_filter($this->env, $context["k"], "html", null, true);
            echo "\"";
            echo (((($context["download_accelerator"] ?? null) == $context["k"])) ? (" SELECTED") : (""));
            echo ">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $context["dlAcceleratorOption"]), "html", null, true);
            echo "</option>
                                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['k'], $context['dlAcceleratorOption'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 78
        echo "                                    </select>
                                    <p>This dramatically increases server performance for busy sites by handing the process away from PHP to Apache or Nginx. <strong>Important: </strong>You must make the server changes listed in the relevant link below for this to work.</p>
                                    <ul>
                                        <li><a href=\"https://support.mfscripts.com/public/kb_view/1/\" target=\"_blank\" style=\"text-decoration: underline;\">Enable XSendFile for Apache</a>.</li>
                                        <li><a href=\"https://support.mfscripts.com/public/kb_view/2/\" target=\"_blank\" style=\"text-decoration: underline;\">Enable X-Accel-Redirect for Nginx</a>.</li>
                                    </ul>
                                </div>
                            </div>
                        </span>

                        <span class=\"ftpElements\" style=\"display: none;\">
                            <div class=\"form-group\">
                                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
        // line 90
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("ftp_host", "ftp host")), "html", null, true);
        echo ":</label>
                                <div class=\"col-md-5 col-sm-5 col-xs-12\">
                                    <input name=\"ftp_host\" id=\"ftp_host\" type=\"text\" class=\"form-control\" value=\"";
        // line 92
        echo twig_escape_filter($this->env, ($context["ftp_host"] ?? null), "html", null, true);
        echo "\"/>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
        // line 96
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("ftp_port", "ftp port")), "html", null, true);
        echo ":</label>
                                <div class=\"col-md-5 col-sm-5 col-xs-12\">
                                    <input name=\"ftp_port\" id=\"ftp_port\" type=\"text\" class=\"form-control\" value=\"";
        // line 98
        echo twig_escape_filter($this->env, ($context["ftp_port"] ?? null), "html", null, true);
        echo "\" class=\"small\"/>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
        // line 102
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("ftp_username", "ftp username")), "html", null, true);
        echo ":</label>
                                <div class=\"col-md-5 col-sm-5 col-xs-12\">
                                    <input name=\"ftp_username\" id=\"ftp_username\" type=\"text\" class=\"form-control\" value=\"";
        // line 104
        echo twig_escape_filter($this->env, ($context["ftp_username"] ?? null), "html", null, true);
        echo "\"/>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
        // line 108
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("ftp_password", "ftp password")), "html", null, true);
        echo ":</label>
                                <div class=\"col-md-5 col-sm-5 col-xs-12\">
                                    <input name=\"ftp_password\" id=\"ftp_password\" type=\"password\" class=\"form-control\" value=\"";
        // line 110
        echo twig_escape_filter($this->env, ($context["ftp_password"] ?? null), "html", null, true);
        echo "\"/>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
        // line 114
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("file_storage_path", "file storage path")), "html", null, true);
        echo ":</label>
                                <div class=\"col-md-9 col-sm-9 col-xs-12\">
                                    <input name=\"storage_path\" id=\"ftp_storage_path\" type=\"text\" class=\"form-control\" value=\"";
        // line 116
        echo twig_escape_filter($this->env, ($context["storage_path"] ?? null), "html", null, true);
        echo "\" class=\"large\"/>
                                    <p class=\"text-muted\">As the FTP user would see it. Login with this FTP user using an FTP client to confirm<br/>the path to use.</p>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
        // line 121
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("ftp_server_type", "ftp server type")), "html", null, true);
        echo ":</label>
                                <div class=\"col-md-5 col-sm-5 col-xs-12\">
                                    <select name=\"ftp_server_type\" id=\"ftp_server_type\" class=\"form-control\">
                                        ";
        // line 124
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["ftpServerTypes"] ?? null));
        foreach ($context['_seq'] as $context["k"] => $context["ftpServerType"]) {
            // line 125
            echo "                                            <option value=\"";
            echo twig_escape_filter($this->env, $context["k"], "html", null, true);
            echo "\"";
            echo (((($context["ftp_server_type"] ?? null) == $context["k"])) ? (" SELECTED") : (""));
            echo ">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $context["ftpServerType"]), "html", null, true);
            echo "</option>
                                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['k'], $context['ftpServerType'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 127
        echo "                                    </select>
                                </div>
                            </div>

                            <div class=\"form-group\">
                                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
        // line 132
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("ftp_enable_passive_mode", "enable passive mode")), "html", null, true);
        echo ":</label>
                                <div class=\"col-md-3 col-sm-3 col-xs-12\">
                                    <select name=\"ftp_passive_mode\" id=\"ftp_passive_mode\" class=\"form-control\">
                                        ";
        // line 135
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["serverPassiveOptions"] ?? null));
        foreach ($context['_seq'] as $context["k"] => $context["serverPassiveOption"]) {
            // line 136
            echo "                                            <option value=\"";
            echo twig_escape_filter($this->env, $context["k"], "html", null, true);
            echo "\"";
            echo (((($context["ftp_passive_mode"] ?? null) == $context["k"])) ? (" SELECTED") : (""));
            echo ">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $context["serverPassiveOption"]), "html", null, true);
            echo "</option>
                                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['k'], $context['serverPassiveOption'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 138
        echo "                                    </select>
                                </div>
                            </div>
                        </span>

                        <span class=\"directElements\" style=\"display: none;\">
                            <div class=\"form-group\">
                                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
        // line 145
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("file_server_domain_name", "file server domain name")), "html", null, true);
        echo ":</label>
                                <div class=\"col-md-9 col-sm-9 col-xs-12\">
                                    <div class=\"input-group\">
                                        <span class=\"input-group-addon\">";
        // line 148
        echo twig_escape_filter($this->env, ($context["_CONFIG_SITE_PROTOCOL"] ?? null), "html", null, true);
        echo "://</span>
                                        <input name=\"file_server_domain_name\" id=\"file_server_domain_name\" class=\"form-control\" placeholder=\"i.e. fs1.";
        // line 149
        echo twig_escape_filter($this->env, ($context["_CONFIG_SITE_HOST_URL"] ?? null), "html", null, true);
        echo "\" type=\"text\" value=\"";
        echo twig_escape_filter($this->env, ($context["file_server_domain_name"] ?? null), "html", null, true);
        echo "\" onKeyUp=\"updateUrlParams();\" class=\"large\"/>
                                    </div>
                                    <p class=\"text-muted\">Uploads must use the same protocol as this site (";
        // line 151
        echo twig_escape_filter($this->env, ($context["_CONFIG_SITE_PROTOCOL"] ?? null), "html", null, true);
        echo ") due to browser security restrictions.</p>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
        // line 155
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("file_server_direct_server_path_to_install", "server path to install")), "html", null, true);
        echo ":</label>
                                <div class=\"col-md-9 col-sm-9 col-xs-12\">
                                    <input name=\"script_root_path\" id=\"direct_script_root_path\" placeholder=\"/home/admin/public_html\" type=\"text\" value=\"";
        // line 157
        echo twig_escape_filter($this->env, ($context["script_root_path"] ?? null), "html", null, true);
        echo "\" class=\"form-control\"/>
                                    <p class=\"text-muted\">The full server path to the script install on your file server. If you're unsure, leave empty and it'll be auto generated.</p>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
        // line 162
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("file_storage_path", "file storage path")), "html", null, true);
        echo ":</label>
                                <div class=\"col-md-9 col-sm-9 col-xs-12\">
                                    <input name=\"storage_path\" id=\"direct_storage_path\" type=\"text\" value=\"";
        // line 164
        echo twig_escape_filter($this->env, ($context["storage_path"] ?? null), "html", null, true);
        echo "\" class=\"form-control\"/>
                                    <p class=\"text-muted\">Which folder to store files in on the file server, relating to the script root. Normally files/</p>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
        // line 169
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("url_path", "url path")), "html", null, true);
        echo ":</label>
                                <div class=\"col-md-9 col-sm-9 col-xs-12\">
                                    <input name=\"script_path\" id=\"script_path\" type=\"text\" placeholder=\"/ - root, unless you installed into a sub-folder\" value=\"";
        // line 171
        echo twig_escape_filter($this->env, ($context["script_path"] ?? null), "html", null, true);
        echo "\" class=\"form-control\" onKeyUp=\"updateUrlParams();\"/>
                                    <p class=\"text-muted\">Use /, unless you've installed into a sub-folder on the file server domain above.</p>
                                </div>
                            </div>
                            <div class=\"clearfix alt-highlight\" style=\"display: none;\">
                                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
        // line 176
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("use_main_site_url", "use main site url")), "html", null, true);
        echo ":</label>
                                <div class=\"col-md-9 col-sm-9 col-xs-12\">
                                    <select name=\"route_via_main_site\" id=\"route_via_main_site\" class=\"form-control\">
                                        ";
        // line 179
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["routeViaMainSiteOptions"] ?? null));
        foreach ($context['_seq'] as $context["k"] => $context["routeViaMainSiteOption"]) {
            // line 180
            echo "                                            <option value=\"";
            echo twig_escape_filter($this->env, $context["k"], "html", null, true);
            echo "\"";
            echo (((($context["route_via_main_site"] ?? null) == $context["k"])) ? (" SELECTED") : (""));
            echo ">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $context["routeViaMainSiteOption"]), "html", null, true);
            echo "</option>
                                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['k'], $context['routeViaMainSiteOption'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 182
        echo "                                    </select>
                                    <p class=\"text-muted\">If 'yes' ";
        // line 183
        echo twig_escape_filter($this->env, ($context["_CONFIG_SITE_HOST_URL"] ?? null), "html", null, true);
        echo " will be used for all download urls generated on the site. Otherwise the above 'File Server Domain Name' will be used. Changing this will not impact any existing download urls.</p>
                                </div>
                            </div>

                            <div class=\"form-group\">
                                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
        // line 188
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("improved_download_management", "Improved Downloads")), "html", null, true);
        echo ":</label>
                                <div class=\"col-md-9 col-sm-9 col-xs-12\">
                                    <select name=\"dlAccelerator\" id=\"dlAccelerator2\" class=\"form-control\">
                                        ";
        // line 191
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["dlAcceleratorOptions"] ?? null));
        foreach ($context['_seq'] as $context["k"] => $context["dlAcceleratorOption"]) {
            // line 192
            echo "                                            <option value=\"";
            echo twig_escape_filter($this->env, $context["k"], "html", null, true);
            echo "\"";
            echo (((($context["download_accelerator"] ?? null) == $context["k"])) ? (" SELECTED") : (""));
            echo ">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $context["dlAcceleratorOption"]), "html", null, true);
            echo "</option>
                                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['k'], $context['dlAcceleratorOption'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 194
        echo "                                    </select>
                                    <p>This dramatically increases server performance for busy sites by handing the process away from PHP to Apache or Nginx. <strong>Important: </strong>You must make the server changes listed in the relevant link below for this to work.</p>
                                    <ul>
                                        <li><a href=\"https://support.mfscripts.com/public/kb_view/1/\" target=\"_blank\" style=\"text-decoration: underline;\">Enable XSendFile for Apache</a>.</li>
                                        <li><a href=\"https://support.mfscripts.com/public/kb_view/2/\" target=\"_blank\" style=\"text-decoration: underline;\">Enable X-Accel-Redirect for Nginx</a>.</li>
                                    </ul>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
        // line 203
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("file_server_download_proto", "file server download protocol")), "html", null, true);
        echo ":</label>
                                <div class=\"col-md-9 col-sm-9 col-xs-12\">
                                    <select name=\"file_server_download_proto\" id=\"file_server_download_proto\" class=\"form-control\">
                                        ";
        // line 206
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["serverPassiveOptions"] ?? null));
        foreach ($context['_seq'] as $context["k"] => $context["serverPassiveOption"]) {
            // line 207
            echo "                                            <option value=\"";
            echo twig_escape_filter($this->env, $context["k"], "html", null, true);
            echo "\"";
            echo (((($context["file_server_download_proto"] ?? null) == $context["k"])) ? (" SELECTED") : (""));
            echo ">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $context["serverPassiveOption"]), "html", null, true);
            echo "</option>
                                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['k'], $context['serverPassiveOption'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 209
        echo "                                    </select>
                                    <p class=\"text-muted\">Generally use the same as this site (";
        // line 210
        echo twig_escape_filter($this->env, ($context["_CONFIG_SITE_PROTOCOL"] ?? null), "html", null, true);
        echo "). Note that this is only for download urls.</p>
                                </div>
                            </div>
                        </span>



                        <span class=\"localElements serverAccessWrapper\" style=\"display: none;\">
                            <div class=\"x_title\">
                                <h2>";
        // line 219
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("local_server_ssh_details_this_server", "local server SSH details (This Server)")), "html", null, true);
        echo ":</h2>
                                <div class=\"clearfix\"></div>
                            </div>
                            <p>The following information should be filled in if you're using the media converter plugin or archive manager. If you have openssl_encrypt() functions available within your server PHP setup, these details will be encrypted in your database using AES256. In a future release we'll be able to use these details to automatically update your site.<br/><br/></p>
                            <div class=\"form-group\">
                                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
        // line 224
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("local_server_direct_ip_address", "local server ip address")), "html", null, true);
        echo ":</label>
                                <div class=\"col-md-5 col-sm-5 col-xs-12\">
                                    <input name=\"file_server_direct_ip_address\" id=\"file_server_direct_ip_address_2\" placeholder=\"i.e. 124.194.125.34\" type=\"text\" value=\"";
        // line 226
        echo twig_escape_filter($this->env, ($context["file_server_direct_ip_address"] ?? null), "html", null, true);
        echo "\" class=\"form-control\"/>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
        // line 230
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("local_server_direct_ssh_port", "local SSH port")), "html", null, true);
        echo ":</label>
                                <div class=\"col-md-3 col-sm-3 col-xs-12\">
                                    <input name=\"file_server_direct_ssh_port\" id=\"file_server_direct_ssh_port_2\" type=\"text\" placeholder=\"22\" value=\"";
        // line 232
        echo twig_escape_filter($this->env, ($context["file_server_direct_ssh_port"] ?? null), "html", null, true);
        echo "\" class=\"form-control\"/>
                                    <p class=\"text-muted\">Normally port 22.</p>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
        // line 237
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("local_server_direct_ssh_username", "local SSH username")), "html", null, true);
        echo ":</label>
                                <div class=\"col-md-5 col-sm-5 col-xs-12\">
                                    <input name=\"file_server_direct_ssh_username\" id=\"file_server_direct_ssh_username_2\" placeholder=\"user\" type=\"text\" value=\"";
        // line 239
        echo twig_escape_filter($this->env, ($context["file_server_direct_ssh_username"] ?? null), "html", null, true);
        echo "\" class=\"form-control\"/>
                                    <p class=\"text-muted\">Root equivalent user.</p>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
        // line 244
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("local_server_direct_ssh_password", "local SSH password")), "html", null, true);
        echo ":</label>
                                <div class=\"col-md-5 col-sm-5 col-xs-12\">
                                    <input name=\"file_server_direct_ssh_password\" id=\"file_server_direct_ssh_password_2\" type=\"password\" value=\"\" class=\"form-control\"/>
                                    <p class=\"text-muted\">Leave blank to keep existing value, if updating.</p>
                                </div>
                            </div>
                        </span>



                        <span class=\"directElements serverAccessWrapper\" style=\"display: none;\">
                            <div class=\"x_title\">
                                <h2>";
        // line 256
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("file_server_ssh_details", "file server SSH details")), "html", null, true);
        echo ":</h2>
                                <div class=\"clearfix\"></div>
                            </div>
                            <p>The following information should be filled in if you're using the media converter plugin or archive manager. If you have openssl_encrypt() functions available within your server PHP setup, these details will be encrypted in your database using AES256. In a future release we'll be able to use these details to automatically create and upgrade your file servers.</p>
                            <div class=\"form-group\">
                                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
        // line 261
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("file_server_direct_ip_address", "file server ip address")), "html", null, true);
        echo ":</label>
                                <div class=\"col-md-5 col-sm-5 col-xs-12\">
                                    <input name=\"file_server_direct_ip_address\" id=\"file_server_direct_ip_address\" placeholder=\"i.e. 124.194.125.34\" type=\"text\" value=\"";
        // line 263
        echo twig_escape_filter($this->env, ($context["file_server_direct_ip_address"] ?? null), "html", null, true);
        echo "\" class=\"form-control\"/>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
        // line 267
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("file_server_direct_ssh_port", "server SSH port")), "html", null, true);
        echo ":</label>
                                <div class=\"col-md-3 col-sm-3 col-xs-12\">
                                    <input name=\"file_server_direct_ssh_port\" id=\"file_server_direct_ssh_port\" type=\"text\" placeholder=\"22\" value=\"";
        // line 269
        echo twig_escape_filter($this->env, ($context["file_server_direct_ssh_port"] ?? null), "html", null, true);
        echo "\" class=\"form-control\"/>
                                    <p class=\"text-muted\">Normally port 22.</p>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
        // line 274
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("file_server_direct_ssh_username", "server SSH username")), "html", null, true);
        echo ":</label>
                                <div class=\"col-md-5 col-sm-5 col-xs-12\">
                                    <input name=\"file_server_direct_ssh_username\" id=\"file_server_direct_ssh_username\" placeholder=\"user\" type=\"text\" value=\"";
        // line 276
        echo twig_escape_filter($this->env, ($context["file_server_direct_ssh_username"] ?? null), "html", null, true);
        echo "\" class=\"form-control\"/>
                                    <p class=\"text-muted\">Root equivalent user.</p>
                                </div>
                            </div>
                            <div class=\"form-group\">
                                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
        // line 281
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("file_server_direct_ssh_password", "server SSH password")), "html", null, true);
        echo ":</label>
                                <div class=\"col-md-5 col-sm-5 col-xs-12\">
                                    <input name=\"file_server_direct_ssh_password\" id=\"file_server_direct_ssh_password\" type=\"password\" value=\"\" class=\"form-control\"/>
                                    <p class=\"text-muted\">Leave blank to keep existing value, if updating.</p>
                                </div>
                            </div>
                        </span>

                        <span class=\"directElements\" style=\"display: none;\">
                            <div class=\"x_title\">
                                <h2>";
        // line 291
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("file_server_direct_install", "Direct File Server Install")), "html", null, true);
        echo ":</h2>
                                <div class=\"clearfix\"></div>
                            </div>
                            <p>Direct file servers require additional setup on either a vps or dedicated server.</p>
                            <div class=\"form-group\">
                                <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
        // line 296
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("file_server_setup", "file server setup")), "html", null, true);
        echo ":</label>
                                <div class=\"col-md-9 col-sm-9 col-xs-12\">
                                    Direct file server requirements: PHP5.6+, Apache Mod Rewrite or Nginx, remote access to your MySQL database.<br/><br/>
                                    So that your direct file server can receive the uploads and process downloads, it needs a copy of the full codebase installed. Upload all the files from your main site (";
        // line 299
        echo twig_escape_filter($this->env, ($context["_CONFIG_SITE_HOST_URL"] ?? null), "html", null, true);
        echo ") to your new file server. This includes any plugin files within the plugin folder.<br/><br/>
                                    Once uploaded, replace the /_config.inc.php file on the new file server with the one listed below. Set your database password in the file (_CONFIG_DB_PASS). We've removed it for security.<br/><br/>
                                    <ul class=\"adminList\"><li><a id=\"configLink\" href=\"server_manage_direct_get_config_file?fileName=_config.inc.php\" style=\"text-decoration: underline;\">_config.inc.php</a></li></ul><br/>
                                    In addition, if you're using Apache, replace the '.htaccess' on the file server with the one listed below.<br/><br/>
                                    <ul class=\"adminList\"><li><a id=\"htaccessLink\" href=\"server_manage_direct_get_config_file?fileName=.htaccess&REWRITE_BASE=/\" style=\"text-decoration: underline;\">.htaccess</a></li></ul><br/>
                                    For Nginx users, set your rules to the same as the main server. See /___NGINX_RULES.txt for details.<br/><br/>
                                    Ensure the following folders are CHMOD 755 (or 777 depending on your host) on this file server:<br/><br/>
                                    <ul class=\"adminList\">
                                        <li>/files/</li>
                                        <li>/cache/</li>
                                        <li>/logs/</li>
                                        <li>/plugins/</li>
                                    </ul>
                                </div>
                            </div>
                        </span>

                        <span class=\"flysystemWrapper\" style=\"display: none;\">
                        </span>
                    </div>

                    <div role=\"tabpanel\" class=\"tab-pane fade\" id=\"tab_content2\" aria-labelledby=\"profile-tab\">
                        <div class=\"x_title\">
                            <h2>CDN Support:</h2>
                            <div class=\"clearfix\"></div>
                        </div>
                        <p>You can use Content Delivery Networks (CDNs) such as Stackpath or Akamai to handle image previews, file icons and other static assets. File downloads can not be handled by CDNs however users will see a big performance improvement using the file manager if this is set.</p>
                        <p>CDNs work by caching a copy of the requested file on their own servers, then sending that to the user from a server closer to their physical location.<br/><br/></p>
                        <div class=\"form-group\">
                            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
        // line 328
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("cdn_url", "cdn url")), "html", null, true);
        echo ":</label>
                            <div class=\"col-md-9 col-sm-9 col-xs-12\">
                                <input name=\"cdn_url\" id=\"cdn_url\" type=\"text\" value=\"";
        // line 330
        echo twig_escape_filter($this->env, ($context["cdn_url"] ?? null), "html", null, true);
        echo "\" class=\"form-control\"/>Ensure you've pointed the CDN url at this file server url. Exclude the https or http in the url. For Flysystem type servers this should be the main domain name of your site. Leave blank to disable.
                            </div>
                        </div>
                    </div>

                    <div role=\"tabpanel\" class=\"tab-pane fade\" id=\"tab_content3\" aria-labelledby=\"profile-tab\">
                        <div class=\"x_title\">
                            <h2>Storage Options:</h2>
                            <div class=\"clearfix\"></div>
                        </div>
                        <div class=\"form-group\">
                            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
        // line 341
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("max_storage_bytes", "max storage (bytes)")), "html", null, true);
        echo ":</label>
                            <div class=\"col-md-9 col-sm-9 col-xs-12\">
                                <input name=\"max_storage_space\" id=\"max_storage_space\" type=\"text\" value=\"";
        // line 343
        echo twig_escape_filter($this->env, ($context["max_storage_space"] ?? null), "html", null, true);
        echo "\" class=\"form-control\" placeholder=\"2199023255552 = 2TB\"/>&nbsp;bytes. Use zero for unlimited.
                            </div>
                        </div>
                        <div class=\"form-group\">
                            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">";
        // line 347
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("server_priority", "server priority")), "html", null, true);
        echo ":</label>
                            <div class=\"col-md-9 col-sm-9 col-xs-12\">
                                <input name=\"server_priority\" id=\"server_priority\" type=\"text\" value=\"";
        // line 349
        echo twig_escape_filter($this->env, ($context["server_priority"] ?? null), "html", null, true);
        echo "\" class=\"form-control\"/>&nbsp;A number. In order from lowest. 0 to ignore.<br/><br/>- Use for multiple servers when others are full. So when server with priority of 1 is full, server<br/>with priority of 2 will be used next for new uploads. 3 next and so on. \"Server selection method\"<br/>must be set to \"Until Full\" to enable this functionality.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>";
    }

    public function getTemplateName()
    {
        return "admin/ajax/server_manage_add_form.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  706 => 349,  701 => 347,  694 => 343,  689 => 341,  675 => 330,  670 => 328,  638 => 299,  632 => 296,  624 => 291,  611 => 281,  603 => 276,  598 => 274,  590 => 269,  585 => 267,  578 => 263,  573 => 261,  565 => 256,  550 => 244,  542 => 239,  537 => 237,  529 => 232,  524 => 230,  517 => 226,  512 => 224,  504 => 219,  492 => 210,  489 => 209,  476 => 207,  472 => 206,  466 => 203,  455 => 194,  442 => 192,  438 => 191,  432 => 188,  424 => 183,  421 => 182,  408 => 180,  404 => 179,  398 => 176,  390 => 171,  385 => 169,  377 => 164,  372 => 162,  364 => 157,  359 => 155,  352 => 151,  345 => 149,  341 => 148,  335 => 145,  326 => 138,  313 => 136,  309 => 135,  303 => 132,  296 => 127,  283 => 125,  279 => 124,  273 => 121,  265 => 116,  260 => 114,  253 => 110,  248 => 108,  241 => 104,  236 => 102,  229 => 98,  224 => 96,  217 => 92,  212 => 90,  198 => 78,  185 => 76,  181 => 75,  175 => 72,  165 => 67,  160 => 65,  152 => 60,  147 => 58,  137 => 51,  132 => 49,  128 => 48,  124 => 47,  120 => 46,  115 => 44,  109 => 41,  102 => 36,  89 => 34,  85 => 33,  79 => 30,  69 => 25,  64 => 23,  58 => 20,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "admin/ajax/server_manage_add_form.html.twig", "/var/www/html/medicalimage/app/views/admin/ajax/server_manage_add_form.html.twig");
    }
}
