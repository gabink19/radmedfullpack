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

/* admin/system_update.html.twig */
class __TwigTemplate_b8d892707e024b0b9f11bebef5b7b84fe472327bf5578a3fe81a12253e9d91d1 extends \Twig\Template
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
        $this->parent = $this->loadTemplate("admin/partial/layout_logged_in.html.twig", "admin/system_update.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "System Update";
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
        echo "    <script>
        function checkForUpdates() {
            \$('#checkUpdatesBtn1').hide();
            \$('#checkUpdatesBtn2').show();

            \$(document).ready(function () {
                \$.ajax({
                    url: \"ajax/check_for_upgrade\",
                    dataType: \"json\"
                }).done(function (response) {
                    console.log(response);
                    if (typeof (response['core']) != \"undefined\") {
                        // updates available
                        \$('.availableVersionNumber').html(response['core']['latest_version']);
                        \$('#checkUpdatesBtn3').text('Upgrade to v' + response['core']['latest_version']);
                        \$('.releaseNotesTitle').html('Release Notes for v' + response['core']['latest_version']);
                        \$('.releaseNotesPara1').html(response['core']['release_detail']['release_date_formatted'] + ' - ' + response['core']['release_detail']['release_title']);
                        \$('.releaseNotesPara2').html(response['core']['release_detail']['release_detail']);

                        \$('.updateCheckerWrapper').hide();
                        \$('.updateAvailableWrapper').show();
                    } else {
                        // no updates available
                        \$('.updateCheckerWrapper').hide();
                        \$('.updateNotAvailableWrapper').show();
                    }
                });
            });
        }
    </script>

    <!-- page content -->
    <div class=\"right_col\" role=\"main\">
        <div class=\"\">
            <div class=\"page-title\">
                <div class=\"title_left\">
                    <h3>";
        // line 44
        $this->displayBlock("title", $context, $blocks);
        echo "</h3>
                </div>
            </div>
            <div class=\"clearfix\"></div>

            ";
        // line 49
        echo ($context["msg_page_notifications"] ?? null);
        echo "

            <div class=\"row\">
                <div class=\"col-md-12 col-sm-12 col-xs-12\">
                    <div class=\"x_panel updateCheckerWrapper\">
                        <div class=\"x_title\">
                            <h2>Update Check</h2>
                            <div class=\"clearfix\"></div>
                        </div>
                        <div class=\"x_content\">
                            <p>Use this page to check and apply updates for your install.</p>
                            <p>Current Version: v";
        // line 60
        echo twig_escape_filter($this->env, ($context["scriptInstalledVersion"] ?? null), "html", null, true);
        echo "</p>
                        </div>

                        <a id=\"checkUpdatesBtn1\" href=\"#\" class=\"btn btn-primary\" onClick=\"checkForUpdates();
                            return false;\">";
        // line 64
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("system_update_check_for_updates", "Check for Updates"), "html", null, true);
        echo "</a>
                        <a id=\"checkUpdatesBtn2\" href=\"#\" class=\"btn btn-primary\" onClick=\"return false;\" style=\"display: none;\" disabled=\"disabled\">";
        // line 65
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("system_update_checking_for_updates", "Checking..."), "html", null, true);
        echo " <span class=\"glyphicon glyphicon-refresh spinning\"></span></a>
                    </div>

                    <div class=\"x_panel updateNotAvailableWrapper\" style=\"display: none;\">
                        <div class=\"x_title\">
                            <h2>You're Up To Date!</h2>
                            <div class=\"clearfix\"></div>
                        </div>
                        <div class=\"x_content\">
                            <p>Congratulations, you are already on the latest copy of the script. Check again at any time or keep an eye on our website for announcements.</p>
                        </div>
                    </div>

                    <div class=\"x_panel updateAvailableWrapper\" style=\"display: none;\">
                        <div class=\"x_title\">
                            <h2>Update Available!</h2>
                            <div class=\"clearfix\"></div>
                        </div>
                        <div class=\"x_content\">
                            <p>A new update to your install is available! Click the button below to download <strong>v<span class=\"availableVersionNumber\"></span></strong> via your account login on the ";
        // line 84
        echo twig_escape_filter($this->env, ($context["currentProductName"] ?? null), "html", null, true);
        echo " website.</p>
                        </div>

                        <a id=\"checkUpdatesBtn3\" href=\"";
        // line 87
        echo twig_escape_filter($this->env, ($context["currentProductUrl"] ?? null), "html", null, true);
        echo "\" class=\"btn btn-success\" target=\"_blank\">";
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("system_update_start_update", "Upgrade"), "html", null, true);
        echo "</a>
                    </div>

                    <div class=\"x_panel updateAvailableWrapper\" style=\"display: none;\">
                        <div class=\"x_title\">
                            <h2 class=\"releaseNotesTitle\">Release Notes</h2>
                            <div class=\"clearfix\"></div>
                        </div>
                        <div class=\"x_content\">
                            <p class=\"releaseNotesPara1\"></p>
                            <p class=\"literal-block releaseNotesPara2\"></p>
                        </div>
                    </div>

                    <div class=\"x_panel updateAvailableWrapper\" style=\"display: none;\">
                        <div class=\"x_title\">
                            <h2>How to Upgrade</h2>
                            <div class=\"clearfix\"></div>
                        </div>
                        <div class=\"x_content\">
                            <ol>
                                <li>Download the latest release code.</li>
                                <li>Backup your MySQL database, any /files/ and the _config.inc file.</li>
                                <li>Backup any custom code or changes you have made (these may be overwritten).</li>
                                <li>Unzip the newly downloaded zip file onto your local computer.</li>
                                <li>Within that local code, remove the _config.inc file & the install/ folder.</li>
                                <li>Upload the new files to your existing installation of ";
        // line 113
        echo twig_escape_filter($this->env, ($context["currentProductName"] ?? null), "html", null, true);
        echo " replacing all existing files.</li>
                                <li>Within your hosting control panel, load phpMyAdmin and select your new database. In the right-hand section click on 'import'. Attach the the relevant sql patches from the directory `/install/resources/upgrade_sql_statements/` and submit the form. Choose the patches between your current script version number and the latest, ensuring you do them in version number order. If there are none, you can ignore this step.</li>
                                <li>Done - Enjoy the upgrade!</li>
                                </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "admin/system_update.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  204 => 113,  173 => 87,  167 => 84,  145 => 65,  141 => 64,  134 => 60,  120 => 49,  112 => 44,  74 => 8,  70 => 7,  63 => 5,  56 => 4,  49 => 3,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "admin/system_update.html.twig", "/var/www/html/medicalimage/app/views/admin/system_update.html.twig");
    }
}
